<<<<<<< HEAD
<?php
error_reporting( error_reporting() & ~E_NOTICE );
// Include configuration file
include_once 'config.php';

// Include database connection file
include_once 'dbConnect.php';
=======
<?php 
// Include configuration file 
include_once 'cart_config.php'; 
 
// Include database connection file 
include_once 'dbConnect.php'; 
>>>>>>> 5648e63c52471305a4fb417ee5bab799edaba31b
?>

<div class="container">
    <?php
        // Fetch products from the database
        $results = $db->query("SELECT * FROM products WHERE status = 1");
        while($row = $results->fetch_assoc()){
    ?>
        <div class="pro-box">
            <img src="images/<?php echo $row['image']; ?>"/>
            <div class="body">
                <h5><?php echo $row['name']; ?></h5>
                <h6>Price: <?php echo '$'.$row['price'].' '.PAYPAL_CURRENCY; ?></h6>

                <!-- PayPal payment form for displaying the buy button -->
                <form action="<?php echo PAYPAL_URL; ?>" method="post">
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
<<<<<<< HEAD
                    <input type="hidden" name="notify_url" value="https://www.codexworld.com/paypal_ipn.php">S

=======
                    <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
                    <!--input type="hidden" name="notify_url" value="https://www.codexworld.com/paypal_ipn.php"-->
					
>>>>>>> 5648e63c52471305a4fb417ee5bab799edaba31b
                    <!-- Display the payment button. -->
                    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                </form>
                <?php
            unset($_SESSION['cart']);
            include "config.php";
            $sql = "INSERT INTO sales (user_id, price) VALUES (:user_id, :product_id)";
            if($stmt = $pdo->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bindParam(":user_id", $user_id);
              $stmt->bindParam(":product_id", $sub);
              //$stmt->bindParam(":qty", $qty);
      
              // Set parameters
              $user_id = $_SESSION['user_id'];
              $sub= $subtotal;
              $stmt->execute();
            }
              ?>
   <?php
    }
    ?>
            </div>
        </div>
    <?php } ?>
</div>
