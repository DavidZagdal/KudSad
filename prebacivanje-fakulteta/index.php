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



    

    <div class="card mt-3 container" >
            <div class="card-body container-fluid">

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
                        $whatToEcho .= '<th scope="col"></th>';
                        $whatToEcho .= '</tr>';
                        $whatToEcho .= '</thead>';
                        $whatToEcho .= '<tbody>';

                        
                        foreach ($result as $row) {
                            if(htmlspecialchars($row['ime_fakulteta']) == $fakultet){
                                $whatToEcho .= '<tr onclick="selectRow(this)">';
                                $whatToEcho .= '<td>' . htmlspecialchars($row['ime_smjer']) . '</td>';
                                $whatToEcho .= '<td>' . htmlspecialchars($row['opis_smjer']) . '</td>';
                                $whatToEcho .= '<td>' . '<button class="btn btn-success btn-block btn-sm">Prebaci</button>'. '</td>';
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

</body>
</html>