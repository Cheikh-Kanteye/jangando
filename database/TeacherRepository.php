<?php
class TeacherRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Teachers (id, username, name, surname, email, phone, address, img, bloodType, sex, createdAt, birthday) 
                VALUES (:id, :username, :name, :surname, :email, :phone, :address, :img, :bloodType, :sex, :createdAt, :birthday)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Teachers";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findTeacherWithSubjects($id)
  {
    $sql = "SELECT s.name AS subject_name
            FROM teacher_subjects ts
            JOIN teachers t ON ts.teacher_id = t.id   
            JOIN subjects s ON ts.subject_id = s.id
            WHERE ts.teacher_id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Retourner toutes les matières de l'enseignant
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Teachers WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Teachers SET username = :username, name = :name, surname = :surname, email = :email, phone = :phone, address = :address, img = :img, bloodType = :bloodType, sex = :sex, createdAt = :createdAt, birthday = :birthday 
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    $sql = "DELETE FROM Teachers WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo "<script>alert('Supprimé avec succés'); window.location.href='/teachers'</script>";
  }


  public function findAllPaginated($offset, $limit)
  {
    $sql = "SELECT * FROM Teachers LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
