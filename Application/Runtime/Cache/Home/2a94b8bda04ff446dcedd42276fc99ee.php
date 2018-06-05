<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>梨享查</title>
	<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
	<style>
		.box{
			float: left;
			margin-left: 20px
		}
	</style>
</head>
<body>
<font color="orange"><h1>梨享查<font size="3" >&nbsp;lxw521.com</font></h1></font>
	<div style="border:2px solid #eee;padding: 20px;width: 200px;height: 350px" class="box">
		<h3>线路1:</h3>
		<form method="GET" action="<?php echo U('index/linea');?>">
			<h4>位置:</h4>
			<select name="sheng" class="sheng"> 
				<option value="0">请选择</option> 
				<?php if(is_array($ressheng)): foreach($ressheng as $key=>$v): ?><option value="<?php echo ($v['region_id']); ?>"><?php echo ($v['region_name']); ?></option><?php endforeach; endif; ?>
			</select>

			<br>	

			<select name="shi" class="shi">		
				<option value="0">请选择</option> 
			</select>

			<h4>行业:</h4>
			<select name="type" id="type"> 
				<option value="0">请选择</option> 
				<?php if(is_array($restype)): foreach($restype as $key=>$v): ?><option value="<?php echo ($v['type_newtype']); ?>"><?php echo ($v['type_name']); ?></option><?php endforeach; endif; ?>
			</select>
			<br>
			<select name="hy" id="hy">		
				<option value="0">请选择</option> 
			</select>
			<br><br>
			<input type="hidden" name="page"  value="1">
			<input type="hidden" name="line"  value="1">
			<input type="submit" value="开始查询">
		</form>
	</div>

	<div style="border:2px solid #eee;padding: 20px;width: 200px;height: 350px" class="box">
		<h3>线路2:</h3>
		<form method="GET" action="<?php echo U('index/lineb');?>">
			<h4>位置:</h4>
			<select name="sheng" class="sheng"> 
				<option value="0">请选择</option> 
				<?php if(is_array($ressheng)): foreach($ressheng as $key=>$v): ?><option value="<?php echo ($v['region_id']); ?>"><?php echo ($v['region_name']); ?></option><?php endforeach; endif; ?>
			</select>

			<br>	

			<select name="shi" class="shi">		
				<option value="0">请选择</option> 
			</select>

			<h4>关键词:</h4>
			<input type="text" name="keyword">
			<br><br>
			<input type="hidden" name="page"  value="1">
			<input type="hidden" name="line"  value="2">
			<input type="submit" value="开始查询">
		</form>
	</div>

	<div style="border:2px solid #eee;padding: 20px;width: 200px;height: 350px" class="box">
		<h3>线路3:</h3>
		<form method="GET" action="<?php echo U('index/linec');?>">
			<h4>位置:</h4>
			<select name="sheng" class="sheng"> 
				<option value="0">请选择</option> 
				<?php if(is_array($ressheng)): foreach($ressheng as $key=>$v): ?><option value="<?php echo ($v['region_id']); ?>"><?php echo ($v['region_name']); ?></option><?php endforeach; endif; ?>
			</select>

			<br>	

			<select name="shi" class="shi">		
				<option value="0">请选择</option> 
			</select>

			<h4>关键词:</h4>
			<input type="text" name="keyword">
			<br><br>
			<input type="hidden" name="page"  value="1">
			<input type="hidden" name="line"  value="2">
			<input type="submit" value="开始查询">
		</form>
	</div>
</body>
</html>
<script>
	$(".sheng").change(function(){
		 
		var a=$(this).children('option:selected').val();
		$(".shi").empty();
		$.ajax({
		    url:"<?php echo U('index/meme');?>",
		    type:'GET', //GET
		    async:true,    //或false,是否异步
		    data:{
		        id:a
		    },
		    success:function(data,textStatus,jqXHR){
		    	data = JSON.parse(data);
		        console.log(data);
		        // alert(data.length);
		        for (var i = 0; i < data.length; i++) {
		            $(".shi").append("<option value='"+data[i]['region_name']+"'>"+data[i]['region_name']+"</option>")
		        }
		    }
		})
	})

	$("#type").change(function(){
		$("#hy").empty();
		$("#hy").append("<option value='0'>全部</option>");
		var a=$(this).children('option:selected').val();
		console.log(a);
		$.ajax({
		    url:"<?php echo U('index/mama');?>",
		    type:'GET', //GET
		    async:true,    //或false,是否异步
		    data:{
		        id:a
		    },
		    success:function(data,textStatus,jqXHR){
		    	data = JSON.parse(data);
		        console.log(data);
		        // alert(data.length);
		        for (var i = 0; i < data.length; i++) {
		            $("#hy").append("<option value='"+data[i]['type_newtype']+"'>"+data[i]['type_name']+"</option>")
		        }
		    }
		})
	})
</script>