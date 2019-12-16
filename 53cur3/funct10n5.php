<?php
/*
*Core Functions
*/
if(!ob_start()){ob_start();}
if(!session_start()){session_start();}
date_default_timezone_set('America/Chicago');
$g_cmd = $g_honey = $g_email = $g_m_email = $g_s_email = $g_fname = $g_lname = $g_uphone = $g_password = $urank = $g_umin_price = $g_umax_price = $g_ubeds = $g_ubaths = $g_uaream = $g_ulot = '';
$cur = 'https://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
//$config = include( $config['secure'].'config.php');

/*POST Vars*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $g_cmd = post_input($_POST["cmd"]);
  $g_email = post_input($_POST["email-address"]);
  $g_honey = post_input($_POST["email"]);
  $g_fname = post_input($_POST["first-name"]);
  $g_lname = post_input($_POST["last-name"]);
  $g_uphone = post_input($_POST["phone"]);
  $g_urank = post_input($_POST["rank"]);
  $g_umin_price = post_input($_POST["min-price"]);
  $g_umax_price = post_input($_POST["max-price"]);
  $g_ubeds = post_input($_POST["beds"]);
  $g_ubaths = post_input($_POST["baths"]);
  $g_uarea = post_input($_POST["area"]);
  $g_ulot = post_input($_POST["lot"]);
  $g_password = post_input($_POST["password"]);
}

function post_input($post_data) {
  $post_data = trim($post_data);
  $post_data = stripslashes($post_data);
  $post_data = htmlspecialchars($post_data);
  return $post_data;
}

/*GET Vars*/
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $g_cmd = get_input($_GET["cmd"]);
}

function get_input($get_data) {
  $get_data = trim($get_data);
  $get_data = stripslashes($get_data);
  $get_data = htmlspecialchars($get_data);
  return $get_data;
}

/*Honey Pot*/
if($g_honey != ''){
  header('location: '.$config['domain'].'?err=cheat');
  die();
}
/*
if(($g_cmd != '')&&($g_cmd != sha1('<?php $config['domain']; ?>'))){
	header('location: <?php $config['domain']; ?>?err=cheat');
	die();
}
*/

/*
*Grab IP
*/
$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = $_SERVER['REMOTE_ADDR'];

if(filter_var($client, FILTER_VALIDATE_IP)){
  $ip = $client;
}
elseif(filter_var($forward, FILTER_VALIDATE_IP)){
  $ip = $forward;
}else{
  $ip = $remote;
}

/*UID*/
$date = date('ymdHis');
$micro = microtime();
$uid = sha1($date.$micro);

/*Detect Device Width*/
$device = $_SESSION['screen_width'];

/*User Agent String*/
$user_agent = $_SERVER['HTTP_USER_AGENT']; 

/*Detect Browser*/
function getUserAgent(){ if ( empty($agent) ) { $agent = $_SERVER['HTTP_USER_AGENT']; if ( stripos($agent, 'Firefox') !== false ) { $agent = 'firefox'; } elseif ( stripos($agent, 'MSIE') !== false ) { $agent = 'ie'; } elseif ( stripos($agent, 'Trident') !== false ) { $agent = 'ie'; } elseif ( stripos($agent, 'iPad') !== false ) { $agent = 'ipad'; } elseif ( stripos($agent, 'Android') !== false ) { $agent = 'android'; }  elseif ( stripos($agent, 'Googlebot') !== false ) { $agent = 'google'; } elseif ( stripos($agent, 'Bingbot') !== false ) { $agent = 'Bingbot'; } elseif ( stripos($agent, 'Chrome') !== false ) { $agent = 'chrome'; } elseif ( stripos($agent, 'Safari') !== false ) { $agent = 'safari'; } elseif ( stripos($agent, 'AIR') !== false ) { $agent = 'air'; } elseif ( stripos($agent, 'Fluid') !== false ) { $agent = 'fluid'; } else { $agent = 'unknown'; } } return $agent; } $browser = getUserAgent();

/*URI/HOST/URL/REFERRER*/
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];
$referrer = $_SERVER['HTTP_REFERER'];
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



?>
