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
  <body class="text-center">
    
<main class="form">
  <form method="post" action="login.php">
    <h1 class="h3 mt-5 mb-3 fw-normal">Please sign in</h1>

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

    <div class="mb-3">
    <?php echo display_error(); ?>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
      <label>Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" name="password" placeholder="Password" required>
      <label>Password</label>
    </div>

    <div class="form-floating">
        <small>Don't have an account yet?</small> <a href="signup.php">Signup</a>
    </div>

    <button class="w-100 mt-3 btn btn-lg btn-primary" name="login_btn" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>


    
  </body>
</html>
