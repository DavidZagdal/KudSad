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
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .hidden-column {
            display: none;
        }

        tr {
            cursor: pointer;
        }

        td{
            width: 33%;
        }

        tr:nth-child(even) {
            background-color: #212121;
        }

        .highlight {
            background-color: green;
            color: white;
        }

        tr.highlight {
            background-color: green;
            color: white;
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

        .floating-choice{
            position: fixed;
            text-align: center;
            bottom: 3px;
            right: 120px;
            z-index: 9999;
            background-color: #242424;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
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

    <div class="container">
        <div class="card">
            <div class="card-body container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-sm-3">
                        <form action="#" method="GET">
                            <label for="ime_fakulteta" class="form-label">Ime fakulteta:</label>
                            <input type="text" id="ime_fakulteta" name="ime_fakulteta" class="form-control">

                            <label for="ime_smjera" class="form-label">Ime smjera:</label>
                            <input type="text" id="ime_smjera" name="ime_smjera" class="form-control">

                            <button type="submit" class="btn-success btn mt-3" >Filter</button>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <form action="izbrisiCookies.php" method="POST">
                        
                            <button type="submit" class="btn-success btn">Reset</button>
                        </form>
                    </div>
                
                
                </div>
                
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body container-fluid">
                <div id="data-table"></div>
            </div>
        </div>
    </div>



    <p id="selected-row-data" class="floating-choice border border-success"></p>
    
    <button class="floating-button" onclick="saveToCookie()">Spremi</button>
    <form id="saveForm" method="post" action="saveToCookie.php">
    <input type="hidden" id="smjerId" name="smjerId">
</form>
</body>
</html>

<?php
    $ime_smjera = "";
    $ime_fakulteta = "";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['ime_fakulteta'])) {
            $ime_fakulteta = $_GET['ime_fakulteta'];
        }
        if(isset($_GET['ime_smjera'])) {
            $ime_smjera = $_GET['ime_smjera'];
        }
    }
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $database = $_SESSION['database'];
    

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->query("SELECT * FROM fakultet JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $whatToEcho = "";

        $whatToEcho .= '<div class="table-responsive">';
        $whatToEcho .= '<table class="table-bordered table-hover table-dark">';
        $whatToEcho .= '<thead class="thead-dark">';
        $whatToEcho .= '<tr>';
        $whatToEcho .= '<th scope="col">Ime fakulteta</th>';
        $whatToEcho .= '<th scope="col">Ime Smjera</th>';
        $whatToEcho .= '<th scope="col">Deskripcija smjera</th>';
        $whatToEcho .= '<th scope="col" class="hidden-column">id smjera</th>';
        $whatToEcho .= '</tr>';
        $whatToEcho .= '</thead>';
        $whatToEcho .= '<tbody>';

        
        foreach ($result as $row) {
            if(str_contains(htmlspecialchars($row['ime_smjer']), $ime_smjera) && str_contains(htmlspecialchars($row['ime_fakulteta']), $ime_fakulteta)){
                $whatToEcho = printData($whatToEcho, $row);
            }
        }
        
        $whatToEcho .= '</tbody>';
        $whatToEcho .= '</table>';
        $whatToEcho .= '</div>';

        echo "<script>document.getElementById('data-table').innerHTML = '" . addslashes($whatToEcho) . "';</script>";
    } catch (PDOException $e) {

    }

    $conn = null;
    


    function printData($whatToEcho, $row){
        $whatToEcho .= '<tr onclick="selectRow(this,'.htmlspecialchars($row['id_smjer']).')">';
        $whatToEcho .= '<td>' . htmlspecialchars($row['ime_fakulteta']) . '</td>';
        $whatToEcho .= '<td>' . htmlspecialchars($row['ime_smjer']) . '</td>';
        $whatToEcho .= '<td>' . htmlspecialchars($row['opis_smjer']) . '</td>';
        $whatToEcho .= '<td class="hidden-column">' . htmlspecialchars($row['id_smjer']) . '</td>';
        $whatToEcho .= '</tr>';

        return $whatToEcho;
    }
    
?>

<script>
function selectRow(row, id_s) {
    var rows = document.querySelectorAll('tr');
    rows.forEach(function(row) {
        row.classList.remove('highlight');
    });

    row.classList.add('highlight');

    var rowData = row.cells[0].innerHTML + ", " + row.cells[1].innerHTML + ", " + row.cells[2].innerHTML;
    document.getElementById('selected-row-data').innerText = rowData;
}

function saveToCookie() {
    var selectedRow = document.querySelector('tr.highlight');

    if (selectedRow) {
        var smjerId = selectedRow.cells[3].innerHTML;
        document.getElementById('smjerId').value = smjerId;
        document.getElementById('saveForm').submit();
    } else {
        alert("Prvo odaberite red u tablici.");
    }

}
</script>
