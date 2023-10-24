<?php
$phone = $_GET['phone'];
$conn = new PDO("mysql:host=localhost; dbname=database;charset=utf8","root","");
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql ="SELECT * FROM account WHERE phone=?";
$stmt = $conn-> prepare($sql);
$stmt-> execute([$phone]);
$count = $stmt-> rowCount();
echo json_encode(['count' => $count]);
?>

