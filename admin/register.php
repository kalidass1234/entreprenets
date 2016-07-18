<?php 
include('header.php');
include("pagination.php");
if(isset($_REQUEST['msg']))
{
	$msg = $_REQUEST['msg'];
}
 ?>
<!-- Main content starts -->
<script src="../dist/country.js"></script>
<script type="text/javascript" src="../js/modernizr.custom.29473.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/mobilyslider.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript"></script>
<script src="../js/validation.js"></script>
<script src="../js/validationOnNumber.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
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
           <div id="reportrange" class="pull-right">
              <i class="fa fa-calendar"></i>
              <span></span> <b class="caret"></b>
           </div>
        </div>
        <div class="clearfix"></div>
        <!-- Breadcrumb -->
        <div class="bread-crumb">
          <a href="index.php"><i class="fa fa-home"></i> Home</a> 
          <!-- Divider -->
          <span class="divider">/</span> 
          <a href="#" class="bread-current">Register New Member</a>
        </div>
        <div class="clearfix"></div>
	    </div>
	    <!-- Page heading ends -->
	    <!-- Matter -->
	    <div class="matter">
        <div class="container">
         <div class="row">
            <div class="col-md-12">
            
              <div class="widget">
             <div class="widget-head">
                <div class="pull-left">Register New Member</div></br>
                <div style="size:14px;color:red;"><?=$msg?></div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
               <div class="padd">
                  <?php
                  $user_id=$_GET['userid'];
				  $res=$obj_query->query("*","registration","user_id='$user_id'");
				  $row=$obj_query->get_all_row($res);
				  ?>
                  <form action="insert_profile.php" method="post" class="validate" id='form1' enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" name="action" value="new_registration" />
                  
                    <fieldset>
                    
                        <div class="form-group">
                        <div class="left-box">
                           <label for="name" >Sponsor:</label>
                           <input type="text" name="ref_id" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['sp_name']; ?>" required/>
                        </div>
                        <div class="left-box">
                           <label for="name" >First Name:</label>
                           <input type="text" name="first_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['first_name']; ?>" required/>
                        </div>
                        <div class="left-box">
                           <label for="name" >Last Name:</label>
                           <input type="text" name="last_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['last_name']; ?>" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Email:</label>
                          <input type="text" name="email" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['email']; ?>" required/>
                        </div>
                        <div class="left-box">
                          <label for="name" >Username:</label>
                           <input type="text" name="user_name" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['user_name']; ?>" required/>
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Password:</label>
                           <input type="password" name="user_pass" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['user_pass']; ?>" required/>
                        </div>
                        <div class="left-box">
                          <label for="name" >Transaction Password:</label>
                           <input type="password" name="t_code" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['t_code']; ?>" required/>
                        </div>
                      </div>

                        <div class="left-box">
                          <label for="name" >Package</label>
                           <select name="package_id" required="required" class="validate[required] form-control placeholder" id="package_id">
                             <option value="" >Package</option>
                             	<?php
                                $i = 1;
                                $sql1=mysql_query("select * from package where status='0' ORDER BY total_price ASC");
                                while($res=mysql_fetch_array($sql1))
                                {
                                    $tax = $res['tax'];
                                    $total_price = $res['total_price'];
                                    ?>
                             <option value="<?=$res['package_id']?>"<?php if($total_price == 1000){?> checked="checked"   <?php } ?>><?=$res['package_name']."-".$res['total_price']?></option>
                                  <?php
                                  $i++;
                                  }
                                  ?>
                            </select>
                        </div>
                    
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Country Name:</label>
                           <input type="text" name="country" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['bank_nm']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >State Name:</label>
                           <input type="text" name="state" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['branch_nm']; ?>" />
                        </div>
                      </div>
                      
                    
                       <div class="form-group">
                        <div class="left-box">
                          <label for="name" >Street1:</label>
                           <input type="text" name="street1" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['street1']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Street2:</label>
                           <input type="text" name="street2" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['street2']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Mobile:</label>
                           <input type="text" name="phoner" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['phoner']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Other Phone:</label>
                           <input type="text" name="mobile" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['mobile']; ?>" />
                        </div>
                        <div class="left-box">
                          <label for="name" >Zip:</label>
                           <input type="text" name="zip" class="validate[required,custom[email]] form-control placeholder" value="<?php echo $row['zip']; ?>" />
                        </div>

                      </div>

                       <div class="form-group">

                      </div>


                      </div>
                       <div class="form-group">
                         <div class="left-box"><br>
                            <br>
                          </div>
                       </div>  
                      <div class="form-group">
                        <div class="left-box">
                        <br>
                          <button class="btn btn-danger side"  name="submit" type="submit" id="button" >Submit</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
            
            
            </div>
          </div>
        </div>
		<!-- Matter ends -->
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