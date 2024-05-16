<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KudSad</title>
    <script src="https://kit.fontawesome.com/90b9bb8c8d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <style>
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
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">LOGS</h3>
                        <button id="toggleOrder" class="btn btn-primary">
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5" id="logsContainer">
        <?php
        $logFilePath = '../errors/errors.txt';

        $logs = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $counter = 1;

        foreach ($logs as $log) {
            preg_match('/\[(.*?)\] file: (.*?). Error: (.*?)(?=\.\s|$)/', $log, $matches);
            $timestamp = $matches[1];
            $where = $matches[2];
            $what = $matches[3];
            $details = substr($log, strpos($log, $matches[3]) + strlen($matches[3]) + 1);
        ?>
            <div class="col-md-12 mt-3 log-entry">
                <div class="card hover-custom">
                    <div class="card-body">
                        <a href="#collapse<?= $counter ?>" style="text-decoration: none;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse<?= $counter ?>">
                            <h6 class="card-title text-center"><?= htmlspecialchars($timestamp) ?></h6>
                            <h5 class="card-title text-center"><?= htmlspecialchars($what) ?></h5>
                            <h6 class="card-title text-center text-white-50"><?= htmlspecialchars($where) ?></h6>
                        </a>
                    </div>
                </div>
            </div>
        <?php
            $counter++;
        }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleOrder');
            const logsContainer = document.getElementById('logsContainer');
            let logs = Array.from(logsContainer.getElementsByClassName('log-entry'));
            
            function toggleOrder() {
                logs.reverse();
                logs.forEach(log => logsContainer.appendChild(log));
            }

            toggleButton.addEventListener('click', toggleOrder);
        });
    </script>
</body>
</html>
