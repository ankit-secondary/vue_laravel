<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">products Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">Add New <i class="fa fa-product-plus fa-fw"></i></button>
                </div>
              </div>

              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
						<th>Status</th>
                        <th>Image</th>
                        <th>Description</th>
						<th>Created At</th>
                  </tr> 

                  <tr v-for="product in products" v-bind:key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.category }}</td>
                    <td>{{ product.price}}</td>
				    <td>{{ product.status}}</td>
					<td>{{ product.image}}</td>
				    <td>{{ product.description}}</td>
                    <td>{{ product.created_at | formatDate}}</td>

                    <td>
                        <a href="#" data-id="product.id" @click="editModalWindow(product)">
                            <i class="fa fa-edit"></i>
                        </a>
                        |
                        <a href="#" @click="deleteproduct(product.id)">
                            <i class="fa fa-trash "></i>
                        </a>

                    </td>
                  </tr>
                </tbody></table>
              </div>

              <div class="card-footer">

              </div>
            </div>

          </div>
        </div>


            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">

                    <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New product</h5>
                    <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update product</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

<form @submit.prevent="editMode ? updateproduct() : createproduct()">
<div class="modal-body">
     <div class="form-group">
        <input v-model="form.name" type="text" name="name"
            placeholder=" Product Name"
            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
        <has-error :form="form" field="name"></has-error>
    </div>

     <div class="form-group">
        <input v-model="form.status" type="text" name="status"
            placeholder="status"
            class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
        <has-error :form="form" field="status"></has-error>
    </div>


    <div class="form-group">
        <input v-model="form.price" type="text" name="price" id="price" placeholder="Enter price"
        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
        <has-error :form="form" field="price"></has-error>
    </div>

	 <div class="form-group">
        <input v-model="form.description" type="text" name="description" id="description" placeholder="Enter description"
        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
        <has-error :form="form" field="description"></has-error>
    </div>

    <div class="form-group">
        <select name="category" v-model="form.category" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('category') }">
            <option value="" disabled selected hidden>Select product category</option>
            <option value="Men's Clothes"> Men's Clothes</option>
			<option value=" Women's Clothes"> Women's Clothes</option>
			<option value="Kid's Clothes"> Kid's Clothes</option>
            <option value="Electronics">Electronics</option>
			<option value="Furnitures">Furnitures</option>
			<option value="Men's Shoes">Men's Shoes</option>
			<option value="Women's Shoes"> Women's Shoes</option>
			<option value="Kid's Shoes"> Kid's Shoes</option>
			<option value="Bags">Bags</option>
			<option value="Watches">Watches</option>
			
        </select>
        <has-error :form="form" field="category"></has-error>
    </div>

	 <div class="form-group">
        <input type="file"  @change='upload_image'  name="image" id="image" placeholder="Select image"
        class="form-control" :class="{ 'is-invalid': form.errors.has('image') }">
        <has-error :form="form" field="image"></has-error>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
    <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
</div>

</form>

                </div>
            </div>
            </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                products: {},
                form: new Form({
					id:'',
                    name: '',
                    status : '',
                    price: '',
                    description: '',
					image: '',
					category: '',

                })
            }
        },

     
        methods: {

        

        editModalWindow(product){
           this.form.clear();
           this.editMode = true
           this.form.reset();
           $('#addNew').modal('show');
           this.form.fill(product)
        },

         loadproducts() {

        axios.get("/products").then( data => (this.products = data.data));
      

        },


        updateproduct(){
           this.form.put('/products/update/'+this.form.id)
               .then(()=>{

                   Toast.fire({
                      icon: 'success',
                      title: 'product updated successfully'
                    })

                    Fire.$emit('AfterCreatedproductLoadIt'); 

                    $('#addNew').modal('hide');
                    this.loadproducts();
               })
               .catch(()=>{
                  console.log("Error.....")
               })
        },

        openModalWindow(){

           this.editMode = false
           this.form.reset();
           $('#addNew').modal('show');
        },

       

        createproduct(){

          

            this.form.post('/products/create')
                .then(() => {

                        Toast.fire({
                          icon: 'success',
                          title: 'product created successfully'
                        })

                
                       $('#addNew').modal('hide');
                        
                     axios.get("/products").then( data => (this.products = data.data));

                })
                .catch(() => {
                   console.log("Error......")
                })

            
		  },
		  
		  upload_image(e){
              let file = e.target.files[0];
                let reader = new FileReader();  

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.form.image = reader.result;
                    }              
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            },
          deleteproduct(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

              if (result.value) {
                //Send Request to server
                this.form.delete('/products/destroy/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Deleted!',
                              'product deleted successfully',
                              'success'
                            )
                    this.loadproducts();

                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        })
                    })
                }

            })
          }
        },

        created() { //Like Mounted this method
            this.loadproducts();

            Fire.$on('AfterCreatedproductLoadIt',()=>{ //custom events fire on
                this.loadproducts();
            });

            // setInterval(() => 
            //     this.loadproducts()
            // ,3000); //Every 3 seconds loadproducts call
        }
    }
</script> 