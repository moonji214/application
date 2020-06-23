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
												
													<tr v-for="contact in contacts">
														<td>{{contact.b_idx}} </td>
														<td>{{contact.b_name}} </td>
														<td>{{contact.b_subject}} </td>
													</tr>	
																				
												</tbody>
											</table>
											
										</div>
									</div>

</div>				
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>	
 <script src="https://unpkg.com/vue"></script>-->

<script>
var app = new Vue({
	el : "#app",
	data : {
		b_idx: '',
		b_name: '',
		b_subject: '',
	    contacts: []
	},
	 mounted: function () {
		    //console.log('Hello from Vue!')
		    this.getContacts()
		  },

		  methods: {
		    //getContacts: function(){
		    //},
			  getContacts: function(){
				    axios.get('/api/order/vue_test')
				    .then(function (response) {
				        console.log(response.data);
				        app.contacts = response.data;

				    })
				    .catch(function (error) {
				        console.log('에러입니다.');
				    });
				}

		    
		   // createContact: function(){
		   // },
		  //  resetForm: function(){
		  //  }
		  }

});


$(function () {
	
	$('#member-list tbody').on('mouseover', 'td', function(){
		$(this).parent().addClass('highlight');
	}).on('mouseleave', 'td', function(){
		$(this).parent().removeClass('highlight');
	});
	
});

</script>