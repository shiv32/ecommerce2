<!DOCTYPE html>

<?php

session_start();

include ("functions/functions.php");

?>

<html>
    <head>
        
        <title>CheckOut</title>
        
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
                            
                           <!-- Welcome Guest! --> 
                            
                            
                            
                            <b style="color:lavender">Shopping Cart -</b> Total items: <b style="color: yellow"><?php total_items(); ?></b> 
                            Total price: <b style="color: yellow"><?php total_price(); ?></b> <a  href="cart.php" style="color: cornsilk; text-decoration: none;" ><strong> Go to Cart</strong></a>
                        
                        </span>
                        
                    </div>
                
                    <div id="products_box">
                        
                      <?php
                      if(!isset($_SESSION['customer_email'])){
                          
                          include("customer_login.php");
                      
                      }
                      else {
                          
                          include("payment.php");
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
