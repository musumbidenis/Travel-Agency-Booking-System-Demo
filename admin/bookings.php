<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['error'] = "You must log in first";
	header('location: ../client/login.php');
} ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
<body class="sb-nav-fixed">
    <?php include 'layouts/navbar.php';?>
    <?php include 'layouts/sidebar.php';?>
        <div id="layoutSidenav_content">
        <?php if( isAdmin() || isAccountant() ){ ?>
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Bookings</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="success" >
                            <p>
                                <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                ?>
                            </p>
                        </div>
                    <?php endif ?>

                    <?php $results = bookings(); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Bookings
                        </div>
                        <div class="card-body">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form method="post" action="bookings.php">
                                        <div class="row border border-light rounded py-2 mb-2">
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label>Users</label>
                                                <fieldset class="form-group">
                                                    <select class="form-control">
                                                        <option value="">Any</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label>Package Type</label>
                                                <fieldset class="form-group">
                                                    <select name="packageType" name="user" class="form-control">
                                                        <option value="any">Any</option>
                                                          <option value="beach holiday">Beach Holiday</option>
                                                          <option value="family holiday">Family Holiday</option>
                                                          <option value="honeymoon">Honeymoon</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label>Status</label>
                                                <fieldset class="form-group">
                                                    <select name="status" class="form-control">
                                                        <option value="any">Any</option>
                                                        <option value="cancelled">Cancelled</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="complete">Complete</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                                <button class="btn btn-block btn-primary glow" name="show_bookings">Show</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php  if (isset($_SESSION['bookings_packageType'])) : ?>
					<small><?php echo $_SESSION['bookings_packageType']; 

                    ?></small>
                    <?php endif ?>
                </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Package Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Package Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['packageType']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <?php if($row['status'] == 'cancelled' || $row['status'] == 'pending') { ?>
                                                <td><button type="button" class="btn btn-sm btn-danger" disabled>Cancel</button></td>
                                            <?php } else { ?>
                                                <td><a href="bookings.php?update-booking=<?php echo $row['bookingId'];?>" onclick="return confirm('Are you sure you want to update this entry?')"  type="button" class="btn btn-sm btn-danger">Cancel</a></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>

                                    <?php } ?>
                                    
                                </table>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 d-flex float-right">
                            <form method="post">
                               <button class="btn btn-block btn-primary glow" name="bookings_report">Generate Report</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php } else { ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Bookings</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Bookings</li>
                        </ol>
                        <div class="error text-center">
                            <div class="my-4">
                                <strong>
                                Access Denied. You're not authorized to access this resource
                                </strong>
                            </div>
                        </div>
                    </div>
                </main>
            <?php } ?> 
            <?php include 'layouts/footer.php';?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
