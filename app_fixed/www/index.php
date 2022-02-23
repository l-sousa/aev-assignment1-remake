<?php include 'include/common.php'; ?>

<?php
    global $con;
    $user_id = $_SESSION['user_id'];

    //$result = mysqli_query($con, "SELECT * FROM users WHERE id = '$user_id' ;") or die(mysqli_error($con));

    $result = $con->prepare("SELECT * FROM users WHERE id = ?");
    $result->bind_param("s", $user_id);
    $result->execute();
    $result = $result->get_result();

    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Local CSS -->
    <link rel="stylesheet" href="assets/css/index.css">

    <title>SecurePhotography</title>
</head>
<body>
    <!-- NavBar w/ Home, Cart, Profile and Search bar -->
    <?php include 'navbar.php'; ?>

    <br>
    <br>
    <br>

    <div class="container">
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <form action="search.php">
                    
                        <?php
                            if (!isset($_GET['search']))
                                $_GET['search'] = '';
                            echo "<input type='text' placeholder='Search for products' class='form-control' name='search' id='search' value = '" . htmlspecialchars($_GET['search']) . "'>"; 
                        ?>
                        <button class="btn btn-success" type="submit">Search</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container products">
        <div class="row">
            
            <?php
                $query = mysqli_query($con, "SELECT * FROM products ; ");
                while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 product">
                        <div class="card">
                            <?php echo "<img src='products/" . $row['image'] . "' class='card-img-top' >"; ?>
                            <div class="card-body">
                            <?php echo "<h5 class='card-title'>" . $row['brand'] . " " . $row['name'] . "</h5><p class='card-text'>" . $row['price'] . "€</p><a href='product_detail.php?id=" . $row['id'] . "' class='btn btn-success'>Details</a>"; ?>
                            </div>
                        </div>
                    </div>
                <?php }
            ?>
        </div>
    </div>
    <br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<?php include 'include/footer.php'; ?>

</html>