<?php

include('header.php');
include("pagination.php");

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
      <h2 class="pull-left">Member Volume Report</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb "> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Member Volume Report</a> </div>
      <div class="clearfix"></div>
      <div class="error_page">
       <div class="error">
       	<h1 class="green"><?php echo $_GET['msg'];?></h1>
       </div>
      </div>
    </div>
    
    <!-- Page heading ends --> 
    <!-- Matter -->
    <div class="matter">
      <div class="container"> 
        <!-- Today status. jQuery Sparkline plugin used. -->
        <div class="row">
          <div class="col-md-12">
        
            <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Filters</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  <form action="" class="validate" method="post" id='form1'>
                  <input type="hidden" name="action" value="add_fund">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> User Id/User Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="user_name" value="<?php echo $_POST['user_name'];?>" id="user_name" placeholder="User Id/ User name" data-bind="value: name" />
                        </div>
                        
                        
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
           
      
      <div class="clearfix"></div>
        <div class="widget">
          <div class="widget-head">
            <div class="pull-left">Member Volume Report</div>
            <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="widget-content">
           <div id="tab2" >
         <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
            <th><strong>S. No.</strong></th>
            <th><strong>Member Id</strong></th>
            <th><strong>Member Name</strong></th>
            <th><strong>Personal Volume</strong></th>
            <th><strong>Refferal Volume</strong></th>
            <th><strong>Left Volume</strong></th>
            <th><strong>Right Volume</strong></th>
            <th><strong>Team Sale Volume</strong></th>
           
           </tr>
           </thead>
            <tbody>
             <?php  
			 $country_search =  check_country($country_id, $country_name,$admin_type);
			 if(isset($_REQUEST['search']))
			{
				
				extract($_REQUEST);
				if(isset($_REQUEST['user_name']) && $_REQUEST['user_name']!='')
				{
				
				
					// get user id
					$res_user=$obj_query->query("*","registration"," user_name='$user_name' or user_id='$user_name' ");
					$row_user=$obj_query->get_all_row($res_user);
					$user_id=$row_user['user_id'];
					$search_string.="where (user_name='$user_name' or user_id='$user_name')";
					$query_string.="&user_name='$user_name'";
				}
				else
				{
					
					$search_string="where 1=1";
				}
			}
			else
			{
			$search_string="where 1=1"; 
			}
			 
			//echo "select user_id,user_name from registration $search_string $country_search";
         $res_user1=mysql_query("select user_id,user_name from registration $search_string $country_search") or die(mysql_error());   
		 $num=mysql_num_rows($res_user1);
		 if($num>0)
		 {
			 $i=1;
			 while($r=mysql_fetch_assoc($res_user1))
			 {
				 $userid=$r['user_id'];
          ?>  
         
             <tr> 
            <td class="ptext"><?php echo $i; ?></td>
          <td class="ptext"><?php echo $r['user_id']; ?></td>
          <td class="ptext"><?php echo $r['user_name']; ?></td>
           <td class="ptext"><?php  echo _get_personal_volume($userid)." PV";?></td>
          <td class="ptext"><?php echo _get_referral_volume($userid)." PV";?></td>
           <td class="ptext"><?php  echo _get_left_team_sale_volume($userid,'left');?></td>
           <td class="ptext"><?php  echo _get_right_team_sale_volume($userid,'right');?></td>
           <td class="ptext"><?php echo _get_team_sale_volume($userid);?></td>
           
          </tr>
            <?php
			$i++;
		 }
		 }
		 ?>
         </tbody>
            </table>
            </div>
            <div class="widget-foot">
            <?php //echo pagination($url,$parameters,$pages,$current_page);?>
              <!--<ul class="pagination pull-right">
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>-->
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Today status ends --> 
      <!-- Dashboard Graph starts --> 
      <!-- Dashboard graph ends --> 
      <!-- Chats, File upload and Recent Comments --> 
    </div>
  </div>
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('footer.php'); ?>
<script language="javascript">

function ValidateData(form)

{



var chks = document.getElementsByName('id[]');

var hasChecked = false;

for (var i = 0; i < chks.length; i++)

{

if (chks[i].checked)

{

hasChecked = true;

break;

}

}

if (hasChecked == false)

{

alert("Please select at least one Request.");

return false;

}



} 

function Check(chk)

{

var chk = document.getElementsByName('id[]');

if(document.myform.Check_All.value=="Check All"){



for (i = 0; i < chk.length; i++)

chk[i].checked = true ;

document.myform.Check_All.value="UnCheck All";

}else{



for (i = 0; i < chk.length; i++)

chk[i].checked = false ;

document.myform.Check_All.value="Check All";

}

}

</script>