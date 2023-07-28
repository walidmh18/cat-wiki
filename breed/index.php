<?php
include('../connection.php');

if (!isset($_GET['name']) || !isset($_GET['id'])) {
   header('Location:/');
} else {
   $name = $_GET['name'];
   $id = $_GET['id'];


   $json = file_get_contents('https://api.thecatapi.com/v1/breeds/' . $id);
   $obj = json_decode($json);

   $temperament = $obj->temperament;
   $origin = $obj->origin;
   $description = $obj->description;
   $life_span = $obj->life_span;
   $adaptability = $obj->adaptability;
   $affection_level = $obj->affection_level;
   $child_friendly = $obj->child_friendly;
   $grooming = $obj->grooming;
   $health_issues = $obj->health_issues;
   $intelligence = $obj->intelligence;
   $social_needs = $obj->social_needs;
   $stranger_friendly = $obj->stranger_friendly;
   $wikipedia_url = $obj->wikipedia_url;
   $image_id = $obj->reference_image_id;

   $imageJson = file_get_contents('https://api.thecatapi.com/v1/images/' . $image_id);
   $imageUrl = json_decode($imageJson)->url;




   // other images

   $otherImgsJson = file_get_contents('https://api.thecatapi.com/v1/images/search?limit=10&breed_ids=' . $id);
   $otherImgsObj = json_decode($otherImgsJson);
   $objLength = count($otherImgsObj);
   $otherImagesArr = array();
   for ($i = 0; $i < $objLength; $i++) {
      array_push($otherImagesArr, $otherImgsObj[$i]->url);
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Catwiki - <?php echo $name; ?></title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="./style.css">
</head>

<body>
   <header>
      <a href="../" class="navLogo">
         <img src="../images/CatwikiLogo.svg" alt="logo">
      </a>
   </header>
   <section id="infos">
      <div class="img">
         <div class="container">
            <img src="<?php echo $imageUrl ?>" alt="">
         </div>
      </div>
      <div class="components">
         <h1 class="name"><?php echo $name ?></h1>
         <p class="description"><?php echo $description ?></p>
         <p class="temperament"><b>Temperament: </b><?php echo $temperament ?></p>
         <p class="origin"><b>Origin: </b><?php echo $origin ?></p>
         <p class="life_span"><b>Life Span: </b><?php echo $life_span ?></p>



         <div class="range">
            <p class="adaptability ">adaptability:</p>
            <div data-level="<?php echo $adaptability ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="affection_level ">affection_level:</p>
            <div data-level="<?php echo $affection_level ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="child_friendly ">Child Friendly:</p>
            <div data-level="<?php echo $child_friendly ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="grooming">Grooming:</p>
            <div data-level="<?php echo $grooming ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="health_issues">Health Issues:</p>
            <div data-level="<?php echo $health_issues ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="intelligence">Intelligence:</p>
            <div data-level="<?php echo $intelligence ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="social_needs">Social Needs:</p>
            <div data-level="<?php echo $social_needs ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>

         <div class="range">
            <p class="stranger_friendly">Stranger Friendly:</p>
            <div data-level="<?php echo $stranger_friendly ?>" class="levels">
               <div class="level level1"></div>
               <div class="level level2"></div>
               <div class="level level3"></div>
               <div class="level level4"></div>
               <div class="level level5"></div>
            </div>

         </div>


      </div>
   </section>

   <section id="otherImages">
      <h1>Other Photos</h1>

      <div class="imagesContainer">

         <?php
         for ($i = 0; $i < $objLength; $i++) {
            array_push($otherImagesArr, $otherImgsObj[$i]->url);

            echo '<div> <img src="' . $otherImagesArr[$i] . '" alt=""></div>';
         }
         ?>
       
      </div>
      <a href="<?php echo $wikipedia_url ?>" target="_blank" rel="noopener noreferrer">View On Wikipedia <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
   </section>
   <footer>
      <a href="#" class="logo"><img src="../images/CatwikiLogo-white.svg" alt=""></a>
      <p>created by <a href="http://bit.ly/walidmh_" target="_blank">walidmh_</a></p>
   </footer>
</body>

</html>