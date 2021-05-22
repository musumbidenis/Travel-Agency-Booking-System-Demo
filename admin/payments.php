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
                        <h1 class="mt-4">Payments</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ol>

                        <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Bookings
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $results = payments(); ?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Mpesa Receipt Number</th>
                                                <th>Payment Number</th>
                                                <th>Amount</th>
                                                <th>Transaction Date</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Email</th>
                                                <th>Mpesa Receipt Number</th>
                                                <th>Payment Number</th>
                                                <th>Amount</th>
                                                <th>Transaction Date</th>
                                            </tr>
                                        </tfoot>

                                        <?php while ($row = mysqli_fetch_array($results)) {
                                            $timestamp = $row['transactionDate'];
                                            $formatDate = strtotime($timestamp);
                                        ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['mpesaReceiptNumber']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo date("M d Y h:i:sa", $formatDate); ?></td>
                                            </tr>
                                        </tbody>

                                        <?php } ?>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php } else { ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Payments</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Payments</li>
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
    <script src="js/datatables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
