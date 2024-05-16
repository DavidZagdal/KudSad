<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fullName = $_POST["fullName"];

    if (empty($email) || empty($password)) {
        echo "Email i sifra su potrebni.";
        header("Location: register.php");
    }
    $hashedPassword = hash('sha256', $password);

   
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $dbPassword = $_SESSION['password'];
    $database = $_SESSION['database'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM tempuser WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            header("Location: register.php?wrong=True");
        }else{

            $stmt = $conn->prepare("INSERT INTO tempuser (email, password, ime) VALUES (:email, :password, :ime)");
        
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':ime', $fullName);
    
            $stmt->execute();
            header("Location: login-page.php");
        }


    } catch (PDOException $e) {
        $timestamp = date("Y-m-d H:i:s");
        $logMessage = "[$timestamp] file: register-to-database.php. Error: " . $e->getMessage() . "\n";
        file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        header("Location: register.php?wrong=True");
    }
    

    $conn = null;
}
?>
