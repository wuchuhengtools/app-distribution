<?php
include 'source/system/db.class.php';
include 'source/admincp/include/function.php';
$frames = array('login', 'index', 'body', 'config', 'config_extend', 'app', 'key', 'make', 'user', 'backup', 'sql', 'clean', 'update', 'admin', 'paylog', 'buylog', 'signlog', 'ajax');
$iframe = !empty($_GET['iframe']) && in_array($_GET['iframe'], $frames) ? $_GET['iframe'] : 'login';
include_once $iframe == '' ? '' : 'source/admincp/module/'.$iframe.'.php';
?>