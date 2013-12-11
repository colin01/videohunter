<html>
<head>
	<h1>MYSQL数据库操作类</h1>
</head>
<body>

<h2>如何开始</h2>
<ol>
<li>dbhelper能够帮助你更好的操作数据库,你可以快捷方便的操作数据库无需复杂的SQL语法.</li>
<li>首先,引入dbhelper类,然后定义数据库的链接信息$cfg,并实例化类</li>
<li>实例化的参数第一个为数据库链接信息,第二个为调试模式,调试模式默认为false,若填写true,即开启调试模式</li>
<li>在调试模式中,所有的SQL语句在执行到QUERY时,将会中断,并且显示将要QUERY的SQL语句,而不会真正提交到数据库.</li>
<li>实例化后,若无错误提示,就可以使用其内置的方法了.</li>
</ol>

<h2>如何使用</h2>
<ol>
<li>dbhelper一共提供了三类数据库操作类型.
一是,对数据库结构化的查询,新增,删除更新等.另外还有 sum count max min avg like 等
二是,对数据库表的操作,包含数据表的新增,删除.
三是,类KVDB的key-value操作,若要使用KVDB,先进行cache_init() 操作,此时,将会创建cache表.
</li>

<li>
数据库基本操作
</li>

</ol>

<h2>附录</h2>
<h2>联系</h2>
<ul>
<li>我的博客 <a href="http://blog.suconghou.cn">http://blog.suconghou.cn</a></li>
<li>我的邮箱 suconghou@126.com</li>
</ul>
</body>
</html>