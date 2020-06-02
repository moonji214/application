				<style>
					tr.highlight { background-color: #222D32 !important; color: #FFF; cursor: pointer; }
					.table { table-layout: fixed; }
					.table td, th { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
					.btn-modify:hover { color: #00a65a; }
					.btn-delete:hover { color: #dd4b39; }
				</style>
				<section class="content-header">
					<h1>
						<i class="fa fa-users"></i> 
						
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i>프로그램등록</a></li>
						<li class="active">
							</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-6">
							<div class="box">
								<div class="box-body">
									<table id="board-list" class="table table-bordered table-striped">
										<colgroup>
											<col width="20%" />
											<col width="55%"/>
											<col width="25%" />
											
										</colgroup>
										<thead>
											<tr>
												<th class="text-center">번호</th>
												<th class="text-center">프로그램명</th>
												<th class="text-center">상위 메뉴</th>	
											</tr>
										</thead>
									</table>	
									<a href="/board/regist"><button class="btn btn-success">등록</button></a>
								</div>
							</div>
						</div>
					</div>
				</section>
				<script type="text/javascript">
					$(function(){
						var table=$("#board-list").DataTable({
							'language': {
								'url': 'http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Korean.json'
							},
							'processing': true,
							'serverSide': true,
							'bAutoWidth': false,
							'responsive': true,
							'info': false,
							'bLengthChange': false,
							'ajax': {
								'url': '/api/conf/lists',
								'type': 'post'
							},
							'pageLength': 10,
							"order": [[ 0, 'DESC' ]],
							'aoColumns': [
								{ 'bSortable': false, 'sName': 'm_seq', 'data': 'no', 'sClass': 'board text-center' },
								{ 'sName': 'p_name', 'data': 'p_name', 'sClass': 'board b_subject text-center' },
								{ 'sName': 'p_parent', 'data': 'p_parent', 'sClass': 'board b_subject text-center' }
							]

							
						});
						
						$('#board-list tbody').on('mouseover', 'td', function(){
							$(this).parent().addClass('highlight');
						}).on('mouseleave', 'td', function(){
							$(this).parent().removeClass('highlight');
						});
						
						$('#board-list tbody').on('click', '.board', function(){
							var idx = $(this).parents('tr').attr('id');
							window.location.href = '/board/view/' + idx;
						});

						
						$('#board-list tbody').on('click', '.btn-delete', function(){
							var name = $(this).parents('tr').find('.b_subject').text();
							var idx = $(this).parents('tr').attr('id');
							
							if ( confirm(name + ' �Խù��� �����Ͻðڽ��ϱ�?') ) {
								$.ajax({
									url: '/api/board/del',
									type: 'post',
									datatype: 'json',
									data: { b_idx: idx },
									success: function(d){
										var data = $.parseJSON(d);
										
										if ( data.result ) {
											alert('�Խù��� �����Ǿ����ϴ�');
											table.ajax.reload(null, false);
										} else {
											alert(data.message);
										}
									}
								});
							}
						});
					});
				</script>