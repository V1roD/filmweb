<!DOCTYPE html>

<head>
    <title>Cinema - Vé của tôi</title>
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
    <!-- Thanh menu-->
    <nav style="background-color: #fff7eb;" class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container"><a href="index.php" class="navbar-brand d-flex align-items-center"> <i class="fa fa-snowflake-o fa-lg text-primary mr-2"></i><strong>CINEMA</strong></a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <?php 
                    session_start();
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
                    if (isset($_SESSION["datve"]) && $_SESSION["datve"] == 1) {
                        echo '<script>alert("Đặt vé thành công")</script>';
                        $_SESSION['datve'] = 0;
                    }
                ?>
                
            </div>
        </div>
    </nav>
    <!-- Kết thúc thanh menu-->

    <!-- Thêm các banner quảng cáo -->
    <header class="header-section">
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                    <span>Phim Mới</span>
                        <ul class="depart-hover">
                        <li><a href="listmovie.php?type=1">Đang chiếu</a></li>
                        <li><a href="listmovie.php?type=0">Sắp chiếu</a></li>
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


                
    <div style="padding: 50px">
        
        
        <?php 
           if (isset($_SESSION['login_id'])) {
            
         ?>
        <h4 style="text-align: center; padding-bottom:10px">Vé của tôi</h4>
        <div class="table-responsive" style="border: 1px;">
            <table class="table table-striped b-t b-light">
                <tr>
                    <th>STT</th>
                    <th>Tên Phim</th>
                    <th>Ngày xem</th>
                    <th>Giờ</th>
                    <th>Cụm rạp</th>
                    <th>Rạp</th>
                    <th>Loại vé</th>
                    <th>Danh sách ghế</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                </tr>

                <?php
                    $i = 1;
                    include'./config.php';
                    $id = $_SESSION['login_id'];
                    //Lấy danh sách vé của khách hàng ứng với id khách hàng
                    $result = mysqli_query($conn,"SELECT * FROM datve where id_KH = $id");
                    while($tmp = $result->fetch_assoc()) {
                        $id_LC = $tmp['id_lichchieu'];
                        $result2 = mysqli_query($conn,"SELECT * FROM lichchieu where id = $id_LC");
                        $tmp2 = $result2->fetch_assoc()
                ?>

                <tr>
                    
                    <th style="font-weight: 100;"><?=$i?></th>
                    <th style="font-weight: 100;"><?=$tmp2['TenPhim']?></th>
                    <th style="font-weight: 100;"><?=$tmp2['Ngay']?></th>
                    <th style="font-weight: 100;"><?=$tmp2['Gio']?></th>
                    <th style="font-weight: 100;"><?=$tmp2['TenCum']?></th>
                    <th style="font-weight: 100;"><?=$tmp2['TenRap']?></th>
                    <th style="font-weight: 100;"><?=$tmp2['LoaiVe']?></th>
                    <th style="font-weight: 100;"><?=$tmp['Ghe']?></th>
                    <th style="font-weight: 100;"><?= number_format($tmp['TongTien'])?> VNĐ</th>
                    <th style="font-weight: 100;"><?=$tmp['NgayDat']?></th>
      
                </tr>

                <?php $i++; } ?>
                
            </table>
        <?php
            } else {

        ?>  
            
            <h4 style="text-align: center; padding-bottom:10px">Vui lòng đăng nhập để xem vé của bạn.</h4>

        <?php
            }
        ?>
                
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