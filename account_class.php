<?php
    include_once("top.php");
?>
<?php
if(($_GET["Submit"])){
        if (empty($_GET[classname])){
            echo "<script>alert('输入内容不合规!');</script>";  
         }
        else
       {
	$sql="select * from selfbank_account_class where classname='$_GET[classname]' and ufid='$_SESSION[uid]'";
	$query=mysql_query($sql);
	$attitle=is_array($row=mysql_fetch_array($query));
	if($attitle){
                $returnstat="exits";
		$status="账务分类名称已存在!";
	}else{
		$sql="insert into selfbank_account_class (classname, classtype,ufid) values ('$_GET[classname]', '$_GET[classtype]',$_SESSION[uid])";
		$query=mysql_query($sql);
		if($query){
                        $returnstat="success";
			$status="新添加账务分类成功!";
		}else{
                        $returnstat="failed";
			$status="新添加分类失败!";
		}
	}
     }
}
?>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <form id="form1" name="form1" method="get" action="">
          <td bgcolor="#FFFFFF" width="60%" align="center">
            <label>账务类型名称：
              <input name="classname" type="text" id="classname" />
            </label>
            </td>
            <td width="20%">
            <label>
             账务分类选择
            <select name="classtype" id="classtype">
              <option value="1">收入</option>
              <option value="2">支出</option>
            </select>
            </label>
            </td>
            <br/>
            <td>
            <label>
            <input type="submit" name="Submit" value="新建" />
            </label>
            </td>
        </form>
        </tr>
        <tr>
        <td>
            <?php
            if($returnstat==="exits")
            { echo "<script>alert('$status');</script>";}
            if($returnstat==="failed")
            {  echo "<script>alert('$status');</script>";}
            if($returnstat==="success")
            { echo "<script>alert('$status');</script>";}
            

            ?>
        </td>
        </tr>
      </table>
      <table align="center" width="100%" height="15" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td></td>
        </tr>
      </table>
    <table align="center" width="100%" border="0" cellpadding="5" cellspacing="1" >
             <tr>
              <th align="center" >账务类型名称</th>
              <th align="center" ><font color='blue'>账务分类</font></th>
              <th align="center" >操作</th>
            </tr>
			<?php 
			$sql="select * from selfbank_account_class where ufid='$_SESSION[uid]' and classtype='1'";
			$query=mysql_query($sql);
			while($row = mysql_fetch_array($query)){
			  echo "<tr><td align='center' bgcolor='#FFFFFF'>".$row[classname]."</td>";
			  if($row[classtype]==1)
			  	echo "<td align='center' bgcolor='#FFFFFF'><font color='#0000FF'>收入</font></td>";
			  else
			  	echo "<td align='center' bgcolor='#FFFFFF'><font color='#FF0000'>支出</font></td>";
			  echo "<td align='center' bgcolor='#FFFFFF'> <a href='delete_account_class.php?type=1&classid=".$row[classid]."'>修改</a> <a href='delete_account_class.php?type=3&classid=".$row[classid]."'>删除</a></td>";
			 }
			 echo "</tr>";
			?>
              <td align="center">&nbsp&nbsp&nbsp&nbsp</th>
              <th align="center" >&nbsp&nbsp&nbsp&nbsp</font></th>
              <th align="center" >&nbsp&nbsp</th>
            </tr>
			<?php 
			$sql="select * from selfbank_account_class where ufid='$_SESSION[uid]' and classtype='2'";
			$query=mysql_query($sql);
			while($row = mysql_fetch_array($query)){
			  echo "<tr><td align='center' bgcolor='#FFFFFF'>".$row[classname]."</td>";
			  if($row[classtype]==1)
			  	echo "<td align='center' bgcolor='#FFFFFF'><font color='#0000FF'>收入</font></td>";
			  else
			  	echo "<td align='center' bgcolor='#FFFFFF'><font color='#FF0000'>支出</font></td>";
			  echo "<td align='center' bgcolor='#FFFFFF'><a href='delete_account_class.php?type=1&classid=".$row[classid]."'>修改</a> <a href='delete_account_class.php?type=3&classid=".$row[classid]."'>删除</a></td>";
			 }
			 echo "</tr>";
			?>
          </table>

