 
<!DOCTYPE html>
<html>
<header>
<meta charset="utf-8">

<script src="/52weis/public/script/js/echarts.min.js"></script>

<link rel="stylesheet" href="/52weis/public/script/bootstrap/css/bootstrap.min.css">
<script src="jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>



</header>
<body>
<h1>简书首页昨天详情 </h1>
<div class="container-fluid">
<div class="row">
<div id="main" style="height:600px;">
</div>
</div>
</body>



<script type="text/javascript">

function time_formater(time){
	 var date = new Date(time*1000);
	 var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
	 var D = date.getDate() < 10 ? '0'+date.getDate()+ ' ':date.getDate()+ ' ';
	 var h = date.getHours() < 10 ? '0'+date.getHours()+ ':':date.getHours()+ ':';
	 var m = date.getMinutes() < 10 ? '0'+date.getMinutes()+ ':':date.getMinutes()+ ':';
	 var s = date.getSeconds() < 10 ? '0'+date.getSeconds():date.getSeconds();
	 return M+D+h+m+s; 
}

myChart = echarts.init(document.getElementById('main'));
var option = {
	    title : {
	        text: '文章位于首页时阅读量变化情况',
	        subtext: '数据来源于简书'
	    },
	    tooltip : {
	        trigger: 'axis',
	        formatter:function (params){
		        var s = "2016-";
		        s += time_formater(params[0].value[0]) + "<br/>";
		        s += "阅读量 : " + params[0].value[1];
	        	return s;
           }
	    },
	    legend: {
	        data:['阅读量']
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true},
	            dataView : {show: true, readOnly: false},
	            magicType : {show: true, type: ['line', 'bar']},
	            restore : {show: true},
	            saveAsImage : {show: true}
	        }
	    },
	    interval: <?php echo $interval?>,
	    calculable : true,
	    xAxis : [
	        {
	            type : 'time',
	            scale:true,
	          	axisLabel : {
	                formatter:function (value){
	                	return time_formater(value);
		           },
	            }
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            scale:true,
	            axisLabel : {
	            	 formatter:function (value){
		                	return parseInt(value);
			           },
	            },
            	min:<?php echo $values[0]?>,
                max:<?php echo end($values)*1.1?>,
	        }
	    ],
	    series : [
	        {
	            name:'阅读量',
	            type:'line',
	            smooth:true,
	            data:<?php echo $views?>
	        }
	    ]
	};
	                    
myChart.setOption(option);







</script>
</html>

 