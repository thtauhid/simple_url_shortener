<?php 
//Getting the config file
require_once('config.php');

//get url
if (isset($_POST['url']) and !empty($_POST['url'])) {

	$url	=	$_POST['url'];


//string generator
function string($len = 5){
  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
  }
  return substr($result, -5);
}

//get the string
$thestring	=	string();

//time now
$time	=	date("d/m/Y");

//check for duplicate string
$check_query	=	"";

//insert data into database
$query	=	"INSERT INTO data (url, string, time) VALUES ('{$url}', '{$thestring}', '{$time}')";

mysqli_query($dbconnect, $query) or die('Something happened!');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Shorten URL</title>
</head>
<body>
	<div style="text-align: center;">
		<form style="padding-top: 10%;" method="post" action="index.php">
		<h1>URL Shortener</h1>
			<input type="url" name="url" placeholder="Enter URL to Shrink" style="width: 250px;  padding: 25px; " required="required">
			<button type="submiy" name="submit" style="widows: 100px; padding: 25px;">Submit</button>
		</form><br>
		<p style="font-size: 20px;">
			<?php 
			if (isset($thestring)) {
				echo "Generated! <a href=\"$site_address/$thestring\" target=\"_blank\">$site_address/$thestring</a>";
			}
			 ?>
		 </p>
	</div>
</body>
</html>