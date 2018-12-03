<?php
include ("./conectar4.php");
$fechai="2018-09-01";
$fechaf="2019-12-31";

$i=0;
$sql="SELECT * FROM autobusmae WHERE  datmae>='$fechai' and datmae<='$fechaf' order by id DESC";
$query = $conn->query($sql);
while($row = $query->fetch_array()){
   $idb        = $row['id'];
   $control01  = $row['docmae'];
   $control02  = $row['busmae'];
   $control06  = $row['chomae'];
   $control07  = $row['reg_time'];
   $control09  = $row['hr1mae'];
   $control08  = $row['hr2mae'];
   $control09  = $row['datmae'];
   $i=$i+1;
   echo '<tr id="mostrardatos" class="member">';
   echo '<td align="center" width="1%"><input class="form-control" type="hidden" id="poid'.$i.'"  name="mitextoid[]"  value="'.$idb.'"/></td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid29'.($i).'" readonly   value="'.$control09.'"/>
   </td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid20'.($i).'" readonly   value="'.($control01).'"/>
   </td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid21'.($i).'" readonly   value="'.($control02).'"/>
   </td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid21'.($i).'" readonly   value="'.($control02).'"/>
   </td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid22'.($i).'"  readonly  value="'.($control07).'"/></td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid23'.($i).'"  readonly value="'.($control09).'"/></td>';
   echo '<td align="left"><input class="form-control" type="text"  style="width: 100%;  min-width: 100%; align: left;"  id="poid24'.($i).'" readonly  value="'.($control08).'"/></td>';
   echo '<td align="center"><button type="button" border="0" id="poid27e'.($i).'" onclick="consultar(this.id)" class="button" value=""><img width="90%" height="11%" src="./img/editer.png"></button></td>';
   echo '</tr>';
  }
?>
