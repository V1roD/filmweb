<?php
if(session_id()=='') session_start();
if (isset($_SESSION['login_id'])==false){
    header("location:login.php");
    exit();
}
$phone = $_SESSION['login_user'];
$loi ="";
if(isset($_POST['btndoimatkhau'])==true){
    $matkhaucu = $_POST['matkhaucu'];
    $matkhaumoi_1 = $_POST['matkhaumoi_1'];
    $matkhaumoi_2 = $_POST['matkhaumoi_2'];

    $conn = new PDO("mysql:host=localhost; dbname=cinema;charset=utf8","root","");
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM account WHERE phone = ? AND password = ?";
    $stmt = $conn -> prepare($sql); 
    $stmt -> execute([$phone,$matkhaucu]);
    if($stmt -> rowCount()==0){
        $loi = "Mật khẩu cũ không chính xác <br>";
    }
    if($matkhaumoi_1 != $matkhaumoi_2){
        $loi = "Nhập lại mật khẩu không trùng khớp <br>";
    }
    if($loi ==""){
        $sql = "UPDATE account SET password = ? WHERE phone =?";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([ $matkhaumoi_1,$phone]);
        //echo "Đã cập nhật mật khẩu mới";
        header("location:index.php");
        exit();
    }
}


?>
<!DOCTYPE html>
<html >
<head>
    <title>Cinema - Đổi mật khẩu</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <div class="img-bg">
            <img src="images/1.jpg">
        </div>
        <div class="noi-dung">
            <div class="form">
                <form method="POST">
                <H4 class="mb-3 TEXT-CENTER" style="width:600px;" class="border border-primary border-2 m-auto p-2">
                    ĐỔI MẬT KHẨU
                </H4>
        <?php if($loi!=""){ ?>
            <div class ="alert alert-secondary"> <?php echo $loi?></div>
        <?php }?>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input value="<?php echo $phone ?>" type="phone" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="matkhaucu" class="form-label">Mật khẩu cũ</label>
            <input value="<?php if(isset($matkhaucu)==true) echo $matkhaucu?>" type="password" class="form-control" id="matkhaucu" name="matkhaucu">
        </div>
        <div class="mb-3">
            <label for="matkhaumoi_1" class="form-label">Mật khẩu mới</label>
            <input value="<?php if(isset($matkhaumoi_1)==true) echo $matkhaumoi_1?>"type="password" class="form-control" id="matkhaumoi_1" name="matkhaumoi_1">
        </div>
        <div class="mb-3">
            <label for="matkhaumoi_2" class="form-label">Nhập lại mật khẩu</label>
            <input value="<?php if(isset($matkmatkhaumoi_2haucu)==true) echo $matkhaumoi_2?>"type="password" class="form-control" id="matkhaumoi_2" name="matkhaumoi_2">
        </div>
    

        <button type="submit" name="btndoimatkhau" value="doimk" class="btn btn-primary">Đổi mật khẩu</button>
        <div class="input-form">
            <p>Trở về trang chủ? <a href="index.php">Trang chủ</a></p>
        </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>