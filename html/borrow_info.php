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
		die("could not connect the mysql");
	if(mysql_select_db("library",$connection)==FALSE)
		die("could not use database library");
	if(isset($_GET["book_id"])&&($_GET["book_id"]!=""))
	{
		if(isset($_GET["borrow"])==FALSE) die("Not Submit!");
		$result=mysql_query("select manager_id from manager where name='$manager';");
		$row=mysql_fetch_row($result);
		$manager_id=$row[0];
		$card_id=$_GET["card_id"];
		$book_id=$_GET["book_id"];
		$result=mysql_query("select * from record where card_id='$card_id' and book_id='$book_id';");
		if($result==FALSE) die("can not get record!");
		$count=mysql_num_rows($result);
		if($count!=0) die("You've borrow this book.Don't be greedy!");	
		$result=mysql_query("select stocks from book where book_id='$book_id';");
		$row=mysql_fetch_row($result);
		if(empty($row)) die("Book not Exist!");
		if($row[0]==0) 
		{
			$result=mysql_query("select max(return_slot) from record;");
			$row=mysql_fetch_row($result);
			die("This book run out of stocks.Most recent return time : $row[0]");
		} else {
			$result=mysql_query("select count(*) from record");
			$row=mysql_fetch_row($result);
			$record_id=$row[0];
			$sql="insert into record value( '$record_id', '$card_id', '$book_id', current_timestamp, current_timestamp+interval 1 month, '$manager_id' );";
			$result=mysql_query($sql);
			if($result==FALSE) die("insert into record Failed!".mysql_error());
			$result=mysql_query("update book set stocks=stocks-1 where book_id='$book_id';");
			if($result==FALSE) 
			{
				mysql_query("delete from record where record_id='$record_id';");
				die("Update stocks faild!".mysql_error());
			} else die("Success!");
		}
	} else {
		$card_id=$_GET["card_id"];
		$result=mysql_query("select book_id,record_id from record where card_id='$card_id';");
		if($result==FALSE) die("select record faild!");
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
