<?php
$loi ="";
$thongbao="";
if(isset($_POST['nutguiyeucau'])==true){
    $email = $_POST['email'];
    $conn = new PDO("mysql:host=localhost; dbname=cinema;charset=utf8","root","");
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql ="SELECT * FROM account WHERE email=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$email]);
    $count = $stmt ->rowCount();
    if($count ==0){
        $loi = "Email bạn nhập chưa đăng ký thành viên, vui lòng nhập lại";
    }
    else{
        $matkhaumoi =substr( md5(rand(0,999999)),0,8);
        $sql = "UPDATE account SET password =? WHERE email=?";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([$matkhaumoi,$email]);
        //echo "Đã cập nhật";
        GuiMatKhauMoi($email,$matkhaumoi);

    }//else
}

?>
<?php
    function GuiMatKhauMoi($email,$matkhaumoi){
        require "PHPMailer-master/src/PHPMailer.php"; 
        require "PHPMailer-master/src/SMTP.php"; 
        require 'PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
        try {
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'giabaolht21@gmail.com'; // SMTP username
            $mail->Password = 'gohu owpj nwet jiiv';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('giabaolht21@gmail.com', 'Admin Cinema' ); 
            $mail->addAddress($email); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Thư gửi lại mật khẩu';
            $noidungthu = "<p> Bạn nhận được thư này do bạn hoặc ai đó yêu cầu mật khẩu mới </p>
                Mật khẩu mới của bạn là { $matkhaumoi}
            "; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            echo 'Đã gửi';
        } catch (Exception $e) {
            echo 'Error: ', $mail->ErrorInfo;
        }
    }

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<form method="POST" style="width:600px;" class="border border-primary border-2 m-auto p-2">
    <H4 class="mb-3 TEXT-CENTER">
        QUÊN MẬT KHẨU
    </H4>
        <?php if($loi!="") { ?>
            <div class="alert alert-danger"> <?php echo  $loi ?> </div>
        <?php } ?>
    <div class="mb-3">
        <label for="email" class="form-label">Nhập Email</label>
        <input value="<?php if(isset($email)==true) echo $email ?>" type="email" class="form-control" id="email" name="email">
    </div>
  
    <button type="submit" name="nutguiyeucau" value="nutgui" class="btn btn-primary">Gửi yêu cầu</button>
    <div class="input-form">
        <p>Trở về trang đăng nhập? <a href="login.php">Đăng nhập</a></p>
    </div>
</form>