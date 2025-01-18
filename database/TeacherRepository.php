<?php
class TeacherRepository extends BaseRepository
{
  private $usersRepository;

  private function displayMessage($message)
  {
    echo "<script>alert('$message')</script>";
    echo "<script>window.location='/teachers'</script>";
    exit;
  }

  public function __construct()
  {
    parent::__construct('Teachers');
    $this->usersRepository = new UsersRepository();
  }


  public function createTeacher($data)
  {
    try {
      // Création de l'utilisateur avec UserRepository
      $password = password_hash("passer123", PASSWORD_BCRYPT);

      $userData = [
        'username' => $data['username'],
        'password' => $password,
        'role' => 'teacher',
      ];

      $userId = $this->usersRepository->create($userData);
      var_dump("User created with ID: " . $userId); // Vérification de la création de l'user

      // Gestion de l'image
      if (isset($_FILES['img'])) {
        $uploadResult = uploadImage($_FILES['img']);

        if (isset($uploadResult['success'])) {
          $imgPath = $uploadResult['success'];
        } else {
          var_dump($uploadResult); // Afficher l'erreur si l'image n'est pas téléchargée
          return $uploadResult; // Retourner l'erreur si l'image n'est pas téléchargée
        }
      } else {
        $imgPath = null;
      }

      // Création des données du professeur
      $teacherData = [
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

      // Insertion du professeur avec PDO
      $teacherQuery = "INSERT INTO Teachers (id,user_id, name, surname, email, phone, address, img, bloodType, sex, birthday) 
                        VALUES (:id, :user_id, :name, :surname, :email, :phone, :address, :img, :bloodType, :sex, :birthday)";
      $stmt = $this->db->prepare($teacherQuery);
      $stmt->bindParam(':id', $teacherData['id']);
      $stmt->bindParam(':user_id', $teacherData['user_id']);
      $stmt->bindParam(':name', $teacherData['name']);
      $stmt->bindParam(':surname', $teacherData['surname']);
      $stmt->bindParam(':email', $teacherData['email']);
      $stmt->bindParam(':phone', $teacherData['phone']);
      $stmt->bindParam(':address', $teacherData['address']);
      $stmt->bindParam(':img', $teacherData['img']);
      $stmt->bindParam(':bloodType', $teacherData['bloodType']);
      $stmt->bindParam(':sex', $teacherData['sex']);
      $stmt->bindParam(':birthday', $teacherData['birthday']);

      if (!$stmt->execute()) {
        throw new Exception("Erreur lors de la création du professeur.");
      }

      $teacherId = $this->db->lastInsertId();
      $this->displayMessage("teacher created with ID: " . $teacherId);
    } catch (PDOException $e) {
      $this->displayMessage("PDO Exception: " . $e->getMessage());
    } catch (Exception $e) {
      $this->displayMessage("General Exception: " . $e->getMessage());
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
    // Fetch teacher information
    $teacherSql = "SELECT * FROM Teachers WHERE id = :id";
    $teacherStmt = $this->db->prepare($teacherSql);
    $teacherStmt->execute(['id' => $id]);
    $teacher = $teacherStmt->fetch(PDO::FETCH_ASSOC);

    if (!$teacher) {
      throw new Exception("Teacher not found.");
    }

    // Fetch classes associated with the teacher
    $classesSql = "SELECT c.*
                   FROM teacher_classe tc
                   JOIN classes c ON tc.classe_id = c.id
                   WHERE tc.teacher_id = :id";
    $classesStmt = $this->db->prepare($classesSql);
    $classesStmt->execute(['id' => $id]);
    $classes = $classesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Combine teacher information with classes
    $teacher['classes'] = $classes;

    return $teacher;
  }


  public function deleteTeacher($teacherId)
  {
    try {
      // Find the teacher's user_id
      $sql = "SELECT user_id FROM Teachers WHERE id = :teacherId";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(['teacherId' => $teacherId]);
      $teacher = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$teacher) {
        throw new Exception("Teacher not found.");
      }

      $userId = $teacher['user_id'];

      // Delete from teacher_subjects
      $sql = "DELETE FROM teacher_subjects WHERE teacher_id = :teacherId";
      $stmt = $this->db->prepare($sql);
      if (!$stmt->execute(['teacherId' => $teacherId])) {
        throw new Exception("Error deleting from teacher_subjects.");
      }

      // Delete the teacher
      $sql = "DELETE FROM Teachers WHERE id = :teacherId";
      $stmt = $this->db->prepare($sql);
      if (!$stmt->execute(['teacherId' => $teacherId])) {
        throw new Exception("Error deleting teacher.");
      }

      // Delete the user
      if (!$this->usersRepository->delete($userId)) {
        throw new Exception("Error deleting user.");
      }

      return true;
    } catch (PDOException $e) {
      $this->displayMessage("PDO Exception: " . $e->getMessage());
      return false;
    } catch (Exception $e) {
      $this->displayMessage("General Exception: " . $e->getMessage());
      return false;
    }
  }
}
