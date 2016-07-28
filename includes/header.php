<?php
@ini_set('display_errors','Off');
@ini_set('error_reporting',0);
session_start();

?>

<div id="top-bar" class="clearfix">
          <div id="top-bar-background">
            <div class="container relative">
              <div id="top-bar-text" class="top-bar-sides abs-left"> <a href="tel:(1)13546"><i class="ui--icon fontawesome-phone icon-inline-block" style="font-size: 14px;  width: 18px;  height: 18px;  margin-right: 5px;"></i> (1) 13 546 897</a>
                <div class="helper--seperator">/</div>
                <a href="#" class="ui--side-panel" data-target="ui--side-content-widget-1"><i class="ui--icon fontawesome-envelope icon-inline-block" style="font-size: 14px;  width: 18px;  height: 18px;  margin-right: 5px;"></i> Contact Us</a> </div>
              <div id="top-bar-widgets" class="top-bar-sides abs-right">
                <ul id="widget--login-default" class="ui--widget ui--custom-menu opt--on-hover unstyled-all ">
                <li> <a href="register.php"> Register </a> </li>
                  <li> <a href="login.php"> Login </a> </li>
                </ul>
<!--                <ul id="widget--shop-cart" class="ui--widget ui--custom-menu opt--on-hover unstyled-all ">
                  <li> <a href="#" class="ui--gradient ui--accent-gradient ui--accent-color on--hover ui--side-panel" data-target="ui--side-cart-widget">Cart: <span class="cart-money"><span class="amount">&#36;0</span></span> <span class="helper--extract-icon"><i class="fontawesome-angle-right px14"></i></span></a> </li>
                </ul>-->
                <ul id="topbar-social-icons" class="ui-socialbar unstyled ui--widget opt--on-hover style--top-bar  ss grey-bevel-gradient effect--slide borderless">
                  <li class="facebook ui--gradient ui--gradient-grey on--hover ui-socialbar-item ui--animation">
                    <div class="ui-socialbar-image ui-socialbar-background "></div>
                    <a href="#" class="ui-socialbar-image" target="_blank" title="Facebook"></a></li>
                  <li class="twitter-alt ui--gradient ui--gradient-grey on--hover ui-socialbar-item ui--animation">
                    <div class="ui-socialbar-image ui-socialbar-background "></div>
                    <a href="#" class="ui-socialbar-image" target="_blank" title="Twitter"></a></li>
                  <li class="googleplus ui--gradient ui--gradient-grey on--hover ui-socialbar-item ui--animation">
                    <div class="ui-socialbar-image ui-socialbar-background "></div>
                    <a href="#" class="ui-socialbar-image" target="_blank" title="Google Plus"></a></li>
                  <li class="rss ui--gradient ui--gradient-grey on--hover ui-socialbar-item ui--animation">
                    <div class="ui-socialbar-image ui-socialbar-background "></div>
                    <a href="#" class="ui-socialbar-image" target="_self" title="Rss"></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- /#top-bar -->
        <div id="header-container" class="header-type-1 no-stuck clearfix"  data-responsive="{&quot;css&quot;:{&quot;padding-bottom&quot;:{&quot;phone&quot;:20,&quot;tablet&quot;:20,&quot;widescreen&quot;:0}}}">
          <div id="header-container-background"></div>
          <div class="container relative">
            <div id="logo" class="pull-left"> <a href="index.php"> <img  id="logo-desktop" class="visible-desktop " src="images/logo.png" data-at2x="images/logo@2x-2.png" alt="Envision" style="margin-top: 10px;  margin-bottom: 10px;"/><img  id="logo-tablet" class="visible-tablet " src="images/logo.png" data-at2x="images/logo@2x-2.png" alt="Envision" style="margin-top: 10px;  margin-bottom: 10px;"/><img  id="logo-phone" class="visible-phone " src="images/logo.png" data-at2x="images/logo@2x-2.png" alt="Envision" style="margin-top: 20px;  margin-bottom: 20px;"/> </a> </div>
            <!-- /#logo -->
            <nav id="navigation" class="pull-right">
<!--              <div id="woocommerce-nav-cart" class="pull-right visible-desktop "> 
                  <a href="#" class="ui--side-panel" data-target="ui--side-cart-widget"><i class="ui--icon icomoon-cart icon-inline-block" style="font-size: 18px;  width: 22px;  height: 22px;"></i> <span class="cart-money"><span class="amount">&#36;0</span></span></a> 
              </div>-->
              <div id="header-navigation-toggle" class="visible-phone "> <a href="javascript:;">Navigation <i class="fontawesome-align-justify ui--caret"></i></a> </div>
              
              <ul id="header-navigation" class="sf-menu clearfix unstyled-all">
                
                
                <?php
				$getInfoByTableName = getInfoByTableName("manage_pages");
				foreach($getInfoByTableName as $records)
				{
                                    if($records['id']==4){
                                        if(isset($_SESSION['adid']) && !empty($_SESSION['adid'])){
                                            $counts = mysql_num_rows(mysql_query("select * from manage_content WHERE page_id='".$records['id']."'"));
                                        } else {
                                            $counts = 0;
                                        }
                                    } else {
                                        $counts = mysql_num_rows(mysql_query("select * from manage_content WHERE page_id='".$records['id']."'"));
                                    }
				?>
                
                <li id="menu-item-1278" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children level-0 top-level-item has-child fallout to-right"><a href="<?=$records['page_url'];?>"><?=$records['page_name'];?> <?php if($counts>0){?><i class="ui--caret fontawesome-angle-down px18"></i><?php } ?></a>

                <?php
				//$counts = mysql_num_rows(mysql_query("select * from manage_content WHERE page_id='".$records['id']."'"));
				if($counts > 0)
				{?>
                     <ul class="sub-menu">

                <?php
					$cond = " page_id='".$records['id']."'";
					$getInfoByTableNameID = getInfoByTableNameID("manage_content",$cond);
					foreach($getInfoByTableNameID as $record)
					{
					?>
						<li id="menu-item-1427" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children level-1 sub-level-item has-child to-right"><a href="<?=$record['page_url'];?>">- <?=$record['page_name']?></a>
						  
						</li>
						
					  <?php } ?>
                      </ul>

				<?php }?>
                </li>
              
              <?php } ?>
              
              
              
              
              </ul>
            </nav>

            <!-- /nav#navigation --> </div>
        </div>
        <!-- /#header-container -->