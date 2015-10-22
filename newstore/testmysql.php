<?php 
$dsn="mysql:host=127.0.0.1;dbname=wxpay";
$user='root';
$password='PKDz6tvo';
try {
    $pdo = new PDO($dsn, $user, $password); 
    $pdo->query('set names utf8');
    //echo "yes";
} catch (PDOException $e) {
    die('连接数据库失败!');    
}
?>
