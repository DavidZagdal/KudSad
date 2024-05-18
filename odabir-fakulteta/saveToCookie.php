<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }
    
    require '../setglbvar/gapi.php';
    require 'izbrisiCookies.php'
?>


<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["smjerId"])) {
            //delete cookies
            destroy_cookies();

            $smjerId = $_POST["smjerId"];
                setcookie("id_smjera", $smjerId, time() + (86400 * 30), "/");
                
                $servername = $_SESSION['servername'];
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                $database = $_SESSION['database'];
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    
                    $stmt = $conn->query("
                        SELECT fakultet.*, smjer.*, tip_posla.ime_tip_posla AS ime_tip_posla 
                        FROM fakultet
                        JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet
                        LEFT JOIN tip_posla ON smjer.id_tip_posla = tip_posla.id_tip_posla
                    ");
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $linkstranica = "";
                    $linkposao = "";
                    $imefakulteta = "";
                    $ime_smjera = "";

                    foreach ($result as $row) {
                        if(htmlspecialchars($row['id_smjer']) == $smjerId){
                            $linkstranica = htmlspecialchars($row['link_stranica']);
                            $linkposao = htmlspecialchars($row['link_posao']);
                            $linkprijelaz = htmlspecialchars($row['link_prijelaz']);
                            $ime_smjera = htmlspecialchars($row['ime_smjer']);
                            $imefakulteta = htmlspecialchars($row['ime_fakulteta']);
                            $id_tip = htmlspecialchars($row['id_tip_posla']);
                        }
                    }
                    saveIdToUser($smjerId);

                    /*if($titula != ""){
                        $bacc = $titula;
                        setcookie("bacc", $bacc, time() + (86400 * 30), "/");
                    }else{
                        $snipp = searchGoogleFirstPageSnippet($ime_smjera.' "bacc. ing."');
                        $bacc = izvuciBacc($snipp);
                        setcookie("snippet",urldecode($snipp), time() + (86400 * 30), "/");
                        if($bacc != null){
                            setcookie("bacc", $bacc, time() + (86400 * 30), "/");
                            saveTitulaToSmjer($bacc, $smjerId);
                        }else{
                            setcookie("bacc", "error", time() + (86400 * 30), "/");
                        }
                    }*/

                    if($id_tip == 0){
                        findTipAndSave($smjerId, $ime_smjera, $conn);
                    }
                    
                    if($linkstranica != ""){
                        setcookie("link_stranica", $linkstranica, time() + (86400 * 30), "/");
                    }else{
                        $thisLink = searchGoogleFirstPage($imefakulteta);
                        setcookie("link_stranica", $thisLink, time() + (86400 * 30), "/");
                        saveStranicaLinkToDatabase($thisLink, $smjerId);
                    }

                    if($linkposao != ""){
                        setcookie("link_posao", $linkposao, time() + (86400 * 30), "/");
                    }else{
                        $thisLink = searchGoogleFirstPage($imefakulteta.' posao');
                        setcookie("link_posao",$thisLink , time() + (86400 * 30), "/");
                        savePosaoLinkToDatabase($thisLink, $smjerId);
                    }

                    if($linkprijelaz != ""){
                        setcookie("link_prijelaz", $linkprijelaz, time() + (86400 * 30), "/");
                    }else{
                        $thisLink = searchGoogleFirstPage($imefakulteta.' prijelaz');
                        setcookie("link_prijelaz",$thisLink , time() + (86400 * 30), "/");
                        savePrijelazLinkToDatabase($thisLink, $smjerId);
                    }

                } catch (PDOException $e) {
                    $timestamp = date("Y-m-d H:i:s");
                    $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
                    file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
                }
            echo "Podaci su spremljeni u cookie.";
            header("Location: ../homepage/");
        } else {
            echo "Nema podataka za spremanje.";
        }
    } else {
        
    }



    function searchGoogleFirstPageSnippet($whatToSearch) {
        $apiKey = getGAPI();
        $searchEngineId = getSEI();
    
        $encoded = urlencode($whatToSearch);
        
        $endpoint = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$searchEngineId}&q={$encoded}";
    
        
        $curl = curl_init();
    
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($curl);
    
        if(curl_errno($curl)) {
             $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . curl_error($curl) . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
            exit;
        }
    
        curl_close($curl);
    
        $results = json_decode($response, true);
    
        $firstSnippet = "";
        if(isset($results['items'][0]['snippet'])) {
            $firstSnippet = $results['items'][0]['snippet'];
        } 
    
        return $firstSnippet;
    }
    

    

    function searchGoogleFirstPage($whatToSearch) {

        $apiKey = getGAPI();
        $searchEngineId = getSEI();

        $encoded = urlencode($whatToSearch);
        
        $endpoint = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$searchEngineId}&q={$encoded}";

        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . curl_error($curl) . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
            exit;
        }

        curl_close($curl);


        $results = json_decode($response, true);

        $firstLink = "";
        if(isset($results['items'][0]['link'])) {
            $firstLink = $results['items'][0]['link'];
        } 
        return $firstLink;


    }
    


    function savePosaoLinkToDatabase($linkPosao, $idSmjer){
        try {
            $servername = $_SESSION['servername'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $database = $_SESSION['database'];
            
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("
                UPDATE fakultet
                JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet
                SET fakultet.link_posao = :linkPosao
                WHERE smjer.id_smjer = :idSmjer
            ");
            
            $stmt->bindParam(':idSmjer', $idSmjer, PDO::PARAM_INT);
            $stmt->bindParam(':linkPosao', $linkPosao, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $conn = null;
            
        } catch(PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }


    function savePrijelazLinkToDatabase($linkPrijelaz, $idSmjer){
        try {
            $servername = $_SESSION['servername'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $database = $_SESSION['database'];
            
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("
                UPDATE fakultet
                JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet
                SET fakultet.link_prijelaz = :linkPrijelaz
                WHERE smjer.id_smjer = :idSmjer
            ");
            
            $stmt->bindParam(':idSmjer', $idSmjer, PDO::PARAM_INT);
            $stmt->bindParam(':linkPrijelaz', $linkPrijelaz, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $conn = null;
            
        } catch(PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }

    function saveStranicaLinkToDatabase($linkStranica, $idSmjer){
        try {
            $servername = $_SESSION['servername'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $database = $_SESSION['database'];
            
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("
                UPDATE fakultet
                JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet
                SET fakultet.link_stranica = :linkStranica
                WHERE smjer.id_smjer = :idSmjer
            ");
            
            $stmt->bindParam(':idSmjer', $idSmjer, PDO::PARAM_INT);
            $stmt->bindParam(':linkStranica', $linkStranica, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $conn = null;
            
        } catch(PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }

    function saveTitulaToSmjer($titula, $idSmjer){
        try {
            $servername = $_SESSION['servername'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $database = $_SESSION['database'];
            
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("
                UPDATE smjer
                SET titula = :titula
                WHERE id_smjer = :idSmjer
            ");
            
            $stmt->bindParam(':idSmjer', $idSmjer, PDO::PARAM_INT);
            $stmt->bindParam(':titula', $titula, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $conn = null;
            
        } catch(PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }

    function saveIdToUser($idSmjer){
        try {
            $servername = $_SESSION['servername'];
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $database = $_SESSION['database'];

            $userID = $_SESSION['id_tempuser'];
            
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $stmt = $conn->prepare("
                UPDATE tempuser
                SET id_smjer = :id_smjer
                WHERE id_tempuser = :id_tempuser
            ");
            
            $stmt->bindParam(':id_tempuser', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':id_smjer', $idSmjer, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $conn = null;
            
        } catch(PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }
    


    function izvuciBacc($snippet) {
        $pattern = '/\((bacc.[^)]+)\)/';
    
        preg_match($pattern, $snippet, $matches);
    
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            return null; 
        }
    }

    function findTipAndSave($smjerId, $imeSmjera, $conn) {
        try {
            $stmt = $conn->query("SELECT id_tip_posla, ime_tip_posla FROM tip_posla");
            $tipoviPosla = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $found = 0;

            foreach ($tipoviPosla as $tip) {
                $imeTipa = $tip['ime_tip_posla'];
                if (stripos($imeSmjera, $imeTipa) !== false && strlen($imeTipa) >= 5 || stripos($imeTipa, $imeSmjera) !== false && strlen($imeSmjera) >= 5) {
                    $idTipPosla = $tip['id_tip_posla'];
    
                    $updateStmt = $conn->prepare("UPDATE smjer SET id_tip_posla = :idTipPosla WHERE id_smjer = :idSmjer");
                    $updateStmt->bindParam(':idTipPosla', $idTipPosla, PDO::PARAM_INT);
                    $updateStmt->bindParam(':idSmjer', $smjerId, PDO::PARAM_INT);
                    $updateStmt->execute();
                    $found = 1;
                    break;
                }
            }
            if($found == 0){
                setcookie("no-jobs", 'true', time() + (86400 * 30), "/");
            }
        } catch (PDOException $e) {
            $timestamp = date("Y-m-d H:i:s");
            $logMessage = "[$timestamp] file: saveToCookie.php. Error: " . $e->getMessage() . "\n";
            file_put_contents("../errors/errors.txt", $logMessage, FILE_APPEND);
        }
    }


    /*function izvuciSpec($snippet) {
        $pattern = '/\((spec.[^)]+)\)/';
        preg_match($pattern, $snippet, $matches);
    
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            return null;
        }
    }*/

    
?>