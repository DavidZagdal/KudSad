<?php
    //stavljanje svakog postavljenog cookiea, cak i korisnikovog (logout) na 1 sekundu prije nego sto istekne, uglavnom brisajuci ga
    setcookie("id_smjera", "", time() - 1, "/");
    setcookie("id_drugog_smjera", "", time() - 1, "/");
    setcookie("logininfo", "", time() - 1, "/");
    setcookie("link_stranica", "", time() - 1, "/");
    setcookie("link_posao", "", time() - 1, "/");
    setcookie("link_prijelaz", "", time() - 1, "/");
    
    setcookie("no-jobs", "", time() - 1, "/");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['status'])) {
        $_SESSION['status'] = '';
    }
    if (isset($_SESSION['id_tempuser'])) {
        $_SESSION['id_tempuser'] = '';
    }
    
    header("Location: ../index.php");//ova linija skace na index.php glavne stranice, koji isto tako redirecta na homepage.php
?>