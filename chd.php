<?php
$v = $_GET['v'] ?? '';
$ts = $_GET['ts'] ?? '';

if (!$ts) {
  # code...

$url = "https://zplayer001.com/bcric.php?v=".$v."&secure=saskakas&expires=545452333";
$headers = [
  "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
  "accept-language: en-US,en;q=0.9",
  "priority: u=0, i",
  "referer: https://cdn.crichdplays.ru/",
  "sec-ch-ua: \"Chromium\";v=\"134\", \"Not:A-Brand\";v=\"24\", \"Microsoft Edge\";v=\"134\"",
  "sec-ch-ua-mobile: ?0",
  "sec-ch-ua-platform: \"Windows\"",
  "sec-fetch-dest: iframe",
  "sec-fetch-mode: navigate",
  "sec-fetch-site: cross-site",
  "sec-fetch-storage-access: active",
  "sec-fetch-user: ?1",
  "upgrade-insecure-requests: 1",
  "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);

function lpcode($string1, $start1, $end1){
  $string1 = ' ' . $string1;
  $ini1 = strpos($string1, $start1);
  if ($ini1 == 0) return '';
  $ini1 += strlen($start1);
  $len1 = strpos($string1, $end1, $ini1) - $ini1;
  return substr($string1, $ini1, $len1);
   }
// $start1='return([';
// $end1='].join("")';
$start1 = "source: '";
$end1 = "'";
$text=lpcode($response,$start1,$end1);
// $text = str_replace(['"', ',', '\\'], '', $text);
// $text=str_replace('https:////','https://',$text);

// echo $text;

//lp code
function lpcode1($string1, $start1, $end1){
  $string1 = ' ' . $string1;
  $ini1 = strpos($string1, $start1);
  if ($ini1 == 0) return '';
  $ini1 += strlen($start1);
  $len1 = strpos($string1, $end1, $ini1) - $ini1;
  return substr($string1, $ini1, $len1);
   }
   $start1='https://';
   $end1=$v.".m3u8";
  // $end1 = "super2cric.m3u8";
   $oglink=lpcode1($text,$start1,$end1);

$save='https://'.$oglink;

// echo $save;


$curl1 = curl_init($text);
curl_setopt($curl1, CURLOPT_URL, $text);
curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);

$headers1 = array(
   "Referer: https://zplayer001.com/",
);
curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers1);
//for debug only!
curl_setopt($curl1, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl1, CURLOPT_SSL_VERIFYPEER, false);

$resp1 = curl_exec($curl1);
curl_close($curl1);

//hls setup and hls//
$cc= "?=".$v;
$elink = $save;
$opts = array(
  'http'=>array(
    'method'=>"GET",
    
  )
);
$context = stream_context_create($opts);
$f = preg_replace("/(?<=ts).*/", "", $resp1);
$g = preg_replace("/(".$cc.").*ts/", $elink."$0", $f);
$g = preg_replace("/(".$cc.").*ts/", "chd.php?ts=".$elink."$0", $f);


echo $g.PHP_EOL;
} else {
  $url = $ts;
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Referer: https://zplayer001.com/"
            )
        );
        $context = stream_context_create($opts);
        $e = file_get_contents($url, false, $context);
        if ($e === false) {
            throw new Exception("Failed to fetch .ts segment from: $url");
        }
        echo $e;
}
