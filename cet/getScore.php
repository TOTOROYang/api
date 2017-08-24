<?php
include_once('lib/simple_html_dom.php'); 

$name = urldecode($_GET['name']);
$zkzh = urldecode($_GET['zkzh']);

$ip=rand(0,254).'.'.rand(0,254).'.'.rand(0,254).'.'.rand(0,254);
$params = "zkzh=".$zkzh."&xm=".urlencode($name);
$curl=curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://www.chsi.com.cn/cet/query?".$params,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "referer: http://www.chsi.com.cn/cet/",
    "user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.75 Safari/537.36",
    "x-forwarded-for: ".$ip
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	//echo $response;
	$html = str_get_html($response);
	//echo $html->find('div')[10]->innertext();
	$date = trim($html->find('div')[10]->getElementsByTagName('h2')[0]->innertext());
	$name = trim($html->find('div')[10]->getElementsByTagName('td')[0]->innertext());
	$school = trim($html->find('div')[10]->getElementsByTagName('td')[1]->innertext());
	$type = trim($html->find('div')[10]->getElementsByTagName('td')[2]->innertext());
	$zkzh = trim($html->find('div')[10]->getElementsByTagName('td')[3]->innertext());
	$totalScore = trim($html->find('div')[10]->getElementsByTagName('td')[4]->getElementsByTagName('span')[0]->innertext());
	$score1 = trim($html->find('div')[10]->getElementsByTagName('td')[6]->innertext());
	$score2 = trim($html->find('div')[10]->getElementsByTagName('td')[8]->innertext());
	$score3 = trim($html->find('div')[10]->getElementsByTagName('td')[10]->innertext());
	
	$smg = "{"."\"date\":\"".$date."\",".
			   "\"name\":\"".$name."\",".
			   "\"school\":\"".$school."\",".
			   "\"type\":\"".$type."\",".
			   "\"zkzh\":\"".$zkzh."\",".
			   "\"totalScore\":\"".$totalScore."\",".
			   "\"score1\":\"".$score1."\",".
			   "\"score2\":\"".$score2."\",".
			   "\"score3\":\"".$score3."\"".
		   "}";
	echo $smg;
}
