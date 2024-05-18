<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
}
?>

<?php

function whatToolbarToUse(){

    if(isset($_COOKIE['logininfo'])){
        if(isset($_SESSION['status']) && $_SESSION['status'] == 'admin'){
            $toolbar_content = file_get_contents("../toolbar/toolbarAdmin.html");
            return $toolbar_content;
        }else if(isset($_SESSION['status']) && $_SESSION['status'] == 'partner'){
            $toolbar_content = file_get_contents("../toolbar/toolbarPartner.html");
            return $toolbar_content;
        }else{
            $toolbar_content = file_get_contents("../toolbar/toolbarLoggedIn.html");
            return $toolbar_content;
        }
    }else{
        $toolbar_content = file_get_contents("../toolbar/toolbar.html");
        return $toolbar_content;
    }
}
    
?>