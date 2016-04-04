 
<!DOCTYPE html>
<html>
<header>
<meta charset="utf-8">

<script src="/52weis/public/script/js/echarts.min.js"></script>

<link rel="stylesheet" href="/52weis/public/script/bootstrap/css/bootstrap.min.css">
<script src="jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>



</header>
<body style="font-family:Microsoft YaHei">
<h1>简书首页昨天详情</h1>
<div class="container-fluid">
<div class="row">
	<div class="panel panel-default">
	<div class="panel-heading">阅读TOP10</div>
	<table class="table table-hover table-bordered">
		<thead>
	        <tr>
	          <th>#</th>
	          <th>标题</th>
	          <th>作者</th>
	          <th>首次被收录时间</th>
	          <th>发表时间</th>
	          <th>被展示于首页时长</th>
	          <th>阅读量变化</th>
	        </tr>
	    </thead>
	    <tbody>
	    <?php 
	    	$tr_template = '
				<tr>
		          <th scope="row">%s</th>
		          <td><a target="_blank"  href="http://www.jianshu.com%s">%s</a></td>
		          <td>%s</td>
		          <td>%s</td>
		          <td>%s</td>
		          <td>%s</td>
		          <td >
		          	<div style="display:table;margin-left:auto; margin-right: auto;">
		          	<button type="button" class="btn btn-primary" value="%s" onclick="detail(this.value)">详情</button>
		          	</div>
		          </td>
       			 </tr>
			';
	    	$num = 1;
	    	foreach ($blogs as $blog){
				$hour = intval($blog->showTime/3600);
				$min = round($blog->showTime%60, 1);
				$txt = vsprintf($tr_template, array($num, $blog->url, $blog->title, $blog->author, $blog->selectedTime, $blog->time, $hour.'小时'.$min.'分',$blog->url));
				echo $txt;
				$num = $num + 1;
			}
	    ?>
      </tbody>
	</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-4"  style="padding:10px;">
		<div style="border:4px #61A0A8 solid;padding:10px;">
		<h3 class="text-center">首页收录文章数</h3>
		<div id="num" style="height:400px;">
		</div>
		</div>
	</div>
	<div class="col-xs-4" style="padding:10px;">
		<div style="border:4px #61A0A8 solid;padding:10px;">
		<h3 class="text-center">首页收录文章数分布</h3>
		<div id="main" style="height:400px;">
		</div>
		</div>
	</div>
	<div class="col-xs-4"  style="padding:10px;">
		<div style="border:4px #61A0A8 solid;padding:10px;">
		<h3 class="text-center">文章停留首页时间</h3>
		<div id="cost" style="height:400px;">
		</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-5"  style="padding:10px;">
		<div style="border:5px #61A0A8 solid;padding:10px; ">
		<h3 class="text-center">增长一阅读量所需时间</h3>
		<div id="unitcost" style="height:360px;">
		</div>
		</div>
	</div>
	<div class="col-xs-7" style="padding:10px;">
		<div style="border:4px #61A0A8 solid;padding:10px;">
		<h3 class="text-center">一周首页收录文章数</h3>
		<div id="weeksum" style="height:360px;">
		</div>
		</div>
	</div>
</div>

<div class="row" >
	<div class="col-xs-6"  style="padding:10px;">
		<div style="border:4px #61A0A8 solid;padding:10px;">
		<h3 class="text-center">一周文章停留首页平均时间</h3>
		<div id="weekcost" style="height:360px;">
		</div>
		</div>
	</div>
	<div class="col-xs-6" style="padding:10px;">
		<div style="border:4px #61A0A8 solid; padding:10px;">
		<h3 class="text-center">一周增长一阅读量所需时间</h3>
		<div id="weekunitcost" style="height:360px;">
		</div>
		</div>
	</div>
</div>

</body>

<script type="text/javascript">

function detail(url){
	window.open("/detail.html?id=" + url.split('/')[2]);
}

</script>
<script type="text/javascript">

var myChart = echarts.init(document.getElementById('main'));
var option = {
	title : {
		text: '',
		subtext: '数据来源简书',
		x:'center'
	},
	tooltip : {
		trigger: 'item',
		formatter: "{a} <br/>{b} : {c} ({d}%)"
	},
	legend: {
		orient : 'vertical',
		x : 'left',
		data:['一天','0-8点','8-16点', '16-24点']
	},
	toolbox: {
		show : true,
		feature : {
			mark : {show: true},
			dataView : {show: true, readOnly: false},
			magicType : {
				show: true,
				type: ['pie', 'funnel'],
				option: {
					funnel: {
						x: '25%',
						width: '50%',
						funnelAlign: 'left',
						max: 1548
					}
				}
			},
			restore : {show: true},
			saveAsImage : {show: true}
		}
	},
	calculable : true,
	series : [
	{
		name:'数量分布',
		type:'pie',
		radius : '55%',
		center: ['50%', '60%'],
		data:[
		{value:<?php echo $morning_nums;?>, name:'0-8点'},
		{value:<?php echo $mid_nums;?>, name:'8-16点'},
		{value:<?php echo $night_nums;?>, name:'16-24点'}
		]
	}
	]
};
myChart.setOption(option);

myChart = echarts.init(document.getElementById('num'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['首页收录文章数','首页作者数']
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true}
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : ['昨天']
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            axisLabel : {
	                formatter: '{value}'
	            }
	        }
	    ],
	    series : [
	        {
	            name:'首页收录文章数',
	            type:'bar',
	            data:[<?php echo $blog_nums; ?>],
	            
	        },
	        {
	            name:'首页作者数',
	            type:'bar',
	            data:[<?php echo $author_nums; ?>],
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);


myChart = echarts.init(document.getElementById('cost'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['最小停留时间','平均停留时间', '最大停留时间']
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true}
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : ['昨天']
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            axisLabel : {
	                formatter: '{value}分'
	            }
	           
	        }
	    ],
	    series : [
	        {
	            name:'最小停留时间',
	            type:'bar',
	            data:[<?php echo round($show_time[0]/60, 1)?>],
	            
	        },
	        {
	            name:'平均停留时间',
	            type:'bar',
	            data:[<?php echo round($show_time[1]/60, 1)?>],
	            
	        },
	        {
	            name:'最大停留时间',
	            type:'bar',
	            data:[<?php echo round($show_time[2]/60, 1)?>],
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);




myChart = echarts.init(document.getElementById('unitcost'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['被首页收录前','被首页收录后']
	    },
	    toolbox: {
	        show : true
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : ['昨天']
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	            axisLabel : {
	                formatter: '{value}秒'
	            }
	           
	        }
	    ],
	    series : [
	        {
	            name:'被首页收录前',
	            type:'bar',
	            data:[<?php echo intval($read_rate[0]) ?>],
	            
	        },
	        {
	            name:'被首页收录后',
	            type:'bar',
	            data:[<?php echo intval($read_rate[1]) ?>],
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);



myChart = echarts.init(document.getElementById('weeksum'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['收录文章数']
	    },
	    toolbox: {
	        show : true,
	        feature : {
	            mark : {show: true},
	            magicType : {show: true, type: ['line', 'bar']}
	           
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : <?php echo $date_list_str; ?>
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	          	axisLabel : {
		                formatter: '{value}篇'
		            }
	        }
	    ],
	    series : [
	        {
	            name:'收录文章数',
	            type:'bar',
	            data:<?php echo $week_blog_nums;?>,
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);



myChart = echarts.init(document.getElementById('weekcost'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['文章停留首页时间']
	    },
	    toolbox: {
	        show : true,
	      feature : {
	            mark : {show: true},
	            magicType : {show: true, type: ['line', 'bar']}
	           
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : <?php echo $date_list_str; ?>
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	          	axisLabel : {
		                formatter: '{value}分钟'
		            }
	        }
	    ],
	    series : [
	        {
	            name:'文章停留首页时间',
	            type:'bar',
	            data:<?php echo $week_show_times; ?>
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);


myChart = echarts.init(document.getElementById('weekunitcost'));
var option = {
	    title : {
	        text: '',
	        subtext: '数据来源简书'
	    },
	    tooltip : {
	        trigger: 'axis'
	    },
	    legend: {
	        data:['文章停留首页时间']
	    },
	    toolbox: {
	        show : true,
	      feature : {
	            mark : {show: true},
	            magicType : {show: true, type: ['line', 'bar']}
	           
	        }
	    },
	    calculable : true,
	    xAxis : [
	        {
	            type : 'category',
	            data : <?php echo $date_list_str; ?>
	        }
	    ],
	    yAxis : [
	        {
	            type : 'value',
	          	axisLabel : {
		                formatter: '{value}秒'
		            }
	        }
	    ],
	    series : [
	        {
	            name:'文章停留首页时间',
	            type:'bar',
	            data:<?php echo $week_rate; ?>
	            
	        }
	    ]
	};
	                    
myChart.setOption(option);


//myChart = echarts.init(document.getElementById('main'));
//var
//myChart.setOption(option);







</script>
</html>

 