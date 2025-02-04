<?php
require_once 'BaseRepository.php';

class StudentRepository extends BaseRepository
{
  private $usersRepository;

  public function __construct()
  {
    parent::__construct('Students');
    $this->usersRepository = new UsersRepository();
  }

  public function createStudent($data)
  {
    try {
      $userId = $this->usersRepository->createUser($data['email']);
      $imgPath = $this->usersRepository->handleImageUpload();
      $studentData = $this->prepareStudentData($data, $userId, $imgPath);
      $this->create($studentData);
      $this->usersRepository->displayMessage("Student created with ID: " . $studentData['id']);
    } catch (PDOException $e) {
      $this->usersRepository->displayMessage("PDO Exception: " . $e->getMessage());
    } catch (Exception $e) {
      $this->usersRepository->displayMessage("General Exception: " . $e->getMessage());
    }
  }

  private function prepareStudentData($data, $userId, $imgPath) {}

  public function findStudentWithClass($id)
  {

    $sql = "SELECT students.*, classes.name as className FROM students
                JOIN classes ON students.classId = classes.id
                WHERE students.id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function getCountByGender($gender)
  {
    $sql = "SELECT COUNT(*) FROM Students WHERE sex = :gender";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['gender' => $gender]);
    return (int) $stmt->fetchColumn();
  }

  public function findByEmail($email)
  {
    $sql = "SELECT * FROM {$this->table} WHERE email = :email";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
