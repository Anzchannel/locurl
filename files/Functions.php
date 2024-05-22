<?php
/**
 * ドメインを名前解決できるか判定する関数
 */
function nslookup($domain_arg){
    $a = gethostbyname($domain_arg);
    if ($a !== $domain_arg){
        return true; //https or localhost(DNS成功)
    } else{
        return false; //http or other(DNS失敗)
    }
}


/**
 * <script>タグからドメインを抽出し、それを~etc/hostsに書き込む関数
 */
function script_escape($url){
    $html = file_get_contents($url);

    //script抽出
    preg_match_all('|<script(.*?)></script>|', $html, $match);
    $text = "";
    foreach ($match[0] as $m){
        $text .= $m . PHP_EOL;
    }
    //https://抽出
    preg_match_all("/https?:\/\/([^\/]+)/i", $text, $match2);
    $texts = array();
    foreach ($match2[0] as $m2){
        $texts[] = $m2;
    }
    //unique
    $domains = array_unique($texts);

    //add「200.3.12.1 」 del https:// 
    $Arecord = "";
    foreach ($domains as $d){
        //delete http || https && www.
        $domain = preg_replace("/(https?:\/\/)?(www\.)?/", "", $d);
        //add 200.3.12.1
        $Arecord .= "200.3.12.1" . " " . $domain . PHP_EOL;
    }
    $Arecord = PHP_EOL . $Arecord;
    
    //そのドメインは登録しない
    $a = parse_url($url);
    $pat = "200.3.12.1 " . $a["host"];
    $Arecord = str_replace($pat, "", $Arecord);
    
    $Arecord = PHP_EOL . "#{$url}" . $Arecord;
    

    //to hosts
    copy("C:/Windows/System32/drivers/etc/hosts", "C:/xampp/htdocs/locurl/files/hosts");

    $f_pass = "C:/xampp/htdocs/locurl/files/hosts";
    $hosts_ = file_get_contents($f_pass);
    $f_handle = fopen($f_pass, "a");
    if (strpos($hosts_, $Arecord) == false){
        $f_handle = fopen($f_pass, "a");
        fputs($f_handle, $Arecord);
    }

    fclose($f_handle);
    exec("cmd.exe /c/xampp/htdocs/locurl/bat/admin.bat");

}
    


?>