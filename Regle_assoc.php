<?php

include "Services.php";
include "get_motif.php";
include "get_supp.php";

error_reporting(0);
$table_m_frequant=m_frequant();
$table_sup_frequant=m_support();
$matrix=array();
$matrix2=array();
$array_contigut=array();
$array_contigut2=array();
$taille_max=0;
$c=0;
$c2=0;
/*fair un matrix */

foreach($table_m_frequant as $array){
    for($o=0;$o<count($array);$o++){
        $array_contigut[$c]=$array[$o];
        $c++;
    }
}
foreach($table_sup_frequant as $array){
    for($o=0;$o<count($array);$o++){
        $array_contigut2[$c2]=$array[$o];
        $c2++;
    }
}
//echo count($array_contigut);//json_encode($array_contigut);
//echo  count($array_contigut2);//json_encode($array_contigut2);

$taille_max=get_max($array_contigut);

for($i=0;$i<count($array_contigut);$i++){
    for($j=0;$j<count($array_contigut);$j++){
    if($i==$j or test_inclut2($array_contigut[$i],$array_contigut[$j])==false){
        $matrix[$array_contigut[$i]][$array_contigut[$j]]=0;

    }else if(strlen($array_contigut[$i])!=$taille_max or strlen($array_contigut[$j])!=$taille_max){
        $matrix[$array_contigut[$i]][$array_contigut[$j]]=1;
        $inx_sup1=get_index($array_contigut[$i].$array_contigut[$j],$array_contigut);
        $inx_sup2=get_index($array_contigut[$i],$array_contigut);
        $inx_sup1=$array_contigut2[$inx_sup1];
        $inx_sup2=$array_contigut2[$inx_sup2];
        $supp_final=($inx_sup1)/($inx_sup2);
        $matrix2[$array_contigut[$i]][$array_contigut[$j]]=$supp_final;


    }

    }

}
/*display les regle */
$tabe='<table class="table">
<thead>
  <tr>
    <th scope="col">rules</th>
    <th scope="col">confidence</th>
    <th scope="col">remarque</th>
    
  </tr>
</thead>
<tbody>';
$remarque="none";
for($i=0;$i<count($array_contigut);$i++){
    for($j=0;$j<count($array_contigut);$j++){
      if($matrix[$array_contigut[$i]][$array_contigut[$j]]==1){
         // echo $array_contigut[$i]."=>".$array_contigut[$j]." // confidence :".($matrix2[$array_contigut[$i]][$array_contigut[$j]]*100)."%<br>";
         if($matrix2[$array_contigut[$i]][$array_contigut[$j]]  >= $_SESSION['sigma']){
          $remarque ="oui";
        }
          $tabe.='<tr>
          <th>'.$array_contigut[$i]."=>".$array_contigut[$j].'</th>
          <td>'.($matrix2[$array_contigut[$i]][$array_contigut[$j]]*100).'%</td>
          <td>'.$remarque.'</td>
          
        </tr>';

          
      }

      $remarque = "none";

    }
}
//echo json_encode($matrix2);

//echo get_index("EBC",$array_contigut);

$tabe.=' </tbody>
</table>';
echo $tabe;



?>