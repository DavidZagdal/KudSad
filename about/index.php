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
    </style>
</head>
<body>
    <!-- Objasnjenje u homepage.php -->
    <div id="toolbarContainer">
        <?php
            if(isset($_COOKIE['logininfo'])){
                $toolbar_content = file_get_contents("../toolbar/toolbarLoggedIn.html");
                echo $toolbar_content;
            } else {
                $toolbar_content = file_get_contents("../toolbar/toolbar.html");
                echo $toolbar_content;
            }
        ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Kratki opis</h2>
                        <p class="card-text text-center">KudSad?<br>Ova aplikacija je upravo za one koji imaju ovo pitanje. <br>Došli ste na pravo mjesto.<br>Nadamo se da će Vam olakšati to pitanje uz našu aplikaciju.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Naš tim - Skibidi Piggies</h3>
                        <p class="card-text text-center">Sastojimo se od 3 nadarena člana:<br></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="nolink" data-bs-toggle="collapse" data-bs-target="#simunDetails">
                            <h5 class="card-title text-center">Šimun Polimanac <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center pb-3">Marketing & Business Specialist</p>
                        </a>
                        <div class="collapse details-card" id="simunDetails">
                            <div class="card card-body border-success">
                                <p class="card-text text-center">Student Tehničkog veleučilišta Zagreb <br> Prijediplomski računarstvo<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="nolink" data-bs-toggle="collapse" data-bs-target="#aldoDetails">
                            <h5 class="card-title text-center">Aldo Šarunić <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center pb-3">Data Analyst</p>
                        </a>
                        <div class="collapse details-card" id="aldoDetails">
                            <div class="card card-body border-success">
                                <p class="card-text text-center">Student Tehničkog veleučilišta Zagreb <br> Elektroničko poslovanje<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="nolink " data-bs-toggle="collapse" data-bs-target="#davidDetails">
                            <h5 class="card-title text-center">David Gulić <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center pb-3">Full-Stack developer</p>
                        </a>
                        <div class="collapse details-card" id="davidDetails">
                            <div class="card card-body border-success">
                                <p class="card-text text-center">Student Tehničkog veleučilišta Zagreb <br> Prijediplomski računarstvo<br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
