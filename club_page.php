<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if($_GET['function'] == 'add')echo "Add Member";
        else echo "Remove Member";
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome.min.css">
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body id="body" onresize="myFunction()">

<div class="wrapper" id="wrapper">

    <div class="header">

        <div class="logo">
            <div class="logo-text">
                <strong>PLYMOUTH</strong>
            </div>
            <div class="logo-text">
                <strong>UNIVERSITY</strong>
            </div>
        </div>

        <div class="top">
            <div class="menu-icon-div">
                <a href="#" onclick="openNav()" class="menu-link"><img src="images/menu1.png" class="menu-icon"></a>
            </div>
            <span class="user-name">
                <?php echo isset($_SESSION['username'])?$_SESSION['username']:'no user'; ?>
            </span>



        </div>

    </div>





    <div class="left" id="mySideNav">
        <div class="sidebar-list">
            <ul>
                <?php
                include "php/sidebar_arrays.php";
                if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == "student" ){
                    foreach ($sidebar_array_students as $sidebar_item) {
                        echo "<li class='sidebar-item'>";
                        echo "<a href='$sidebar_item[2]' class='link'>";
                        echo "<i class='$sidebar_item[1]'></i><span style='padding: 10px'>$sidebar_item[0]</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                }else if(isset($_SESSION['access_level']) && $_SESSION['access_level'] == "lec" ){
                    foreach ($sidebar_array_lecturers as $sidebar_item) {
                        echo "<li class='sidebar-item'>";
                        echo "<a href='$sidebar_item[2]' class='link'>";
                        echo "<i class='$sidebar_item[1]'></i><span style='padding: 10px'>$sidebar_item[0]</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="main" id="content">
        <div class="box" id="box-one">
            <div class="box-header">
                <strong>
                    <?php
                    include "php/club_functions.php";
                    include "php/init.php";
                    echo get_club_name($conn, $_GET['club_id']);
                    switch ($_GET['function']){
                        case 'add': echo "<div class='year'><small>Add Member</small></div>"; break;
                        case 'send': echo "<div class='year'><small>Send Message</small></div>"; break;
                        case 'remove': echo "<div class='year'><small>Remove Member</small></div>"; break;
                    }
                    ?>
                </strong>
            </div>
            <div class="box-content">
                <div class="main-title">
                </div>
                <div class="box-data" style="text-align: left">
                    <form style="border: 0" action="php/club_functions.php" method="POST">
                            <?php
                            select_function($_GET['function'],$_GET['club_id'],$conn);
                            ?>
                        <input type="hidden" name="club_id" value="<?php echo $_GET['club_id']?>">
                        <input type="hidden" name="function" value="<?php echo $_GET['function']?>">

                        
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>