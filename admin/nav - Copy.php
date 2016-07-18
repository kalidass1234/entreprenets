<!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <!-- Search form -->
       <!-- <form class="navbar-form" role="search">
    			<div class="form-group">
    				<input type="text" class="form-control" placeholder="Search">
            <button class="btn search-button" type="submit"><i class="fa fa-search"></i></button>
    			</div>
    		</form>-->
        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li><a href="index.php" class="open"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
          <li class="has_sub"><a href="#"><i class="fa fa-group"></i> <span>Member Management</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/member_list.php">Member List</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/member_password.php">Track Member Passoword</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/subscription_list.php">Subscription List</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/power_leg.php">Power Leg/Status</a></li>
            </ul>
          </li>
          <li  class="has_sub"><a href="#"><i class="fa fa-hand-o-up"></i> <span>Network</span><span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
           <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/downline_member.php">Downline member</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/direct_member.php">Direct Member</a></li>
              <!--<li><a href="top_recruiter.html">Top recruiter</a></li>
               <li><a href="upline_list.html">Upline list</a></li>
                <li><a href="total_network_view.html">Total network View</a></li>-->
            </ul></li>
          <li  class="has_sub"><a href="#"><i class="fa fa-sitemap"></i> <span>Genealogy</span><span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
           <ul>
               <li><a href="<?php echo SITE_URL; ?>admin/matrix_tree.php">Binary Tree</a></li>
           	  <!--<li><a href="#">Unilevel</a></li>
               <li><a href="#">Binary</a></li>
               <li><a href="#">Force Matrix</a></li>-->
               <li><a href="<?php echo SITE_URL; ?>admin/newmulti.php">Generation Tree</a></li>
           <!--<li><a href="board_tree.html">Board</a></li>-->
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="fa fa-group"></i> <span>Categories</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/category_main.php">Main Category</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/sub-category.php">Sub Category</a></li>
            </ul>
          </li>                               
          <li  class="has_sub"><a href="#"><i class="fa fa-credit-card"></i> <span>Products</span><span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
           <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/product_list.php"> Products List</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/stock_to_sell.php"> Stock To Sell</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/stock_to_sell_user_list.php"> Stock To Sell User Wise List</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/weekly_adds.php"> Daily Task</a></li>
              <!--<li><a href="<?php echo SITE_URL; ?>admin/stock_to_sell_list.php"> Stock To Sell List</a></li>-->
              <li><a href="<?php echo SITE_URL; ?>admin/weekly_adds_user_list.php"> Daily Adds User Wise List</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/weekly_adds_user_central.php"> Daily Adds Verify User Wise List</a></li>
            </ul>
           </li> 
          <li  class="has_sub"><a href="#"><i class="fa fa-file-text"></i> <span>Eshop Reports</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/order_pending.php">Order Pending</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/order_new.php">Order New</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/order_cancel.php">Order Cancel</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/order_diliver.php">Order Diliver</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/order_bv.php">Product Points</a></li>
              <!--<li><a href="guru_recruiter_report.html">Guru Recruiter Report</a></li>
              <li><a href="affiliate_income_report.html">Affiliate Income Report</a></li>
              <li><a href="active_summary_report.html">Active Summary Report</a></li>
              <li><a href="history_summary_report.html">History Summary Report</a></li>-->
            </ul>
          </li>
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-calendar"></i> <span>Commission setup</span><span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
           <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/manage_package.php">Manage Management</a></li>
              <li><a href="manage_delivery_charge.html">Manage Commission</a></li>
            </ul>
          </li>-->
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-edit"></i> <span>Taxes Management</span><span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="manage_tax.html">Manage Tax</a></li>
              <li><a href="#">Manage Shipping</a></li>
               <li><a href="manage_transuction.html">Manage Transaction Charge</a></li>
            </ul>
           </li>-->
          <!--<li><a href="#"><i class="fa fa-bar-chart-o"></i> <span>Chart Management</span></a></li>-->
          <li><a href="<?php echo SITE_URL; ?>admin/marketing_material.php"><i class="fa fa-cloud-download"></i> <span>Marketing Materials </span></a></li>
          <li><a href="<?php echo SITE_URL; ?>admin/faq.php"><i class="fa fa-cloud-download"></i> <span>FAQ </span></a></li>
          <li class="has_sub"><a href="#"><i class="fa fa-indent"></i> <span>Front Website CMS</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <!--<li><a href="testimonial.php">Testimonial</a></li>-->
              <li><a href="<?php echo SITE_URL; ?>admin/cms_category_main.php">CMS Category</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms.php">CMS</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_home.php">CMS Home</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_home_top.php">CMS Home Top</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_home_footer.php">Get in Touch</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_latest_work.php">Latest Work</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_client_say.php">Client Say</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/cms_recent_post.php">Recent Post</a></li>
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="fa fa-indent"></i> <span>ADMIN</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <!--<li><a href="testimonial.php">Testimonial</a></li>-->
              <li><a href="<?php echo SITE_URL; ?>admin/new_support_ticket.php">New Support Ticket</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/close_support_ticket.php">Closed Support Ticket</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/new_withdraw_request.php">New Withdraw Request</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/close_withdraw_request.php">Closed Withdraw Ticket</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/announcement.php">Announcement</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/member_remark.php">Member Remark</a></li>
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="fa fa-indent"></i> <span>Financial Manager</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <!--<li><a href="testimonial.php">Testimonial</a></li>-->
              <li><a href="<?php echo SITE_URL; ?>admin/member_wallet.php">View Members Wallet</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/fund_transfer.php">Fund Transfer To Members</a></li>
              
            </ul>
          </li>
           <li class="has_sub"><a href="#"><i class="fa fa-indent"></i> <span>Master</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <!--<li><a href="testimonial.php">Testimonial</a></li>-->
              <li><a href="<?php echo SITE_URL; ?>admin/member_package.php">Member Package</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/social_media_page.php">Social Media Pages</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/payment_methods.php">Payment Option</a></li>
            </ul>
          </li>
          <li  class="has_sub"><a href="#"><i class="fa fa-file-text"></i> <span>Bonuses & Reports</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="<?php echo SITE_URL; ?>admin/direct_sell_bonus.php">Direct Sell Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/direct_sponsor_bonus.php">Direct Sponsor Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/weekly_bonus.php">Weekly Guarnteed Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/retroactive_bonus.php">Retroactive Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/fasttrack_bonus.php">Fast Start Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/team_passive_bonus.php">Team Passive Bonus</a></li>
              <li><a href="<?php echo SITE_URL; ?>admin/rank_bonus.php">Incentive Bonus</a></li>
              <!--<li><a href="guru_recruiter_report.html">Guru Recruiter Report</a></li>
               <li><a href="affiliate_income_report.html">Affiliate Income Report</a></li>
              <li><a href="active_summary_report.html">Active Summary Report</a></li>
              <li><a href="history_summary_report.html">History Summary Report</a></li>-->
            </ul>
          </li>
          <!--<li class="has_sub"><a href="#"><i class="fa fa-indent"></i> <span>Procepecting  management</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="post.html">Auto Respondar</a></li>
              <li><a href="login.html">Set up</a></li>
              <li><a href="register.html">View</a></li>
            </ul>
          </li> -->
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-file-text"></i> <span>Bonuses & Reports</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="residual_commission_report.html">Residual Commission Report</a></li>
              <li><a href="bonus_report.html">Bonus Report</a></li>
              <li><a href="guru_recruiter_report.html">Guru Recruiter Report</a></li>
               <li><a href="affiliate_income_report.html">Affiliate Income Report</a></li>
              <li><a href="active_summary_report.html">Active Summary Report</a></li>
              <li><a href="history_summary_report.html">History Summary Report</a></li>
            </ul>
          </li>
          <li  class="has_sub"><a href="#"><i class="fa fa-calendar-o"></i> <span>Invoice Management</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="e-shop_marketing.html">E-shop Marketing</a></li>
              <li><a href="marketing_product_marketing.html">Marketing Product Marketing</a></li>
              <li><a href="cancel_order_eshop.html">Cancel Order E-shop</a></li>
              <li><a href="#">Cancel Order Marketing</a></li>
          </ul>
          </li>
          <li  class="has_sub"><a href="#"><i class="fa fa-calendar-o"></i> <span>E-shop</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
          <ul>
              <li><a href="#">Marketing Product</a></li>
              <li><a href="e-shop_marketing.html">Manage  Marketing Banners</a></li>
            </ul>
          </li>
          <li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>Social Media Management</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="twitter.html">Twitter</a></li>
              <li><a href="facebook.html">Facebook</a></li>
              <li><a href="google_plus.html">Google Plus</a></li>
               <li><a href="linkedin.html">Linkedin</a></li>
               <li><a href="buddy_press.html">Buddypess</a></li>
              <li><a href="you_tube.html">You tube</a></li>
               <li><a href="pinterest.html">Pinterest</a></li>
              <li><a href="instagram.html">Instagram</a></li>
            </ul>
          </li>-->
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>API management</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
               <li><a href="sharesale.html">Sharesale </a></li>
              <li><a href="webgains.html">Webgains</a></li>
              <li><a href="phg.html">PHG</a></li>
               <li><a href="commission_junction.html">Commission Junction</a></li>
                <li><a href="marketing_solution.html">Marketing Solution</a></li>
                 <li><a href="ebay_enterprise.html">Ebay Enterprise</a></li>
                  <li><a href="link_connector.html">Link Connector</a></li>
                   <li><a href="impact_radius.html">Impact Radius</a></li>
                    <li><a href="avantlink.html">Avantlink</a></li>
                     <li><a href="affiliate_wimdow.html">Affiliate Wimdow</a></li>
                      <li><a href="idevaffiliate.html">Idevaffiliate</a></li>
                      <li><a href="trade_douber.html">Trade Douber</a></li>
            </ul>
          </li>
          -->
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>Shipping</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
                <li><a href="usps.html">USPS</a></li>
              <li><a href="ups.html">UPS</a></li>
              <li><a href="fedex.html">FEDEX</a></li>
                <li><a href="canada_post.html">Canada Post</a></li>
              
             
            </ul>
          </li>-->
          
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>E-mail Services</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
               <li><a href="mailchimp.html">Mail Chimp</a></li>
                  <li><a href="mini.html">Mini</a></li>
              
             
            </ul>
          </li>-->
          
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>Payment Methods</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
               <li><a href="authorize.net.html">Authorize.net</a></li>
                    <li><a href="paypal.html">Paypal</a></li>
                    <li><a href="google_checkout.html">Google Checkout</a></li>
             
            </ul>
          </li>-->
          
          <!--<li  class="has_sub"><a href="#"><i class="fa fa-users"></i> <span>E-commerce</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="doba.html">DOBA </a></li>
                    <li><a href="dollar_days.html">Dollars Day</a></li>
                    <li><a href="shopzilla.html">Shopzilla</a></li>
                    <li><a href="wholesale_central.html">Wholesale Central</a></li>
            </ul>
          </li>-->
          
          
        </ul>
    </div>
    <!-- Sidebar ends -->