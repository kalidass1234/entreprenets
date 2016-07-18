<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

			   	/*-------------------------------------------
				* var len store no of images in session
				* var I denote postion of image
				*-------------------------------------------*/

			   		$len=-1;
			   		if(isset($_SESSION['imgname']))
					{
						$len=count($_SESSION['imgname']);
						$len--;
						$i=0;
					}
					//echo $len;
			   ?>

 <div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						
						<h6 id="h0" <?php if($len>=0){?> style="display:block" <?php } else {?> style="display:none;" <?php }?> >Image 1 <a href="#" onClick="removeimage('0')">Remove Image</a></h6>
						<h6 id="fh0" <?php if($len>=0){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 1</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=0){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide0">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img0" class="img-val"></div>
						
					</div>
				</div>
			</div>
            
            
            
            <div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						
						<h6 id="h1"  <?php if($len>=1){?> style="display:block" <?php } else {?> style="display:none;" <?php }?> >Image 2 <a href="#" onClick="removeimage('1')">Remove Image</a></h6>
						<h6 id="fh1" <?php if($len>=1){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 2</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=1){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide1">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img1"></div>
					</div>
				</div>
			</div>
            
            <div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h2" <?php if($len>=2){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 3 <a href="#" onClick="removeimage('2')">Remove Image</a></h6>
						<h6 id="fh2" <?php if($len>=2){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 3</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=2){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide2">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img2"></div>
					</div>
				</div>
			</div>
            
            <div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h3" <?php if($len>=3){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 4 <a href="#" onClick="removeimage('3')">Remove Image</a></h6>
						<h6 id="fh3" <?php if($len>=3){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 4</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=3){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide3">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img3"></div>
					</div>
				</div>
			</div>
			<div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h4" <?php if($len>=4){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 5 <a href="#" onClick="removeimage('4')">Remove Image</a></h6>
						<h6 id="fh4" <?php if($len>=4){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 5</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=4){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide4">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img4"></div>
					</div>
				</div>
			</div>
			<div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h5" <?php if($len>=5){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 6 <a href="#" onClick="removeimage('5')">Remove Image</a></h6>
						<h6 id="fh5" <?php if($len>=5){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 6</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=5){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide5">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img5"></div>
					</div>
				</div>
			</div>
			<div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h6" <?php if($len>=6){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 7 <a href="#" onClick="removeimage('6')">Remove Image</a></h6>
						<h6 id="fh6" <?php if($len>=6){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 7</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=6){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide6">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img6"></div>
					</div>
				</div>
			</div>
			<div class="grid_3">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6 id="h7" <?php if($len>=7){?> style="display:block" <?php } else {?> style="display:none;" <?php }?>>Image 8 <a href="#" onClick="removeimage('7')">Remove Image</a></h6>
						<h6 id="fh7" <?php if($len>=7){?> style="display:none" <?php } else {?> style="display:block;" <?php }?>>Image 8</h6>
					</div>
					<div class="widget_content">
						<?php if($len>=7){ ?>
							<img src='../product_logos/<?php echo $_SESSION['imgname'][$i]; ?>' height='80' width='80'/>
						<?php $i++; } else { ?>
						<div id="hide7">
						<h3>Photo</h3>
						<p>Add Your Image </p>
						</div>
						<?php } ?>
						<div id="img7"></div>
					</div>
				</div>
			</div>
