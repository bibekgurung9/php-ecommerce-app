<?php

include 'config.php';

//Function to Validate Password with RegEx
function validatePassword($password) {
   // Regular expression pattern for password validation
   $pattern = '/^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/';
   return preg_match($pattern, $password);
}

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Query Failed!');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User Already Exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm Password Does Not Matched!';
      } else if(!validatePassword($_POST['password'])){
         $requirements = array();

         if(!preg_match('/.*\d.*/', $_POST['password'])){
            $requirements[] = "at least one digit";
         }
         if (!preg_match('/.*[A-Z].*/', $_POST['password'])) {
            $requirements[] = "at least one uppercase letter";
        }
        if (!preg_match('/.*[!@#$%^&*].*/', $_POST['password'])) {
            $requirements[] = "at least one symbol";
        }
        if (strlen($_POST['password']) < 8) {
            $requirements[] = "at least 8 characters";
        }

        $message[] = "Password Must Contain " .implode(', ', $requirements) . ".";
      }
      else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('Query Failed');
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
<header class="header">

<div class="header-1">
   <div class="flex">
      <div class="share">
         <a href="#" class="fab fa-facebook-f"></a>
         <a href="https://github.com/bibekgurung9" target="_blank" class="fab fa-github"></a>
         <a href="https://www.linkedin.com/in/bibek-gurung-4aa280274/" target="_blank" class="fab fa-linkedin"></a>
         <a href="#" class="fab fa-instagram"></a>
         
      </div>
      <p><a href="login.php">Login </a> | <a href="register.php">Register</a> </p>
   </div>
</div>
</header> 
<div class="welcome">
<h3>Welcome to BIKESHOP</h3>
<p>Create Your Account With Us: </p>
</div>
<div class="form-container">
   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter Your Name" required class="box">
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" id="password" placeholder="Enter Your Password" required class="box">
      <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Your Password" required class="box">
      <p id="message">Password is <span id="strength"></span><br><span id="match"></span></p>

      <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>Already have an account? <a href="login.php">Login Now!</a></p>
   </form>

</div>

<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">LOGIN</a>
         <a href="register.php">REGISTER</a>
         <a href="https://github.com/bibekgurung9" target="_blank">GITHUB</a>
         <a href="https://www.linkedin.com/in/bibek-gurung-4aa280274/" target="_blank">LINKEDIN</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +977-98XXXXXXXX</p>
         <p> <i class="fas fa-phone"></i> +144-XXXXXX </p>
         <p> <i class="fas fa-envelope"></i> bibekgurung@email.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal</p>
      </div>

      <div class="box">
         <h3>Our Location</h3>
         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d56510.204945783196!2d85.33448653535157!3d27.72075003156448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1692882526915!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
   </div>

   <p class="credit"><span>BCA 4th Semester Project</span><br>
   <span>@ All Rights Reserved To Bibek Gurung & Jebin Joshi</span> </p>

</section>

<script>
   var pass = document.getElementById("password");
   var cpass = document.getElementById("cpassword");
   var msg = document.getElementById("message");
   var str = document.getElementById("strength");
   var mat = document.getElementById("match");

   pass.addEventListener('input', () => {
      if(pass.value.length > 0){
         msg.style.display = "block";
      }
      else{
         msg.style.display = "none";
      }
      if(pass.value.length < 4){
         str.innerHTML = "Weak!";
         pass.style.borderColor = "#ff5925";

      }
      else if(pass.value.length >= 4 && pass.value.length < 8){
         str.innerHTML = "Medium!";
         pass.style.borderColor = "yellow";

      }
      else if(pass.value.length >= 8){
         str.innerHTML = "Strong!";
         pass.style.borderColor = "#26d730";
      }
   })

   cpass.addEventListener('input', () =>{
      if(cpass.value == pass.value){
         cpass.style.borderColor = "#26d730";
         mat.innerHTML = "Password & Confirm Password Match!";
      }
      else if(cpass.value != pass.value){
         cpass.style.borderColor = "#ff5925";
         mat.innerHTML = "Password & Confirm Password Does Not Match!";
      }
   })

</script>
</body>
</html>