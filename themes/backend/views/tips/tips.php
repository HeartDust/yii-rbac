<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        .content{ background:url('<?php echo Yii::app()->theme->baseUrl; ?>/images/success_tip.jpg') no-repeat center; font-family: '微软雅黑'; color: #333; font-size: 16px; width:1331px;height:886px;}
        .system-message{ padding: 24px 48px; position: absolute;left: 300px;top: 200px;}
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
        .system-message .jump{ padding-top: 10px;font-size: 14px;}
        .system-message .jump a{ color: #333;}
        .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
    </style>
</head>
<body>
<div class='content'>
    <div class="system-message">
        <h1></h1>
        <p class="success" style="color:green;"><?php echo $info['message']; ?></p>
        <p class="detail"></p>
        <p class="jump">
            页面自动 <a id="href" style="color:blue" href="<?php echo $info['href']; ?>">跳转</a> 等待时间： <b id="wait"><?php echo $info['waitSecond']; ?></b>
        </p>
    </div>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>