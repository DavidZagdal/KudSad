<?php
    session_start();
    if(!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }
?>

<?php 
    $email = $_POST["email"];
    $password = $_POST["password"];

   
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $database = $_SESSION['database'];

    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tempuser WHERE email = :email");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            if (sha1($_POST['password']) == $user['password']) {

            $email = $user['email']; 
            $id_smjera = $user['id_smjer'];

            $encrypted = sha1($email.' '.sha1($_POST['password']));

            setcookie("logininfo", $encrypted, time() + (86400 * 30), "/");
            setcookie("id_smjera", $id_smjera, time() + (86400 * 30), "/");

                header("Location: ../homepage/index.php");
                exit();
            } else {
                header("Location: login-page.php?wrong=True");
                exit();
            }
        } else {
            header("Location: login-page.php?wrong=True");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }



    
?>