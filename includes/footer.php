      <footer class="ui-dark">

        <div id="footer-widgets">
          <div class="container">
            <div id="footer-widgets-row1">
              <div class="ui-row row">
                <aside class="widget-area span6">
                  <div id="cloudfw_mailchimp-2" class="widget widget-footer widget_cloudfw_mailChimp">
                    <h4 class="footer-widget-title ui--widget-title">Sign Up <strong>Newsletter</strong></h4>
                    <p>Make sure you don&#8217;t miss interesting happenings<br />
                      by joining our newsletter program.</p>
                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                      <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div class="ui--mailchimp mc-field-group">
                          <input type="email" value="" name="EMAIL" placeholder="Email Address" class="required email" id="mce-EMAIL">
                          <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">Subscribe</button>
                        </div>
                        <div id="mce-responses" class="clearfix">
                          <div class="response" id="mce-error-response" style="display:none"></div>
                          <div class="response" id="mce-success-response" style="display:none"></div>
                        </div>
                      </form>
                    </div>
                    <!--End mc_embed_signup--> </div>
                </aside>
                <aside class="widget-area span3">
                  <div id="widget_cloudfw_blog_list-3" class="widget widget-footer widget_cloudfw_blog_list">
                    <h4 class="footer-widget-title ui--widget-title">Latest <strong>Posts</strong></h4>
                    <div id="blog-2" class="ui--blog ui--blog-wrapper ui--pass" data-layout="mini" data-columns="1">
                      <div class="ui--carousel clearfix" data-options="{&quot;effect&quot;:&quot;slide&quot;,&quot;auto_rotate&quot;:&quot;FALSE&quot;,&quot;animation_loop&quot;:&quot;FALSE&quot;,&quot;arrows&quot;:true,&quot;rotate_time&quot;:0,&quot;animate&quot;:true}">
                        <div class="slides">
                            <?php
                            $mpb= mysql_query("SELECT * FROM `manage_news` WHERE `news_status`=1 ORDER BY `id` DESC LIMIT 10");
                            while($resn = mysql_fetch_assoc($mpb)){
                            ?>  
                            <div class="ui--blog-item ui--animation ui--accent-gradient-hover-parent clearfix layout--mini-carousel">
                              <div class="ui--blog-side ui--blog-date ui--accent-gradient-hover-parent ui--box">
                                <h3><span class="ui--blog-date-day ui--accent-gradient-hover"><?=date('d',strtotime($resn['added_date']))?></span></h3>
                                <h6 class="ui--blog-date-month ui--gradient ui--gradient-grey"><span><?=date('M',strtotime($resn['added_date']))?></span></h6>
                              </div>
                              <div class="ui--blog-content-wrapper">
                                <div class="ui--blog-header">
                                  <h6 class="ui--blog-title"><a class="ui--blog-link" href="news_article.php"><?=$resn['news_title']?></a></h6>
                                </div>
                                <div class="ui--blog-content">
                                <?php
                                echo implode(' ', array_slice(explode(' ', $resn['news_desc']), 0, 5)).'...';
                                ?>
                                </div>
                                <div class="ui--blog-readmore more-link"><a class="btn btn-small btn-secondary muted" href="news_article.php">Read More</a></div>
                              </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </aside>
                <aside class="widget-area span3">
                  <div id="tag_cloud-2" class="widget widget-footer widget_tag_cloud">
                    <h4 class="footer-widget-title ui--widget-title">Like Us On <strong>FaceBook</strong></h4>
                    <div class="tagcloud">
                        <div id="fb-root"></div>
                        <div class="fb-like" data-href="https://www.facebook.com/Entreprenets-Powered-By-Regsila-Software-Limited-841129552683805" data-layout="box_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=494173624005572";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
<!--                        <a href='#' class='tag-link-4' title='1 topic' style='font-size: 7pt;'>high resolution</a>
                        <a href='#' class='tag-link-3' title='1 topic' style='font-size: 7pt;'>icons</a>
                        <a href='#' class='tag-link-19' title='1 topic' style='font-size: 7pt;'>image</a>
                        <a href='#' class='tag-link-5' title='1 topic' style='font-size: 7pt;'>layout</a>
                        <a href='#' class='tag-link-6' title='1 topic' style='font-size: 7pt;'>menu</a>
                        <a href='#' class='tag-link-15' title='1 topic' style='font-size: 7pt;'>music</a>
                        <a href='#' class='tag-link-7' title='1 topic' style='font-size: 7pt;'>navigation</a>
                        <a href='#' class='tag-link-8' title='1 topic' style='font-size: 7pt;'>paper</a>
                        <a href='#' class='tag-link-2' title='2 topics' style='font-size: 7pt;'>theme</a>
                        <a href='#' class='tag-link-16' title='1 topic' style='font-size: 7pt;'>video</a>-->
                    </div>
                  </div>
                </aside>
              </div>
            </div>
            <?php
            $q = mysql_query("SELECT * FROM manage_footer LIMIT 1");
            $row = mysql_fetch_assoc($q);
            //echo "<pre>";print_r($row);exit;
            ?>
            <div class="footer-widgets-row-separator ui--footer-seperator-color"></div>
            <div id="footer-widgets-row2">
              <div class="ui-row row">
                <aside class="widget-area span3">
                  <div id="text-2" class="widget widget-footer widget_text">
                    <div class="textwidget">
                      <div class="ui--image-wrap clearfix" style="margin-bottom: 30px;">
                          <?php
                          if(!empty($row['logo']))
                          {
                          ?>
                            <img  id="ui--image-3" class="ui--image ui--animation" src="admin/logo_image/<?=$row['logo']?>" alt="" title="" data-at2x=""/>
                          <?php
                          }
                          ?>
                      </div>
                      <p><?php
                          if(!empty($row['logo_content']))
                          {
                              echo $row['logo_content'];
                          }
                          ?></p>
                        <p>
                            <?php
                            if(!empty($row['tel']))
                            {
                            ?>
                            <strong><i class="ui--icon fontawesome-phone" style="margin-right: 5px;"></i>Tel:</strong> <?=$row['tel']?><br />
                            <?php
                            }
                            ?>
                            <?php
                            if(!empty($row['fax']))
                            {
                            ?>
                            <strong><i class="ui--icon fontawesome-print" style="margin-right: 5px;"></i>Fax:</strong> <?=$row['fax']?><br />
                            <?php
                            }
                            ?>
                            <?php
                            if(!empty($row['email']))
                            {
                            ?>
                            <strong><i class="ui--icon fontawesome-envelope-alt" style="margin-right: 5px;"></i>E-mail:</strong> <?=$row['email']?>
                            <?php
                            }
                            ?>
                        
                        
                        </p>
                    </div>
                  </div>
                  <div id="widget_cloudfw_socialbar-2" class="widget widget-footer widget_cloudfw_socialbar">
                    <ul id="socialbar-1" class="ui-socialbar unstyled ssm white_p50-gradient with-bg effect--fade borderless">
                      <?php if(!empty($row['fb_url'])){?>
                      <li class="facebook radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['fb_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Facebook"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['tw_url'])){?>
                      <li class="twitter radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['tw_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Twitter"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['in_url'])){?>
                      <li class="linkedin radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['in_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Linkedin"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['gplus_url'])){?>
                      <li class="googleplus radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['gplus_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Google Plus"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['flickr_url'])){?>
                      <li class="flickr radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['flickr_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Flickr"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['behance_url'])){?>
                      <li class="behance radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['behance_url']?>" class="ui-socialbar-image radius-circle" target="_blank" title="Behance"></a></li>
                      <?php } ?>
                      <?php if(!empty($row['rss_url'])){?>
                      <li class="rss radius-circle ui-socialbar-item ui--animation">
                        <div class="ui-socialbar-image ui-socialbar-background radius-circle"></div>
                        <a href="<?=$row['rss_url']?>" class="ui-socialbar-image radius-circle" target="_self" title="Rss"></a></li>
                      <?php } ?>
                    </ul>
                  </div>
                </aside>
                <aside class="widget-area span3">
                  <div id="nav_menu-4" class="widget widget-footer widget_nav_menu">
                    <h4 class="footer-widget-title ui--widget-title"><strong>Pages</strong></h4>
                    <div class="menu-pages-menu-container">
                      <ul id="menu-pages-menu" class="menu">
                        <?php
                        $getInfoByTableName = getInfoByTableName("manage_pages");
                        foreach($getInfoByTableName as $records)
                        {
                        ?>
                        <li id="menu-item-1208" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?=$records['page_url'];?>"><a href="<?=$records['page_url'];?>"><?=$records['page_name'];?></a></li>  
                        <?php  
                        }
                        ?>
                      </ul>

                    </div>
                  </div>
                </aside>
                <aside class="widget-area span3">
                  <div id="nav_menu-3" class="widget widget-footer widget_nav_menu">
                    <h4 class="footer-widget-title ui--widget-title">Hot <strong>eBusinesses</strong></h4>
                    <div class="menu-features-menu-container">
                      <ul id="menu-features-menu" class="menu">
                        <?php
                        $mpb= mysql_query("SELECT * FROM `manage_projects` WHERE `project_type`=4 AND `display_status`=1 ORDER BY `id` DESC LIMIT 10");
                        while($res = mysql_fetch_assoc($mpb)){
                        ?>
                        <li id="menu-item-1007" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-<?=$res['id']?>"><a href="project-detail-page.php?id=<?=$res['id']?>"><?=$res['title']?></a></li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </aside>
                <aside class="widget-area span3">
                  <div id="text-3" class="widget widget-footer widget_text">
                    <h4 class="footer-widget-title ui--widget-title">Contact</h4>
                    <div class="textwidget">
                      <div class="wpcf7" id="wpcf7-f47-w1-o1">
                          <form action="/homepage-v2/#wpcf7-f47-w1-o1" id="footer_c_contect_form" method="post" class="wpcf7-form" novalidate="novalidate">
                          <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="47" />
                            <input type="hidden" name="_wpcf7_version" value="3.5.4" />
                            <input type="hidden" name="_wpcf7_locale" value="" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f47-w1-o1" />
                            <input type="hidden" name="_wpnonce" value="bfad6aa71a" />
                          </div>
                          <p>Your Email (required)<br />
                            <span class="wpcf7-form-control-wrap your-email">
                            <input type="email" name="your-email" id="footer_c_email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" />
                            </span> </p>
                          <p>Your Message<br />
                            <span class="wpcf7-form-control-wrap your-message">
                                <textarea name="your-message" id="footer_c_message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea"></textarea>
                            </span> </p>
                          <p class="text-right" style="margin-bottom:0;">
                              <button type="button" id="footer_c" class="sendContactusmail btn btn-primary btn-small">Send Message</button>
                          </p>
                          <div class="wpcf7-response-output wpcf7-display-none"></div>
                        </form>
                      </div>
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
        <div id="footer-bottom" class="">
          <div class="container">
              <div id="" class="" style="text-align: center;"><strong><?php if(!empty($row['cpy_right'])){ echo $row['cpy_right'];}?></strong></div>
              <!--<div id="footer-texts" class="pull-left"><strong>BMC System All Rights Reserved © 2014</strong></div>
            <div id="footer-navigation" class="pull-right">
              <ul id="menu-footer-bottom-menu" class="clearfix unstyled-all">
                <li id="menu-item-319" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-319"><a href="#"><i class="ui--icon fontawesome-facebook" style="margin-right: 5px;"></i> Facebook</a></li>
                <li class="ui--separator"> / </li>
                <li id="menu-item-320" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-320"><a href="#"><i class="ui--icon fontawesome-twitter" style="margin-right: 5px;"></i> Twitter</a></li>
                <li class="ui--separator"> / </li>
                <li id="menu-item-317" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-317"><a href="#">Buy!</a></li>
                <li class="ui--separator"> / </li>
              </ul>
            </div>-->
          </div>
        </div>
</footer>

    </div>
    <!-- /#page-wrap --></div>
  <!-- /#main-container -->
  <div id="side-panel" class="ui-row">
    <div id="ui--side-content-widget-1">
      <h3><strong>Contact Us</strong></h3>
      <div class="" id="wpcf7-f47-p1288-o1">
          <form action="#" method="post" id="main_contect_form" class="wpcf7-form" novalidate="novalidate" >
          <div style="display: none;">
            <input type="hidden" name="_wpcf7" value="47" />
            <input type="hidden" name="_wpcf7_version" value="3.5.4" />
            <input type="hidden" name="_wpcf7_locale" value="" />
            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f47-p1288-o1" />
            <input type="hidden" name="_wpnonce" value="bfad6aa71a" />
          </div>
          <p>Your Email (required)<br />
            <span class="wpcf7-form-control-wrap your-email">
                <input type="email" id="main_email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" required=""/>
            </span> </p>
          <p>Your Message<br />
            <span class="wpcf7-form-control-wrap your-message">
            <textarea name="message" id="main_message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea"></textarea>
            </span> </p>
          <p class="text-right" style="margin-bottom:0;">
              <button type="button" id="main" class="sendContactusmail btn btn-primary btn-small">Send Message</button>
          </p>
          <div class="wpcf7-response-output wpcf7-display-none"></div>
        </form>
      </div>
    </div>
    <div id="ui--side-content-widget-2">
      <h3><strong>Homepage &#8211; Layer Slider</strong></h3>
    </div>
    <div id="ui--side-content-widget-3">
      <h3><strong>Homepage &#8211; Layer Slider</strong></h3>
    </div>
    <div id="ui--side-cart-widget">
      <h3><strong>Cart</strong></h3>
      <div id="ui--side-cart" class="woocommerce">
        <ul class="cart_list product_list_widget ">
          <li class="empty">No products in the cart.</li>
        </ul>
        <!-- end product list --> </div>
    </div>
    <div id="ui--side-login-default-widget">
      <h3><strong>Login</strong></h3>
      <div id="login-form-container" class="ui--custom-login login-form-container">
        <form method="post" class="login-form form-horizontal ui-row">
          <div class="form-elements">
            <div class="ui-row row">
              <p class="control-group">
                <label class="control-label ui--animation" for="user_login">Username or Email</label>
                <span class="controls ui--animation">
                <input tabindex="100" type="text" class="input-text" name="log" id="user_login" value="" />
                </span> </p>
              <p class="control-group"> <small class="pull-right ui--animation"> <a class="lost_password" href="lost-password">Lost Password?</a> </small>
                <label class="control-label ui--animation" for="user_pass">Password</label>
                <span class="controls ui--animation">
                <input tabindex="101" class="input-text" type="password" name="pwd" id="user_pass" />
                </span> </p>
            </div>
          </div>
          <div class="form-actions clearfix">
            <input type="hidden" id="_n" name="_n" value="86dca65787" />
            <input type="hidden" name="_wp_http_referer" value="/homepage-v2/" />
            <p class="control-group">
              <label class="control-label checkbox inline ui--animation" for="rememberme">
                <input tabindex="100" type="checkbox" name="rememberme" id="rememberme" value="forever" />
                Remember me</label>
            </p>
            <p class="control-group">
              <button type="submit" class="ui--animation btn btn-block btn-yellow" tabindex="102" name="wpt_login" value="Login" >Login</button>
            </p>
            <p class="control-group"> <span class="ui--animation"> <a class="lost_password btn btn-block  btn-secondary" href="register.php">Register New User</a> </span> </p>
          </div>
        </form>
      </div>
    </div>
    <a class="btn btn-normal btn-icon-left btn-primary ui--animation" data-target="ui--side-content-widget-1" id="ui--side-panel-close-button" href="javascript:;" style=""><i class="ui--icon fontawesome-remove" style="font-size: 16px;  width: 18px;  height: 18px;"></i></a> </div>
</div>
<!-- /#side-panel-pusher -->
<div class="ui--fixed-button position--right "><a class="btn btn-normal btn-icon-left ui--side-panel btn-primary ui--animation" data-target="ui--side-content-widget-1" href="javascript:;" style=""><i class="ui--icon fontawesome-envelope icon-inline-block" style="font-size: 24px;  width: 28px;  height: 28px;"></i></a> </div>


<div id="theme-options1">

	<div id="theme-options-handlers">

		<a id="theme-options-handler" class="theme-options-button o--active" href="#">
			<i id="theme-options-handler-icon" class="theme-options-button-icon fontawesome-phone-sign"></i>
		</a>

	</div>

	

</div>
<script type="text/javascript">
jQuery('.sendContactusmail').on('click',function(){
    var id = this.id;
    if(jQuery('#'+id+'_email').val().trim()===''){
        alert('Email address can not be blank.');
        return false;
    }
    if(jQuery('#'+id+'_message').val().trim()===''){
        alert('Message can not be blank.');
        return false;
    }
    var formData=jQuery('#'+id+'_contect_form').serialize();
    jQuery.ajax({
        url: 'ajax/send_email.php',
        data: formData,
        processData: false,
        type: 'POST',
        success: function (data) {
            jQuery('#'+id+'_email').val('');
            jQuery('#'+id+'_message').val('');
            if(data=='TRUE'){
                alert('Thank you for contack us. We will get back soon.')
            } else {
                alert('We are sorry! something went wronge. please try after some time.');
            }
        }
    });
    return false;
});
function checkcontectvalidation(id){
    
}
</script>
