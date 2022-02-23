<?php
    include 'include/common.php';

    if (!isset($_SESSION['email']))
        header("location:./index.php?error=session not set");
    include 'navbar.php';

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
    <link rel="stylesheet" href="assets/css/login.css">
    <title>VulnPhotography - Profile</title>
</head>

<body>
    <!-- NavBar w/ Home, Cart, Profile and Search bar -->
    <?php include 'navbar.php'; ?>

    <?php
    $path = 'uploads/';
    $files = scandir($path);
    $file_path = "uploadimagedfirst";
    foreach ($files as $fname) {
        $f = explode("&", $fname);
        if ($f[0] == $_SESSION["user_id"]) {
            $file_path = $fname;
            break;
        }
    }
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center p-3 py-5">
                    <img src='/uploads/<?php echo $file_path ?>' class='rounded-circle' alt="Profile Picture" style="margin-top: 10em; width:100px; height: 100px" onerror="this.src='include/avatar.jpeg'">
                    <?php echo "<h3 class='text-center'>" . ucwords($row['name']) . "</h3><span>" . $row['email'] . "</span><span>" . $row['contact'] . "</span>"; ?>
                </div>
            </div>
            <div class="col">
                <div style="padding:5%">

                    <h4>Profile Settings</h4>
                    <div class="text-danger">
                            <?php
                                if (isset($_GET['error'])) {
                                    echo "<h5>" . htmlspecialchars($_GET['error']) . "</h5>";
                                }
                            ?>
                        </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Profile Picture</label>
                            <form class="mt-3" enctype="multipart/form-data" action="upload_file.php" method="POST">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="userfile">
                                    <input type="hidden" id="user" name="user" value="<?php echo $user_id ?>">
                                    <div>
                                        <?php
                                        if (isset($_GET['error_0'])) {
                                            echo htmlspecialchars($_GET['error_0']);
                                        }
                                        ?>
                                    </div>
                                    <label class="custom-file-label" for="customFile">Choose Picture</label>
                                </div>
                                <div class="mt-3">
                                    <button id="b" type="submit" name="submit" class="btn btn-primary">Save Picture</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Email Address</label>
                            <form action="profile_change.php" method="post">
                                <?php echo "<input name='email' type='email' class='form-control' placeholder=" . $row['email'] . ">" ?>
                                <div class="mt-3"><button type='submit' class="btn btn-primary" id="c">Save Email</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label>Mobile Number</label>
                            <form action="profile_change.php" method="post">
                                <?php echo "<input name='contact' type='tel' class='form-control' placeholder=" . $row['contact'] . ">" ?>
                                <div class="mt-3"><button type='submit' id='d' class="btn btn-primary">Save Number</button></div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                    </div>

                    <form action="profile_change.php" method="post" id='e' class="row mt-3">
                        <div class="col-md-4"><label>Old Password</label><input type="password" class="form-control" name="Old_password"></div>
                        <div class="col-md-4"><label>New Password</label><input type="password" class="form-control" name="New_Password"></div>
                        <div class="col-md-4"><label>Verify Password</label><input type="password" class="form-control" name="Re_type_new_password"></div>
                        <div class="col-md-12 mt-3"><button class="btn btn-primary" type="submit">Save Password</button></div>
                    </form>
                </div>
            </div>
        </div>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="./scripts.js"></script>
        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
</body>
<?php include 'include/footer.php'; ?>

</html>