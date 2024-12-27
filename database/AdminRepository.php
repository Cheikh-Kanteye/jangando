<?php
class AdminRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($id, $username)
  {
    $sql = "INSERT INTO Admins (id, username) VALUES (:id, :username)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id, 'username' => $username]);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Admins";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Admins WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $username)
  {
    $sql = "UPDATE Admins SET username = :username WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id, 'username' => $username]);
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Admins WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }
}
