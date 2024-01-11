<?php
include('../config/connect.php');
include('../config/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Select Post
    $productid = isset($_POST['ProductID']) ? htmlspecialchars($_POST['ProductID']) : null;
    $size = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : null;
    $id = isset($_POST['UserID']) ? htmlspecialchars($_POST['UserID']) : null;

    // Control Seleced Empty
    if (!empty($size) && !empty($productid)) {
        // Select Product
        $product = getData('Products', 'ProductID', $productid);
        $price = $product['Price'];
        $quantity = 1;
        $subtotal = $price * $quantity;
        //  Check Cart
        $cart = $pdo->prepare("SELECT * FROM CartItems WHERE ProductID = :ProductID AND CartID = :ID AND Size = :Size");
        $cart->bindParam(':ProductID', $productid, PDO::PARAM_INT);
        $cart->bindParam(':ID', $id, PDO::PARAM_INT);
        $cart->bindParam(':Size', $size, PDO::PARAM_INT);
        $cart->execute();
        $cartRows = $cart->fetch(PDO::FETCH_ASSOC);

        // Cart Is Not Empy
        if (!empty($cartRows)) {
            // Updated Data
            $quantity = $cartRows['Quantity'];
            $newquantity = $quantity + 1;
            $newsubtotal = $newquantity * $price;
            // Updated CartItem
            $updcart = $pdo->prepare("UPDATE CartItems SET Quantity = :Quantity, Subtotal = :Subtotal WHERE ProductID = :ProductID AND CartID = :ID AND Size = :Size");
            $updcart->bindParam(':Quantity', $newquantity, PDO::PARAM_INT);
            $updcart->bindParam(':Subtotal', $newsubtotal, PDO::PARAM_INT);
            $updcart->bindParam(':ProductID', $productid, PDO::PARAM_INT);
            $updcart->bindParam(':ID', $id, PDO::PARAM_INT);
            $updcart->bindParam(':Size', $size, PDO::PARAM_INT);
            $updcart->execute();
            echo '<p class="Success">Again added</p>';
        }
        // Cart Is Empy
        else {
            $addcart = $pdo->prepare("INSERT INTO CartItems (CartID ,ProductID,Quantity,Size,Price,Subtotal) VALUES (:CartID,:ProductID,:Quantity,:Size,:Price,:Subtotal)");
            $addcart->bindParam(':CartID', $id, PDO::PARAM_INT);
            $addcart->bindParam(':ProductID', $productid, PDO::PARAM_INT);
            $addcart->bindParam(':Quantity', $quantity, PDO::PARAM_INT);
            $addcart->bindParam(':Size', $size, PDO::PARAM_INT);
            $addcart->bindParam(':Price', $price, PDO::PARAM_INT);
            $addcart->bindParam(':Subtotal', $subtotal, PDO::PARAM_INT);
            $addcart->execute();
            echo '<p class="Success">Selected added to cart</p>';
        }

    } else {
        echo '<p class="Err">Choose Size</p>';
    }
} else {
    echo '<p class="Err">Invalid request</p>';
}

?>