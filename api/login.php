<?php
    session_start();
    include("connect.php");
    
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = mysqli_query($connect, "SELECT * From user WHERE mobile='$mobile' AND password ='$password' AND role='$role'");

    if (mysqli_num_rows($check)>0) 
    {
        $groups = mysqli_query($connect, "SELECT name, photo, votes, id FROM user WHERE role=2");
        if(mysqli_num_rows($groups)>0){
            $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
            $_SESSION['groupdata'] =$groupdata;
        }
        $userdata = mysqli_fetch_array($check);
        $_SESSION['id'] = $userdata['id'];
        $_SESSION['status'] = $userdata['status'];
        $_SESSION['userdata'] = $userdata;
        

        echo '
        <script>
            window.location = "../routes/dashboard.php";
        </script>';

    }
    else 
        {
            echo '
            <script>
                alert("Invalid Credentails or User not foiund!");
                window.location = "../login.html";
            </script>';
        }
    
?>