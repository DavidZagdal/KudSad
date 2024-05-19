<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naziv_posla = $_POST['naziv_posla'];
    $opis_posla = $_POST['opis_posla'];
    $time_limit = $_POST['time_limit'];
    $odabrani_smjerovi = explode(',', $_POST['odabrani_smjerovi']); 

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $userId = $_SESSION['id_tempuser'];

    try {
        
        $conn->beginTransaction();

        if (isset($_GET['id'])) {
            
            $posaoId = $_GET['id'];

            
            $stmt = $conn->prepare("SELECT * FROM posao WHERE id_posao = :id AND id_tempuser = :userId");
            $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $posao = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$posao) {
                throw new Exception("Neispravan ID posla ili nemate dopuštenje za uređivanje ovog posla.");
            }

            
            $stmt = $conn->prepare("UPDATE posao SET ime_posao = :naziv_posla, opis_posao = :opis_posla, deadline_posao = DATE_ADD(CURDATE(), INTERVAL :time_limit DAY) WHERE id_posao = :id");
            $stmt->bindParam(':naziv_posla', $naziv_posla, PDO::PARAM_STR);
            $stmt->bindParam(':opis_posla', $opis_posla, PDO::PARAM_STR);
            $stmt->bindParam(':time_limit', $time_limit, PDO::PARAM_INT);
            $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
            $stmt->execute();

            
            $stmt = $conn->prepare("DELETE FROM posao_smjer WHERE id_posao = :id");
            $stmt->bindParam(':id', $posaoId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            
            $stmt = $conn->prepare("INSERT INTO posao (ime_posao, opis_posao, deadline_posao, id_tempuser) VALUES (:naziv_posla, :opis_posla, DATE_ADD(CURDATE(), INTERVAL :time_limit DAY), :userId)");
            $stmt->bindParam(':naziv_posla', $naziv_posla, PDO::PARAM_STR);
            $stmt->bindParam(':opis_posla', $opis_posla, PDO::PARAM_STR);
            $stmt->bindParam(':time_limit', $time_limit, PDO::PARAM_INT);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $posaoId = $conn->lastInsertId();
        }

        
        $stmt = $conn->prepare("INSERT INTO posao_smjer (id_posao, id_smjer) VALUES (:posao_id, :smjer_id)");
        foreach ($odabrani_smjerovi as $smjer_id) {
            $stmt->bindParam(':posao_id', $posaoId, PDO::PARAM_INT);
            $stmt->bindParam(':smjer_id', $smjer_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        
        $conn->commit();
        header('Location: potvrda.php');
    } catch (Exception $e) {
        
        $conn->rollBack();
        die("Greška prilikom spremanja podataka: " . $e->getMessage());
    }
}
?>
