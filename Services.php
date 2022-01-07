<?php
function connexion_db()
{
    $cnx = new mysqli('localhost:3307', 'root', '', 'motif');
    //mysqli_query($cnx,"SET NAMES 'UTF8';");
    $cnx->autocommit(FALSE);
    return $cnx;
}
function enregistre_data($data){
    $con = connexion_db();
    if ($con) {
        $cmd="insert into test_apriori values(0,".$data.")";
        
        $inst=$con->query($cmd);
        if($inst){
            return 1;
        }else{
            return 0;
        }
    } 
}
function get_data(){
    $con=connexion_db();
    $string = "SELECT * FROM test_apriori ";
            //print_r($string);
            $sth = $con->prepare($string);
            $sth->execute();
            $resultSet = $sth->get_result();
            $result = $resultSet->fetch_all();
            return json_encode($result);
}
function drop_table(){
    $con = connexion_db();
    if ($con) {
        $cmd="drop table test_apriori";
        $inst=$con->query($cmd);
        if($inst){
            return 1;
        }else{
            return 0;
        }
    }
}
function commande($nb_prop,$alpha){
    $text='';
    $i=0;
    for($i<0;$i<$nb_prop;$i++){
        if($i==0){
            $text.=$alpha[$i].' boolean';
        }else{
            $text.=','.$alpha[$i].' boolean';
        }
       

    }
    return $text;

}
function create_table($text){
    $con = connexion_db();
    if ($con) {
        $cmd="create table test_apriori (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,$text) ";
        $inst=$con->query($cmd);
        if($inst){
            return 1;
        }else{
            return 0;
        }
    }
}
function Prop_item()
{
    $items = [];
    $con = connexion_db();
    if ($con) {
        $sth = $con->prepare("SELECT *
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME =N'test_apriori'");
        $sth->execute();
        $resultSet = $sth->get_result();
        $result = $resultSet->fetch_all();
        foreach ($result as $row) {
            if ($row[3] != 'id') {
                array_push($items, $row[3]);
            }
        }
        return $items;
    }
    return 0;
}

function get_count_objet()
{
    $con = connexion_db();
    if ($con) {
        $sth = $con->prepare("SELECT *
        FROM test_apriori");
        $sth->execute();
        $resultSet = $sth->get_result();
        $result = $resultSet->fetch_all();
        return count($result);
    }
}

function Get_objet()
{
    $con = connexion_db();
    if ($con) {
        $sth = $con->prepare("SELECT *
        FROM test_apriori");
        $sth->execute();
        $resultSet = $sth->get_result();
        $result = $resultSet->fetch_all();
        json_encode($result);
    }
}


function calcule_supp_items($table, $count_obj)
{
    $i = 0;
    $j = 0;
    $support = array();
    $con = connexion_db();
    $table = json_decode($table);
    if (strlen($table[0]) == 1) {
        for ($i = 0; $i < count($table); $i++) {
            $string = "SELECT * FROM test_apriori where " . $table[$i] . "=1";
            //print_r($string);
            $sth = $con->prepare($string);
            $sth->execute();
            $resultSet = $sth->get_result();
            $result = $resultSet->fetch_all();
            array_push($support, (count($result) / $count_obj));
        }
    } else {
        
        
        $p = 0;
        $i=0;
        /*var_dump($table);*/
        for ($i = 0; $i <count($table); $i++) {
            $mot=" ";
            $table_split = str_split($table[$i]);
            /*var_dump($table_split);*/
            for ($p = 0; $p <count($table_split); $p++) {
            /*while($p <count($table_split)){ */
                $f=$p;
                
                if ($f  == 0) {
                    $mot =$mot." ".$table_split[$p]." =1 ";
                    
                } else {
                    
                    $mot =$mot." and ".$table_split[$p]." =1 ";
                    
                }
                /*echo $mot.$p;*/
                
            }
            /*echo $mot;*/
            $string = "SELECT * FROM test_apriori where " . $mot . "";
                $sth = $con->prepare($string);
                $sth->execute();
                $resultSet = $sth->get_result();
                $result = $resultSet->fetch_all();
                array_push($support, (count($result) / $count_obj));
                
            
            
        }
        
    }
    return $support;
}


function elemeination($table_supp,$sigma,$table_item){
$i=0;
$tab_index=array();
for($i=0;$i<count($table_supp);$i++){
    if($table_supp[$i]<$sigma){
        array_push($tab_index,$i); 

}
}
return $tab_index;

}

function detect_lettre($array_item1,$array_item2){
     $array1=str_split($array_item1);
     $array2=str_split($array_item2);
     //var_dump($array1);
     //var_dump($array2);
     
     $bool=true;
     $i=0;
     $r=0;
     /*while($bool==false and count($array2)>$r){
        $bool=in_array($array2[$r],$array1);
        
        $r++;
     }*/
     while($bool==true and count($array2)>$i /*and $r<(count($array2))*/){
        $bool=in_array($array2[$i],$array1);
        
        $i++;
     }
     
     
     return $array2[$i-1];
     
}
function test_inclu($table1,$table2){
    //$array1=str_split($table1);
    if($table1==array()){
        return false;
    }
    if(in_array($table2,$table1)){
        return true;
    }
    $array1=array();
    
    $array2=str_split($table2);
    $bool=true;
    $i=0;
    for($j=0;$j<count($table1);$j++){ 
        $array1=str_split($table1[$j]);
        $bool=true;
    while($bool==true and count($array2)!=$i){
       $bool=in_array($array2[$i],$array1);
       $i++;
    }
    
   
    if($bool==true){
        return $bool;
    }
    
    $i=0;
    
    $array1=array();
}
    return $bool;
   /* $bool=false;
    $array1=str_split($table1);
   $s=0;
    for($i=0;$i<count($array1);$i++){
        $tab=str_split($array1[$i]);
        for($j=0;$j<count($table2);$j++){
           if(in_array($table2[$j],$tab)){
               $s++;
           }
           if($s==count($table2)){
               return true;
           }
        }
        $s=0;
    }
    return $bool;*/
  
}
function combainaison($table_item){
    $array=array();
    //var_dump($table_item);
    for($i=0;$i<count($table_item);$i++){
       
        for($j=$i+1;$j<count($table_item);$j++){
            
           //var_dump($table_item[]);
            
            $lettre=detect_lettre($table_item[$i],$table_item[$j]);
            //var_dump($array);
            //var_dump($table_item[$i].$lettre);
            //var_dump(test_inclu($array,$table_item[$i].$lettre));
            if(in_array($table_item[$i].$lettre,$array)==false  and test_inclu($array,$table_item[$i].$lettre)==false ){ 
               
                array_push($array,$table_item[$i].$lettre);
            }
        }
    }
    //var_dump($array);
    return $array;
     
}

function test_inclut2($tab1,$tab2){
    $div1=str_split($tab1);
    $div2=str_split($tab2);
    $test=true;
    $count=0;
while($test==true and $count <count($div1) ){
        if(in_array($div1[$count],$div2)){
            $test= false;
        }else{
            $test=true;
        }
        $count++;
    }
    return $test;



}
function get_max($table){
    $len =0;
    for($i=0;$i<count($table);$i++){
        $len=strlen($table[$i]);
        
    }
    return $len;

}
function get_index($chain,$motif_freq){
    $bool =true;
    $c=0;
    $tab2=str_split($chain);
    for($i=0;$i<count($motif_freq);$i++){
        
       $tab1=str_split($motif_freq[$i]);
      
       while($bool==true and $c!=strlen($chain) and  in_array($tab2[$c],$tab1)  ){
           $c++;
       }
       if($c==strlen($chain) and $bool=true){
           return $i;
       }
       $c=0;
    }

}




