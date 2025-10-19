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

$sql = "SELECT `id`,`nom`,`email`,`mot_de_passe`,`date_naissance`,`telephone` FROM utilisateurs ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  echo json_encode($result->fetch_assoc());
} else {
  echo json_encode(["status"=>"empty"]);
}
$conn->close();
