<?php
class LessonRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Lessons');
  }


  public function findByTeacherId($teacherId)
  {
    $sql = "SELECT lessons.*, teachers.name as teacher_name, teachers.email as teacher_email 
            FROM {$this->table} as lessons
            JOIN teachers ON lessons.teacherId = teachers.id
            WHERE lessons.teacherId = :teacherId";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['teacherId' => $teacherId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
