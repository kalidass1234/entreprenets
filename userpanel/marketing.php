<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
include('header.php');
$idd=$_SESSION['SD_User_Name'];
$s="select * from registration where user_name='$idd'";
$ffr=mysql_query($s) or die($s);
$f=mysql_fetch_array($ffr);
$id=$f['user_id'];
$sponser_id=$f['ref_id'];
 

?>
<style>
.table td{
	padding:1%;
	font-size:1.2em;
}
</style>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function() { 
		$("#image").change(function(){
				$("#userprofileimage").html('');
				$("#userprofileimage").html("<img src='images/progress.gif'>");
				$("#my-form").ajaxForm(
				{
					target: '#userprofileimage'
				}).submit();
				$("#image").val('');
		});
        });
</script>
<script language="javascript">
function setprofileimage(checkval)
{
	if(document.getElementById('checkbox'+checkval).checked==true)
	{
		document.getElementById('checkbox'+checkval).checked=true;
		var splitarr = $('#idstr').val().split(',');
		var i;
		for(i=0;i<splitarr.length;i++)
		{
			if(splitarr[i]==checkval)
			{
				$("#span"+checkval).addClass('checked');
			}
			else
			{
				$("#span"+splitarr[i]).removeClass('checked');
			}
		}
		applyprofileimage(checkval,'yes');
	}
	else
	{
		document.getElementById('checkbox'+checkval).checked=false;
		$("#span"+checkval).removeClass('checked');
		applyprofileimage(checkval,'no');
	}
}
function applyprofileimage(checkval,cond)
{
var urldata="checkval="+checkval+"&status="+cond;
	  $.ajax({
                type: "POST",
                async: "false",
                url: "ajax_profileimage.php",
                data: urldata,
                success: function(html) {
                    $('#userprofileimage').html(html);
                }
            });
}
</script>
<script src='https://connect.facebook.net/en_US/all.js'></script>
<script> 
      FB.init({appId: "732168676828527", status: true, cookie: true});

      function postToFeed(method1,link1,picture1,name1,caption1,description1) {
        // calling the API ...
        var obj = {
          method: method1,
          link: link1,
          picture: picture1,
          name: name1,
          caption: caption1,
          description: description1
        };


        function callback(response) {
          document.getElementById('msg').innerHTML = "Share Successfully" ;
        }

        FB.ui(obj, callback);
      }
    
    </script>
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
		$query2="select * from materials order by m_date desc";
$result2=mysql_query($query2);
echo mysql_error();
$nume=mysql_num_rows($result2);
$sql_show_banner=mysql_query("select * from banner_size");
		?>
	</div>
	<div class="page_title">
		
		<!--<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>-->
	</div>
	<?php
	//include('switch-bar.php');
	?>
	<div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
      <h6 align="center" style="color:#0033FF">Welcome <?php echo $_SESSION['SD_User_Name'];?> </h6>
            <div class="widget_wrap tabby">
              <div class="widget_top" align="center"> 
                <h6>Marketing Banners</h6>
                
               <!-- <div id="widget_tab">
                  <ul>
                    <li><a href="#tab1" class="active_tab">Marketing</a></li>
                    <li><a href="#tab2" >Business</a></li>
                  </ul>
                </div>-->
              </div>
              <div class="widget_content">
                <div id="tab1">
                  <div class="form_grid_12" style="width:80%; margin:2%;">
                    <form method="post" action="">
                      <div class="form_input">
                        <div class=" form_grid_2 alpha"> <span class=" label_intro">Choose Banner Size</span>
                          <select name="banner" id=""  class="chzn-select"   oninvalid="setCustomValidity(' Please Select Banner Size. ')"  onchange="try{setCustomValidity('')}catch(e){}">
						  	<option value="">Select Banner Size</option>
                            <?php while($banner=mysql_fetch_array($sql_show_banner)){ ?>
                            <option value="<?=$banner[id] ?>" <?=($banner[id]==$_POST[banner]) ? 'selected="selected"' : '' ?>>
                            	<?=$banner[size] ?>
                            </option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class=" form_grid_2">
                          <input name="submit" type="submit" value="Show Result" class="btn_small btn_gray"/>
                        </div>
                        <span class="clear"></span> </div>
                    </form>
                  </div>
                  <div class="widget_content">
                  
                    <table class="display data_tbl">
                      <thead>
                        <tr>
                          <th> Srl No.</th>
                         <!-- <th> Language</th>-->
                          <th> Title</th>
                          <th>Banner Size</th>
                          <th>Category Name</th>
                          <th>View Banner</th>
                          <th>Code</th>
                          <th> Date</th>
                          <th>Share with Facebook</th>
                          <!--<th>Request For Business Card</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
						     $s="select * from materials mat INNER JOIN language lan ON lan.l_id=mat.l_id   ";
							 if(isset($_POST[submit]) && $_POST[banner]!=''){
							 	$s.=" AND mat.banner='{$_POST[banner]}' ";
							 }
							 $s.=" order by m_date desc ";
							// echo $s;
							$q_r=mysql_query($s) or die(mysql_error());
							$pin_receive_total=mysql_num_rows($q_r);
						 	$srl1=1;
							
			while($row=mysql_fetch_array($q_r))
			{  
				 $cat=mysql_query("select * from category1 where c_id='$row[c_id]'") or die(mysql_error());
				 $ff=mysql_fetch_array($cat);
				 $size=mysql_query("select * from banner_size where id='$row[banner]'") or die(mysql_error());
				 $ff_size=mysql_fetch_array($size);
				 $m=$row['material'];
				 $url_landing=$host_name."$idd";
				 $image_show=$host_name."$m";
				 $url="<a href='".$host_name.$idd."' target=_blank ><img src='".$host_name."materials/$m'></a>";
				 
				 
			 ?>
                <tr>
                  <td align="center" class="ptext"><?=$srl1?></td>
                  <!--<td align="center" class="ptext"><?php echo ucfirst($row['language_name']);?></td>-->
                  <td align="center" class="ptext"><?=ucfirst($row['material_title'])?></td>
                  <td align="center" class="ptext"><?= $ff_size['size'];?></td>
                  <td align="center" class="ptext"><?= ucfirst($ff['category_name']); ?></td>
                  <td align="center" class="ptext"><ul class="portfolio group">
                  <li class="item" data-id="id-1" data-type="hannah"> <a href="../materials/<?= $row['material']; ?>" rel="gallery"><img src="../materials/<?php echo $row['material'];?>" alt="" width="50px" height="50px" /></a> </li>
                    </ul></td>
                  <td align="center" class="ptext"><textarea name="textarea" cols="25" rows="5" class="textareatools3" style="width:150px;" ><?php echo $url;?></textarea></td>
                  <td align="center" class="ptext"><?=date('m-d-Y',strtotime($row['m_date'])); ?></td>
                  <td align="center" class="ptext"><p style="cursor:pointer"><a onclick='postToFeed("feed","<?=$url_landing?>","<?=$image_show?>","Facebook Dialogs","<?=$row[material_title]?>","Reffral link"); return false;'><img src="../images/Facebook-Icon.png" width="50px" height="50px" alt="" /></a></p>
                  <p>
                 <a href="https://twitter.com/intent/tweet?button_hashtag=<?php echo $image_show;?>" class="twitter-hashtag-button" data-size="large" data-related="mynetworkvision">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> 
                  </p>
                  </td>
                  <!--<td align="center" class="ptext">
                  <?php
                  if($count_request)
				  {
				  	//echo "Requested";
				  }
				  else
				  {
				  ?>
                  <a href="marketing_request.php?id=<?php echo $row['m_id'];?>">Request Business Card</a>
                  <?php
                  }
				  ?>
                  </td>-->
                </tr>
            <?
			$srl1++;
			}
			?>
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                  </div>
                </div>
                
              </div>
          
        </div>
        <div class="dynemicTD"> </div>
      </div>
      <span class="clear"></span></div>
    <span class="clear"></span> </div>
</div>
</body>
</html>
