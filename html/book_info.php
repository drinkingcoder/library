<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("../lib/header.php");
	session_start();
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
</head>
<body>
	</br>
	</br>
	<table border="1" align="center">
		<tr>
			<td> Book_id </td>
			<td> Type </td>
			<td> Name </td>
			<td> Publisher </td>
			<td> Year </td>
			<td> Author </td>
			<td> Price </td>
			<td align="right"> Stocks</td>
			<td align="right"> Collection</td>
		</tr>
	<?
		if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
			die("could not connect the mysql".mysql_error());
		if(mysql_select_db("library",$connection)==FALSE)
			die("could not use database library".mysql_error());
		$flag=0;
		if($_GET["type"]=="") $type="";
		else{
			$type=$_GET["type"];
			$flag=1;
			$type="type='$type'";

		}
		if($_GET["name"]=="") $name="";
		else{
			$name=$_GET["name"];
			$name="book_name='$name'";
			if($flag==1) $name=" and ".$name;
			else $flag=1;
		}
		if($_GET["publisher"]=="") $publisher="";
		else{
			$publisher=$_GET["name"];
			$publisher="publisher='$publisher'";
			if($flag==1) $publisher=" and ".$publisher;
			else $flag=1;
		}
		if(($_GET["year_min"]=="")||($_GET["year_max"]=="")) $year="";
		else{
			$year_min=$_GET["year_min"];
			$year_max=$_GET["year_max"];
			$year="$year_min<=year<=$year_max";
			if($flag==1) $year=" and ".$year;
			else $flag=1;
		}
		if($_GET["author"]=="") $author="";
		else{
			$author=$_GET["author"];
			$author="author='$author'";
			if($flag==1) $author=" and ".$author;
			else $flag=1;
		}
		if(($_GET["price_min"]=="")||($_GET["price_max"]=="")) $price="";
		else{
			$price_min=$_GET["price_min"];
			$price_max=$_GET["price_max"];
			if(floatval($price_min)==0) die("Minimum Price Error!");
			if(floatval($price_max)==0) die("Maximum Price Error!");
			$price=$price_min."<=price<=".$price_max;
			if($flag==1) $price=" and ".$price;
			else $flag=1;
		}
		if($flag==0) die("You do not choose anything!");
		$order=$_GET["order"];
		$sql="select * from book where $type$name$publisher$year$author$price order by $order;";
		$result=mysql_query($sql);
		if($result==FALSE) die("Query Wrong!".mysql_error());
		$times=mysql_num_rows($result);
		if($times>50) $times=50;
		for($i=0;$i<$times;$i++)
		{
			echo "<tr>";
			$row=mysql_fetch_row($result);
			echo "<td align='right'> $row[7] </td>";
			for($j=0;$j<count($row);$j++)
			{
				if($j==7) continue;
				$ans=$row[$j];
				echo "<td align='right'> $ans </td>";
			}
			echo "</tr>";
		}
	?>
	</table>
</body>
</html>
