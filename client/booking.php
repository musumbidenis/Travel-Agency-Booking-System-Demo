<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
} ?>

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
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Booking Form</h2>
      <p class="lead">Below are your booking details that includes your package of choice as selected. Please review your
      booking details before proceeding to checkout. Payments are done via MPESA, please provide an MPESA registered number 
      to complete the checkout.
      </p>

      <div class="col-sm-12 col-lg-12 mt-2">
        <?php echo display_error(); ?>
      </div>
      
    </div>

    <?php $results = bookingDetails(); ?>
    <?php $row = mysqli_fetch_assoc($results) ?>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-center align-items-center mb-3">
          <span class="text-primary">Booking Information</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Package Type</h6>
              <small class="text-muted"><?php echo $row['packageType']; ?></small>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Description</h6>
              <small class="text-muted"><?php echo $row['description']; ?></small>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Package Amount</h6>
              <span class="text-success">Kshs. <?php echo $row['amount']; ?></span>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (Kshs)</span>
            <strong><?php echo $row['amount']; ?></strong>
          </li>
        </ul>
      </div>

      <div class="col-md-7 col-lg-8">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">User Information</span>
        </h4>
        <form method="post" action="booking.php?packageId=<?php echo $row['packageId'];?>">
          <div class="row g-3 mb-2">
            <div class="col-sm-6">
              <label class="form-label">First name</label>
              <input type="text" class="form-control" name="firstName" value="<?php echo $_SESSION['user']['firstName']; ?>" disabled>
            </div>

            <div class="col-sm-6">
              <label class="form-label">Surname</label>
              <input type="text" class="form-control" name="surname" value="<?php echo $_SESSION['user']['surname']; ?>" disabled>
            </div>
          </div>

          <div class="col-sm-6 col-lg-12 mb-2">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>" disabled>
          </div>

          <div class="col-sm-6 col-lg-12 mb-2">
            <input type="text" class="form-control" name="packageId" value="<?php echo $row['packageId']; ?>" hidden>
          </div>

          <div class="col-sm-6 col-lg-12 mb-2">
            <input type="text" class="form-control" name="amount" value="<?php echo $row['amount']; ?>" hidden>
          </div>

          <div class="col-sm-6 col-lg-12 mb-2">
            <label class="form-label">Mpesa Registered Number</label>
            <input type="number" placeholder="254713710887" class="form-control" name="phone">
          </div>

          <?php ?>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" name="stkPush" type="submit">Continue to checkout</button>
        </form>
      </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Super Travel Agency</p>
  </footer>
</div>
  </body>
</html>
