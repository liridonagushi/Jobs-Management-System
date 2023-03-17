<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+
/**
* Creates an example PDF TEST document using TCPDF
* @package com.tecnick.tcpdf
* @abstract TCPDF - Example: HTML tables and table headers
* @author Nicola Asuni
* @since 2009-03-20
*/
// Include the main TCPDF library (search for installation path).
require_once('../../../assets/include/functions.php');
require_once('tcpdf_include.php');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
// Page footer
public function Footer() {
// Position at 15 mm from bottom
$this->SetY(-15);
// Set font
$this->SetFont('helvetica', 'I', 8);
// Page number
$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
}
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set default header data
// set header and footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set some language-dependent strings (optional)

// add a page
$pdf->AddPage();
// NON-BREAKING ROWS (nobr="true")
// $res=$dbh->query('SELECT reservations.id_reservation,reservations.id_reservation,  FROM reservations LEFT JOIN clients ON reservations.id_client=clients.id_client WHERE id_client='.$_GET['id_client'].' LIMIT 1');
// $tbl_res=$res->fetch(PDO::FETCH_ASSOC);
//============================================================+
// END OF FILE
//============================================================+
$user=$dbh->query('SELECT job_types.title, users.name, users.surname FROM users LEFT JOIN job_types ON users.id_job=job_types.id_job WHERE id_user="1"');
$col_user=$user->fetch(PDO::FETCH_ASSOC);

$client=$dbh->query('SELECT * FROM clients WHERE id_client="'.$_GET['id_client'].'" LIMIT 1');
$col_client=$client->fetch(PDO::FETCH_ASSOC);
$transactions=$dbh->query('SELECT * FROM reservations WHERE id_reservation="'.$_GET['id_reservation'].'"');
$col_transactions=$transactions->fetch(PDO::FETCH_ASSOC);
$status=$dbh->query('SELECT res_status FROM reservation_status WHERE id_res_status="'.$col_transactions['status'].'"');
$col_status=$status->fetch(PDO::FETCH_ASSOC);
$room=$dbh->query('SELECT room_number FROM rooms WHERE id_room="'.$col_client['id_room'].'"');
$col_room=$room->fetch(PDO::FETCH_ASSOC);

$tbl_header = '  <style>
th{
border:1px solid gray;
margin-right:10px;
font-size: 7px;
text-align:right;
background-color:#DCDCDC;
font-weight: bold;
}

td{
text-align: right;
font-size: 8px;
border:1px solid gray;
}

.logo{
    border:none;
}

.header{
font-size: 7px;
}

.invoice_command{
font-size: 12px;
height:55px;
border:none;
text-align: left;
}
img{

width:100px;
padding-right:20px;
}
.result{
    height:15px;
}
.noborder{
    border:none;
    height:55px;
    text-align:right;
}
</style>
<table>
    <tr>
        <td class="invoice_command">
            Liridon Agushi<br>
            S.D Susaja<br/>
            0638002549<br/>
            agushi.liridon@gmail.com
        </td>
        <td class="logo">
            <img src="../../../assets/images/logo/logo.jpg" />
        </td>
    </tr>
        <tr>
    <td class="noborder"></td>
    <td class="noborder"></td>
</tr>
    <tr class="header">
        <td align="left">
            Client ID N° '.$col_client['id_client'].'
        </td>
        <td height="30px"  align="right">
            
            January 1, 2015<br />
        </td>
      </tr>
</table>';
$tbl = '';
$tbl .= '
<table>
        <tr>
            <th class="result">Room Number</th>
            <td class="result">'.$col_room['room_number'].'</td>
        </tr>
        <tr>
            <th class="result">Time Reservation</th>
            <td class="result">'.$col_transactions['date_reservation'].'</td>
        </tr>
        <tr>
            <th class="result">Check In</th>
            <td class="result">'.$col_transactions['check_in'].'</td>

        </tr>
        <tr>
            <th class="result">Check Out</th>
            <td class="result">'.$col_transactions['check_out'].'</td>
        </tr>
        <tr>
            <th class="result">Total Nights</th>
            <td class="result">'.$col_transactions['total_nights'].'</td>
        </tr>
        <tr>
            <th class="result">Total Cost</th>
            <td class="result">'.$col_transactions['total_cost'].' '.$_SESSION['currency'].'</td>
        </tr>
        <tr>
            <th class="result">Status</th>
            <td class="result">'.$col_status['res_status'].'</td>
        </tr>
<tr>
    <td class="noborder"></td>
    <td class="noborder"></td>
</tr>
<tr>
    <td style="border:none;text-align:left;height:20px;">Client: '.$col_client['name'].' '.$col_client['surname'].'</td>
    <td style="border:none;text-align:right;height:20px;">'.$col_user['title'].': '.$col_user['name'].' '.$col_user['surname'].'</td>
</tr>
<tr>
    <td style="border:none;text-align:left;">----------------------------------</td>
    <td style="border:none;text-align:right;">----------------------------------</td>
</tr>

';


    $tbl_footer = '</table>';
// output the HTML content
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
//Close and output PDF document
$pdf->Output('reservations.pdf', 'I');