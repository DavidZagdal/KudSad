<?php 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main-css-for-pages.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        iframe {
            width: 100%;
            height: 80%;
            border: none; 
            overflow: auto;
        }

        ::placeholder {
            color: white;
            opacity: 1; 
        }

        ::-ms-input-placeholder { 
            color: white;
        }

        
    </style>
</head>
<body>

    <div id="toolbarContainer">
    </div> 
    <script>
            document.addEventListener("DOMContentLoaded", function () {
                var toolbarContainer = document.getElementById("toolbarContainer");
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        toolbarContainer.innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "../toolbar/toolbar.html", true);
                xhttp.send();
            });
        </script>



        <iframe id="embeddedFrame" src="https://www.postani-student.hr/Ucilista/Nositelji.aspx" ></iframe>

       
            <footer>
            <div class="card">
                <div class="card-body container-fluid">
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="d-flex mb-3">
                                <input type="text" class="form-control flex-grow-1" placeholder="Naziv fakulteta"  style="color: white;">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <div class="d-flex mb-3">
                                <input type="text" class="form-control flex-grow-1" placeholder="Smjer na fakultetu"  style="color: white;">
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-outline-primary ms-2">Odaberi</button>
                        </div>
                        
                    </div>
                
            </div>
        </footer>

    
</body>

</html>
