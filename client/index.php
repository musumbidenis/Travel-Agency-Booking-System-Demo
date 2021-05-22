<?php include('functions.php') ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Travel Agency</title>
    

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="geo-fill" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
    </symbol>
    <symbol id="collection" viewBox="0 0 16 16">
      <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
  </svg> 
    
<header class="site-header sticky-top py-1">
  <nav class="container d-flex flex-column flex-md-row">
    <a class="py-4" href="#">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
    </a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="index.php">Home</a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="#">About</a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="#packages">Packages</a>
    <a class="py-4 pe-5 ps-4 d-none d-md-inline-block" href="#">Contact</a>

    <?php if($_SESSION['user']) { ?>
      <a class="py-4 ps-5 d-none d-md-inline-block" class="btn btn-sm btn-outline-secondary" href="../client/index.php?logout">Logout</a>
    <?php } else { ?>
      <a class="py-4 px-3 d-none d-md-inline-block" class="btn btn-sm btn-outline-secondary" href="../client/login.php">Login</a>
    <?php } ?> 
    
  </nav>
</header>

<main>
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="../assets/images/01.jpeg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Super Travel Agency</h1>
            <p>Your preffered tour agency. Quality and affordable rates just for you. <br> Book with us today for exclusive packages.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Book Now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="../assets/images/02.jpeg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img src="../assets/images/03.jpeg" class="d-block w-100" alt="...">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>One more for good measure.</h1>
            <p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- WHY CHOOSE US
  ================================================== -->

  <div class="container marketing">

    <div class="container py-5" id="hanging-icons">
      <div class="row g-5 py-5">
        <div class="col-md-4 d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <svg class="bi" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
          </div>
          <div>
            <h2>Best Selection</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
        </div>
        <div class="col-md-4 d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
          </div>
          <div>
            <h2>Best Price Guarantee</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
        </div>
        <div class="col-md-4 d-flex align-items-start">
          <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
            <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
          </div>
          <div>
            <h2>24/7 Support</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
          </div>
        </div>
      </div>
    </div>


    <!-- PACKAGE TYPES OFFERED -->

    <hr class="featurette-divider">

    <div id="packages">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Beach holidays. <span class="text-muted">They'll blow your mind.</span></h2>
          <p class="lead">Check out some great Beach holiday packages tailor made just for you. There are numerous options for you this includes an exclusive tour
            that is aimed at travellers that are looking for an extra bit of comfort - you choose.
          </p>
          <a href="../client/beach-holiday.php?packageType='beach holiday'" class="stretched-link">Checkout our packages</a>
        </div>
        <div class="col-md-5">
          <img src="../assets/images/03.jpeg" class="d-block w-100" alt="...">
        </div>
      </div>
  
      <hr class="featurette-divider">
  
      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading">Oh yeah, family holidays too. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Wondering where to take your family for vacation? We've got you covered. We have exclusive family holiday packages that you can choose from.
            Best price guaranteed for the best Kenyan destinations</p>
          <a href="../client/family-holiday.php?packageType='family holiday'" class="stretched-link">Checkout our packages</a>
        </div>
        <div class="col-md-5 order-md-1">
          <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
  
        </div>
      </div>
  
      <hr class="featurette-divider">
  
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Honeymoon. <span class="text-muted">For the newlyweds.</span></h2>
          <p class="lead">Wondering where to go on your honeymoon? We've got you covered. We have exclusive honeymoon packages that you can choose from.
            Best price guaranteed for the best Kenyan honeymoon destinations.
          </p>
          <a href="../client/honeymoon.php?packageType='honeymoon'" class="stretched-link">Checkout our packages</a>
        </div>
        <div class="col-md-5">
         <div class="col-md-5">
          <img src="../assets/images/04.jpeg" width="500px" height="350px">  
        </div>
      </div>
  
      <hr class="featurette-divider">
    </div>

    <!-- /END OF PACKAGE -->

  </div>
</main>

  <!-- FOOTER -->
  <footer class="container py-5">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2021 Super Travel Agency</p>
  </footer>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
