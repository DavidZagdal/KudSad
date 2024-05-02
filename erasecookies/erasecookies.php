<?php
    //stavljanje svakog postavljenog cookiea, cak i korisnikovog (logout) na 1 sekundu prije nego sto istekne, uglavnom brisajuci ga
    setcookie("id_smjera", "", time() - 1, "/");
    setcookie("id_drugog_smjera", "", time() - 1, "/");
    setcookie("logininfo", "", time() - 1, "/");
    setcookie("link_stranica", "", time() - 1, "/");
    setcookie("link_posao", "", time() - 1, "/");
    header("Location: ../index.php");//ova linija skace na index.php glavne stranice, koji isto tako redirecta na homepage.php
?>