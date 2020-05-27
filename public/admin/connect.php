 <?php

 include('../../env.php');

 if(env('APP_DEBUG')) {
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
 } else {
     ini_set('display_errors', 'off');
 }

ini_set("allow_url_fopen","off");
ini_set("allow_url_include","off");
ini_set("log_errors","on");
ini_set("expose_php","off");
ini_set("sessionuse_only_cookies","1");

ini_set("session.use_trans_sid","0");
ini_set("session.use_strict_mode","0");

ini_set("session.cookie_httponly","1");
ini_set("session.cookie_domain","");
ini_set("session.cookie_secure","1");



$a = session_id();
if(empty($a)) session_start();
 $mysession=session_id();

 $mycookier=$_COOKIE["PHPSESSID"];
// Create connection
 $conn = mysqli_connect(env('DB_HOST', 'localhost'),env('DB_USERNAME', 'root'),env('DB_PASSWORD', ''),env('DB_DATABASE', 'webinar'), env('DB_PORT', '3360'));

 // Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sdate=date('Y-m-d');
$stime=date('H:i:s');

    $ip = $_SERVER['REMOTE_ADDR'];
   $string=exec('getmac');
$mac=substr($string, 0, 17); 

 
function ip_visitor_country()
{ 

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $country  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data);

    if($ip_data && $ip_data['geoplugin_countryName'] != null) {
        $country = $ip_data['geoplugin_countryName'];
    }

    return $country;
}

 $mycountry=ip_visitor_country();
 
 
 
 function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }

include("systeminfo.php");
date_default_timezone_set('Africa/Lagos'); 

$smsurl="http://ngnr.connectbind.com/bulksms/bulksms?"; 

$smsurl1="http://ngnr.connectbind.com/bulksms/bulksms"; 


$mydate=date('Y-m-d');
$mytime=date('Y-m-d H:i:s');

$sql="select * from oc_profile";
$result_oc_profile=mysqli_query($conn,$sql); 
while($rows=mysqli_fetch_array($result_oc_profile)) {extract($rows); }

?> 
