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
$query = "SELECT nama_user, email_user FROM user WHERE id = ?";
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
    <link rel="icon" href="images/logo bisnis.jpg" type="image/x-icon">
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
                  <div class="rd-navbar-brand"><a class="brand" href="homepage.php"><P style="font-size: larger;">My DreamFood</P></a></div>
                </div>
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
                    <!-- RD Navbar Basket-->
                    <!-- <div class="rd-navbar-basket-wrap">
                      <button class="rd-navbar-basket fl-bigmug-line-shopping198" data-rd-navbar-toggle=".cart-inline"><span>2</span></button>
                      <div class="cart-inline">
                        <div class="cart-inline-header">
                          <h5 class="cart-inline-title">In cart:<span> 2</span> Products</h5>
                          <h6 class="cart-inline-title">Total price:<span> $800</span></h6>
                        </div>
                        <div class="cart-inline-body">
                          <div class="cart-inline-item">
                            <div class="unit align-items-center">
                              <div class="unit-left"><a class="cart-inline-figure" href="#"><img src="images/product-mini-1-108x100.png" alt="" width="108" height="100"/></a></div>
                              <div class="unit-body">
                                <h6 class="cart-inline-name"><a href="#">Blueberries</a></h6>
                                <div>
                                  <div class="group-xs group-inline-middle">
                                    <div class="table-cart-stepper">
                                      <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                                    </div>
                                    <h6 class="cart-inline-title">$550</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="cart-inline-item">
                            <div class="unit align-items-center">
                              <div class="unit-left"><a class="cart-inline-figure" href="#"><img src="images/product-mini-2-108x100.png" alt="" width="108" height="100"/></a></div>
                              <div class="unit-body">
                                <h6 class="cart-inline-name"><a href="#">Avocados</a></h6>
                                <div>
                                  <div class="group-xs group-inline-middle">
                                    <div class="table-cart-stepper">
                                      <input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000">
                                    </div>
                                    <h6 class="cart-inline-title">$250</h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="cart-inline-footer">
                          <div class="group-sm"><a class="button button-md button-default-outline-2 button-wapasha" href="#">Go to cart</a><a class="button button-md button-primary button-pipaluk" href="#">Checkout</a></div>
                        </div>
                      </div> -->
                    <!-- </div><a class="rd-navbar-basket rd-navbar-basket-mobile fl-bigmug-line-shopping198" href="#"><span>2</span></a> -->
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
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="homepage.php">Home</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="about-us.php">About Us</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="subs.php">Subscription</a>
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
      <!-- Swiper-->
      <section class="section swiper-container swiper-slider swiper-slider-modern" data-loop="true" data-autoplay="5000" data-simulate-touch="true" data-nav="true" data-slide-effect="fade">
        <div class="swiper-wrapper text-left">
          <div class="swiper-slide context-dark" data-slide-bg="images/banner/banner 1.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInDown" data-caption-delay="0">makanan sehat</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">kami ada untuk kalian yang ingin mencari resep baru</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="about-us.html" data-caption-animate="slideInLeft" data-caption-delay="400">menu</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide context-dark" data-slide-bg="images/banner/banner1.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInLeft" data-caption-delay="0">bosan dengan resep yang itu itu aja?</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">kami mencarikan resep yang anda inginkan dan menyampaikan kepada anda dengan mudah</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="about-us.html" data-caption-animate="slideInLeft" data-caption-delay="400">menu</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide context-dark" data-slide-bg="images/banner/banner1.jpg">
            <div class="swiper-slide-caption">
              <div class="container">
                <div class="row justify-content-center justify-content-xxl-start">
                  <div class="col-md-10 col-xxl-6">
                    <div class="slider-modern-box">
                      <h1 class="slider-modern-title"><span data-caption-animate="slideInDown" data-caption-delay="0">fitur berbayar</span></h1>
                      <p data-caption-animate="fadeInRight" data-caption-delay="400">berlanggananlah untuk mendapatkan resep khusus dari chef kita yang limited dan beserta vidio tutorial lengkapnya</p>
                      <div class="oh button-wrap"><a class="button button-primary button-ujarak" href="susb.php" data-caption-animate="slideInUp" data-caption-delay="400">Langganan</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination swiper-pagination-style-2"></div>
      </section>

      <!-- Icons Ruby-->
      <section class="section section-md bg-default section-top-image">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay="0s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-leaf"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="#menu">Menu Kami</a></h4>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay=".1s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-shovel"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="#">Subscription</a></h4>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay=".2s">
              <article class="box-icon-ruby">
                <div class="unit box-icon-ruby-body flex-column flex-md-row text-md-left flex-lg-column align-items-center text-lg-center flex-xl-row text-xl-left">
                  <div class="unit-left">
                    <div class="box-icon-ruby-icon linearicons-sun"></div>
                  </div>
                  <div class="unit-body">
                    <h4 class="box-icon-ruby-title"><a href="#team">Dedicated Team</a></h4>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
      <!-- Improve your interior with deco-->
      <section class="section section-md bg-default section-top-image" id="menu">
        <div class="container">
          <div class="oh h2-title">
            <h2 class="wow slideInUp" data-wow-delay="0s">Menu Kami</h2>
          </div>
          <div class="row row-30" data-lightgallery="group">
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInLeft" data-wow-delay="0s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/nasi goreng.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-1-1200x800.jpg" data-lightgallery="item"><img src="images/grid-gallery-1-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Nasi Goreng</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInUp" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/mie ayam.png" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/menu/mie ayam.png" data-lightgallery="item"><img src="images/grid-gallery-2-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Mie Ayam</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInRight" data-wow-delay=".0s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/Gado-Gado.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-3-800x1200.jpg" data-lightgallery="item"><img src="images/grid-gallery-3-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Mandarin Oranges</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInUp" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/gudeg.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-4-800x1200.jpg" data-lightgallery="item"><img src="images/grid-gallery-4-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Lemons</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInLeft" data-wow-delay="0s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/nasi kuning.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-5-800x1200.jpg" data-lightgallery="item"><img src="images/grid-gallery-5-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Organic Food</a></h4>
                  </div>
                </article>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="oh-desktop">
                <!-- Thumbnail Classic-->
                <article class="thumbnail thumbnail-mary thumbnail-sm wow slideInDown" data-wow-delay=".1s">
                  <div class="thumbnail-mary-figure"><img src="images/menu/salad.jpg" alt="" width="370" height="303"/>
                  </div>
                  <div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-original-6-1200x800.jpg" data-lightgallery="item"><img src="images/grid-gallery-6-370x303.jpg" alt="" width="370" height="303"/></a>
                    <h4 class="thumbnail-mary-title"><a href="#">Salad</a></h4>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Team of professionals-->
      <section class="section section-md bg-default" id="team">
        <div class="container">
          <div class="oh">
            <h2 class="wow slideInUp" data-wow-delay="0s">Our Team</h2>
          </div>
          <div class="row row-30 justify-content-center">
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay="0s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="images/team/bismo.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Bismo Aryo Bagaskoro</a></h5>
                  <p class="team-classic-status">Founder</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay=".1s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="images/team-2-370x406.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Miftachus Zien</a></h5>
                  <p class="team-classic-status">Marketing</p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInRight" data-wow-delay=".2s">
              <!-- Team Classic-->
              <article class="team-classic"><a class="team-classic-figure" href="#"><img src="images/team/foto formal.jpg" alt="" width="370" height="406"/></a>
                <div class="team-classic-caption">
                  <h5 class="team-classic-name"><a href="#">Ilham Syukur Abdillah</a></h5>
                  <p class="team-classic-status">Developer</p>
                </div>
              </article>
            </div>
          </div>
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
    <!-- coded by Ragnar-->
  </body>
</html>