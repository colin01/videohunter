<?php

require 'Media.class.php';

$url="http://www.kuwo.cn/yinyue/6643494/";
$data=Media::parse($url);
var_dump($data);