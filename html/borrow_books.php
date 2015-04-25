<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
	print_r($manager);
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
</head>
<body>
	<div align="center">
		<form id="pe" name="pe" action="borrow_info.php"/>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>
			<table align="center">
			<tr>
				<td>
					Card_id:
				</td>
				<td>
					<input type="text" name="card_id"/>
				</td>
			</tr>
			<tr>
				<td>
					Book_id:
				</td>
				<td>
					<input type="text" name="book_id"/>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right">
					<input type="submit" name="borrow" value="Borrow"/>
					<input type="hidden" name="manager" value="<?echo $manager?>"/>
				</td>
			</tr>
			</table>
	   </form>	
	</div>
</body>
</html>
