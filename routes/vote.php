<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../login.html");
    }
    // include("connect.php");
    require "../api/connect.php";
    $vote =  $_POST['groupvote'];
    // echo"$vote";
    $total_vote = $vote+1;
    // echo "$total_vote";
    $gid = $_POST['gid'];
    $uid = $_SESSION['id'];

    $update_votes = mysqli_query($connect,"UPDATE user SET votes ='$total_vote' WHERE id ='$gid'");

    $update_user_status = mysqli_query($connect,"UPDATE user SET status = 1 WHERE id = '$uid'");

    if($update_votes and $update_user_status){
        $getGroups = mysqli_query($connect, "select name, photo, votes, id from user where role=2 ");
        $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);

        $_SESSION['groupdata'] = $groups;
        $_SESSION['status'] = 1;

        echo '
            <script>
                alert("Voting Successfull!");
                window.location = "./dashboard.php";
            </script>';
    }
    else{
        echo '
        <script>
            alert("Some error occured!");
            window.location = "./dashboard.php";
        </script>';
    }
        
     


?>