<?php
class GradeRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Grades (id, level) VALUES (:id, :level)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Grades";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Grades WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Grades SET level = :level WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Grades WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
