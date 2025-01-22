<?php
   session_start();
   include 'db.php'; // Menghubungkan ke database
   // Periksa apakah pengguna sudah login
   if (!isset($_SESSION['user_id'])) {
       // Jika belum login, arahkan ke halaman login
       header("Location: login.php");
       exit();
   }

   // Ambil data pengguna
$user_id = $_SESSION['user_id'];
$query = "SELECT nama_user, email_user FROM user WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>MyDreamFood</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo fix.jpg" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container"><span></span><span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="page">
      <!-- Page Header-->
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-modern-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="70px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a class="brand" href="homepage.php"><p style="font-size: 20px;">My DreamFood</p></a></div>
                </div>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Search-->
                    <div class="rd-navbar-search">
                      <button class="rd-navbar-search-toggle" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                      <form class="rd-search" action="#">
                        <div class="form-wrap">
                          <label class="form-label" for="rd-navbar-search-form-input">Search...</label>
                          <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="search">
                          <button class="rd-search-form-submit fl-bigmug-line-search74" type="submit"></button>
                        </div>
                      </form>
                    </div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item"><a class="rd-nav-link" href="homepage.php">Home</a>
                      </li>
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="about-us.php">About Us</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="typography.html">Subscription</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="contact-us.php">Contact Us</a>
                      </li>
                    </ul>
                  </div>
                  <div class="rd-navbar-project-hamburger" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
                    <div class="project-hamburger"><span class="project-hamburger-arrow-top"></span><span class="project-hamburger-arrow-center"></span><span class="project-hamburger-arrow-bottom"></span></div>
                    <div class="project-hamburger-2"><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span>
                    </div>
                    <div class="project-close"><span></span><span></span></div>
                  </div>
                </div>
                <div class="rd-navbar-project rd-navbar-modern-project">
                <div class="rd-navbar-project-modern-header">
                    <h4 class="rd-navbar-project-modern-title"><?php echo htmlspecialchars($user['nama_user']); ?></h4>
                    <div class="rd-navbar-project-hamburger" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
                      <div class="project-close"><span></span><span></span></div>
                    </div>
                  </div>
                  <div class="rd-navbar-project-modern-header">
                  <h5 class="rd-navbar-project-modern-title"><?php echo htmlspecialchars($user['email_user']); ?></h5>
                    <div class="rd-navbar-project-hamburger" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
                      <div class="project-close"><span></span><span></span></div>
                    </div>
                  </div>
                  <div class="rd-navbar-project-content rd-navbar-modern-project-content">
                    <div>
                      <p>kami membuat website ini hanya untuk tugas perkuliahan</p>
                      <ul class="rd-navbar-modern-contacts">
                        <li>
                          <div class="unit unit-spacing-sm">
                           <a href="update.php">Update akun</a>
                          </div>
                        </li>
                        <li>
                          <div class="unit unit-spacing-sm">
                           <a href="subs.php">Subscription</a>
                          </div>
                        </li>
                        <li>
                          <div class="unit unit-spacing-sm">
                           <a href="delete_akun.php">Delete akun</a></button>
                          </div>
                        </li>
                      </ul>
                      <ul class="list-inline rd-navbar-modern-list-social">
                        <!-- <li><a class="icon fa fa-facebook" href="#"></a></li>
                        <li><a class="icon fa fa-twitter" href="#"></a></li>
                        <li><a class="icon fa fa-google-plus" href="#"></a></li> -->
                        <li><a class="icon fa fa-instagram" href="#"></a></li>
                        <!-- <li><a class="icon fa fa-pinterest" href="#"></a></li> -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>  
        </div>
      </header>
      <!-- Breadcrumbs -->
      <section class="breadcrumbs-custom-inset">
        <div class="breadcrumbs-custom context-dark bg-overlay-46">
          <div class="container">
            <h2 class="breadcrumbs-custom-title">About Our Farm</h2>
            <ul class="breadcrumbs-custom-path">
              <li><a href="homepage.php">Home</a></li>
              <li class="active">About Us</li>
            </ul>
          </div>
          <div class="box-position" style="background-image: url(images/bg-breadcrumbs.jpg);"></div>
        </div>
      </section>
      <!-- Why choose us-->
      <section class="section section-md section-first bg-default text-md-left">
        <div class="container">
          <div class="row row-50 justify-content-center">
            <div class="col-md-10 col-lg-5 col-xl-6"><img src="images/logo fix.jpg" alt="" width="519" height="446"/>
            </div>
            <div class="col-md-10 col-lg-7 col-xl-6">
              <h2>Why Choose Us</h2>
              <!-- Bootstrap tabs-->
              <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-4">
                <!-- Nav tabs-->
                <ul class="nav nav-tabs">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-4-1" data-toggle="tab">Our Goals</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-2" data-toggle="tab">Our Values</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-3" data-toggle="tab">Our Mission</a></li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="tabs-4-1">
                    <p>Di My Dream Food, misi kami adalah menginspirasi dan memberdayakan semua orang untuk menciptakan hidangan lezat yang membawa kebahagiaan dan kehangatan ke dalam hidup mereka. Kami percaya bahwa memasak bukan hanya tentang menyiapkan makanan, tetapi juga tentang menciptakan pengalaman berkesan dan menyuburkan jiwa.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Menyediakan Resep Unik</li>
                        <li>Mendorong Pola Makan Sehat</li>
                        <li>Memberdayakan Koki Rumahan</li>
                        <li>Membangun Komunitas</li>
                        <li>Inovasi Berkelanjutan</li>
                      </ul>
                    </div>
                    <div class="group-md group-middle"><a class="button button-width-xl-310 button-default-outline button-wapasha" href="contact-us.html">Contact us</a></div>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-2">
                    <p>Di My Dream Food, nilai-nilai kami adalah dasar dari segala yang kami lakukan. Nilai-nilai ini membimbing tindakan kami dan membentuk komunitas kami. Nilai-nilai inti kami adalah:</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Gairah Terhadap Memasak</li>
                        <li>Bahan Berkualitas</li>
                        <li>Kreativitas dan Inovasi</li>
                        <li>Inklusivitas</li>
                        <li>Keberlanjutan</li>
                        <li>Pendidikan dan Pemberdayaan</li>
                      </ul>
                    </div>
                    <div class="group-md group-middle"><a class="button button-width-xl-310 button-default-outline button-wapasha" href="contact-us.html">Contact us</a></div>
                  </div>
                  <div class="tab-pane fade" id="tabs-4-3">
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <div class="text-center text-sm-left offset-top-30">
                      <ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
                        <li>Minim veniam</li>
                        <li>Nostrud exercitation</li>
                        <li>Eiusmod tempor</li>
                        <li>Dolore magna</li>
                        <li>Laboris nisi</li>
                        <li>Officia deserunt</li>
                      </ul>
                    </div>
                    <div class="group-md group-middle"><a class="button button-width-xl-310 button-default-outline button-wapasha" href="contact-us.html">Contact us</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- What people say-->
      <!-- <section class="section context-dark">
        <div class="parallax-container" data-parallax-img="images/bg-parallax-2.jpg">
          <div class="parallax-content section-md bg-overlay-2-21">
            <div class="container">
              <div class="oh">
                <h2 class="wow slideInUp" data-wow-delay="0s">What People Say</h2>
              </div> -->
              <!-- Owl Carousel-->
              <!-- <div class="owl-carousel owl-modern" data-items="1" data-stage-padding="15" data-margin="30" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut" data-autoplay="true"> -->
                <!-- Quote Lisa-->
                <!-- <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/user-16-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">I picked up a head of your lettuce at a local grocery store today. What an amazing and beautiful lettuce it is! I’ve never seen another so full and green and tempting.</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">Samantha Peterson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article> -->
                <!-- Quote Lisa-->
                <!-- <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/user-17-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">I wanted to tell you how amazing it was to see the farm and how much we love the food. Your apples and carrots are just wonderful and their taste is great.</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">John Wilson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article> -->
                <!-- Quote Lisa-->
                <!-- <article class="quote-lisa">
                  <div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/user-18-100x100.jpg" alt="" width="100" height="100"/></a>
                    <div class="quote-lisa-text">
                      <p class="q">The food from your farm is wonderful. So many nights when we sit down to dinner we can say everything on this plate is locally grown and delicious. Thank you!</p>
                    </div>
                    <h5 class="quote-lisa-cite"><a href="#">Kate Anderson</a></h5>
                    <p class="quote-lisa-status">Regular Client</p>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <section class="section section-md section-last bg-gray-100">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Partners</h2>
          </div>
          <!-- Owl Carousel-->
          <div class="owl-carousel owl-clients owl-dots-secondary" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-margin="30" data-dots="true"><a class="clients-modern" href="#"><img src="images/team/gordon.png" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/team/renatta.jpg" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/team/juna.jpg" alt="" width="270" height="145"/></a><a class="clients-modern" href="#"><img src="images/team/arnold.jpg" alt="" width="270" height="145"/></a></div>
        </div>
      </section>
      <!-- Page Footer-->
      <footer class="section footer-variant-2 footer-modern context-dark section-top-image section-top-image-dark">
        <div class="footer-variant-2-content">
          <div class="container">
            <div class="row row-40 justify-content-between">
              <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="oh-desktop">
                  <div class="wow slideInRight" data-wow-delay="0s">
                    <div class="footer-brand"><a href="homepage.php"><p style="font-size: 20px;">My DreamFood</p></a></div>
                    <p>website ini dibuat hanya untuk tugas perkuliahan, kami tidak menjual apapun.</p>
                    <ul class="footer-contacts d-inline-block d-md-block">
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-phone"></span></div>
                          <div class="unit-body"><a class="link-phone" href="tel:#">+62 851-5531-7797</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="unit unit-spacing-xs">
                          <div class="unit-left"><span class="icon fa fa-location-arrow"></span></div>
                          <div class="unit-body"><a class="link-location" href="#">INSTITUT TEKNOLOGI ADHI TAMA SURABAYA</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4 col-xl-4">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInDown" data-wow-delay="0s">
                    <div class="group-lg group-middle">
                      <p class="text-white">Follow Us</p>
                      <div>
                        <ul class="list-inline list-inline-sm footer-social-list-2">
                          <li><a class="icon fa fa-instagram" href="https://www.instagram.com/resep.nusantaraid/"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-xl-3">
                <div class="oh-desktop">
                  <div class="inset-top-18 wow slideInLeft" data-wow-delay="0s">
                    <h5>Gallery</h5>
                    <div class="row row-10 gutters-10" data-lightgallery="group">
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/menu/nasi goreng.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-7-800x1200.jpg" data-lightgallery="item"><img src="images/gallery-image-1-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/menu/mie ayam.png" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-8-1200x800.jpg" data-lightgallery="item"><img src="images/gallery-image-2-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-9-800x1200.jpg" data-lightgallery="item"><img src="images/gallery-image-3-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                      <div class="col-6 col-sm-3 col-lg-6">
                        <!-- Thumbnail Classic-->
                        <article class="thumbnail thumbnail-mary">
                          <div class="thumbnail-mary-figure"><img src="images/menu/salad.jpg" alt="" width="129" height="120"/>
                          </div>
                          <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-10-1200x800.jpg" data-lightgallery="item"><img src="images/gallery-image-4-129x120.jpg" alt="" width="129" height="120"/></a>
                          </div>
                        </article>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-variant-2-bottom-panel">
          <div class="container">
            <!-- Rights-->
            <div class="group-sm group-sm-justify">
              <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span> <span>Herber</span>. All rights reserved
              </p>
              <p class="rights">Design&nbsp;by&nbsp;<a href="https://www.templatemonster.com/">Templatemonster</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>