<?php
function destroy_cookies(){
    setcookie("id_smjera", "", time() - 1, "/");
    setcookie("id_drugog_smjera", "", time() - 1, "/");
    setcookie("link_stranica", "", time() - 1, "/");
    setcookie("link_posao", "", time() - 1, "/");
    setcookie("no-jobs", "", time() - 1, "/");

    setcookie("link_prijelaz", "", time() - 1, "/");
    
//fali vjv jos jedan sessio ncookie koji trebam resetat
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    destroy_cookies();
    header("Location: index.php");
}
?>