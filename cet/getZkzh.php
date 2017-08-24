<?php

$name=urldecode($_GET['name']);
$id=urldecode($_GET['id']);
$type=urldecode($_GET['type']);
$params = "{\"ks_xm\":\"".$name."\",\"ks_sfz\":\"".$id."\",\"jb\":\"".$type."\"}";
$params = urlencode($params);

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "7066",
  CURLOPT_URL => "http://app.cet.edu.cn:7066/baas/app/setuser.do?method=UserVerify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "action=&params=".$params,
  CURLOPT_HTTPHEADER => array(
    "accept: */*",
    "accept-encoding: gzip, deflate",
    "accept-language: zh-CN,zh;q=0.8",
    "connection: keep-alive",
    "content-type: application/x-www-form-urlencoded; charset=utf-8",
    "cookie: JSESSIONID=76B41107736927661C117DA5FF2F1846",
    "host: app.cet.edu.cn:7066",
    "origin: http://app.cet.edu.cn:7066",
    "referer: http://app.cet.edu.cn:7066/baas/app/setuser.do?method=UserVerify",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>
