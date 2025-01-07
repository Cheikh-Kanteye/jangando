<?php
require_once 'BaseRepository.php';

class AdminRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Admins');
  }

  public function findByUsername($username)
  {
    $sql = "SELECT * FROM {$this->table} WHERE username = :username";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
