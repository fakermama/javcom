<?php include('../admin_config/config.php');?>
<!doctype html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>800CMS管理中心</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="<?php echo JCCMS_ADMIN_url;?>assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo JCCMS_ADMIN_url;?>assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="<?php echo JCCMS_ADMIN_url;?>assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="<?php echo JCCMS_ADMIN_url;?>assets/css/admin.css">
    <link rel="stylesheet" href="<?php echo JCCMS_ADMIN_url;?>assets/css/app.css">
    <script src="<?php echo JCCMS_ADMIN_url;?>assets/js/echarts.min.js"></script>
  </head>
  
  <body data-type="index">
	<?php include('../admin_config/admin_top.php');;?>
    <div class="tpl-page-container tpl-page-header-fixed">
	<?php include('../admin_config/admin_list.php');;?>
        <div class="tpl-content-wrapper">

            <ol class="am-breadcrumb">
                <li><a href="#" class="am-icon-home">首页</a></li>
                <li>安全管理</li>
				 <li class="am-active">301重定向</li>
				 <li class="am-active">修改</li>
				 
            </ol>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-code"></span> 修改
                    </div>
                </div>
<?php
$ad_top_json_url=JCCMS_ROOT."admin_boss/ad.json";
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("Content-type: text/html; charset=utf-8");
include('../../class/class_txttest.php');
$txt = new  TxtDB($ad_top_json_url);
$bankinfo = array();
 $date = $txt::select($_GET['id']);
	$ad_top_id=$date['0'];
     $ad_top_url=$date['1'];
	$ad_top_pic=$date['2'];
	$ad_top_md=$date['3'];
	$str_err_ids = explode('--',$ad_top_md);
	$str_err=$str_err_ids['1'];
	$ad_top_md=$str_err_ids['0'];
	
	if($str_err =="ok"){$str_err_names="开启";}
	if($str_err =="no"){$str_err_names="关闭";}	
?>				
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">


                        <div class="am-u-sm-12 am-u-md-9">
                            <form method="post"  class="am-form am-form-horizontal">
								<input type="hidden" name="ad_top_id"  value="<?php echo  $ad_top_id;?>" />
							
								<div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">301重定向状态 </label>
                                    <div class="am-u-sm-9">
                                        <select  name="ad_top_url_zt" data-am-selected="{searchBox: 1}" style="display: none;">
										   <option  value="<?php echo  $str_err;?>" style="background-color:E9ECF3!important;">目前状态：<?php echo  $str_err_names;?></option>
										  <option  value="ok">开启</option>
										  <option  value="no">关闭</option>

										</select> 
                                    </div>
								</div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">目标页URL</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="ad_top_url"  value="<?php echo  $ad_top_url;?>" placeholder="目标页URL">
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">备注</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" name="ad_top_md"  value="<?php echo  $ad_top_md;?>" placeholder="如12/8~1/8广告费100元">
                                    </div>
                                </div>								
                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button name="submit" type="submit" class="am-btn am-btn-primary">修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<?php include('../admin_config/admin_foot.php');?>
    </div>
<?php


if (isset($_POST['submit']) && isset($_POST['ad_top_id'])&& isset($_POST['ad_top_url_zt']) && isset($_POST['ad_top_url']) && isset($_POST['ad_top_md'])) {
function post_input($data){$data = stripslashes($data);$data = htmlspecialchars($data);return $data;}		
$ad_top_id = post_input($_POST["ad_top_id"]);	
$ad_top_url_zt = post_input($_POST["ad_top_url_zt"]);
$ad_top_url = post_input($_POST["ad_top_url"]);	

$ad_top_md = post_input($_POST["ad_top_md"]);
$ad_top_md=$ad_top_md.'--'.$ad_top_url_zt;	

 $bankinfo["ad_top_id"] = $ad_top_id;
 $bankinfo["ad_top_url"] = $ad_top_url;
 $bankinfo["ad_top_pic"] = '';
 $bankinfo["ad_top_md"] = $ad_top_md;

$txt::alter($bankinfo); //改
?>
<script language="javascript"> 
<!-- 

alert("恭喜修改成功！"); 
window.location.href="security_301.php" 

--> 
</script> 
<?php



}
//{"result":"ok","ad_top":[{"ad_top_url":"3","ad_top_pic":"3","ad_top_md":"3","ad_top_time":"123"}]}
?>	
	
    <script src="<?php echo JCCMS_ADMIN_url;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo JCCMS_ADMIN_url;?>assets/js/amazeui.min.js"></script>
    <script src="<?php echo JCCMS_ADMIN_url;?>assets/js/iscroll.js"></script>
    <script src="<?php echo JCCMS_ADMIN_url;?>assets/js/app.js"></script>
  </body>

</html>