<!DOCTYPE html>

<?php
session_start();

include ("functions/functions.php");

?>

<html>
    <head>
        
        <title>Product Detail</title>
        
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
                    
                    <div id="shopping_cart">
                        
                        <span  style="float: right; font-size: 17px; padding: 5px; line-height: 40px;">
                            
                            <?php
                            
                            if(isset($_SESSION['customer_email'])){
                                
                                echo "<b>Welcome:</b>" . "<span style='color: yellow'>" . $_SESSION['customer_email'] ."</span>". "<b style='color:lavender'> Your </b>";
                                
                            }
                             else {
                                 
                                echo "<b>Welcome Guest!</b>";
                             }
                            
                            
                            ?>
                            
                           <!-- Welcome Guest! --> 
                            
                            <b style="color:lavender">Shopping Cart -</b> Total items: <b style="color: yellow"><?php total_items(); ?></b> 
                            Total price: <b style="color: yellow"><?php total_price(); ?></b> <a  href="cart.php" style="color: cornsilk; text-decoration: none;" ><strong> Go to Cart</strong></a>
                            
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
                        
                  <?php  
                  
        if(isset($_GET['pro_id'])){
                      
        $product_id = $_GET['pro_id'];              
                      
    $get_pro = "select * from products where product_id = '$product_id'";
    
    $run_pro = mysqli_query($con, $get_pro);
    
    while ($row_pro = mysqli_fetch_array($run_pro)){
        
        $pro_id = $row_pro['product_id'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_image = $row_pro['product_image'];
        $pro_desc = $row_pro['product_desc'];
        
        echo "
            <div id='single_product'>
        
             <h3>$pro_title</h3>
             
             <img src='admin_area/product_images/$pro_image' width='400' height='300' />    
             
             <p> <b>$$pro_price</b></p>
             <p> $pro_desc </p>    
                 
            <a href='index.php' style='float: left;'>Go Back</a>
            
            <a href='index.php?add_cart=$pro_id'><button style='float: right'> Add to Cart</button></a>

                    
              </div>
                       ";
        
        
    }
                  }
    
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
