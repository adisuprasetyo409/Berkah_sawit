<?php
include 'config/app.php';
//ambil koneksi dari koneksi.php

// Perintah untuk menampilkan data
$datakegiatan = select("SELECT * FROM db_kegiatan ORDER BY id DESC");

// perintah untuk membaca dan mengambil data dalam bentuk array

session_start();

//atur variabel
$err        = "";
$username   = "";
$ingataku   = "";

if(isset($_COOKIE['cookie_username'])){
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "select * from db_user where username = '$cookie_username'";
    $q1   = mysqli_query($koneksi,$sql1);
    $r1   = mysqli_fetch_array($q1);
    if($r1['password'] == $cookie_password){
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

if(isset($_SESSION['session_username'])){
    header("location: admin/index.php");
    exit;
}

if(isset($_POST['login'])){
    $username   = isset($_POST['username']) ? $_POST['username'] : '';
    $password = $_POST['password'];
    $ingataku   = isset($_POST['ingataku']);

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $sql1 = "SELECT * FROM db_user where username ='$username'";
        $qry = mysqli_query($koneksi,$sql1);
        $num = mysqli_num_rows($qry);
        $row = mysqli_fetch_array($qry);
    
        if ($num==0 OR $username!=$row['username']) {
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        }
        elseif($row['password'] != md5($password)){
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       
        
        if(empty($err)){
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = md5($password);

            if($ingataku == 1){
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            }
            header("location:admin/index.php");
        }
    }
}
?>
 
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Bekah Sawit</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> berkahsawit@google.com</p>
                    <p> <i class='bx bxs-phone-call'></i> 0822-7845-XXXX</p>
                </div>
                <div class="col-auto social-icons">
                    <a href="https://www.facebook.com/profile.php?id=100071366413355"><i class='bx bxl-facebook'></i></a>
                    <a href="https://goo.gl/maps/99EeJrotBTJYKpzNA"><i class="bi bi-geo-alt-fill"></i></a>       
                    <a href="https://instagram.com/_berkahsawit?igshid=YmMyMTA2M2Y="><i class='bx bxl-instagram'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">BerkahSawit<span class="dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#monitoring">Kegiatan</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Portfolio</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="login.php">LOGIN COK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">LOG OUT</a>
                    </li> -->
                </ul>
                <a href="login.php" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-brand ms-lg-3">login</a>
            </div>
        </div>
    </nav>

    <!-- SLIDER -->
    <div class="owl-carousel owl-theme hero-slider">
        <div class="slide slide1">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h6 class="text-white text-uppercase">SIMALUNGUN</h6>
                        <h1 class="display-3 my-4">PENJUALAN BIBIT<br />BERSERTIFIKAT </h1>
                        <!-- <a href="#" class="btn btn-brand">Get Started</a> -->
                        <!-- <a href="#" class="btn btn-outline-light ms-3">Our work</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h6 class="text-white text-uppercase">L A U T A N&nbsp; S A W I T</h6>
                        <h1 class="display-3 my-6">PROSES PENGANGKUTAN<br />DAN PENGIRIMAN</h1>
                        <!-- <a href="#" class="btn btn-brand">Get Started</a> -->
                        <!-- <a href="#" class="btn btn-outline-light ms-3">Our work</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 py-5">
                    <div class="row">

                        <div class="col-12">
                            <div class="info-box">
                                <img src="img/icon6.png" alt="">
                                <div class="ms-4">
                                    <h5>Berkah Sawit</h5>
                                    <p>Pembibitan kelapa sawit berkualitas dengan bibit dari PPKS-MEDAN </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/icon4.png" alt="">
                                <div class="ms-4">
                                    <h5>VISI</h5>
                                    <p>Menjadikan pembibitan kelapa sawit yang memliki setandar nasional (SNI) </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/icon5.png" alt="">
                                <div class="ms-4">
                                    <h5>MISI</h5>
                                    <p>Membantu para petani sawit yang membutuhkan bibit berkulitas agar mendapatkan hasil
                                        panen yang optimal
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="img/marsidi.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- MILESTONE -->
    <section id="milestone">
        <div class="container">
            <div class="row text-center justify-content-center gy-4">
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-9">99K+</h1>
                    <p class="mb-0">Penjualan Bibit</p>
                </div>
                <!-- <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">45M</h1>
                    <p class="mb-0">Lines of code</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">190</h1>
                    <p class="mb-0">Total Downloads</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">380K</h1>
                    <p class="mb-0">YouTube Subscribers</p>
                </div> -->
            </div>
        </div>
    </section>





	


    <!-- Monitoring -->
    <section id="monitoring" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>KEGIATAN</h6>
                        
                        <h1>KEGIATAN PEMBIBITAN</h1>
                        <p class="mx-auto">Menampilkan nilai kelembapan tanah, setatus tanah, status pompa, serta waktu melakukan penyiraman</p>
                    </div>
                </div>
            </div>
            <?php foreach ($datakegiatan as $key):?>
            <div class="row g-5">
                <div class="col-lg-7 col-md-10">
                    <div class="service">
                        <img src="admin/assets/img/<?= $key['foto']; ?>" alt="" class="iconn" >
                        <h5>Keterangan</h5>
                        <p><?=$key["keterangan"]; ?></p>

                    </div>
                    <hr>
                </div>
                
            </div>
            <?php endforeach; ?>
        </div>
    </section>


    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Team</h6>
                        <h1>Team Members</h1>
                        <p class="mx-auto">Terus Konsisten Mengembangkan, Dan Selalu Mengutamakan Kebutuhan Konsumen</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/edo.png" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Adi Suprasetyo</h5>
                        <p>Marketing Coordinator</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/edo.png" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Edo Fernando</h5>
                        <p>Pemasaran</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/edo.png" alt="">
                            <div class="social-icons">
                                <a href="https://www.facebook.com/hardy.glutera"><i class='bx bxl-facebook'></i></a>
                    
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Hardi</h5>
                        <p>Penyiraman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light" id="reviews">

        <div class="owl-theme owl-carousel reviews-slider container">
            <div class="review">
                <div class="person">
                    <img src="img/team_1.jpg" alt="">
                    <h5>HUSEN PRABOWO</h5>
                    <small>PEMBELI</small>
                </div>
                <h3>Bibit Yang Dijual Dengan Kulitas Bagus, Kurang Daru 4 Tahun Sudah Bisa Menghasilka Buah Pasir</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <div class="review">
                <div class="person">
                    <img src="img/team_2.jpg" alt="">
                    <h5>REZA</h5>
                    <small>PEMBELI</small>
                </div>
                <h3>Pelayanan sangat bagus pegawainya sangat ramah, dan pekerjanya enak diajak ngobrol</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <!-- <div class="review">
                <div class="person">
                    <img src="img/team_3.jpg" alt="">
                    <h5>Ralph Edwards</h5>
                    <small>Market Development Manager</small>
                </div>
                <h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut quis, rem culpa labore voluptate
                    ullam! In, nostrum. Dicta, vero nihil. Delectus minus vitae rerum voluptatum, excepturi incidunt ut,
                    enim nam exercitationem optio ducimus!</h3>
                <div class="stars">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class="bx bxs-star-half"></i>
                </div>
                <i class='bx bxs-quote-alt-left'></i>
            </div> -->
        </div>
    </section>


    <footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h4 class="navbar-brand">BerkahSawit<span class="dot">.</span></h4>
                        <p>Berkah Sawit adalah pembibitan kelapa sawit yang dikelola dengan teknologi 
                            penyiraman otomatis berbasis 
                            <br><i>Internet of things</i> </p>
                        <div class="col-auto social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100071366413355"><i class='bx bxl-facebook'></i></a>
                        <a href="https://goo.gl/maps/99EeJrotBTJYKpzNA"><i class="bi bi-geo-alt-fill"></i></a>       
                        <a href="https://instagram.com/_berkahsawit?igshid=YmMyMTA2M2Y="><i class='bx bxl-instagram'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0">Copyright@2022. All rights Reserved</p>
        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="container-fluid">
                        <div class="row gy-4">
                            <div class="col-lg-4 col-sm-12 bg-cover"
                                style="background-image: url(img/c2.jpg); min-height:300px;">
                                <div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <form class="p-lg-5 col-12 row g-3" action="" method="POST">
                                    <div>
                                        <h2 class="navbar-brand">BerkahSawit<span class="dot">.</span></h2>
                                    <p>login Khusus Admin</p>
                                    <?php if($err){ ?>
                                        <div id="login-alert" class="alert alert-danger col-sm-12">
                                            <ul><?php echo $err ?></ul>
                                        </div>
                                    <?php } ?>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <label for="userName" class="form-label">Username</label>
                                        <input type="text" class="form-control" 
                                            aria-describedby="emailHelp" id="username" value=
                            
                                    <div class="col-6">
                                        <label for="userName" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="password"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" >L O G I nN</button>
                                </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn btn-brand">L O G I N</button>
                                    </div> -->
                                <!-- </form> -->


                                <form action="" method="POST">
                                <div class="form-group">
                                    <label class="sr-only" for="username">Username</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $username ?>" placeholder="username">                         
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="Password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                
                                    </div>
                                    <a href="####" id="emailHelp" class="form-text text-muted text-right">Lost Password?</a>
                                </div>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input id="login-remember" type="checkbox" name="ingataku" value="1" <?php if($ingataku == '1') echo "checked"?>> Ingat Aku
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" >L O G I N</button>
                                </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>