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
        .nolink{
            text-decoration: none;
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
            transition: border 0.3s ease;
            border: 1px solid transparent; 
        }

        .hover-custom:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 1);
            border: 1px solid rgba(40, 167, 69, 1); 
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-success">
                    <div class="card-body">
                        <h3 class="card-title text-center">Policies</h3>
                        <p class="card-text text-center text-white-50">Ovdje se nalaze basic policies za stranicu.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card hover-custom">
                    <div class="card-body">
                        <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#privacyPolicy">
                            <h5 class="card-title text-center">Privacy policy <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                        </a> 
                        <div class="collapse details-card" id="privacyPolicy">
                            <iframe src="privacy-policy.html" style="width: 100%; height: 45vh;" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <div class="container mb-5">

            <div class="col-md-12 mt-3">
                <div class="card hover-custom">
                    <div class="card-body">
                        <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#cookiePolicy">
                            <h5 class="card-title text-center">Cookie policy <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                        </a> 
                        <div class="collapse details-card" id="cookiePolicy">
                            <iframe src="cookie-policy.html" style="width: 100%; height: 45vh;" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
