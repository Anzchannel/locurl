<?php
    copy("C:/Windows/System32/drivers/etc/hosts", "C:/xampp/htdocs/locurl/files/hosts");
    $Arecord = PHP_EOL . <<<__LONG_STRRING__
    200.3.12.1 pagead2.googlesyndication.com
    200.3.12.1 tpc.googlesyndication.com
    200.3.12.1 googleadservices.com
    200.3.12.1 w3.org
    200.3.12.1 ads.google.com
    200.3.12.1 googleads.g.doubleclick.net
    __LONG_STRRING__;

    $f_pass = "C:/xampp/htdocs/locurl/files/hosts";
    $f_handle = fopen($f_pass, "a");
    fputs($f_handle, $Arecord);
    fclose($f_handle);
    exec("cmd.exe /c/xampp/htdocs/locurl/bat/admin.bat");
    
    header("Location: http://localhost/locurl/files/index.html");
?>