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


<header class="site-header sticky-top py-1">
  <nav class="container d-flex flex-column flex-md-row">
    <a class="py-4" href="#">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
    </a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="index.php">Home</a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="#">About</a>
    <a class="py-4 px-4 d-none d-md-inline-block" href="index.php#packages">Packages</a>
    <a class="py-4 pe-5 ps-4 d-none d-md-inline-block" href="#">Contact</a>

    <?php if($_SESSION['user']) { ?>
      <a class="py-4 ps-5 d-none d-md-inline-block" class="btn btn-sm btn-outline-secondary" href="../client/index.php?logout">Logout</a>
    <?php } else { ?>
      <a class="py-4 px-3 d-none d-md-inline-block" class="btn btn-sm btn-outline-secondary" href="../client/login.php">Login</a>
    <?php } ?> 
    
  </nav>
</header>


<main>
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Family Holiday Packages</h1>
        <p class="lead text-muted">Wondering where to take your family for vacation? We've got you covered. We have exclusive family holiday packages that you can choose from.
            Best price guaranteed for the best Kenyan destinations.</p>
      </div>
    </div>
  </section>

  <?php $results = packages(); ?>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      <?php while ($row = mysqli_fetch_array($results)) { ?>
        <div class="col">
          <div class="card shadow-sm">
            <img src="../admin/images/<?php echo $row['imageUrl'];?>" class="d-block w-100" alt="...">

            <div class="card-body">
              <p class="card-text"><?php echo $row['description']; ?></p>
              <a href="../client/booking.php" class="float-right btn btn-sm btn-outline-secondary">Book Now</a>
              <strong>Kshs. <?php echo $row['amount']; ?></strong>
            </div>
          </div>
        </div>
      <?php } ?>

      </div>
    </div>
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
