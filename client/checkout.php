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
          <h2>Payment Checkout</h2>

          <p id="msg" class="success lead py-5">
            Request accepted for processing. Please check your phone and input your Mpesa PIN to complete transaction
          </p>

        </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2021 Super Travel Agency</p>
    </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
      var interval = setInterval(status, 3000);
      
      function status(){
        var checkoutRequestID = '<?php echo $_GET['checkoutRequestID']; ?>'
        $.ajax({
            type: "POST",
            data: { "checkoutRequestID": checkoutRequestID },
            url: 'functions.php',
            success: function(response){

              var data = JSON.parse(response);
              if (data['paymentStatus'] == 'cancelled' || data['paymentStatus'] == 'timed out'){

                $('#msg').removeClass();
                $('#msg').addClass("error lead py-5 text-center");
                $('#msg').text('Transaction was cancelled by the user. Your booking has been cancelled, please go back to reinitiate the booking process');

                clearInterval(interval);

              }else if (data['paymentStatus'] == 'complete'){

                clearInterval(interval);

                alert('Payment was successful');
                window.location.href = 'index.php';

              }else{

                $('#msg').text('Request accepted for processing. Please check your phone and input your Mpesa PIN to complete transaction');

              }
           }
       });

      }
    });
    </script>
  </body>
</html>
