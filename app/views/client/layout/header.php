<?php if (isset($_SESSION['user_id'])): ?>
  <p>Bienvenue, <?= $_SESSION['email'] ?> | <a style="color:red" href="logout_index.php">Déconnexion</a></p>
<?php else: ?>
  <p>Not current User <a style="color:red" href="login_index.php">Connecter</a></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Domnoo Restaurant & Pizza HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../public/client-assets/images/fav2.ico" type="image/x-icon" />
    <link rel="icon" href="../public/client-assets/images/fav2.ico" type="image/x-icon" />
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="../public/client-assets/css/bootstrap.min.css" />
    <!-- main stylesheet -->
    <link rel="stylesheet" href="../public/client-assets/css/style.css" />
    <!-- color stylesheet -->
    <link rel="stylesheet" href="../public/client-assets/css/colors.css" id="ui-theme-color" />
    <!-- responsive css -->
    <link rel="stylesheet" href="../public/client-assets/css/responsive.css" />
  </head>
  <body>
    <div class="loader_wrapper">
      <div class="loader">
        <img src="../public/client-assets/images/loader.gif" alt="" class="img-fluid" />
      </div>
    </div>
    <!--// loader_wrapper -->

    <div id="wrapper">
      <header class="new-block main-header">
        <div class="main-nav new-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="logo">
                  <a href="../public/client-assets/index.html"
                    ><img
                      src="../public/client-assets/images/logo.png"
                      alt="logo"
                      class="img-responsive"
                  /></a>
                </div>
                <div class="location-block">
                  <p>Austrlia</p>
                  <span>+00 123 456 789</span>
                </div>
                <a href="../public/client-assets/#" class="nav-opener"><i class="fa fa-bars"></i></a>
                <nav class="nav">
                  <ul class="list-unstyled">
                    <li class="drop active">
                      <a href="../public/client-assets/#">Home</a>
                      <ul class="drop-down">
                        <li><a href="../public/client-assets/index.html">Home1</a></li>
                        <li><a href="../public/client-assets/home2.html">Home2</a></li>
                      </ul>
                    </li>
                    <li class="drop">
                      <a href="../public/client-assets/#">Menu</a>
                      <ul class="drop-down">
                        <li><a href="../public/client-assets/menu.html">Menu</a></li>
                        <li><a href="../public/client-assets/menu2.html">Menu2</a></li>
                      </ul>
                    </li>
                    <li class="drop">
                      <a href="../public/client-assets/#">Pages</a>
                      <ul class="drop-down">
                        <li><a href="../public/client-assets/menu.html">Menu</a></li>
                        <li><a href="../public/client-assets/menu2.html">Menu2</a></li>
                        <li><a href="../public/client-assets/about_us.html">About</a></li>
                        <li><a href="../public/client-assets/blog.html">Blog</a></li>
                        <li><a href="../public/client-assets/blog_left.html">Blog left</a></li>
                        <li><a href="../public/client-assets/blog_right.html">Blog right</a></li>
                        <li><a href="../public/client-assets/blog_single.html">Single blog</a></li>
                        <li><a href="../public/client-assets/contact.html">Contact us</a></li>
                        <li>
                          <a href="../public/client-assets/product_single.html">Product single</a>
                        </li>
                        <li><a href="../public/client-assets/shopping_cart.html">Cart page</a></li>
                      </ul>
                    </li>
                    <li><a href="../public/client-assets/#">Meals</a></li>
                    <li><a href="../public/client-assets/#">Pizza</a></li>
                    <li><a href="../public/client-assets/about_us.html">About</a></li>
                    <li class="drop">
                      <a href="../public/client-assets/#">Blog</a>
                      <ul class="drop-down">
                        <li><a href="../public/client-assets/blog.html">Blog</a></li>
                        <li><a href="../public/client-assets/blog_left.html">Blog left</a></li>
                        <li><a href="../public/client-assets/blog_right.html">Blog right</a></li>
                        <li><a href="../public/client-assets/blog_single.html">Single blog</a></li>
                      </ul>
                    </li>
                    <li><a href="../public/client-assets/#">Location</a></li>
                    <li><a href="../public/client-assets/contact.html">Contact Us</a></li>
                    <li><a href="../public/client-assets/#">Login/Signup</a></li>
                  </ul>
                </nav>
                <div class="nav-right-block">
                  <ul class="list-unstyled">
                    <li>
                      <a href="../public/client-assets/#"
                        ><i class="flaticon-scooter-front-view"></i
                        ><span class="nav-price">$00.00</span></a
                      >
                    </li>
                  </ul>
                </div>
                <!-- nav-login -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- header -->