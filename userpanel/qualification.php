<?php
include("../includes/all_func.php");
 include_once ("header.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
 
		
		?>

<style type="text/css">
.display h3{
margin-top:0.1em;
}
</style>
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
<?php include('left-bar.php');?>
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
    <style>
	td
	{
		border: 1px solid #ccc;
		padding:10px;
	}
	</style>
	<div id="content">
		<div class="grid_container">
			
			
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6>My Rank</h6>
					</div>
					<div class="widget_content">
          
        
          
          <table class="display" >
               
               <tr><td colspan="6">
                 <table class="display" >
          <tr>
          <td class="center tr_select "><strong>Your Rank</strong></td>
          <td class="center"><strong>Your Personal BV</strong></td>
          <td class="center"><strong>Remaining BV for next rank</strong></td>
          <td class="center"><strong>Daily Caping (Cycle/Day)</strong></td>
           <td class="center"><strong>Remaining Daily Caping (Cycle/Day)</strong></td>
          </tr>
          <tr>
          <td class="center"><?php  $rank= _get_member_rank($_SESSION['SD_User_Name']);
		  echo $rank;?></td>
          <td class="center"><?php 
		  $bv= _get_personal_volume(USERID);
		   echo $bv." PV";?></td>
          
          <td class="center">
		<?php
		if($rank=='Customer')
		{
			echo "Purchase atleast one product, otherwise your account will be deactivate after one month of your registration<br>&darr;<br><br>";
		
			$fbv=30-$bv;
			echo "You are required ".$fbv." BV for <span style='color:red;'>1 star</span> rank<br>&darr;<br><br>";
			$fbv1=180-$bv;
			echo "You are required ".$fbv1." BV for  <span style='color:red;'>2 star</span> rank<br>&darr;<br><br>";
			$fbv2=360-$bv;
			echo "You are required ".$fbv2." BV for <span style='color:red;'>3 star</span> rank<br>&darr;<br><br>";
			$fbv3=1080-$bv;
			echo "You are required ".$fbv3." BV for <span style='color:red;'>5 star</span> rank";
		}
		
		elseif($rank=='Below Rank')
		{
			
			$fbv=30-$bv;
			echo "You are required ".$fbv." BV for <span style='color:red;'>1 star</span> rank<br>&darr;<br><br>";
			$fbv1=180-$bv;
			echo "You are required ".$fbv1." BV for  <span style='color:red;'>2 star</span> rank<br>&darr;<br><br>";
			$fbv2=360-$bv;
			echo "You are required ".$fbv2." BV for <span style='color:red;'>3 star</span> rank<br>&darr;<br><br>";
			$fbv3=1080-$bv;
			echo "You are required ".$fbv3." BV for <span style='color:red;'>5 star</span> rank";
		}
		elseif($rank=="1 Star")
		{
			$fbv=180-$bv;
			echo "You are required ".$fbv." BV for <span style='color:red;'>2 star</span> rank<br>&darr;<br><br>";
			$fbv2=360-$bv;
			echo "You are required ".$fbv2." BV for <span style='color:red;'>3 star</span> rank<br>&darr;<br><br>";
			$fbv3=1080-$bv;
			echo "You are required ".$fbv3." BV for <span style='color:red;'>5 star</span> rank";
		}
		elseif($rank=="2 Star")
		{
			$fbv=360-$bv;
			echo "You are required ".$fbv." BV for <span style='color:red;'>3 star</span> rank<br>&darr;<br><br>";
			$fbv3=1080-$bv;
			echo "You are required ".$fbv3." BV for <span style='color:red;'>5 star</span> rank";
		}
		elseif($rank=="3 Star")
		{
			$fbv=1080-$bv;
			echo "You are required ".$fbv." BV for <span style='color:red;'>5 star</span> rank";
		}
		elseif($rank=="5 Star")
		{
			
			echo "Achieved Highest Rank";
		}
		else
		{
		}
		?>
          </td>
          <td class="center"><?php 
		  if($rank=="1 Star")
			  echo "10";
		  elseif($rank=="2 Star")
		  	 echo "30";
		  elseif($rank=="3 Star")
		  	 echo "60";
		  elseif($rank=="5 Star")
		  	 echo "100";
			  
		  ?></td>
          
          
          
          
           <td class="center">
		<?php
		if($rank=='Customer')
		{
			
			echo "<span style='color:red;'>10</span> Cycle/Day after 1 star rank<br>&darr;<br><br>";
			echo "<span style='color:red;'>30 </span>Cycle/Day after 2 star rank<br>&darr;<br><br>";
			echo "<span style='color:red;'>60 </span>Cycle/Day after 3 star rank<br>&darr;<br><br>";
            echo "<span style='color:red;'>100</span> Cycle/Day after 5 star rank<br>&darr;<br><br>";	
				}
		
		elseif($rank=='Below Rank')
		{
			
			echo "<span style='color:red;'>10</span> Cycle/Day after 1 star rank<br>&darr;<br><br>";
			echo "<span style='color:red;'>30</span> Cycle/Day after 2 star rank<br>&darr;<br><br>";
			echo "<span style='color:red;'>60 </span>Cycle/Day after 3 star rank<br>&darr;<br><br>";
            echo "<span style='color:red;'>100</span> Cycle/Day after 5 star rank<br>&darr;<br><br>";	

		}
		elseif($rank=="1 Star")
		{
			echo "<span style='color:red;'>30</span> Cycle/Day after 2 star rank<br>&darr;<br><br>";
			echo "<span style='color:red;'>60</span> Cycle/Day after 3 star rank<br>&darr;<br><br>";
            echo "<span style='color:red;'>100</span> Cycle/Day after 5 star rank<br>&darr;<br><br>";	


		}
		elseif($rank=="2 Star")
		{
			echo "<span style='color:red;'>60</span> Cycle/Day after 3 star rank<br>&darr;<br><br>";
            echo "<span style='color:red;'>100</span> Cycle/Day after 5 star rank<br>&darr;<br><br>";	

		}
		elseif($rank=="3 Star")
		{
						
            echo "<span style='color:red;'>100 </span>Cycle/Day  after 5 star rank<br>&darr;<br><br>";	

		}
		elseif($rank=="5 Star")
		{
			
			echo "Achieved Highest Daily Caping";
		}
		else
		{
		}
		?>
          </td>
          </tr>
          </table>
              </td></tr> 
                <tr>
                <?php $rank = _get_member_rank($_SESSION['SD_User_Name']);
				if($rank=='Customer')
				{
				?>
                
               <td align="center" class="blink">Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>
               <?php 
				}
				elseif($rank=='Below Rank')
				{
				?>
              <td align="center" >Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center" class="blink">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>
                <?php 
				}
				elseif($rank=='1 Star')
				{
				?>
               <td align="center" >Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center" class="blink">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>
                <?php 
				}
				elseif($rank=='2 Star')
				{
				?>
               <td align="center">Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center"  class="blink">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>
                <?php 
				}
				elseif($rank=='3 Star')
				{
				?>
               <td align="center" >Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center" class="blink">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>
                <?php 
				}
				elseif($rank=='5 Star')
				{
				?>
               <td align="center" >Free Registration<br><br><img src="../images/red.png" height="50" width="50"></td>
               <td align="center">After First Purchase<br><br><img src="../images/green.png" height="50" width="50"></td>
               <td align="center">After Acquiring 30 BV<br><br><img src="../images/star1.png" height="50" width="50"> </td>
               <td align="center">After Acquiring 180 BV<br><br><img src="../images/star2.png" height="50" width="50"></td>
               <td align="center">After Acquiring 360 BV<br><br><img src="../images/star3.png" height="50" width="50"></td>
               <td align="center" class="blink">After Acquiring 1080 BV<br><br><img src="../images/star5.png" height="50" width="50"></td>

               <?php
				}
				?>
               </tr>
                </table>
          </h3>
          </div>
          </div>
          </div>
          </div>
          
  <span class="clear"></span> </div>
</div>
</body>
</html>
<script language="JavaScript">
/*function CopyToClipboard(text,no) {
//alert(no);
document.getElementById('show_copy_'+no).innerHTML='Link Copied';
var holdtext=document.getElementById('link_'+no).value;
var Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
/*var text=document.getElementById('text_copy');
var holdtext=text;*/
//holdtext.innerText = copytext.innerText;
//alert(holdtext.innerText)
/*Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
   /* Copied = text.createTextRange();
	alert(Copied);
    Copied.execCommand("Copy");*/
/*}*/
function CopyToClipboard(p,s) {
    if (window.clipboardData && clipboardData.setData) {
        clipboardData.setData('text', s);
    }
}
function setLocation(url)
{
	window.location.href=url;
}
</script>
