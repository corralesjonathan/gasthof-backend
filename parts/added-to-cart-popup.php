<div id="cart-popup">
            <h2 class="slide-title dish-title">dish successfully added to your cart!</h2>
            <?php 
            $dishesInCart = getCart($database);
            $total = calculateTotal($dishesInCart);
            echo "<p class='dish-type slide-description'>You have <b>".count($dishesInCart)."</b> items in your cart</p>";
            echo "<p class='dish-type slide-description'><b>Total:</b> $".$total."</p>";
            ?>
            <a href="cart.php" class="btn view-all">go to cart</a>
        </div>