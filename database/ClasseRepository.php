<?php
class ClasseRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Classes (id, name, capacity, supervisorId, gradeId) 
                VALUES (:id, :name, :capacity, :supervisorId, :gradeId)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Classes";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Classes WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

  public function update($id, $data)
  {
    $sql = "UPDATE Classes SET name = :name, capacity = :capacity, supervisorId = :supervisorId, gradeId = :gradeId 
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Classes WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
