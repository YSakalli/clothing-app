<?php
//1. getData($db, $row, $value);
//2. getDataAll($db);
include('connect.php');
// ******** Get Database ********

function getData($db, $row, $value)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM $db WHERE $row=?");
    $stmt->execute([$value]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// ******** Get Database All ********
function getDataAll($db)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM $db");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// ******** Insert Orders ********
function insertOrders($userid, $totalamount)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Orders (UserID,TotalAmount) VALUES (:UserID, :TotalAmount)");
    $stmt->bindParam(':UserID', $userid, PDO::PARAM_INT);
    $stmt->bindParam(':TotalAmount', $totalamount, PDO::PARAM_INT);
    $stmt->execute();
    $orderid = $pdo->lastInsertId();
    return $orderid;
}


// ******** Insert OrdersDetails ********
function insertOrdersDetails($orderid, $productid, $quantity, $subtotal)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO OrdersDetails (OrderID,ProductID,Quantity,Subtotal) VALUES (:OrderID, :ProductID,:Quantity,:Subtotal)");
    $stmt->bindParam(':OrderID', $orderid, PDO::PARAM_INT);
    $stmt->bindParam(':ProductID', $productid, PDO::PARAM_INT);
    $stmt->bindParam(':Quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':Subtotal', $subtotal, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// ******** Insert Cart ********
function insertCart($userid)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Carts (UserID) VALUES (:UserID)");
    $stmt->bindParam(':UserID', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $orderid = $pdo->lastInsertId();
    return $orderid;
}
// ******** Insert CartItem ********
function insertCartItem($cartid, $productid, $quantity, $price, $subtotal)
{
    global $pdo;

}

// ******** Insert Users ********
function insertUsers($username, $email, $pass)
{
    global $pdo;
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO Users (username, email, password) VALUES (:username, :email, :pass)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>