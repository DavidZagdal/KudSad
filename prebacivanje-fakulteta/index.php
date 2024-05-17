<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['servername'])) {
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

        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #242424 !important;
            color: #28a745 !important;
            border-bottom: 2px solid #28a745;
        }

        td {
            background-color: #1e1e1e !important;
            border-bottom: 1px solid #28a745;
        }

        tr:hover td {
            background-color: #333 !important;
        }

        tr:nth-child(even) td {
            background-color: #2a2a2a !important;
        }

        tr.highlight, tr.highlight td {
            background-color: #28a745 !important;
            color: #fff;
        }

        tr.highlight:hover, tr.highlight:hover td {
            background-color: #28a745 !important;
            color: #fff;
        }


        .hidden-column {
            display: none;
        }


        .card {
            background-color: #242424;
            border: 1px solid #28a745;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838 !important; 
        }


        body {
            overflow: hidden;
        }

        iframe {
            border: none;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .if-cont {
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
            .if-cont {
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

        a, .title {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            position: relative;
        }

        a.effect-underline:after {
            content: '';
            position: absolute;
            left: 0;
            display: inline-block;
            height: 1em;
            width: 100%;
            border-bottom: 1px solid;
            margin-top: 10px;
            opacity: 0;
            -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
            -webkit-transform: scale(0,1);
            transform: scale(0,1);
        }

        a.effect-underline:hover:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        .tab-pane .if-cont {
            height: 60vh;
            overflow-y: hidden;
        }

        .tab-pane.show .if-cont {
            overflow-y: scroll;
            scrollbar-color: #28a745 #181818;
            scrollbar-width: thin;
        }

        p {
            color: #FFFFFF;
            font-size: 1rem;
            line-height: 1.5;
        }

        @keyframes shadow-animation {
            0% {
                box-shadow: 0 0 0 rgba(0, 0, 0, 0.2);
            }
            100% {
                box-shadow: 0 0 20px rgba(0, 0, 0, 1);
            }
        }

        .hover-custom {
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .hover-custom:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 1);
        }


    </style>
</head>
<body>
    
    <div id="toolbarContainer">
        <?php
            require '../toolbar/whatToolbarToUse.php';
            echo whatToolbarToUse();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <div class="card mt-3 flex-grow-1 container">

        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3"> 
                    <button class="btn btn-success btn-block" onclick="window.location.href='../posao/'">Posao</button>
                </div>
                <div class="col-md-4 mb-3"> 
                    <button class="btn btn-success btn-block" onclick="window.location.href='../homepage/'">Home</button>
                </div>
                <div class="col-md-4 mb-3"> 
                    <button class="btn btn-success btn-block" onclick="window.location.href='../odabir-fakulteta/index.php'">Fakultet</button>
                </div>
            </div>
        </div>
                <div class="card-body container-fluid">
                    <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Kako prebaciti smjer</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Smjerovi</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabsContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <?php
                            if (isset($_COOKIE["link_prijelaz"])) {
                                echo '<div class="container if-cont overflow-hidden">
                                    <iframe src="' . $_COOKIE["link_prijelaz"] . '"></iframe>
                                </div>';

                                echo '<button class="floating-button" onclick="openTab(\'';
                                if (isset($_COOKIE["link_prijelaz"])) {
                                    echo $_COOKIE["link_prijelaz"];
                                }
                                echo '\')">';
                                echo '<i class="fa-solid fa-arrow-up-right-from-square"></i>';
                                echo '</button>';
                            } else {
                                echo '<div class="container">
                                    <p>Odaberite fakultet</p>
                                </div>';
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="container if-cont">
                                <div class=" mt-3 container" >
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

                                                $whatToEcho = "";
                                                $whatToEcho .= '<div class="table-responsive">';
                                                $whatToEcho .= '<table class="table-bordered table-hover table-dark">';
                                                $whatToEcho .= '<thead class="thead-dark">';
                                                $whatToEcho .= '<tr>';
                                                $whatToEcho .= '<th scope="col">Ime Smjera</th>';
                                                $whatToEcho .= '<th scope="col">Opis Smjera </th>';
                                                $whatToEcho .= '</tr>';
                                                $whatToEcho .= '</thead>';
                                                $whatToEcho .= '<tbody>';

                                                
                                                foreach ($result as $row) {
                                                    if(htmlspecialchars($row['ime_fakulteta']) == $fakultet){
                                                        $whatToEcho .= '<tr onclick="selectRow(this)">';
                                                        $whatToEcho .= '<td>' . htmlspecialchars($row['ime_smjer']) . '</td>';
                                                        $whatToEcho .= '<td>' . htmlspecialchars($row['opis_smjer']) . '</td>';
                                                        $whatToEcho .= '</tr>';
                                                    }
                                                }

                                                $whatToEcho .= '</tbody>';
                                                $whatToEcho .= '</table>';
                                                $whatToEcho .= '</div>';


                                                echo '
                                                <div class="container-fluid mb-2">
                                                    '.$whatToEcho.'
                                                </div>
                                                ';
                                            }else{
                                                echo '
                                                <div class="container-fluid mb-2">
                                                    <h1 class="card-text text-center">Nije odabran fakultet.</h1>
                                                </div>
                                                ';
                                            }
                                        ?>


                                    </div>

                                
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        function openTab() {
            var cookieValue = "<?php echo isset($_COOKIE['link_stranica']) ? $_COOKIE['link_stranica'] : ''; ?>";
            if (cookieValue !== "") {
                window.open(cookieValue, '_blank');
            }
        }
    </script>

</body>
</html>