
<?php
require_once("./fpdf181/dompdf/dompdf_config.inc.php");
// Introducimos HTML de prueba
include ("./conectar4.php");
$informe="Rapport Global Autobus";
$docmae = "117";
//$ruta = "./archivos/pdf/"."Autob".$docmae.".pdf";
$busmae="xxxx";
$firstname = "NA";
$lastname = "NA";
$lin1t = 0;
$cont1t = 0;
$cont2t = 0;
$cont3t = 0;
$conta1 = 0;
$conta2 = 0;
$conta3 = 0;
$conta4 = 0;

$datmae ="2018-01-01";
if(isset($_POST['fecha'])){
    $datmae = $_POST['fecha'];
}


$ruta = "./archivos/pdf/"."Autob".$datmae.".pdf";

$codigoHTML = '
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1, minimun-scale=1">
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<link href="./estilos/tabla1.css" rel="stylesheet" media="screen" type="text/css">

      <table class="tablat" id="tablat" border=1 cellspacing=0 cellpadding=0>
        <tr>
        <th rowspan="2" width="16" height="70" ><img  src="./img/logolacroix.png" width="13" height="60"  ></th>
        <td align="Center" valign ="middle" colspan="4" style="font-size:16px">'.$informe.'</td>
        </tr>

        <tr >
        <th height="45" valign ="middle" align="left" style="font-size:12px">Date</th>
        <th height="45" colspan="3"  align="left"  style="font-size:11px">'.$datmae.'</th>
        </tr>


        </table>
        <br>

        <table class="tablat" id="tablat" border=2 cellspacing=0 cellpadding=0>

         <tr style="text-align: center; font-size:13px">
         <td>Chauffeur</td>
         <td>Prénom Chauffeur</td>
         <td>Autobus</td>
         <td>Heure départ</td>
         <td>Nouveaux hommes</td>
         <td>Nouvelles femmes</td>
         <td>Anciens employés</td>
         <td>Total</td>
         </tr>

        ';

     $m123=array();

     $sql = "SELECT * from autobusmae WHERE datmae='$datmae'";
     $query = $conn->query($sql);
     while($row = $query->fetch_array()){
              $m123[] = $row ["docmae"];
              $docmae = $row['docmae'];
              $datmae = $row['datmae'];
              $busmae = $row['busmae'];
              $chomae = $row['chomae'];
              $horadepart  = $row['hr2mae'];
              $horallegada = $row['hr3mae'];

              $sql1 = "SELECT * from autobusemp where numemp='$chomae'";
              $query1 = $conn->query($sql1);
              while($row1 = $query1->fetch_array()){
              //$firstname = "Primer nombre ok";
              //$lastname  = "Last Name OK";
              $firstname = $row1['nomemp'];
              $lastname = $row1['apeemp'];
              $nombreauto=$firstname."  ".$lastname;
              }



              $lin1 = 0;
              $cont1 = 0;
              $cont2 = 0;
              $cont3 = 0;
              $sql2 = "SELECT * from autobusmov WHERE docmov='$docmae'";
              $query2 = $conn->query($sql2);
              while($row2 = $query2->fetch_array()){
                    $lin1=$lin1+1;
                    $lin1t=$lin1t+1;
                    $cod1 = $row2['nummov'];
                    $cod2 = $row2['nommov'];
                    $cod3 = $row2['apemov'];
                    $cod4 = $row2['sexmov'];
                    if ($cod1 == ''){
                        if ($cod4 == 'Homme'){
                         $cont2 = $cont2+1;
                         $cont2t = $cont2t+1;
                        }
                        if ($cod4 == 'Femme'){
                         $cont3 = $cont3+1;
                         $cont3t = $cont3t+1;
                        }
                    }else{
                     $cont1 = $cont1+1;
                     $cont1t = $cont1t+1;
                    }
                    $codigoHTML.='
                    ';
              }

        $codigoHTML.='



         <tr style="text-align: center; font-size:13px">

         <td>'.$chomae.'</td>
         <td>'.$nombreauto.'</td>
         <td>'.$busmae.'</td>
         <td>'.$horadepart.'</td>
         <td>'.$cont2.'</td>
         <td>'.$cont3.'</td>
         <td>'.$cont1.'</td>
         <td>'.$lin1.'</td>
         </tr>
         ';

      }
        $codigoHTML.='
         <tr style="text-align: center; font-size:13px">
         <td colspan="4">Total</td>
         <td>'.$cont2t.'</td>
         <td>'.$cont3t.'</td>
         <td>'.$cont1t.'</td>
         <td>'.$lin1t.'</td>
         </tr>
         </table>

         <br>
         <br>
         <br>
         <table class="tablat" id="tablat" border=2 cellspacing=0 cellpadding=0>
         <tr style="text-align: center; font-size:13px">
         <td>Employés prévus dans l`autobus</td>
         <td>Employés présents dans l`autobus</td>
         <td>Employés imprévus</td>
         <td>Total des absents</td>
         </tr>
         <tr style="text-align: center; font-size:13px">
         <td>'.$conta1.'</td>
         <td>'.$conta2.'</td>
         <td>'.$conta3.'</td>
         <td>'.$conta4.'</td>
         </tr>
         </table>



        ';
/*
         $sql3 = "SELECT * from autobusmov WHERE docmov='$docmae'";
         $query3 = $conn->query($sql3);
         while($row3 = $query3->fetch_array()){
*/
         foreach ($m123 as &$value) {

            //  $cod1 = $row3['nummov'];
              $docmae = $value;
            //  $datmae = "Temporal";
              $sql3 = "SELECT * from autobusmae WHERE docmae='$docmae'";
              $query3 = $conn->query($sql3);
              while($row3 = $query3->fetch_array()){
                     $docmae = $row3['docmae'];
                     $datmae = $row3['datmae'];
                     $busmae = $row3['busmae'];
                     $chomae = $row3['chomae'];
                     $horadepart  = $row3['hr2mae'];
                     $horallegada = $row3['hr3mae'];
              }
              $sql4 = "SELECT * from autobusemp where numemp='$chomae'";
              $query4 = $conn->query($sql4);
              while($row4 = $query4->fetch_array()){
                $firstname = $row4['nomemp'];
                $lastname = $row4['apeemp'];
              }
              $nombreauto=$firstname."  ".$lastname;

              $codigoHTML.='
              <div style="page-break-before: always;"></div>
              <table class="tablat" id="tablat" border=1 cellspacing=0 cellpadding=0>
              <tr>
              <th rowspan="5" width="16" height="80" ><img  src="./img/logolacroix.png" width="13" height="70"  ></th>

              <td align="Center" colspan="4" style="font-size:16px">Rapport Autobus</td>
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
        }
$codigoHTML.='
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

header('Content-Type: text/html; charset=ISO-8859-1');
// para evitar que se nos detenga la ejecucion del script (en caso de que el servidor tarde en responder) definimos un intervalo de 5 minutos de inactividad
ini_set('max_execution_time', 300);
include ("php/class.phpmailer.php");
//Recibir todos los parámetros del formulario

//$para  = "rafael.yepes@lacroixmeats.com";
$para = "autobus@lacroixmeats.com";
$para1 = "";
$para2 = "";
$para3 = "";
$para4 = "";
$para5 = "";

$asunto = "Rapport autobus global";
$mensaje = "Mensaje";

//$username = 'docs@lacroixmeats.com';
//$password = 'DoLa753?';
$username = 'lacroixnet@lacroixmeats.com';
$password = 'Yefa7832$';

$d2="Autob".$datmae;

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


include ('consolidado.php');


?>
