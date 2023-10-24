<?php
    include'./config.php';
    $id = $_GET['id'];
    $sql = "DELETE  FROM movie WHERE id=$id";
    mysqli_query($conn,$sql);

    header("Location:danhsachphim.php");
?>