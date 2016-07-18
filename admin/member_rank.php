<?php 
include('header.php');
include("pagination.php");


				
            if(isset($_POST['submit']) && $_POST['action']=='Change_Rank')
			{
				
				   $country_search=  check_country($country_id, $country_name,$admin_type);
				
				
				 $username=$_POST['username'];
				 $rank=$_POST['rank'];
				//exit();
				
				$rqry=mysql_query("select reg_date,user_name from registration where (user_name='$username' or user_id='$username') $country_search") or die(mysql_error());
				$rnum=mysql_num_rows($rqry);
				if($rnum>0)
				{
				$rrow=mysql_fetch_assoc($rqry);
				$username=$rrow['user_name'];
				$date=$rrow['reg_date'];
				$date1=date("Y-m-d");
				$dataDiff = floor((strtotime($date1)-strtotime($date))/(3600*24));
				
				
				
				$qry=mysql_query("select * from user_rank_achieve where username='$username'") or die(mysql_error());
				$num=mysql_num_rows($qry);
				if($num>0)
				{
					$updQry=mysql_query("update user_rank_achieve set rank_id='$rank',rank_achieve_by='admin', rank_achieve_day='$dataDiff' where username='$username'") or die(mysql_query());
					if($updQry)
					{
						$msg="Successfully updated user rank";
					}
				}
				else
				{
					$insQry=mysql_query("insert into user_rank_achieve set rank_id='$rank',rank_achieve_by='admin', rank_achieve_day='$dataDiff', username='$username'") or die(mysql_error());
					if($insQry)
					{
						$msg="Successfully updated user rank";
					}
				}
				$insQry1=mysql_query("insert into user_rank_achieve_history set rank_id='$rank',rank_achieve_by='admin', rank_achieve_day='$dataDiff', username='$username'") or die(mysql_error());
				}
				else
				{
					$msg="You can not upgrade rank of this user";
				}
					
			}
?>
<!-- Main content starts -->

<div class="content">
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends -->
  <!-- Main bar -->
  <div class="mainbar">
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Dashboard</h2>
      <div class="pull-right">
        <div id="reportrange" class="pull-right"> <i class="fa fa-calendar"></i> <span></span> <b class="caret"></b> </div>
      </div>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <!-- Divider -->
        <span class="divider">/</span> <a href="#" class="bread-current">Dashboard</a> </div>
      <div class="clearfix"></div>
    </div>
    <!-- Page heading ends -->
    <!-- Matter -->
    <div class="matter">
      <div class="container">
        <div class="row">
          <div class="col-md-12 float">
          
           
            	<div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Change Rank Of User<?php //echo $user_id;?> </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd" >
                 <span style="color:#F00;"> <?php
				  echo $msg; 
				  ?></span>
                  <form action="" method="post" class="validate" id='form1'>
                  
                  <input type="hidden" name="action" value="Change_Rank" />
                 <table width="100%" border="0" class="table table-striped table-bordered table-hover">
  <tr>
    <td>Username/User Id</td>
    <td><input type="text" class="validate[required] form-control placeholder" id="ref_id" name="username" placeholder="User Name" data-bind="value: name" value="" onBlur="findUser(this.value);"  /></td>
  </tr>
  <tr><td colspan="2" ><table class="table table-striped table-bordered table-hover" id="txtHint">
  <tr >
    <td width="35%">Name</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td>Star</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Join BV</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </td>
  </tr>
 
  <tr>
    <td>New Star</td>
    <td><select name="rank" class="validate[required] form-control placeholder">
                            <?php
							$rankQry=mysql_query("select * from user_rank ") or die(mysql_error());
							//numRank=mysql_num_rows($rankQry)
							while($rowRank=mysql_fetch_assoc($rankQry))
							{
								?>
                            <option value="<?php echo $rowRank['id']; ?>"><?php echo $rowRank['rank_name']; ?></option>
                            <?php
							}
							?>
                            </select></td>
  </tr>
  
   <tr>
    <td colspan="2"> <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="submit"  type="submit" id="button" >Submit</button></td>
    
  </tr>
</table>

                     
                  </form>
                  </div>
                </div>
              </div>
          
          </div>
        </div>
        <!-- Matter ends -->
      </div>
    </div>
  </div>
</div>
<script>
function findUser(str)
{
	//alert(str);
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	//window.location.reload();
    }
  }
xmlhttp.open("GET","user.php?q="+str,true);
xmlhttp.send();
}
</script>

<!-- Mainbar ends -->
<!-- Content ends -->
<!-- Footer starts -->
<?php
include("footer.php");
?>