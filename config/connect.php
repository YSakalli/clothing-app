<?php
$host = 'db';
$db = 'db';
$user = 'clothingapp';
$pass = 'a123';
$port = "3306";
$charset = 'utf8';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$pdo = new \PDO($dsn, $user, $pass, $options);
?>

<!-- DataBase Fuction -->
<!-- 
    
getData($db, $row, $value);
getDataAll($db);

-->

<?php
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
// ******** Insert Users ********
function insertUsers($username, $email, $pass)
{
    global $pdo;
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :pass)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>