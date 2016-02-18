SelfBank 
====
Author:ymc023 Email:ymc023@163.com

###前言
____
SelfBank 是一个用php+js写的B/S个人(家庭)账务管理系统！需要服务器连接网络才能使用jquery.js <br>
>运行环境:<br>
>php >=5.4, (nginx/apache/...),(Mysql/MariaDB)<br>
安装前提:<br>
>准备好web服务器，安装好数据库及php.当然，你还要有数据库的root账号及密码.<br>
默认账号:<br>
>selfbank,selfbank 为连接数据库创建的默认账号！<br>
>admin,admin@admin 为登录系统默认账号 !<br>

###注意:
>需要使用google chrome才能保证日期选择正常使用！
>需要服务器正常连接互连网，才能保证前面的图像正常显示，否则首页是一片空白！(因为jquery.js是cdn上的)

###安装
____
##### 可用install.php安装sql.也可以用source selfbank.sql
>1.git clone https://github.com/ymc023/selfbank.git or Download selfbank.zip <br>
>2.cp -rf selfbank/ /var/www/....  //copy php源文件到www或其他自定义路径下 <br>
>3.vi selbank/config.php <br>
```
$db_servername="localhost";//修改成自己Mysql服务器地址 
```
```
$db_username="root";//修改成自己数据库用户名 
```
```
$db_password="$@albck$#－*723";//修改成自己数据库密码  
```
```
$db_dbname="selfbank";//数据库 
```
```
$qianzui="selfbank_";//表前缀  
```
>4.配置好web服务，打开http://serverip or domainname/install.php <br>
>5.系统默认会创建selfbank账号与密码，请更新到config.php中。<br>

====

###使用(Usage)
____
>1.安装页面  http://serverip/install.php
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/install.jpg) 
>2. 登录页面  http://serverip/
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/login.jpg)
>3. 首页显示  http://serverip/index.php
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/index-chart.jpg)
>4. 图片导出  
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/chart-download.jpg)
>5. 新建分类
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/new-class.jpg)
>6. 添加记录
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/add.jpg)
>7. 账目修改
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/change.jpg)
>8. 账务查询
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/search.jpg)
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/search-2.jpg)
<br>
>9. 修改密码
>![](https://github.com/ymc023/selfbank/blob/master/readmeimg/password-change.jpg)

COPYRIGHT
------
Copyright (C) 2016, ymc023. All rights reserved.
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; version 2 of the License.

