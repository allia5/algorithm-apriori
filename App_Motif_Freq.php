<?php
/*hello*/
include "Services.php";
/*hello world */
function fn1(){ 
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

/*----------------------------------------------------*/ 

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
    $table_item=$array_test;
    //var_dump($table_motif_freq);
    //var_dump($table_supp_motif_freq);
    

   
    

}

/*print_r("tableaux de ensemble  motif frèquants: \n");
var_dump($table_motif_freq);
print_r("tableaux  de support motif frèquants: \n");
    var_dump($table_supp_motif_freq);*/
 
return $array;


}
