<?php
include("header.php");
?>
<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <?php include("nav.php");?>
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
          <a href="#" class="bread-current">Dashboard</a>
        </div>
        
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
                  <div class="pull-left">Social Media Pages</div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <?php
                  $res=$obj_query->query("*","social_media_page","1=1");
				  $count=$obj_query->num_row($res);
				  while($row=$obj_query->get_all_row($res))
				  {
					  $arr_page[]=$row['page_name'];
					  $arr[$row['page_name']]=$row['link'];
				  }
				  ?>
                    <form action="submit.php" method="post" class="validate" id='form1'>
                      <input type="hidden" name="action" value="ADD_Social_Page">
                      <input type="hidden" name="id" value="<?php echo $count;?>">
                      <fieldset>
                        <div class="form-group">
                            <label for="name"> Facebook Page</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="face" placeholder="Facebook" data-bind="value: name" value="<?php echo $arr['face'];?>" />
                        </div>
						<div class="form-group">
                            <label for="name"> Twitter Page</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="tweet" placeholder="Twitter Account" data-bind="value: name" value="<?php echo $arr['tweet'];?>" />
                        </div>
                        <div class="form-group">
                            <label for="name"> Youtube Link</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="youtube" placeholder="Twitter Account" data-bind="value: name" value="<?php echo $arr['youtube'];?>" />
                        </div>
                        <div class="form-group">
                            <label for="name"> Skype Link</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="skype" placeholder="Twitter Account" data-bind="value: name" value="<?php echo $arr['skype'];?>" />
                        </div>
                        <div class="form-group">
                            <label for="name"> Dribble Link</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="dribble" placeholder="Twitter Account" data-bind="value: name" value="<?php echo $arr['dribble'];?>" />
                        </div>
                        <div class="form-group">
                            <label for="name"> Google Plus</label>
                            <input type="text" class="validate[required] form-control placeholder" id="personName" name="google" placeholder="Twitter Account" data-bind="value: name" value="<?php echo $arr['google'];?>" />
                        </div>  
                        <div class="form-group">
                          <div class="left-box right-side">
                            <button class="btn btn-danger side "  type="submit" id="button" >Save</button>
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
    </div>
    </div>
   <!-- Mainbar ends -->
<!-- Content ends -->

<!-- Footer starts -->
<?php
include("footer.php");
?>