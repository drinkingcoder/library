<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>Operate</title>
</head>
<body>
	<div align="center">
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		<table >
			<tr>
				<td>
					<form action="borrow_books.php">
						<input type="submit" name="borrow" value="Borrow_Books"/>
						<input type="hidden" name="manager" value="<?echo $manager?>"/>
					</form>
				</td>
			</tr>
			<tr>
				<td>
					<form action="return_books.php">
						<input type="submit" name="return" value="Return_Books"/>
						<input type="hidden" name="manager" value="<?echo $manager?>"/>
					</form>
				</td>
			</tr>
			<tr align="center">
				<td>
					<form action="explorer.php">
						<input type="submit" name="explorer" value="Explorer"/>
						<input type="hidden" name="manager" value="<?echo $manager?>"/>
					</form>
				</td>
			</tr>
		</table>
	</div>
</body>
</script>
