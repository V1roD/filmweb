

<?php
    session_start();
    $_SESSION['datve'] = 1;
    $id_KH = $_SESSION['login_id'];
    $id = $_POST["lichchieu"];
    $giave = $_POST["giave"];
    $dsghe = trim($_POST["seat"]);
    $chuoi = explode(" ", $dsghe);
    $tongtien = count($chuoi) * $giave;
    include'./config.php';
    
    //Lưu lịch sử đặt vé của khách hàng
    $sql2 = "insert into datve (id_KH,id_lichchieu,Ghe,TongTien) values ($id_KH,$id,'$dsghe',$tongtien)";
    $result2 = $conn->query($sql2);
    
    
    foreach ($chuoi as $c) {
        $day = substr($c,0,1);
        $ghe = "Ghe" . substr($c,1,2);
        $sql = "select * from danhsachghe where id_lichchieu = $id";
        $result = $conn->query($sql);
        $tmp = $result->fetch_assoc();
        $trong = $tmp['Trong'] - 1;

        //Thay đổi trạng thái ghế khách hàng vừa đặt thành ghế đã đặt
        $sql1 = "update danhsachghe set $ghe = 1, Trong = $trong where id_lichchieu = $id and DayGhe = '$day'";
        $result1 = $conn->query($sql1);
    }
    
    header("location: myticket.php");  
?>
