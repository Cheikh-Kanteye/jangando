<?php
class TeacherRepository extends BaseRepository
{
  private $usersRepository;

  public function __construct()
  {
    parent::__construct('Teachers');
    $this->usersRepository = new UsersRepository();
  }

  public function createTeacher($data)
  {
    try {
      $userId = $this->createUser($data['username']);
      $imgPath = $this->handleImageUpload();
      $teacherData = $this->prepareTeacherData($data, $userId, $imgPath);
      $this->insertTeacher($teacherData);
      $this->usersRepository->displayMessage("Teacher created with ID: " . $teacherData['id']);
    } catch (PDOException $e) {
      $this->usersRepository->displayMessage("PDO Exception: " . $e->getMessage());
    } catch (Exception $e) {
      $this->usersRepository->displayMessage("General Exception: " . $e->getMessage());
    }
  }

  private function createUser($username)
  {
    $password = password_hash("passer123", PASSWORD_BCRYPT);
    $userData = [
      'username' => $username,
      'password' => $password,
      'role' => 'teacher',
    ];
    return $this->usersRepository->create($userData);
  }

  private function handleImageUpload()
  {
    if (isset($_FILES['img'])) {
      $uploadResult = uploadImage($_FILES['img']);
      if (isset($uploadResult['success'])) {
        return $uploadResult['success'];
      } else {
        var_dump($uploadResult);
        throw new Exception("Image upload failed.");
      }
    }
    return null;
  }

  private function prepareTeacherData($data, $userId, $imgPath)
  {
    return [
      'id' => generateUniqueId($data['name'], $data['surname'], date('YmdHis')),
      'user_id' => $userId,
      'name' => $data['name'],
      'surname' => $data['surname'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'address' => $data['address'],
      'img' => $imgPath,
      'bloodType' => $data['bloodType'],
      'sex' => 'male',
      'birthday' => $data['birthday'],
    ];
  }

  private function insertTeacher($teacherData)
  {
    $teacherQuery =
      "INSERT INTO Teachers (id, user_id, name, surname, email, phone, address, img, bloodType, sex, birthday) 
      VALUES (:id, :user_id, :name, :surname, :email, :phone, :address, :img, :bloodType, :sex, :birthday)";

    $stmt = $this->db->prepare($teacherQuery);
    foreach ($teacherData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
    if (!$stmt->execute()) {
      throw new Exception("Error creating teacher.");
    }
  }

  public function findTeacherWithSubjects($id)
  {
    $sql = "SELECT s.name AS subject_name
            FROM teacher_subjects ts
            JOIN teachers t ON ts.teacher_id = t.id   
            JOIN subjects s ON ts.subject_id = s.id
            WHERE ts.teacher_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findTeacherWithClasses($id)
  {
    $teacher = $this->fetchTeacher($id);
    $classes = $this->fetchTeacherClasses($id);
    $teacher['classes'] = $classes;
    return $teacher;
  }

  private function fetchTeacher($id)
  {
    $sql = "SELECT * FROM Teachers WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$teacher) {
      throw new Exception("Teacher not found.");
    }
    return $teacher;
  }

  private function fetchTeacherClasses($id)
  {
    $sql = "SELECT c.*
            FROM teacher_classe tc
            JOIN classes c ON tc.classe_id = c.id
            WHERE tc.teacher_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deleteTeacher($teacherId)
  {
    try {
      $userId = $this->getTeacherUserId($teacherId);
      $this->deleteTeacherSubjects($teacherId);
      $this->deleteTeacherRecord($teacherId);
      $this->usersRepository->delete($userId);
      return true;
    } catch (PDOException $e) {
      $this->usersRepository->displayMessage("PDO Exception: " . $e->getMessage());
      return false;
    } catch (Exception $e) {
      $this->usersRepository->displayMessage("General Exception: " . $e->getMessage());
      return false;
    }
  }

  private function getTeacherUserId($teacherId)
  {
    $sql = "SELECT user_id FROM Teachers WHERE id = :teacherId";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['teacherId' => $teacherId]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$teacher) {
      throw new Exception("Teacher not found.");
    }
    return $teacher['user_id'];
  }

  private function deleteTeacherSubjects($teacherId)
  {
    $sql = "DELETE FROM teacher_subjects WHERE teacher_id = :teacherId";
    $stmt = $this->db->prepare($sql);
    if (!$stmt->execute(['teacherId' => $teacherId])) {
      throw new Exception("Error deleting from teacher_subjects.");
    }
  }

  private function deleteTeacherRecord($teacherId)
  {
    $sql = "DELETE FROM Teachers WHERE id = :teacherId";
    $stmt = $this->db->prepare($sql);
    if (!$stmt->execute(['teacherId' => $teacherId])) {
      throw new Exception("Error deleting teacher.");
    }
  }
}
