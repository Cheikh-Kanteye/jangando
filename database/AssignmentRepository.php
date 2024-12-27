<?php
class AssignmentRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Assignments (id, title, startDate, dueDate, lessonId) 
                VALUES (:id, :title, :startDate, :dueDate, :lessonId)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Assignments";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Assignments WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Assignments SET title = :title, startDate = :startDate, dueDate = :dueDate, lessonId = :lessonId 
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Assignments WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
