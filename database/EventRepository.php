<?php
class EventRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  // TODO: Fix the create method
  public function create($data)
  {
    $sql = "INSERT INTO Events (id, name, date, location) 
                VALUES (:id, :name, :date, :location)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Events";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Events WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Events SET name = :name, date = :date, location = :location 
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Events WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
