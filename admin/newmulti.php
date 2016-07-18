<?php
include("header.php");
include("pagination.php");
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
    <style>
a.tip2 {
  position: relative;
  text-decoration: none;
}
a.tip2 span {display: none;}
a.tip2:hover span {
  display: block;
  position: absolute; 
  padding: .5em;
  content: attr(title);
  text-align: center;
  width: 250px;
  height: auto;
  border:5px solid #999;

  top: -170px;
  background: rgba(0,0,0,.8);
  -moz-border-radius:10px;
  -webkit-border-radius:10px;
  border-radius:10px;    
  color: #fff;
  font-size: .86em;
  z-index:9999;
}
a.tip2:hover span:after {
  position: absolute;
  display: block;
  content: "";  
  border-color: rgba(0,0,0,.8) transparent transparent transparent;
  border-style: solid;
  border-width: 10px;
  height:0;
  width:0;
  position:absolute;
  bottom: -16px;
  left:1em;
}
.rw{width:auto; height:22px; margin:0 auto;}
.lf-rw{width:50%; height:22px; float:left;padding:3px; text-align:left;}
.rf-rw{width:50%; height:22px; float:left;padding:3px; text-align:left;}
                        </style>
    <div class="matter">
      <div class="container">
        <div class="row">
          <div class="col-md-12 float">
          <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">Total Direct Member </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <form action="" method="post" class="validate" id='form1'>
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Enter User ID/User Name</label>
                    <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User ID/User name" data-bind="value: name" />
                        </div>
                  	  <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                  </form>
                  </div>
                </div>
              </div>
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Generation Tree</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <?php
			  $country_search =  check_country($country_id, $country_name,$admin_type);
              if(isset($_REQUEST['search']))
			  {
				extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and nom_id ='$user_id'";
					$query_string.="&user_id='$user_id'";
					
					// get user detail
					$res_user=mysql_query("select * from registration where user_id='$user_id' or user_name='$user_id' $country_search ");
					$num=mysql_num_rows($res_user);
					$row_user=mysql_fetch_assoc($res_user);
					$user_id=$row_user['user_id'];
				}
			  if($num>0)
			  {
			  ?>
              <div class="widget-content">
               <div class="padd newpadd">
                    <div class="matrix_box" >
                      <div class="parent">
                        <div class="img_box">
                        <a href="#" class="tip2">
                        <img src="images/b.png" >
                        <br>
                        <?php echo $row_user['user_id'];?>
                        <br>
						<?php echo $row_user['user_name'];?>
                        <span>
                        <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_user['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_user['first_name'].' '.$row_user['mid_name'].' '.$row_user['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Mobile</div>
                          <div class="rf-rw"><?php echo $row_user['mobile'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Country</div>
                          <div class="rf-rw"><?php echo $row_user['country'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">E-mail</div>
                          <div class="rf-rw"><?php echo $row_user['email'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Sponsor Id</div>
                          <div class="rf-rw"><?php echo $row_user['ref_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">D.O.J</div>
                          <div class="rf-rw"><?php echo $row_user['reg_date'];?></div>
                        </div>
                        </span></a>
                        </div>
                      </div>
                      <div class="parent">
                        <div class="rule"></div>
                      </div>
                      <!--<div class="parent">
                        <div class="hori-rule"></div>
                      </div>-->
                      
                      <div class="parent overflow" style="height:auto;">
                      
                      <?php
                      $res_ref=$obj_query->query("*","registration","ref_id='$user_id'");
					  while($row_ref=$obj_query->get_all_row($res_ref))
					  {
					  ?>
                      	<div class="big_box">
                        	<div class="hori-rule" style="width:100%;"></div>
                        	<div class="top-big"></div>
                            <div class="bt-big">
                            <a href="#" class="tip2">
                        <img src="images/bb.png" >
                        <br>
                        <?php echo $row_ref['user_id'];?>
                        <br>
                        <?php echo $row_ref['user_name'];?>
                         <span>
                        <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_ref['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_ref['first_name'].' '.$row_ref['mid_name'].' '.$row_ref['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Mobile</div>
                          <div class="rf-rw"><?php echo $row_ref['mobile'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Country</div>
                          <div class="rf-rw"><?php echo $row_ref['country'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">E-mail</div>
                          <div class="rf-rw"><?php echo $row_ref['email'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Sponsor Id</div>
                          <div class="rf-rw"><?php echo $row_ref['ref_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">D.O.J</div>
                          <div class="rf-rw"><?php echo $row_ref['reg_date'];?></div>
                        </div>
                        </span></a>
                            </div>
                       
                        </div> 
                        
                      <?php
                      }
					  ?>
                       
                         <!--<div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>
                         <div class="big_box">
                        	<div class="top-big"></div>
                            <div class="bt-big"><img src="images/g.png"></div>
                         </div>-->
                    </div>
                  </div>
              	</div>
              </div>
              <?php
			  
              }
			   else
			  {
				 ?> 
                 <span style="color:red; font-size:18px;">
				 <?php  echo "User not exist";?>
                  </span>
                  <?php
			  }
			  }
			 
			  ?>
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
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        <!-- Copyright info -->
        <p class="copy">Copyright &copy; 2013 | <a href="#">BMC</a> </p>
      </div>
    </div>
  </div>
</footer>

<!-- Footer ends --> 

<!-- Scroll to top --> 
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

<!-- JS --> 
<script src="js/jquery.js"></script> <!-- jQuery --> 
<script src="js/bootstrap.js"></script> <!-- Bootstrap --> 
<script src="js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI --> 
<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar --> 
<script src="js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating --> 
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto --> 

<!-- Morris JS --> 
<script src="js/raphael-min.js"></script> 
<script src="js/morris.min.js"></script> 

<!-- jQuery Flot --> 
<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.flot.js"></script> 
<script src="js/jquery.flot.resize.js"></script> 
<script src="js/jquery.flot.pie.js"></script> 
<script src="js/jquery.flot.stack.js"></script> 

<!-- jQuery Notification - Noty --> 
<script src="js/jquery.noty.js"></script> <!-- jQuery Notify --> 
<script src="js/themes/default.js"></script> <!-- jQuery Notify --> 
<script src="js/layouts/bottom.js"></script> <!-- jQuery Notify --> 
<script src="js/layouts/topRight.js"></script> <!-- jQuery Notify --> 
<script src="js/layouts/top.js"></script> <!-- jQuery Notify --> 
<!-- jQuery Notification ends --> 

<!-- Daterangepicker --> 
<script src="js/moment.min.js"></script> 
<script src="js/daterangepicker.js"></script> 
<script src="js/sparklines.js"></script> <!-- Sparklines --> 
<!--<script src="js/jquery.gritter.min.js"></script> <!-- jQuery Gritter --> 
<script src="js/jquery.cleditor.min.js"></script> <!-- CLEditor --> 
<script src="js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker --> 
<script src="js/jquery.uniform.min.js"></script> <!-- jQuery Uniform --> 
<script src="js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll --> 
<script src="js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle --> 
<script src="js/jquery.maskedinput.min.js"></script> <!-- jQuery Masked Input --> 
<script src="js/dropzone.js"></script> <!-- jQuery Dropzone --> 
<script src="js/filter.js"></script> <!-- Filter for support page --> 
<script src="js/custom.js"></script> <!-- Custom codes --> 
<script src="js/charts.js"></script> <!-- Charts & Graphs --> 

<script src="js/index.js"></script> <!-- Index Javascripts -->
</body>
</html>