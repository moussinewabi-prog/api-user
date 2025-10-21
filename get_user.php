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

// Récupération des utilisateurs
try {
    $stmt = $pdo->query("SELECT * FROM utilisateurs ORDER BY id DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
}
?>
