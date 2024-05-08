<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KudSad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <link rel="icon" type="../image/png" href="../images/favicon-32x32.png">
    <style>
        .form-control::placeholder { 
            color: white;
            opacity: 0.3;
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrirajte se</h5>
                    <p class="card-text text-center"></p>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Ime i prezime</label>
                            <input type="name" class="form-control" id="fullName" placeholder="npr. Ivan Horvat" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Adresa</label>
                            <input type="email" class="form-control" id="email" placeholder="npr. ihorvat@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Lozinka</label>
                            <input type="password" class="form-control" id="password" placeholder="Unesite lozinku" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">Potvrdite Lozinku</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Ponovno unesite lozinku" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
