<?php
setcookie("id_smjera", "", time() - 1, "/");
setcookie("id_drugog_smjera", "", time() - 1, "/");
setcookie("link_stranica", "", time() - 1, "/");
setcookie("link_posao", "", time() - 1, "/");
header("Location: index.php");
?>