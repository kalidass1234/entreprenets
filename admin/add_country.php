<?php include('header.php'); ?>
<!-- Main content starts -->

<div class="content"> 
  <!-- Sidebar -->
  <?php include('nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Country</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.php"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Country</a> </div>
      <div class="clearfix"></div>
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
                <div class="pull-left">Add Country</div>
                <!--<div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>-->
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
            	  <div class="padd">
                  
                  <?php
				  
				  	$action = 'AddCountry';
					$update = false;
					
				  	if(isset($_GET['country_id'])){
						$country_id = $_GET['country_id'];
						$icon = $_GET['icon'];
						$action = 'UpdateCountry';
						$update = true;
						$field ="country_name, tds, miscellaneous";
					$q=mysql_query("select * from country where id='$country_id'");
					$row=mysql_fetch_assoc($q);
					$country_name=$row['country_name'];
					$tds=$row['tds'];
					$miscellaneous=$row['miscellaneous'];
					}
				  ?>
                  
                  <form action="submit.php" class="validate" method="post" id='form1' enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group">
                        <div class="left-box">
                          <label for="name"> Country Name</label>
                          <input type="text" class="validate[required] form-control placeholder" name="country_name" id="country_name" placeholder="Country name" data-bind="value: name" value="<?php if(isset($country_name)): echo $country_name; endif; ?>" />
                          <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                          <input type="hidden" name="rand" value="<?php echo $_SESSION['rand'];?>"/>
                          <input type="hidden" name="id" value="<?php echo $country_id; ?>"/>
                        </div>
                        <div class="left-box">
                          <label for="name" >TDS(%)</label>
                          	<input type="text" class="validate[required] form-control placeholder" name="tds" id="tds" placeholder="TDS" data-bind="value: tds" value="<?php if(isset($tds)): echo $tds; endif; ?>" />
                            
                        </div>
                         <div class="left-box">
                          <label for="name" >Miscellaneous(%)</label>
                          	<input type="text" class="validate[required] form-control placeholder" name="miscellaneous" id="miscellaneous" placeholder="Miscellaneous" data-bind="value: miscellaneous" value="<?php if(isset($miscellaneous)): echo $miscellaneous; endif; ?>" />
                            
                        </div>
                      </div>
                       <div class="clearfix"></div>
                      <div class="form-group">
                        <div class="left-box">
                          <button class="btn btn-danger side"  type="submit" id="button" >Submit</button>
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
