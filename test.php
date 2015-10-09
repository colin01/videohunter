<?php

require 'Media.class.php';

$url="http://www.iqiyi.com/v_19rrkm9vy8.html";
$data=Media::parse($url);
var_dump($data);