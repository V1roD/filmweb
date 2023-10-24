<?php
    session_start();
    $_SESSION['pre'] = $_SERVER['HTTP_REFERER'];
?>

<!DOCTYPE html>

<head>
    <title>Cinema - Chi tiết phim</title>
    <meta charset="utf-8">
    <script src="myscript.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



    <!-- Css Styles -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">

    <style>
        body {
            background-image: url();
        }
    </style>
</head>
<body>
    <!-- Thanh menu-->
    <nav style="background-color: #fff7eb;" class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container"><a href="index.php" class="navbar-brand d-flex align-items-center"> <i class="fa fa-snowflake-o fa-lg text-primary mr-2"></i><strong>CINEMA</strong></a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <?php 
                    if (!isset($_SESSION["login_id"])) {
                ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="login.php" class="nav-link"> ĐĂNG NHẬP </a></li>
                    <li class="nav-item active"><a href="REGISTER.php" class="nav-link"> ĐĂNG KÝ </a></li>
                </ul>

                <?php
                    }
                    elseif (isset($_SESSION["login_id"])) {
                       
                ?>
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link"> XIN CHÀO <?= mb_strtoupper($_SESSION["login_username"]) ?> ! </a></li>
                    <li class="nav-item active"><a href="change_password.php" class="nav-link"> ĐỔI MẬT KHẨU </a></li>
                    <li class="nav-item active"><a href="logout.php" class="nav-link"> ĐĂNG XUẤT</a></li>
                </ul>
                <?php
                    }
                ?>
                
            </div>
        </div>
    </nav>
    <!-- Kết thúc menu-->

    <!-- Thanh header chức năng -->
    <header class="header-section">
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <span>Xem phim</span>
                        <ul class="depart-hover">
                        <li><a href="listmovie.php?type=1">Chiếu rạp</a></li>
                        <li><a href="listmovie.php?type=0">Miễn phí</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nav-depart">
                    <div class="depart-btn">
                        <span>Cụm Rạp</span>
                        <ul class="depart-hover">
                        <li>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="myticket.php">Vé Của Tôi</a></li>
                        <li><a >Ưu đãi</a></li>
                        <li><a >Liên hệ</a></li>
                        <li><a >Giới thiệu</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap">

                </div>
            </div>
        </div>

    </header>

    <div class="bg-white py-5">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <?php
                    $id = $_GET["id"];    

                    include'./config.php';
                    $sql = "Select * FROM movie where id = $id";
                    $result = $conn->query($sql);

                    
                    
                    while($tmp = $result->fetch_assoc()) {
                        $ten = mb_strtoupper($tmp['TenPhim']);
                        $date = strtotime($tmp['NgayChieu']);
                        if ($tmp['DoTuoi'] == 0) {
                            $dotuoi = "P - PHIM DÀNH CHO MỌI ĐỐI TƯỢNG";
                        }
                        else {
                            $dotuoi = "C" .$tmp['DoTuoi']. " - PHIM CẤM KHÁN GIẢ DƯỚI " .$tmp['DoTuoi'] . " TUỔI";
                        }
                        $url = "images/" . $tmp['Poster'];

                        
                ?>

                <!--Link ảnh-->
                <div class="col-lg-4 px-5 mx-auto"><img src=<?= $url?> alt="" class="img-fluid mb-4 mb-lg-0"></div>
                <div class="col-lg-5 order-2 mx-auto">
                    <!--Tên phim-->
                    <h2 style="font-weight=bold" ><b><?= $ten ?></b></h2>

                    <!--Thông tin của phim-->
                    <p><b>Đạo diễn:</b> <?= $tmp['DaoDien'] ?></p>
                    <p style="text-align: justify;"><b>Diễn viên:</b> <?= $tmp['DienVien'] ?></p>
                    <p><b>Thể loại:</b> <?= $tmp['TheLoai'] ?></p>
                    <p><b>Khởi chiếu:</b> <?= date('d/m/Y', $date); ?></p>
                    <p><b>Thời lượng:</b> <?= $tmp['ThoiLuong'] ?> phút</p>
                    <p><b> Rated: <?= $dotuoi ?></b> </p>
                    
                
                    <!--Link nút mua vé-->
                    <button type="button" data-id=<?=$tmp['TenPhim']?> data-toggle="modal" onclick="notification()" class="btnChiTiet" data-target="#myModal">Xem phim</button>

                    <!-- The Modal -->
                    <div class="modal fade" id="myModal">

                    <?php 
                            if (!isset($_SESSION["login_id"])) {
                        ?>

                    <form action="login.php" method="POST">`
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                            
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Nhắc nhở</h4>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div action = "" class="form-group" method="GET" >
                                <p>Bạn phải đăng nhập trước khi xem</p>     
                                        
                                </div>
                                
                            </div>                        
                            <!-- Modal footer -->
                            <div style="margin-top: 50px;" class="modal-footer">
                                <input name="id" id="id" type="hidden" value=<?= $tmp['id']?>>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                <button style="width: 110px;" type="submit" class="btn btn-primary">Đăng nhập</button>
                            
                            </div>
                            </div>
                        </div>
                        </form>

                            <?php } else {?>

                        <form action="booking.php" method="POST">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                            
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <?php echo" <h4 class='modal-title'>$ten</h4>"; ?>
                                
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            <iframe src=<?= $tmp['Trailer'] ?> frameborder="0" allowfullscreen class="embed-responsive-item"></iframe>
                                
                            </div>                        
                            <!-- Modal footer -->
                            <div style="margin-top: 50px;" class="modal-footer">
                                <input name="id" id="id" type="hidden" value=<?= $tmp['id']?>>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                               
                            </div>
                            </div>
                        </div>
                        </form>
                        <?php } ?>
                    </div>
                    

                    
                </div>
            </div>
            <div class="row">
                <div class="filter-control" style="margin: auto; padding:auto">
                    <ul>
                        <li class="active">Giới thiệu phim</li>
                    </ul>
                </div>
                <p style="text-align: justify; margin: bottom 20px;"><?= $tmp['MoTa'] ?></p>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src=<?= $tmp['Trailer'] ?> frameborder="0" allowfullscreen class="embed-responsive-item"></iframe>
                </div>
            </div>
            <?php } ?>
        </div>
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

    <!-- Js Plugins -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</html>