<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
}
?>



<?php 
    //include '../odabir-fakulteta/saveToCookie.php';

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
            if (hash('sha256', $_POST['password']) == $user['password']) {

            $email = $user['email']; 
            $id_smjera = $user['id_smjer'];
            $id_tempuser = $user['id_tempuser'];
            $_SESSION['id_tempuser'] = $id_tempuser.'';

            $encrypted = sha1($email.' '.sha1($_POST['password']));

            setcookie("logininfo", $encrypted, time() + (86400 * 30), "/");
            setcookie("id_smjera", $id_smjera, time() + (86400 * 30), "/");
            quickLogInSetup($id_smjera);
            

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
        
    }


    function quickLogInSetup($smjerId){
        $servername = $_SESSION['servername'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $database = $_SESSION['database'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            
            $stmt = $conn->query("SELECT * FROM fakultet JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $linkstranica = "";
            $linkposao = "";
            $imefakulteta = "";

            foreach ($result as $row) {
                if(htmlspecialchars($row['id_smjer']) == $smjerId){
                    $linkstranica = htmlspecialchars($row['link_stranica']);
                    $linkposao = htmlspecialchars($row['link_posao']);
                    $imefakulteta = htmlspecialchars($row['ime_fakulteta']);
                }
            }
            if($linkstranica != ""){
                setcookie("link_stranica", $linkstranica, time() + (86400 * 30), "/");
            }else{
                setcookie("link_stranica", searchGoogleFirstPage($imefakulteta), time() + (86400 * 30), "/");
            }

            if($linkposao != ""){
                setcookie("link_posao", $linkposao, time() + (86400 * 30), "/");
            }else{
                setcookie("link_posao", searchGoogleFirstPage($imefakulteta.' posao'), time() + (86400 * 30), "/");
            }

        } catch (PDOException $e) {
            header("Location: login-page.php?wrong=True");
        }
                
    }
    

?>

