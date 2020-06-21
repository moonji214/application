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
<div id="app"> 
			<div class="row">
										<div class="col-xs-12">
											<table id="member-list" class="table table-bordered table-striped">
												<colgroup>
													<col width="5%" />
													<col width="10%" />
													<col width="*%" />
												
												</colgroup>
												<thead>										
													<tr>
														<th class="text-center">NO</th>
														<th class="text-center">ID</th>
														<th class="text-center">NAME</th>														
													
													</tr>
												</thead>
												<tbody>	
												
													<tr v-for="post in posts">
														<td>{{post.b_idx}} </td>
														<td>{{post.b_name}} </td>
														<td>{{post.b_subject}} </td>
													</tr>	
																				
												</tbody>
											</table>
											
										</div>
									</div>
	
	<!--  <div v-for="post in posts">
		<h3>{{post.b_idx}}</h3>
		<p> {{post.b_name}}</p>
		<p> {{post.b_subject}}</p>
	</div>-->
</div>				
</section>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>	
<script src="https://unpkg.com/vue"></script>
<script type="text/javascript">
var wm = new Vue({
	el : "#app",
	data : {
		posts  : []
	},
	created() {
		//fetch('https://jsonplaceholder.typicode.com/posts/1')
		 fetch('/api/order/vue_test')
			.then((response) => {
				if(response.ok){
					return response.json();
				}
				throw new error('네트워크 에러');
			})
			.then((json) => {
				this.posts.push({
					b_idx: json.b_idx,
					b_name: json.b_name,
					b_subject: json.b_subject,
				});
			})
			.catch((error ) =>{
				console.log(error);
			});
	}
		
	
});
</script>