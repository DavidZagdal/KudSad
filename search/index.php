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
         .scrolling-container {
            overflow-y: auto;
            max-height: 400px; 
        }
        .card {
            margin-bottom: 10px; 
        }
        .card-text{
            font-size: 10px;
        }

        .card-border{
            border: 3px #28a745 solid;
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


    <div class="container mt-5">
        <div class="scrolling-container">
            <div class="card card-border">
                <img src="https://via.placeholder.com/300x100/353535/FFF?text=Partner+slika+1" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Partner Posao 1</h5>
                    <p class="card-text">-Deskripcija posla.</p>
                </div>
            </div>
            
            <div class="card">
                <img src="https://via.placeholder.com/300x100/353535/FFF?text=Posao+slika+2" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Posao 2</h5>
                    <p class="card-text">Deskripcija posla.</p>
                </div>
            </div>

            <div class="card">
                <img src="https://via.placeholder.com/300x100/353535/FFF?text=Posao+slika+3" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Posao 3</h5>
                    <p class="card-text">Deskripcija posla.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>