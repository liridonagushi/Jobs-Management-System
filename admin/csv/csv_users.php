<?php
//Visit http://code.google.com/p/parsecsv-for-php/ for more info.
//Connect to Database and perform your select
require_once('../../assets/include/functions.php');

$users=$dbh->query("SELECT id_user, name, surname, birthday, date_registered, email, is_admin FROM users WHERE status=1 ORDER BY id_user DESC LIMIT 10000");

$csvHeader="ID, Name, Surname, Birthday, Date registered, Email, Is admin\n";

# include parseCSV class.
require_once('parsecsv.lib.php');

# create new parseCSV object.
$csv = new parseCSV();

echo $csvHeader;
//Turn the SQL results into a 2D array
$DataArray = array();
while($row=$users->fetch(PDO::FETCH_ASSOC)) { 
    $DataArray[] = $row; 
}

//$csvHeader = array('Car name', 'color');
$csv->output (true, 'data.csv', $DataArray);
?>
