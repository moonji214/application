<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MJH</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/morris/morris.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- <link href="/assets/plugin/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" /> -->
		<link href="/assets/style/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugin/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
		
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
		   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<![endif]-->
	
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js" type="text/javascript"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="/assets/plugin/morris/morris.min.js" type="text/javascript"></script>
		<script src="/assets/plugin/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
		<script src="/assets/plugin/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
		<script src="/assets/plugin/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
		<script src="/assets/plugin/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<!-- <script src="/assets/plugin/datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script> -->
		<script src="/assets/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<script src="/assets/plugin/iCheck/icheck.min.js" type="text/javascript"></script>
		<script src="/assets/plugin/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="/assets/plugin/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<script src="/assets/plugin/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>		
		<script src="/assets/script/app.js" type="text/javascript"></script>
		<script src="//cdn.ckeditor.com/4.5.1/full/ckeditor.js"></script>
		<script src="/assets/plugin/jqueryForm/jquery.form.js" type="text/javascript"></script>
		<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
		
		<style>
		.jbStart {display:none ;}
		</style>
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			<header class="main-header">
				<a href="#" class="logo">내블로그</a>
				<nav class="navbar navbar-static-top" role="navigation">
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="btn-logout"><span class="hidden-xs">마이블로그</span></a>
							</li>
							<li class="dropdown user user-menu">
								<a href="#" class="btn-logout"><span class="hidden-xs">로그아웃</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="left-side">
				<section class="sidebar">
					<div class="user-panel">
						<div class="pull-left info">
							<p></p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<ul class="sidebar-menu">
						<li class="header">MAIN NAVIGATION</li>
						
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-table"></i> <span>게시판</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<? $base_filename = basename($_SERVER['PHP_SELF']); 
							?>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="lists" ||$base_filename =="view"  ) { echo ' class="active"'; } ?>><a href="/board/lists"><i class="fa fa-angle-double-right"></i>리스트</a></li>
								<li<? if ($base_filename =="my_lists" ||$base_filename =="my_view"  ) {echo ' class="active"'; } ?>><a href="/board/my_lists"><i class="fa fa-angle-double-right"></i>마이게시판</a></li>
							</ul>
						</li>
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-users"></i> <span>사용자</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<? $base_filename = basename($_SERVER['PHP_SELF']); 
							?>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="user_lists" ||$base_filename =="user_view"  ) { echo ' class="active"'; } ?>><a href="/member/user_lists"><i class="fa fa-angle-double-right"></i>리스트</a></li>
							</ul>
						</li>
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-table"></i> <span>메뉴설정</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<? $base_filename = basename($_SERVER['PHP_SELF']); 
							?>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="menu" ) { echo ' class="active"'; } ?>><a href="/conf/menu"><i class="fa fa-angle-double-right"></i>프로그램등록</a></li>
							</ul>
						</li>		
						
						<li class="treeview active">
							<a href="#">
								<i class="fa fa-mortar-board"></i> <span>신청서</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<? $base_filename = basename($_SERVER['PHP_SELF']); 
							?>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="order_lists" ||$base_filename =="order_view"  ) { echo ' class="active"'; } ?>><a href="/order/order_lists"><i class="fa fa-angle-double-right"></i>리스트</a></li>
							</ul>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="vue_list" ||$base_filename =="vue_view"  ) { echo ' class="active"'; } ?>><a href="/order/vue_list"><i class="fa fa-angle-double-right"></i>뷰테스트</a></li>
							</ul>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="vue_list2" ||$base_filename =="vue_view"  ) { echo ' class="active"'; } ?>><a href="/order/vue_list2"><i class="fa fa-angle-double-right"></i>뷰테스트2</a></li>
							</ul>
							<ul class="treeview-menu">
								<li<? if ($base_filename =="vue_list3" ||$base_filename =="vue_view"  ) { echo ' class="active"'; } ?>><a href="/order/vue_list3"><i class="fa fa-angle-double-right"></i>뷰테스트2</a></li>
							</ul>
						</li>				
					</ul>
				</section>
			</aside>
			<div class="content-wrapper">
				<?=$contents?>
				<? if ( $base_filename =="menu"){?>
					<?=$modal?>
				<?}?>
			</div>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					
				</div>
				
			</footer>
		</div>
		<script>
			$(function(){
				$('.btn-logout').click(function(){
					$.ajax({
						url: '/api/account/logout',
						datatype: 'json',
						success: function(d){
							var data = $.parseJSON(d);
							
							if ( data.result ) {
								window.location.replace('/');
							} else {
								alert( data.message );
							}
						}
					});
				});
			});
			
		</script>
	</body>
</html>