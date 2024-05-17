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

    <script src="https://kit.fontawesome.com/90b9bb8c8d.js" crossorigin="anonymous"></script>
    <style>
        body {
            overflow: hidden;
        }

        .vh-custom {
            height: 65vh !important;
        }

        @media (max-width: 767px) {
            .vh-custom {
                height: 40vh !important;
            }
        }

        @media (max-width: 337px) {
            .vh-custom {
                height: 30vh !important;
            }
        }

        .flex-grow-1 {
            flex-grow: 1;
        }

        .container {
            height: 100%;
        }

        .card {
            height: 100%;
        }

        .card-body {
            height: 100%;
        }

        .if-cont {
            height: 100%;
            overflow: hidden;
        }

        #objectContainer {
            height: 100%;
            width: 100%;
        }

        object {
            border: none;
            height: 100%;
            width: 100%;
            overflow: hidden;
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

    <div class="d-flex flex-column">
        <div class="container h-100">
            <div class="card h-100">
                <div class="card-body container-fluid h-100">
                    <div class="container-fluid mb-2">
                        <p class="card-text text-center">Nakon odabira fakulteta će se prikazati više podataka.</p>
                    </div>

                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-4 mb-3"> 
                                <button class="btn btn-success btn-block" onclick="window.location.href='../posao/'">Posao</button>
                            </div>
                            <div class="col-md-4 mb-3"> 
                                <button class="btn btn-success btn-block" onclick="window.location.href='../prebacivanje-fakulteta/index.php'">Prebacivanje smjerova</button>
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
                        
                        if (isset($_COOKIE["id_smjera"])) {
                            $id_smjera = $_COOKIE["id_smjera"];
                            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->query("SELECT * FROM fakultet JOIN smjer ON fakultet.id_fakultet = smjer.id_fakultet");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $fakultet = "";
                            $smjer = "";

                            foreach ($result as $row) {
                                if (htmlspecialchars($row['id_smjer']) == $id_smjera) {
                                    $fakultet = htmlspecialchars($row['ime_fakulteta']);
                                    $smjer = htmlspecialchars($row['ime_smjer']);
                                }
                            }

                            echo '
                            <div class="container-fluid mb-2">
                                <h1 class="card-text text-center">' . $fakultet . '</h1>
                                <h2 class="card-text text-center">' . $smjer . '</h2>
                            </div>';
                        } else {
                            echo '
                            <div class="container-fluid mb-2">
                                <h1 class="card-text text-center">Nema zabilježena prijava na faks.</h1>
                                <p class="card-text text-center">Ukoliko želite možete odabrati neki drugi fakultet i vidjeti njegove opcije.</p>
                            </div>';
                        }
                    ?>

                    <div class="container if-cont overflow-hidden vh-custom">
                        <div id="objectContainer" style="height: 100%; width: 100%;">
                        </div>
                    </div>

                    <script>
                        function loadObject(src, params, onLoaded, onError) {
                            var obj = document.createElement('object');
                            obj.style.display = 'block';
                            obj.style.visibility = 'hidden'; 
                            obj.style.width = '100%';
                            obj.style.height = '100%';
                            obj.data = src;

                            obj.innerHTML = '<div class="vh-custom" style="height:100%; width: 100%; display: flex; justify-content: center;  flex-grow: 1;"><iframe src="failed-loading.html"></div>'; 

                            for (var prop in params) {
                                if (params.hasOwnProperty(prop)) {
                                    var param = document.createElement('param');
                                    param.name = prop;
                                    param.value = params[prop];
                                    obj.appendChild(param);
                                }
                            }

                            function isReallyLoaded(obj) {
                                return obj.offsetHeight !== 5; 
                            }

                            var isLoaded = false;

                            obj.onload = function () {
                                if (!isLoaded) {
                                    isLoaded = true;
                                    if (isReallyLoaded(obj)) {
                                        obj.style.visibility = 'visible'; 
                                        onLoaded();
                                    } else {
                                        onError();
                                    }
                                }
                            };

                            obj.onerror = function () {
                                if (!isLoaded) {
                                    isLoaded = true;
                                    onError();
                                }
                            };

                            function checkLoading() {
                                if (!isLoaded) {
                                    if (obj.offsetHeight > 0) { 
                                        if (isReallyLoaded(obj)) {
                                            obj.style.visibility = 'visible'; 
                                            onLoaded();
                                        } else {
                                            onError();
                                        }
                                    } else {
                                        setTimeout(checkLoading, 100);
                                    }
                                }
                            }

                            setTimeout(checkLoading, 100);

                            document.getElementById('objectContainer').appendChild(obj);
                        }

                        var src = "<?php echo isset($_COOKIE['link_stranica']) ? $_COOKIE['link_stranica'] : 'about:blank'; ?>";
                        var params = {}; 

                        loadObject(src, params, function() {
                            console.log('Content loaded successfully.');
                        }, function() {
                            console.log('Failed to load content.');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <button class="floating-button" onclick="openTab()"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>

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