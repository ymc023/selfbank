<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SelfBank Chart</title>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
</head>
<body>

<?php
#Author:ymc023
#Email:ymc023@163.com
#Date:2016.01.23
#Platform:(Centos7/Debian8.1)+(nginx/apache)+(mariadb/mysql)
include_once('top.php');
//计算年度总收入income,与总支出spend
$income=0.00;
$spend=0.00;
$sqltotal="select * from selfbank_account where jiid='$_SESSION[uid]' ORDER BY actime ASC";
$query=mysql_query($sqltotal);
  while($row = mysql_fetch_array($query))
  {
     $sql="select * from selfbank_account_class where classid= $row[acclassid] and ufid='$_SESSION[uid]'";
     $classquery=mysql_query($sql);
     $classinfo = mysql_fetch_array($classquery);
     if($classinfo[classtype]==1)
     {
      $income=$income+$row[acmoney];
     }
     else
     {
      $spend=$spend+$row[acmoney];
     }
  }

 //统计账目分类信息，获取分类ID
$sqlclassid="select `classid` from selfbank_account_class where ufid='$_SESSION[uid]'";
$queryclassid=mysql_query($sqlclassid);
$resultclassid=array();
 while($row = mysql_fetch_row($queryclassid))
{
  $resultclassid[]=$row[0]; 

}

 //获取分类名称
$sqlclassname="select `classname` from selfbank_account_class where ufid='$_SESSION[uid]'";
$queryclassname=mysql_query($sqlclassname);
$resultclassname=array();
 while($row=mysql_fetch_row($queryclassname))
 {
     $resultclassname[]=$row[0]; 
 }




//定义moneysum用于传参给存储过程summoney 获得12个月的详细账目统计
Function moneysum($fenlei,$yuefen,$userid)
{
  
  $moneyarray=array();
  if ($yuefen>=1 && $yuefen<=12)
  {
  for($i=1;$i<=12;$i++)
   {
     if($i<9)        
     {$sql="call summoney({$fenlei},'____-0{$i}-%',{$userid},@result);";}
     else
     {$sql="call summoney({$fenlei},'____-{$i}-%',{$userid},@result);"; }
   $query=mysql_query($sql);
   $result=mysql_query("select @result");
   $row_return = mysql_fetch_row($result);  
   $value= $row_return [0]; 
   if ($value=="")
      $moneyarray[$i]=0;
   else
      $moneyarray[$i]=$value;
  }
 }
  return $moneyarray;
}

//定义账目分类变量，并调用函数moneysum，传递三个参数调用存储过程summoney
$caigousum=moneysum($resultclassid[0],1,$_SESSION[uid]);
$kehuhuikuan=moneysum($resultclassid[1],1,$_SESSION[uid]);
$lirunzhuanzhang=moneysum($resultclassid[2],1,$_SESSION[uid]);
$richangzhichu=moneysum($resultclassid[3],1,$_SESSION[uid]);
$jiaotongfeiyong=moneysum($resultclassid[4],1,$_SESSION[uid]);
$renqinwanglai=moneysum($resultclassid[5],1,$_SESSION[uid]);
$jinqumenpiao=moneysum($resultclassid[6],1,$_SESSION[uid]);
$gonzi=moneysum($resultclassid[7],1,$_SESSION[uid]);

?>
<!-- 下面是highcharts的代码区-->
<div id="content" style="width:1500px;height:600px"></div>	
<script type="text/javascript">
$(function () {
    $('#content').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: '欢迎使用 SelfBank (2016年度)收/支报表'

        },
        subtitle: {
                text: '<?php echo '收入￥:'.$income.'    支出￥:'.$spend ?>'
        },
        credits: {
            text: 'SelfBank',
            href: 'https://github.com/ymc023'
    
        },         
        xAxis: {
            categories: ['一月', '二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: '人民币(元)'
            },
            labels: {
                formatter: function () {
                    return this.value ;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: '(元)'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: '<?php echo $resultclassname[0];?>',
            data: [<?php echo $caigousum[1];?>,
                   <?php echo $caigousum[2];?>,
                   <?php echo $caigousum[3];?>,
                   <?php echo $caigousum[4];?>,
                   <?php echo $caigousum[5];?>,
                   <?php echo $caigousum[6];?>,
                   <?php echo $caigousum[7];?>,
                   <?php echo $caigousum[8];?>,
                   <?php echo $caigousum[9];?>,
                   <?php echo $caigousum[10];?>,
                   <?php echo $caigousum[11];?>,
                   <?php echo $caigousum[12];?>
                  ]
        }, {
            name: '<?php echo $resultclassname[1];?>',
            data: [<?php echo $kehuhuikuan[1];?>,
                   <?php echo $kehuhuikuan[2];?>,
                   <?php echo $kehuhuikuan[3];?>,
                   <?php echo $kehuhuikuan[4];?>,
                   <?php echo $kehuhuikuan[5];?>,
                   <?php echo $kehuhuikuan[6];?>,
                   <?php echo $kehuhuikuan[7];?>,
                   <?php echo $kehuhuikuan[8];?>,
                   <?php echo $kehuhuikuan[9];?>,
                   <?php echo $kehuhuikuan[10];?>,
                   <?php echo $kehuhuikuan[11];?>,
                   <?php echo $kehuhuikuan[12];?>
                  ]
        }, {
            name: '<?php echo $resultclassname[2];?>',
            data: [
                  <?php echo $lirunzhuanzhang[1];?>,
                  <?php echo $lirunzhuanzhang[2];?>,
                  <?php echo $lirunzhuanzhang[3];?>,
                  <?php echo $lirunzhuanzhang[4];?>,
                  <?php echo $lirunzhuanzhang[5];?>,
                  <?php echo $lirunzhuanzhang[6];?>,
                  <?php echo $lirunzhuanzhang[7];?>,
                  <?php echo $lirunzhuanzhang[8];?>,
                  <?php echo $lirunzhuanzhang[9];?>,
                  <?php echo $lirunzhuanzhang[10];?>,
                  <?php echo $lirunzhuanzhang[11];?>,
                  <?php echo $lirunzhuanzhang[12];?>
                  ]
        },{
            name: '<?php echo $resultclassname[3];?>',
            data: [
                  <?php echo $richangzhichu[1];?>,
                  <?php echo $richangzhichu[2];?>,
                  <?php echo $richangzhichu[3];?>,
                  <?php echo $richangzhichu[4];?>,
                  <?php echo $richangzhichu[5];?>,
                  <?php echo $richangzhichu[6];?>,
                  <?php echo $richangzhichu[7];?>,
                  <?php echo $richangzhichu[8];?>,
                  <?php echo $richangzhichu[9];?>,
                  <?php echo $richangzhichu[10];?>,
                  <?php echo $richangzhichu[11];?>,
                  <?php echo $richangzhichu[12];?>
                  ]
        },{
            name: '<?php echo $resultclassname[4];?>',
            data: [
                 <?php echo $jiaotongfeiyong[1];?>,
                 <?php echo $jiaotongfeiyong[2];?>,
                 <?php echo $jiaotongfeiyong[3];?>,
                 <?php echo $jiaotongfeiyong[4];?>,
                 <?php echo $jiaotongfeiyong[5];?>,
                 <?php echo $jiaotongfeiyong[6];?>,
                 <?php echo $jiaotongfeiyong[7];?>,
                 <?php echo $jiaotongfeiyong[8];?>,
                 <?php echo $jiaotongfeiyong[9];?>,
                 <?php echo $jiaotongfeiyong[10];?>,
                 <?php echo $jiaotongfeiyong[11];?>,
                 <?php echo $jiaotongfeiyong[12];?>
                  ]
        },{
            name: '<?php echo $resultclassname[5];?>',
            data: [
                   <?php echo $renqinwanglai[1];?>,
                   <?php echo $renqinwanglai[2];?>,
                   <?php echo $renqinwanglai[3];?>,
                   <?php echo $renqinwanglai[4];?>,
                   <?php echo $renqinwanglai[5];?>,
                   <?php echo $renqinwanglai[6];?>,
                   <?php echo $renqinwanglai[7];?>,
                   <?php echo $renqinwanglai[8];?>,
                   <?php echo $renqinwanglai[9];?>,
                   <?php echo $renqinwanglai[10];?>,
                   <?php echo $renqinwanglai[11];?>,
                   <?php echo $renqinwanglai[12];?>
                  ]
        },{
            name: '<?php echo $resultclassname[6];?>',
            data: [
                   <?php echo $jinqumenpiao[1];?>,
                   <?php echo $jinqumenpiao[2];?>,
                   <?php echo $jinqumenpiao[3];?>,
                   <?php echo $jinqumenpiao[4];?>,
                   <?php echo $jinqumenpiao[5];?>,
                   <?php echo $jinqumenpiao[6];?>,
                   <?php echo $jinqumenpiao[7];?>,
                   <?php echo $jinqumenpiao[8];?>,
                   <?php echo $jinqumenpiao[9];?>,
                   <?php echo $jinqumenpiao[10];?>,
                   <?php echo $jinqumenpiao[11];?>,
                   <?php echo $jinqumenpiao[12];?>
                   ]
        }, {
            name: '<?php echo $resultclassname[7];?>',
            data: [
                   <?php echo $gonzi[1];?>,
                   <?php echo $gonzi[2];?>,
                   <?php echo $gonzi[3];?>,
                   <?php echo $gonzi[4];?>,
                   <?php echo $gonzi[5];?>,
                   <?php echo $gonzi[6];?>,
                   <?php echo $gonzi[7];?>,
                   <?php echo $gonzi[8];?>,
                   <?php echo $gonzi[9];?>,
                   <?php echo $gonzi[10];?>,
                   <?php echo $gonzi[11];?>,
                   <?php echo $gonzi[12];?>
                   ]
        }]
    });
});
		</script>
	</head>
	</body>
</html>

