<?php
    copy("C:/Windows/System32/drivers/etc/hosts", "C:/xampp/htdocs/locurl/files/hosts");

    if (isset($_POST["ad_domain"])){
        $ad_domain = htmlspecialchars($_POST["ad_domain"], ENT_QUOTES, "UTF-8");
        $Arecord = PHP_EOL . "200.3.12.1" . " " . $ad_domain;
        $f_pass = "C:/xampp/htdocs/locurl/files/hosts";
        $hosts_ = file_get_contents($f_pass);
        if (strpos($hosts_, $Arecord) == false){
            $f_handle = fopen($f_pass, "a");
            fputs($f_handle, $Arecord);
        }

        fclose($f_handle);
        // system("taskkill /im \"chrome.exe\" /f");
        exec("cmd.exe /c/xampp/htdocs/locurl/bat/admin.bat");
    }
    
    header("Location: http://localhost/locurl/files/index.html");
?>