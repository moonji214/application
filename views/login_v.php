<!DOCTYPE html>
<html class="bg-black">
<head>
	<meta charset="UTF-8">
	<title>mjh시스템 - 로그인</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
	<link href="/assets/style/AdminLTE.css" rel="stylesheet" type="text/css" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
		
	<!--[if !IE]> -->
	   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<!-- <![endif]-->
	<!--[if IE]>
	   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/script/common.js"></script>
</head>
<body class="bg-black">
	<div class="form-box" id="login-box">
		<div class="header">사용자 로그인</div>
		<form id="login-form">
			<div class="body bg-gray">
				<div class="form-group">
					<input type="text" name="id" class="form-control" placeholder="사용자 아이디" value="<?=$this->input->cookie('id')?>" required />
				</div>
				<div class="form-group">
					<input type="password" name="pw" class="form-control" placeholder="사용자 비밀번호" required />
				</div>
				<div class="form-group">
					<input type="checkbox" name="account_remember" value="Y"<? if ( $this->input->cookie('id') ) { echo ' checked'; }?> /> 계정 기억하기
				</div>
			</div>
			<div class="footer">
				<button type="submit" class="btn bg-olive btn-block">로그인하기</button>
			</div>
		</form>
	</div>
	<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loading" aria-hidden="true">
		<div class="modal-dialog text-center">
			<i class="fa fa-spin fa-cog" style="font-size: 150px;"></i>
		</div>
	</div>
	<script>
		$(function(){
			$('#login-form').submit(function(e){
				e.preventDefault();
				
				$.ajax({
					url: '/api/account/login',
					type: 'post',
					datatype: 'json',
					data: $(this).serialize(),
					success: function(d){
						var data = $.parseJSON(d);
						
						if ( data.result ) {
							window.location.replace('/board/lists');
						} else {
							alert( data.message );
						}
					}
				})
				
				return false;
			});
		});
	</script>
</body>
</html>