<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
    exit();
}else if ((isset($_SESSION['status']) && $_SESSION['status'] != 'partner')) {
    header("Location: ../customerrors/403.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreiraj Posao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <script src="https://kit.fontawesome.com/90b9bb8c8d.js" crossorigin="anonymous"></script>
    <style>
        body{
            overflow: hidden;
        }
        .container {
            margin-top: 20px;
        }
        .smjerovi-container {
            display: flex;
            justify-content: space-between;
        }
        .smjerovi {
            width: 45%;
        }
        .ul-c {
            list-style-type: none;
            padding: 0;
            max-height: 380px;
            overflow-y: auto; 
        }
        .li-c {
            background-color: #282828;
            color: #FFFFFF;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            border: 1px solid #28a745;
        }
        .li-c:hover {
            background-color: #333;
        }
        .sticky-button {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }

        .tab-pane.show .if-cont {
            overflow-y: scroll;
            scrollbar-color: #28a745 #181818;
            scrollbar-width: thin;
        }

        .if-cont {
            overflow-y: scroll;
            scrollbar-color: #28a745 #181818;
            scrollbar-width: thin;
        }
        .form-control::placeholder { 
            color: white;
            opacity: 0.3;
        }

        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
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
    <div class="container">
        <h2 class="title">Kreiraj Novi Posao</h2>
        <form action="spremi_posao.php" method="POST" id="posao-form">
            <div class="mb-3">
                <label for="naziv_posla" class="form-label" style="background-color:#181818;">Naziv Posla:</label>
                <input type="text" id="naziv_posla" name="naziv_posla" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="opis_posla" class="form-label" style="background-color:#181818;">Opis Posla:</label>
                <textarea id="opis_posla" name="opis_posla" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="time_limit" class="form-label" style="background-color:#181818;">Time Limit (max 60 dana):</label>
                <input type="number" id="time_limit" name="time_limit" class="form-control" max="60" required>
            </div>
            <div class="smjerovi-container">
                <div class="smjerovi" id="smjerovi-lijevo">
                    <h3>Svi Smjerovi</h3>
                    <input type="text" id="filter-lijevo" placeholder="Filter..." class="form-control mb-3">
                    <ul id="lista-lijevo" class="border-green if-cont ul-c">
                        <?php
                        require_once 'db_connection.php';
                        $smjerovi = getAllSmjerovi();
                        foreach ($smjerovi as $smjer) {
                            
                            $fakultetId = $smjer['id_fakultet'];
                            $stmt = $conn->prepare("SELECT ime_fakulteta FROM fakultet WHERE id_fakultet = :id_fakultet");
                            $stmt->bindParam(':id_fakultet', $fakultetId, PDO::PARAM_INT);
                            $stmt->execute();
                            $fakultet = $stmt->fetch(PDO::FETCH_ASSOC);
                            $imeFakulteta = $fakultet ? $fakultet['ime_fakulteta'] : "Nepoznato";

                            echo "<li class=\"li-c card\" data-id='{$smjer['id_smjer']}'>{$smjer['ime_smjer']} - {$imeFakulteta}</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="smjerovi" id="smjerovi-desno">
                    <h3>Odabrani Smjerovi</h3>
                    <input type="text" id="filter-desno" placeholder="Filter..." class="form-control mb-3">
                    <ul id="lista-desno" class="border-green if-cont ul-c "></ul>
                </div>
            </div>
            <input type="hidden" name="odabrani_smjerovi" id="odabrani_smjerovi">
            <div class="sticky-button">
                <button type="submit" class="btn btn-success">Spremi</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('lista-lijevo').addEventListener('click', function(event) {
            if (event.target && event.target.nodeName == "LI") {
                document.getElementById('lista-desno').appendChild(event.target);
                updateOdabraniSmjerovi();
            }
        });

        document.getElementById('lista-desno').addEventListener('click', function(event) {
            if (event.target && event.target.nodeName == "LI") {
                document.getElementById('lista-lijevo').appendChild(event.target);
                updateOdabraniSmjerovi();
            }
        });

        document.getElementById('filter-lijevo').addEventListener('input', function() {
            filterList('lista-lijevo', this.value);
        });

        document.getElementById('filter-desno').addEventListener('input', function() {
            filterList('lista-desno', this.value);
        });

        function filterList(listId, filterText) {
            let list = document.getElementById(listId);
            Array.from(list.getElementsByTagName('li')).forEach(item => {
                if (item.textContent.toLowerCase().includes(filterText.toLowerCase())) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function updateOdabraniSmjerovi() {
            const selectedItems = document.querySelectorAll('#lista-desno li');
            const selectedIds = Array.from(selectedItems).map(item => item.getAttribute('data-id'));
            document.getElementById('odabrani_smjerovi').value = selectedIds.join(',');
        }
    </script>
</body>
</html>
