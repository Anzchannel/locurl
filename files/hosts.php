<?php
    if(isset($_POST["domain"]) && $_POST["ninidomain"]){
        $_POST["domain"] = htmlspecialchars($_POST["domain"], ENT_QUOTES, "UTF-8");
        $_POST["ninidomain"] = htmlspecialchars($_POST["ninidomain"], ENT_QUOTES, "UTF-8");
        $Arecord = $_POST["ninidomain"]. " ". $_POST["domain"] . PHP_EOL;
        $f_pass = "C:/xampp/htdocs/locurl/files/hosts'";
        $f_handle = fopen($f_pass, "a");
        fputs($f_handle, $Arecord);
        fclose($f_handle);
    }
    
    //if ($_SERVER["HTTP_REFERER"] !== "http://localhost/curl/index.php") {
        header("Location: http://localhost/locurl/files/index.html");
    //     exit;
    // }
?>