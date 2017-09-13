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



	//time now
	$time	=	date("d/m/Y");

	//Check for duplicate URL & String
	$url_check	=	"SELECT url FROM data WHERE url = '$url'";
	$url_check_processor	=	mysqli_query($dbconnect, $url_check);

	$duplicate_string_check	=	"SELECT string FROM data WHERE string = '$thestring'";
	$duplicate_string_check_processor =	mysqli_query($dbconnect, $duplicate_string_check);

	if ($url_check_processor->num_rows) {
		//If URL Exists - get the string for coresponding URL
		$get_string	=	"SELECT string FROM data WHERE url = '$url'";
		$get_string_processor	=	mysqli_query($dbconnect, $get_string);
		$thestring	=	$get_string_processor->fetch_object()->string;
		}	elseif ($duplicate_string_check_processor->num_rows) {
			//If the string exists - get the string
			$thestring	=	$duplicate_string_check_processor->fetch_object()->string;
		}	else {
			//Create New String
			$thestring	=	string();
			//Insert Data into DB
			$query	=	"INSERT INTO data (url, string, time) VALUES ('{$url}', '{$thestring}', '{$time}')";
			mysqli_query($dbconnect, $query) or die('Something happened!');
		}
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
