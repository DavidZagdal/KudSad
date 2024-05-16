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
            require '../toolbar/whatToolbarToUse.php';
            echo whatToolbarToUse();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <?php
        
        if (isset($_GET['wrong'])) {
            
            if ($_GET['wrong'] == 'True') {
                echo '<script>
                  alert("Korisnik vec postoji ili se desila greska.");
                </script>';
            }
        }
    ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Registrirajte se</h5>
                    <p class="card-text text-center"></p>
                    <form action="register-to-database.php" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Ime i prezime</label>
                            <input type="name" class="form-control" id="fullName" name="fullName" placeholder="npr. Ivan Horvat" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Adresa</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="npr. ihorvat@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Lozinka</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Unesite lozinku" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">Potvrdite Lozinku</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Ponovno unesite lozinku" required>
                            <div id="passwordError" style="color: red;"></div>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                    <script>
                        function validateForm() {
                            var password = document.getElementById("password").value;
                            var confirmPassword = document.getElementById("confirmPassword").value;
                            var passwordError = document.getElementById("passwordError");


                            if (password != confirmPassword) {
                                passwordError.innerText = "Lozinke se ne podudaraju";
                                return false;
                            } else {
                                passwordError.innerText = ""; 
                                return true;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
