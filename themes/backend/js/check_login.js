//登录验证
$(function(){
	$("input[type='submit']").click(function(){
		var $this=$(this);
		var uname=$("input[name=uname]").val();
		var upwd=$("input[name=upwd]").val();
			if($.trim(upwd).length>0){
				upwd=hex_md5(upwd);
			}else{
				upwd=hex_md5("");
			}
		var url=window.location.pathname;
		var reg=/.*php/;
			url=url.match(reg);
		var surl=url;
			url=url+'/Index/check_login';
		var data={'uname':uname,'upwd':upwd};
		$.ajax({
			url:url,
			data:data,
			type:'post',
			success:function(data){
				console.log(data);
				if(data==0){
					window.location.href=surl+'/Home/index';
/*					$('form').attr("onsubmit",true);
					$this.click();
*/					$('form').get(0).reset();
				}else if(data==1){
					$("label[for='remember']").text("用户名或密码错误");
					$("label[for='remember']").css('color','red');
				}else if(data==2){
					$("label[for='remember']").text("账户被锁定");
					$("label[for='remember']").css('color','red');
				}else{
					$("label[for='remember']").text("系统错误");
					$("label[for='remember']").css('color','red');
				}
			}
		});
	})
});