<?php
session_start();
include_once 'dbh.inc.php';
date_default_timezone_set('Europe/Brussels');

$order_id = $_SESSION['o_id']; //haal order id op uit sessie

// haal orderinfo op
$sql = "SELECT * FROM tbl_orders WHERE ordernummer=$order_id";
$result_orders = mysqli_query($conn, $sql);
foreach ($result_orders as $result_orders_sql) {
  $klantnummer = $result_orders_sql['klantnummer'];
  $datum_aangemaakt = strtotime($result_orders_sql['datum_aangemaakt']);
  $breedte = $result_orders_sql['breedte'];
  $hoogte = $result_orders_sql['hoogte'];
  $radius = $result_orders_sql['radius'];
  $tussenafstand = $result_orders_sql['tussenafstand'];
  $rolbreedte = $result_orders_sql['rolbreedte'];
  $materiaal = $result_orders_sql['materiaal'];
  $afbeelding = $result_orders_sql['afbeelding_path'];
  $wikkeling = $result_orders_sql['wikkeling'];
  $oplage1 = $result_orders_sql['oplage1'];
  $oplage2 = $result_orders_sql['oplage2'];
  $prijs1 = $result_orders_sql['prijs1'];
  $prijs2 = $result_orders_sql['prijs2'];
  $status = $result_orders_sql['status'];
  $opmerking_klant = $result_orders_sql['opmerking_klant'];
  $opmerking_admin = $result_orders_sql['opmerking_admin'];
}

//haal klantinfo op
$sql = "SELECT * FROM tbl_klanten WHERE klantnummer='$klantnummer'";
$result = mysqli_query($conn, $sql);
foreach ($result as $result_sql) {
  $email = $result_sql["email"];
  $voornaam = $result_sql["voornaam"];
  $achternaam = $result_sql["achternaam"];
  $telefoonnummer = $result_sql["telefoonnummer"];
  $bedrijf = $result_sql["bedrijf"];
}

// Het onderwerp
$subject = "De offerte voor uw aanvraag: #".$_SESSION['o_id'];

// het bericht
$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$msg .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$msg .= '<head> <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Pentolabel Offerte</title><meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
$msg .= '<style> body { font-family: Roboto; padding 0px; background-color: white; }';
$msg .= '.container { width: 1120px; margin-left: auto; margin-right: auto; background-color: white; }';
$msg .= '.announcement { width: 100%; background-color: #dc5626; grid-row-gap: 1fr; }';
$msg .= '.announcement_row { width: 1120px; color: white; display: grid; margin-left: auto; margin-right: auto; font-size: 14px; }';
$msg .= '.logo img { padding: 20px 0px 20px 0px; }';
$msg .= '.nav { width: 100%; border: 0px; list-style-type: none; background-color: #292929; padding: 0px; } .nav td { padding: 20px; display: inline-block; } .nav td:hover { background-color: #363636; text-decoration: none } .nav a { color: white; text-decoration: none;}';
$msg .= 'h4 { font-size: 20px; margin-bottom: 10px; color: #dc5626;}';
$msg .= '.overzicht td { padding: 10px; padding-left: 0px;}';
$msg .= '</style> </head>';
$msg .= '<body style="margin: 0px;" bgcolor=”#ffffff”><div class="announcement" bgcolor="#dc5626"><span class="announcement_row" style="padding: 8px 0px 8px 0px;">Pentolabel B.V., Mon Plaisir 89c, 4879 AM Etten-Leur</span></div>';
$msg .= '<div class="container">';
$msg .= '<a class="logo" href="https://pentolabel.nl/"><img src="https://pentolabel.nl/wp-content/uploads/2017/11/briefhoofd.png" height="88px"></a>';
$msg .= '<table class="nav" style="margin: 0px 0px 10px 0px;"><tr height="100%"><td><a href="http://localhost:8080/IT-Challenge/public/order">Mijn orders</a></td></tr></table>';
$msg .= '<h4><strong>Beste '.$voornaam.' '.$achternaam.',</strong></h4>';
$msg .= 'Hartelijk dank voor uw aanvraag bij Pentolabel. Dit is de offerte voor uw aanvraag. Deze is bij ons bekend onder nummer: <strong>'.$_SESSION['o_id'].'</strong>';
$msg .= '<h4><strong>Overzicht van de offerte</strong></h4>';
$msg .= 'Datum van de offerte: '.date('d-m-Y').'<br>';
$msg .= 'Datum van je aanvraag: '.date('d-m-Y', $datum_aangemaakt).'<br><br>';
$msg .= '<table class="overzicht" style="width:100%; table-layout: fixed; border: 0; margin-bottom: 10px;"><tr><td>Breedte: '.$breedte.' mm</td>';
$msg .= '<td>Hoogte: '.$hoogte.' mm</td></tr>';
$msg .= '<tr><td>Radius: '.$radius.' mm</td>';
$msg .= '<td>Tussenafstand: '.$tussenafstand.' mm</td></tr>';
$msg .= '<tr><td>Rolbreedte: '.$rolbreedte.' mm</td>';
$msg .= '<td>Materiaal: '.$materiaal.'</td></tr>';
$msg .= '<tr><td>Wikkeling: '.$wikkeling.'</td>';
if ($afbeelding != "") $msg .= '<td style="background-color: #dc5626; color: #ffffff; border: none; padding: 10px 18px; font-size: 16px; cursor: pointer; border-radius: 2px;"><a style="color: white; text-decoration: none;" href="uploads/'.$afbeelding.'" target="_blank">'.$afbeelding.'</a></td></tr>';
else $msg .= '</tr>';
$msg .= '<tr><td>Minimale oplage: '.$oplage1.' stuks</td>';
if ($prijs2 != "0") $msg .= '<td>Maximale oplage: '.$oplage2.' stuks</td></tr>';
else $msg .= '</tr>';
$msg .= '<tr><td>Prijs minimale oplage: €'.$prijs1.' per 1000 stuks</td>';
if ($prijs2 != "0") $msg .= '<td>Prijs maximale oplage: €'.$prijs2.' per 1000 stuks</td></tr>';
else $msg .= '</tr>';
$msg .= '<tr><td>Status: Wachten op confirmatie klant</td></tr>';
if (($opmerking_klant != NULL) && ($opmerking_admin == NULL)) $msg .= '<tr><td>Opmerking klant: '.$opmerking_klant.'</td></tr>';
else if (($opmerking_klant != NULL) && ($opmerking_admin != NULL)) $msg .= '<tr><td>Opmerking klant: '.$opmerking_klant.'</td><td>Opmerking admin: '.$opmerking_admin.'</td></tr>';
else if (($opmerking_klant == NULL) && ($opmerking_admin != NULL)) $msg .= '<tr><td>Opmerking admin: '.$opmerking_admin.'</td></tr>';
$msg .= '</table>';
$msg .= '<table style="width:100%; table-layout : fixed; border: 0px"><tr><td><a style="text-decoration: none;" href="http://localhost:8080/IT-Challenge/public/order?order='.$_SESSION['o_id'].'"><table style="padding: 10px; width: 100%; background-color: #27abdd; color: white;" border="0"><tr><td align="center">De offerte goedkeuren</td></tr></table></a></td><td><a style="text-decoration: none;" href="http://localhost:8080/IT-Challenge/public/order?order='.$_SESSION['o_id'].'"><table style="padding: 10px; width: 100%; background-color: #dd2727; color: white;" border="0"><tr><td align="center">De offerte afkeuren</td></tr></table></a></td></tr></table>';
$msg .= '<h4><strong>Jouw gegevens</strong></h4>';
$msg .= '<table class="overzicht" style="width:100%; table-layout : fixed; border: 0px"><tr><td>Naam: '.$voornaam.' '.$achternaam.'</td>';
$msg .= '<td>Email: '.$email.'</td></tr>';
$msg .= '<tr><td>Telefoonnummer: '.$telefoonnummer.'</td>';
if ($afbeelding != "") $msg .= '<td>Bedrijf: '.$bedrijf.'</td></tr></table>';
else $msg .= '</tr></table>';
$msg .= '</div>';
$msg .= '</body> </html>';

echo $msg; // tijdelijk mail laten zien voor testen

// bekangrijke info
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: Pentolabel <info@pentolabel.nl>' . "\r\n";

// email versturen
mail($email,$subject,$msg,$headers);
?>
