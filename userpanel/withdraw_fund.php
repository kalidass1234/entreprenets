<?php

include('../includes/all_func.php');

error_reporting(E_ALL ^ E_NOTICE);

include('header.php');

$pid=$_GET['pid'];

if(isset($_SESSION) && $_SESSION['SD_User_Name'])

{

	$add_by=$_SESSION['SD_User_Name'];

$res_reg=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_name='$add_by'"));

 $user_ids=$res_reg['user_id'];
 
 
$res_reg1=mysql_fetch_array(mysql_query("SELECT * FROM final_e_wallet WHERE user_id='$user_ids'"));
$rand=rand(0,1000000);
 $amount=$res_reg1['amount'];
 
 if(isset($_POST['Show'])){
 $sub1=$_POST['subject1'];
  $sub2=$_POST['subject2'];
   $sub3=$_POST['subject3'];
    $sub4=$_POST['subject4'];
	 $sub5=$_POST['subject5'];
	  $sub6=$_POST['subject6'];
	   $sub7=$_POST['subject7'];
	    $sub8=$_POST['subject8'];
		 $sub9=$_POST['subject9'];
		 $send_id=$_POST['id'];
$date=date("Y-m-d");
if($amount>=$sub8)
{
	
	 $selecting=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='$user_ids'"));
	 $request_amount1=$selecting['amount']; print_r("<br/>");
	 $request_amounts1=$request_amount1-$sub8; print_r("<br/>");
	  mysql_query("update final_e_wallet set amount='$request_amounts1' where user_id='$user_ids'");
	  
	  mysql_query("INSERT INTO `credit_debit` (`id`, `transaction_no`, `user_id`, `credit_amt`, `debit_amt`, `admin_charge`, `receiver_id`, `sender_id`, `receive_date`, `ttype`, `TranDescription`, `Cause`, `Remark`, `invoice_no`, `gift_code`, `product_name`, `final_bal`, `status`, `paid_status`, `ewallet_used_by`) VALUES (NULL, '$rand', '$user_ids', '0', '$sub8', '0', '123456', '$user_ids', '$date', 'Withdrawal Request', 'Withdrawal Request From Admin', '0', 'Withdrawal Request ', '$rand', '0', 'Withdrawal Request', '$sub8', '0', '0', '$user_ids')");
	  
	  
   mysql_query("insert into withdraw_request values (NULL,'$rand','$send_id','$sub1','$sub2','$sub3','$sub4','$sub5','$sub6','$sub7','$sub8','$sub9','0','$date','','')");
	$msg="Request Sent Successfully";
}
else
{
	$msg="Sorry ! Insufficient Balance In Your Ewallet";
}

	}

}

else

{

	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;

}



?>

<style>



.form_container ul {



    background:none;!important



    border-top:none;!important



	border-bottom:none;!important



    padding: 15px 15px 15px 10px;



    position: relative;



}



.form_container ul li {



    background:none;!important



    border-top:none;!important



	border-bottom:none;!important



    padding: 15px 15px 15px 10px;



    position: relative;



}



.input_txt{



	width:290px!important;



	height:30px!important;}



	



.input_grow{width:490px!important;



	height:160px!important;}



.form_container ul li label.field_title{



	font-size:16px;



	font-weight:normal;



	margin-left:20px;



	text-transform:capitalize;}



.btn-blu{



	border:none;



	line-height:30px;



	padding:0 20px;



	color:#fff;



	margin-left:170px;



	text-shadow:none;



	font-weight:bold;



	background: #62bded; /* Old browsers */



background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */



background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */



background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */



background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */



background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */



background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */



filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */



}



.btn-blu1{



	border:none;



	border-radius:5px;



	line-height:30px;



	padding:0 20px;



	color:#fff;



	text-shadow:none;



	font-weight:bold;



	background: #62bded; /* Old browsers */



background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */



background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */



background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */



background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */



background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */



background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */



filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */



}







.btn_30_blue a{



border-radius:10px;



box-shadow:none;



border:none;



background: #62bded; /* Old browsers */

background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */

background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */

background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */

background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */

background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */

background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */

}



.btn_30_blue a:hover

{

border:none;

background: #62bded; /* Old browsers */



background: -moz-linear-gradient(top,  #62bded 0%, #0b98df 99%); /* FF3.6+ */



background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#62bded), color-stop(99%,#0b98df)); /* Chrome,Safari4+ */



background: -webkit-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Chrome10+,Safari5.1+ */



background: -o-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* Opera 11.10+ */



background: -ms-linear-gradient(top,  #62bded 0%,#0b98df 99%); /* IE10+ */



background: linear-gradient(to bottom,  #62bded 0%,#0b98df 99%); /* W3C */



filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#62bded', endColorstr='#0b98df',GradientType=0 ); /* IE6-9 */}



.chzn-container-multi .chzn-choices .search-field input{ background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;



    border: 0 none !important;



    box-shadow: none;



    color: #666666;



    font-family: sans-serif;



    font-size: 100%;



    height: 25px;



    margin: 1px 0;



    outline: 0 none;



    padding: 5px;}

	

	

	.sms_quick{margin-right:40px;

}



.sms_quick img{

	}



.sms_quick img:hover{ 

width:94px;

height:94px;

}



</style>

<body id="theme-default" class="full_block">

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

		<span class="title_icon"><span style="float:left;"><img src="backend-images/mail.png" height="20" width="20" alt="" border="0" /></span></span>

		<h3>Email To Users</h3>

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

	<div id="content">

		<div class="grid_container">

			<div class="grid_12 full_block">

				<div class="widget_wrap">

					<div class="widget_top">

						<h6>Withdraw Request Form </h6>

						<!--<div id="widget_tab">

							<ul>

								<li><a href="#tab1" class="active_tab">Email</a></li>

								<li><a href="email_search.php">Bulk Email</a></li>

								

							</ul>

						</div>-->

 					</div>

<style type="text/css">
    .box{
        padding: 20px;
		height:500px;
        display: none;
        margin-top: 20px;
        border: 1px solid #000;
    }
    .red{ background: #ff0000; }
    .green{ background: #00ff00; }
    .blue{ background: #0000ff; }
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="red"){
                $(".box").hide();
                $(".red").show();
            }
            if($(this).attr("value")=="green"){
                $(".box").hide();
                $(".green").show();
            }
          
        });
    });
</script>

    

                            		
					<div class="widget_content" >

						<div class="oilhold">
                        
                        
      

   							<form action="" method="post" class="form_container left_label" name="withdraw">

							<ul >

                            <?php

                            if($msg!='')

							{

							?>

							<li >

								<div class="form_grid_12">

									<label class="field_title" >&nbsp;</label>

									<div class="form_input" >

									<font color="#003300"><?php echo $msg;?></font>

                                    </div>

								</div>

								</li>

                            <?php

                            }

							?>    
                            
                            <?php $bank_detail=mysql_fetch_array(mysql_query("select * from registration where user_name='$add_by'"));
	
	?>
                            
                            <li >

								<div class="form_grid_12">

									<label class="field_title" >Choose Account Details</label>

									<div class="form_input" >

									  <label><input type="radio" name="colorRadio" value="red"> Existing</label>
        <label><input type="radio" name="colorRadio" value="green"> New Detail</label>
       
  
    <div class="red box" style="height:400px;width:600px;"><form name="info" method="POST"><input type="hidden" name="id" value="<?php echo $bank_detail['user_id'];?>"> <table><tr><td>First Name</td><td> :</td><td> <input name="subject1" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['first_name'];?>" required/> </td></tr>
                          <tr><td>Last Name </td><td> :</td><td>  <input name="subject2" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['last_name'];?>" required/> </td></tr>
                          <tr><td>Account Name </td><td> :</td><td>  <input name="subject3" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['acc_name'];?>" required/> </td></tr>
                          <tr><td>Account Number </td><td> :</td><td>  <input name="subject4" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['ac_no'];?>" required/></td></tr> 
                         <tr><td> Bank Name </td><td> :</td><td>  <input name="subject5" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['bank_nm'];?>" required/> </td></tr>
                          <tr><td>Bank Branch </td><td> :</td><td>  <input name="subject6" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['branch_nm'];?>" required /> </td></tr>
                          <tr><td>Swift Code </td><td> :</td><td>  <input name="subject7" type="text" tabindex="4"  style="width:94%;padding:5px;" value="<?php echo $bank_detail['swift_code'];?>" required/></td></tr> 
                          
                          <tr><td>Requested Amount </td><td> :</td><td>  <input name="subject8" type="text" tabindex="4"  style="width:94%;padding:5px;" value="" required /></td></tr> 
                          <tr><td>Description </td><td> :</td><td>  <textarea name="subject9" type="text" tabindex="4"  style="width:300px;height:100px;padding:5px;" /></textarea></td></tr> </table><br/><br/>
                          <button type="submit" class="btn-blu" name="Show"><span>SEND</span></button></form>
    </div>
                                    
           
           
            
   <div class="green box" style="height:400px;width:600px;"><form name="info1" method="POST"> <input type="hidden" name="id" value="<?php echo $bank_detail['user_id'];?>"><table><tr><td>First Name</td><td> :</td><td> <input name="subject1" value="" type="text" tabindex="4"  required style="width:94%;padding:5px;" /> </td></tr>
                          <tr><td>Last Name </td><td> :</td><td>  <input name="subject2" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/> </td></tr>
                          <tr><td>Account Name </td><td> :</td><td>  <input name="subject3" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/> </td></tr>
                          <tr><td>Account Number </td><td> :</td><td>  <input name="subject4" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/></td></tr> 
                         <tr><td> Bank Name </td><td> :</td><td>  <input name="subject5" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/> </td></tr>
                          <tr><td>Bank Branch </td><td> :</td><td>  <input name="subject6" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/> </td></tr>
                          <tr><td>Swift Code </td><td> :</td><td>  <input name="subject7" type="text" tabindex="4" value="" style="width:94%;padding:5px;"  required/></td></tr> <tr><td>Requested Amount </td><td> :</td><td>  <input name="subject8" type="text" tabindex="4"  style="width:94%;padding:5px;" value=""/></td></tr> 
                          <tr><td>Description </td><td> :</td><td>  <textarea name="subject9" type="text" tabindex="4"  style="width:300px;height:100px;padding:5px;" /></textarea></td></tr> </table><br/><br/>
                          	<button type="submit" class="btn-blu" name="Show"><span>SEND</span></button></form>
    </div>

										</div>

									</div>


								</li>
                          
								
							
							</ul>

						</form>

					  <!--<img src="images/support-ticket.jpg" border="0" />

					<br />

					 <div align="center" style="padding-top:20px;">

					  <input name="raise_ticket" class="btn" type="button"  value="Raise Ticket" onClick="window.location.href='raise-ticket.php'"/>

					  </div>-->

					</div>

					</div>

				</div>

			</div>

		</div>

		<span class="clear"></span>

	</div>

</div>

</body>

</html>