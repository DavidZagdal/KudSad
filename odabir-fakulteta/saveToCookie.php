<?php
    session_start();
    if(!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }
?>


<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["smjerId"])) {
            $smjerId = $_POST["smjerId"];
            if (isset($_COOKIE["id_smjera"])) {
                setcookie("id_drugog_smjera", $smjerId, time() + (86400 * 30), "/");
            } else {
                setcookie("id_smjera", $smjerId, time() + (86400 * 30), "/");
                
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
                    $ime_smjera = "";

                    foreach ($result as $row) {
                        if(htmlspecialchars($row['id_smjer']) == $smjerId){
                            $linkstranica = htmlspecialchars($row['link_stranica']);
                            $linkposao = htmlspecialchars($row['link_posao']);
                            $ime_smjera = htmlspecialchars($row['ime_smjer']);
                            $imefakulteta = htmlspecialchars($row['ime_fakulteta']);
                            $titula = htmlspecialchars($row['titula']);
                        }
                    }


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
                    
                    echo $linkstranica;
                    if($linkstranica != ""){
                        setcookie("link_stranica", $linkstranica, time() + (86400 * 30), "/");
                    }else{
                        $thisLink = searchGoogleFirstPage($imefakulteta);
                        echo 'usao';
                        echo $thisLink;
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

                } catch (PDOException $e) {

                }
                
            }
            echo "Podaci su spremljeni u kolačić.";
        } else {
            echo "Nema podataka za spremanje.";
        }
    } else {
        echo "Nevažeći zahtjev.";
    }



    function searchGoogleFirstPageSnippet($whatToSearch) {
        $apiKey = ''; //maknuto za public git
        $searchEngineId = ''; // maknuto za public git
    
        $encoded = urlencode($whatToSearch);
        
        $endpoint = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$searchEngineId}&q={$encoded}";
    
        
        $curl = curl_init();
    
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($curl);
    
        if(curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
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
        $apiKey = '';
        $searchEngineId = '';

        $encoded = urlencode($whatToSearch);
        
        $endpoint = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$searchEngineId}&q={$encoded}";

        
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        if(curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
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


    /*function izvuciSpec($snippet) {
        $pattern = '/\((spec.[^)]+)\)/';
        preg_match($pattern, $snippet, $matches);
    
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            return null;
        }
    }*/

    header("Location: ../homepage/");
?>