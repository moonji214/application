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
											<div class="container">
												<button v-on:click="upvotes++">
													투표! {{upvotes}}
												</button>
											</div>
											<div class="container2">
												<h1>2개숫자를 입력해주세요.</h1>
												<form class="form-inline">
													<input v-model.number="a" class="form-control">
    													<select v-model="operator" class="form-control">
    														<option>+</option>
    														<option>-</option>
    														<option>*</option>
    														<option>/</option>
    													</select>
													<input v-model.number="b" class="form-control">
												 	<button type="submit" @click="calculate" class="btn btn-primary">
												 		계산기
													</button>
												</form>
												<h2>
													결과 : {{a}}   {{operator}}  {{b}} = {{c}} 
												</h2>
												<pre>
													{{$data}}
												</pre>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>				
			</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.js"></script>								
<script type="text/javascript">

new Vue({
	el : '.container' ,
	data : {
			upvotes : 0
		}
})

new Vue({
	el : '.container2' ,
	data : {
			a: 1,
			b: 2,
			c: null,
			operator: "+",
		},
		methods : {
			calculate : function() {
				event.preventDefault();
				switch (this.operator){
				case "+":
					this.c = this.a + this.b
					break;
				case "-":
					this.c = this.a - this.b
					break;	
				case "*":
					this.c = this.a * this.b
					break;
				case "/":
					this.c = this.a / this.b
					break;		
				} 
			}
		},


})

</script>