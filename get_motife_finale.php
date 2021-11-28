<?php
include "Services.php";
session_start();
$sigma=$_SESSION['sigma'];
$index=0;$taille_champ=0;
$count_objet=get_count_objet();
$table_item=array();
/*$table_mot_supprimer=array();*/
/*$table_secondaire=array();*/
$table_supp=array();
$table_motif_freq=array();
$table_supp_motif_freq=array();
$array=array();
$array_suppretion=array();
$c=0;

/*----------------------------------------------------*/
$moule='';
$array_test=array();
$table_item=Prop_item();
/*$table_secondaire=$table_item;*/
/*$table_item=json_decode($table_item);*/
/*echo $table_item.'/'.json_encode($table_supp);*/
while($table_item!=array()){
    $table_supp = calcule_supp_items(json_encode($table_item),$count_objet);
    array_push($array,$table_item);
    array_push($array,$table_supp);
    
    $tab_index=elemeination($table_supp,$sigma,$table_item);
    //var_dump($table_supp);
   //var_dump($tab_index);
    $in=0;
    for($in=0;$in<count($tab_index);$in++){
        //array_push($table_mot_supprimer,$table_item[$tab_index[$in]]);
        array_push($array_suppretion,$table_item[$tab_index[$in]]);
         unset($table_supp[$tab_index[$in]]);  
         unset($table_item[$tab_index[$in]]);
         
         //\array_splice($table_item,$tab_index[$in],1);
         //\array_splice($table_supp,$tab_index[$in],1);

    }
    
   for($in=0;$in<count($tab_index);$in++){
        //array_push($table_mot_supprimer,$table_item[$tab_index[$in]]);
        
         //unset($table_supp[$tab_index[$in]]);  
         //unset($table_item[$tab_index[$in]]);
         
         array_splice($table_item,$tab_index[$in],0);
         array_splice($table_supp,$tab_index[$in],0);

    }
    $moule.='<div id="etap3" class="container">
    <div id="graph" class="container" ">
    <canvas style="height: 10%;" id="actuel'.$c.'" class="actuel'.$c.'" width="400" height="400"></canvas>
    </div>
    <div id="resu" style="display: flex; " class="container">
     <div class="container"><div class="alert alert-info" role="alert">
  les items acceptè il est :'.json_encode($table_item).'
</div></div>
     <div class="container"><div class="alert alert-danger" role="alert">
  les items sont supprimer : '.json_encode($array_suppretion).'
</div></div>
    </div>

</div>';
    //var_dump($table_supp);
    array_push($table_motif_freq,$table_item);
    array_push($table_supp_motif_freq,$table_supp);
    /*--------------*/
   /* $index=$taille_champ;
    $taille_champ=$taille_champ-count($table_motif_freq);*/
    /*-----*/
    /*$table_item=array();
    $table_supp=array();*/
    /*----------- combinaison */
    
    $array_test=combainaison($table_item);
    $table_supp=array();
    $table_item=array();
    $array_suppretion=array();
    $table_item=$array_test;
    //var_dump($table_motif_freq);
    //var_dump($table_supp_motif_freq);
    
$c++;
   
    

}

/*print_r("tableaux de ensemble  motif frèquants: \n");
var_dump($table_motif_freq);
print_r("tableaux  de support motif frèquants: \n");
    var_dump($table_supp_motif_freq);*/
 
$moule.='<div  class="container"><div class="alert alert-info" role="alert">les motifs frèquants il est : '.json_encode($table_motif_freq).'</div></div>';
echo $moule;


?>