<!-------------------------------About Us Page Section------------------------------->
<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us | BikeShop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!------------------------------- Custom css file link ----------------------------- -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">Home</a> | About </p>
</div>

<?php include 'our_features.php'; ?>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/home-background.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>We aim to provide the best deals for you according to your needs.</p>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
      </div>

   </div>
</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/user_reviews.png" alt="user review 1">
         <p>5/5 The Best Ecommerce Website In Nepal. It features a clean UI and easy to use functions and features.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Customer #1</h3>
      </div>

      <div class="box">
         <img src="images/user_reviews.png" alt="user review 2">
         <p>They provide quality customer satisfaction with customer support who are 24/7 ready to help us! Awesome Site!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Customer #2</h3>
      </div>

      <div class="box">
         <img src="images/user_reviews.png" alt="user review 3">
         <p>4/5 Stars but doesn't lag behind anyother platform in the current ecommerce sector in Nepal. You are doing a great job for us!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class=""></i>
         </div>
         <h3>Customer #3</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>