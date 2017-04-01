


<br>
<h2 style="text-align: center;">Do you really want to delete your Account?</h2>
<form action="" method="post">
    <br>
    <input type="submit" name="yes" value="Yes I Want" />
    <input type="submit" name="no" value="I don't Want" />
    
</form>

<?php

include("includes/db.php");

$user = $_SESSION['customer_email'];

if(isset($_POST['yes'])){
    
  $delete_customer = "delete from customers where customer_email = '$user'";
  
  $run_customer = mysqli_query($con, $delete_customer);
  
  echo "<script>alert('Your Account is deleted Successfully!')</script>";
  
  echo "<script>window.open('../logout.php','_self')</script>";
    
    
}

if(isset($_POST['no'])){
    
    echo "<script>alert('It is OK')</script>";
  
    echo "<script>window.open('my_account.php','_self')</script>";
    
}

?>