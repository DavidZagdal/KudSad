<?php
setcookie("id_smjera", "", time() - 1, "/");
setcookie("id_drugog_smjera", "", time() - 1, "/");
setcookie("logininfo", "", time() - 1, "/");
header("Location: ../index.php");
?>