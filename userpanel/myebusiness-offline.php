<?php
include('../includes/all_func.php');
include('header.php');

error_reporting(E_ALL ^ E_NOTICE);
if (isset($_SESSION) && $_SESSION['adid']) {
    $s="select * from registration where user_name='".$_SESSION['adid']."'";
    $ffr=mysql_query($s);
    $f=mysql_fetch_array($ffr);
    $user_id=$f['user_id'];
} else {
    echo "<script language='javascript'>window.location.href='login.php';</script>";
    exit;
}
?>
<body id="theme-default" class="full_block">
    <div id="actionsBox" class="actionsBox">
        <div id="actionsBoxMenu" class="menu">
            <span id="cntBoxMenu">0</span>
            <a class="button box_action">Archive</a>
            <a class="button box_action">Delete</a>
            <a id="toggleBoxMenu" class="open"></a>
            <a id="closeBoxMenu" class="button t_close">X</a>
        </div>
        <div class="submenu">
            <a class="first box_action">Move...</a>
            <a class="box_action">Mark as read</a>
            <a class="box_action">Mark as unread</a>
            <a class="last box_action">Spam</a>
        </div>
    </div>
<?php
include('left-bar.php');
?>
    <div id="container">
        <div id="header" class="blue_lin">
            <div class="header_left">
<?php
include('header-left.php');
?>
                <?php
                include('menu-mobile.php');
                ?>
            </div>
                <?php
                include('header-right.php');
                ?>
        </div>
        <div class="page_title">
            <span class="title_icon"><span class="computer_imac"></span></span>
            <h3>My eBusiness</h3>
        </div>
<?php
//include('switch-bar.php');
?>
        <div id="content">
            <div class="grid_container">
                <div class="grid_12 full_block">
                    <div class="widget_wrap">
                        <div class="widget_top">
                            <span class="h_icon blocks_images"></span>
                            <h6>Online Business</h6>
                            <div id="widget_tab">
                                <ul>
                                    <li><a href="myebusiness.php">Online business</a></li>
                                    <li><a href="#" class="active_tab">Offline business</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="widget_content">
                            <ul id="search_box">
                            <li>
                                <a href="../offline-business.php" target="_blank">Click here to select offline business</a>
                            </li>
                            </ul>
                        </div>
                        
                        
                        <div class="widget_content">

                            <table class="display data_tbl">
                                <thead>
                                    <tr>
                                        <th>
                                            S.No.
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Short Description
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Detail
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqll = mysql_query("SELECT p.* FROM user_project up LEFT JOIN manage_projects p ON p.id=up.project_id WHERE p.project_type=1 AND up.user_id='".$user_id."' AND up.status=1 AND p.display_status=1");
                                    $ii = 0;
                                    while ($fetch = mysql_fetch_assoc($sqll)) {
                                        $imgq = mysql_query("SELECT image FROM manage_projects_images WHERE project_id='".$fetch['id']."' LIMIT 1");
                                        $img = mysql_fetch_assoc($imgq);
                                        $ii++;
                                        ?>
                                        <tr>
                                            <td align="center" class="ptext"><?= $ii; ?></td>
                                            <td align="center" class="ptext"><?= $fetch['title'] ?></td>
                                            <td align="center" class="ptext"><?= $fetch['short_desc'] ?></td>
                                            <td align="center" class="ptext">
                                            <?php 
                                                if(!empty($img['image'])){
                                                ?>
                                                <img src="../admin/project_image/<?=$img['image'];?>" height="100" width="100" />
                                                <?php
                                                } else {
                                                    echo "No image";
                                                }
                                            ?>
                                            </td>
                                            <td align="center" class="ptext">
                                                <a target="_blank" href="../project-detail-page.php?id=<?=$fetch['id'];?>">See Detail</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div></div>
    </div>
</body>
</html>