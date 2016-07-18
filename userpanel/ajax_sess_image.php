<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
//unset($_SESSION['imgname']);
//unset($_SESSION['img']);

$count=$_POST['count'];
$totalcount=$_POST['totalcount'];
$sesscount=count($_SESSION['imgname']);

//echo $count.'---'.$totalcount.'-----'.$sesscount;//exit;


for($i=0,$j=0;$i<$sesscount;$i++)
{
	if($i!=$count)
	{
	$arr[$j]=$_SESSION['imgname'][$i];
	//echo "\n".$j.'---'.$i.'---'.$count;
	$j++;
	unset($_SESSION['imgname'][$i]);
	unset($_SESSION['img'][$i]);
	}
	else
	{
		unset($_SESSION['imgname'][$count]);
		unset($_SESSION['img'][$count]);	
	}
}
//unset($_SESSION['imgname']);

for($i=0;$i<count($arr);$i++)
{
	$_SESSION['imgname'][$i]=$arr[$i];
	$_SESSION['img'][$i]=$arr[$i];
}

echo count($_SESSION['imgname']); exit;
if(isset($_FILES['file01']['name']))
{
	$image2="prop2_".rand(0,9999).substr($_FILES['file01']['name'],0,3).'.jpg';
	//echo "insert into images (p_id, prop_image) values ('$id', '$image2')";exit;
	//mysql_query("insert into images (p_id, p_image) values ('$id', '$image2')");
	$move=move_uploaded_file($_FILES['file01']['tmp_name'],"../product_logos/".$image2);
	if($move){} else { "image not upload"; exit;}
  // echo 'image not upload';exit;
	/*-------------------------------------------
	* IF Condition true when SESSION has 1 img
	* ELSE Store first time image
	*-------------------------------------------*/
	
	if(isset($_SESSION['imgname']))
	{
		//echo count($_SESSION['imgname'])."<br>";
		for($i=0;$i<count($_SESSION['imgname']);$i++)
		{
			$_SESSION['img'][$i]=$_SESSION['imgname'][$i];
		}
		$_SESSION['img'][$i]=$image2;
		$_SESSION['imgname']=$_SESSION['img'];
	}
	else
	{
		$_SESSION['imgname'][0]=$image2;
	}
	
	echo "<img src='../product_logos/".$image2."' height='80' width='80'/>";
	//print_r($_SESSION['imgname']);
}

?>

