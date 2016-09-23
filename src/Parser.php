<?php
namespace Echobool\Getui\Igetui;
require_once('../parser/pb_parser.php');
$test = new PBParser();
$test->parse('./performance.proto');
?>