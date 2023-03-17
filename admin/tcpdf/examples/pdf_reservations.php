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
$client=$dbh->query('SELECT * FROM clients WHERE id_client='.$_GET['id_client'].' LIMIT 1');
$row_client=$client->fetch(PDO::FETCH_ASSOC);
$transactions=$dbh->query('SELECT * FROM reservations WHERE id_client='.$_GET['id_client'].'');
$tbl_header = '  <style>
th{
border:1px solid gray;
padding:10px;
margin:10px;
font-size: 7px;
font-style: italic;
text-align:center;
background-color:#DCDCDC;
}
.header{
font-size: 7px;
}
.invoice_command{
font-size: 9px;
}
.resultrows td{
text-align: center;
font-size: 8px;
border:1px solid gray;
}
</style>
<table>
    <tr>
        <td align="left" class="invoice_command" height="55px">
            <br/>
            Liridon Agushi<br/>
            S.D Susaja<br/>
            0638002549<br/>
            agushi.liridon@gmail.com
        </td>
        <td align="right">
            <img src="../../../assets/images/logo/logo.jpg" />
        </td>
    </tr>
    <tr class="header">
        <td align="left">
            History Transaction for Client ID# '.$row_client['id_client'].', '.$row_client['name'].' '.$row_client['surname'].'
        </td>
        <td height="30px"  align="right">
            
            January 1, 2015<br />
        </td>
    </tr>
    
</table>
<table>
    <tr>
        <th>Room ID</th>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Cost Night</th>
    </tr>';
$tbl_footer = '</table>';
$tbl = '';
while($row_transactions=$transactions->fetch(PDO::FETCH_ASSOC)){
$tbl .= '
<tr class="resultrows">
    <td>'.$row_transactions['id_room'].'</td>
    <td>'.$row_transactions['check_in'].'</td>
    <td>'.$row_transactions['check_in'].'</td>
    <td>'.$row_transactions['check_in'].'</td>
</tr>
';
}
// output the HTML content
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
//Close and output PDF document
$pdf->Output('reservations.pdf', 'I');