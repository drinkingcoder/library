<?
	global $manager;
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	else die("Do not Login!");
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
	if(isset($_GET["flag"]))
	{
		$info=$_GET["info"];
		if($_GET["flag"]=="T") 
		{
			?> <script> alert("Success!"); </script> <?
		} else {
			?> <script> alert("Failed! <? echo $info;?>"); </script> <?
		}
	}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
</head>
<body align="center">
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	<form action="card_info.php">
		<input type="hidden" name="manager" value="<?echo $manager?>"/>
		<table align="center">
			<tr>
				<td> 
					Card_id:
				</td>
				<td>
					<input type="text" name="card_id"/>
				</td>
				<td>
					<input type="submit" name="delete" value="Delete Card"/>
				</td>
			</tr>
			<tr>
				<td>
					Name:
				</td>
				<td>
					<input  type="text" name="name"/>
				</td>
			</tr>
			<tr>
				<td>
					Department:
				</td>
				<td>
					<input  type="text" name="dept"/>
				</td>
			</tr>
			<tr>
				<td>
					Job:
				</td>
				<td>
					Student:<input checked type="radio" name="job" value="Stu"/>
					Teacher:<input type="radio" name="job" value="Tch"/>
				</td>
			</tr>
			<tr>
				<td></td><td></td>
				<td>
					<input type="submit" name="insert" value="Insert Card"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
