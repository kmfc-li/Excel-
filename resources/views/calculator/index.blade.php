<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>账单管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> BillCalculator首页 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
			<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<a href="javascript:;" onclick="member_add('添加','{{url::asset('calculator/add')}}','','510')" class="btn btn-primary radius">
			<i class="Hui-iconfont">&#xe600;</i> 添加</a>


			<a href="javascript:;" onclick="location.href='{{url::asset('calculator/export')}}'" class="btn btn-primary radius">
			<i class="Hui-iconfont">&#xe644;</i> 导出账单</a>
			<a href="javascript:;" onclick="_import('导入试题','{{url::asset('calculator/import')}}','','510')" class="btn btn-primary radius">
			<i class="Hui-iconfont">&#xe645;</i> 导入账单</a>
		</span> 
		<span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">账目</th>
				<th width="60">数量</th>
				<th width="60">单价</th>
				<!-- <th width="90">选项</th> -->
				<th width="70">总价</th>				
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
	@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="{{$val->id}}" name=""></td>
				<td>{{$val->id}}</td>
				<td>{{$val->bill_name}}</td>
				<td>{{$val->bill_num}}</td>
				<td>{{$val->unit_price}}</td>
				<td>{{$val->total_price}}</td>				
				<td>{{$val->created_at}}</td>
				<td class="td-manage">
					<a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> 
					<a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{URL::asset('calculator/update')}}','{{$val->id}}','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a title="删除" href="javascript:;" onclick="member_del(this,'{{URL::asset('calculator/delete')}}','{{$val->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
			</tr>
	@endforeach
	
		</tbody>
	</table>
	</div>
	
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{URL::asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('admin/static/h-ui/js/H-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{URL::asset('admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('admin/lib/datatables/1.10.15/jquery.dataTables.min.js')}}"></script> 
<script type="text/javascript" src="{{URL::asset('admin/lib/laypage/1.2/laypage.js')}}"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
		]
	});
	
});

/*试题-导入*/
function _import(title,url,w,h){
	layer_show(title,url,w,h);
}

/*试题-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*试题-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*试题-编辑*/
function member_edit(title,url,id,w,h){
	layer_show(title,url+'?id='+id,w,h);
}

/*试题-删除*/
function member_del(obj,ur,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: ur+'?id='+id,
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
</script> 
</body>
</html>