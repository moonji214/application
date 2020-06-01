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
									<div id="app">
										<table class="table tbale-striped">
											<tr>
												<th>#</th>
												<th>Plot</th>
												<th>Wirter</th>
												<th>Upvotes</th>
												<th>Actions</th>
											</tr>
											<tr v-for="story in stories" is="story" :story="story"></tr>
										</table>
										<template id="template-story-raw">
											<tr>
												<td>
												{{story.id}}
												</td>
												<td>
    												<span>
    													{{story.plot}}
    												</span>
												</td>
												<td>
													<span>
														{{story.writer}}
													</span>
												</td>
												<td>
													{{story.upvotes}}
												</td>
											</tr>
										</template>
										<p class="lead"> 여기다 </p>
										<pre>{{ $data }}</pre>
										
									</div>
								</div>
							</div>
						</div>
					</div>				
			</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.js"></script>
<!--  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>	-->							
<script type="text/javascript">

Vue.component('story', {
	 template : "#template-story-raw",
	 props : ['story'],
});


var vm = new Vue({
	el : '#app',
	data : {
		stories: []
	},
	mounted : function() {
		$.get('/api/stories', function(data){
			vm.stories = data;
		})
	}
})

</script>