<?php
include '../../system/db.class.php';
if(empty($_COOKIE['in_adminid']) || empty($_COOKIE['in_adminname']) || empty($_COOKIE['in_adminpassword']) || empty($_COOKIE['in_permission']) || empty($_COOKIE['in_adminexpire']) || !getfield('admin', 'in_adminid', 'in_adminid', intval($_COOKIE['in_adminid'])) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
	exit(iframe_message("���ȵ�¼�������ģ�"));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>�ϴ�Ӧ��</title>
<link href="<?php echo IN_PATH; ?>static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/upload/uploadify.js"></script>
<script type="text/javascript">
var in_php = '<?php echo IN_PATH; ?>source/pack/upload/admin-uplog.php';
var in_post = <?php echo time(); ?>;
var in_size = <?php echo intval(ini_get('upload_max_filesize')); ?>;
function return_response(response){
        if (response == -1) {
                $(".uploadifySuccess").hide();
                $(".uploadifyError").show().text("�ļ����淶��������ѡ��");
        } else {
                ReturnValue(eval('(' + response + ')'));
        }
}
function ReturnValue(response){
        $("#fileQueue").html('<div class="uploadifyQueueItem">���ڽ���Ӧ�ã����Ե�...</div>');
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
                processAJAX();
        };
        xhr.open("GET", "<?php echo IN_PATH; ?>source/pack/upload/admin-" + response.extension + ".php?time=" + response.time + "&size=" + response.size, true);
        xhr.send(null);
        function processAJAX() {
                if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                                if (xhr.responseText == -1) {
                                        $("#fileQueue").html('<div class="uploadifyQueueItem">Access denied</div>');
                                        return false;
                                }
                                var data = eval('(' + xhr.responseText + ')');
                                parent.$("#in_name").val(data.name);
                                parent.$("#in_mnvs").val(data.mnvs);
                                parent.$("#in_bid").val(data.bid);
                                parent.$("#in_bsvs").val(data.bsvs);
                                parent.$("#in_bvs").val(data.bvs);
                                parent.$("#in_form").val(data.form);
                                parent.$("#in_nick").val(data.nick);
                                parent.$("#in_type").val(data.type);
                                parent.$("#in_team").val(data.team);
                                parent.$("#in_icon").val(data.icon);
                                parent.$("#in_plist").val(data.plist);
                                parent.$("#in_size").val(data.size);
                                parent.$("#btnsave").click();
                        }
                }
        }
}
</script>
</head>
<body>
<div id="fileQueue">
	<div class="uploadifyQueueItem uploadifySuccess" style="display:none">
		<div class="cancel">
			<a href="javascript:cancle()"><img src="<?php echo IN_PATH; ?>static/pack/upload/cancel.png" border="0"></a>
		</div>
		<span class="fileName"></span><span class="percentage"></span>
		<div class="uploadifyProgress">
			<div class="uploadifyProgressBar"></div>
		</div>
	</div>
	<div class="uploadifyQueueItem uploadifyError" style="display:none"></div>
</div>
<input type="file" id="uploadify" onchange="uploadify()" style="display:none">
<img src="<?php echo IN_PATH; ?>static/pack/upload/up.png" style="cursor:pointer" onclick="$('#uploadify').click()">
</body>
</html>