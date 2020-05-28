				<style>
					tr.highlight { background-color: #222D32 !important; color: #FFF; cursor: pointer; }
					.table { table-layout: fixed; }
					.table td, th { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
					.btn-modify:hover { color: #00a65a; }
					.btn-delete:hover { color: #dd4b39; }
				</style>
				<section class="content-header">
					<h1>
						<i class="fa fa-users"></i> Member Manage
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-users"></i> Home</a></li>
						<li>user</li>
						<li class="active">user search</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<br/>
									<div class="row">
										<form id="searchForm" name="searchForm" method="post" action="<?=$searchForm['action_url']?>">
											<input type="hidden" name="record_start" value="<?=$searchForm['record_start']?>">
											
											<div class="col-xs-12">
											
												<table class="table table-bordered table-striped">
													<body>
														<tr>
															<th class="text-center" rowspan="2"><h3>Search</h3></th>
															<th class="text-center">ID</th>
															<td class="text-center">
																<input type="hidden" name="search_field3" value="<?=$searchForm['search_field3']?>">
																<input type="text" class="form-control" name="search_word3" id="search_word3" onkeyup="enterkey();" value="<?=$searchForm['search_word3']?>">
															</td>
															<th class="text-center">Name</th>
															<td class="text-center">
																<input type="hidden" name="search_field2" value="<?=$searchForm['search_field2']?>">
																<input type="text" class="form-control" name="search_word2" id="search_word2" onkeyup="enterkey();" value="<?=$searchForm['search_word2']?>">
															</td>
															<th class="text-center" rowspan="2"  style="padding-top:30px;">
																<div id="btn-searchlist" class="btn btn-default">Search</div>
															</th>
														</tr>									
														<tr>
															
															<th class="text-center">Email</th>
															<td class="text-center">
																<input type="hidden" name="search_field1" value="<?=$searchForm['search_field1']?>">
																<input type="text" class="form-control" name="search_word1" id="search_word1" onkeyup="enterkey();" value="<?=$searchForm['search_word1']?>">
															</td>
															<th class="text-center">Phone</th>
															<td class="text-center">
																<input type="hidden" name="search_field4" value="<?=$searchForm['search_field4']?>">
																<input type="text" class="form-control" name="search_word4" id="search_word4" onkeyup="enterkey();" value="<?=$searchForm['search_word4']?>">
															</td>
														</tr>
													</body>
												</table>
												
											</div>
										</form>
									</div>
									<br><br>
									<div class="row">
										<div class="col-xs-12">
											<table id="member-list" class="table table-bordered table-striped">
												<colgroup>
													<col width="5%" />
													<col width="10%" />
													<col width="10%" />
													<col width="*%" />
													<col width="30%" />													
													<col width="10%" />
												</colgroup>
												<thead>										
													<tr>
														<th class="text-center">NO</th>
														<th class="text-center">ID</th>
														<th class="text-center">NAME</th>														
														<th class="text-center">EMAIL</th>
														<th class="text-center">PHONE</th>
														<th class="text-center">DELETE FLAG</th>
													</tr>
												</thead>
												<tbody>	
												<?
													$board_num = (int)$request['total_record']-(int)$request['record_start'];							
													foreach($request['data'] as $key => $value) {
												?>
														<tr id="<?=$value['idx']?>">
															<td class="text-center"><?=$board_num?></td>
															<td class="text-center"><?=$value['id']?></td>
															<td class="text-center"><?=$value['u_name']?></td>															
															<td class="text-center"><?=$value['u_email']?></td>
															<td class="text-center"><?=$value['u_phone']?></td>	
															<td class="text-center"> <? if ( $value['u_delete'] == 'Y' ) { echo '<font color="green">Delete user</font>';} else { echo '<font color="blue">Using</font>';}  ?></td>													
															<!--  <th class="text-center"><a href="javascript:memberLogin('<?=$value['u_id']?>','<?=$value['u_password']?>');" class="btn btn-success">접속</a></th>-->
														</tr>
												<?
														$board_num = $board_num+1;
													} 
												?>
																							
												</tbody>
											</table>
											
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>				
			</section>						
				<script type="text/javascript">
				function enterkey() {
			        if (window.event.keyCode == 13) {
			             // 엔터키가 눌렸을 때 실행할 내용
			        	$('#searchForm').submit();
			        }
				}



				
					$(function () {
						
						$('#btn-searchlist').click(function(){
							$('#searchForm').submit();
						});
						
						
						$('#member-list tbody').on('mouseover', 'td', function(){
							$(this).parent().addClass('highlight');
						}).on('mouseleave', 'td', function(){
							$(this).parent().removeClass('highlight');
						});
						
						$('#member-list tbody').on('click', 'td', function(){
							var idx = $(this).parents('tr').attr('id');
							if ( idx != undefined ) {
								
								$('#searchForm').attr('action','/member/user_view/' + idx);
								$('#searchForm').submit();
							}
						});						

					});
				</script>