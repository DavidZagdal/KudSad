<?php
require_once '../partner/db_connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $smjer_id = $_POST['id_smjera'];
    $poslovi = getPosloviBySmjerId($smjer_id);
    if (empty($poslovi)) {
        echo "<div class='container text-center'><p>Partneri još nisu postavili posao za Vaš smjer!</p></div>";
    } else {
        foreach ($poslovi as $posao) {
            echo "<div class=\"card m-3 border-success p-3 hover-custom\" style=\"color:#28a745;\">";
            echo "<h5>" . htmlspecialchars($posao['ime_posao']) . "</h5>";
            echo "<p class=\"p-not\" ><strong>" . htmlspecialchars($posao['opis_posao']) . "</strong></p>";
            echo "<p class=\"p-not\"><strong>Rok: " . htmlspecialchars($posao['deadline_posao']) . "</strong></p>";
            echo "</div>";
        }
    }   
}
?>