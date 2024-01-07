<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productid = isset($_POST['ProductID']) ? htmlspecialchars($_POST['ProductID']) : null;
    $size = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : null;
    if (!empty($size) && !empty($productid)) {
        echo '<p class="Success">Selected added to cart</p>';
    } else {
        echo '<p class="Err">Choose Size</p>';
    }
} else {
    echo '<p class="Err">Invalid request</p>';
}
?>