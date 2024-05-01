<?php 
    

    session_start();

    if(isset($_SESSION['servername'])){
        header("Location: ../login");
    }else{

    //site
    /*
    $_SESSION['servername'] = '10.30.72.173';
    $_SESSION['username'] = 'phpuserkudsad';
    $_SESSION['password'] = 'PHPusing1!';
    $_SESSION['database'] = 'fakulteti';
    */


    //lokalno
    
    $_SESSION['servername'] = 'localhost';
    $_SESSION['username'] = 'root';
    $_SESSION['password'] = '';
    $_SESSION['database'] = 'fakulteti';

    }

    
    
    
    header("Location: ../homepage/");
?>