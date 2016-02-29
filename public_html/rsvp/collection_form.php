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
<html>

<head>
    <meta charset="utf-8">
    <title>RSVP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= Configuration::$STATIC_PATH; ?>styles/normalize.css">
    <style media="screen">
        html, body {
            font-family: -apple-system, avenir, 'avenir next', roboto, 'helvetica neue', helvetica, ubuntu, arial, sans-serif;
        }
    </style>
</head>

<body>
    	<header>
        	<h1>RSVP</h1>
			<h2>To Sam &amp; Eric's Wedding</h2>
    	</header>
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
	    <label>Total number of people in party:</label>
            <input type="text" name="partysize">
			<br>
            <label>Can you make it?</label>
			<select name="is_attending">
				<option value="NULL"><em>Please Select Either Yes or No</em></option>
				<option value="YES">Yes</option>
				<option value="NO">Alas, no</option>
			</select>
			<br>
	    <label>Email Address</label>
            <input type="email" name="contact_email">
			<br>
	    <label for="extra_info">Anything else we should know?</label>
			<br>
			<textarea name="extra_info" placeholder="..."></textarea>
			<br>
            <button type="submit" name="submit">Submit RSVP</button>
        </form>

<? } // End show HTML form ?>

    </main>
    <br>
    <br>
</body>

</html>
