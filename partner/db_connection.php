<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }

    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $database = $_SESSION['database'];


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Konekcija nije uspjela: " . $e->getMessage());
    }
    
    function getAllSmjerovi() {
        global $conn;
        $sql = "SELECT * FROM smjer";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getPosaoById($id) {
        global $conn;
        $sql = "SELECT * FROM posao WHERE id_posao = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    function getAllPoslovi() {
        global $conn;
        $sql = "SELECT * FROM posao";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    function getSmjeroviByPosaoId($posao_id) {
        global $conn;
        $sql = "
            SELECT smjer.* 
            FROM smjer
            JOIN posao_smjer ON smjer.id_smjer = posao_smjer.id_smjer
            WHERE posao_smjer.id_posao = :posao_id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':posao_id', $posao_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    function getSmjeroviNotInPosao($posao_id) {
        global $conn;
        $sql = "
            SELECT smjer.* 
            FROM smjer
            WHERE smjer.id_smjer NOT IN (
                SELECT id_smjer 
                FROM posao_smjer
                WHERE id_posao = :posao_id
            )
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':posao_id', $posao_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPosloviBySmjerId($smjer_id) {
        global $conn;
        $sql = "
            SELECT posao.* 
            FROM posao
            JOIN posao_smjer ON posao.id_posao = posao_smjer.id_posao
            WHERE posao_smjer.id_smjer = :smjer_id
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':smjer_id', $smjer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>
