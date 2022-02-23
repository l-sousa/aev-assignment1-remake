<?php
    ob_start();
    require 'include/common.php';

    $user_id = $_SESSION['user_id'];
    $item_id = $_GET['id'];

    // Receives a user id and returns the username
    function getUsernameById($id)
    {
        global $con;
        $result = mysqli_query($con, "SELECT name FROM users WHERE id=" . $id . " LIMIT 1");
        
        // return the username
        return mysqli_fetch_assoc($result)['name'];
    }

    if (isset($_POST['comment_text'])) {
        global $con;
        
        // grab the comment that was submitted through Ajax call
        $comment_text = $_POST['comment_text'];
        
        // insert comment into database
        $sql = "INSERT INTO comments (user_id,product_id, body, created_at) VALUES (" . $user_id . "," . $item_id . ",'$comment_text', now())";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header("location:product_detail.php?id=" . $item_id);
            exit();
        } else {
            echo "error";
            exit();
        }
    }
?>