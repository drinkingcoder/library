<html>
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
<body>
<textarea id="iptcont" rows="10" style="border:none;height:200px;border-bottom:1px solid blue;width:1000px;resize:none;font-size:18px;line-height:20px;overflow:hidden;"></textarea>
</body>
</html>
