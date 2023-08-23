<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

//Add to Cart PHP Section
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added To Cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product Added To Cart!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product | BikeShop</title> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<!--Retreving the cliked product for quickview-->
<?php
if(isset($_GET['id'])){
   $product_id = $_GET['id'];
   $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die("Query Failed");

   if(mysqli_num_rows($select_product) > 0) {
      $fetch_products = mysqli_fetch_assoc($select_product);

      // Retrieve the product details
      $product_name = $fetch_products['name'];
      $product_price = $fetch_products['price'];
      $product_image = $fetch_products['image'];
      $product_description = $fetch_products['description'];
?>
<section class="quickview">
   <div class="box-container">
   <form action="" method="post" class="box">   
      <h3><?php echo $product_name; ?></h3>
      <img class="image" src="uploaded_img/<?php echo $product_image; ?>" alt="Product Image">
      <div class="content">
      <p><strong>Price:</strong> Rs.<?php echo $product_price; ?>/-</p>
      <p><strong>Description:</strong> <?php echo $product_description; ?></p>
      </div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
   </form>
   </div>
</section>
<?php
   } else {
      echo "Product Not Found.";
   }
} else {
   echo "Product ID Not Provided.";
}
?>

<?php include 'our_features.php';?>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>