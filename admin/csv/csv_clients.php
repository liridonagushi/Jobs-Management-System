<?php
//Visit http://code.google.com/p/parsecsv-for-php/ for more info.
//Connect to Database and perform your select
require_once('../../assets/include/functions.php');

$reservations=$dbh->query("SELECT reservations.id_reservation, clients.id_client, clients.name, clients.surname, rooms.room_number, reservations.adults, reservations.children, reservations.date_reservation, reservations.check_in, reservations.check_out, reservations.cost_night, reservations.total_cost FROM reservations LEFT JOIN CLIENTS on reservations.id_client=clients.id_client LEFT JOIN rooms ON reservations.id_room=rooms.id_room ORDER BY reservations.id_reservation DESC LIMIT 10000");

$csvHeader="ID Reservation,ID client,Name,Surname,Room number,Adults,Children,Time reservation,Check In,Check Out,Cost Night ".$_SESSION['currency'].",Total Cost ".$_SESSION['currency']."\n";

# include parseCSV class.
require_once('parsecsv.lib.php');

# create new parseCSV object.
$csv = new parseCSV();

echo $csvHeader;
//Turn the SQL results into a 2D array
$DataArray = array();
while($row=$reservations->fetch(PDO::FETCH_ASSOC)) { 
    $DataArray[] = $row; 
}

//$csvHeader = array('Car name', 'color');
$csv->output (true, 'data.csv', $DataArray);
?>
