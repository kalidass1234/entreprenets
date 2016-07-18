<?php 
error_reporting(0);
include('../includes/all_func.php');
include('header.php');

$idd=$_SESSION['adid'];
$s="select * from registration where user_name='$idd'";
$ffr=mysql_query($s);
$f=mysql_fetch_array($ffr);
$id=$f['user_id'];
$sponser_id=$f['ref_id'];
$date=date('Y-m-d H:i:s');		
mysql_query("update registration set current_login_date='$date', current_login_status='Login' where user_id='$id'");		
		
$query="select user_id from registration where ref_id='$id'";
$q=mysql_query($query);
$totaldirectmem=mysql_num_rows($q);

?>
<body id="theme-default" class="full_block" >
<div id="actionsBox" class="actionsBox">
  <div id="actionsBoxMenu" class="menu"> <span id="cntBoxMenu">0</span> <a class="button box_action">Archive</a> <a class="button box_action">Delete</a> <a id="toggleBoxMenu" class="open"></a> <a id="closeBoxMenu" class="button t_close">X</a> </div>
  <div class="submenu"> <a class="first box_action">Move...</a> <a class="box_action">Mark as read</a> <a class="box_action">Mark as unread</a> <a class="last box_action">Spam</a> </div>
</div>
<div id="header" class="blue_lin" style="background:#000;">
  <div class="header_left">
    <?php 
		include('header-left.php');
		include('menu-mobile.php');
	?>
  </div>
  <?php include('header-right.php'); ?>
</div>
<?php 
include('left-bar.php');
?><div id="container">

  <div class="page_title"> <span class="title_icon"><span class="computer_imac"></span></span>
    <h3>Dashboard <span style="float:right">Welcome <?php echo $idd;?> !</span></h3>
    
  </div>
  <?php 
	include('switch-bar.php');
	$query="select user_id from registration where nom_id='$id'";
	$q=mysql_query($query);
	$r=0;
	while($row_d=mysql_fetch_assoc($q))
	{
		$r++;
		$uid=$row_d['user_id'];
		$query1="select user_id from registration where nom_id='$uid'";
		$q1=mysql_query($query1);
		while($row_d1=mysql_fetch_assoc($q1))
		{
			$r++;
			$uid1=$row_d1['user_id'];
			$query2="select user_id from registration where nom_id='$uid1'";
			//echo "<br>";
			$q2=mysql_query($query2);
			while($row_d2=mysql_fetch_assoc($q2))
			{
				$r++;
				$uid2=$row_d2['user_id'];
			}
		}	
	}
?>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <div class="social_activities"> 
          <div class="comments_s" style="width:220px;">
            <div class="block_label" style="width:220px;"> Total Downline<span>
              <?php  echo $r;?>
              </span> </div>
            <span class="badge_icon customers_sl"> </span> </div>
          
           <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Total Direct Member:<span>
              <?php  echo $totaldirectmem;?>
              </span> </div> <span class="badge_icon customers_sl"> </span>
          </div>
           <div class="comments_s" style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Plan:<span>
              <?php  echo $f['package_name'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div style="height:70px;"></div>
           <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Ip Address:<span>
              <?php echo $_SERVER['REMOTE_ADDR'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Registration Date:<span>
              <?php echo $f['reg_date'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Sponsor Id:<span>
                <?php echo $f['ref_id'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Sponsor Name:<span>
                <?php echo showusername($f['ref_id']);?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
            <div style="height:70px;"></div>
             <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your User Id:<span>
                 <?php echo $f['user_id'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your User Name:<span>
                <?php echo $idd;?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          
         <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Upline Id:<span>
                 <?php echo $f['nom_id'];?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Your Upline Name:<span>
                 <?php echo showusername($f['nom_id']);?>
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          
           <div style="height:70px;"></div>
             <div class="comments_s"  style="width:220px;">
            <div class="block_label" style="width:220px;"> Ewallet Balance:<span>
                 <?php  $res_reg1=mysql_fetch_array(mysql_query("SELECT * FROM final_e_wallet WHERE user_id='".$f['user_id']."'"));

 echo $res_reg1['amount']; ?> USD
              </span> </div> <span class="badge_icon customers_sl"> </span> 
          </div>
          
          
         
         
          
          
          
        </div>
        <div class="widget_content">
        
        
        
          <div class="grid_12">
            <div class="widget_wrap collapsible_widget">
              <div class="widget_top active"> <span class="h_icon"></span>
                <h6>Anouncement</h6>
              </div>
              <div class="widget_content">
                <table class="display data_tbl">
                  <thead>
                    <tr>
                      <th> Date </th>
                      <th> Event </th>
                      <th> Description </th>
                      <th> View Detail </th>
                    </tr>
                  </thead>
                  <tbody>
                                    
                  
                    <?php

						   $str1="select * from promo where status=1";

							$res1=mysql_query($str1);

							if(mysql_num_rows($res1)>0){

						  while($x1=mysql_fetch_array($res1))

						  {

			 			 ?>
                    <tr>
                      <td align="center" class="ptext"><?=$x1['n_date']?></td>
                      <td align="center" class="ptext"><?=$x1['news_name']?></td>
                      <td align="center" class="ptext"><?=substr(strip_tags($x1['description']),0,50);?></td>
                      <td align="center" class="ptext"><a href="view_events.php?id=<?php echo $x1['n_id'];?>">View Detail</a></td>
                    </tr>
                    <?php

                         }


						}

					 ?>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <div id="chart8" class="chart_block"> </div>
            </div>
          </div>
        </div>
        <div class="grid_12">
          <div class="widget_wrap collapsible_widget">
            <div class="widget_top active" style="background:#00a3e7; color:#fff;"> <span class="h_icon"></span>
              <h6>CONGRATULATIONS</h6>
            </div>
            <div class="widget_content">
              <h3>CONGRATULATIONS</h3>
              <p>
                <?php  
				 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));
				 echo $sql_welcome['description'];
				 ?>
              </p>
              <div id="chart8" class="chart_block"> </div>
            </div>
          </div>
        </div>
        <br/><br/>
        <span class="clear"></span> </div><br/><br/>
    </div><br/><br/>
  </div><br/><br/>
</div><br/><br/>
</div><br/><br/>

</body>
</html>