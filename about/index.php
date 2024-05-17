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
                <div class="card hover-custom">
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
                <div class="card hover-custom">
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
                <div class="card hover-custom">
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
