<?
	global $manager;
	if(isset($_POST["manager"])) 
		$manager=$_POST["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
?>

<?php
	if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
		die("could not connect the mysql".mysql_error());
	if(mysql_select_db("library",$connection)==FALSE)
		die("could not use database library".mysql_error());
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
	  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	  echo "Type: " . $_FILES["file"]["type"] . "<br />";
	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br/>";
	    if (file_exists("upload/" . $_FILES["file"]["name"]))
		{
			$result=@unlink("upload/".$_FILES["file"]["name"]);
			if($result=false) echo "Submit Failed";
			else echo "Submit Success";
		}
			move_uploaded_file($_FILES["file"]["tmp_name"],
					"upload/" . $_FILES["file"]["name"]);
			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		$file=fopen("upload/".$_FILES["file"]["name"],"r");
		while(!feof($file))
		{
			$att=fgetcsv($file);
			if(count($att)<8) continue;
			$sql=sprintf("select stocks,book_id from book where book_id='%s'",$att[0]);
			$result=mysql_query($sql);
			if(!empty($row=mysql_fetch_row($result))) 
			{
				$sql="update book set stocks=stocks+$att[7],collection=collection+$att[7] where book_id=$row[1]";
				mysql_query($sql);
				continue;
			}
			$sql=sprintf("insert into book value('%s','%s','%s',%s,'%s',%s,%s,'%s',%s)",$att[1],$att[2],$att[3],$att[4],$att[5],$att[6],$att[7],$att[0],$att[7]);
			if(mysql_query($sql)==FALSE) die("Insert Faild!".mysql_error());
		}
				
	}
?>

