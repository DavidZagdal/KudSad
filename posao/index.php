<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['servername'])) {
    header("Location: ../setglbvar/setvardtb.php");
    exit();
}
require '../scraper/scrape-functions.php';
require '../find-keyword/find-keyword.php';
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

        .p-not {
            color: #FFFFFF;
            font-size: 1rem;
            line-height: 1;
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

        #loading-tab3 {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #28a745;
        }

        .spinner-border {
            margin-left: 10px;
        }

        #tab3-content {
            display: none;
        }

        #loading-tab4 {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #28a745;
        }

        #tab4-content {
            display: none;
        }
    </style>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadTab3Content();
            loadTab4Content();
        });
    </script>

    <div id="toolbarContainer">
        <?php
            require '../toolbar/whatToolbarToUse.php';
            echo whatToolbarToUse();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="d-flex flex-column vh-100">
        <div class="container">
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
                            <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4" aria-selected="false">Za Vas</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabsContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <div class="container if-cont overflow-hidden vh-custom">
                                <div id="objectContainer" style="height: 100%; width: 100%;">
                                </div>
                            </div>

                        <script>
                            function loadObject(src, params, onLoaded, onError) {
                                var objContainer = document.getElementById('objectContainer');
                                var obj = document.createElement('object');
                                obj.style.display = 'block';
                                obj.style.visibility = 'hidden'; 
                                obj.style.width = '100%';
                                obj.style.height = '100%';
                                obj.data = src;

                                obj.innerHTML = '<div class="vh-custom" style="height: 100%; width: 100%; display: flex; justify-content: center; align-items: center;"><iframe src="failed-loading.html" style="flex-grow: 1; border: none;"></iframe></div>';

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

                                objContainer.innerHTML = ''; 
                                objContainer.appendChild(obj);
                            }

                            var src = "<?php echo isset($_COOKIE['link_posao']) ? $_COOKIE['link_posao'] : 'about:blank'; ?>";
                            var params = {}; 

                            loadObject(src, params, function() {
                                console.log('Content loaded successfully.');
                            }, function() {
                                console.log('Failed to load content.');
                            });


                            var src = "<?php echo isset($_COOKIE['link_posao']) ? $_COOKIE['link_posao'] : 'about:blank'; ?>";
                            var params = {}; 

                            loadObject(src, params, function() {
                                console.log('Content loaded successfully.');
                            }, function() {
                                console.log('Failed to load content.');
                            });
                        </script>
                    </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="container if-cont">
                                <?php
                                if (!isset($_COOKIE["no-jobs"])) {
                                    $imePosla = getImeTipaPosla($_COOKIE['id_smjera']);
                                    if ($imePosla != '') {
                                        $allJob = scrapeAndStoreDataMojPosao($imePosla); //ovdje kada se odabvere faks u cookie staviti kao "pretraga"
                                        foreach ($allJob as $job) {
                                            echo $job;
                                        }
                                        $allJob = [];
                                    } else {
                                        echo '<div class="container text-center">
                                            <p>Za ovaj smjer nema kompetitivnih poslova</p>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="container text-center">
                                        <p>Za ovaj smjer nema kompetitivnih poslova</p>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                            <div class="container if-cont">
                                <div id="loading-tab3">
                                    Učitavanje, molimo sačekajte par sekundi.
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div id="tab3-content"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                            <div class="container if-cont">
                                <div id="loading-tab4">
                                    Učitavanje, molimo sačekajte par sekundi.
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div id="tab4-content"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                            <div class="container text-center">
                                <p>Partneri još nisu postavili posao za Vaš smjer!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tab3ContentLoaded = false;
        let tab3Content = '';

        let tab4ContentLoaded = false;
        let tab4Content = '';

        function loadTab3Content() {
            if (!tab3ContentLoaded) {
                document.getElementById('loading-tab3').style.display = 'flex';
                document.getElementById('tab3-content').style.display = 'none';
                
                setTimeout(function() {
                    fetchTab3Content();
                }, 0);
            } else {
                document.getElementById('tab3-content').style.display = 'block';
            }
        }

        function fetchTab3Content() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_tab3_content.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tab3Content = xhr.responseText;
                    document.getElementById('tab3-content').innerHTML = tab3Content;
                    document.getElementById('loading-tab3').style.display = 'none';
                    document.getElementById('tab3-content').style.display = 'block';
                    
                    const links = document.querySelectorAll('a:not(.not-external)');
                    links.forEach(function(link) {
                        link.setAttribute('target', '_blank');
                    });
                    tab3ContentLoaded = true;
                }
            };
            xhr.send('id_smjera=' + encodeURIComponent(getCookie('id_smjera')));
        }

        function loadTab4Content() {
            if (!tab4ContentLoaded) {
                document.getElementById('loading-tab4').style.display = 'flex';
                document.getElementById('tab4-content').style.display = 'none';
                
                setTimeout(function() {
                    fetchTab4Content();
                }, 0);
            } else {
                document.getElementById('tab4-content').style.display = 'block';
            }
        }

        function fetchTab4Content() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_tab4_content.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tab4Content = xhr.responseText;
                    document.getElementById('tab4-content').innerHTML = tab4Content;
                    document.getElementById('loading-tab4').style.display = 'none';
                    document.getElementById('tab4-content').style.display = 'block';
                    
                    tab4ContentLoaded = true;
                }
            };

            var formData = new FormData();
            formData.append('id_smjera', getCookie('id_smjera'));

            xhr.send(formData);
        }

        function getCookie(name) {
            let cookieArr = document.cookie.split(";");
            for (let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");
                if (name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        function openTab(link) {
            window.open(link, '_blank');
        }
        
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a');
            links.forEach(function(link) {
                link.setAttribute('target', '');
            });

            links = document.querySelectorAll('a:not(.not-external)');
            links.forEach(function(link) {
                link.setAttribute('target', '_blank');
            });
        });
    </script>
</body>
</html>
