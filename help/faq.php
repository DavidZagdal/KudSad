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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body ">
                        <h3 class="card-title text-center">FAQ</h3>
                        <p class="card-text text-center text-white-50">Pozdrav, ako ste zbunjeni kako koristiti stranicu ovdje se nalaze svi odgovori.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#prvi">
                            <h5 class="card-title text-center">1. Čemu služi ova stranica? <i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                        </a> 
                        <div class="collapse details-card" id="prvi">
                            <p class="text-center">Ova stranica je napravljena za studente I učenike koji će sada postati studenti. Stranica služi kako bi mogli vidjeti poslovi koje se nude za Vaša zanimanja, te prosječnu plaću za ta zanimanja i poslove.</p>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <div class="container mb-5">

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#drugi">
                            <h5 class="card-title text-center">2. Gdje je gumb za registraciju?<i class="fa-solid fa-caret-down"></i></h5>
                            <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                        </a> 
                        <div class="collapse details-card" id="drugi">
                            <p class="text-center">Za našu stranicu se ne morate registrirati, već samo unesite svoje podatke od svoga faksa ili srednje škole. Prijava se vrši preko AAIEdu sustava.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">

        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#treci">
                        <h5 class="card-title text-center">3. Prijavio sam se što sada?<i class="fa-solid fa-caret-down"></i></h5>
                        <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                    </a> 
                    <div class="collapse details-card" id="treci">
                        <p class="text-center">Sada stisnete na Fakultet I odaberete fakultet koji Vas zanima ili u kojem ste trenutno. Kada ste odabrali kliknite na karticu I stisnite SPREMI.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#cetvrti">
                    <h5 class="card-title text-center">4. Što ako se želimo prebaciti s jednog smjera na drugi smjer?<i class="fa-solid fa-caret-down"></i></h5>
                    <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                </a> 
                <div class="collapse details-card" id="cetvrti">
                    <p class="text-center">Za to postoji opcija Prebacivanje smjerova, koju kad kliknete se nude svi smjerovi na koji se možete prebaciti s svojim trenutnim smjerom.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#peti">
                    <h5 class="card-title text-center">5. Zanima me koji posao mogu imati s stečenim zanimanjem?<i class="fa-solid fa-caret-down"></i></h5>
                    <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                </a> 
                <div class="collapse details-card" id="peti">
                    <p class="text-center">Na kartici Posao možete naći sve trenutne ponude I ponude fakulteta za Vaše zanimanje.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mb-5">

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#sesti">
                    <h5 class="card-title text-center">6. Kako da brzo vidim stranicu svog fakulteta?<i class="fa-solid fa-caret-down"></i></h5>
                    <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                </a> 
                <div class="collapse details-card" id="sesti">
                    <p class="text-center">Nakon što ste izabrali fakultet, stisnite na karticu Home, gdje će Vam biti prikazana stranica Vašeg traženog fakulteta.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mb-5">

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#sedmi">
                    <h5 class="card-title text-center">7. Zanima Vas tko smo mi I zašto ovo radimo?<i class="fa-solid fa-caret-down"></i></h5>
                    <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                </a> 
                <div class="collapse details-card" id="sedmi">
                    <p class="text-center">Sve informacije možete pronaći na kartici About.</p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mb-5">

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <a href="" style="text-decoration: none;" data-bs-toggle="collapse" data-bs-target="#osmi">
                    <h5 class="card-title text-center">8. Zanima Vas koje podatke skupljamo?<i class="fa-solid fa-caret-down"></i></h5>
                    <p class="card-text text-center text-white-50">Pritisnite za više detalja.</p>
                </a> 
                <div class="collapse details-card" id="osmi">
                    <p class="text-center">Sve informacije možete pronaći na kartici Policies.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mb-5">
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h5 class="card-title text-center">9. Niste pronašli odgovor na svoje pitanje?</h5>
                    <p class="card-text text-center text-white-50">Postavite ga ovdje!</p>
                </div> 
                <div class="details-card">
                    <form action="saveQuestionToDatabase.php" method="POST">
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email adresa</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Ime</label>
                            <input type="text" class="form-control" id="inputName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputMessage" class="form-label">Poruka</label>
                            <textarea class="form-control" id="inputMessage" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pošalji</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
        
    if (isset($_GET['success'])) {
        
        if ($_GET['success'] == 'True') {
            echo '<script>
                alert("Uspješno poslana poruka!");
            </script>';
        }
    }

    if (isset($_GET['error'])) {
        
        if ($_GET['error'] == 'True') {
            echo '<script>
                alert("Negdje se dogodila pogreška! Pokušajte ponovno kasnije.");
            </script>';
        }
    }
?>

</body>
</html>