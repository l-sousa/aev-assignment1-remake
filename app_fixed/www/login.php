<?php include 'include/common.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>SecurePhotography - Login</title>

</head>

<body class="bg-dark">

    <!-- NavBar w/ Home, Cart, Profile and Search bar -->
    <?php include 'navbar.php'; ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="row d-flex justify-content-center  ">
            <div class="col-md-6 ">
                <div class="card px-5 py-5 ">
                    <div class="form-data">
                        <div class="forms-inputs mb-4">
                            <span>Email</span>
                            <input type="text" id="email" name="email" style="width: 100%;">
                        </div>
                        <div class="forms-inputs mb-4">
                            <span>Password</span>
                            <input type="password" id="password" name="password" style="width: 100%;">
                        </div>
                        <div class="text-danger">
                            <?php
                                if (isset($_GET['error'])) {
                                    echo htmlspecialchars($_GET['error']);
                                }
                            ?>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success w-100" name="submit" onclick="pst()">Login</button>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <a href="signup.php">Don't have an account? Register</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./scripts.js"></script>
</body>
<?php include 'include/footer.php'; ?>
</html>