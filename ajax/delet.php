<?php
$user = 'root';
$password = 'root';
$db = 'web-block';
$host = 'localhost';
$port = 3306;

$dsn = 'mysql:host='.$host.';dbname='.$db.';port='.$port;
$pdo = new PDO($dsn, $user, $password);

$userId = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $userId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
?>


