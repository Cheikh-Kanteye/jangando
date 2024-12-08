<?php
require_once "./models.php";
require_once "./db.php";

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Lire le corps de la requête JSON
$inputData = json_decode(file_get_contents('php://input'), true);

// Vérifier si le corps contient l'ID et le type d'action
if ($inputData && isset($inputData['id']) && isset($inputData['type'])) {
  $id = intval($inputData['id']);
  $type = $inputData['type'];

  // Router basé sur le type d'action dans le corps de la requête
  switch ($type) {
    case 'delete_student':
      $response = deleteStudent($conn, $id);
      break;
    default:
      $response = ["status" => "failed", "message" => "Action non reconnue : $type"];
  }
} else {
  $response = ["status" => "failed", "message" => "Requête invalide ou données manquantes."];
}

echo json_encode($response);
