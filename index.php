<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Catwiki</title>

   <link rel="stylesheet" href="./style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="script.js" defer></script>
</head>
<body>
   <header>
      <a href="#" class="navLogo">
         <img src="./images/CatwikiLogo.svg" alt="logo">
      </a>
   </header>

   <section id="mainSection">
      <div class="top">
         <!-- <img src="./images/HeroImagelg.png" alt="" class="bg"> -->
         <div class="components">
            <img src="./images/CatwikiLogo-white.svg" alt="" class="logo">
            <p >Get to know more about your cat breed</p>
            <form action="./searchBreed.php" method="post" class="searchBreed"  autocomplete="off">
               <input type="text" name="breed" id="breedInp" placeholder="Enter your breed" >
               <button type="submit" ><i class="fa-solid fa-magnifying-glass"></i></button>


               <input type="text" name="breedM" id="breedInpMobile" placeholder="Search" >
               <ul id="searchInpValues">
                  <?php
                     $json = file_get_contents('https://api.thecatapi.com/v1/breeds/?limit=100');
                     $obj = json_decode($json);
                     // print_r($obj[1]->name) ;

                     $arrl = count($obj);
                     for ($i=0; $i < $arrl; $i++) { 
                        echo '<li>'.$obj[$i]->name.'</li>';
                     }
                  ?>
               </ul>
            </form>
         </div>
      </div>
      <div class="bottom">
         <h3>Most Searched Breeds</h3>
         <div>
            <h1>66+ Breeds for you to discover</h1>
            <a href="most-searched">See More <i class="fa-solid fa-arrow-right"></i></a>
         </div>


         <div class="mostSearched">

         <?php
            include('./connection.php');

         $sql = 
         "SELECT     breed_id
         FROM        searches
         GROUP BY    breed_id
         ORDER BY    COUNT(breed_id) DESC
         LIMIT       4
         ;";

         $mostSearched = array();
         $result = mysqli_query($con,$sql);
         while ($row = mysqli_fetch_assoc($result)) {
            array_push($mostSearched, $row['breed_id']);
         }





         $breedsCount = count($mostSearched);
         // echo $breedsCount;
         for ($i=0; $i < 4; $i++) { 
            $breedJson = file_get_contents('https://api.thecatapi.com/v1/breeds/'.$mostSearched[$i]);
            $breedObj = json_decode($breedJson);

            $name = $breedObj->name;

                     
            $imgJson = file_get_contents('https://api.thecatapi.com/v1/images/'.$breedObj->reference_image_id);
            $imgObj = json_decode($imgJson);
           
            $img = $imgObj->url;
          

         echo '<div class="cat">
         <img src="'.$img.'" alt="'.$name.'">
         <p class="catName">'.$name.'</p>
      </div>';

         }
      ?>

         </div>
      </div>
   </section>
      <div class="searchOnMobileContainer">
         
      <div class="searchOnMobile">
            <button class="closeSearch" onclick="closeSearch()"><i class="fa-solid fa-xmark"></i></button>
            <form action="searchBreed.php" method="post" class="searchBreed"  autocomplete="off">
                     <button type="submit" ><i class="fa-solid fa-magnifying-glass"></i></button>


                     <input type="text" name="breed" id="breedInpMobileFr" placeholder="Search" >
                     
                  </form>
                  <ul id="searchInpValuesMobile">
                        <?php
                           
                           for ($i=0; $i < $arrl; $i++) { 
                              echo '<li>'.$obj[$i]->name.'</li>';
                           }
                        ?>
                     </ul>
         </div>

      </div>
   <section id="secondary">
      <div class="text">
         <h1>Why should you have a cat?</h1>
         <p>Having a cat around you can actually trigger the release of calming chemicals in your body which lower your stress and anxiety levels</p>
         <a href="#">Read More <i class="fa-solid fa-arrow-right"></i></a>

      </div>
      <div class="images">
         <div class="left">
            <img src="./images/image 2.png" alt="">
            <img src="./images/image 1.png" alt="">
         </div>
         <div class="right"><img src="./images/image 3.png" alt=""></div>
      </div>
   </section>

   <footer>
      <a href="#" class="logo"><img src="./images/CatwikiLogo-white.svg" alt=""></a>
      <p>created by <a href="http://bit.ly/walidmh_"  target="_blank">walidmh_</a></p>
   </footer>
</body>
</html>