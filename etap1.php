<?php
include "Services.php";
session_start();
$_SESSION['sigma']=$_POST['sigma'];

$prop=$_POST['prop'];
$table=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$text=commande($prop,$table);

drop_table();
create_table($text);
$div='<table class="table">
<thead>
  <hr>';
for($i=0;$i<$prop;$i++){
    $div.='<th scope="col"> <input id="'.$i.'" type="number" max="1" min="0" aria-label="First name"  class="form-control"></th>';

  }
  $div.='<th><button class="btn-success" id="add">add</button></th>';
  $div.='</hr></thead></table>';




$div.='<table class="table">
<thead>
  <hr>';
  


  for($i=0;$i<$prop;$i++){
    $div.='<th scope="col">'.$table[$i].'</th>';

  }

  $div.='</hr></thead><tbody id="formelle"></tbody></table><button class="btn btn-dark"  id="voire">voir le resultat</button>';
echo $div;












?>