<?php
    session_start();
    if(!isset($_SESSION['servername'])) {
        header("Location: ../setglbvar/setvardtb.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KudSad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <style>
        body{
            overflow: hidden;
        }
        
        iframe {
            border: none;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .if-cont{
            height: 60vh; 
            overflow: auto; 
        }



        @media (max-width: 800px) {
            .if-cont{
            height: 40vh; 
            overflow: auto; 
        }
        }

        
    </style>
</head>
<body>
    <div id="toolbarContainer">
            <?php
                if(isset($_COOKIE['logininfo'])){
                    $toolbar_content = file_get_contents("../toolbar/toolbarLoggedIn.html");
                    echo $toolbar_content;
                }else{
                    $toolbar_content = file_get_contents("../toolbar/toolbar.html");
                    echo $toolbar_content;
                }
            ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="d-flex flex-column vh-100">
        <div class="container" >
            <div class="card">
                <div class="card-body container-fluid">
                    
                    
                    <div class="container-fluid mb-2">
                        <p class="card-text text-center">Nakon odabira fakulteta će se prikazati više podataka.</p>
                    </div>
                    

                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-4 mb-3"> 
                                <button class="btn btn-success btn-block"  onclick="window.location.href='../posao/'">Posao</button>
                            </div>
                            <div class="col-md-4 mb-3"> 
                                <button class="btn btn-success btn-block" onclick="window.location.href='../prebacivanje-fakulteta/index.php'">Prebacivanje smjerova</button>
                            </div>
                            <div class="col-md-4 mb-3"> 
                                <button class="btn btn-success btn-block" onclick="window.location.href='../odabir-fakulteta/index.php'">Fakultet</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card mt-3 flex-grow-1" >
                <div class="card-body container-fluid">
                    
                    <?php
                        $servername = $_SESSION['servername'];
                        $username = $_SESSION['username'];
                        $password = $_SESSION['password'];
                        $database = $_SESSION['database'];

                        if(isset($_COOKIE["id_smjera"])) {
                            $id_smjera = $_COOKIE["id_smjera"];

                            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                            
                            $stmt = $conn->query("SELECT * FROM fakultet JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $fakultet = "";
                            $smjer = "";

                            foreach ($result as $row) {
                                if(htmlspecialchars($row['id_smjer']) == $id_smjera){
                                    $fakultet = htmlspecialchars($row['ime_fakulteta']);
                                    $smjer = htmlspecialchars($row['ime_smjer']);
                                }
                            }


                            echo '
                            <div class="container-fluid mb-2">
                                <h1 class="card-text text-center">'.$fakultet.'</h1>
                                <h2 class="card-text text-center">'.$smjer.'</h2>
                            </div>
                            ';
                        }else{
                            echo '
                            <div class="container-fluid mb-2">
                                <h1 class="card-text text-center">Nema zabilježena prijava na faks.</h1>
                                <p class="card-text text-center">Ukoliko želite možete odabrati neki drugi fakultet i vidjeti njegove opcije.</p>
                            </div>
                            ';
                        }
                    ?>

                    
                    <?php
                        if(isset($_COOKIE["link_stranica"])) {
                            echo '<div class="container if-cont overflow-hidden">
                                <iframe src="'.$_COOKIE["link_stranica"].'"></iframe>
                            </div>';                 

                        }else{
                            echo '<div class="container text-center">
                                <p>Odaberite fakultet</p>
                            </div>';
                        }
                    ?>

                </div>

                
            </div>
        </div>
    </div>
    


</body>
</html>