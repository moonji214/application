

				<section class="text-center">
						<ul class="pagination">
							<?
							$link_count=5;
							if($searchForm['record_start'] == 0){
								$current_page=1;
							}else{
								$current_page=((int)$searchForm['record_start']/(int)$searchForm['record_count'])+1;
							}
							
							$group=floor((int)$searchForm['record_start']/((int)$searchForm['record_count']*$link_count));
							
							
							if( (int)$searchForm['total_record'] > (int)$searchForm['record_count'] ){
								if((int)$searchForm['total_page']>1 && ((int)$searchForm['record_start'] != 0)){
									$pre_page_start=(int)$searchForm['record_start'] - (int)$searchForm['record_count']; 
							?>
									
									<li class="paginate_button previous">
										<a href="javascript:S_List('<?=$searchForm['search_field1']?>','<?=$searchForm['search_field2']?>','<?=$searchForm['search_field3']?>','<?=$searchForm['search_field4']?>','<?=$searchForm['search_field5']?>','<?=$searchForm['search_field6']?>','<?=$searchForm['search_word1']?>','<?=$searchForm['search_word2']?>','<?=$searchForm['search_word3']?>','<?=$searchForm['search_word4']?>','<?=$searchForm['search_word5']?>','<?=$searchForm['search_word6']?>','0')">처음</a>
									</li>						
									<li class="paginate_button previous">
										<a href="javascript:S_List('<?=$searchForm['search_field1']?>','<?=$searchForm['search_field2']?>','<?=$searchForm['search_field3']?>','<?=$searchForm['search_field4']?>','<?=$searchForm['search_field5']?>','<?=$searchForm['search_field6']?>','<?=$searchForm['search_word1']?>','<?=$searchForm['search_word2']?>','<?=$searchForm['search_word3']?>','<?=$searchForm['search_word4']?>','<?=$searchForm['search_word5']?>','<?=$searchForm['search_word6']?>','<?=$pre_page_start?>')">이전</a>
									</li>
									
							<?	
								}else{
							?>
									<li class="paginate_button previous disabled">	
										<a>처음</a>
									</li>
									<li class="paginate_button previous disabled">
										<a>이전</a>
									</li>
							<?					
								}
								for($i=0; $i<$link_count; $i++) {
							    	$input_start=($group*$link_count+$i)*(int)$searchForm['record_count'];
									$link=($group*$link_count+$i)+1;
													
									if($input_start<(int)$searchForm['total_record']){
										if($input_start!=(int)$searchForm['record_start']){		?>
											<li class="paginate_button">
												<a href="javascript:S_List('<?=$searchForm['search_field1']?>','<?=$searchForm['search_field2']?>','<?=$searchForm['search_field3']?>','<?=$searchForm['search_field4']?>','<?=$searchForm['search_field5']?>','<?=$searchForm['search_field6']?>','<?=$searchForm['search_word1']?>','<?=$searchForm['search_word2']?>','<?=$searchForm['search_word3']?>','<?=$searchForm['search_word4']?>','<?=$searchForm['search_word5']?>','<?=$searchForm['search_word6']?>','<?=$input_start?>')"><?=$link?></a>
											</li>
							<?    
							            }else{ 
							?>
											<li class="paginate_button active">
											<a><?=$link?></a>
											</li>
							<?			}
									}
								}
								
								if((int)$searchForm['total_page']>1 && ((int)$searchForm['record_start']!= ((int)$searchForm['total_page']*(int)$searchForm['record_count']-(int)$searchForm['record_count']))){
									$next_page_start = (int)$searchForm['record_start']+(int)$searchForm['record_count'];
									$end_page_start = (((int)$searchForm['total_page']-1)*(int)$searchForm['record_count']); 
									?>
									<li class="paginate_button next">	
										<a href="javascript:S_List('<?=$searchForm['search_field1']?>','<?=$searchForm['search_field2']?>','<?=$searchForm['search_field3']?>','<?=$searchForm['search_field4']?>','<?=$searchForm['search_field5']?>','<?=$searchForm['search_field6']?>','<?=$searchForm['search_word1']?>','<?=$searchForm['search_word2']?>','<?=$searchForm['search_word3']?>','<?=$searchForm['search_word4']?>','<?=$searchForm['search_word5']?>','<?=$searchForm['search_word6']?>','<?=$next_page_start?>')">다음</a>
									</li>
									<li class="paginate_button next">
										<a href="javascript:S_List('<?=$searchForm['search_field1']?>','<?=$searchForm['search_field2']?>','<?=$searchForm['search_field3']?>','<?=$searchForm['search_field4']?>','<?=$searchForm['search_field5']?>','<?=$searchForm['search_field6']?>','<?=$searchForm['search_word1']?>','<?=$searchForm['search_word2']?>','<?=$searchForm['search_word3']?>','<?=$searchForm['search_word4']?>','<?=$searchForm['search_word5']?>','<?=$searchForm['search_word6']?>','<?=$end_page_start?>')"> 끝 </a>
									</li>
							<?
								}else{
							?>
									<li class="paginate_button next disabled">	
										<a>다음</a>
									</li>
									<li class="paginate_button next disabled">
										<a> 끝 </a>
									</li>
							<?
								}
							}  
							?>
						</ul>
				</section>


 <form name="frmSList" method="post" action='<?=$searchForm['action_url']?>'>
	<input type="hidden" name="search_field1">
	<input type="hidden" name="search_field2">
	<input type="hidden" name="search_field3">
	<input type="hidden" name="search_field4">
	<input type="hidden" name="search_field5">
	<input type="hidden" name="search_field6">
	<input type="hidden" name="search_word1">
	<input type="hidden" name="search_word2">
	<input type="hidden" name="search_word3">
	<input type="hidden" name="search_word4">
	<input type="hidden" name="search_word5">
	<input type="hidden" name="search_word6">
	<input type="hidden" name="record_start">
</form>

<script language="JavaScript">

function S_List(strKey1,strKey2,strKey3,strKey4,strKey5,strKey6,strKey7,strKey8,strKey9,strKey10,strKey11,strKey12,strKey13) {
   frmSList.search_field1.value = strKey1;
   frmSList.search_field2.value = strKey2;
   frmSList.search_field3.value = strKey3;
   frmSList.search_field4.value = strKey4;
   frmSList.search_field5.value = strKey5;
   frmSList.search_field6.value = strKey6;
   frmSList.search_word1.value = strKey7;   
   frmSList.search_word2.value = strKey8;
   frmSList.search_word3.value = strKey9;   
   frmSList.search_word4.value = strKey10;
   frmSList.search_word5.value = strKey11;
   frmSList.search_word6.value = strKey12;
   frmSList.record_start.value = strKey13;

   frmSList.submit();
}

</script>