<!DOCTYPE html>

<head>
<title>Cinema - Đặt vé</title>
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
                ?>
                
            </div>
        </div>
    </nav>
    <!-- End-->

    <!-- Header Section Begin -->
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

    <?php 
        $cumrap = $_POST["cumrap"];
        $ngay = $_POST["suat"];
        $gio = $_POST["gio"];
        $id = $_POST["id"];

        include'./config.php';
        $sql = "Select TenPhim FROM movie where id = $id";
        $result = $conn->query($sql);
        $tmp = $result->fetch_assoc();
        $tenphim = $tmp['TenPhim'];
    ?>

    <div class="bg-white py-5">
        <div class="container py-5">
        <form action="order.php" method="POST">
            <div class="row align-items-center mb-5">

                
                <div class="col-lg-7 px-5 mx-auto">
                    <div id="map" class="seatmap">
                        <div class="screen">Màn Hình</div>
                        
                        <?php 

                            $sql2 = "Select * FROM lichchieu where TenPhim = '$tenphim' and Ngay = '$ngay' and Gio = '$gio' and TenCum = '$cumrap'";
                            $result2 = $conn->query($sql2);
                            $tmp2 = $result2->fetch_assoc();
                            $id_lichchieu = $tmp2['id'];
                            $date = strtotime($tmp2['Ngay']);
                            $ve = $tmp2['LoaiVe'];

                            $sql4 = "Select * FROM vephim where LoaiVe='$ve'";
                            $result4 = $conn->query($sql4);
                            $tmp4 = $result4->fetch_assoc();
                            $giave = $tmp4['GiaVe'];

                            $sql3 = "Select * FROM danhsachghe where id_lichchieu = $id_lichchieu ORDER BY DayGhe ASC";
                            $result3 = $conn->query($sql3);
                            while($tmp = $result3->fetch_assoc()) {
                            $i = 1;
                        ?>
                        <input type="hidden" id="lichchieu" name="lichchieu" value="<?= $id_lichchieu?>">
                        <input type="hidden" id="giave" name="giave" value="<?= $giave?>">

                        <div class="row"> 
                            <div style="margin-right: 15px; margin-top: 7px; width: 15px; text-align:center;"><b><?= $tmp['DayGhe']?></b></div>
                            
                            <?php
                                for ($i; $i<=10; $i++) {
                                    $s = 'Ghe'.$i;
                                    if ($tmp[$s] == 0) {
                                        $index = $tmp['DayGhe'].$i;
                            ?>

                            <div style="color: black;" onclick="document.getElementById('ghe').innerHTML = document.getElementById('ghe').innerHTML + '<?= $index?>' + ' ';
                            document.getElementById('seat').value = document.getElementById('ghe').innerHTML;
                            var i =  Number(document.getElementById('gia').innerHTML.slice(0,-8) + '000') + <?= $giave?>;
                            document.getElementById('gia').innerHTML =  i/1000 + ',000 VNĐ';
                            this.style.backgroundColor='rgb(0, 136, 0)';" class="seat" ><?= $i?></div>



                            <?php
                                    }
                                    else {
                            ?>
                            <div class="seat sold"><?= $i?></div>
                            <?php
                                    }   
                                } 
                            ?>
                                    
                            </div>
                        <?php } ?>

                        

                        <ul class="showcase">
                            <li>
                                <div class="seat"></div>
                                <small>Trống</small>
                            </li>
                            <li>
                                <div class="seat selected"></div>
                                <small>Đang chọn</small>
                            </li>
                            <li>
                                <div class="seat sold"></div>
                                <small>Đã bán</small>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 order-2 mx-auto">
                
                    
                    <h2 style="font-weight=bold; color: #dd7600;"><b><?= $tenphim ?></b></h2>
                    <p><b>Cụm rạp:</b> <?= $cumrap ?></p>
                    <p><b>Rạp:</b> <?= $tmp2['TenRap'] ?></p>
                    <p><b>Loại vé:</b> <?= $ve ?></p>
                    <p><b>Suất chiếu:</b> <?= $tmp2['Gio'] . " - ". date('d/m/Y', $date); ?></p>
                    <a style="color: #636363;"><b>Ghế đã chọn: </b><a id="ghe" name="ghe"></a></a>
                    <input type="hidden" id="seat" name="seat" value="">
                    <br><br>
                    <a style="color: #636363;"><b>Giá vé:</b> <a id="gia">0,000 VNĐ</a></a>
                    <br><br>
                    <!--Link nút mua vé-->
                    <button class="btnChiTiet" type="submit">Đặt vé</button>
                
                </div>
                
            </div>
        </form>
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