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
        //~etc/hostsに紐づけられているドメインだった場合
        copy("C:/Windows/System32/drivers/etc/hosts", "C:/xampp/htdocs/locurl/files/hosts");
        $etc_hosts = file_get_contents("C:/xampp/htdocs/locurl/files/hosts");
        $pattern = "/200\.3\.12\.1\s+{$a}\s*$/m" . PHP_EOL;
        if (preg_match($pattern, $etc_hosts) === 1){
            $cmd = "start http://localhost/locurl/files/error.html";
        }
        //hosts'参照ドメイン
        elseif (strpos($hosts, $start) !== false){
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
                $cmd = "start {$x}";
            } else{
                //ドメイン
                //http or https
                $bool =nslookup($x);
                if ($bool == true){
                    //localhostかそれ以外か
                    if (strpos($x, "localhost") !== false){
                        $cmd = "start http://{$x}"; //127.0.0.1
                    } else{
                        $cmd = "start https://www.{$x}"; //https
                    }
                } else{
                    $cmd = "start http://www.{$x}"; //ただのhttp
                }
    
            }
        } else{
            $tujokensaku = $_POST["kensaku"];
            $cmd = "rundll32 url.dll,FileProtocolHandler \"https://google.co.jp/search?q={$tujokensaku}\"";
        }
        system($cmd);
        location:
        header("Location: http://localhost/locurl/files/index.html");
    }


?>