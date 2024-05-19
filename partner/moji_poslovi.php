<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['id_tempuser'])) {
    header("Location: ../login/");
    exit();
}else if ((isset($_SESSION['status']) && $_SESSION['status'] != 'partner')) {
    header("Location: ../customerrors/403.html");
}
require_once 'db_connection.php';

$userId = $_SESSION['id_tempuser'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moji Poslovi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <style>
        .container {
            margin-top: 20px;
        }
        .card {
            background-color: #282828;
            color: #FFFFFF;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #242424 !important;
            color: #28a745 !important;
            border-bottom: 2px solid #28a745;
        }

        td {
            background-color: #1e1e1e !important;
            border-bottom: 1px solid #28a745;
        }

        tr:hover td {
            background-color: #333 !important;
        }

        tr:nth-child(even) td {
            background-color: #2a2a2a !important;
        }

        tr.highlight, tr.highlight td {
            background-color: #28a745 !important;
            color: #fff;
        }

        tr.highlight:hover, tr.highlight:hover td {
            background-color: #28a745 !important;
            color: #fff;
        }

    </style>
</head>
<body>
    <div id="toolbarContainer">
        <?php
            require '../toolbar/whatToolbarToUse.php';
            echo whatToolbarToUse();
        ?>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
        <h2 class="title">Moji Poslovi</h2>
        <?php
        $stmt = $conn->prepare("SELECT * FROM posao WHERE id_tempuser = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $poslovi = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($poslovi) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<table class="table table-dark">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Naziv Posla</th>';
            echo '<th>Opis Posla</th>';
            echo '<th>Akcije</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($poslovi as $posao) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($posao['ime_posao']) . '</td>';
                echo '<td>' . htmlspecialchars($posao['opis_posao']) . '</td>';
                echo '<td>';
                echo '<a href="uredi_posao.php?id=' . $posao['id_posao'] . '" class="btn btn-primary btn-sm">Uredi</a> ';
                echo '<a href="izbrisi_posao.php?id=' . $posao['id_posao'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Jeste li sigurni da želite izbrisati ovaj posao?\')">Izbriši</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>Nema kreiranih poslova.</p>';
        }
        ?>
    </div>
</body>
</html>
