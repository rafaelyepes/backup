<?php

require_once("./fpdf181/dompdf/dompdf_config.inc.php");
// Introducimos HTML de prueba
include ("./conectar4.php");
$informe="Rapport Autobus";
$docmae = "";
$d2="Sin numero";
$chomae = "";
$busmae = "";
$datmae = "";
$horadepart = "";

if(isset($_GET['docmov'])){
  $docmae = $_GET['docmov'];
}
if(isset($_POST['docmov'])){
  $docmae = $_POST['docmov'];
}

if(isset($_GET['chomae'])){
  $chomae = $_GET['chomae'];
}
if(isset($_POST['chomae'])){
  $chomae = $_POST['chomae'];
}

$d2="Autob".$docmae;

//$ruta = "./php/archivos/pdf/"."Autob".$docmae.".pdf";
$ruta = "./archivos/pdf/"."Autob".$docmae.".pdf";

$busmae="xxxx";
$firstname = "NA";
$lastname = "NA";

$sql = "SELECT * from autobusmae WHERE docmae='$docmae'";
$query = $conn->query($sql);
while($row = $query->fetch_array()){
      $datmae = $row['datmae'];
      $busmae = $row['busmae'];
      $chomae = $row['chomae'];
      $horadepart  = $row['hr2mae'];
      $horallegada = $row['hr3mae'];
}

$sql = "SELECT * from autobusemp where numemp='$chomae'";
$query = $conn->query($sql);
while($row = $query->fetch_array()){
  $firstname = $row['nomemp'];
  $lastname = $row['apeemp'];
}
$nombreauto=$firstname."  ".$lastname;


$codigoHTML = '
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1, minimun-scale=1">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="./estilos/tabla1.css" rel="stylesheet" media="screen" type="text/css">
      <table class="tablat" id="tablat" border=1 cellspacing=0 cellpadding=0>
        <tr>
        <th rowspan="5" width="16" height="80" ><img  src="./img/logolacroix.png" width="13" height="70"  ></th>
        <td align="Center" colspan="4" style="font-size:14px">'.$informe.'</td>
        </tr>
        <tr>
        <th align="left" style="font-size:12px; padding-left: 10px;">Numéro Document</th>
        <th colspan="3" align="left" style="font-size:11px; padding-left: 10px;">'.$docmae.'</th>
        </tr>

        <tr>
        <th valign ="middle" align="left" style="font-size:12px; padding-left: 10px;">Date</th>
        <th colspan="3"  align="left"  style="font-size:11px; padding-left: 10px;">'.$datmae.'</th>
        </tr>

        <tr>
        <th align="left" style="font-size:12px; padding-left: 10px;">Autobus</th>
        <th align="left"  style="font-size:11px; padding-left: 10px;">'.$busmae.'</th>
        <th colspan="2" align="left" style="font-size:12px; padding-left: 10px;">Heure départ  : '.$horadepart.'</th>
        </tr>

        <tr>
        <th align="left" style="font-size:12px; padding-left: 10px;">Chauffeur</th>
        <th align="left"  style="font-size:11px; padding-left: 10px;">'.$chomae.'</th>
        <th colspan="2" align="left"  style="font-size:11px; padding-left: 10px; ">'.$nombreauto.'</th>
        </tr>
        </table>

          <table class="tablat" id="tablat" border=1 cellspacing=0 cellpadding=0>
          <tr style="text-align: center; font-size:13px">
          <td>Item</td>
          <td>Numéro</td>
          <td>Prénom de l`employé </td>
          <td>Nom de l`employé  </td>
          <td>Genre</td>
          </tr>
          ';
          $lin1 = 0;
          $cod1= "";
          $cod2= "";
          $cod3= "";
          $cod4= "";
          $cont1 = 0;
          $cont2 = 0;
          $cont3 = 0;
          $sql = "SELECT * from autobusmov WHERE docmov='$docmae'";
          $query = $conn->query($sql);
          while($row = $query->fetch_array()){
                $lin1=$lin1+1;
                $cod1 = $row['nummov'];
                $cod2 = $row['nommov'];
                $cod3 = $row['apemov'];
                $cod4 = $row['sexmov'];


                if ($cod1 == ''){
                    if ($cod4 == 'Homme'){
                     $cont2 = $cont2+1;
                    }
                    if ($cod4 == 'Femme'){
                     $cont3 = $cont3+1;
                    }

                }else{
                 $cont1 = $cont1+1;


                }
                $codigoHTML.='
                <tr style="font-size:12px; text-align: center;">
                <td>'.$lin1.'</td>
                <td>'.$cod1.'</td>
                <td style="text-align: left; padding-left: 5px;">'.$cod2.'</td>
                <td style="text-align: left; padding-left: 5px;">'.$cod3.'</td>
                <td>'.$cod4.'</td>
                </tr>
                ';

          }

         $codigoHTML.='
         <tr style="text-align: center; font-size:13px">
         <td colspan="2">Nouveaux hommes</td>
         <td>Nouvelles femmes</td>
         <td>Anciens employés</td>
         <td>Total</td>
         </tr>
         <tr style="text-align: center; font-size:13px">
         <td colspan="2">'.$cont2.'</td>
         <td>'.$cont3.'</td>
         <td>'.$cont1.'</td>
         <td>'.$lin1.'</td>
         </tr>
         <tr>
         <td colspan="5"></td>
         </tr>
         </table>
         ';

$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
//$paper_size = (25,15,760,590);
//$dompdf->set_paper($paper_size);
$dompdf->set_paper("letter","portrait");  //tiene que ser horizontal y lo deja en vertical
$dompdf->load_html(utf8_decode($codigoHTML));
ini_set("memory_limit","128M");
$dompdf->render();
$output = $dompdf->output();
file_put_contents($ruta, $output);
//$dompdf->stream($ruta);
$dompdf->stream($ruta, array("Attachment" => false));
//fin de creacion del PDF //

//include "./php/enviaradjunto.php";
//$res = array('error' => false);
//$res['results'] = $d2;


//echo json_encode($res);



//header('Content-Type: text/html; charset=ISO-8859-1');
// para evitar que se nos detenga la ejecucion del script (en caso de que el servidor tarde en responder) definimos un intervalo de 5 minutos de inactividad
ini_set('max_execution_time', 300);
include ("php/class.phpmailer.php");
//Recibir todos los parámetros del formulario

$para = "autobus@lacroixmeats.com";
$para1 = "";
$para2 = "";
$para3 = "";
$para4 = "";
$para5 = "";

$asunto = "Asunto";
$mensaje = "Mensaje";

//$username = 'docs@lacroixmeats.com';
//$password = 'DoLa753?';

$username = 'lacroixnet@lacroixmeats.com';
$password = 'Yefa7832$';


$rutaadic='/archivos/pdf/'.$d2.'.pdf';
$archivoi=getcwd().$rutaadic;

// Enviamos la respuesta
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 2;//$mail->SMTPDebug = 1; // Degug. Valores 1 -> errores y mensajes // 2 solo mensajes // 0 no informa nada

//$mail->Host = "smtp.aol.com";
//$mail->Host = "stmp.yahoo.com";
//$mail->Host = "smtp.gmail.com";

$mail->Host = "smtp.office365.com";
$mail->Port = "587";
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = TRUE;
$mail->Username = $username;
$mail->Password = $password;

$mail->From = $username;
$mail->FromName = "Rafael Yepes";


//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para1);
$mail->AddAddress($para2);
$mail->AddAddress($para3);
$mail->AddAddress($para4);
$mail->AddAddress($para5);


$mail->Subject = $asunto;
//$mail->Body = $mensaje;
$mail->Body = $archivoi;

$d1="rafael.yepes@lacroixmeats.com";
$ruta="";

//$d2="Autob124";

//$d2=$nomemail;

//$archivoi='C:\xampp\htdocs\autobus\archivos\pdf\Autob117.pdf';
//$rutaadic='/php/archivos/pdf/'.$d2.'.pdf';

//$rutaadic='/archivos/pdf/'.$d2.'.pdf';
//$archivoi=getcwd().$rutaadic;

$d2g=$d2.".pdf";

echo ("Nombre del Archivo No 1 :".$d2);
echo ("    .     ");
echo ("<br>");
echo ("Correo Electronico :".$d1);
echo ("<br>");
echo ("Ruta Real   :".$ruta);
echo ("<br>");
echo ("Nombre del Archivo No 2 :".$archivoi);
echo ("<br>");

$mail->AddAttachment($archivoi,$d2g);

$mail->WordWrap = 50;
$mail->IsHTML(TRUE);

if($mail->Send())
{
         //enviado
}
else{
         //no enviado
}



?>
