<?php
$dsn = 'mysql:dbname=exomoyenne;host=localhost:8889';
$user = 'root';
$password = 'root';
$option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
try {
    $pdo = new PDO($dsn, $user, $password, $option);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}
?>
  