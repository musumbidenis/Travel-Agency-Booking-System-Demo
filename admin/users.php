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
            <?php if( isAdmin() ){ ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <form method="post" action="users.php">
                        <div class="col-sm-6 mb-5">
                            <div class="card">
                                <div class="card-header"><strong>Create user</strong> <small>Form</small></div>
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
                                                <label>First Name</label>
                                                <input class="form-control" name="firstName" type="text" placeholder="First name">
                                            </div>
                                            <div class="form-group">
                                                <label>Surname</label>
                                                <input class="form-control" name="surname" type="text" placeholder="Surname">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" name="phone" type="number" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" type="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" name="password" type="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input class="form-control" name="confirmPassword" type="password" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control" name="role">
                                                    <option selected="selected" disabled>Choose user role</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="accountant">Accountant</option>
                                                    <option value="client">Client</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-lg btn-primary" name="create_user_btn" type="submit"> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Registered Users
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php $results = users(); ?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Surname</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Surname</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                            </tr>
                                        </tfoot>

                                        <?php while ($row = mysqli_fetch_array($results)) { ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['firstName']; ?></td>
                                                <td><?php echo $row['surname']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['role']; ?></td>
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
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
