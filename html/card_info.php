<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
	$info;
	if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
		die("could not connect the mysql");
	if(mysql_select_db("library",$connection)==FALSE)
		die("could not use database library");
	if(isset($_GET["delete"]))
	{
		$card_id=$_GET["card_id"];
		$result=mysql_query("select * from record where card_id='$card_id';");
		if(mysql_num_rows($result)!=0) die("This card has some book not returned!");
		$result=mysql_query("select * from certificate where card_id='$card_id';");
		if(mysql_num_rows($result)==0)
		{
			$flag="F";
			$info="Card not exist!";
		} else {
			$result=mysql_query("delete from certificate where card_id='$card_id';");
			if($result==False) 
			{
				$flag="F";
				$info="Can not delete this card now!";
			} else $flag="T";
		}
	} else {
		$card_id=$_GET["card_id"];
		$job=$_GET["job"];
		$dept=$_GET["dept"];
		$name=$_GET["name"];
		$result=mysql_query("select * from certificate where card_id='$card_id';");
		if(mysql_num_rows($result)==1)
		{
			$info="This card already exists!";
			$flag="F";
		} else{
			$result=mysql_query("insert into certificate value('$card_id','$name','$dept','$job');");
			if($result==False) 
			{
				$flag="F";
				$info="Can not insert now!";
			} else $flag="T";
		}
	}
	header("Location:card.php?info=$info&manager=$manager&flag=$flag");
?>


