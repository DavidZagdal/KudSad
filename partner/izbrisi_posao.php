<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_tempuser'])) {
    header("Location: login.php");
    exit();
}else if ((isset($_SESSION['status']) && $_SESSION['status'] != 'partner')) {
    header("Location: ../customerrors/403.html");
}
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $posaoId = $_GET['id'];
    $userId = $_SESSION['id_tempuser'];

    
    $stmt = $conn->prepare("SELECT * FROM posao WHERE id_posao = :id AND id_tempuser = :userId");
    $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $posao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($posao) {
        
        $stmt = $conn->prepare("DELETE FROM posao_smjer WHERE id_posao = :id");
        $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM posao WHERE id_posao = :id");
        $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: moji_poslovi.php");
        exit();
    } else {
        die("Neispravan ID posla ili nemate dopuštenje za brisanje ovog posla.");
    }
}
?>
