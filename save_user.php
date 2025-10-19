<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit(); }

// === CONFIGURATION DE LA BASE ===
$servername = "sql306.infinityfree.com";
$username = "if0_40163175";
$password = "0eYSSqQOYdlxy";
$dbname = "if0_40163175_mon_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { echo json_encode(["status"=>"error","message"=>$conn->connect_error]); exit; }

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || count($data)==0) $data = $_POST;

$nom = $conn->real_escape_string($data['nom'] ?? '');
$email = $conn->real_escape_string($data['email'] ?? '');
$mdp = $conn->real_escape_string($data['mot_de_passe'] ?? '');
$date = $conn->real_escape_string($data['date_anniversaire'] ?? '');
$tel = $conn->real_escape_string($data['telephone'] ?? '');

if (empty($nom) || empty($email)) {
  echo json_encode(["status"=>"no_data"]);
  exit;
}

$sql = "INSERT INTO utilisateurs (nom,email,mot_de_passe,date_naissance,telephone)
        VALUES ('$nom','$email','$mdp','$date','$tel')";
if ($conn->query($sql) === TRUE) {
  echo json_encode(["status"=>"success"]);
} else {
  echo json_encode(["status"=>"error","message"=>$conn->error]);
}
$conn->close();
