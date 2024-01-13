<?php
session_start();
include('../config/connect.php');
include('../config/functions.php');
$userid = 1;
// Get Productid
$productid = $_GET['productid'];
?>
<?php
// Product Select
$product = getData('Products', 'ProductID', $productid);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/productview.css">
    <title>Document</title>
</head>

<body>
    <div id="resultContainer"></div>
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
            <a href="" class="logintext">Login</a>
            <a href="">
                <i class="material-icons">local_mall</i>
            </a>

        </div>
    </nav>

    <div class="product">
        <!-- Slider -->
        <div class="slider">
            <i class="material-icons prev">navigate_before</i>
            <i class="material-icons next">chevron_right</i>
            <div class="img">
                <?php
                $images = explode(',', $product["ProductImages"]);

                foreach ($images as $image) {
                    echo '<img src="../asset/product/' . $image . '.jpg" alt="">';
                }
                ?>

            </div>
        </div>

        <div class="productdetail">
            <div class="header">
                <h1>
                    <?= $product['ProductName'] ?>
                </h1>
                <hr>
                <p>
                    <?= $product['ProductExplanation'] ?>
                </p>
            </div>

            <div class="price-addcart">
                <form action="" method="post" id="addCartForm_<?= $productid ?> ">
                    <!-- Price -->
                    <div class="price">
                        <p>25$</p>
                    </div>
                    <!-- Form -->
                    <div class="productsize">
                        <!-- Secelt Size -->
                        <label>
                            <input type="radio" name="size" value="S">
                            S
                            <span></span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="M">
                            M
                            <span></span>
                        </label>
                        <label>
                            <input type="radio" name="size" value="L">
                            XL
                            <span></span>
                        </label>
                    </div>
                    <!-- Add Cart -->
                    <div class="addcart">
                        <input type="hidden" name="ProductID" value="<?= $productid ?>">
                        <input type="hidden" name="UserID" value="<?= $userid ?>">

                        <button type="submit" name="addcart">Add Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- General Info -->
    <div class="generalinfo">
        <div class="materiel">
            <h1>Materiel</h1>
            <span><img src="../asset/icon/cotton.png" alt="">
                <p>100% Cotton</p>
            </span>


        </div>
        <div class="use">
            <h1>Using</h1>
            <span><img src="../asset/icon/warm.png" alt="">
                <p>keeps warm</p>
            </span>
        </div>
        <div class="cargo">
            <h1>Using</h1>

            <span><img src="../asset/icon/fast-delivery.png" alt="">
                <p>Fast Delivery</p>
            </span>
        </div>

    </div>
    <!-- FAQ And Size -->
    <div class="faq">

        <div class="question">
            <div class="header">

                <span class="plus">+</span>
                <h1>How can I place an order?</h1>
            </div>

            <div class="anwers">
                To place an order, simply browse our online store, select the items you want, and proceed to checkout.
                Follow the prompts to enter your shipping details and payment information.
            </div>
        </div>
        <div class="question">
            <div class="header">

                <span class="plus">+</span>
                <h1> What payment methods do you accept?</h1>
            </div>

            <div class="anwers">

                We accept various payment methods, including credit cards, debit cards, and PayPal. You can find the
                complete list of accepted payment options at the checkout page.
            </div>
        </div>
        <div class="question">
            <div class="header">
                <span class="plus">+</span>
                <h1>Can I modify or cancel my order after placing it?</h1>
            </div>
            <div class="anwers">
                Unfortunately, once an order is placed, it cannot be modified or canceled. Please double-check your
                items and shipping details before confirming your purchase.
            </div>
        </div>
    </div>

    <script src="../js/app.js"></script>
    <script>
        // Fetch Api
        document.addEventListener('DOMContentLoaded', function () {
            var forms = document.querySelectorAll('[id^=addCartForm_]');
            forms.forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    var productID = form.querySelector('input[name="ProductID"]').value;
                    var formData = new FormData(form);

                    console.log(forms);
                    console.log(productID);

                    fetch('addprocess.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('Gelen Veri:', data);
                            document.getElementById('resultContainer').innerHTML = data;
                            var autoHideTimeout = setTimeout(function () {
                                document.getElementById('resultContainer').innerHTML = '';
                            }, 2000);
                        })


                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <script>

        let plusses = document.querySelectorAll('.plus');
        let questions = document.querySelectorAll('.question');

        plusses.forEach(function (plus, index) {
            plus.addEventListener('click', function () {
                questions.forEach(function (question, i) {
                    if (i === index) {
                        question.classList.toggle('active');
                    } else {
                        question.classList.remove('active');
                    }
                });
            });
        });
    </script>
    <script>
        // Slider
        let next = document.querySelector('.next');
        let prev = document.querySelector('.prev');
        let imgbox = document.querySelector('.product .slider .img');
        let img = document.querySelectorAll('.product .slider img');
        let slider = document.querySelector('.product .slider');

        let active = 0;
        let imglength = img.length - 1;
        // Next ONclick
        next.onclick = function () {
            if (active + 1 > imglength) {
                active = 0;
            } else {
                active = active + 1;
            }
            reloadSlider();
        }
        // Prev ONclick
        prev.onclick = function () {
            if (active - 1 < 0) {
                active = imglength;
            } else {
                active = active - 1;
            }
            reloadSlider();
        }
        function reloadSlider() {
            let checkleft = img[active].offsetLeft;
            imgbox.style.left = -checkleft + 'px';
        }
    </script>
</body>

</html>