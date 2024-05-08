<?php
    //pokretanje sesije i provjeravanje da li je postavljena varijabla koja je potrebna za pokretanje veze s bazom podataka
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
    <meta name="description" content="Studentski poslovni pomoćnik!">
    <meta name="keywords" content="student, studenti, hrvatska, croatia, posao, hub, tražim, posao, fakultet, faks">
    <meta name="author" content="Skibidi Piggies">
    <title>KudSad</title>

    <meta property="og:title" content="KudSad">
    <meta property="og:description" content="Studentski poslovni pomoćnik">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.kudsad.site">
    <meta property="og:image" content="https://www.kudsad.site/images/KudSadLogo.png">


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
    <!-- pomocu php-a ispisujem prog. kod. toolbara, te ima dvije opcije, ako je korisnik ulogiran i ako nije -->
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
                        //spajanje na bazu i izvlacenje podataka o svim fakultetima, povezano sa JOIN sa smjerovima
                        if(isset($_COOKIE["id_smjera"])) {//ovdje ulazi samo ako je odabran neki smjer, ili ako ulogirani korisnik ima smjer
                            $id_smjera = $_COOKIE["id_smjera"];

                            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                            
                            $stmt = $conn->query("SELECT * FROM fakultet JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $fakultet = "";
                            $smjer = "";

                            foreach ($result as $row) {
                                if(htmlspecialchars($row['id_smjer']) == $id_smjera){//trazi korisnikov smjer, ovo kasnije u sql-u samo provjeriti da on vrati jedno, a ne gledati kroz sve
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
                        if(isset($_COOKIE["link_stranica"])) {//ako je postavljen cookie, sto znaci da taj fakultet ima svoj homepage, napravi iframe toga 
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