<?php

require_once "database.php";

function save_rsvp(Database $db) {
	$values['people']=$db->escape_string($_POST['people']);
	$values['partysize']=$db->escape_string($_POST['partysize']);
	$values['is_attending']=$db->escape_string($_POST['is_attending']);
	$values['contact_email']=$db->escape_string($_POST['contact_email']);
	$values['extra_info']=$db->escape_string($_POST['extra_info']);

	return $db->insert("rsvp_data", $values);
}

$db = new Database();

// Only process form if $_POST isn't empty
$submitted = false;
$success = false;
if (!empty($_POST)) {
	$submitted = true;
	$success = save_rsvp($db);
}

?>

<!DOCTYPE html>
<html class="no-js">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Sam and Eric's Wedding</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<style>
			body {
				padding-top: 4em;
				padding-bottom: 2.5em;
			}
		</style>
		<link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="/css/main.css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic' rel='stylesheet' type='text/css'>

	</head>
	<body>
		<center>
		<div class="container">
			
			<!-- linkbar -->
			<ul class="nav nav-pills pull-left">
	 		  <li><a href="/index.html">Home</a></li>
			  <li><a href="/venue.html">Venue</a></li>
			  <li><a href="/attire.html">Attire</a></li>
			  <li><a href="/accommodations.html">Accommodations</a></li>
			  <li><a href="transportation.html">Transportation</a></li>
			  <li><a href="/registry.html">Registry</a></li>
			  <li class="active">
			  	<a href="/rsvp.html">RSVP</a>
			  </li>
		  	</ul>
		  	<br />
		  	<br />
			
			<div class="hero-unit">
				<div class="row">

					<!-- ************* -->

					<h3>RSVP</h3>
					<hr />
					<br />

    <main>

<?

if ($submitted && $success) {
	include "submit_success.php";
} else {
	if ($submitted) {
		include "submit_error.php";
	}
    // Show HTML form
?>
        <form method="post">
            <label>Please list the people in your party:</label>
            <input type="text" name="people">
			<br>
			<br>
	    <label>Total number of people in party:</label>
            <input type="number" name="partysize">
			<br>
			<br>
            <label>Can you make it?</label>
			<select name="is_attending">
				<option value="NULL"><em>Please Select Either Yes or No</em></option>
				<option value="YES">Yes</option>
				<option value="NO">Alas, no</option>
			</select>
			<br>
			<br>
	    <label>Email Address</label>
            <input type="email" name="contact_email">
			<br>
			<br>
	    <label for="extra_info">Anything else we should know?</label>
			<textarea name="extra_info" rows="5" placeholder="..."></textarea>
			<br>
			<br>
            <button type="submit" name="submit">Submit RSVP</button>
        </form>

<? } // End show HTML form ?>

    </main>


					<!-- ************* -->
				
					<br />
					<hr />
					<a href="&#109;&#97;&#105;&#108;&#116;&#111;:&#105;&#110;&#102;&#111;&#64;&#115;&#97;&#109;&#97;&#110;&#100;&#101;&#114;&#105;&#99;&#46;&#111;&#114;&#103;">&#105;&#110;&#102;&#111;&#64;&#115;&#97;&#109;&#97;&#110;&#100;&#101;&#114;&#105;&#99;&#46;&#111;&#114;&#103;</a>

					<!-- ************* -->
				</div>
			</div>

			<hr>

			<footer>
				<font color="#FFFFFF">
					<p>&copy; Eric Turner and Samantha Shropshire 2016</p>
				</font>
			</footer>

		</div> <!-- /container -->
		</center>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

		<script src="js/vendor/bootstrap.min.js"></script>

		<script src="js/main.js"></script>
	</body>
</html>
