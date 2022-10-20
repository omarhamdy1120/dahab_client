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
        header( "location:../login.php" );
        die();
    }
    include_once "../config.php";
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>users</title>
</head>

<body>
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
                $query = "SELECT fname,lname,role,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );

                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    $role = $data['role'];
                    $avatar = $data['avatar'];
                ?>
                <img src="../assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="../index.php">Dashboard</a>
                        <a class="dropdown-item" href="../index.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="../logout.php">Log Out</a>
                    </div>
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
        <img class="logo" src="../assets/img/logo.png" alt="Dahab" style="width:150px">
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="../index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <?php if ( 'admin' == $sessionRole ) {?>
                <!-- For Admin, -->
                <li id="left" class="sideber__item sideber__item--modify<?php if ( 'addusers' == $id ) {
                                                                            echo " active";
                                                                        }?>">
                    <a href="users.php?id=addusers"><i id="left" class="fas fa-user-plus"></i>Add users</a>
                </li><?php }?>
            <li id="left" class="sideber__item<?php if ( 'allusers' == $id ) {
    echo " active";
}?>">
                <a href="users.php?id=allusers"><i id="left" class="fas fa-user"></i>All users</a>
            </li>
        </ul>
        <footer class="text-center" style="font-size:12px;" ><span>DahabMasr</span><br>©2022 DahabMasr All right reserved.</footer>
    </section>
    <section class="main">
        <div class="container">

            <!-- ---------------------- DashBoard ------------------------ -->
            <!-- ---------------------- users ------------------------ -->
            <div class="users">
                <?php if ( 'allusers' == $id ) {?>
                    <div class="allusers">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <?php if ( 'admin' == $sessionRole) {?>
                                            <!-- For Admin-->
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getusers = "SELECT * FROM users";
                                            $result = mysqli_query( $connection, $getusers );

                                        while ( $users = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                             <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="../assets/img/<?php echo $users['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $users['fname'], $users['lname'] );?></td>
                                            <td><?php printf( "%s", $users['email'] );?></td>
                                            <td><?php printf( "%s", $users['phone'] );?></td>
                                            <?php if ( 'admin' == $sessionRole) {?>
                                                <!-- For Admin-->
                                                <td><?php printf( "<a href='users.php?action=editusers&id=%s'><i class='fas fa-edit'></i></a>", $users['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='users.php?action=deleteusers&id=%s'><i class='fas fa-trash'></i></a>", $users['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addusers' == $id ) {?>
                    <div class="addusers">
                        <div class="main__form">
                            <div class="main__form--title text-center">Add New users</div>
                            <form action="../add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addusers">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editusers' == $action ) {
                        $usersID = $_REQUEST['id'];
                        $selectusers = "SELECT * FROM users WHERE id='{$usersID}'";
                        $result = mysqli_query( $connection, $selectusers );

                    $users = mysqli_fetch_assoc( $result );?>
                    <div class="addManager">
                        <div class="main__form">
                            <div class="main__form--title text-center">Update users</div>
                            <form action="../add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $users['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $users['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $users['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $users['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateusers">
                                    <input type="hidden" name="id" value="<?php echo $usersID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteusers' == $action ) {
                        $usersID = $_REQUEST['id'];
                        $deleteusers = "DELETE FROM users WHERE id ='{$usersID}'";
                        $result = mysqli_query( $connection, $deleteusers );
                        header( "location:users.php?id=allusers" );
                        ob_end_flush();
                }?>
            </div>
            
        </div>
    </section>
    <!-- Optional JavaScript -->
    <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="../assets/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            
</body>
</html>
