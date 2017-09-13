<?php

//Database Details
$host	=	'';
$user	=	'';
$pass	=	'';
$dbase	=	'';

//Web Address
//Example: $site_address	=	'http://tauhid.xyz';
$site_address	=	'';

//db connect
$dbconnect	=	mysqli_connect($host, $user, $pass, $dbase) or die('Unable to connect to database!');