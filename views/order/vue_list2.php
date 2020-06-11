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
				<div id="example" class="container layout1">
					<p><input type="text" v-model="amount"  class="form-control" /> </p>
					<p>
						<button id="deposit" v-on:click="balance += parseInt(amount)"  class="btn btn-primary" >예금</button>
						<button id="withdraw" v-on:click="balance -= parseInt(amount)" class="btn btn-primary">인출</button>
					</p>
					<h3>계좌잔고 : {{balance}}</h3>
				</div>
				
					<main>
                        <div class="container">
                            <h1>Stories</h1>
                            <div id="v-app">
                                <table class="table table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Plot</th>
                                        <th>Writer</th>
                                        <th>Upvotes</th>
                                        <th>Actions</th>
                                    </tr>
                                    <tr v-for="story in stories" :key="story.id" is="story" :story="story"></tr>
                                </table>
                                <p class="lead">Here's a list of all your stories.
                                    <button @click="createStory()" class="btn btn-primary">Add a new one?</button>
                                </p>
                                <pre>{{ $data }}</pre>
                            </div>
                        </div>
                    </main>
<template id="template-story-raw">
    <tr>
        <td>
            {{story.id}}
        </td>
        <td class="col-md-6">
            <input v-if="story.editing" v-model="story.plot" class="form-control">
            <!--in other occasions show the story plot-->
            <span v-else>
                {{story.plot}}
            </span>
        </td>
        <td>
            <input v-if="story.editing" v-model="story.writer" class="form-control">
            <!--in other occasions show the story writer-->
            <span v-else>
                {{story.writer}}
            </span>
        </td>
        <td>
            {{story.upvotes}}
        </td>
        <td>
            <div class="btn-group" v-if="!story.editing">
                <button @click="upvoteStory(story)" class="btn btn-primary">Upvote</button>
                <button @click="editStory(story)" class="btn btn-default">Edit</button>
                <button @click="deleteStory(story)" class="btn btn-danger">Delete</button>
            </div>
            <div class="btn-group" v-else>
                <!--If the story is taken from the db then it will have an id-->
                <button v-if="story.id" class="btn btn-primary" @click="updateStory(story)">Update Story</button>
                <!--If the story is new we want to store it-->
                <button v-else class="btn btn-success" @click="storeStory(story)">Save New Story</button>
                <!--Always show cancel-->
                <button @click="story.editing=false" class="btn btn-default">Cancel</button>
            </div>
        </td>
    </tr>
</template>
</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.js"></script>
<script src='/js/app.js' type="text/javascript"></script>
<script src='https://unpkg.com/vue/dist/vue.min.js' ></script>
<!--  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>	-->							
<script type="text/javascript">
var wm = new Vue({
	el : "#example",
	data : {
		amount  : 0 ,
		balance : 0 ,
	}
	
})

Vue.component('story', {
    template: '#template-story-raw',
    props: ['story'],
    methods: {
        deleteStory: function (story) {
            var index = this.$parent.stories.indexOf(story);
            this.$parent.stories.splice(index, 1)
            this.$http.delete('/api/stories/' + story.id)
        },
        upvoteStory: function (story) {
            story.upvotes++;
            this.$http.patch('/api/order/lists' , story)
        },
        editStory: function (story) {
            story.editing = true;
        },
        updateStory: function (story) {
            this.$http.patch('/api/stories/' + story.id, story)
            //Set editing to false to show actions again and hide the inputs
            story.editing = false;
        },
        storeStory: function (story) {
            this.$http.post('/api/stories/', story).then(function (response) {
                /*
                After the the new story is stored in the database fetch again all stories with
                vm.fetchStories();
                Or Better, update the id of the created story
                */
                Vue.set(story, 'id', response.data.id);

                //Set editing to false to show actions again and hide the inputs
                story.editing = false;
            });
        },
    }
})

new Vue({
    el: '#v-app',
    data: {
        stories: [],
        story: {}
    },
    mounted: function () {
        this.fetchStories()
    },
    methods: {
        createStory: function () {
            var newStory = {
                plot: "",
                upvotes: 0,
                editing: true
            };
            this.stories.push(newStory);
        },
        fetchStories: function () {
            var vm = this;
            this.$http.get('/api/order/listsd')
                .then(function (response) {
                    // set data on vm
                    var storiesReady = response.data.map(function (story) {
                        story.editing = false;
                        return story
                    })
                    Vue.set(vm, 'stories', storiesReady)
                });
        },
    }
});
</script>