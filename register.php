<?php
$loi="";
if(isset($_POST['submit'])==true){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email =$_POST['email'];
    $birthday = $_POST['birthday'];
   
    if($password != $repassword){
        $loi = "Nhập lại mật khẩu không trùng khớp <br>";
    }
    if(strlen($phone)==0){
        $loi .="Vui lòng nhập số điện thoại <br>";
    }
    if(strlen($phone)<9){
        $loi .="Số điện thoại không chính xác <br>";
    }
    if(strlen($username)==0){
        $loi .="Vui lòng nhập họ và tên <br>";
    }
    if(strlen($password)==0){
        $loi .="Vui lòng nhập mật khẩu <br>";
    }
    if(strlen($email)==0){
        $loi .="Vui lòng nhập email <br>";
    }
    if(strlen($birthday)<10){
        $loi .="Vui lòng nhập ngày sinh <br>";
    }


    if($loi==""){
        include 'config.php';
        $sql = "INSERT INTO account SET username=?, phone=?, password=?, email=?, birthday=? ";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([ $username, $phone, $password, $email,$birthday]);
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html >
<head>
    <title>Cinema - Đăng ký</title>
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
            ĐĂNG KÝ TÀI KHOẢN
        </H4>
        <?php if($loi!="") { ?>
            <div class ="alert alert-danger"><?php echo $loi?></div>
            <?php } ?>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input onblur="checkphone(this)" value="<?=(isset($phone)? $phone:"")?>" type="phone" class="form-control" id="phone" name="phone" placeholder ="Nhập số điện thoại">
            <div id="loiphone" class ="form-text text-danger"></div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input value="<?=(isset($password)? $password:"")?>"  type="password" class="form-control" id="password" name="password" placeholder ="Nhập mật khẩu">
        </div>

        <div class="mb-3">
            <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
            <input value="<?=(isset($password)? $password:"")?>" type="repassword" class="form-control" id="repassword" name="repassword" placeholder ="Nhập lại mật khẩu">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Họ và tên</label>
            <input value="<?=(isset($username)? $username:"")?>"  type="username" class="form-control" id="username" name="username" placeholder ="Nhập họ và tên">
            <div id="loiusername" class ="form-text"></div>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?=(isset($email)? $email:"")?> "  type="email" class="form-control" id="email" name="email" placeholder ="Nhập email">
            <div id="loiemail" class ="form-text"></div>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Ngày sinh</label>
            <input value="<?=(isset($birthday)? $birthday:"")?> " type="date" class="form-control" id="birthday" name="birthday" >
            <div id="loibirthday" class ="form-text"></div>
        </div>

        
    
        <button type="submit" name="submit" value="nutgui" class="btn btn-primary">Đăng ký</button>
        <div class="input-form">
            <p>Trở về  <a href="login.php">Đăng nhập</a></p> 
            <p>Trở về  <a href="index.php">Trang chủ</a></p>
            
        </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>

<script>
    function checkphone(obj){
        var phone = obj.value;
        var url ="http://localhost/check_phone.php?phone=" + phone;
        fetch(url)
        .then(d => d.json())
        .then(data => {
            if(data.count >0){
                document.getElementById('loiphone').innerText="Số điện thoại "+ phone +" đã có người dùng";
            }
            else{
                document.getElementById('loiphone').innerText="Bạn có thể dùng số "+ phone +" để đăng ký";
            }
        })
    }
</script>
