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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">FAQ - placeholder</h5>
                        <p class="card-text text-center">placeholder</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
