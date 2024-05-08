<?php
    session_start();
    if(!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }
?>

<?php 

saveEncryptedQuestion();

function encryptData($data, $key){
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, '1234567890123456');
    return base64_encode($encrypted);
}

function decryptData($data, $key){
    $decoded = base64_decode($data);
    $decrypted = openssl_decrypt($decoded, 'aes-256-cbc', $key, 0, '1234567890123456');
    return $decrypted;
}

function saveEncryptedQuestion(){
    try {
        $servername = $_SESSION['servername'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $database = $_SESSION['database'];
        
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $stmt = $conn->prepare("INSERT INTO pitanja (pitanje, ime, email) VALUES (:pitanje, :ime, :email)");
        
        $encryptedName = encryptData($_POST['name'], "encrypt");
        $encryptedEmail = encryptData($_POST['email'], "encrypt");
        $encryptedQuestion = encryptData($_POST['message'], "encrypt");

        $stmt->bindParam(':pitanje', $encryptedQuestion);
        $stmt->bindParam(':ime', $encryptedName);
        $stmt->bindParam(':email', $encryptedEmail);
        
        $stmt->execute();
        
        $conn = null;

        header("Location: faq.php?success=True");
        
    } catch(PDOException $e) {
        header("Location: faq.php?error=True");
    }
}
?>
