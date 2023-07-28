<?php 
include('../connection.php');


$sql = 
"SELECT     breed_id
FROM        searches
GROUP BY    breed_id
ORDER BY    COUNT(breed_id) DESC
LIMIT       10
;";

$mostSearched = array();
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_assoc($result)) {
   array_push($mostSearched, $row['breed_id']);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Catiki - Most searched breeds</title>
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="../style.css">
</head>
<body>
<header>
      <a href="../" class="navLogo">
         <img src="../images/CatwikiLogo.svg" alt="logo">
      </a>
   </header>

   <section>
      <h1>Most searched breeds:</h1>

      <div class="breedsContainer">
      .
      <?php
         $breedsCount = count($mostSearched);
         // echo $breedsCount;
         for ($i=0; $i < $breedsCount; $i++) { 
            $breedJson = file_get_contents('https://api.thecatapi.com/v1/breeds/'.$mostSearched[$i]);
            $breedObj = json_decode($breedJson);

            $name = $breedObj->name;
            $description = $breedObj->description;

                     
            $imgJson = file_get_contents('https://api.thecatapi.com/v1/images/'.$breedObj->reference_image_id);
            $imgObj = json_decode($imgJson);
           
            $img = $imgObj->url;
          
            echo '<div class="breed">
            <div class="image">
               <img src="'.$img.'" alt="'.$name.'">
            </div>
            <div class="text">
               <h1>'.$i + 1 .'. '.$name.'</h1>
               <p>'.$description.'</p>
            </div>
         </div>' ;
         

         }
      ?>
      
      </div>
   </section>
   <footer>
      <a href="#" class="logo"><img src="../images/CatwikiLogo-white.svg" alt=""></a>
      <p>created by <a href="http://bit.ly/walidmh_" target="_blank">walidmh_</a></p>
   </footer>
</body>
</html>