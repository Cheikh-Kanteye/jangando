<?php
class StudentRepository
{
  private $db;

  public function __construct()
  {
    $this->db = DatabaseConnection::getInstance()->getConnection();
  }

  public function create($data)
  {
    $sql = "INSERT INTO Students (id, username, name, surname, email, phone, address, img, bloodType, sex, createdAt, parentId, classId, gradeId, birthday) 
                VALUES (:id, :username, :name, :surname, :email, :phone, :address, :img, :bloodType, :sex, :createdAt, :parentId, :classId, :gradeId, :birthday)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($data);
  }

  public function count()
  {
    $sql = "SELECT COUNT(*) as count FROM Students";
    $stmt = $this->db->query($sql);
    return $stmt->fetchColumn();
  }

  public function findAll()
  {
    $sql = "SELECT * FROM Students";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll();
  }

  public function findById($id)
  {
    $sql = "SELECT * FROM Students WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function findStudentWithClass($id)
  {
    $sql = "SELECT Students.*, Classes.name as className  FROM Students
                JOIN Classes ON Students.classId = Classes.id
                JOIN Grades ON Students.gradeId = Grades.id
                WHERE Students.id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
  }

  public function update($id, $data)
  {
    $sql = "UPDATE Students SET username = :username, name = :name, surname = :surname, email = :email, phone = :phone, address = :address, img = :img, bloodType = :bloodType, sex = :sex, createdAt = :createdAt, parentId = :parentId, classId = :classId, gradeId = :gradeId, birthday = :birthday
                WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array_merge(['id' => $id], $data));
  }

  public function delete($id)
  {
    try {
      // Supprimer les enregistrements liés dans results
      $sqlResults = "DELETE FROM results WHERE studentId = :id";
      $stmtResults = $this->db->prepare($sqlResults);
      $stmtResults->execute(['id' => $id]);

      // Supprimer les enregistrements liés dans attendances
      $sqlAttendances = "DELETE FROM attendances WHERE studentId = :id";
      $stmtAttendances = $this->db->prepare($sqlAttendances);
      $stmtAttendances->execute(['id' => $id]);

      // Supprimer l'étudiant
      $sqlStudent = "DELETE FROM Students WHERE id = :id";
      $stmtStudent = $this->db->prepare($sqlStudent);
      $stmtStudent->execute(['id' => $id]);

      echo "<script>alert('Supprimé avec succés'); window.location.href='/students'</script>";
    } catch (PDOException $e) {
      echo "Erreur lors de la suppression : " . $e->getMessage();
    }
  }



  public function getCountByGender($gender)
  {
    $sql = "SELECT COUNT(*) FROM Students WHERE sex = :gender";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['gender' => $gender]);
    return (int) $stmt->fetchColumn();
  }
}
