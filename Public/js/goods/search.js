
function init() {
	
    var clip = new ZeroClipboard.Client();
    clip.setHandCursor( true );
    clip.setCSSEffects( true );
    clip.addEventListener( 'mouseDown', function(client){
      clip.setText( $('#inviteContent').val() );
    });
    clip.addEventListener( 'complete', function(){alert('复制成功');});
    clip.glue( 'copycardid' );
}

function chk(id){
	var obj = document.getElementsByName(id); // 选择所有name="'test'"的对象，返回数组
	// 取到对象数组后，我们来循环检测它是不是被选中
	var s = '';
	for ( var i = 0; i < obj.length; i++) {
		if (obj[i].checked)
			s += obj[i].value + ' '; // 如果选中，将value添加到变量s中
	}
	// 那么现在来检测s的值就知道选中的复选框的值了
	return s;
} 

$(function(){
	$(':checkbox[name=pingbao]').each(function() {
		$(this).click(function() {
			if ($(this).attr('checked')) {
				$(':checkbox[name=pingbao]').removeAttr('checked');
				$(this).attr('checked', 'checked');
			}
		});
	});
	
	$(':checkbox[name=kuaidi]').each(function() {
		$(this).click(function() {
			if ($(this).attr('checked')) {
				$(':checkbox[name=kuaidi]').removeAttr('checked');
				$(this).attr('checked', 'checked');
			}
		});
	});
}); 

function doSubmit(){

	var error = $("#error").val();
	var content = $("#content").val();

	if(error=="" || error==null){

		alert("请填写报错");
		return false;
		}
	if(content=="" || content==null){
		alert("请生成错误内容");
		return false;
		}
	return true;
}
