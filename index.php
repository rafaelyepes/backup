<?php
//include ("./conectar4.php");
date_default_timezone_set("America/Montreal");
/*Calculando la fecha de Salida del Autobus*/
$fecha = new DateTime('NOW');
$hora= $fecha->format('H');
$minuto=$fecha->format('i');
$segundos=$fecha->format('s');
$fecha=$fecha->format('Y-m-d');
$horatotal= ($hora.":".$minuto.":".$segundos);
$ano = substr($fecha,2,2);
$mes = substr($fecha,5,2);
$dia = substr($fecha,8,2);
/*Calculando la fecha de Salida del Autobus*/

//$fecha="2018-09-10";
$bus="";
$chofer="";
$viaje="";
$documento="";
///////////////


$horadepart="00:00:00";
$horallegada="00:00:00";


if(isset($_GET["bus"])){
$bus=$_GET['bus'];
}

if(isset($_GET["fecha"])){
$fecha=$_GET['fecha'];
}

if(isset($_GET["chofer"])){
$chofer=$_GET['chofer'];
}

if(isset($_GET["documento"])){
$documento=$_GET['documento'];
}

if(isset($_GET["viaje"])){
$viaje=$_GET['viaje'];
}

/*
$consulta="SELECT * FROM autobusmae where docmae='$documento'";
$rs_tabla=mysqli_query($conexion, $consulta);

 for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
         $fecha = mysqli_result($rs_tabla,$i,"datmae");
         $bus = mysqli_result($rs_tabla,$i,"busmae");
         $chofer = mysqli_result($rs_tabla,$i,"chomae");
         $viaje = mysqli_result($rs_tabla,$i,"viamae");
         $horadepart=mysqli_result($rs_tabla,$i,"hr2mae");
         $horallegada=mysqli_result($rs_tabla,$i,"hr3mae");
    }

*/
include ("autentican.php");


?>

<!DOCTYPE html>
<html>
<head>
	<title>LacroixNet</title>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script type="text/javascript" src="./js/jquery.js"></script>

    <link rel="stylesheet" type="text/css" href="./QuaggaJS/css/modalcss.css">
    <link rel="stylesheet" type="text/css" href="./QuaggaJS/css/alert.css">


    <link rel="stylesheet" type="text/css" href="./QuaggaJS/css/styles.css?v=<?php echo(rand()); ?>" />
    <!--<link href="css/style.css" rel="stylesheet">-->


    <!--UTILIZADO PARA CONFIRM ALERT
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    -->
<script>

  /*carrousel jquery*/
  jQuery(document).ready(function($) {

        $('#myCarousel').carousel({
                interval: 5000
        });

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
      /*FIN carrousel jquery*/



        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});

function validachofer(){
  app.ValidaMembers('10014');
}
function validaautobus(){
  app.ValidaMembers('10656');
}
function empleado1(){
  app.ValidaMembers('10366');
}
function empleado2(){
  app.ValidaMembers('50097');
}
function empleado3(){
  app.ValidaMembers('41393');
}
function empleado4(){
  app.ValidaMembers('22006');
}
function empleado5(){
  app.ValidaMembers('41251');
}


function sonido(){

var audio = document.getElementById("audio");
audio.play();

}



function nombre(id){
numero=id;
app.consultaMember = {nummov:numero};
app.ConsultaMembers();
}

function validahora(horadepart, horallegada){

      if (horadepart == "00:00:00"){

         $("#depart").show();
         $("#arrive").hide();
         $("#rearrive").hide();
         $("#reouvrir").hide();
    //   $("#arrive").removeAttr("style").hide();
    //   $("#rearrive").removeAttr("style").hide();

         chofer  = document.getElementById("chofer").value;
         autobus = document.getElementById("bus").value;

         if (chofer == '' && autobus==''){
           $("#boton1").hide();
           $("#boton1").prop("disabled",true);
           $("#boton11").hide();
           $("#boton11").prop("disabled",true);
           $("#boton12").hide();
           $("#boton12").prop("disabled",true);
         }else{
           $("#boton1").show();
           $("#boton1").prop("disabled",false);
           $("#boton11").show();
           $("#boton11").prop("disabled",false);
           $("#boton12").show();
           $("#boton12").prop("disabled",false);
      //   $("#boton1").removeAttr("style").show();
         } //fin if chofer
           $("#interactive").show();
      }
      if (horadepart != "00:00:00"){
            $("#depart").hide();
            $("#boton1").hide();
            $("#boton11").hide();
            $("#boton12").hide();
            $("#boton1").prop("disabled",true);
            $("#boton11").prop("disabled",true);
            $("#boton12").prop("disabled",true);

            $(".upload1").hide();
            //  $("#boton3").prop("disabled",true);
            /*captura de la camara*/
            $("#interactive").hide();
            $("#reouvrir").hide();
           //  $("#arrive").hide();

          //   $("#rearrive").hide();


            if (horallegada == "00:00:00"){
             inicio = document.getElementById("horadepart").value;
             //$reg_time=strtotime($reg_time);
             fin = <?php echo json_encode($horatotal)?>;

             inicioMinutos = parseInt(inicio.substr(3,2));
             inicioHoras = parseInt(inicio.substr(0,2));

             finMinutos = parseInt(fin.substr(3,2));
             finHoras = parseInt(fin.substr(0,2));

             transcurridoMinutos = finMinutos - inicioMinutos;
             transcurridoHoras = finHoras - inicioHoras;

             if (transcurridoMinutos < 0) {
              transcurridoHoras--;
              transcurridoMinutos = 60 + transcurridoMinutos;
             }

             horas = transcurridoHoras.toString();
             minutos = transcurridoMinutos.toString();
             //alert (horas+"  "+minutos);
             if (horas <= 1){
              $("#arrive").show();
             }
             $("#rearrive").show();

            }else{ //horallegada si ya llego entra aqui
             $("#reouvrir").show();
             $("#depart").hide();
             $("#depart").removeAttr("style").hide();
             $("#arrive").hide();
             $("#arrive").removeAttr("style").hide();

             $("#rearrive").hide();
             $("#rearrive").removeAttr("style").hide();

             $("#boton1").hide();
           //  $("#boton1").removeAttr("style").hide();

             $("#boton11").hide();
           //  $("#boton11").removeAttr("style").hide();

             $("#boton12").hide();
           //  $("#boton12").removeAttr("style").hide();

             $(".upload1").hide();
             $(".upload1").removeAttr("style").hide();
            } // fin horallegada
      } //fin horadepart




} //fin validahora

function inicio(){
      var documentog = <?php echo json_encode($documento)?>;
      var horadepart = "00:00:00";
      var horallegada = "00:00:00";;
      //validahora(horadepart, horallegada);
}

function arrive(){
if(confirm('Vous confirmez que vous êtes arrivés à destination')){ /* si on clique sur ok */
  fecmov = document.getElementById("fecha").value;
        docmov = document.getElementById("documento").value;
        chofer = document.getElementById("chofer").value;
        autobus = document.getElementById("bus").value;
        crud="arrive";
        const formData = new FormData();
        formData.append('crud', crud);
        formData.append('fecmov', fecmov);
        formData.append('docmov', docmov);
        formData.append('autobus', autobus);
        formData.append('chofer', chofer);
        console.log("Arrive Autobus");
        axios({
                  method: 'POST',
                  url: 'api.php',
                  responseType: 'json',
                  data: formData
          })
       .then(function(response){
          console.log(response);
          app.clickMember = {};
          if(response.data.error){
            app.errorMessage = response.data.message;
          }
          else{
            document.getElementById("horallegada").value = response.data.horadepart;
            horallegada=response.data.horadepart;
            horadepart=document.getElementById("horadepart").value;
            validahora(horadepart, horallegada);
            //app.getAllMembers();
          }
        });
    } //vou voulez arrive



} //Fin arrive

function reouvrir(){
   if(confirm('Vous êtes arrivés à destination êtes vous sur de vouloir ajouter des employés')){ /* si on clique sur ok */
        fecmov = document.getElementById("fecha").value;
        docmov = document.getElementById("documento").value;
        chofer = document.getElementById("chofer").value;
        autobus = document.getElementById("bus").value;
        crud="reouvrir";
        const formData = new FormData();
        formData.append('crud', crud);
        formData.append('fecmov', fecmov);
        formData.append('docmov', docmov);
        formData.append('autobus', autobus);
        formData.append('chofer', chofer);
        console.log("Rearrive Autobus");
        axios({
                  method: 'POST',
                  url: 'api.php',
                  responseType: 'json',
                  data: formData
          })
       .then(function(response){
          console.log(response);
          app.clickMember = {};
          if(response.data.error){
            app.errorMessage = response.data.message;
          }
          else{
            document.getElementById("horadepart").value = response.data.horadepart;
            document.getElementById("horallegada").value = response.data.horadearrive;
            horadepart=response.data.horadepart;
            horallegada=document.getElementById("horallegada").value;
            validahora(horadepart, horallegada);
            //app.getAllMembers();
          }
        });


   }
} //Fin reouvrir

function depart(){
   docmov =(document.getElementById("documento").value).trim();
   if (docmov == ""){
    //alert ("0");
   }else{
     if(confirm("Vous avez enregistré tous les employés qui sont dans l'autobus et êtes prêt à partir?")){ /* si on clique sur ok */
        fecmov = document.getElementById("fecha").value;
        //docmov = document.getElementById("documento").value;
        chofer = document.getElementById("chofer").value;
        autobus = document.getElementById("bus").value;
        crud="depart";
        const formData = new FormData();
        formData.append('crud', crud);
        formData.append('fecmov', fecmov);
        formData.append('docmov', docmov);
        formData.append('autobus', autobus);
        formData.append('chofer', chofer);

        console.log("Depart Autobus");
        axios({
                  method: 'POST',
                  url: 'api.php',
                  responseType: 'json',
                  data: formData
          })
         .then(function(response){
          console.log(response);
         // app.clickMember = {};
          if(response.data.error){
            app.errorMessage = response.data.message;
          }
          else{
            document.getElementById("horadepart").value = response.data.horadepart;
            horadepart=response.data.horadepart;
            horallegada=document.getElementById("horallegada").value;

            app.showAddimagen2 = "true";
            console.log("Genernado PDF-1");
            const formData = new FormData();
            formData.append('docmov', docmov);
            formData.append('chomae', chofer);
            //2do axios
            axios({
                  method: 'POST',
                  url: 'index01pdf.php',
                  responseType: 'text',
//                responseType: 'json',
                  data: formData
            })
            .then(function(response){
              console.log("Respuesta PDF-2");
              console.log(response);
              app.showAddimagen2 = false;
              validahora(horadepart, horallegada);
              //alert ("Respuesta");
            })
            .catch(function (error) {
              //alert ("Error");
              alert ("Error-Courriel");
              console.log("Genernado PDF-3");
              app.showAddimagen2 = false;
              // handle error
              console.log(error);
              validahora(horadepart, horallegada);
            }); //fin 2di=o axios
          }//fin if principal
          }); //fin axios principal
    } //vou voulez depart
    } //fin if vacios
}  //fin funcion depart

function rearrive(){
   if(confirm("Voulez-vous ajouter un/des employé(s)")){ /* si on clique sur ok */
        fecmov = document.getElementById("fecha").value;
        docmov = document.getElementById("documento").value;
        chofer = document.getElementById("chofer").value;
        autobus = document.getElementById("bus").value;
        crud="rearrive";
        const formData = new FormData();
        formData.append('crud', crud);
        formData.append('fecmov', fecmov);
        formData.append('docmov', docmov);
        formData.append('autobus', autobus);
        formData.append('chofer', chofer);
        console.log("Rearrive Autobus");
        axios({
                  method: 'POST',
                  url: 'api.php',
                  responseType: 'json',
                  data: formData
          })
       .then(function(response){
          console.log(response);
          app.clickMember = {};
          if(response.data.error){
            app.errorMessage = response.data.message;
          }
          else{
            document.getElementById("horadepart").value = response.data.horadepart;
            horadepart=response.data.horadepart;
            horallegada=document.getElementById("horallegada").value;
            validahora(horadepart, horallegada);
            //app.getAllMembers();
          }
        });
    } //vou voulez depart

}  //fin funcion depart


//inicio de las funcion JQUERY
function Cerrarseccion(){
alert ("0");

}


$(document).ready(function(){
$(".img2lc").click(function() {
  alert ("0");
  window.location.href = "../autobus/menun.php";
});


$( "#camara" ).click(function() {
  $("#respuesta").hide();
});

$("#boton1xx" ).click(function() {
 // alert ("0");
//    app.showAddModal = "true";
//    app.showDebarqueModal = "true";
});


$("#botonx1" ).click(function() {
//  alert ("0");
});


});  //fin del document read ---ADICIONA INFORMACION AL DOCUMENTO

function botonx1(){
 app.newMember.sexmov= "Homme";
 app.showAddModal = "true";
}

function botonxx1(){
 app.newMember.sexmov= "Femme";
 app.showAddModal = "true";
}

function botonxx2(){
 app.newMember.codmov="ZZZZZ";
 app.showAddModalex = "true";
}

function botonx2(){
 app.showAddimagen = "true";

}

function cancelar(){
  window.location="../autobus/index.php";
}

var $node="hola";

</script>

<style>

.cerrar2 {
/*float: right;*/
float: right;
margin-right: 15px;
}


.classegris{
background-color: #F6CED8;

}
.borderno{
border: none;

}

#respuesta{
font-size: 15px;
padding-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
text-align: center;
}


.upload1img {

    min-height: 400px;

    background-size: cover;
    background-position: center;


    /*
    width: 250px;
    height: 280px;
    background: url(./img/acepter.png);
    background-repeat: no-repeat;
    overflow: hidden;
    border-style: none;
    */
    width: 250px;
    height: 450px;
    background: url(./img/crochet.png);
    background-repeat: no-repeat;
    overflow: hidden;
    border-style: none;
}

.form-img {
    margin-left: 30px;
    width: 210px;
    height: 230px;
    background-repeat: no-repeat;
    overflow: hidden;
    border-style: none;
}



div.upload1 {
    width: 95px;
    height: 38px;
    background: url(./img/barcode.jpg);
    background-repeat: no-repeat;
    overflow: hidden;
}

div.upload1 input {
    display: block !important;
    width: 95px;
    height: 38px;
    opacity: 0 !important;
    overflow: hidden !important;
}


.btn-lg1{
width: 65px;
height: 63px;

}


#audio{
display: none
}

.warning{
font-size: 16px;
}

.danger1{
font-size: 16px;
}

.formcmodal {
height: 70px;
font-size:25px;
}

.formgroup {
font-size: 22px;
}


.img2{
margin-left: 0px;
margin-right: 0px;
width: 100%;
max-width: 100%;
height: 65px;
}

.img2autobus{
height: 65px;
}

.img2lc{
margin-left: 0px;
margin-right: 0px;

max-width: 38px;
width: 38px;
height: 66px;
max-height: 66px;

}


@media all and (min-width: 604px) and (max-width: 750px){






}
</style>
</head>
<body onload="inicio()">
<!--
<div class="container-fluid">
-->
<div class="container-fluid" id="QR-Code" style="background-color: ;">

      <br>
      <div class="row" >

      <div class="col-xs-3 col-sm-1  col-md-1" >
      <img class="img2lc" onClick("Cerrarseccion()") src="./img/logolacroixform.png" alt="Logo Lacroix">
      </div>

      <div class="col-xs-6 col-sm-9  col-md-9 img2autobus" style="text-align: center; ">
      <h1 class="img2autobus">Autobus</h1>
      </div>

      <div class="col-xs-3 col-sm-2  col-md-2" style="text-align: center; ">
      <img class="img2"  src="./img/autobus.png" alt="Autobus" onClick="cancelar()">   </div>

      </div>


      <!--Linea: depart-arrive-reovrir-ajouter-->
      <div class="row">


       <div class="col-xs-3 col-md-3" style="text-align: center">
       <button  class="btn btn-warning center-block"  onClick="arrive()" id="arrive"><span class="glyphicon glyphicon-home danger1"></span>Arrivé</button>
       </div>

       <div class="col-xs-5 col-md-5" style="text-align: center">
       <button  id="depart" class="btn btn-primary  center-block confirm" onClick="depart()"><span class="glyphicon glyphicon-ok danger1"></span>Départ</button>
       </div>

      <!--onClick="reouvrir()"-->
      <div class="col-xs-2 col-md-2" style="text-align: center">
      <button   class="btn btn-info center-block"  onClick="reouvrir()" id="reouvrir"><span class="glyphicon glyphicon-barcode  btn-info"></span>Re-Ouvrir</button>
      </div>

      <div class="col-xs-3 col-md-3" style="text-align: center">
      <button   class="btn btn-danger center-block"  onClick="rearrive()" id="rearrive"><span class="glyphicon glyphicon-barcode danger1"></span>Ajouter</button>
      </div>




      </div>
      <!--FIN Linea: depart-arrive-reovrir-ajouter-->
      <!--FIN Linea: depart-arrive-reovrir-ajouter-->
      <!--FIN Linea: depart-arrive-reovrir-ajouter-->






       <div class="row">
          <div class="col-xs-5 col-md-5" style="text-align: right;  margin-left: 8px;">
          <input class="borderno" id="bus" style="text-align: center;" name="bus" ></input>
          </div>

          <div class="col-xs-5 col-md-5" style="text-align: left;">
          <input class="borderno" value="<?php echo ($chofer)?>" id="chofer" style="text-align: center;" name="chofer"></input>
          </div>
       </div>

<!--
        <div class="col-xs-12 col-md-12" style="padding: 0; border-top: 30px;">

        <div class="col-xs-9 col-md-9" style="padding-left: 0px; padding-bottom: 0px; text-align: center; border-style: none; width: 100%">
        <span  id="respuesta" style="display: none; text-align: center">xxx</span>
        </div>
        </div>
-->

         <section id="container" class="container" style="margin-top: -5px;">
         <div class="controls" style="display: none" >
            <fieldset class="reader-config-group" >
                <label>
                    <span>Barcode-Type</span>
                    <select name="decoder_readers">
                        <option value="code_128" >Code 128</option>
                        <option value="code_39">Code 39</option>
                        <option value="code_39_vin">Code 39 VIN</option>
                        <option value="ean" selected="selected">EAN</option>
                        <option value="ean_extended">EAN-extended</option>
                        <option value="ean_8">EAN-8</option>
                        <option value="upc">UPC</option>
                        <option value="upc_e">UPC-E</option>
                        <option value="codabar">Codabar</option>
                        <option value="i2of5">Interleaved 2 of 5</option>
                        <option value="2of5">Standard 2 of 5</option>
                        <option value="code_93">Code 93</option>
                    </select>
                </label>
                <label>
                    <span>Resolution (width)</span>
                    <select name="input-stream_constraints">
                        <option value="320x240">320px</option>
                        <option selected="selected" value="640x480">640px</option>
                        <option value="800x600">800px</option>
                        <option value="1280x720">1280px</option>
                        <option value="1600x960">1600px</option>
                        <option value="1920x1080">1920px</option>
                    </select>
                </label>
                <label>
                    <span>Patch-Size</span>
                    <select name="locator_patch-size">
                        <option value="x-small">x-small</option>
                        <option value="small">small</option>
                        <option selected="selected" value="medium">medium</option>
                        <option value="large">large</option>
                        <option value="x-large">x-large</option>
                    </select>
                </label>
                <label>
                    <span>Half-Sample</span>
                    <input type="checkbox" checked="checked" name="locator_half-sample" />
                </label>
                <label>
                    <span>Workers</span>
                    <select name="numOfWorkers">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option selected="selected" value="4">4</option>
                        <option value="8">8</option>
                    </select>
                </label>
                <label>
                    <span>Camera</span>
                    <select name="input-stream_constraints" id="deviceSelection">
                    </select>
                </label>
                <label >
                    <span>Zoom</span>
                    <select name="settings_zoom"></select>
                </label>
                <label >
                    <span>Torch</span>
                    <input type="checkbox" name="settings_torch" />
                </label>
            </fieldset>
        </div> <!--FIN DIV CONTROL-->



      <!--Espacio de captura de la camara dentro del div -->
      <!--./QuaggaJS/css/styles.css -->
      <div class="row anchop" style="margin-top: -0px; " >
      <div class="col-sm-12 col-xs-12 col-md-12">
      <div class="col-sm-10 col-xs-9 col-md-9">
      <div id="interactive" class="viewport">

      </div>
      </div>

      <div class="col-sm-2 col-xs-3 col-md-3" id="slider-thumbs" >
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">

                </ul>
            </div>
          </div>
      </div>





       <!--Espacio de mostrar la foto tomada -->
<!--   <div id="result_strip" style="padding: 0;"> -->

        <!--Quitado slider horizontal
       <div class="col-sm-12 col-xs-12 col-md-12" style="border: 20px;">
       <div id="result_strip" style="padding: 0;">
        <ul class="thumbnails"></ul>
        <ul class="collector"></ul>
       </div>
       </div>
       -->
    </section>
     <div class="row" style="margin-top: -20px">
          <div class="col-sm-4 col-xs-4 col-md-4" style="padding-left: -40px;">
          <button id="boton1" onClick="botonx1()" class="btn btn-success" style="width: 123px; font-size: 11px;"><span  class="glyphicon " </span>Nouvel employé H.</button>
          </div>



       <div class="col-sm-4 col-xs-4 col-md-4">
       <button id="boton11" onClick="botonxx1()" class="btn btn-warning
       " style="width: 123px; font-size: 11px;"><span  class="glyphicon "></span>Nouvel employé F.</button>
       </div>

       <div class="col-sm-4 col-xs-4 col-md-4"  >
       <button id="boton12" onClick="botonxx2()" class="btn btn-primary center-block" style="width: 123px; font-size: 11px;"><span  class="glyphicon " ></span>Employé existant.</button>
       </div>



       </div>




  <script src="./QuaggaJS/vendor/jquery-1.9.0.min.js" type="text/javascript"></script>



  <!--Utilizado para scanner fijo
  <script src="./QuaggaJS/js/file_input.js" type="text/javascript"></script>
  -->

  <!--Utilizado para scanner automatico
  <script src="./QuaggaJS/js/live_w_locator.js" type="text/javascript"></script>
 -->



    <!--Aqui se encuentra el enlace A el lector de codigo de barras -->
    <!--
    <script src="QuaggaJS/js/adapter-latest.js" type="text/javascript"></script>
    <script src="QuaggaJS/js/live_w_locator.js" type="text/javascript"></script>
    -->

    <!--FIN DEL CONTROLADOR QUAGGAJS   -->





	<div  id="members">
	<div class="col-md-12">
			<div style="display: none" class="alert alert-danger text-center" v-if="errorMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
			</div>

			<div style="display: none" class="alert alert-success text-center" v-if="successMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-ok"></span> {{ successMessage }}
			</div>

      <div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<th class="warning">Item {{ contadorgr }}</th>
					<th class="warning">Numéro</th>
					<th class="warning">Prénom de l'employé</th>
					<th class="warning">Nom de l'employé</th>
					<th class="warning">Genre</th>
					<th class="warning">Statut</th>
          <th class="warning">Action</th>
          <th class="warning">Action</th>
				</thead>
				<tbody>
            <!--
            <tr v-for="(member array in sortedArray, index) in members">
            -->
    				<tr v-for="(member, index) in members" >
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.row_number }}</td>
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.nummov }}</td>
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.nommov }}</td>
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.apemov }}</td>
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.sexmov }}</td>
            <td v-bind:class="{'classegris': index+1 == 1, danger1 }">{{ member.stamov }}</td>
						<td v-bind:class="{'classegris': index+1 == 1, danger1 }" class="trans text-center">
						<button id="boton2"  class="btn btn-success btn-responsive btninter" @click="showEditModal = true; selectMember(member);" v-if="member.sexmov"><span class="glyphicon glyphicon-edit danger1" ></span> Modifier</button>
            </td>
            <td class="trans text-center">
						<button v-if="member.stamov == 'Embarqué'" id="boton3" class="btn  btn-danger  btn-tt" @click="showDebarqueModal = true; selectMember(member);"><span class="glyphicon glyphicon-trash btn-success"></span>Débarqué</button>

            <button v-if="member.stamov == 'Débarqué'" id="boton3" class="btn btn-info btn-tt" @click="showDebarqueModal2 = true; selectMember(member);"><span class="glyphicon"></span>Embarque</button>



						</td>
					</tr>
				</tbody>
			</table>
		    </div>
        </div>
           <!--
           <pre>
            {{ $data }}
           <pre>
					 -->

        <?php include('modal.php'); ?>
    </div>
    </div>
<!--

    <div class="panel panel-primary" >
-->


    <div style="display: none " class="panel panel-primary" style="margin:20px;">

    <div class="panel-heading">
            <h3 class="panel-title">R.F</h3>
    </div>
    <div class="panel-body">


    <div class="col-md-12 col-sm-12" >

        <div class="row">
          <div class="col-sm-6 form-group">
            <label>Document No</label>
            <input type="text"  class="form-control" id="documento" value="<?php echo ($documento)?>" name="documento" readonly>
            <span class="glyphicon glyphicon-ok form-control-feedback"></span>
          </div>
          <div class="col-sm-6 form-group">
            <label>Date</label>
            <input type="text" class="form-control" value="<?php echo ($fecha)?>" id="fecha" name="fecha" readonly>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-4 form-group">
            <label>No</label>
            <input type="text" placeholder="" class="form-control" value="<?php echo ($viaje)?>" id="viaje" name="viaje" readonly>
          </div>
          <div class="col-sm-4 form-group">
            <label>Validacion No</label>
            <input type="text" placeholder="" class="form-control" value="0" id="validacion" name="validacion" readonly>
          </div>
          <div class="col-sm-4 form-group">
           <input type="text" onclick="validachofer()" value="Chofer"/>
           <input type="text" onclick="validaautobus()" value="Autobus"/>
           <input type="text" onclick="empleado1()" value="Empleado-1"/>
           <input type="text" onclick="empleado2()" value="Empleado-2"/>
           <input type="text" onclick="empleado3()" value="Empleado-3"/>
           <input type="text" onclick="empleado4()" value="Empleado-4"/>
           <input type="text" onclick="empleado5()" value="Empleado-5"/>
          </div>

          <div class="col-sm-4 form-group">
          <input type="text" placeholder="" class="form-control" value="00:00:00" id="horadepart" name="horadepart" readonly>
          <input type="text" placeholder="" class="form-control" value="00:00:00" id="horallegada" name="horallegada" readonly>
          </div>


        </div>
      </div>


    </div>
</div>

<div class="cerrar2">
 <a href="cerrar.php"><img id="span1" class="imglacroixyz" src="./img/logout.png" style="width: 80%; height: 75%"; align="right"></a>
</div>
<div class="controls" style="margin-left: 30%;">
<audio id="audio" controls>
<source type="audio/wav" src="beep.mp3">
</audio>

</div>
</div>
<script src="dist/adapter-latest.js" type="text/javascript"></script>
<script src="dist/quagga.min.js" type="text/javascript"></script>
<script src="./QuaggaJS/js/live_w_locator.js?v=<?php echo(rand()); ?>" type="text/javascript"></script>
<script src="./js/alert.js"></script>
<script src="./js/vue.js"></script>
<script src="./js/axios.js"></script>
<script src="./js/app.js?v=<?php echo(rand()); ?>"></script>
</body>
</html>
