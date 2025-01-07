<?php
require_once 'BaseRepository.php';

class ClasseRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Classes');
  }

  public function findByIDWithGrade($id)
  {
    $sql = "SELECT Classes.id, Classes.name, Classes.capacity, Classes.supervisorId, Classes.gradeId, Grades.level 
                FROM Classes 
                JOIN Grades ON Classes.gradeId = Grades.id 
                WHERE Classes.id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
