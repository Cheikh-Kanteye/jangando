<?php
class ParentRepository extends BaseRepository
{
  private $usersRepository;

  public function __construct()
  {
    parent::__construct('Parents');
    $this->usersRepository = new UsersRepository();
  }

  public function createParent($data)
  {
    try {
      $password = $this->usersRepository->hashPassword("passer123");

      $userData = $this->prepareUserData($data['username'], $password);
      $userId = $this->usersRepository->create($userData);

      $parentData = $this->prepareParentData($data, $userId);
      $this->insertParentData($parentData);
    } catch (PDOException $e) {
      $this->usersRepository->displayMessage("PDO Exception: " . $e->getMessage());
    } catch (Exception $e) {
      $this->usersRepository->displayMessage("General Exception: " . $e->getMessage());
    }
  }


  private function prepareUserData($username, $password)
  {
    return [
      'username' => $username,
      'password' => $password,
      'role' => 'teacher',
    ];
  }

  private function prepareParentData($data, $userId)
  {
    return [
      'id' => $this->usersRepository->generateUniqueId($data['name'], $data['surname']),
      'user_id' => $userId,
      'name' => $data['name'],
      'surname' => $data['surname'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'address' => $data['address'],
    ];
  }

  private function insertParentData($parentData)
  {
    $parentQuery = "INSERT INTO parents (id, name, surname, email, phone, address, user_id) 
                    VALUES (:id, :name, :surname, :email, :phone, :address, :user_id)";
    $stmt = $this->db->prepare($parentQuery);
    $stmt->bindParam(':id', $parentData['id']);
    $stmt->bindParam(':user_id', $parentData['user_id']);
    $stmt->bindParam(':name', $parentData['name']);
    $stmt->bindParam(':surname', $parentData['surname']);
    $stmt->bindParam(':email', $parentData['email']);
    $stmt->bindParam(':phone', $parentData['phone']);
    $stmt->bindParam(':address', $parentData['address']);

    if (!$stmt->execute()) {
      throw new Exception("Erreur lors de la création du professeur.");
    }
  }
}
