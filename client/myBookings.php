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
      <h2>My Bookings</h2>
      <p class="lead">Below are the bookings that includes the packages you booked with us. You can review your
      bookings and don't hesitate to book more packages with us. We as Super Travel Agency value and treasure all
      our clients in equal measure.
      </p>

      <?php $results = myBookings(); ?>

      <?php if (isset($_SESSION['success'])) { ?>
			<div class="success text-center" >
				<p>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</p>
			</div>
      <?php } else if(isset($_SESSION['error'])) { ?>
        <div class="error text-center" >
				<p>
					<?php 
						echo $_SESSION['error']; 
						unset($_SESSION['error']);
					?>
				</p>
			</div>
		<?php } ?>
      
    </div>

    <div class="row py-3">
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <div class="col-sm-12">
            <?php if($row['status'] == 'cancelled' || $row['status'] == 'pending') { ?>
                <div class="card mx-auto border-danger mb-3">
                <div class="card-header text-danger mb-2">Booking Status - <?php echo $row['status']; ?> </div>
            <?php } else { ?>
                <div class="card mx-auto border-success mb-3">
                <div class="card-header text-success mb-2">Booking Status - <?php echo $row['status']; ?> </div>
            <?php } ?>
                <div class="card-body mb-3">
                    <div class="">
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <!-- <?php if($row['status'] == 'cancelled' || $row['status'] == 'pending') { ?>
                            <p class="card-text"><?php echo $row['status']; ?></p>
                        <?php } else { ?>
                            <a href="myBookings.php?update-booking=<?php echo $row['bookingId'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a>
                        <?php } ?> -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 Super Travel Agency</p>
  </footer>
</div>
  </body>
</html>
