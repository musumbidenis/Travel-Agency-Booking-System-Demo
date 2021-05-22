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
            <?php if( isAdmin()) { ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Packages</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Packages</li>
                        </ol>
                        <form method="post" action="packages.php" enctype="multipart/form-data">
                        <div class="col-sm-6 mb-5">
                            <div class="card">
                                <div class="card-header"><strong>Add Package</strong> <small>Form</small></div>
                                    <div class="card-body">

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

                                    <div class="mb-3">
                                    <?php echo display_error(); ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Package Type</label>
                                                <select class="form-control" name="packageType">
                                                    <option selected="selected" disabled>Choose Package Type</option>
                                                    <option value="beach holiday">Beach Holiday</option>
                                                    <option value="family holiday">Family Holiday</option>
                                                    <option value="honeymoon">Honeymoon</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" type="text-area" placeholder="Description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input class="form-control" name="amount" type="number" placeholder="Amount">
                                            </div>
                                            <div class="form-group">
                                                <label>Cover Image</label>
                                                <input class="form-control" name="image" type="file" placeholder="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-lg btn-primary" name="add_package_btn" type="submit"> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Packages
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php $results = packages(); ?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Package Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Cover Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Package Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Cover Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>

                                        <?php while ($row = mysqli_fetch_array($results)) { ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['packageType']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td>Kshs. <?php echo $row['amount']; ?></td>
                                                <td><?php echo "<img style='width: 50px; length: 50px;' src='images/".$row['imageUrl']."' >"; ?></td>
                                                <td><a href="packages.php?del-package=<?php echo $row['packageId'];?>" onclick="return confirm('Are you sure you want to delete this entry?')"  type="button" class="btn btn-sm btn-danger">Delete</a></td>
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
                        <h1 class="mt-4">Packages</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Packages</li>
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
