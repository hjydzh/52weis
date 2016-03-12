<!DOCTYPE html>
<html>
<header>
    <meta charset="utf-8">
    <!-- 引入 ECharts 文件 -->
    <script src="/52weis/public/script/js/echarts.min.js"></script>
</header>
<body>

	 <div id="main" style="width: 1000px;height:600px;"></div>
	 <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
    title : {
        text: '南京java岗位数量',
        subtext: '数据来源于智联招聘'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['数目','最低气温']
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
    calculable : true,
    xAxis : [
        {
            type : 'category',
             
            boundaryGap : false,
            data : 
            <?php 
            echo $days;
            ?>
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
            name:'数目',
            type:'line',
            data:<?php 
            echo $datas;
            ?>,
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
        }
    ]
};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
</body>
</html>