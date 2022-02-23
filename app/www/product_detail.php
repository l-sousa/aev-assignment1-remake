<?php
    include 'navbar.php';
    include 'product_detail_functions.php';

    $comments_query_result = mysqli_query($con, "SELECT * FROM comments WHERE product_id=" . $item_id . " ORDER BY created_at DESC");
    $comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);

    $query = "SELECT * FROM products WHERE id='$item_id';";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>VulnPhotography - Product Detail</title>
</head>

<body>

    <br>
    <br>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php echo "<img src='products/" . $row['image'] . "' class='img-fluid' >"; ?>
                </div>
                <div class="col">
                    <?php echo "<h1 class='display-4'>" . $row['brand'] . " " . $row['name'] . "</h1>"; ?>
                    <?php echo "<p class='lead'> " . $row['category'] . " </p>"; ?>
                    <?php echo "<p class='lead'> " . $row['price'] . "€" . " </p>"; ?>

                    <button href="#" class="btn btn-success">Add to Cart</button>
                    <?php echo "<a href='download.php?id=" . $item_id . ".pdf' download='product_" . $item_id . ".pdf' class='btn btn-success'>Download Details</a>"; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">

                        <?php if (isset($user_id)) : ?>
                            <?php echo "<form action='product_detail_functions.php?id=" . $item_id . "' method='post' id='comment_form'>" ?>
                                <h5 class="card-title">Comment your opinion below!</h5>
                                <div class="form-group">
                                    <textarea class="form-control" name="comment_text" id="comment_text" rows="3"></textarea>
                                </div>
                                <button class="btn btn-primary" id="submit_comment">Submit comment</button>
                            </form>
                        <?php else : ?>
                            <h5 class="card-title"><a href="login.php">Log in</a> to post a comment</h5>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="comment-tabs">
        <div class="row d-flex no-wrap justify-content-center">
            <h2><span id="comments_count"><?php echo count($comments) ?></span> Comment(s)</h2>
        </div>
        <div class="tab-content" style="padding:20%; padding-top:1%;">
            <div id="comments-logout">
                <ul class="media-list" >
                    <?php if (!empty($comments)) : ?>
                        <?php foreach ($comments as $comment) : ?>
                            <li class="media" style="margin-bottom: 15px; word-break: break-all; word-wrap: break-word;">

                                <?php
                                    $fname = '';
                                    foreach (glob("uploads/" . $comment['user_id']  . '&*.*') as $filename) {
                                        $fname = $filename;
                                    }
                                    if ($fname == '') {
                                        echo "<img class='rounded-circle mr-3' style='width:50px; height: 50px' src='include/avatar.jpeg' >"; 
                                    } else {
                                        echo "<img class='rounded-circle mr-3' style='width:50px; height: 50px' src='" . $fname . "' >"; 
                                    }
                                ?>

                                <div class="well well-lg">
                                    <span>
                                        <h4 style="display: inline;"><?php echo getUsernameById($comment['user_id']) ?> </h4>
                                        <p style="display: inline;">- <?php echo date("F j, Y, g:i a", strtotime($comment["created_at"])); ?></p>
                                    </span>
                                    <p >
                                        <?php echo $comment['body']; ?>
                                    </p>
                                </div>

                            </li>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="row d-flex no-wrap justify-content-center">
                            <h4>Be the first to comment on this post!</h4>
                        </div>
                    <?php endif ?>
                </ul>
            </div>
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