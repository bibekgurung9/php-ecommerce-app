<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User Already Exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm Password Does Not Matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'Registered Successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register | BikeShop </title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter Your Name" required class="box">
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" id="password" placeholder="Enter Your Password" required class="box">
      <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Your Password" required class="box">
      <p id="message">Password is <span id="strength"></span></p>

      <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>Already have an account? <a href="login.php">Login Now!</a></p>
   </form>

</div>

<script>
   var pass = document.getElementById("password");
   var cpass = document.getElementById("cpassword");
   var msg = document.getElementById("message");
   var str = document.getElementById("strength");

   pass.addEventListener('input', () => {
      if(pass.value.length > 0){
         msg.style.display = "block";
      }
      else{
         msg.style.display = "none";
      }
      if(pass.value.length < 4){
         str.innerHTML = "Weak";
         pass.style.borderColor = "#ff5925";

      }
      else if(pass.value.length >= 4 && pass.value.length < 8){
         str.innerHTML = "Medium";
         pass.style.borderColor = "yellow";

      }
      else if(pass.value.length >= 8){
         str.innerHTML = "Strong";
         pass.style.borderColor = "#26d730";
      }

   })
</script>
</body>
</html>