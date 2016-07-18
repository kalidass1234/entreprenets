<?php define('ABSPATH','../../lib/'); include('header.php');  include('pagination.php');

?>
<!-- Main content starts -->
<style>
a.tip2 {
	position: relative;
	text-decoration: none;
}
a.tip2 span {
	display: none;
}
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
	background: rgba(0, 0, 0, .8);
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
	border-color: rgba(0, 0, 0, .8) transparent transparent transparent;
	border-style: solid;
	border-width: 10px;
	height:0;
	width:0;
	position:absolute;
	bottom: -16px;
	left:1em;
}
.rw {
	width:auto;
	height:22px;
	margin:0 auto;
}
.lf-rw {
	width:50%;
	height:22px;
	float:left;
	padding:3px;
	text-align:left;
}
.rf-rw {
	width:50%;
	height:22px;
	float:left;
	padding:3px;
	text-align:left;
}
</style>

<div class="content"> 
  <!-- Sidebar -->
  <?php include('../nav.php'); ?>
  <!-- Sidebar ends --> 
  <!-- Main bar -->
  <div class="mainbar"> 
    
    <!-- Page heading -->
    <div class="page-head">
      <h2 class="pull-left">Network</h2>
      <div class="clearfix"></div>
      <!-- Breadcrumb -->
      <div class="bread-crumb"> <a href="index.html"><i class="fa fa-home"></i> Home</a> 
        <!-- Divider --> 
        <span class="divider">/</span> <a href="#" class="bread-current">Network</a> </div>
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
                  <div class="pull-left">Total Direct Member </div>
                  <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                  <form action="" method="get" class="validate" id='form1'>
                  
                      <fieldset>
                        <div class="form-group">
                          <div class="left-box">
                            <label for="name">Enter User ID/User Name</label>
                    <input type="text" class="validate[required] form-control placeholder" id="user_id" name="user_id" placeholder="User ID/User name" data-bind="value: name" />
                        </div>
                  	  <button style="float:left; clear:both; margin:7px;" class="btn btn-danger side" name="search"  type="submit" id="button" >Submit</button>
                      </fieldset>
                  </form>
                 
                  
                  <?php  if(isset($_GET['user_id']) && !isset($_GET['search'])) : ?>
			  
                    <a href="javascript:window.history.back()" style="cursor:pointer;"><button style="float:right; clear:both; margin:7px; " class="btn btn-danger side" name="search"  type="button" id="button" >Back</button></a>
                  
                  <?php endif; ?>  
                  
                   </div>
                   
                   <div class="clearfix"></div>
                    
                </div>
              </div>
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Tree</div>
                <div class="widget-icons pull-right"> <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> <a href="#" class="wsettings"><i class="fa fa-wrench"></i></a> <a href="#" class="wclose"><i class="fa fa-times"></i></a> </div>
                <div class="clearfix"></div>
              </div>
              <?php
              if(isset($_REQUEST['user_id']))
			  {
				
				$query_string = '';
				  
				extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$query_string.=" where (user_id='$user_id' or username='$user_id')";
					// get user detail
					$row_user=$mxDb->get_information('user_registration', '*', $query_string, true, 'assoc');
				}
				
				$user_id = $row_user['user_id'];
			  
			  ?>
              <div class="widget-content">
            
               <div class="padd newpadd">
                
                    <div class="matrix_box" >
                   
                      <div class="parent">
                        <div class="img_box">
                        <a href="#" class="tip2">
                        <img src="<?php echo SITE_URL; ?>admin/images/b.png" >
                        <br>
                        <?php echo $row_user['user_id'];?>
                        <br>
						<?php echo $row_user['username'];?>
                        <span>
                        <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_user['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_user['first_name'].' '.$row_user['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Contact</div>
                          <div class="rf-rw"><?php echo $row_user['telephone'];?></div>
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
                          <div class="rf-rw"><?php echo $row_user['registration_date'];?></div>
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
					  // show tree view
					  
                      $query_string = " where ref_id='$user_id'";
					  $res_ref = $mxDb->get_information('user_registration', '*', $query_string, false, 'assoc');
					  
					  if($res_ref) :
					  
					  	foreach($res_ref as $row_ref):
					  
					  ?>
                      	<div class="big_box">
                        	<div class="hori-rule" style="width:100%;"></div>
                        	<div class="top-big"></div>
                            <div class="bt-big">
                            <a href="<?php echo SITE_URL; ?>admin/network/tree.php?user_id=<?php echo $row_ref['user_id']; ?>" class="tip2">
                        <img src="<?php echo SITE_URL; ?>admin/images/b.png" >
                        <br>
                        <?php echo $row_ref['user_id'];?>
                        <br>
                        <?php echo $row_ref['username'];?>
                         <span>
                        <div class="rw">
                          <div class="lf-rw">User Id</div>
                          <div class="rf-rw"><?php echo $row_ref['user_id'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Full Name</div>
                          <div class="rf-rw"><?php echo $row_ref['first_name'].'  '.$row_ref['last_name'];?></div>
                        </div>
                        <div class="rw">
                          <div class="lf-rw">Mobile</div>
                          <div class="rf-rw"><?php echo $row_ref['telephone'];?></div>
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
                          <div class="rf-rw"><?php echo $row_ref['registration_date'];?></div>
                        </div>
                        </span></a>
                            </div>
                       
                        </div> 
                        
                      <?php
                     		endforeach;
						endif;
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
			  ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Matter ends --> 
 </div>
 
  <!-- Matter ends --> 
</div>
<!-- Mainbar ends --> 
<!-- Mainbar ends -->
<div class="clearfix"></div>
</div>
<!-- Content ends -->
<?php include('../footer.php'); ?>
