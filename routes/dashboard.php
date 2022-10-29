<?php
    session_start();
    
    if(!isset($_SESSION['id'])){
        header("location: ../login.html");
    }

    $userdata = $_SESSION['userdata'];
    



    if($_SESSION['status'] == 0){
        $status = '<b style="color:red">Not Voted</b>';
    }else{
        $status = '<b style="color:green">Voted</b>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../CSS/Style.css">
    
</head>
<body>
    <center>
        <div id="Header-Section">
                <h1>Online Voting System</h1>
        </div>
    </center>
    <hr>
    <div id="profile">
        <center><img src="../uploads/<?php echo $userdata['photo']?>" hight="150" width="150"><br><br></center>
        <b>Name:</b><?php echo $userdata['name'] ?><br><br>
        <b>Mobile:</b><?php echo $userdata['mobile'] ?><br><br>
        <b>Address:</b><?php echo $userdata['address'] ?><br><br>
        <b>Status:</b><?php echo $status ?><br><br>
        <a href="../api/logout.php"><button id="logout-button">Logout</button></a>


    </div>
    <div id="Group">
        <?php
            if(isset($_SESSION['groupdata'])){
                $groupdata = $_SESSION['groupdata'];    
                for ($i=0; $i <count($groupdata) ; $i++) { 
                    ?>
                        <div>
                            <img style="float:right" src="../uploads/<?php echo $groupdata[$i]['photo']?>" hight="100" width="100"><br><br>
                            <b>Group Name:</b><?php echo $groupdata[$i]['name'] ?> <br><br>
                            <b>Votes:</b><?php echo $groupdata[$i]['votes'] ?><br><br>
                            
                                <form action="vote.php" method="POST">
                                    <input type="hidden" name="groupvote" value="<?php echo $groupdata[$i]['votes'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id'] ?>">
                                    <!-- <input type="text" namr="MY" values="100"> -->

                                    <?php

                                        if($_SESSION['status']==1){
                                            ?>
                                            <button disabled style="padding: 5px; font-size: 15px; background-color: #27ae60; color: white; border-radius: 5px;" type="button">Voted</button>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button style="padding: 5px; font-size: 15px; background-color: #3498db; color: white; border-radius: 5px;" type="submit">Vote</button>
                                            <?php
                                        }
                                    ?>
                                </form>

                        </div>
                         <br>
                        <hr>
                    <?php
                }
            }
        ?>
    </div>
    
</body>
</html>