				<section class="content-header">
					<h1>
						<i class="fa fa-users"></i> 
						게시판
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i> Home</a></li>
						<li>게시판 관리</li>
						<li class="active">
						글작성d
						</li>
					</ol>
				</section>
				<section class="content">
					<form id="board-regist-form" class="form-horizontal">
					<input type="hidden" name="bc_code" id="bc_code" value="" />
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">게시물 내용</h3>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">제목</label>
													<div class="col-xs-11">
														<input type="text" class="form-control" id="b_subject" name="b_subject" required />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">작성자</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_name" name="b_name" value="<?=$this->session->userdata('u_name')?>" placeholder="작성자를 입력하세요" required />
													</div>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">등록일</label>
													<div class="col-xs-10">
														<input type="text" class="daterange form-control" id="b_regdate" name="b_regdate" value="<?=date('Y-m-d', time())?>"  />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">연락처</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_phone" name="b_phone" value="<?=$this->session->userdata('u_phone')?>" placeholder="연락처를 입력하세요" />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">내용</label>
													<div class="col-xs-11">
														<textarea class="ckeditor form-control" id="b_content" name="b_content" required rows="10" style="resize: none;" placeholder="내용을 입력하세요"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">첨부파일</h3>
									</div>
									<div class="box-body file-layer">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">첨부파일</label>
													<div class="col-xs-7">
														<input type="file" name="b_files[]" />
														<p class="help-block">파일크기: 640 MB, 확장자: PDF, PPT, ZIP, JPG, GIF, PNG</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="box-footer text-right">
										<div class="btn-file-add btn btn-primary">첨부파일 추가</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<button class="btn btn-success">저장</button>
								<div class="btn-cancel btn btn-danger">취소</div>
								<a href="/admin/board/lists/<?=$current_board?>"><div class="btn btn-default">목록</div></a>
							</div>
						</div>
					</form>
				</section>
				<script>
					$(function(){

						$('.daterange').daterangepicker({
							singleDatePicker: true,
							timePicker: false,
							timePickerIncrement: 30,
							timePicker12Hour: false,
							format: 'YYYY-MM-DD'
						});
						
						
						$('.btn-file-add').click(function(){
							var html = '<div class="row">';
								html += '<div class="col-xs-12">';
								html += '<div class="form-group">';
								html += '<label class="col-xs-1 control-label">첨부파일</label>';
								html += '<div class="col-xs-7">';
								html += '<input type="file" name="b_files[]" />';
								html += '<p class="help-block">파일크기: 2 MB, 확장자: PDF, PPT, ZIP, JPG, GIF, PNG</p>';
								html += '</div>';
								html += '<div class="col-xs-4">';
								html += '<div class="btn-file-delete btn btn-danger">삭제</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
							
							$('.file-layer').append(html);
						});
						
						$('.file-layer').on('click', '.btn-file-delete', function(){
							$(this).closest('.row').remove();
						});
						
						$('#board-regist-form').submit(function(e){
							e.preventDefault();
							
							var data1 = CKEDITOR.instances.b_content.getData();
							$('#b_content').val(data1);
							
							$(this).ajaxSubmit({
								url: '/api/board/add',
								type: 'post',
								datatype: 'json',
								error: function(e) { return false; },
								success: function(d) {
									var data = $.parseJSON(d);
									
									if ( data.result ) {
										alert('게시물이 저장되었습니다');
										window.location.replace('/board/lists');
									} else {
										alert(data.message);
										return false;
									}
								}
							});
						});
						
						$('.btn-cancel').click(function(){
							$('#board-regist-form')[0].reset();
						})
					});
				</script>