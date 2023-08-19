<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $test = mysqli_real_escape_string($conn, $_POST['test']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `test-ride` WHERE name = '$name' AND email = '$email' AND number = '$number' AND test = '$test' AND message = '$msg'") or die('Query Failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Ride has Already Been Booked!';
   }else{
      mysqli_query($conn, "INSERT INTO `test-ride`(user_id, name, email, number, test, message) VALUES('$user_id', '$name', '$email', '$number', '$test', '$msg')") or die('Query Failed');
      $message[] = 'Test Ride Booked Successfully! You Will Get Contacted Through Email Or Call Soon!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Test Ride | BikeShop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Book A Test Ride</h3>
   <p> <a href="home.php">Home</a> | Test Ride </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Book A Test Ride!</h3>
      <input type="text" name="name" required placeholder="Please Enter Your Name" class="box">
      <input type="email" name="email" required placeholder="Please Enter Your Email" class="box">
      <input type="number" name="number" required placeholder="Please Enter Your Number" class="box">
      <input type="text" name="test" required placeholder="Which Bike Would You Like To Test Ride?" class="box">
      <textarea name="message" class="box" placeholder="Anything You Want To Add?" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Book A Test Ride!" name="send" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>