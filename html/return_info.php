<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
?>

<?
	if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
		die("could not connect the mysql".mysql_error());
	if(mysql_select_db("library",$connection)==FALSE)
		die("could not use database library".mysql_error());
	if(isset($_GET["book_id"])&&($_GET["book_id"]!=""))
	{
		if(!isset($_GET["return"])) die("Not Submit!");
		$card_id=$_GET["card_id"];
		$book_id=$_GET["book_id"];
		$result=mysql_query("select record_id from record where card_id='$card_id' and book_id='$book_id';");
		$row=mysql_fetch_row($result);
		$record_id=$row[0];
		if(empty($row)) die("You've not borrowed this book!");
		$result=mysql_query("delete from record where record_id='$record_id';");
		if($result==FALSE) die("Can't delete record!".mysql_error());
		$result=mysql_query("update book set stocks=stocks+1 where book_id='$book_id';");
		die("Return Success!");
	} else {
		$card_id=$_GET["card_id"];
		$result=mysql_query("select book_id,record_id from record where card_id='$card_id';");
		if($result==FALSE) die("select record faild!".mysql_error());
	?>	
		<html>
		<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		</head>
		<body>
			<div align="center">
				</br>
				</br>
				<table width="%50" border="0" align="center">
					<tr>
						<td style="width:120px">
							Book_id
						</td>
						<td style="width:140px">
							Book_Name
						</td>
					</tr>
		<?
					$count=mysql_num_rows($result);
					for($i=0;$i<$count;$i++)
					{
						$row=mysql_fetch_row($result);
						echo "<tr><td>";
						$book_id=$row[0];
						$res=mysql_query("select book_name from book where book_id='$book_id';");
						$res=mysql_fetch_row($res);
						$book_name=$res[0];
						echo "$book_id</td>";
						echo "<td>$book_name</td></tr>";
					}
		?>
			</table>
			</div>
		</body>
		</html>
		<?
	}
?>
