				<section class="content-header">
					<h1>
						<i class="fa fa-users"></i> 사용자관리
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i> Home</a></li>
						<li>사용자</li>
						<li class="active">정보조회</li>
					</ol>
				</section>
				<section class="content">
					<form id="member-modify-form" class="form-horizontal">
					<input type="hidden" name="idx" id="idx" value="<?=$member['idx']?>" />
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">사용자 조회</h3>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">아이디</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="id" name="id" value="<?=$member['id']?>" placeholder="�옉�꽦�옄瑜� �엯�젰�븯�꽭�슂" required readonly />
													</div>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">삭제여부</label>
													<div class="col-xs-10 control-label" style="text-align: left;">
														<input type="radio" name="u_delete" value="Y"<? if ( $member['u_delete'] == 'Y' ) { echo ' checked'; } ?> /> 삭제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<input type="radio" name="u_delete" value="N"<? if ( $member['u_delete'] != 'Y' ) { echo ' checked'; } ?> /> 사용중
														
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">사용자</br>이름</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="u_name" name="u_name" value="<?=$member['u_name']?>" required />
													</div>
												</div>
											</div>
											
										</div>
										
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">핸드폰번호</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="u_phone" name="u_phone" value="<?=$member['u_phone']?>" placeholder="�씠硫붿씪�쓣 �엯�젰�븯�꽭�슂" />
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">이메일</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" id="u_email" name="u_email" value="<?=$member['u_email']?>" placeholder="�씠硫붿씪�쓣 �엯�젰�븯�꽭�슂" />
													</div>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label class="col-xs-2 control-label">패스워드</label>
													<div class="col-xs-10">
														<input type="text" class="form-control" readonly id="pw" name="pw" value="<?=$member['pw']?>" placeholder="鍮꾨�踰덊샇瑜� �엯�젰�븯�꽭�슂" />
													</div>
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-4 text-right">
									<div class="btn-delete btn btn-danger">회원삭제</div>
							</div>
							<div class="col-xs-8 text-right">
								<button class="btn btn-success">저장</button>&nbsp;&nbsp;&nbsp;
								<div id="btn-lists" class="btn btn-default">목록</div>
							</div>
						</div>
						
					</form>
					
					<form id="searchForm" name="searchForm" method="post" action="/member/user_lists">
						<input type="hidden" name="record_start"  value="<?=$searchForm['record_start']?>">
						<input type="hidden" name="search_field1" value="<?=$searchForm['search_field1']?>">
						<input type="hidden" name="search_word1"  value="<?=$searchForm['search_word1']?>">
						<input type="hidden" name="search_field2" value="<?=$searchForm['search_field2']?>">
						<input type="hidden" name="search_word2"  value="<?=$searchForm['search_word2']?>">
						<input type="hidden" name="search_field3" value="<?=$searchForm['search_field3']?>">
						<input type="hidden" name="search_word3"  value="<?=$searchForm['search_word3']?>">
						<input type="hidden" name="search_field4" value="<?=$searchForm['search_field4']?>">
						<input type="hidden" name="search_word4"  value="<?=$searchForm['search_word4']?>">
					</form>
		
				</section>
				<script>
					$(function(){

						// 회원정보저장 
						$('#member-modify-form').submit(function(e){
							e.preventDefault();
							
							if ( confirm($('#u_name').val() + '정보를 수정하시겠습니까?') ) {
								$.ajax({
									url: '/api/member/set',
									type: 'post',
									data: $(this).serialize(),
									datatype: 'json',
									success: function(d) {
										var data = $.parseJSON(d);
										
										if ( data.result ) {
											alert('수정이 완료 되었습니다.');
											$('#searchForm').attr('action','/member/user_view/<?=$member['idx']?>');
											$('#searchForm').submit();
										} else {
											alert( data.message );
											return false;
										}
									}
								});
							}
						});
						
						//목록
						$('#btn-lists').click(function(){
							$('#searchForm').attr('action','/member/user_lists');
							$('#searchForm').submit();	
						});
						
						//회원정보 삭제처리 
						$('.btn-delete').click(function(){
							var name = '<?=$member['u_name']?>';
							var idx = '<?=$member['idx']?>';
							
							if ( confirm(name + '정보를 삭제하시겠습니까?') ) {
								$.ajax({
									url: '/api/member/del',
									type: 'post',
									datatype: 'json',
									data: { idx: idx },
									success: function(d){
										var data = $.parseJSON(d);
										
										if ( data.result ) {
											alert('삭제되었습니다.');
											$('#btn-lists').click();
										} else {
											alert(data.message);
										}
									}
								});
							}
						});

	
					});
				</script>