<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["smjerId"])) {
            $smjerId = $_POST["smjerId"];
            if (isset($_COOKIE["id_smjera"])) {
                setcookie("id_drugog_smjera", $smjerId, time() + (86400 * 30), "/");
            } else {
                setcookie("id_smjera", $smjerId, time() + (86400 * 30), "/");
            }
            echo "Podaci su spremljeni u kolačić.";
        } else {
            echo "Nema podataka za spremanje.";
        }
    } else {
        echo "Nevažeći zahtjev.";
    }

    header("Location: ../homepage/");
?>