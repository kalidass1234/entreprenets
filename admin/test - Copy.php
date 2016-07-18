<?php 
// define site url for include style and js etc.
//define('SITE_URL','http://localhost/creative/creative/');

// include method file. 
//include(ABSPATH.'functions.php');  
include('config/directory.php');
include("config/config.php");
$host_name=$obj_function->host_name();
$host_name=str_replace('admin','',$host_name);
//echo $host_name;

define('SITE_URL',$host_name);
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 
// store current url
$_SESSION['page_url'] = str_ireplace("/creative/","",SITE_URL).$_SERVER['REQUEST_URI'];
//echo $_SESSION['TRINITY_User_Name'];exit;
if(!isset($_SESSION['TRINITY_User_Name']))
{
	header("Location:login.php"); exit;
}
class showDwonMem
{
	function shoDwnMem($dwnid,$tid)
	{
		function showMemX($dwnid,$tid)
		{
			global $data_dwn,$lel;
			$quer3="select * from registration where nom_id='$dwnid' ";
			$data3=mysql_query($quer3);
			//$le=2;
			while($arr2=mysql_fetch_array($data3))
			{
					$idx=$arr2['user_id'];
					$data_dwn[]=$idx;
					//$levv=level_count($idx,$tid);
					$lel[]=$levv;
					
					//print $data_dwn;
					showMemX($idx,$tid);
			}
			return $data_dwn;
		}
		$quer="select * from registration where nom_id='$dwnid' ";
		$data=mysql_query($quer);
		while($arr=mysql_fetch_array($data))
		{
			$user2=$arr['user_id'];
			showMemX($user2,$tid);
		}
	}
}
function showlegid($id,$leg)
{
//echo "select * from registration where nom_id='$id' and binary_pos='$leg'";
$sql_nom1l=mysql_query("select * from registration where nom_id='$id' and binary_pos='$leg'");
$ff_nom1l=mysql_fetch_array($sql_nom1l);
return $ff_nom1l;
}
				extract($_REQUEST);
				if(isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='')
				{
					$search_string.=" and nom_id ='$user_id'";
					$query_string.="&user_id='$user_id'";
					// get user detail
					$res_user=$obj_query->query("*","registration","user_id='$user_id'");
					$row_user=$obj_query->get_all_row($res_user);
				}
				$shdwn = new showDwonMem();
				$shdwn->shoDwnMem($user_id,$user_id);
				$r=count($data_dwn);
				//print_r($data_dwn);
				$dir=mysql_query("select * from registration where nom_id='$user_id' order by id");
				$dir_count=mysql_num_rows($dir);
				$tot_mem=$r+$dir_count;				
				$level2=0;
				$level3=0;
				$level4=0;
				$level5=0;
				$level6=0;
				$level7=0;
				$level8=0;					
				for($i=0;$i<$r;$i++)
				{
				$dn=$data_dwn[$i];
				$lel[$i];
				if($lel[$i]==1){$level1++;}	
				if($lel[$i]==2){$level2++;}
				if($lel[$i]==3){$level3++;}
				if($lel[$i]==4){$level4++;}
				if($lel[$i]==5){$level5++;}
				if($lel[$i]==6){$level6++;}
				if($lel[$i]==7){$level7++;}
				if($lel[$i]==8){$level8++;}	
				}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>jQuery Horizontal Tree</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin:400,700,600"/>
<link href="tree.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.tree.js"></script>
<script>
$(document).ready(function() {
	$('.tree').tree_structure({
		'add_option': true,
		'edit_option': true,
		'delete_option': true,
		'confirm_before_delete' : true,
		'animate_option': [true, 5],
		'fullwidth_option': false,
		'align_option': 'center',
		'draggable_option': true
	});
});
</script>
</head>
<body>
<div class="overflow">
	<div>
		<ul class="tree">
			<li>
				<div><?php echo $row_user['user_id'];?></div>
				<ul>
					<li>
						<div>1.1</div>
						<ul>
							<li>
								<div>1.1.1</div>
							</li>
							<li>
								<div>1.1.2</div>
							</li>
							<li>
								<div>1.1.3</div>
								<ul>
									<li>
										<div>1.1.3.1</div>
										<ul>
											<li>
												<div>1.1.3.1.1</div>
											</li>
											<li>
												<div>1.1.3.1.2</div>
											</li>
										</ul>
									</li>
									<li>
										<div>1.1.3.1</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<div>1.2</div>
						<ul>
							<li>
								<div>1.2.1</div>
							</li>
							<li>
								<div>1.2.2</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.3</div>
						<ul>
							<li>
								<div>1.3.1</div>
							</li>
							<li>
								<div>1.3.2</div>
							</li>
							<li>
								<div>1.3.3</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.4</div>
						<ul>
							<li>
								<div>1.4.1</div>
							</li>
							<li>
								<div>1.4.2</div>
							</li>
							<li>
								<div>1.4.3</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.5</div>
						<ul>
							<li>
								<div>1.5.1</div>
							</li>
							<li>
								<div>1.5.2</div>
							</li>
							<li>
								<div>1.5.3</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<ul class="other_ul">
    <li><b><span class="highlight"></span></b><strong>Icon for Highlight Branch of Particular Tree</strong></li>
    <li><b><span class="add_action"></span></b><strong>Icon for Add</strong></li>
    <li><b><span class="edit_action"></span></b><strong>Icon for Edit</strong></li>
    <li><b><span class="delete_action"></span></b><strong>Icon for Delete</strong></li>
</ul>
<div class="accordion-left">
	<div class="accordion-header">What is jQuery Horizontal Tree</div>
	<div class="accordion-content">
		<p>jQuery Horizontal Tree is a jQuery plugin for visualising data in a tree structure. This plugin supports add, edit, delete functionality with ajax and also supports drag and drop for re-organisation of nodes.</p>
		<p>A plugin that allows you to render structures with nested elements in a tree structure. To build the tree you need is to just make a single line call to the plugin and set parameter and supply the HTML element Id for a nested unordered list element that is representative of the data you'd like to display.</p>
        <p>Trees are usually used to store and represent data in some hierarchical order. The data are stored in the nodes, from which the tree is consisted of.</p>
        <p>Here, In getting started, we demonstrates how to create a simple Tree and populate it with some data.</p>
	</div>
	<div class="accordion-header">Features</div>
	<div class="accordion-content">
		<ul>
			<li>Very easy to use given a nested unordered list element.</li>
			<li>Drag-and-drop functionality for re-organisation of elements.</li>
			<li>Add, Edit, Delete functionality</li>
			<li>Show/hide a particular branch of the tree by clicking on the show hide icon.</li>
			<li>Highlight a particular branch of the tree by clicking on the highlight icon.</li>
			<li>Nodes can contain any amount of HTML except [li] and [ul].</li>
			<li>Draw lines between nodes with animation on page load event.</li>
			<li>Easy to style.</li>
			<li>Full support and documentation.</li>
		</ul>
	</div>
	<div class="accordion-header">Download</div>
	<div class="accordion-content">
		<p><a href="download/tree_with_html.zip">Click here for download static code [ HTML, CSS and jQuery ]</a></p>
		<p><a href="download/tree_with_php.zip">Click here for download dynamic code [ PHP, Mysql, Ajax, HTML, CSS and jQuery ]</a></p>
    </div>
	<div class="accordion-header">Whats Other</div>
	<div class="accordion-content">
		<p>Thank you for purchasing jQuery Horizontal Tree. If you have any questions that are beyond the scope of this help file, please feel free to <a href="mailto:tableles@gmail.com">email</a> via my user page <a href="mailto:tableles@gmail.com">contact form here.</a> Thank you so much!</p>
	</div>
</div>
<div class="accordion-right">
	<div class="accordion-header">Set Tree Structure</div>
	<div class="accordion-content">
		<h4>Step 1</h4>
		<p>Include CSS & SCRIPT into HEAD section of the page.<br />
		<a href="download/style.css" target="_blank">Click Here for download CSS.</a><br />
		<a href="download/js.zip">Click Here for download JS folder zip.</a></p>
<textarea>
<link href="style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.tree.js"></script>
<script>
$(document).ready(function() {
	$('.tree').tree_structure({
		'add_option': true,
		'edit_option': true,
		'delete_option': true,
		'confirm_before_delete' : true,
		'animate_option': [true, 5],
		'fullwidth_option': false,
		'align_option': 'center',
		'draggable_option': true
	});
});
</script></textarea><br /><br />
		<h4>Step 2</h4>
		<p>Include HTML code into BODY section of the page. <a href="download/images.zip">Click Here for download images zip.</a></p>
<textarea>
<div class="overflow">
	<div>
		<ul class="tree">
			<li>
				<div>1</div>
				<ul>
					<li>
						<div>1.1</div>
						<ul>
							<li>
								<div>1.1.1</div>
							</li>
							<li>
								<div>1.1.2</div>
							</li>
							<li>
								<div>1.1.3</div>
								<ul>
									<li>
										<div>1.1.3.1</div>
										<ul>
											<li>
												<div>1.1.3.1.1</div>
											</li>
											<li>
												<div>1.1.3.1.2</div>
											</li>
										</ul>
									</li>
									<li>
										<div>1.1.3.1</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<div>1.2</div>
						<ul>
							<li>
								<div>1.2.1</div>
							</li>
							<li>
								<div>1.2.2</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.3</div>
						<ul>
							<li>
								<div>1.3.1</div>
							</li>
							<li>
								<div>1.3.2</div>
							</li>
							<li>
								<div>1.3.3</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.4</div>
						<ul>
							<li>
								<div>1.4.1</div>
							</li>
							<li>
								<div>1.4.2</div>
							</li>
							<li>
								<div>1.4.3</div>
							</li>
						</ul>
					</li>
					<li>
						<div>1.5</div>
						<ul>
							<li>
								<div>1.5.1</div>
							</li>
							<li>
								<div>1.5.2</div>
							</li>
							<li>
								<div>1.5.3</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
    </div>
</div></textarea><br /><br />
	</div>
	<div class="accordion-header">Customization</div>
	<div class="accordion-content">
<textarea>
$(document).ready(function() {
	$('.tree').tree_structure({
		'add_option': true,
		'edit_option': true,
		'delete_option': true,
		'confirm_before_delete' : true,
		'animate_option': [true, 5],
		'fullwidth_option': false,
		'align_option': 'center',
		'draggable_option': true
	});
});</textarea>		
		<p>These are default parameter. Each parameter has a default value as part of its definition. If no argument is sent for that parameter, the default value is used. you can override value of parameters as per your requirements.</p>
		<p>I have mentioned below the description of each parameter.</p>
		<ul>
			<li>
				<h4>add_option</h4>
				<p>default value is true.</p>
				<p>We can add new node to the tree by clicking on add icon. Any name can be used to specify the node. Not only name we can use textarea for content or html code.</p>
			</li>
			<li>
				<h4>edit_option</h4>
				<p>default value is true.</p>
				<p>We can edit particular node by clicking on edit icon.</p>
			</li>
			<li>
				<h4>delete_option</h4>
				<p>default value is true.</p>
				<p>We can delete particular node with all child nodes by clicking on delete icon.</p>
            </li>
			<li>
				<h4>confirm_before_delete</h4>
				<p>default value is true.</p>
				<p>If by mistake click on delete icon then we have confirm message box before delete node.</p>
			</li>
			<li>
				<h4>animate_option</h4>
				<p>default value is [true, 5].</p>
				<p>Draw lines between nodes with animation on page load, we can increase or decrease animation speed.</p>
			</li>
			<li>
				<h4>fullwidth_option</h4>
				<p>default value is false.</p>
				<p>If value is false then tree structure is set as per browser width, change this value with true then tree structure get full width if tree width is bigger then browser width then tree structure set with horizontal scroll.</p>
			</li>
			<li>
				<h4>align_option</h4>
				<p>default value is 'center'.</p>
				<p>We can set align of tree structure with this option. options are left, right and center.</p>
			</li>
			<li>
				<h4>draggable_option</h4>
				<p>default value is true.</p>
				<p>We can perform a drag-and-drop operation with tree nodes. We drag the tree node which we want to move and then drop the dragged node on the destination node. The dragged node will now bound to the destination node.</p>
			</li>
		</ul>
		<hr />
		<ul>
			<li>We can Show or hide a particular branch of the tree by clicking on the show hide icon. If you want to hide particular branch of tree then go on parent node of that branch and click on edit icon then check the checkbox[hide child nodes] and save it.</li>
			<li>We can single/double click the highlight icon which performs the below mentioned operations<br />
        	<strong>- Single Click :</strong> It highlights all its parent nodes and child nodes.<br />
        	<strong>- Double Click :</strong> It navigate and shows only all its parent nodes and child nodes and clicking on Back Icon we can view whole tree.
			</li></ul><br />
	</div>
	<div class="accordion-header">Instruction</div>
	<div class="accordion-content">
		<p>PHP code is also available for this plugin. <a href="download/tree_with_php.zip">Click Here for download PHP Code</a></p>
		<h3>Step 1 :</h3>
        <p>Put downloaded folder in your system local php server[maybe it is htdocs]. Now create blank database in phpmyadmin & import tree.sql[tree.sql is located in tree_with_php folder]<br />
		Note : Blank database name must be tree.</p>
		<h3>Step 2 :</h3>
		<p>Open db.php and edit mysql connection with your database username and password.</p>
        <p>Now ran index.php</p>
	</div>
    <div class="accordion-header">Source & Credit</div>
    <div class="accordion-content">
    	<p><a href="http:www.jquery.com" target="_blank">jQuery</a> and <a href="http:www.google.com" target="_blank">Google</a> and <a href="http://www.iconfinder.com" target="_blank">iconfinder.com</a></p>
    </div>
</div>
</body>
<script>
$(".accordion-header").click(function() {
	$(this).toggleClass("active").next(".accordion-content").slideToggle();
});
</script>
</html>