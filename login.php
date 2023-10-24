<?php
    session_start();
    $loi="";
    //print_r($_POST);
    if(isset($_POST['nutdangnhap'])==true){
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        if(strlen($phone)==0){
            $loi .="Vui lòng nhập số điện thoại <br>";
        }
        if(strlen($password)==0){
            $loi .="Vui lòng nhập mật khẩu <br>";
        }
        if($loi==""){
        $conn = new PDO("mysql:host=localhost; dbname=cinema;charset=utf8","root","");
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM account WHERE phone =? AND password =?";
        $stmt = $conn -> prepare($sql); //tạo prepare stement
        $stmt -> execute([$phone, $password]);
        if($phone == 'admin' && $password == '123456'){
            header("location: admin.php");
        }
        else if($stmt ->rowCount()==1){
            $user = $stmt -> fetch();
            $_SESSION['login_id'] = $user['id'];
            $_SESSION['login_user'] = $phone;
            $_SESSION['login_username'] = $user['username'];
        
            if (!isset($_SESSION['pre'])) {
                header("location:" . $_SESSION['pre']);
            } else {
                header("location:index.php");
            }
            
            exit();
        }
        else{
            $loi .="Số điện thoại hoặc mật khẩu không chính xác <br>";
            }
        }
    }
?>
<!DOCTYPE html>
<html >
<head>
    <title>Cinema - Đăng nhập</title>
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
        <?php if($loi!="") { ?>
        <div class ="alert alert-danger"><?php echo $loi?></div>
        <?php } ?>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input value = "<?php if(isset($phone)== true) echo $phone;  ?>" type="phone" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input value = "<?php if(isset($password)== true) echo $password;?>" type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
        </div>
      
        <button type="submit" name="nutdangnhap" value="dangnhap" class="btn btn-primary">Đăng nhập</button>
        <div class="input-form">
            <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
            <p>Bạn <a href="sendpassword.php">Quên mật khẩu?</a></p>
            <p>Quay trở lại <a href="index.php">Trang chủ</a></p>
        </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>