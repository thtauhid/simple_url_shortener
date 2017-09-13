<?php 
require_once('config.php');

if (isset($_GET['id'])) {
	$id	=	$_GET['id'];

	$query	=	"SELECT url FROM data WHERE string = '$id'";

	$url = mysqli_query($dbconnect, $query);

	if ($url->num_rows) {
		echo $url = $url->fetch_object()->url;
		header("Location: $url");
	} else {
		echo "Something went wrong!";
	}
	
}

die();

 ?>