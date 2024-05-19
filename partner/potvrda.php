<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}else if ((isset($_SESSION['status']) && $_SESSION['status'] != 'partner')) {
    header("Location: ../customerrors/403.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potvrda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <style>
        .container {
            margin-top: 50px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                <h2 class="card-title">Uspješno ste spremili podatke!</h2>
                <p class="card-text">Podaci o novom poslu su uspješno spremljeni.</p>
                <a href="../homepage/" class="btn btn-primary">Povratak na početnu stranicu</a>
                <a href="kreiraj_novi_posao.php" class="btn btn-secondary">Kreiraj novi posao</a>
            </div>
        </div>
    </div>
</body>
</html>
