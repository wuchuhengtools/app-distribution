<?php
include '../system/db.class.php';
header("Content-type: text/html;charset=".IN_CHARSET);
if(!empty($_FILES)){
	$id = $_POST['id'];
	$pw = $_POST['pw'];
	$pw == IN_SECRET or exit('Access denied');
	$icon = $GLOBALS['db']->getone("select in_icon from ".tname('app')." where in_id=".$id);
	$file = '../../data/attachment/'.str_replace('.png', '.ipa', $icon);
	if(move_uploaded_file($_FILES['ipa']['tmp_name'], $file)){
		updatetable('signlog', array('in_status' => 2,'in_addtime' => date('Y-m-d H:i:s')), array('in_aid' => $id));
		updatetable('app', array('in_type' => 1,'in_addtime' => date('Y-m-d H:i:s')), array('in_id' => $id));
		echo '['.$id.']'.$_SERVER['HTTP_HOST'];
	}
}
?>