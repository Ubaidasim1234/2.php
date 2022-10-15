<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- <div class="container">
  <img src="https://firebasestorage.googleapis.com/v0/b/cajaregistradora-776cc.appspot.com/o/pngwing.com(2).png?alt=media&token=bde13cf8-4b17-4da9-90cf-c16db83b2e1f" />
  <div class="content-box">
    <h4 class="name">Veggie Burguer</h4>
    <p>A burguer typically considered a sandwich, consisting of one or more cooked patties-usually placed inside a sliced bread roll or bun</p>
    <p>Onion, Lettuce, Tomatoe, Patty, Cheese</p>
    <div class="btn">
      <h2 class="price">$ 5</h2>
      <a href="description.php">Order Now</a>
    </div>
  </div>
</div> -->

</body>
</html>
<?php


$conn = mysqli_connect('localhost','root','','image');


if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO product(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};


?>


<?php

$select = mysqli_query($conn, "SELECT * FROM product");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){
      '<tr>
         <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
         <td><?php echo $row['name'];</td>
         <td>$<?php echo $row['price'];</td>
      </tr>'
    } ?>
   </table>