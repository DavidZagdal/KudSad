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

    <script src="https://kit.fontawesome.com/90b9bb8c8d.js" crossorigin="anonymous"></script>
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
        .nav-tabs {
            background-color: #282828;
            color: #FFFFFF;
            border-bottom: 0px solid #28a745;
        }

        .nav-tabs .nav-link {
            color: #FFFFFF;
        }

        .nav-tabs .nav-link.active {
            background-color: #28a745;
            border-color: #28a745;
        }


        @media (max-width: 800px) {
            .if-cont{
            height: 40vh; 
            overflow: auto; 
        }
        }


        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background-color: green;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        
        a{
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }

        .tab-pane .if-cont {
            height: 60vh; 
            overflow-y: hidden;
        }

        .tab-pane.show .if-cont {
            overflow-y: auto;
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
                                <button class="btn btn-success btn-block" onclick="window.location.href='../homepage/'">Home</button>
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

            <div class="card mt-3 flex-grow-1">
                <div class="card-body container-fluid">
                    <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Vaš Fakultet</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">MojPosao</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">posao.hr</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button" role="tab" aria-controls="tab5" aria-selected="false">Za Vas</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabsContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <?php
                                if(isset($_COOKIE["link_posao"])) {
                                    echo '<div class="container if-cont overflow-hidden">
                                        <iframe src="'.$_COOKIE["link_posao"].'"></iframe>
                                    </div>';                 
                                    
                                    echo '<button class="floating-button" onclick="openTab(\'';
                                        if(isset($_COOKIE["link_posao"])) {
                                            echo $_COOKIE["link_posao"];
                                        }
                                        echo '\')">';
                                        echo '<i class="fa-solid fa-arrow-up-right-from-square"></i>';
                                        echo '</button>';
                                }else{
                                    echo '<div class="container">
                                        <p>Odaberite fakultet</p>
                                    </div>';
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="container if-cont">
                                <?php
                                    if(isset($_COOKIE["link_posao"])) {
                                        require '../scraper/scrape-functions.php';
                                        $alljob = scrapeAndStoreDataMojPosao('Programer'); //ovdje kada se odabvere faks u cookie staviti kao "pretraga"
                                        foreach($alljob as $job){
                                            echo $job;
                                        }               
                                    }else{
                                        echo '<div class="container text-center">
                                            <p>Odaberite fakultet!</p>
                                        </div>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                            <?php
                                if(isset($_COOKIE["link_posaoHR"])) {
                                    echo '<div class="container if-cont overflow-hidden">
                                        <iframe src="'.$_COOKIE["link_posaoHR"].'"></iframe>
                                    </div>';                 
                                    echo '<button  class="floating-button" onclick="openTab(\'';
                                        if(isset($_COOKIE["link_posaoHR"])) {
                                            echo $_COOKIE["link_posaoHR"];
                                        }
                                    echo '\')"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>';
                                }else{
                                    echo '<div class="container text-center">
                                        <p>Stiže uskoro!</p>
                                    </div>';
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                            <div class="container text-center">
                                <p>Poslovni partneri za Vas!</p>
                                <p>Stiže uskoro!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    
    <script>
        function openTab(link) {
            window.open(link, '_blank');
        }
    </script>

</body>
</html>