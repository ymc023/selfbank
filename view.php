<?php
    include_once("top.php");
?>

<?php
$income=0;
$spending=0;
?>

 <script language="javascript">
var daochu = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
<form id="form1" name="form1" method="post" action="">
  <tr>
  <td>
      <label>按账务分类查询：
            <select name="classid" id="classid">
              <option value="quan">全部分类</option>
              <option value="sr">收入--</option>
			  <?php
			  	$sqlshouru="select * from selfbank_account_class where ufid='$_SESSION[uid]' and classtype='1'";
				$queryshouru=mysql_query($sqlshouru);
				while($rowshouru = mysql_fetch_array($queryshouru)){
					echo "<option value='$rowshouru[classid]'>------$rowshouru[classname]</option>";
				}
			  ?>
		<option value="zc">支出--</option>
				<?php
			  	$sqlzhichu="select * from selfbank_account_class where ufid='$_SESSION[uid]' and classtype='2'";
				$queryzhichu=mysql_query($sqlzhichu);
				while($rowzhichu = mysql_fetch_array($queryzhichu)){
					echo "<option value='$rowzhichu[classid]'>------$rowzhichu[classname]</option>";
				}
			  ?>
            </select>
         </label>
         </td>
         <td>
         <label>
         按日期查询：
         </label>
         从
         <input type="date" name="time1" id="time1" />到<input type="date" name="time2" id="time2" >
        </td>
        <td>
        按备注查询：<input type="text" name="beizhu" id="beizhu"/>
        </label>
        </td>
        </tr>
        <tr>
        <td>
        <label>
        <input type="submit" name="Submit" value="查询" />
        </label>
        </td>
        <td height="35" align="left">查询结果:&nbsp;<font id="tongji"></font>　　<input type="button" onclick="daochu('excel')" value="导出查询结果为csv文件"></td>
        </tr>
        </form>
        </table>
       <table id="excel" class="table table-striped" width='100%' border='0' align='center' cellpadding='5' cellspacing='1' bgcolor='#B3B3B3'>
                <tr>
                <th width='120' bgcolor='#EBEBEB'>账务分类</th>
                <th width='50' bgcolor='#EBEBEB'>金额</th>
                <th width='90' bgcolor='#EBEBEB'>支出/收入</th>
                <th width='150' bgcolor='#EBEBEB'>时间</th>
                <th width='60' bgcolor='#EBEBEB'>备注</th>
                </tr>
                

		  <?php
		
		  	if(!$_POST[Submit]){  
		  		echo "</table></td></tr></table>";
				exit();
		  	}
		  	//只查询备注
			if($_POST[classid]=="quan" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]<>""){
 				 $a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
 				 $sql="select * from selfbank_account where acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			}
			//什么都没填
			if($_POST[classid]=="quan" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]==""){
				$sql="select * from selfbank_account where jiid='$_SESSION[uid]' ORDER BY actime DESC";
			}
			//只查询分类
			if($_POST[classid]<>"quan" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]==""){
				$sqlclassid="acclassid=".$_POST[classid];
				$sql="select * from selfbank_account where ".$sqlclassid." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			}
			
			//只查询分类收
			if($_POST[classid]=="zc" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]==""){
				
				$sql="select * from selfbank_account where zhifu='2' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			}
			if($_POST[classid]=="sr" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]==""){
				
				$sql="select * from selfbank_account where zhifu='1' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			}
			//只查询分类支
		
			//只查询日期
			if($_POST[classid]=="quan" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]==""){
				
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
			        $sql="select * from selfbank_account where ".$sqltime." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			if($_POST[classid]=="quan" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]==""){
				
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where ".$sqltime." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			//------------------------------
			//查询分类，日期，备注
			if($_POST[classid]<>"" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]<>""){
			         $a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				 $sqlclassid="acclassid=".$_POST[classid];

                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where ".$sqlclassid." and ".$sqltime." and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			//----------------------------------------
			//查询收支，备注
			if($_POST[classid]=="sr" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]<>""){
			$type="1";
				$a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				

				$sql="select * from selfbank_account where zhifu='$type' and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			if($_POST[classid]=="zc" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]<>""){
			$type="2";
				$a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				

				$sql="select * from selfbank_account where zhifu='$type' and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			
			//查询收支，日期
			if($_POST[classid]=="sr" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]==""){
			$type="1";
				

                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where zhifu='$type' and ".$sqltime." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			if($_POST[classid]=="zc" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]==""){
			$type="2";
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where zhifu='$type' and ".$sqltime." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			//查询收支，日期，备注
			if($_POST[classid]=="sr" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]<>""){
		               	$type="1";
			         $a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where zhifu='$type' and ".$sqltime." and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			if($_POST[classid]=="zc" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]<>""){
			$type="2";
			$a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				

                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";
				$sql="select * from selfbank_account where zhifu='$type' and ".$sqltime." and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			
			//查询日期，备注
			if($_POST[classid]=="quan" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]<>""){
			$a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";

				$sql="select * from selfbank_account where ".$sqltime." and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			
			
			//--------------------------------------
			//查询分类，备注
			if($_POST[classid]<>"quan" && $_POST[classid]<>"sr" && $_POST[classid]<>"zc" && $_POST[time1]=="" && $_POST[time2]=="" && $_POST[beizhu]<>""){
			$a="%";
 				 $b =$_POST[beizhu];
 				 $c=$a.$b.$a;
				$sqlclassid="acclassid=".$_POST[classid];

				$sql="select * from selfbank_account where ".$sqlclassid." and acremark like '$c' and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			
			//查询分类，日期
			if($_POST[classid]<>"quan" && $_POST[classid]<>"sr" && $_POST[classid]<>"zc" && $_POST[time1]<>"" && $_POST[time2]<>"" && $_POST[beizhu]==""){
			
				$sqlclassid="acclassid=".$_POST[classid];
                                $sqltime="actime >='".$_POST[time1]." 00:00:00' and actime <='".$_POST[time2]." 23:59:59'";

				#echo $sql="select * from selfbank_account where ".$sqlclassid." and ".$sqltime." and jiid='$_SESSION[uid]' ORDER BY actime DESC";
			
			}
			
		        $query=mysql_query($sql);
			while($row = mysql_fetch_array($query)){
			$sql="select * from selfbank_account_class where classid= $row[acclassid] and ufid='$_SESSION[uid]'";
			        $classquery=mysql_query($sql);
				$classinfo = mysql_fetch_array($classquery);
				echo "<tr>
				<td align='center' bgcolor='#FFFFFF'>$classinfo[classname]</td>
				<td align='center' bgcolor='#FFFFFF'>￥$row[acmoney]</td>";
				if($classinfo[classtype]==1){
				 	echo "<td align='center' bgcolor='#FFFFFF'><font color='blue'>收入</font></td>";
					$income=$income+$row[acmoney];
				}else{
					echo "<td align='center' bgcolor='#FFFFFF'><font color='#FF0000'>支出</font></td>";
					$spending=$spending+$row[acmoney];
				}
				echo "<td align='center' bgcolor='#FFFFFF'>".($row[actime])."</td><td align='center' bgcolor='#FFFFFF'>$row[acremark]</td>";
				#echo "<td align='center' bgcolor='#FFFFFF'>".date("Y-m-d G:i",$row[actime])."</td><td align='center' bgcolor='#FFFFFF'>$row[acremark]</td>";
				echo "</tr>";
				    
			}
	
		  ?>
		  </table><br /><br />
<script language="javascript">
document.getElementById("tongji").innerHTML="<?='共计收入:￥<font color=blue> '.$income.'</font> 共计支出:￥ <font color=red>'.$spending.'</font>'?>"
</script>

