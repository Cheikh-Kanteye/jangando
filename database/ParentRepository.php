<?php
class ParentRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Parents (id, username, name, surname, email, phone, address, createdAt) 
                VALUES (:id, :username, :name, :surname, :email, :phone, :address, :createdAt)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Parents";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Parents WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Parents SET username = :username, name = :name, surname = :surname, email = :email, phone = :phone, address = :address, createdAt = :createdAt 
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Parents WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
