<?php
class GradeRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Grades');
  }

  public function findAllWithLevels()
  {
    $sql = "SELECT * FROM {$this->table} ORDER BY level";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
