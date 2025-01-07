<?php
require_once "./database/DatabaseConnection.php";
require_once "BaseRepository.php";  // Inclure la classe de base

class UsersRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('users');
  }

  public function createUser($userData)
  {
    $data = [
      'username' => $userData['username'],
      'password' => $userData['password'],
      'role' => $userData['role'],
    ];

    return parent::create($data);
  }



  public function login($username, $password)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      return $user;
    } else {
      return null;
    }
  }
}
