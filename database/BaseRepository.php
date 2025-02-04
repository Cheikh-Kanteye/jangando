<?php
abstract class BaseRepository
{
  protected $db;
  protected $table;

  public function __construct($table)
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
    $this->table = $table;
  }

  public function create($data)
  {
    try {
      $columns = implode(", ", array_keys($data));
      $placeholders = ":" . implode(", :", array_keys($data));

      $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
      $stmt = $this->db->prepare($query);

      foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
      }

      if ($stmt->execute()) {
        return $this->db->lastInsertId();
      }

      return null;
    } catch (PDOException $e) {
      if (
        strpos($e->getMessage(), 'teachers.email') !== false ||
        strpos($e->getMessage(), 'students.email') !== false ||
        strpos($e->getMessage(), 'parents.email') !== false
      ) {
        throw new Exception('Erreur : L\'email est déjà utilisé.');
      } elseif (
        strpos($e->getMessage(), 'teachers.phone') !== false ||
        strpos($e->getMessage(), 'students.phone') !== false ||
        strpos($e->getMessage(), 'parents.phone') !== false
      ) {
        throw new Exception('Erreur : Le numéro de téléphone est déjà utilisé.');
      } elseif (strpos($e->getMessage(), 'users.username') !== false) {
        throw new Exception('Erreur : Le nom d\'utilisateur est déjà pris.');
      } else {
        throw new Exception('Erreur de duplication non spécifiée.');
      }
    } catch (Exception $e) {
      throw new Exception('General Exception: ' . $e->getMessage());
    }
  }



  public function findById($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM {$this->table}";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findAllPaginated($offset, $limit, $search = null)
  {
    // Début de la requête
    $sql = "SELECT * FROM {$this->table}";

    // Ajouter une clause WHERE si un terme de recherche est fourni
    if (!empty($search)) {
      $sql .= " WHERE title LIKE :search";
    }

    // Ajouter la pagination
    $sql .= " LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($sql);

    // Lier les paramètres de pagination
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    // Lier le paramètre de recherche si nécessaire
    if (!empty($search)) {
      $search = "%{$search}%";
      $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    }

    // Exécuter la requête
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function update($id, array $data)
  {
    $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));

    $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    // var_dump($data);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  public function count()
  {
    $sql = "SELECT COUNT(*) as count FROM {$this->table}";
    $stmt = $this->db->query($sql);
    return $stmt->fetchColumn();
  }

  public function displayMessage($message)
  {
    echo "<script>alert('$message')</script>";
    echo "<script>window.location='/teachers'</script>";
    exit;
  }

  public function hashPassword($password)
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public function generateUniqueId($name, $surname)
  {
    return generateUniqueId($name, $surname, date('YmdHis'));
  }
}
