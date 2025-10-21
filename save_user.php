<?php
header("Content-Type: application/json");

// Connexion à PostgreSQL (Render)
$host = "dpg-d3rk7gfdiees73bphnkg-a";
$dbname = "db_api_user";
$user = "db_api_user_user";
$pass = "aXsISlcnaMTdIJkaHfXCxYEoDGWYT1be";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
    exit();
}

// Récupération des données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["nom"]) || !isset($data["email"])) {
    echo json_encode(["error" => "Champs manquants"]);
    exit();
}

$nom = $data["nom"];
$email = $data["email"];

try {
    $query = "INSERT INTO utilisateurs (nom, email) VALUES (:nom, :email)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    echo json_encode(["status" => "Utilisateur ajouté avec succès"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
}
?>
