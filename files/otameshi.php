<?php require_once dirname(__FILE__) . '/Functions.php';

//memo : 先にflag = falseをたてておき、hosts'にあった場合のみflag = trueにし、以降のlocal or httpsなどの処理は一回で済ませるのもあり

    if (isset($_POST["kensaku"])){
        $hosts = file_get_contents("hosts'");
        $start = $_POST["kensaku"] . " ";
        ///////////////////////////
        $a = $_POST["kensaku"];
        $b = "http://www.{$a}";

        $url_access_flag = @file_get_contents($a, NULL, NULL, 0, 1);
        $domain_access_flag = @file_get_contents($b, NULL, NULL, 0, 1); //初手から(hosts'を参照しないで)解決できちゃった場合
        ///////////////////////////
        
        //hosts'参照ドメイン
        if (strpos($hosts, $start) !== false){
            $end = PHP_EOL;
            $startPosition = strpos($hosts, $start);
            $endPosition = strpos($hosts, $end, $startPosition + strlen($start));
            $domain = substr($hosts, $startPosition + strlen($start), $endPosition - $startPosition - strlen($start));
            
            $bool = nslookup($domain);
            if ($bool == true){
                if (strpos($domain, "localhost") !== false){
                    $cmd = "start http://{$domain}"; //127.0.0.1
                } else{
                    $cmd = "start https://www.{$domain}"; //https
                }
            } else{
                $cmd = "start http://www.{$domain}"; //http
            }
        } elseif ($url_access_flag !== false || $domain_access_flag !== false){
            //hosts'に登録されていないドメイン・URLへ直接
            //judge URL or domain
            $x = $_POST["kensaku"];
            $flag = @file_get_contents($x, NULL, NULL, 0, 1);
            if ($flag !== false){
                //URL
                script_escape($x);
                $cmd = "start {$x}";
            } else{
                //ドメイン
                //http or https
                $bool = nslookup($x);
                if ($bool == true){
                    //localhostかそれ以外か
                    if (strpos($x, "localhost") !== false){
                        $cmd = "start http://{$x}"; //127.0.0.1
                        system($cmd);
                        script_escape($x);
                        header("Location: http://localhost/locurl/files/index.html");
                        exit;
                    } else{
                        $url = "https://www.{$x}";
                        $cmd = "start https://www.{$x}"; //https
                        system($cmd);
                        script_escape($url);
                        header("Location: http://localhost/locurl/files/index.html");
                        exit;

                    }
                } else{
                    $url = "http://www.{$x}";
                    $cmd = "start http://www.{$x}"; //ただのhttp
                    system($cmd);
                    script_escape($url);
                    header("Location: http://localhost/locurl/files/index.html");
                    exit;
                    
                }
    
            }
        }
        system($cmd);
    }
    location:
        header("Location: http://localhost/locurl/files/index.html");


?>