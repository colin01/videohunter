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
数据库基本操作,insert,update,delete,select 其中$table,为要操作的表名.$data是要插入的键值对,即数据库的字段为键名,对应的值为键值.
$where为满足的条件,也是键值对.
</li>
<li>数据库的大小等操作,max,min,avg,sum,count 其中$column为要统计的元组名.</li>
<li>判断是否存在的isin,如存在,该函数返回此资源否则返回false</li>
<li>数据表操作,create, $struct代表创建的数据表结构,也是键值对,键名代表字段名,键值代表字段的数据类型,drop(),即为删除一个数据表</li>

<li>KVDB的操作,cache_init为cache初始化,将创建一个cache表,可选参数$size,为创建的字段分别赋 varchar text blob数据类型,只需经过一次初始化,以后可以通过get,set操作数据,这和memcache很类似,只是没有memcache效率高,同时当一个$key的$value值设置为null时,即为删除此$key.</li>
</ol>

<h2>附录-供使用的dbhelper内置方法</h2>
<ul>

<p>数据基本操作</p>
<li>insert($table,$data)</li>
<li>delete($table,$where)</li>
<li>select($table,where=null,column="*")</li>
<li>update($table,$where,$data)</li>
<li>max($table,$column)</li>
<li>min($table,$colnum)</li>
<li>avg($table,$column)</li>
<li>sum($table,$column)</li>
<li>count($table,$column="*")</li>
<li>isin($table,$where)</li>

<p>数据表操作</p>
<li>create($table,$struct)</li>
<li>drop($table)</li>

<p>KVDB的使用</p>

<li>cache_init($size=1)</li>
<li>cache_drop()</li>
<li>get($key)</li>
<li>set($key,$value)</li>

<p>未完成的</p>
<li>like() 基本的模糊查询</li>
<li>complex_select() SQL复合查询</li>
</ul>
<h2>联系</h2>
<ul>
<li>我的博客 <a href="http://blog.suconghou.cn">http://blog.suconghou.cn</a></li>
<li>我的邮箱 suconghou@126.com</li>
</ul>
</body>
</html>