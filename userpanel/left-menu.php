<?php
$_SESSION['Session_Rand_No'] = rand();
$sql_check_u = "select * from registration where user_name='$_SESSION[adid]'";
$res_check_u = mysql_query($sql_check_u);
$row_check_u = mysql_fetch_assoc($res_check_u);
$ppckage_amount = $row_check_u['package_amount'];
?>
<div id="sidebar" style="width:265px; margin-left:0px;">
    <div id="secondary_nav">
        <ul id="sidenav" class="accordion_mnu collapsible" style="margin:0px;">
            <li><a href="index.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/home.png" height="20" width="20" alt="" border="0" /></span>Home</a></li>
            <li><a href="anouncement.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/home.png" height="20" width="20" alt="" border="0" /></span>Tutorials</a></li>
            <li><a href="matrix_genealogy.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/commission.png" height="20" width="20" alt="" border="0" /></span>Income<span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">
                    <li><a href="bonus_income.php" ><span class="list-icon">&nbsp;</span>Bonus (Primary)</a></li>
                    <?php
                    if ($ppckage_amount == 35.00) {
                        ?>
                        <li><a href="level_income_bmc1.php" ><span class="list-icon">&nbsp;</span>BMC1 (Primary)</a></li>
                        <li><a href="level_income_bmc2.php" ><span class="list-icon">&nbsp;</span>BMC2 (Secondary)</a></li>
                        <li><a href="level_income_bmc3.php" ><span class="list-icon">&nbsp;</span>BMC3 (Secondary)</a></li>
<?php } else if ($ppckage_amount == 70.00) { ?>
                        <li><a href="level_income_bmc1.php" ><span class="list-icon">&nbsp;</span>BMC1 (Secondary)</a></li>
                        <li><a href="level_income_bmc2.php" ><span class="list-icon">&nbsp;</span>BMC2 (Primary)</a></li>
                        <li><a href="level_income_bmc3.php" ><span class="list-icon">&nbsp;</span>BMC3 (Secondary)</a></li>

<?php } else if ($ppckage_amount == 140.00) { ?>
                        <li><a href="level_income_bmc1.php" ><span class="list-icon">&nbsp;</span>BMC1 (Secondary)</a></li>
                        <li><a href="level_income_bmc2.php" ><span class="list-icon">&nbsp;</span>BMC2 (Secondary)</a></li>
                        <li><a href="level_income_bmc3.php" ><span class="list-icon">&nbsp;</span>BMC3 (Primary)</a></li>
<?php } ?>
                    <li><a href="all_income.php" ><span class="list-icon">&nbsp;</span>All Income</a></li>

                </ul>
            </li>

            <li><a href="matrix_genealogy.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/mytree.png" height="20" width="20" alt="" border="0" /></span>Primary Circles<span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">

<?php
if ($ppckage_amount == 35.00) {
    ?>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC1)</a></li>
                        <li><a href="matrix_gen.php" ><span class="list-icon">&nbsp;</span>My Direct Downline </a></li>
                    <?php
                    } else if ($ppckage_amount == 70.00) {
                        ?>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC2)</a></li>
                        <li><a href="matrix_gen.php" ><span class="list-icon">&nbsp;</span>My Direct Downline</a></li>			
                    <?php
                    } else if ($ppckage_amount == 140.00) {
                        ?>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC3)</a></li>

                        <li><a href="matrix_gen.php" ><span class="list-icon">&nbsp;</span>My Direct Downline</a></li>			
                    <?php } ?>


                    <li><a href="genealogy11.php" ><span class="list-icon">&nbsp;</span>Summary</a></li>
                    <?php
                    if ($ppckage_amount == 35.00) {
                        ?>
                        <li><a href="totaldownline.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC1)</a></li>
                    <?php
                    } else if ($ppckage_amount == 70.00) {
                        ?>
                        <li><a href="totaldownline_second.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC2)</a></li>
                    <?php
                    } else if ($ppckage_amount == 140.00) {
                        ?>
                        <li><a href="totaldownline_third.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC3)</a></li>
                    <?php } ?>
                    <li><a href="genealogydoenline.php" ><span class="list-icon">&nbsp;</span>Direct Member</a></li>

                </ul>
            </li>


            <li><a href="matrix_genealogy.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/mytree.png" height="20" width="20" alt="" border="0" /></span>Secondary Circles<span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">

<?php
if ($ppckage_amount == 35.00) {
    ?>
                        <li><a href="my_board_bmc2.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC2)</a></li>
                        <li><a href="my_board_bmc3.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC3)</a></li>

<?php
} else if ($ppckage_amount == 70.00) {
    ?>
                        <li><a href="matrix_genealogy_35_70.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC1)</a></li>
                        <li><a href="my_board_bmc3.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC3)</a></li>

<?php
} else if ($ppckage_amount == 140.00) {
    ?>

                        <li><a href="matrix_genealogy_70_140.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC1)</a></li>
                        <li><a href="matrix_genealogy_35_140.php" ><span class="list-icon">&nbsp;</span>Matrix Tree (BMC2)</a></li>
                        <li><a href="matrix_gen.php" ><span class="list-icon">&nbsp;</span>Unilevel Tree</a></li>			
<?php } ?>

                    <?php
                    if ($ppckage_amount == 35.00) {
                        ?>
                        <li><a href="totaldownline_second.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC2)</a></li>
                        <li><a href="totaldownline_third.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC3)</a></li>
<?php
}
if ($ppckage_amount == 70.00) {
    ?>
                        <li><a href="totaldownline.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC1)</a></li>
                        <li><a href="totaldownline_third.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC3)</a></li>
                    <?php
                    }
                    if ($ppckage_amount == 140.00) {
                        ?>
                        <li><a href="totaldownline.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC1)</a></li>
                        <li><a href="totaldownline_second.php" ><span class="list-icon">&nbsp;</span>Total Downline (BMC2)</a></li>
                    <?php } ?>					
                </ul>
            </li>

                                <!--<li><a href="matrix_genealogy.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/mytree.png" height="20" width="20" alt="" border="0" /></span>My Circle History <span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">

                    <?php
                    if ($ppckage_amount == 35.00) {
                        ?>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC1)</a></li>
                        <li><a href="my_board_bmc2.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC2)</a></li>
                        <li><a href="my_board_bmc3.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC3)</a></li>
<?php
} else if ($ppckage_amount == 70.00) {
    ?>
                        <li><a href="my_board_bmc2.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC2)</a></li>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC1)</a></li>
                        <li><a href="my_board_bmc3.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC3)</a></li>
            <?php
            } else if ($ppckage_amount == 140.00) {
                ?>
                        <li><a href="my_board_bmc3.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC3)</a></li>
                        <li><a href="my_board_bmc2.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC2)</a></li>
                        <li><a href="my_board_bmc1.php" ><span class="list-icon">&nbsp;</span>Circle History (BMC1)</a></li>
            <?php } ?>
                                        
                                </ul>
                </li>
            -->

            <li><a href="edit_user.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="update-your-logo.jpg" height="20" width="20" alt="" border="0" /></span>Update Profile</a></li>
            <li><a href="#"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/1390664262_Dollar.png" height="20" width="20" alt="" border="0" /></span>Financial Manager<span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">
                    <li><a href="financial_manager.php" ><span class="list-icon">&nbsp;</span>Transaction History</a></li>
                    <li><a href="financial_manager1.php" ><span class="list-icon">&nbsp;</span>Ewallet</a></li>

                </ul>
            </li>

            <li><a href="#"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/1390664262_Dollar.png" height="20" width="20" alt="" border="0"></span>VOUCHER BANK<span class="up_down_arrow">&nbsp;</span></a>
                <ul class="acitem" style="margin-left:-1px; margin-top:0px;">
                    <li><a href="e-vouchers.php" ><span class="list-icon">&nbsp;</span>E-Vouchers</a></li>
                    <li><a href="transfer-voucher.php" ><span class="list-icon">&nbsp;</span>Transfer E-voucher</a></li>
                    <li><a href="voucher-history.php" ><span class="list-icon">&nbsp;</span>Transfer E-voucher History</a></li>
                    <li><a href="request-voucher.php" ><span class="list-icon">&nbsp;</span>Request for E-voucher</a></li>
                    <li><a href="voucher-request-history.php" ><span class="list-icon">&nbsp;</span>Request for E-voucher History</a></li>
                </ul>
            </li>
            <li><a href="gallery.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/gallery.png" height="20" width="20" alt="" border="0" /></span>Gallery</a></li>
            <li><a href="myebusiness.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/sheduled_task.png" height="20" width="20" alt="" border="0" /></span>My eBusiness</a></li>
            <li><a href="privacy_policy.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/terms-&-Condition.png" height="20" width="20" alt="" border="0" /></span>Privacy Policy</a></li>
            <li><a href="terms.php"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/terms-&-Condition.png" height="20" width="20" alt="" border="0" /></span>Term & Condition</a></li>

<?php if ($get_id == 0) {
    ?>
                <li><a href="email.php"><span class="nav_icon mail"></span>Email To User</a>
                <li><a href="#"><span style="float:left; margin-left:-25px!important; margin-top:5px;"><img src="backend-images/messaging.png" height="20" width="20" alt="" border="0" /></span>Member Converse<?php if ($totalmsgcount) { ?><span class="alert_notify blue"><?php echo $totalmsgcount; ?></span><?php } ?><span class="up_down_arrow">&nbsp;</span></a>
                    <ul class="acitem" style="margin-left:-1px; margin-top:0px;">
    <?php
    $mmmmid = showuserid($_SESSION['SD_User_Name']);
    $str_sent1 = "select * from message_sender where sender_id='$mmmmid' and status=0 order by id desc";
    $res_sent1 = mysql_query($str_sent1);
    $count_sent1 = mysql_num_rows($res_sent1);

    $str_inb = "select * from message where reciever_id='$mmmmid' and status=0 order by id desc";
    $res_inb = mysql_query($str_inb);
    $count_inb = mysql_num_rows($res_inb);

    $str_draft1 = "select * from message_draft where sender_id='$mmmmid' and status=0 order by id desc";
    $res_draft1 = mysql_query($str_draft1);
    $count_draft1 = mysql_num_rows($res_draft1);

    $str_trash1 = "select *,'sender' as type from message_sender where sender_id='$mmmmid' and status=1 
			union all 
			select *,'receiver' as type from message where reciever_id='$mmmmid' and status=1
			union all 
			select *,'draft' as type from message_draft where reciever_id='$mmmmid' and status=1
			 order by ts desc
			";
    $res_trash1 = mysql_query($str_trash1);
    $count_trash1 = mysql_num_rows($res_trash1);
    ?>	
                        <li><a href="compose.php" ><span class="list-icon">&nbsp;</span>Compose</a></li>
                        <li><a href="inbox.php" ><?php if ($msginboxcount) { ?><span class="alert_notify blue"><?php echo $msginboxcount; ?></span><?php } ?><span class="list-icon">&nbsp;</span>Inbox&nbsp;(<?php echo $count_inb; ?>)</a></li>
                        <li><a href="inbox_sent.php" ><span class="list-icon">&nbsp;</span>Sent&nbsp;(<?php echo $count_sent1; ?>)</a></li>
                        <li><a href="inbox_draft.php" ><span class="list-icon">&nbsp;</span>Draft&nbsp;(<?php echo $count_draft1; ?>)</a></li>
                        <li><a href="inbox_trash.php" ><span class="list-icon">&nbsp;</span>Trash&nbsp;(<?php echo $count_trash1; ?>)</a></li><?php } ?>
                </ul>
            </li>

            </li>

        </ul>
    </div>
</div>