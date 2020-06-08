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
											<col width="15%" />
											<col width="43%"/>
											<col width="25%" />
											<col width="17%" />
										</colgroup>
										<thead>
											<tr>
												<th class="text-center">번호</th>
												<th class="text-center">프로그램명</th>
												<th class="text-center">메뉴</th>	
												<th class="text-center">정렬순서</th>	
											</tr>
										</thead>
									</table>
									<!--  내용 시작 -->
									<form id="menu-form" class="form-horizontal" >
									<input type="hidden" name="form_status" id="form_status" value="save" />
									<input type="hidden" name="m_seq"  id="m_seq"  value="" />
									<div class="box form-horizontal" >
    									<div class="box-body">
        									<div class="row">
        											<div class="col-xs-10">
        												<div class="form-group">
        													<label class="col-xs-3 control-label">프로그램명</label>
        													<div class="col-md-9">
        														<input type="text" class="form-control" id="p_name" name="p_name"  placeholder="프로그램명을 입력해주세요." />
        													</div>
        												</div>
        											</div>
        									</div>
        									<div class="row">
        										<div class="col-xs-10">
        											<div class="form-group">
        												<label class="col-xs-3 control-label">메뉴</label>
        													<div class="col-md-9">
        														<input type="text" class="form-control" id="p_parent" name="p_parent" value="" placeholder="상위메뉴을 입력해주세요." />
        													</div>
        											</div>
        										</div>
        									</div>
        									<div class="row">
        										<div class="col-xs-10">
        											<div class="form-group">
        												<label class="col-xs-3 control-label">정렬순서</label>
        													<div class="col-xs-3">
        														<input type="text" class="form-control" id="p_no" name="p_no" value="" placeholder="번호를 입력해주세요." />
        													</div>
        											</div>
        										</div>
        									</div>
        									<div class="row">
        										<div class="col-xs-10">
        											<div class="form-group">
        											<label class="col-xs-3 control-label">뎁스</label>
        												<div class="col-xs-2 col-sm-3 col-md-3">
        												<select name="p_depth" id="p_depth" class="form-control">
															<option value="0" selected>상위</option>
															<option value="1">1</option>
															<option value="2">2</option>
														</select>
														</div>
													</div>
        										</div>
        									</div>		
														
        									<div class="row">
        										<div class="col-xs-10">
        											<div class="form-group">
        												<label class="col-xs-3 control-label">사용여부</label>
        													<div class="col-xs-5">
        														<input type="radio" name="p_use" id="p_use" value="Y" /><label for="n">사용</label>
        														<input type="radio" name="p_use" id="p_nuse" value="N" /><label for="n">미사용</label>
        													</div>
        											</div>
        										</div>
        									</div>
        													
    									</div>	
									</div>		
									<div class="text-right">
										<button class="btn-menu-add btn btn-warning" >신규등록</button>&nbsp;&nbsp;&nbsp;
										<button class="btn btn-success" data="save">저장</button>
									</div>
									</form>
								<!--  폼태그 종료 -->
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
								{ 'sName': 'p_parent', 'data': 'p_parent', 'sClass': 'board b_subject text-center' },
								{ 'sName': 'p_no', 'data': 'p_no', 'sClass': 'board b_subject text-center' }
							]

							
						});
						
						$('#board-list tbody').on('mouseover', 'td', function(){
							$(this).parent().addClass('highlight');
						}).on('mouseleave', 'td', function(){
							$(this).parent().removeClass('highlight');
						});

						
						 // 신규등록 클릭시
								$('.btn-menu-add').click(function(e){
									e.preventDefault();
									$('#menu-form')[0].reset();	
								});
								
					//  메뉴클릭시 메뉴정보 가져옴		
						$('#board-list tbody').on('click', '.board', function(){
							var idx = $(this).parents('tr').attr('id');

							if ( idx != undefined ) {
								$.ajax({
									url: '/api/conf/menu_view/'+idx,
									type: 'post',
									datatype: 'json',
									//data: { 'p_idx': calEvent.idx },
									success: function(d) {
										var data = $.parseJSON(d);
										if ( ! data.result ) {
											alert(data.message);
										} else {											
										//  데이터 매핑 
										
											$('#menu-form').find('#p_name').val(data.p_name);
											$('#menu-form').find('#m_seq').val(data.m_seq);		//시퀀스
											$('#menu-form').find('#p_parent').val(data.p_parent);	//부모메뉴
											$('#menu-form').find('#form_status').val("save");
											$('#menu-form').find('#p_no').val(data.p_no);	//정렬넘버
											$('#menu-form').find('#p_depth').prop("checked", true);
											
											if (data.p_use == 'Y'){
												$('#menu-form').find('#p_use').prop("checked", true);
											}else{
												$('#menu-form').find('#p_nuse').prop("checked", true);
											}
										//	$('#item-modify-form').find('#bigo').val(data.bigo);					
																											

											}
										}
									});
								

								}


							
						});



						$('#menu-form').submit(function(d){
							d.preventDefault();
					// 저장 버튼 클릭시 
							switch ( $('#form_status').val() ) {
								
								case 'send' :
									datasend();
								break;

								
								case 'save' :
								// 
										$('#menu-form').ajaxSubmit({
											url: '/api/conf/menu_save',
											type: 'post',
											datatype: 'json',
											error: function(e) { return false; },
											success: function(d) {
												var data = $.parseJSON(d);
												
												if ( data.result ) {
													window.location.reload();
												} else {
													alert( data.message );
												}
											}
										});
									//datainsert();
								break;
								case 'delete' :
									
											$('#item-modify-form').ajaxSubmit({
												url: '/api/quarter_manu/pack_del',
												type: 'post',
												datatype: 'json',
												error: function(e) { return false; },
												success: function(d) {
													var data = $.parseJSON(d);
													
													if ( data.result ) {
														alert('�룷�옣�떒�쐞媛� �궘�젣�릺�뿀�뒿�땲�떎.');
															window.location.reload();
													} else {
														alert( data.message );
													}
												}
											});
								break;

								
							}
						})
						
						
					});
				</script>