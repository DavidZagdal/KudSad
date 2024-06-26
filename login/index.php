<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KudSad</title>
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../main-css-for-pages.css">
        <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
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
                        <div class="card-body" >
                            <h5 class="card-title text-center">Dobrodošli</h5>
                            <p class="card-text text-center">Molimo prijavite se:</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button" onclick="window.location.href='login-page.php'">Prijava / Registracija</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Kratki opis</h5>
                            <p class="card-text text-center">KudSad?<br>Ova aplikacija je upravo za one koji imaju ovo pitanje. <br>Došli ste na pravo mjesto.<br>Nadamo se da će Vam olakšati to pitanje uz našu aplikaciju.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5"></div>


    </body>
</html>