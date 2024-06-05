<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
} else if ((isset($_SESSION['status']) && $_SESSION['status'] != 'admin')) {
    header("Location: ../customerrors/403.html");
}

$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$database = $_SESSION['database'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KudSad</title>
    <script src="https://kit.fontawesome.com/90b9bb8c8d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../main-css-for-pages.css">
</head>
<body>

    <div id="toolbarContainer">
        <?php
            require '../toolbar/whatToolbarToUse.php';
            echo whatToolbarToUse();
        ?>
    </div>

    <div class="container">
        <h1 class="text-center">Pitanja korisnika</h1>
        <div id="questionsContainer">
            <?php
            function decryptData($data, $key) {
                $decoded = base64_decode($data);
                $decrypted = openssl_decrypt($decoded, 'aes-256-cbc', $key, 0, '1234567890123456');
                return $decrypted;
            }

            $stmt = $conn->query("SELECT pitanje, email, ime FROM pitanja");
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $key = 'encrypt'; 

            foreach ($questions as $index => $question) {
                $decryptedPitanje = decryptData($question['pitanje'], $key);
                $decryptedEmail = decryptData($question['email'], $key);
                $decryptedIme = decryptData($question['ime'], $key);
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pitanje #<?= $index + 1 ?></h5>
                        <p><strong>Pitanje:</strong> <?= htmlspecialchars($decryptedPitanje) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($decryptedEmail) ?></p>
                        <p><strong>Ime:</strong> <?= htmlspecialchars($decryptedIme) ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
