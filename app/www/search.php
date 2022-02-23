<?php include 'include/common.php'; ?>

<?php
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE id = '$user_id';");
    $row = mysqli_fetch_array($query);
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

    <title>VulnPhotography</title>
</head>
<body>
    <!-- NavBar w/ Home, Cart, Profile and Search bar -->
    <br>
    <br>
    <br>

    <?php
        include 'navbar.php';
        $search = $_GET['search'];
        $query = "SELECT * FROM products WHERE name like '%$search%' OR brand like '%$search%' OR category like '%$search%'";
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
    ?>

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
                if (mysqli_num_rows($result) < 1) { ?>
                    <div class="panel panel-success col-md-6 col-md-offset-3" style="padding: 15% 0; text-align: center;">
                        <h1 class="panel-heading">No results.</h1>
                    </div>
                <?php }
                while ($row = mysqli_fetch_array($result)) { ?>
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