<style type="text/css">
    #overlay{
        position : fixed;
        top : 0;
        bottom : 0;
        left : 0;
        right:0;
        background: rgba(0,0,0,0.6);
    }
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
<div id="app">
	<div class="container-fluid">
		<div class="row bg-dark">
			<div class="col-lg-12">
			<p class="text-center text-light display-4 pt-2" style="font-size:25px;">CRUD Application</p>
			</div>
		</div> 
	</div>
	<div class="container">
		<div class="row mt-3">
			<div class="col-lg-6">
				<h3 class="text-info">
			 	Registered users	
				</h3>
				<div class="col-lg-6">
					<button class="btn btn-info float-right" @click="showAddModal=true">
						<i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Add new user
					</button>
				</div>
			</div>
			
			<hr class="bg-info">
			<div class="alert alert-danger" v-if="errorMsg">에러</div>
			<div class="alert alert-success" v-if="successMsg" >성공</div>
			
			<!--  테이블 시작 -->
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered table-striped">
    					<thead>
    						<tr class="text-center bg-info text-light">
    							<th>ID</th>
    							<th>Name</th>
    							<th>Email</th>
    							<th>Phone</th>
    							<th>Edit</th>
    							<th>Delete</th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr class="text-center">
    							<td>1</td>
    							<td>가나다라</td>
    							<td>이름</td>
    							<td>1231</td>
    							<td><a href="#" class="text-success"><i class="fas fa-edit"></i></a></td>
    							<td><a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
    						</tr>
    						<tr class="text-center">
    							<td>2</td>
    							<td>가나다라</td>
    							<td>이름</td>
    							<td>1231</td>
    							<td><a href="#" class="text-success"><i class="fas fa-edit"></i></a></td>
    							<td><a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
    						</tr>
    						<tr class="text-center">
    							<td>3</td>
    							<td>가나다라</td>
    							<td>이름</td>
    							<td>1231</td>
    							<td><a href="#" class="text-success"><i class="fas fa-edit"></i></a></td>
    							<td><a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
    						</tr>
    					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<!--  modal -->
	<div id="overlay" v-if="showAddModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New User</h5>
					<button type="button" class="close" @click="showAddModal=false">
						<span aria-hidden="true">닫기</span>
					</button>
				</div
				<div class="modal-body p-4">
    				<form action="#" method="post">
    					<div class="form-group">
    						<input type="text" name="name" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<input type="email" name="email" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<input type="tel" name="phone" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<button class="btn btn-info btn-block btb-lg" @click="showAddModal=false">
    							Add new user
    						</button>
    					</div>
    				</form>
				</div>
			</div>
		</div>
	</div>
	<!-- edit modal -->
	<!--  <div id="overlay" v-if="showEditModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">업데이트 유저</h5>
					<button type="button" class="close" @click="showEditModal=false">
						<span aria-hidden="true">close</span>
					</button>
				</div
				<div class="modal-body p-4">
    				<form action="#" method="post">
    					<div class="form-group">
    						<input type="text" name="name" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<input type="email" name="email" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<input type="tel" name="phone" class="form-control form-control-lg">
    					</div>
    					<div class="form-group">
    						<button class="btn btn-info btn-block btb-lg" @click="showEditModal=false">
    							업데이트
    						</button>
    					</div>
    				</form>
				</div>
			</div>
		</div>
	</div>-->
	
</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
var app = new Vue({
   		el : '#app',
   		data : {
			errorMsg : false,
			successMsg : false,
			showAddModal : false,
			showEditModal : false
   		}
});

</script>