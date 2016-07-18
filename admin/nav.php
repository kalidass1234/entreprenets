<?php 
//session_start();
function ticket_notification()
{
	 $str_pin=mysql_query("select * from tickets where status=0 and notification_status=0")or die(mysql_error());
	 $num=mysql_num_rows($str_pin);
	 if($num>0)
	 {
		 return $num;
	 }
	 else
	 {
		 return 0;
	 }
}



 $user_id=$_SESSION['privilege_uid'];

 $privileage = array();
		   $where_privileage = " where admin_id='".$user_id."'";
		   // get privileage
		  
 $args_privileage= mysql_query("select * from admin_privileges $where_privileage");
		   if( $args_privileage ){
			  while($privRow=mysql_fetch_assoc($args_privileage))
			  {
				   $privileage[] = $privRow['privilege_page'];
			   }
		   }
//print_r($privileage);
?>

<!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <!-- Search form -->
       <!-- <form class="navbar-form" role="search">
    			<div class="form-group">
    				<input type="text" class="form-control" placeholder="Search">
            <button class="btn search-button" type="submit"><i class="fa fa-search"></i></button>
    			</div>
    		</form>-->
        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <?php
        if($user_id!='1234567')
				{
					?>
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li><a href="admin_main.php?page_number=0" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
          <?php
          $res_menu=$obj_query->query("*","menu","status=0");
		  while($row_menu=$obj_query->get_all_row($res_menu))
		  {
		  	$menu_id=$row_menu['id'];
			// get sub menu
			$res_sub_menu=$obj_query->query("*","menu_sub","status=0 and menu_id='$menu_id'");
			$count_sub_menu=$obj_query->num_row($res_sub_menu);
		  ?>
          <li <?php if($count_sub_menu){?>class="has_sub"<?php }?>><a href="<?php echo $row_menu['page_name'];?>"><i class="fa fa-group"></i> <span><?php echo $row_menu['menu_name'];?></span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <?php if($count_sub_menu){?>
            <ul>
            <?php
            while($row_sub_menu=$obj_query->get_all_row($res_sub_menu))
			{
				
				
				$link=$row_sub_menu['page_name'];
				
           if(in_array($link,$privileage)):
				
				if($row_sub_menu['id']==41)
				{
			?>
             <li><a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=<?php echo $row_sub_menu['id'];?>"><?php echo $row_sub_menu['menu_sub_name'];?> <?php $staus=ticket_notification(); if($staus>0) { ?><span class="alert_notify blue">(<?php echo $staus; ?>)</span><?php } ?></a></li>
            <?php
				}
				else
				{
					?>
              <li><a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=<?php echo $row_sub_menu['id'];?>"><?php echo $row_sub_menu['menu_sub_name'];?></a></li>
            <?php
            } 
			endif; 
			}
			?>
            </ul>
            <?php }?>
          </li>
          <?php
		  }
		  ?>
        </ul>
        <?php
				}
				else
				{
					?>
                    
                      <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li><a href="admin_main.php?page_number=0" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
          <?php
          $res_menu=$obj_query->query("*","menu","status=0");
		  while($row_menu=$obj_query->get_all_row($res_menu))
		  {
		  	$menu_id=$row_menu['id'];
			// get sub menu
			$res_sub_menu=$obj_query->query("*","menu_sub","status=0 and menu_id='$menu_id'");
			$count_sub_menu=$obj_query->num_row($res_sub_menu);
		  ?>
          <li <?php if($count_sub_menu){?>class="has_sub"<?php }?>><a href="<?php echo $row_menu['page_name'];?>"><i class="fa fa-group"></i> <span><?php echo $row_menu['menu_name'];?></span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <?php if($count_sub_menu){?>
            <ul>
            <?php
            while($row_sub_menu=$obj_query->get_all_row($res_sub_menu))
			{
				
				
				
				if($row_sub_menu['id']==41)
				{
			?>
             <li><a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=<?php echo $row_sub_menu['id'];?>"><?php echo $row_sub_menu['menu_sub_name'];?> <?php $staus=ticket_notification(); if($staus>0) { ?><span class="alert_notify blue">(<?php echo $staus; ?>)</span><?php } ?></a></li>
            <?php
				}
				else
				{
					?>
              <li><a href="<?php echo SITE_URL; ?>admin/admin_main.php?page_number=<?php echo $row_sub_menu['id'];?>"><?php echo $row_sub_menu['menu_sub_name'];?></a></li>
            <?php
            } 
			}
			?>
            </ul>
            <?php }?>
          </li>
          <?php
		  }
		  ?>
        </ul>
        <?php
				}
				?>
    </div>
    
    
    <!-- Sidebar ends -->