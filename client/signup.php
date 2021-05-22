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
  <form method="post" action="signup.php">
    <h1 class="h3 mt-5 mb-3 fw-normal">Please sign up</h1>

     <!-- notification message -->
    <div class="mb-3">
      <?php echo display_error(); ?>
    </div>

    <div>
    <div class="form-floating">
      <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo $firstName; ?>">
      <label>First Name</label>
    </div>
    
    <div class="form-floating">
      <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?php echo $surame; ?>">
      <label>Surname</label>
    </div>

    <div class="form-floating">
      <input type="number" class="form-control" name="phone" placeholder="254710899878" value="<?php echo $phone; ?>">
      <label>Phone Number</label>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?php echo $email; ?>">
      <label>Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $password; ?>">
      <label>Password</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" value="<?php echo $password; ?>">
      <label>Confirm Password</label>
    </div>

    <button class="w-100 mt-5 btn btn-lg btn-primary" name="register_btn" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
</main>


    
  </body>
</html>
