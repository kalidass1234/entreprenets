<div id="responsive_mnu">
<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
<div id="responsive_menu" class="hidden">
    <ul>
        <li><a href="index.php"> Home</a></li>
        <li><a href="#">My Account</a>
        <ul>
            <!--<li><a href="upgrade_payment_package.php" >Upgrade</a></li>-->
            <li><a href="power_leg.php" >Power Leg</a></li>
            <li><a href="leftrightpv.php" >Left/Right PV</a></li>
           <!-- <li><a href="apply_for_verified.php" >Affiliate Verification</a></li>-->
        </ul>
        </li>
        <li><a href="event.php">Announcement</a></li>
       <!-- <li><a href="step1.php">Seven Step Formula</a></li>-->
        <li><a href="#">Income</a>
        <ul>
            <li><a href="direct_referral_bonus.php" >Direct Referal Bonus </a></li>
                <li><a href="upgrade_bonus.php" >Upgrading Bonus</a></li>
                <li><a href="binary_income.php" >Binary Income</a></li>
                <li><a href="five_star_special_bonus.php" >5 Star Special Bonus </a></li>
                <li><a href="matching_income.php" >Matching Bonus </a></li>
                <li><a href="repurchase_bonus_income.php" >Repurchase Bonus Report </a></li>
                <li><a href="repurchase_binary_income.php" >Repurchase Binary Bonus Report </a></li>
                <li><a href="final_bonus_report.php" >Final Bonus Report </a></li>
        </ul>
        </li>
        <li><a href="matrix_genealogy.php">My Tree</a>
        <ul>
            <li><a href="binary_geneology.php" >Binary Tree</a></li>
            <li><a href="matrix_gen.php" >Unilevel Tree</a></li>
        </ul>
        </li>
        <li><a href="#">My Team</a>
        <ul>
            <li><a href="genealogy11.php">Summary</a></li>
            <li><a href="totaldownline.php">View Downline</a></li>
            <li><a href="genealogydoenline.php">Direct Member</a></li>
        </ul>
        </li>
        <li><a href="#">Financial Manager</a>
        <ul>
            <li><a href="request_cashwallet.php" >Financial Request</a></li>
					<li><a href="financial_manager.php" >Transaction History</a></li>
					<li><a href="financial_manager1.php" >Cash Wallet</a></li>		
        </ul>
        </li>	
        <li><a href="#">Shopping Cart</a>
        <ul>
            <li><a href="..<?php echo $_SESSION['adid'];?>" target="_blank">Eshop</a></li>
        <li><a href="purchase_order.php" >Purchase History(Eshop)</a></li>
        </ul>
        </li>
        <li><a href="#">Rank</a>
        <ul>
            <li><a href="qualification.php" >Rank</a></li>
            <li><a href="qualification_monthly.php" >Monthly Rank</a></li>	
        </ul>
        </li>
         <li><a href="top_recuiter.php">Top Recuiters</a></li>
       <!-- <li><a href="#">Daily Tasks</a>
        <ul>
            <li><a href="stock_to_sell.php">Stock To Sell</a></li>
            <li><a href="weekly_adds.php">Daily Tasks</a></li>
            <li><a href="weekly_adds_verify.php">Daily Adds Verify</a></li>
            <li><a href="weekly_add_central.php">Daily Adds Modules</a></li>	
        </ul>
        </li>-->
        <!--<li><a href="marketing.php">Marketing Tools</a></li>-->
        <li><a href="gallery.php">Gallary</a></li>
        <li><a href="#">Messaging</a>
        <ul>
            <li><a href="compose.php">Compose</a></li>
            <li><a href="inbox.php" >Inbox</a></li>
            <li><a href="compose.php">Sent Message</a></li>
        </ul>
        </li>
        <li><a href="email.php">Email To User</a></li>
       <?php /*?> <?php
                $sql_bc_category="select * from cms_category_backoffice where status=0";
				$res_bc_category=mysql_query($sql_bc_category);
				while($row_bc_category=mysql_fetch_assoc($res_bc_category))
				{
					$bc_category_id=$row_bc_category['id'];
					$bc_category_name=$row_bc_category['category_name'];
					$bc_link_status=$row_bc_category['link_status'];
					
					
					$icon_path="../product_logos/cmsbackoffice/".$row_bc_category['icon'];
					if(file_exists($icon_path) && $row_bc_category['icon']!='')
					{
						$icon_path="../product_logos/cmsbackoffice/".$row_bc_category['icon'];
					}
					else
					{
						$icon_path="backend-images/spill-over.png";
					}
					
					$sql_bc_subcategory="select * from cms_subcategory_backoffice where status=0 and category_id='$bc_category_id'";
					$res_bc_subcategory=mysql_query($sql_bc_subcategory);
					$count_bc_subcategory=mysql_num_rows($res_bc_subcategory);
					if($count_bc_subcategory)
					{
					
					?>
                        <li><a href="#"><?php echo $bc_category_name;?><span class="up_down_arrow">&nbsp;</span></a>
                        <ul>
                        <?php
                        while($row_bc_subcategory=mysql_fetch_assoc($res_bc_subcategory))
						{
							$bc_subcategory_id=$row_bc_subcategory['id'];
							$bc_subcategory_name=$row_bc_subcategory['category_name'];
							$bc_subcategory_link_status=$row_bc_subcategory['link_status'];
							$bc_subcategory_link=$row_bc_subcategory['link'];
							$bc_subcategory_target=$row_bc_subcategory['target'];
							if($bc_subcategory_link_status)
							{
								$bc_subcategory_link="cms.php?category=".$bc_category_id."&subcategory=".$bc_subcategory_id;
								$bc_subcategory_target="";
							}
							else
							{
								$bc_subcategory_link=$row_bc_subcategory['link'];
								$bc_subcategory_target=$row_bc_subcategory['target'];
							}
						?>
                        <li><a href="<?php echo $bc_subcategory_link;?>" target="<?php echo $bc_subcategory_target;?>" ><?php echo $bc_subcategory_name;?></a></li>
                        <?php
                        }
						?>
                        </ul>
                        </li>
					<?php
					}
					else
					{
						if($bc_link_status)
						{
							$bc_link="cms.php?category=".$bc_category_id;
							$bc_target="";
						}
						else
						{
							$bc_link=$row_bc_category['link'];
							$bc_target=$row_bc_category['target'];
						}
					?>
                        <li><a href="<?php echo $bc_link;?>" target="<?php echo $bc_target;?>"><?php echo $bc_category_name;?></a></li>
					<?php
					}
                }
				?><?php */?>
    </ul>
</div>
</div>