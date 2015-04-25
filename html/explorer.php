<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
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
	</br>
	</br>
	</br>
	</br>
	</br>
	<table align="center">
		<form action="book_info.php">
			<tr>
				<td>
					<input type="radio" name="order" value="type"/>
				</td>
				<td style="width:50px">
					Type:
				</td>
				<td style="width:100px">
					<input type="text" name="type"/>
				</td>
				<td>
					<input type="radio" name="order" value="book_name" checked/>
				</td>
				<td style="width:50px">
					Name:
				</td>
				<td style="width:100px">
					<input type="text" name="name"/>
				</td>
				<td>
					<input type="radio" name="order" value="publisher"/>
				</td>
				<td style="width:50px">
					Publisher:
				</td>
				<td style="width:100px">
					<input type="text" name="publisher"/>
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="order" value="year"/>
				</td>
				<td>
					Year:
				</td>
				<td>
					<input type="number" name="year_min" max="9999" min="0" value="0"/>
					~
					<input type="number" name="year_max" max="9999" min="0" value="9999"/>
				</td>
				<td>
					<input type="radio" name="order" value="author"/>
				</td>
				<td>
					Author:
				</td>
				<td>
					<input type="text" name="author"/>
				</td>
				<td>
					<input type="radio" name="order" value="price"/>
				</td>
				<td>
					Price:
				</td>
				<td>
					<input value="0.1" type="text" name="price_min" style="width:50px"/>
					~
					<input value="9999" type="text" name="price_max" style="width:50px"/>
				</td>
			</tr>
			<tr>
				<td></td><td></td>
				<td></td><td></td>
				<td></td><td></td>
				<td></td><td></td>
				<td></td>
				<td align="right">
					<input type="submit" name="submit" value="Submit"/>
				</td>
			</tr>
			<input type="hidden" name="manager" value="<?echo $manager;?>"/>
		</form>
	</table>
</body>
</html>

