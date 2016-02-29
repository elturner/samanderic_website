<?php

require_once "auth.php";

$db = new Database();
$auth = new Auth($db);
$auth->restore_session();

if (!$auth->is_logged_in()) {
    die("Unauthorized");
}

$result = $db->query("SELECT * FROM rsvp_data");

if (!$result) {
    echo "<br>Could not fetch data from database.\n";
    exit;
}

?>

<h3 style="text-align: center;">RSVP Data</h3>
</br>
<table id="table_id" class="display table table-striped table-condensed table-hover">
    <thead style="font-size:0.8em;text-transform:uppercase">
        <tr>
            <th>Date</th>
            <th>People</th>
            <th>Party Size</th>
            <th>Attending?</th>
            <th>Email</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
<?
// Output data of each row
while ($row = $db->read_row($result)) { ?>
        <tr>
            <td><?= $row["date_time"] ?></td>
            <td data-priority="1"><?= $row["people"] ?></td>
            <td data-priority="1"><?= $row["partysize"] ?></td>
            <td><?= $row["is_attending"] ?></td>
            <td><a href="mailto:<?= $row["contact_email"] ?>"><?= $row["contact_email"] ?></a></td>
            <td data-priority="2"><?= $row["extra_info"] ?></td>
        </tr>
<? } // end row loop ?>
</tbody>
</div>
</table>
