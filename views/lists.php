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
						<?if ($current_board == 'notice' ){
								echo '공지사항';
							}else if ($current_board == 'faq' ){
								echo 'FAQ';
							}else if ($current_board == 'datalists' ){
								echo '전시회 관련 자료실';
							}?>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i> Home</a></li>
						<li class="active">
							<?if ($current_board == 'notice' ){
								echo '공지사항';
							}else if ($current_board == 'faq' ){
								echo 'FAQ';
							}else if ($current_board == 'datalists' ){
								echo '전시회 관련 자료실';
							}?></li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12 text-right" style="margin-bottom: 10px;">
							<a href="/admin/board/regist/<?=$current_board?>"><div class="btn btn-success">글등록</div></a>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<table id="board-list" class="table table-bordered table-striped">
										<colgroup>
											<col width="10%" />
											<col />
											<col width="15%" />
											<col width="15%" />
											<col width="15%" />
										</colgroup>
										<thead>
											<tr>
												<th class="text-center">번호</th>
												<th class="text-center">제목</th>
												<th class="text-center">작성자</th>
												<th class="text-center">등록일</th>
												<th class="text-center">수정 / 삭제</th>
											</tr>
										</thead>
									</table>
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
								'url': '/admin/api/board/lists/<?=$current_board?>',
								'type': 'post'
							},
							'pageLength': 15,
							"order": [[ 0, 'DESC' ]],
							'aoColumns': [
								{ 'bSortable': false, 'sName': 'b_regdate', 'data': 'no', 'sClass': 'text-center' },
								{ 'sName': 'b_subject', 'data': 'b_subject', 'sClass': 'b_subject text-left' },
								{ 'sName': 'b_regdate', 'data': 'b_name', 'sClass': 'text-center' },
								{ 'sName': 'b_regdate', 'data': 'b_regdate', 'sClass': 'text-center' },
								{ 'bSortable': false, 'target': -1, 'data': null, 'defaultContent': '<span class="btn-modify">수정</span> / <span class="btn-delete">삭제</span>', 'sClass': 'text-center' }
							],

							'columnDefs': [
											{
												
												render: function (data, type, row) {
													if( row.b_reply == null ){ 
														return row.b_subject ; 
														}else{
														return  '<img src="/assets/image/board_reply.png" />' +' ' + '&nbsp;' + row.b_subject ;																	
													}
												},
												targets: 1
											}
										]	


							
						});
						
						$('#board-list tbody').on('mouseover', 'td', function(){
							$(this).parent().addClass('highlight');
						}).on('mouseleave', 'td', function(){
							$(this).parent().removeClass('highlight');
						});
						
						$('#board-list tbody').on('click', '.btn-modify', function(){
							var idx = $(this).parents('tr').attr('id');
							window.location.href = '/admin/board/modify/<?=$current_board?>/' + idx;
						});

						$('#board-list tbody').on('click', 'td', function(){
							var idx = $(this).parents('tr').attr('id');
							window.location.href = '/admin/board/modify/<?=$current_board?>/' + idx;
						});
						
						$('#board-list tbody').on('click', '.btn-delete', function(){
							var name = $(this).parents('tr').find('.b_subject').text();
							var idx = $(this).parents('tr').attr('id');
							
							if ( confirm(name + ' 게시물을 삭제하시겠습니까?') ) {
								$.ajax({
									url: '/admin/api/board/del',
									type: 'post',
									datatype: 'json',
									data: { b_idx: idx },
									success: function(d){
										var data = $.parseJSON(d);
										
										if ( data.result ) {
											alert('게시물이 삭제되었습니다');
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