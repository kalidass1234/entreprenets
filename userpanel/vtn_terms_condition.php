<?php

include('../includes/all_func.php');

error_reporting(0);

session_start();

$id=$_GET['id'];

if(isset($_SESSION) && $_SESSION['SD_User_Name'])

{

	 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));	

	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['SD_User_Name']}'"));

}

else

{

	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;

}





?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<meta name="viewport" content="width=device-width"/>

<title><?php echo $TITLE_USER;?></title>

<link href="css/reset.css" rel="stylesheet" type="text/css">

<link href="css/layout.css" rel="stylesheet" type="text/css">

<link href="css/themes.css" rel="stylesheet" type="text/css">

<link href="css/typography.css" rel="stylesheet" type="text/css">

<link href="css/styles.css" rel="stylesheet" type="text/css">

<link href="css/shCore.css" rel="stylesheet" type="text/css">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">

<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">

<link href="css/data-table.css" rel="stylesheet" type="text/css">

<link href="css/form.css" rel="stylesheet" type="text/css">

<link href="css/ui-elements.css" rel="stylesheet" type="text/css">

<link href="css/wizard.css" rel="stylesheet" type="text/css">

<link href="css/sprite.css" rel="stylesheet" type="text/css">

<link href="css/gradient.css" rel="stylesheet" type="text/css">

  
        <!-- The plugin stylehseet -->
        <link rel="stylesheet" href="vtncard/jquery.bubbleSlideshow/jquery.bubbleSlideshow.css" />

<!--[if IE 7]>

<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />

<![endif]-->

<!--[if IE 8]>

<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />

<![endif]-->

<!--[if IE 9]>

<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />

<![endif]-->

<!-- Jquery -->

<script src="js/jquery-1.7.1.min.js"></script>

<script src="js/jquery-ui-1.8.18.custom.min.js"></script>

<script src="js/chosen.jquery.js"></script>

<script src="js/uniform.jquery.js"></script>

<script src="js/bootstrap-dropdown.js"></script>

<script src="js/bootstrap-colorpicker.js"></script>

<script src="js/sticky.full.js"></script>

<script src="js/jquery.noty.js"></script>

<script src="js/selectToUISlider.jQuery.js"></script>

<script src="js/fg.menu.js"></script>

<script src="js/jquery.tagsinput.js"></script>

<script src="js/jquery.cleditor.js"></script>

<script src="js/jquery.tipsy.js"></script>

<script src="js/jquery.peity.js"></script>

<script src="js/jquery.simplemodal.js"></script>

<script src="js/jquery.jBreadCrumb.1.1.js"></script>

<script src="js/jquery.colorbox-min.js"></script>

<script src="js/jquery.idTabs.min.js"></script>

<script src="js/jquery.multiFieldExtender.min.js"></script>

<script src="js/jquery.confirm.js"></script>

<script src="js/elfinder.min.js"></script>

<script src="js/accordion.jquery.js"></script>

<script src="js/autogrow.jquery.js"></script>

<script src="js/check-all.jquery.js"></script>

<script src="js/data-table.jquery.js"></script>

<script src="js/ZeroClipboard.js"></script>

<script src="js/TableTools.min.js"></script>

<script src="js/jeditable.jquery.js"></script>

<script src="js/duallist.jquery.js"></script>

<script src="js/easing.jquery.js"></script>

<script src="js/full-calendar.jquery.js"></script>

<script src="js/input-limiter.jquery.js"></script>

<script src="js/inputmask.jquery.js"></script>

<script src="js/iphone-style-checkbox.jquery.js"></script>

<script src="js/meta-data.jquery.js"></script>

<script src="js/quicksand.jquery.js"></script>

<script src="js/raty.jquery.js"></script>

<script src="js/smart-wizard.jquery.js"></script>

<script src="js/stepy.jquery.js"></script>

<script src="js/treeview.jquery.js"></script>

<script src="js/ui-accordion.jquery.js"></script>

<script src="js/vaidation.jquery.js"></script>

<script src="js/mosaic.1.0.1.min.js"></script>

<script src="js/jquery.collapse.js"></script>

<script src="js/jquery.cookie.js"></script>

<script src="js/jquery.autocomplete.min.js"></script>

<script src="js/localdata.js"></script>

<script src="js/excanvas.min.js"></script>

<script src="js/jquery.jqplot.min.js"></script>



<script src="js/custom-scripts.js"></script>

</head>

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

		<span class="title_icon"><span class="coverflow"></span></span>

		<h3>PAY CARD PROGRAM AGREEMENT</h3>

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

						<span class="h_icon list_image"></span>

						<h6>PAY CARD PROGRAM AGREEMENT</h6>

					</div>

     <style>

.form_container ul li {

	background: url(../images/dot.png) repeat-x bottom;

position: relative;

padding: 5px 15px 15px 10px;

}

	 </style>           

					<div class="widget_content" style="background-color:#FFFFFF">

					

							<ul>

								<li>

                                <h3 style="color: #800080;">PAY CARD PROGRAM AGREEMENT</h3>

								<div class="norm_text">

										<p>This PAY CARD PROGRAM AGREEMENT ("Agreement") is entered into by and between WEX Inc., a Delaware corporation with its principal offices at 97 Darling Ave., South Portland, ME 04106 ("WEX") and Vision Team Network, Inc. with its offices at 1135 Suite 6 West Cheltonham Ave Melrose Park PA 19027 ("Company"), in consideration of the promises and undertakings set forth below, WEX and Company agree as follows:</p>

<p>
 <strong>1. GENERAL OVERVIEW.</strong><br>
1. Under the Program, which has been presented to you by Tvizions Card ("Referral Company"), designated employees or independent contractors ("Participants") will be issued prepaid cards ("Cards") funded by Company in order for Company to make payroll or payroll related incentive payments to such Participants (the "Program"). The Cards shall be issued by an FDIC-insured bank ("Bank") selected by WEX. Each Participant shall be required to enroll in the Program by submitting certain information to WEX, and his or her participation shall be contingent on Bank's successful completion of its "know your customer" due diligence and other legal requirements. The terms and conditions governing the Sub-Accounts and the use of the Cards will be supplied by the Bank, in its sole discretion. Accounts shall be opened only for Participants that are residents of the United States or its territories.<br>
<br>
2. Funding by Company shall be made to a pooled custodial account maintained by Bank for this purpose (the "Bank Controlled Account"). To facilitate a Participant's use of Cards, a sub-account under the Bank Controlled Account will be established for such Participant (the "Sub-Account"). The Bank Controlled Account will be accessed by the Company through a passcode protected, secure web portal and will be used to load funds to cards, either individually or in batch files. These transactions are processed as soon as the request are received and funds are then available to Participants. Company shall be able to make Instant Loads to cards as needed with no requirement for a minimum balance to be maintained in the account, except that Company must maintain sufficient funds in the Bank Controlled Account to cover the disbursements that it is directing WEX and Bank to make to Participants. Bank shall maintain individual entries in its system, reconciled each day to amounts in each Sub-Account, reflecting the amount of funds in the Sub-Account that are attributable to, and held on behalf of, each Participant. Bank also shall maintain such records as are required by the FDIC to obtain "pass through" insurance coverage for each Participant whose funds are in a Sub-Account. Unless otherwise prohibited by law, Company, or any successor or assign of Company, including any receiver or trustee in bankruptcy on behalf of Company, shall maintain its right, title or interest in any funds in the Bank Controlled Account.
</p>

<p>
<strong>2. COMPANY RESPONSIBILITIES.</strong><br>
1. Company represents and warrants that all payment data submitted to WEX or the Bank in connection with Participants and the Program is true, accurate and complete, and is sufficient to enable WEX and Bank to allocate the funds among the various Sub-Accounts and honor withdrawal requests by Participants. Company agrees that Bank and WEX may rely on such data without any obligation to verify it.
<br><br>
2. Company shall deposit the funds due to Participants into the designated Bank Controlled Account by wire transfer or ACH transfer or other means, at the discretion of Company. Along with each transfer of funds by Company to the Bank Controlled Account, Company shall provide, in the format specified by Bank, the identity of, and the amount of such funds due to, each Participant ("Disbursement Detail). Company acknowledges that Bank will make funds available to Participants commencing on the business day Bank receives cleared funds and the corresponding Disbursement Detail.Neither Bank nor WEX shall have any obligation to make any funds available to Participants for whom the Disbursement Detail is missing or incomplete or if Bank's records indicate that insufficient funds are available to complete a transaction.
<br><br>
3. Subject to Section 7 hereof, WEX may permit Company to maintain an inventory of instant issue Cards at its locations. In such event, Company agrees to maintain such inventory in a secure manner including but not limited to the following: (i) Cards must be stored in a controlled environment, such as a safe, with access limited to employees who have successfully passed background screening checks; (ii) an inventory log must account for the number of cards received, cards used, cards that cannot be used due to damage, tampering or expiration and remaining cards that should balance to the number of cards on hand at any time. An explanation of causes why cards may be unusable should be included on the log. Any inventory discrepancy must be reported to WEX as soon as detected; (iii) Company shall bear all risk of loss associated with unauthorized activity on Cards or related funds on deposit resulting from unauthorized access to or theft of Card plastics in its possession or control; (iv) If Company is disbursing Cards, Company shall deliver to each Participant the enrollment materials provided to it by WEX (the "Enrollment Materials"). The Enrollment Materials may include, without limitation, the Cardholder Agreement, a Card, a direct Deposit Authorization Form, disclosures as may be required by applicable law and regulation and other materials. Company covenants and represents that it will provide Enrollment Materials to each Participant when Company provides a Card from its inventory.
<br><br>
4. Company shall comply with applicable law and card network rules in connection with its obligations under the Agreement. Company represents and warrants that it shall not use the Program, and shall use its best efforts to prevent itself from being used, for any illegal purpose or activity, including without limitation, money laundering.
<br><br>

<strong>Company shall be solely responsible for compliance with federal, state and local laws, rules and regulations relating to compensation and employment matters.</strong><br><br>

1. Company shall keep records of all transactions and activities performed under this Agreement for a period of not less than six years after the expiration or termination of this Agreement.
<br><br>
2. Company represents and warrants that it complies with applicable laws and regulations concerning payment of wages to the Participants, including, but not limited to I-9 form completion, timeliness of payments, procedures to pay wages, calculation of net pay, distribution of wage statements and handling and reporting amounts withheld or deducted from each Participant's pay, and obtaining consent, as may be required by law, of each employee who has elected to participate in the Program. By signing the attached Exhibit A, Company is requesting the removal of the independent identity verification requirement and agrees to retain the employee identity documents as required by the applicable laws and regulations governing the verification of employees by employers.
</p>

<p>
<strong>3. WEX RESPONSIBILITIES.</strong><br>
1. WEX shall provide or contract for all such functions and services necessary to create, operate and administer the Program.
<br><br>
2. WEX shall provide account set up and enrollment assistance for all Participants to ensure that Cards are delivered to Participants from the Bank. WEX shall grant user level access to Company and Participants to the systems used to support the Program.
<br><br>
3. WEX shall comply with applicable law and card network rules in connection with its obligations under the Agreement.
<br><br>
4. WEX shall provide Participants with operator-assisted customer service which is available 24×7, in addition to providing web based services for Participants and Company to access their respective information.
<br><br>
5. WEX shall provide training services on the Program to Company to enable Company to inform Participants on how to use the Program and take advantage of the various Program features.
<br><br>
6. In its discretion, WEX may provide other ancillary services that Participants may use to access their funds.
</p>

<p>
<strong>5. FEES AND CHARGES.</strong><br>
1. Company acknowledges that certain fees and charges are to be paid by Participants, and that such fees and charges shall be set forth in a disclosure statement that will be provided by the Bank and included in the Enrollment Materials. The current Program fees for Participants are set forth in Schedule A hereto. WEX and/or the Bank reserves the right to change the fees with appropriate prior written notice to Participants.
</p>
<p>
<strong>6. TERM OF AGREEMENT.</strong><br>
1. Unless this Agreement is terminated earlier pursuant to the provisions of this Section 6, this Agreement shall continue in full force and effect unless terminated as provided herein.
<br><br>
2. Either party may terminate this Agreement, with or without cause upon 60 days' prior written notice to the other party.
<br><br>
3. Either party may terminate this Agreement upon 30 days' prior written notice to the other party, if such party breaches or violates any provision of this Agreement and any such default, breach or violation, as described in such notice with specificity and in reasonable detail, is not remedied in all material respects within the applicable 30-day notice period.
<br><br>
4. In addition, either party may terminate this Agreement (a) upon 10 days' prior written notice if the other party becomes the subject of a voluntary bankruptcy petition or any other voluntary proceeding relating to insolvency or (b) without prior notice if the other party becomes the subject of an involuntary petition in bankruptcy or any other involuntary proceeding relating to insolvency, receivership or liquidation, and such voluntary petition or proceeding is not dismissed within such 10-day notice period.
<br><br>
5. Upon termination of this Agreement for any reason all fees and charges then owed by Company to WEX shall immediately be due and payable. Participants shall be permitted to use Cards after termination to access their funds in the relevant Sub-Account. Company shall immediately return all Cards in its possession that have not been issued to a Participant to WEX, under the procedures specified by Bank or WEX.
</p>

<p>
<strong>7. SYSTEM AND TRANSACTION MONITORING.</strong><br>
1. WEX and/or the Bank reserve the right to monitor Card activity, and to refuse to issue a Card, cancel a Card previously issued to a Participant or temporarily suspend usage of a Card, due to actual or suspected fraud or unauthorized use, and to comply with applicable law, card network rules and bank safety and soundness requirements. Except as prohibited by applicable law, the Bank shall disburse to the Participant any funds remaining on a cancelled Card. WEX shall have no liability to Company as a result of any action taken by Bank pursuant to this Agreement.
</p>

<p>
<strong>8. DATA SECURITY.</strong><br>
1. Company acknowledges that it is responsible for the security of all Cards, cardholder data and related Participant information in its possession or which it accesses. In connection with this Agreement, Company shall comply with the applicable requirements of the Payment Card Industry-Data Security Standards (PCI-DSS) as well as other requirements for the safeguarding of Cards and cardholder information which may be required by Bank or WEX. Without limiting the generality ofretain the employee identity documents as required by the applicable laws and regulations governing the verification of employees by employers.
</p>

<p>
<strong>10. ENTIRE AGREEMENT AND MODIFICATIONS. </strong><br>
This Agreement constitutes the entire agreement between the parties with respect to the subject matter and supersedes any and all prior understandings or agreements relating thereto, whether written or oral. Modifications to this Agreement must be in writing and signed by each party to be effective; provided, however, if any provision of this Agreement is found to be invalid or unenforceable such provision shall be deemed severed from this Agreement and all of the other provisions hereof shall remain in full force and effect as if such provision had never been included herein.
</p>

<p>
<strong>11. GOVERNING LAW.</strong><br>
This Agreement, as well as the rights and duties of the parties hereunder, shall be governed by, interpreted under and enforced in accordance with the laws of the State of Delaware, without regard to choice of law and conflict of law statutes.
</p>

<p>
<strong>12. WAIVER OF JURY TRIAL.</strong><br>
EACH PARTY HERETO IRREVOCABLY AND UNCONDITIONALLY WAIVES ALL RIGHT TO TRIAL BY JURY IN OR TO HAVE A JURY PARTICIPATE IN RESOLVING ANY DISPUTE, ACTION, PROCEEDING OR COUNTERCLAIM, WHETHER SOUNDING IN CONTRACT, TORT OR OTHERWISE, ARISING OUT OF OR RELATING TO OR IN CONNECTION WITH THIS AGREEMENT OR ANY OF THE TRANSACTIONS CONTEMPLATED HEREBY.
</p>

<p>
<strong>13. NOTICES.</strong><br>
All notices must be in writing to be effective and may be personally delivered or sent by certified mail or recognized overnight courier (e.g., FedEx) to the applicable address noted for each party in the first paragraph of this agreement, in which event any such notice shall be deemed received when delivered to such address.
</p>

<p>
<strong>14. AUTHORITY, BINDING EFFECT. </strong><br>
Each party hereby represents and warrants to the other that (a) its execution, delivery and performance of this Agreement has been duly authorized and approved, and (b) neither its execution or delivery of this Agreement, nor its performance hereunder, will violate or conflict with any term or condition of its organizational or other governing documents, or any other agreement or directive of any kind or nature to which it is a party or by which it is otherwise bound.
</p>

<p>
<strong>15. ASSIGNMENT. </strong><br>
The Agreement will be binding on and inure to the benefit of each of the parties, their successors and assigns. It may not be assigned or transferred, in whole or in part, by the Company without the written consent of WEX. Any such assignment or transfer without consent will be void. Notwithstanding the foregoing, WEX may assign this Agreement to a Related Entity without Company's prior consent. As used herein, "Related Entity" means (a) any corporation which is a successor to WEX either by merger or consolidation, (b) a purchaser of all or substantially all of WEX's assets, or (c) a corporation or other entity which shall directly or indirectly control, be under the control of, or be under common control of WEX.
</p>

<p>
<strong>16. COUNTERPARTS AND ELECTRONIC COPIES.</strong><br>
This Agreement may be executed in counterparts and delivered by electronic means such as, but not limited to facsimile or scanned e-mail, and all such counterparts and methods shall constitute one and the same document.
</p>

<p>
<strong>17. NO THIRD PARTY BENEFICIARIES.</strong> <br>
Nothing in this Agreement, express or implied, is intended or shall be construed to confer upon any person or entity, other than the parties and their respective successors and permitted assigns, any right, remedy or claim under or by reason of this Agreement.
</p>

<p>
<strong>18. FORCE MAJEURE. </strong> <br>
Neither party hereto, nor Bank, shall be liable for any failure to perform its obligations under this Agreement due to: (i) acts of God, such as fires, floods, electrical storms, unusually severe weather and natural catastrophes; (ii) civil disturbances such as strikes and riots; (iii) acts of aggression, direct or consequential, such as explosions, wars, and terrorism; (iv) failure of any third party service provider to adequately provide such services, including, without limitation ATM network services, telecommunication services, and merchant point-of-sale services; and (v) failures in electric power, computer or telecommunications services or equipment of a third party (each, a "Force Majeure"). In such event, the performance of such party's obligations shall be suspended during the period of existence of such Force Majeure event and the period reasonably required thereafter to resume the performance of the obligation. The party experiencing the Force Majeure event shall use reasonable efforts to minimize the consequences of such event.
</p>

<p>
NOW THEREFORE, WEX and Company have executed this Agreement by their duly authorized representatives to be effective on the date fully executed. <strong>Vision Team Network, Inc.</strong>
</p>

								</div>

								</li>

                                

                                

                                

                                

                                

                                

							</ul>

						

					</div>

				</div>

			</div>

		</div>

		<span class="clear"></span>

	</div>

</div>

</body>

</html>