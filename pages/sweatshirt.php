<?php
session_start();
include("../config/connect.php");

$id = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Sweat Shirt</title>
</head>

<body>
    <div class="info">
        <p>1 free product with purchase of 3 products</p>
        <i class="material-icons closetopinfo">close</i>
    </div>

    <div class="menu">
        <div class="innermenu">
            <i class="material-icons close">close</i>
            <aside>
                <a href="">Sweatshirt</a>
                <a href="">T-shirt</a>
                <a href="">Pants</a>
                <a href="">Jacket</a>
            </aside>
        </div>
        <div class="closemenu"></div>
    </div>
    <nav>
        <div class="menuicon">
            <i class="material-icons">menu</i>
        </div>
        <div class="logo">
            <img src="/asset/logo.png" alt="">
        </div>
        <div class="login">
            <a href="../login.php" class="logintext">Login</a>
            <a href="cart.php">
                <i class="material-icons">local_mall</i>
            </a>

        </div>
    </nav>

    <div class="controls">
        <div class="left">
            <a href="">Tumu</a>
        </div>

        <div class="right">
            <p style="color: gray;">Product: 100</p>
            <hr>

            <div class="piece">
                <div class="square small">Small</div>
                <div class="square large">Large</div>
            </div>
            <hr>
            <span class="filtericon">
                <i class="material-icons">tune</i>Filter
            </span>

        </div>
    </div>
    <!-- Filter -->
    <div class="filter">
        <div class="darkness"></div>

        <div class="filtercontent">
            <i class="material-icons closefilter">close</i>

        </div>

    </div>
    <!-- Product Container -->
    <div class="productcontainer">

        <?php
        // Product Get
        $products = getDataAll('Products');
        foreach ($products as $product) {
            echo ' 
            <div class="product">
                <div id="resultContainer"></div>
            <div class="imgbox">
                <a href="">
                    <img src="../asset/banner2.jpg" alt="">
                </a>
            </div>

            <form action="" method="post" id="addCartForm_' . $product['ProductID'] . '">
                <div class="addcart">
                    <button type="submit" name="addcart">
                        <i class="material-icons">add</i>
                    </button>
                </div>
                <input type="hidden" name="ProductID" value=" ' . $product['ProductID'] . ' ">

            <div class="productsize">
                    <div class="sizediv">
                    <label>
                        <input type="radio" name="size" value="S">
                        S
                        <span></span>
                    </label>
                    <label>
                        <input type="radio" name="size" value="L">
                        L
                        <span></span>
                    </label>
                    <label>
                        <input type="radio" name="size" value="XL">
                        XL
                        <span></span>
                    </label>
            </div>

                </form>
            </div>
            <div class="price">
                <p>$' . $product['Price'] . '</p>
            </div>
        </div> 
            ';
        }
        ?>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var forms = document.querySelectorAll('[id^=addCartForm_]');

            forms.forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    var productID = form.querySelector('input[name="ProductID"]').value;
                    var formData = new FormData(form);

                    console.log(forms);
                    console.log(productID);

                    fetch('process.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Gelen Veri:', data);
                            document.getElementById('resultContainer').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>

</html>