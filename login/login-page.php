<!DOCTYPE html>
<html lang="hr">
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


        <?php
        
            if (isset($_GET['wrong'])) {
                
                if ($_GET['wrong'] == 'True') {
                    echo '<script>
                      alert("Nije pronaden korisnik ili su uneseni krivi podatci.");
                    </script>';
                }
            }
        ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Dobrodošli</h5>
                    <p class="card-text text-center">Molimo unesite svoj email i lozinku:</p>
                    <form action="login-temp.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email adresa:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Lozinka:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Prijavi se</button>
                        </div>
                        <div class="d-grid mt-3" style="text-align: right;">
                            <p>Nemate račun? <a href="register.php" style="color:#28a745"> Registrirajte se ovdje.</a></p>
                            
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
