				<section class="content-header">
					<h1>
						<i class="fa fa-users"></i> 
						
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i> Home</a></li>
						<li>게시판</li>
						<li class="active">
						조회
						</li>
					</ol>
				</section>
				<section class="content">
					<form id="board-modify-form" class="form-horizontal">
					<input type="hidden" name="b_idx" id="b_idx" value="<?=$board['b_idx']?>" />
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">게시판조회</h3>
									</div>
									<div class="box-body">
											<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">제목</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_subject" name="b_subject" value="<?=$board['b_subject']?>" placeholder="제목을 입력해주세요." />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">작성자</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_name" name="b_name" value="<?=$board['b_name']?>" placeholder="�옉�꽦�옄瑜� �엯�젰�븯�꽭�슂" required />
													</div>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">작성일자</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_regdate" name="b_regdate" value="<?=$board['b_regdate']?>" required  />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">연락처</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="b_phone" name="b_phone" value="<?=$board['b_phone']?>" placeholder="연락처를 입력해주세요." />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">내용</label>
													<div class="col-xs-11">
														<textarea class="form-control" id="b_content" name="b_content" required rows="10" style="resize: none;" placeholder="내용을 입력해주세요."><?=$board['b_content']?></textarea>
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
										<? if ( ! empty($board['b_files']) ) { ?>
										<? foreach ( $board['b_files'] as $key => $val) { ?>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">첨부파일</label>
													<div class="col-xs-7">
														<a href="/uploads/board_<?=$board['bc_code']?>/<?=$val['name']?>" target="_blank"><?=$val['original_name']?></a>
														<p class="help-block">파일사이즈: <?=$val['size']?> KB&nbsp;&nbsp;&nbsp;<input type="checkbox" name="b_filedel[]" value="<?=$key?>" /> </label></p>
													</div>
												</div>
											</div>
										</div>
										<? } } ?>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="col-xs-1 control-label">첨부파일</label>
													<div class="col-xs-7">
														<input type="file" name="b_files[]" />
														<p class="help-block">파일사이즈: 640 MB, 파일유형: PDF, PPT, ZIP, JPG, GIF, PNG</p>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<div class="box-footer text-right">
										<div class="btn-file-add btn btn-primary">파일등록</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 text-right">
								<button class="btn btn-success">저장</button>
								<div class="btn-cancel btn btn-danger">취소</div>
								<a href="/board/lists/"><div class="btn btn-default">목록</div></a>
							</div>
						</div>
					</form>
				</section>
				<script>
					$(function(){
						CKEDITOR.replace('b_content', {
							autoUpdateElement : true,
							enterMode: CKEDITOR.ENTER_BR
						});
						
						$('.btn-file-add').click(function(){
							var html = '<div class="row">';
								html += '<div class="col-xs-12">';
								html += '<div class="form-group">';
								html += '<label class="col-xs-1 control-label">泥⑤��뙆�씪</label>';
								html += '<div class="col-xs-7">';
								html += '<input type="file" name="b_files[]" />';
								html += '<p class="help-block">�뙆�씪�겕湲�: 2 MB, �솗�옣�옄: PDF, PPT, ZIP, JPG, GIF, PNG</p>';
								html += '</div>';
								html += '<div class="col-xs-4">';
								html += '<div class="btn-file-delete btn btn-danger">�궘�젣</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';

							
							$('.file-layer').append(html);
						});
						
						$('.file-layer').on('click', '.btn-file-delete', function(){
							$(this).closest('.row').remove();
						});
						
						$('#board-modify-form').submit(function(e){
							e.preventDefault();

							var data1 = CKEDITOR.instances.b_content.getData();
							$('#b_content').val(data1);
							
							$(this).ajaxSubmit({
								url: '/api/board/set',
								type: 'post',
								datatype: 'json',
								error: function(e) { return false; },
								success: function(d) {
									var data = $.parseJSON(d);
									
									if ( data.result ) {
										alert('저장이 완료되었습니다.');
										location.reload();
									} else {
										alert(data.message);
										return false;
									}
								}
							});
						});
						
						$('.btn-cancel').click(function(){
							$('#board-modify-form')[0].reset();
						})
					});
				</script>