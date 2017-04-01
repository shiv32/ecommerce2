<!DOCTYPE html>

<?php

session_start();                      // for $_session[] to work for to keep hold the vlaue in qty box

include ("functions/functions.php");

?>

<html>
    <head>
        
        <title>Shopping Cart</title>
        
        <link rel="stylesheet" href="styles/style.css" media="all" />
    </head>
    
    <body>
        
       <!-- main container starts -->
        <div class="main_wrapper">
            
             <!-- header & navigation starts -->
            
            <?php include 'header.php'; ?>
            
             <!-- header & navigation ends -->
             
             <!-- content wrapper starts -->
            <div class="content_wrapper">
             
                <div id="sidebar">
                    
                    <div id="sidebar_title">Categories</div>
                    
                    <ul id="cats">
                        <?php getCats(); ?>
                    </ul>
                    
                    <div id="sidebar_title">Brands</div>
                    
                    <ul id="cats">
                         <?php getBrands(); ?>
                    </ul>
                    
                </div>
                
                <div id="content_area">
                    
                    <?php cart(); ?>
                    
                    <div id="shopping_cart">
                        
                        <span  style="float: right; font-size: 17px; padding: 5px; line-height: 40px;">
                            
                            
                             <?php
                            
                            if(isset($_SESSION['customer_email'])){
                                
                                echo "<b>Welcome:</b>" . "<span style='color: yellow'>" . $_SESSION['customer_email'] ."</span>" . "<b style='color:lavender'> Your </b>";
                                
                            }
                             else {
                                 
                                echo "<b>Welcome Guest!</b>";
                             }
                            
                            
                            ?>
                            
                            
                            <!--Welcome Guest!-->
                            
                            <b style="color:lavender">Shopping Cart -</b> Total items: <b style="color: yellow"><?php total_items(); ?></b> 
                            Total price: <b style="color: yellow"><?php total_price(); ?></b> <a  href="index.php" style="color: cornsilk; text-decoration: none;" ><strong>Back to Shop</strong></a>
                        
                            <?php
                            
                            if(!isset($_SESSION['customer_email'])){
                                
                                echo "<a href='checkout.php' style = 'color:lavender; text-decoration: none;'>Login</a>";
                                
                            }
                           else {
                              
                               echo "<a href='logout.php' style = 'color:lavender; text-decoration: none;'>Logout</a>";
                               
                           }
                            
                            
                            ?>
                            
                            
                        </span>
                        
                    </div>
                
                    <div id="products_box">
                      
                       <form action="" method="post" enctype="multipart/form-data">
                            
                            <table align="center" width="700" bgcolor="skyblue">
                              <!--  <tr align="center">
                                    <td colspan="5"><h2>Update your Cart or Checkout</h2></td>
                                </tr> -->
                              <tr align="center">
                                    <th>Remove</th>
                                    <th>Product(s)</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                
      <?php
    $total = 0;
   
    global $con;

    $ip = getIp();
    
    $sel_price = "select * from cart where ip_add = '$ip'";
    
    $run_price = mysqli_query($con, $sel_price);
    
    while ($p_price = mysqli_fetch_array($run_price)){
        
        $pro_id = $p_price['p_id'];
        
        $pro_price = "select * from products where product_id = '$pro_id'";
        
        $run_pro_price = mysqli_query($con, $pro_price);
        
        while ($pp_price = mysqli_fetch_array($run_pro_price)){
            
            $product_price = array($pp_price['product_price']);
            
            $product_title = $pp_price['product_title'];
            
            $product_image = $pp_price['product_image'];
            
            $single_price = $pp_price['product_price'];
            
            $values = array_sum($product_price);
            
            $total += $values;
        
                                ?>
                                
                                <tr align="center">
                                    <td><input type="checkbox" name="remove[]" value="<?=$pro_id;?>" /></td>
                                    <td><?= $product_title; ?> <br>
                                     <img src="admin_area/product_images/<?= $product_image; ?>" width="60" height="60" />
                                    
                                    </td>
                                    <td><input type="text" size="4" name="qty" value="<?=$_SESSION['qty'];?>"/> </td>
                                    
                                    <?php
                                    if(isset($_POST['update_cart'])){
                                         
                                       $qty = $_POST['qty'];
                                        
                                        $update_qty = "update cart set qty = '$qty'";
                                        
                                        $run_qty = mysqli_query($con, $update_qty);
                                        
                                        $_SESSION['qty'] = $qty;       //to keep hold the value in qty box
                                        
                                         $total = $total*$qty;
                                   }
                                   
                                   ?>
                                    
                                    <td><?= "$" .$single_price; ?></td>
                                </tr>
                               <?php } } ?>
                               
                                <tr align="right">
                                    <td colspan="4"> <b>Sub Total:</b> </td>
                                    <td><?= "$" .$total; ?></td>
                                </tr>
                     
                                <tr align="center">
                                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart" /></td>
                                    <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                                    <td><button><a href="checkout.php" style="text-decoration: none; color: black;">Checkout</a></button></td>
                                </tr>
                            
                            </table>    
                       </form>  
                        
                        <?php
                      function updatecart(){
                          
                          global $con;

                          $ip = getIp();
                        
                        if(isset($_POST['update_cart'])){
                            
                            foreach($_POST['remove'] as $remove_id){
                                
                             $delete_product = "delete from cart where p_id = '$remove_id' AND ip_add = '$ip'";   
                                
                             $run_delete = mysqli_query($con, $delete_product);
                             
                             if($run_delete){
                                 
                                 echo "<script>window.open('cart.php','_self')</script>";
                             }
                            }
                        }
                        
                        if(isset($_POST['continue'])){
                            
                            echo "<script>window.open('index.php','_self')</script>";
                            
                        }
                        
                    }
                      echo @$up_cart =  updatecart();      // @ means when  updatecart() is not
                                                         // active then it will not generate an error bcoz 
                                                        // of if(isset($_POST['update_cart'])) used in two places.
                        ?>
                    
                    </div>
                    
               </div>
                 
             
            </div>
               <!-- content wrapper ends -->
            
               <!--footer-->
              
              <?php include 'footer.php';; ?>
              
              <!--footer end -->
            
            
        </div>
        <!-- main container ends -->    
  
       </body>
</html>
