<?php
    include_once("top.php"); 
    //删除传弟过来的记录ID
    if ($_GET[id]) {
            $sql="delete from selfbank_account where acid=".$_GET[id];
            $result = mysql_query($sql);
            if ($result)
               echo "<script>alert('账目内容删除成功!');window.location.replace('change.php')</script>";
            else
               echo "<script>alert('账目内容删除失败!');window.location.replace('change.php')</script>"; 
    } 

?>
