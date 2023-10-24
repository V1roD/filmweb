<?php
    include'./config.php';
    if(isset($_POST['addlichchieuphim'])==true){
        $TenPhim = $_POST['TenPhim'];
        $TenCum = $_POST['TenCum'];
        $TenRap = $_POST['TenRap'];
        $LoaiVe = $_POST['LoaiVe'];
        $Ngay = $_POST['Ngay'];
        $Gio = $_POST['Gio'];
        $sql = "INSERT INTO lichchieu SET TenPhim=?, TenCum=?, TenRap=?, LoaiVe=?, Ngay=?,Gio=?";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([ $TenPhim, $TenCum, $TenRap, $LoaiVe,$Ngay,$Gio]);
        header("location:lichchieuphim.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Cinema Admin</title>
</head>

<!-- Thanh menu-->
<nav style="background-color: #fff7eb;" class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container"><a href="admin.php" class="navbar-brand d-flex align-items-center"> <i class="fa fa-snowflake-o fa-lg text-primary mr-2"></i><strong>ADMIN</strong></a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                        PHIM
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="phimdangchieu.php">ĐANG CHIẾU</a>
                            <a class="dropdown-item" href="phimsapchieu.php">SẮP CHIẾU</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="danhsachphim.php">TẤT CẢ PHIM</a>
                        </div>
                    </li>
                    <li class="nav-item active"><a href="danhsachrapphim.php" class="nav-link">RẠP PHIM </a></li>
                    <li class="nav-item active"><a href="lichchieuphim.php" class="nav-link"> LỊCH CHIẾU</a></li>
                    <li class="nav-item active"><a href="thongtinkhachhang.php" class="nav-link">KHÁCH HÀNG </a></li>
                    <li class="nav-item active"><a href="thongke.php" class="nav-link">THỐNG KÊ</a></li>
                    <li class="nav-item active"><a href="danhsachve.php" class="nav-link">ĐẶT VÉ</a></li>
                    <li class="nav-item active"><a href="logout.php" class="nav-link"> ĐĂNG XUẤT</a></li>
                </ul>
            </div>
        </div>
    </nav>

<body>
    <div class="container" style="padding: 100px">
    <h1 style="text-align: center;">THÊM LỊCH CHIẾU PHIM</h1>
    <h5 style="text-align: center;"><a href="./lichchieuphim.php">Trở về lịch chiếu phim</a></h5>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Phim</label>
            <div class="mb-3">
                <select name="TenPhim" class="form-select" required aria-label="select example" style="width: 100%">
                <option value="">Chọn phim</option>
                <?php 
                    include'./config.php';
                    $sql = "Select * FROM movie";
                    $result = $conn->query($sql);

                    while($tmp = $result->fetch_assoc()) {
                ?>
                    <option value="<?=$tmp['TenPhim']?>"><?=$tmp['TenPhim']?></option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Tên cụm</label>
            <div class="mb-3">
                <select name="TenCum" class="form-select" required aria-label="select example" style="width: 100%">
                <option value="">Chọn cụm rạp</option>
                <?php 
                    include'./config.php';
                    $sql = "Select * FROM cumrap";
                    $result = $conn->query($sql);

                    while($tmp = $result->fetch_assoc()) {
                ?>
                    <option value="<?=$tmp['TenCum']?>"><?=$tmp['TenCum']?></option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Tên rạp</label>
            <div class="mb-3">
                <select name="TenRap" class="form-select" required aria-label="select example" style="width: 100%">
                    <option value="">Chọn phòng</option>
                    <option value="Phòng 1">Phòng 1</option>
                    <option value="Phòng 2">Phòng 2</option>
                    <option value="Phòng 3">Phòng 3</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Loại vé</label>
            <div class="mb-3">
                <select name="LoaiVe" class="form-select" required aria-label="select example" style="width: 100%">
                    <option value="">Chọn loại vé</option>
                    <?php 
                    include'./config.php';
                    $sql = "Select * FROM vephim";
                    $result = $conn->query($sql);

                    while($tmp = $result->fetch_assoc()) {
                ?>
                    <option value="<?=$tmp['LoaiVe']?>"><?=$tmp['TenVe']?></option>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Ngày</label>
            <input type="date" class="form-control" id="Ngay" name="Ngay">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Giờ</label>
            <input type="time" class="form-control" id="Gio" name="Gio">
        </div>
       
    
        <button type="submit" name="addlichchieuphim" class="btn btn-primary">Thêm lịch chiếu phim</button>
    </form>
    </div>


</body>
<!--THÀNH VIÊN NHÓM -->
<div style="background-color: #fff7eb;" class="py-5">
    <div class="container py-5">
        <div class="row mb-4">
        <div class="col-lg-5">
            <h2 class="display-4 font-weight-light">Our team</h2>
            <p class="font-italic text-muted">Website had built by us.</p>
        </div>
        </div>

        <div class="row text-center">
        <!-- Tuấn-->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834132/avatar-4_ozhrib.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
            <h5 class="mb-0">Huỳnh Anh Tuấn</h5><span class="small text-uppercase text-muted">52000291</span>
            <ul class="social mb-0 list-inline mt-3">
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
            </ul>
            </div>
        </div>
        <!-- End-->

        <!-- Bảo-->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834130/avatar-3_hzlize.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
            <h5 class="mb-0">Thái Gia Bảo</h5><span class="small text-uppercase text-muted">52000014</span>
            <ul class="social mb-0 list-inline mt-3">
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
            </ul>
            </div>
        </div>
        <!-- End-->

        <!-- Huy -->
        <div class="col-xl-4 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-1_s02nlg.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
            <h5 class="mb-0">Hồ Minh Huy</h5><span class="small text-uppercase text-muted">52000666</span>
            <ul class="social mb-0 list-inline mt-3">
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#" class="social-link"><i class="fa fa-linkedin"></i></a></li>
            </ul>
            </div>
        </div>
        <!--End-->

        </div>
    </div>
    </div>

    <!-- footer-->
    <footer style="background-color: #fff7eb;" class="pb-5">
    <div class="container text-center">
        <p class="font-italic text-muted mb-0">&copy; CÔNG TY TNHH BTH VIETNAM.</p>
        <p class="font-italic text-muted mb-0"> Địa Chỉ: Số 19, Nguyễn Hữu Thọ, P.Tân Phong, Q.7, TPHCM.</p>
        <p class="font-italic text-muted mb-0"> Hotline: 1900 6017.</p>
        <p class="font-italic text-muted mb-0"> COPYRIGHT 2017 CJ CGV. All RIGHTS RESERVED .</p>
    </div>
    </footer>
</html>