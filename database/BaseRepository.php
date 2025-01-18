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
      var_dump("PDO Exception: " . $e->getMessage());
      return null;
    } catch (Exception $e) {
      var_dump("General Exception: " . $e->getMessage());
      return null;
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

  public function findAllPaginated($offset, $limit)
  {
    $sql = "SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function update($id, array $data)
  {
    $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));

    $sql = "UPDATE {$this->table} SET $setClause WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    var_dump($data);
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
}
