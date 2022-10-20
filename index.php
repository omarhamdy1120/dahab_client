<?php
    // each client should remember their session id for EXACTLY 30 min
    ini_set('session.gc_maxlifetime', 1800);

    // each client should remember their session id for EXACTLY 30 min
    session_set_cookie_params(1800);

    session_start();
    $sessionId = isset($_SESSION['id']) ?$_SESSION['id'] :'';
    $sessionRole = isset($_SESSION['role']) ?$_SESSION['role'] :'';
    echo "$sessionId $sessionRole";
    if ( !$sessionId && !$sessionRole ) {
        header( "location:login.php" );
        die();
    }
    include_once "config.php";
    ob_start();
    $id = isset($_REQUEST['id']) ? $_REQUEST['id']:'dashboard';
    $action = isset($_REQUEST['action']) ?$_REQUEST['action']: '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>

<body>

    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "DashBoard";
                    } elseif ( 'addusers' == $id ) {
                        echo "Add users";
                    } elseif ( 'allusers' == $id ) {
                        echo "users";
                    } elseif ( 'userProfile' == $id ) {
                        echo "Your Profile";
                    } elseif ( 'editusers' == $action ) {
                        echo "Edit users";
                    }
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT * FROM users {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                }?>
                 <?php
                $query = "SELECT * FROM admins {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                }?>
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "$fname $lname"; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php">Dashboard</a>
                        <?php if ( 'admin' == $sessionRole ) { ?>
                            <a class="dropdown-item" href="inc/adminprofile.php?id=adminProfile">Profile</a>
                        <?php }else{ ?>
                            <a class="dropdown-item" href="inc/userprofile.php?id=userProfile">Profile</a>
                        <?php } ?>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
        <img class="logo" src="assets/img/logo.png" alt="Dahab" style="width:150px">
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ( 'admin' == $sessionRole ) {?>
                <!-- For Admin, -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addusers' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="inc/users.php?id=addusers"><i id="left" class="fas fa-user-plus"></i>Add users</a>
                </li><?php }?>
        </ul>
        <footer class="text-center" style="font-size:12px;" ><span>DahabMasr</span><br>©2022 DahabMasr All right reserved.</footer>
    </section>
    <!--------------------------------- #Sideber -------------------------------->


    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <?php if ( 'dashboard' == $id ) {?>
                <!-- ---------------------- Gold Price Calculator ------------------------ -->
               <?php }?>
                <?php
                    $karat_21=875;
                    $karat_24=999.9;
                    $queryy = "SELECT * from karat_21 , karat_24 ";
                    $result = mysqli_query($connection,$queryy);
                    $count = 1;
                    while($data = mysqli_fetch_array($result) ){
                        $id = $data['id'];
                        $buy_21 = $data['buy'];
                        $sell_21 = $data['sell'];
                        $buy_24 = $data['buy'];
                        $sell_24 = $data['sell'];

                        $buy_24= $buy_21 * $karat_24 / $karat_21;
                        $sell_24= $sell_21 * $karat_24 / $karat_21;

                        $count ++;
                    }
                    ?>  
                <!-- ---------------------- Gold Price Showing ------------------------ -->
            <div class="dashboard p-0">
                    <form method="post">
                        <div class="total">
                            <div class="row  gy-5">
                                <div class="col" style="left:150px; text-align: -webkit-right; bottom:25px">
                                <h2 style="text-align:center;font-family:arial ;color:#26282B"> Gold spot price</h2>
                                    <table width='300% 'style="border-collapse: collapse;" >
                                        <tr >
                                            <th width='40%' style="text-align:center;font-family:arial ;color:#26282B">21 karat</th>
                                            <th width='40%' style="text-align:center;border-right: solid 1px #26282B; border-left: solid 1px #26282B;">Buy</th>
                                            <th width='40%' style="text-align:center">Sell</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from karat_21";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $buy_21 = $data['buy'];
                                            $sell_21 = $data['sell'];
                                            $buy_24= $buy_21 * $karat_24 / $karat_21;
                                            $sell_24= $sell_21 * $karat_24 / $karat_21;
                                        ?>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <tr >
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;" > <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div contentEditable='true' class='edit' id='buy_<?php echo $id; ?>'> <?php echo $buy_21; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='sell_<?php echo $id; ?>'><?php echo $sell_21; ?> </div> </td>
                                            </tr>
                                        <?php 
                                            $count ++;
                                        }else{?>
                                            <tr >
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div> <?php echo $buy_21; ?></div> </td>
                                            <td> <div><?php echo $sell_21; ?> </div> </td>
                                        </tr><?php
                                        }
                                        }
                                        ?>  
                                    </table>
                                    <table width='300% border='0' >
                                        <tr >
                                            <th width='40%' style="text-align:center;font-family:arial ;color:#26282B">24 Karat</th>
                                            <th width='40%' style="text-align:center;border-right: solid 1px #26282B; border-left: solid 1px #26282B;">Buy</th>
                                            <th width='40%' style="text-align:center">Sell</th>

                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from karat_24";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $buy_24 = $data['buy'];
                                            $sell_24 = $data['sell'];
                                            $buy_24= $buy_21 * $karat_24 / $karat_21;
                                            $sell_24= $sell_21 * $karat_24 / $karat_21;

                                        ?>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <tr>
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div contentEditable='true' class='edit' id='buy_<?php echo $id; ?>'> <?php echo round($buy_24,2); ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='sell_<?php echo $id; ?>'><?php echo round($sell_24,2); ?> </div> </td>
                                            </tr>
                                        <?php 
                                            $count ++;
                                        }else{?>
                                            <tr>
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div> <?php echo round($buy_24,2); ?></div> </td>
                                            <td> <div><?php echo round($sell_24,2); ?> </div> </td>
                                        </tr><?php
                                        }
                                        }
                                        ?>  
                                    </table>
                                    
                                    <table width='300% border='0'>
                                        <tr>
                                            <th width='40%' style="text-align:center;font-family:arial ;color:#26282B">international</th>
                                            <th width='40%' style="text-align:center;border-right: solid 1px #26282B; border-left: solid 1px #26282B;">Buy</th>
                                            <th width='40%' style="text-align:center">Sell</th>
                                        </tr>
                                        <?php 
                                        $queryy = "SELECT * from international";
                                        $result = mysqli_query($connection,$queryy);
                                        $count = 1;
                                        while($data = mysqli_fetch_array($result) ){
                                            $id = $data['id'];
                                            $buy_inter = $data['buy'];
                                            $sell_inter = $data['sell'];
                                        ?>
                                        <?php if ( 'admin' == $sessionRole ) {?>
                                            <tr>
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                                <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div contentEditable='true' class='edit' id='buy_<?php echo $id; ?>'> <?php echo $buy_inter; ?></div> </td>
                                                <td> <div contentEditable='true' class='edit' id='sell_<?php echo $id; ?>'><?php echo $sell_inter; ?> </div> </td>
                                            </tr>
                                        <?php 
                                            $count ++;
                                        }else{?>
                                            <tr>
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div style="font-family:arial ;color:#A47E3B"> Prices</div> </td>
                                            <td style="border-right: solid 1px #A47E3B; border-left: solid 1px #A47E3B;"> <div> <?php echo $buy_inter; ?></div> </td>
                                            <td> <div><?php echo $sell_inter; ?> </div> </td>
                                        </tr><?php
                                        }
                                        }
                                        ?>  
                                    </table>
                                </div>
                                    </div>

                        </div>
                    </form>
                <br>
                
            </div>
        </div>
    </section>
    <!-- ---------------------- users ------------------------ -->

            
    <!-- ---------------------- User Profile ------------------------ -->

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="karat_24_script.js"></script>
    <script src="karat_21_script.js"></script>
    <script src="inter_script.js"></script>
</body>

</html>