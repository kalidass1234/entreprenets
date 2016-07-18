<?php
include("../includes/all_func.php");
 include_once ("header.php");
if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
 
	
		?>




<style type="text/css">
.display h3{
margin-top:0.1em;
}
</style>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
	<div id="actionsBoxMenu" class="menu">
		<span id="cntBoxMenu">0</span>
		<a class="button box_action">Archive</a>
		<a class="button box_action">Delete</a>
		<a id="toggleBoxMenu" class="open"></a>
		<a id="closeBoxMenu" class="button t_close">X</a>
	</div>
	<div class="submenu">
		<a class="first box_action">Move...</a>
		<a class="box_action">Mark as read</a>
		<a class="box_action">Mark as unread</a>
		<a class="last box_action">Spam</a>
	</div>
</div>
<?php include('left-bar.php');?>
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
		<h3>Monthly Rank <span style="color:#F00">(15 BV required for monthly rank qualification)</span></h3>

           
        <div class="grid_12 full_block" style="width:100%">
          <div class="widget_content">
         
			<h3 class="left"><strong>
			<?php $bv= _get_personal_volume(USERID);
			if($bv<15)
			{
				$fbv=15-$bv;
				echo "You are not qualified for monthly rank, required ".$fbv." BV for monthly qualification.";
			}
			else
			{
				echo "Cogratulation!!! You are qualified for monthly rank.";
			}
			?></strong></h3>
           
				<div class="clear"></div>
						
	  <style>
	  .ms-2 li{
	  float:left;
	  padding:10px;
	  margin-left:10px;
	  border:1px solid #ccc;
	  border-radius:5px;
	  }
	 
		  .m_text{
		  font-family:"Trebuchet MS";
		  font-size:14px;
		  font-weight:bold;
		  color:#444;
		  padding:5px;
		  }
		  table.display td input {
height: 30px !important;
padding: 0 5px;
border: #093868 1px solid;
}
.custom_tooltip{
    display: inline;
    position: relative;
}

.custom_tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 70%;
}
		  </style>
			
					
	
					 
					
  <span class="clear"></span></div>
  <span class="clear"></span> </div>
</div>
</body>
</html>
<script language="JavaScript">
/*function CopyToClipboard(text,no) {
//alert(no);
document.getElementById('show_copy_'+no).innerHTML='Link Copied';
var holdtext=document.getElementById('link_'+no).value;
var Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
/*var text=document.getElementById('text_copy');
var holdtext=text;*/
//holdtext.innerText = copytext.innerText;
//alert(holdtext.innerText)
/*Copied = holdtext.createTextRange();
Copied.execCommand("Copy");*/
   /* Copied = text.createTextRange();
	alert(Copied);
    Copied.execCommand("Copy");*/
/*}*/
function CopyToClipboard(p,s) {
    if (window.clipboardData && clipboardData.setData) {
        clipboardData.setData('text', s);
    }
}
function setLocation(url)
{
	window.location.href=url;
}
</script>
