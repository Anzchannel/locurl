<?php
    copy("C:/Windows/System32/drivers/etc/hosts", "C:/xampp/htdocs/locurl/files/hosts");


    if (isset($_POST["ad_cancel"])){
        $ad_cancel = htmlspecialchars($_POST["ad_cancel"], ENT_QUOTES, "UTF-8");
        $ad_dm_ip = "200.3.12.1 {$ad_cancel}";
        $to = "";
        $f_pass = "C:/xampp/htdocs/locurl/files/hosts";
        $hosts = file_get_contents($f_pass);
        if (strpos($hosts, $ad_dm_ip) !== false){
            $hosts = str_replace($ad_dm_ip, $to, $hosts);
            file_put_contents($f_pass, $hosts);
            exec("cmd.exe /c/xampp/htdocs/locurl/bat/admin.bat");
        }
    }
    header("Location: http://localhost/locurl/files/index.html");




    // if (isset($_POST["ad_cancel"])){
    //     $ad_cancel = htmlspecialchars($_POST["ad_cancel"], ENT_QUOTES, "UTF-8");
    //     $ad_dm_ip = "200.3.12.1 {$ad_cancel}";
    //     $f_pass = "C:/xampp/htdocs/curl/hosts";
    //     $f_handle = fopen($f_pass, "w");
    //     if (strpos($f_handle ,$ad_dm_ip) == true){
    //         echo "true";
    //         // $hosts = str_replace($ad_dm_ip, "", $hosts);
    //         // file_put_contents($hosts, $hosts_pass);
    //     }
    // }



?>