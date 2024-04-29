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

        
        

        <div class="container mt-5 mb-5">
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

        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Naš tim - Skibidi Piggies</h5>
                            <p class="card-text text-center">Sastojimo se od 3 nadarena člana:<br></p>
                    </div>
                </div>
                    
               
            </div>
        </div>


        <div class="mb-5">
            <div class="row justify-content-center">
                
            <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Šimun Polimanac</h5>
                            <p class="card-text text-center">Marketing & Business<br></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5 col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Aldo Šarunić</h5>
                            <p class="card-text text-center">kako<br></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">David Gulić</h5>
                            <p class="card-text text-center">cega<br></p>
                    </div>
                </div>
            </div>

        </div>


    </body>
</html>