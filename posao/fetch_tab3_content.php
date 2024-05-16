<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
}
?>

<?php
require '../scraper/scrape-functions.php';
require '../find-keyword/find-keyword.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_smjera'])) {
    $imePosla = getImeTipaPosla($_POST['id_smjera']);
    if ($imePosla != '') {
        $allJob = scrapeAndStoreDataPosaoHr($imePosla);
        if (!empty($allJob)) {
            foreach ($allJob as $job) {
                echo $job;
            }
        } else {
            echo '<div class="container text-center"><p>Za ovaj smjer nema kompetitivnih poslova</p></div>';
        }
    } else {
        echo '<div class="container text-center"><p>Za ovaj smjer nema kompetitivnih poslova</p></div>';
    }
} else {
    echo '<div class="container text-center"><p>Invalid request</p></div>';
}
?>

