<?php


function getImeTipaPosla($id_smjer) {
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $database = $_SESSION['database'];
    
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $conn->query("
                        SELECT fakultet.*, smjer.*, tip_posla.ime_tip_posla AS ime_tip_posla 
                        FROM fakultet
                        JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet
                        LEFT JOIN tip_posla ON smjer.id_tip_posla = tip_posla.id_tip_posla
                    ");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ime_tip_posla = "";

    foreach ($result as $row) {
        if(htmlspecialchars($row['id_smjer']) == $id_smjer){
            $ime_tip_posla = htmlspecialchars($row['ime_tip_posla']);
        }
    }
    return $ime_tip_posla;
}


?>