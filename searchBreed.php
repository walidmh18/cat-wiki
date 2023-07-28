<?php 

include('connection.php');


if (isset($_POST['breed'])) {

   $search = $_POST['breed'];


   $json = file_get_contents('https://api.thecatapi.com/v1/breeds/?limit=100');
   $obj = json_decode($json);
   
   $arrl = count($obj);
   $names = array();
   for ($i=0; $i < $arrl; $i++) { 
      array_push($names , strtolower($obj[$i]->name));
   }
   if (in_array(strtolower($_POST['breed']),$names ) ) {
      
      for ($i=0; $i < $arrl; $i++) { 
         if ( strtolower($_POST['breed']) == strtolower($obj[$i]->name)) {
            $id = $obj[$i]->id;
            $sql = "INSERT INTO searches (breed_id) VALUES ('$id')";
            $con->query($sql);
            header('Location:breed?name='.$obj[$i]->name.'&id='.$obj[$i]->id);
         }
      }
      echo $_POST['breed'];
   }else{
      header('Location:error.php');
      
   }



} else if (isset($_POST['breedM'])) {
   
   $search = $_POST['breedM'];


   echo $_POST['breedM'];
$json = file_get_contents('https://api.thecatapi.com/v1/breeds/?limit=100');
$obj = json_decode($json);

$arrl = count($obj);
$names = array();
for ($i=0; $i < $arrl; $i++) { 
   array_push($names , strtolower($obj[$i]->name));
}
if (in_array(strtolower($_POST['breedM']),$names ) ) {

   for ($i=0; $i < $arrl; $i++) { 
      if ( strtolower($_POST['breedM']) == strtolower($obj[$i]->name)) {
         $id = $obj[$i]->id;
         $sql = "INSERT INTO searches (breed_id) VALUES ('$id')";
         $con->query($sql);
         header('Location:breed?name='.$obj[$i]->name.'&id='.$obj[$i]->id);
      }
      
   }
   header('Location:error.php');
}


else {
   header('Location:error.php');
};



}else {
   header('Location:error.php');
};

?>