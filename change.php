<?php
    include_once("top.php");
?>
<?php
    if ($conn) {
mysql_select_db("selfbank");
        if (!$_GET[id]) {
            //$result = mysql_query("select * from selfbank");

//每页显示数目
$pagesize = 20;

//计算页面数
$p = $_GET['p']?$_GET['p']:1;

//数据指针
$offset = ($p-1)*$pagesize;

//查询本页显示的数据
$query_sql = "SELECT * FROM selfbank_account where jiid='$_SESSION[uid]' ORDER BY actime DESC LIMIT  $offset , $pagesize";

$query=mysql_query($query_sql);


            echo "<table width='100%' border='0' align='center' cellpadding='5' cellspacing='1' bgcolor='#B3B3B3'>
                <tr>
                <th width='120' bgcolor='#EBEBEB'>账务分类</th>
                <th width='50' bgcolor='#EBEBEB'>金额</th>
                <th width='90' bgcolor='#EBEBEB'>支出/收入</th>
                <th width='150' bgcolor='#EBEBEB'>时间</th>
                <th width='60' bgcolor='#EBEBEB'>备注</th>
                <th width='90' bgcolor='#EBEBEB'>操作</th>
                </tr>";
             
             if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

			while($row = mysql_fetch_array($query)){
				$sql="select * from selfbank_account_class where classid= $row[acclassid] and ufid='$_SESSION[uid]'";
				$classquery=mysql_query($sql);
				$classinfo = mysql_fetch_array($classquery);

                echo "<tr>";
                echo "<td align='center' bgcolor='#FFFFFF'>" . $classinfo['classname'] . "</td>";
                echo "<td align='center' bgcolor='#FFFFFF'>￥" . $row['acmoney'] . "</td>";
                if($classinfo[classtype]==1){
                echo "<td align='center' bgcolor='#FFFFFF'><font color='blue'>收入</font></td>";
                $income=$income+$row[acmoney];
                }else{
                echo "<td align='center' bgcolor='#FFFFFF'><font color='red'>支出</font></td>";
                $spending=$spending+$row[acmoney];
                }
                echo "<td align='center' bgcolor='#FFFFFF'>". $row[actime]."</td>";
                #echo "<td align='center' bgcolor='#FFFFFF'>".date("Y-m-d G:i",$row[actime])."</td>";
                echo "<td align='center' bgcolor='#FFFFFF'>" . $row[acremark] . "</td>";
                echo "<td align='center' bgcolor='#FFFFFF'><a href=change.php?id=".$row['acid'].">修改</a> <a href=delete_content.php?id=".$row['acid'].">删除</a></td>";
                echo "</tr>";
            }
            echo "</table>";


echo "<table width='100%' border='0' align='center' cellpadding='5' cellspacing='1' bgcolor='#B3B3B3'>
                <tr><td align='center' bgcolor='#FFFFFF'>";
//分页代码
//计算总数
$count_result = mysql_query("SELECT count(*) as count FROM selfbank_account where jiid='$_SESSION[uid]'");
$count_array = mysql_fetch_array($count_result);

//计算总的页数
$pagenum=ceil($count_array['count']/$pagesize);
echo '共 ',$count_array['count'],' 条';

//循环输出各页数目及连接

if ($pagenum > 1) {
    for($i=1;$i<=$pagenum;$i++) {
        if($i==$p) {
            echo ' [',$i,']';
        } else {
            echo ' <a href="change.php?p=',$i,'">',$i,'</a>';
        }
    }
}
echo "</td></tr></table>";


        }
        //显示列表的内容
        else
            {
            if (!$_POST[ok]) {
                $sql = "select * from selfbank_account where acid='$_GET[id]' and jiid='$_SESSION[uid]'";
                $result = mysql_query($sql);
                $row = mysql_fetch_array($result);
                
                $sql2="select * from selfbank_account_class where classid= $row[acclassid] and ufid='$_SESSION[uid]'";
				$classquery=mysql_query($sql2);
				$classinfo = mysql_fetch_array($classquery);
				$sjian=date($row[actime]);
				#$sjian=date("Y-m-d H:i",$row[actime]);
				
            ?>
   <form method=post action='change.php?id=<? echo $_GET[id];?>'>
            <?php
            ?>
<table align=center>
<INPUT TYPE="hidden" name="id" value="<?php echo $row[acid];?>">
<tbody>
<tr><td>金额：<input type=text name="jine" value="<?php echo $row[acmoney]; ?>"></td></tr>
<tr><td>账目分类：<?php echo $classinfo[classname] ?> </td></tr>
<tr><td>收入/支出：<?php if($classinfo[classtype]==1){
   echo "收入";
   $income=$income+$row[acmoney];
    }else{
   echo "支出";
   $spending=$spending+$row[acmoney];
   } ?></td></tr>
<tr><td>时间：<textarea rows="1" cols="20" name="shijian"><?php echo $sjian; ?></textarea></td></tr>
<tr><td>备注：<input type=text name="beizhu" value=<?php echo $row[acremark]; ?>></td></tr>
<tr><td><input type=submit name=ok value="提交"></td></tr>
</tbody>
</td></tr></table>
   </form>
            <?php
            }
            
 
            else
                {
                //针对$ok被激活后的处理：
               
                $shij=$_POST[shijian];
                $sql = "update selfbank_account set acmoney='".$_POST[jine]."',acremark='".$_POST[beizhu]."',actime='".$shij."' where acid='".$_POST[id]."' and jiid='".$_SESSION[uid]."'";
                $result = mysql_query($sql);
                if ($result)
                    echo "<script>alert('账目内容修改成功!');window.location.replace('change.php')</script>";
                else
                    echo "<script>alert('账目内容修改失败!');window.location.replace('change.php')</script>>";
                             
            }
        }
        //else($id部分)
    } // end if

?>

