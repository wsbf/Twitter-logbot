<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<!--
	because we are using iframes, a transitional doctype is required
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
-->


<head>
	<!--<script type='text/javascript' src='http://wsbf.net/misc/jqui/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='http://wsbf.net/misc/jqui/js/jquery-ui-1.7.2.custom.min.js'></script>-->

	<script type='text/javascript' src='./js/jqui/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='./js/jqui/js/jquery-ui-1.7.2.custom.min.js'></script>
	<script type='text/javascript' src='./logbook.js'></script>
	<meta http-equiv='Content-type' content='text/html;charset=UTF-8' />

	<link rel='stylesheet' type='text/css' href='logbook.css'></link>
        <link rel='stylesheet' id='pricss' type='text/css' href='./js/jqui/css/blitzer/jquery-ui-1.7.2.custom.css'></link>
	<!--<link rel='stylesheet' id='pricss' type='text/css' href='http://wsbf.net/misc/jqui/css/blitzer/jquery-ui-1.7.2.custom.css'></link>-->
	<title>WSBF-FM Logbook</title>
</head>

<body>
<?php

require_once('../conn.php');

$valid_ips = array("130.127.17.5", "130.127.17.40");
$usr = array("admin", "ztm", "remote");
$pwd = array("92d2575377e51f6ba8a373499032aef9", "b9ef6ac2eddbf7021becf4b7fbba071f", "2fae46adeaf17e7bee09ed19ae86eaa3");

/** This is the admittedly weak security routine. **/
if(!in_array($_SERVER['REMOTE_ADDR'], $valid_ips)) {
	session_start();
	if(isset($_GET['out']) && $_GET['out'] == 1) {
		session_unset();
		session_destroy();
	}

	if(isset($_POST['usr']) && isset($_POST['pwd'])) {
		if(in_array($_POST['usr'], $usr)) {
			if(in_array(md5($_POST['pwd']), $pwd)) {
				$_SESSION['wizbif'] = "foobar";
			}
		}

	}
	if(!isset($_SESSION['wizbif']) || $_SESSION['wizbif'] != "foobar") {
		?>
		<div id='users-contain' class='ui-widget'>
		<p>You're not logged in. Please do so now.</p>
		<form action='logbook.php' method='post'><table>
		<?php 
		if($_POST['usr']){
			echo "<font color='ff0000'>Incorrect password; try again.</font>";
		}
		?>
		<tr><td>Username:</td><td><input type='text' name='usr' /></td></tr>
		<tr><td>Password:</td><td><input type='password' name='pwd' /></td></tr>
		<tr><td colspan='2'><input type='submit' name='submit' /></td></tr>
		</table></form></body></html>
		<?php
		die();
	}

	echo "<p>Done? <a href='logbook.php?out=1'>Log off</a>.</p>";
}
/** End security. **/
?>
