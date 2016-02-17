<html>
<head>
<meta charset="UTF-8">
<link rel="styleshee" type="text/css" href="css/top.css">
<link rel="stylesheet" type="text/css" href="css/top1.css">
<title>SelfBank Install</title>
<body>
<form action="" method="post" name="iagree">
  <table class="table" border="0" cellspacing="0" cellpadding="0" width="960">
    <tbody>
        <tr>
            <td valign="top" width="760" align="center"><center><table class="main" border="0" cellspacing="1" cellpadding="1">
    <tbody>
        <tr>
            <td>
            <p><span style="color: #ff0000"><strong>同意安装前，请仔细阅以下息，避免安装失败<br />
            <p><strong>安装须知</strong></p>
            <p><strong> 一.关于系统的需求及使用说明</strong>：<br />
            (1). 建议selfbank使用 PHP+mariadb+linux+nginx <br / >
            (2). 可以使用mysql以及其他web服务器,当然，你也可以使用windows.win上面有wamp这样的组件可直接使用<br />
            <p><strong> 二.关于selfbank数据文件的安装</strong><br />
            (1). 直接使用目录下的selfbank.sql文件直接导入到mysql中.(mysqldump 或source).导入完成后就可以直接使用了<br />
            (2). 另一种安装数据库文件的方法，点击同意安装即可（前提，到config.php文件中配置好主机地址，数据库管理员账号及密码）<br />
            (3). 安装程序会创建一个selfbank账户(密码:selfbank)用于连接库，安装完成后.请更新到config.php文件中.
            <p><strong> 三.关于selfbank的使用</strong><br />
            (1). 默认账户admin 密码 admin@admin <br/>
            (2). 修改默认密码，进入系统后，点击关于我即可修改
            <p><strong> 四.关于selfbank</strong><br />
            (1). 任何人都可以对SelfBank修改并使用! 但需将最终修改后的版本发布到网络或返回给我.(ymc023@163.com)  <br/>   
            (2). SelfBank包含部分网络上的代码，本人并不承担相应违规使用的后果，仅用于演示学习及私人用途!
        </tr>
        <tr>
           <td> 
           <input type="submit" name="iagree" id="iagree" value="同意安装" />
           </td>
           </tr>

<?php
if($_POST[iagree]){
header("Location:install_selfbank.php");
}
?>
</body>
</html>
