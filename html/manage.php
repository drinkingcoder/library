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
	if(isset($_GET["submittxt"]))	
	{
		$context=$_GET["submittxt"];
		if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
			die("could not connect the mysql");
		if(mysql_select_db("library",$connection)==FALSE)
			die("could not use database library");
		$lines=split("\n",$context);
#		$sql="select count(*) count from book;";
#		if(($count=mysql_query($sql))==FALSE)
#			die("select faild!");
#		$count=mysql_fetch_array($count);
#		$count=$count["count"];
		for($i=0;$i<count($lines);$i++)
		{
			$att=split(",",$lines[$i]);
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
			mysql_query($sql);
		}
	}
?>

<script type="text/javascript">
$(function(){
		$("#iptcont").bind("keydown",function(e){
				var key = e.which,that = this,h = 20;
				if (key == 13) {
				var brs = $(this).val().split("\n").length+1;
				$(this).attr("rows",brs).height(h*brs);
				}else if(key == 8){
				window.setTimeout(function(){
						var brs = $(that).val().split("\n").length;
						$(that).attr("rows",brs).height(h*brs);
						},100);
				}

				});
		});
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<!--<script type="text/javascript">
	function insert_into()
	{
		var txt=document.getElementById('submittxt');
		var typ=document.getElementById('type');
		var nam=document.getElementById('name');
		var pub=document.getElementById('publisher');
		var yea=document.getElementById('year');
		var aut=document.getElementById('author');
		var pri=document.getElementById('price');
		var sto=document.getElementById('stocks');
		var arr=new Array(7);
		var tmp=new string();
		tmp=tmp.append_sibling(typ.value);
		alert("!!!!");
		arr[0]=typ.value.join('');
		arr[1]=nam.value.join('');
		arr[2]=pub.value.join('');
		arr[3]=yea.value.join('');
		arr[4]=aut.value.join('');
		arr[5]=pri.value.join('');
		arr[6]=sto.value.join('');
		txt.value=txt.value+'\n';
		txt.value=arr.join(';');
	}
</script>
--!>
</head>
<body>
<div align="center">
<form action="login.php">
	<input type="submit" name="manage" value="Return Index"/>
	<input type="hidden" name="manager" value="<? echo $manager; ?>"/>
</form>
	<table width="50%">
	<tr align="left">
		<td> Book_id </td>
		<td> Type </td>
		<td> Book_Name </td>
		<td> Publisher </td>
		<td> Year </td>
		<td> Author </td>
		<td> Price </td>
		<td> Stocks </td>
	</tr>
	</table>
	<table>
	<tr>
	<td align="right">
	<form action="">
		<textarea autofocus id="submittxt" name="submittxt" rows="60" style="background:transparent ;border:1px solid grey;height:400px;width:600px;resize:none;font-size:18px;line-height:20px;overflow:hidden;"></textarea>
	</br></br>
		<input type="submit" name="submit" value="Import"/>
		<input type="hidden" name="manager" value="<?echo $manager?>"/>
	</form>
	</td>
	</tr>
	</table>
<!--	<table>
	<tr>
		Type:<input type="text" name="type"/>	
		Name:<input type="text" name="name"/>	
		Publisher:<input type="text" name="publisher"/>	
		Year:<input type="text" name="year"/>	
		Author:<input type="text" name="author"/>	
		Price:<input type="text" name="price"/>	
		Stocks:<input type="text" name="stocks"/>	
	</tr>
	</table>
--!>
	<tr>
	<td>
	<form enctype="multipart/form-data" action="upload_file.php" method="post">
		<table>
		<tr>
		<td>
		<label for="file"> File name: </label>
		<input name="file" type="file" id="file" style="width:80px"/> 
		</td>
		<td>
		<input type="hidden" name="manager" value="<? echo $manager; ?>"/>
		</td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td>
		<input value="Import File" type="submit" name="submit"/> 
		</td>
		</tr>
	</form>
	</td>
	</tr>
</div>
</body>
</html>

