<?php
require_once 'BaseRepository.php';

class StudentRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Students');
  }

  public function findStudentWithClass($id)
  {
    $sql = "SELECT Students.*, Classes.name as className FROM Students
                JOIN Classes ON Students.classId = Classes.id
                WHERE Students.id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getCountByGender($gender)
  {
    $sql = "SELECT COUNT(*) FROM Students WHERE sex = :gender";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['gender' => $gender]);
    return (int) $stmt->fetchColumn();
  }
}
