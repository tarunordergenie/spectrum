<template>
    <div class="admin">
       <Header />
        <section class="login-section ">
         <div class="set-header">
            <img src="public/assets/img/header1.jpg">
            <div class="set-text">
               <h2 class="htext _h2"> <span>Users</span></h2>
               <!-- <a href="patient-assessment.html" class="btn btn-info  btn-lg hasicon"><span class="thum"><img src="public/assets/img/arrow.svg" /></span> Start New Assessment</a> -->
            </div>
         </div>
         <div class="container-fluid set-questions">
            <div class="row">
               <div class="col-md-12">
               </div>
            </div>
         </div>
         <div class="inner bgwhite  ">  <!--paddingtop-20   paddingbot-20 i reomoved-->
            <div class="container-fluid set-questions">
               <div class="row">
                  <div class="col-md-9">
                      <br />
                     <h3 class="h3">Users   <a href="#changedate" data-toggle="modal"  class="btn btn-sm btn-primary"> Add</a> </h3> 
                  </div>
                  <div class="col-md-3">
                     <!-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search&hellip;">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default">Go</button>
                        </span>
                     </div> -->
                     <br />
                     <a :href="'/'+this.$foldername+'/#/dashboard'"   class="btn btn-sm btn-info pull-right"> Back</a>
                     <br />
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table class="table mytable">
                           <thead>
                              <tr>
                                 <td>Users ID</td>
                                 <td><span class="bleft">Full Name</span> </td>
                                 <td><span class="bleft">Email</span></td>
                                 <td><span class="bleft">Role</span></td>
                                 <td><span class="bleft">Province</span></td>
                                 <td><span class="bleft">City</span></td>
                                 <td><span class="bleft"> Language</span></td>
                                 <td><span class="bleft"> Edit</span></td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr v-for="(user, index) in users">
                                 <td>{{index+1}}</td>
                                 <td><span class="bleft2">{{user.name}}</span></td>
                                 <td><span class="bleft2">{{user.email}}</span></td>

                                 <td v-if="user.role=='1'"><span class="bleft2">Admin</span></td>
                                 <td v-if="user.role=='2'"><span class="bleft2">Doctor</span></td>
                                 <td v-if="user.role=='3'"><span class="bleft2">Demo</span></td>

                                 <td><span class="bleft2">{{user.Province_Name}}</span> </td>
                                 <td><span class="bleft2">{{user.City_Name}}</span> </td>
                                 <td><span class="bleft2 center">{{user.language}}</span></td>
                                 <td><span class="bleft2 center">
                                    <button type="buttton" href="#changedate2" data-toggle="modal"  @click="editPop(user.id)"   class="btn btn-primary">Edit</button>
                                    </span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
<!--  modal   -->

    <!-- <div id="presurvey" class="modal  fade  "> -->
<div id="changedate" class="modal  fade  mymodal">
      <div class="modal-dialog">
         <div class="modal-content ">
            <div class="modal-header">
               <button type="button" class="close active" data-dismiss="modal"   aria-hidden="true">X</button> 
               <h3 class="modal-title h3">Add Doctor </h3>
            </div>
            <div class="modal-body">
               <form>
                    
                    <div class="form-group">
                        <label for="pwd">Role:</label>
                        <select v-model="role" class="form-control">
                              <option value="">Select Role</option>
                              <option value="1">admin</option>
                              <option value="2">doctor</option>
                              <option value="3">demo</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="pwd">Name:</label>
                        <input type="text"  v-model="Name" class="form-control" >
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">Email:</label>
                        <input type="text" class="form-control"  v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Province:</label>
                        <!-- <input type="text" class="form-control"  v-model="email"> -->
                        <select class="form-control" v-model="province" @change="fetchCity" >
                           <option value="">Select Province</option>
                           <option v-for="province in provinceData" :value="province.Province_ID"     >{{province.Province_Name}}</option>

                        </select>
                    </div>
                     <div class="form-group">
                        <label for="pwd">City:</label>
                        <select class="form-control" v-model="city">
                           <option value="">Select City</option>
                           <option v-for="city in cityData" :value="city.City_ID">{{city.City_Name}}</option>

                           
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">Date Of Webinar:</label>
                        <input type="date" class="form-control"  v-model="dateWeb">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="text" class="form-control"  v-model="password">
                    </div>
                    <div class="form-group">
                        <label for="email">Language:</label>
                        <select class="form-control" v-model="language">
                            <option value="">Select Language</option>
                            <option>en</option>
                            <option>fr</option>
                        </select>
                    </div>
                    <div class="form-group">
                       <div v-if="right" class="alert alert-success">{{msg}}</div>
                       <div v-if="wrong" class="alert alert-danger">{{msg}}</div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer text-center"> 
               <button type="button" class="btn btn-info" @click="addUser"   >Add</button>
            </div>
            
         </div>
      </div>
   </div>

   <div id="changedate2" class="modal  fade  mymodal">
      <div class="modal-dialog">
         <div class="modal-content ">
            <div class="modal-header">
               <button type="button" class="close active" data-dismiss="modal"   aria-hidden="true">X</button> 
               <h3 class="modal-title h3">Edit Doctor </h3>
            </div>
            <div class="modal-body">
               <form>

                     <div class="form-group">
                        <label for="pwd">Role:</label>
                        <select v-model="edit.role" class="form-control">
                              <option value="">Select Role</option>
                              <option value="1">admin</option>
                              <option value="2">doctor</option>
                              <option value="3">demo</option>
                        </select>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="pwd">Name:</label>
                        <input type="text"  v-model="edit.name" class="form-control" >
                    </div>
                    <!-- <div class="form-group"> -->
                        <!-- <label for="pwd">Email:</label> -->
                        <input type="hidden" class="form-control"  v-model="edit.email">
                    <!-- </div> -->
                    <div class="form-group">
                        <label for="pwd">Province:</label>
                        <!-- <input type="text" class="form-control"  v-model="email"> -->
                        <select class="form-control" v-model="edit.province" @change="fetchCityEdit" >
                           <option value="">Select Province</option>
                           <option  v-for="province in provinceData" :value="province.Province_ID">{{province.Province_Name}}</option>

                        </select>
                    </div>
                     <div class="form-group">
                        <label for="pwd">City:</label>
                        <select class="form-control" v-model="edit.city">
                           <option value="">Select City</option>
                           <option  v-for="city in cityData" :value="city.City_ID">{{city.City_Name}}</option>

                           
                        </select>
                    </div> 
                    
                    <div class="form-group">
                        <label for="pwd">Date Of Webinar:</label>
                        <input type="date" class="form-control"  v-model="edit.dateWeb">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="text" class="form-control"  v-model="edit.password">
                    </div>
                    <div class="form-group">
                        <label for="email">Language:</label>
                        <select class="form-control" v-model="edit.language">
                            <option value="">Select Language</option>
                            <option >en</option>
                            <option >fr</option>
                        </select>
                    </div>
                    <div class="form-group">
                       <div v-if="rightEdit" class="alert alert-success">Doctor Updated Successfully</div>
                       <div v-if="wrongEdit" class="alert alert-danger">{{msg}}</div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer text-center"> 
               <button type="button" class="btn btn-info" @click="editUser"   >Edit</button>
            </div>
            
         </div>
      </div>
   </div>
   



<!-- end modal   -->

      
   <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
   <!-- Core JavaScript Files -->
    </div>
</template>
<script>

    import Header from '../components/includes/HeaderComponent';

export default {
      components:{
         Header
      },
     data(){
         return{
            email:'',
            province:'',
            city:'',
            password:'',
            role:'',
            dateWeb:'',
            language:'',
            Name:'',
            wrong:false,
            users:[],
            right:false,
            msg:'',
            provinceData:[],
            cityData:[],
            user_id:localStorage.getItem('user_id'),
            rightEdit:false,
            wrongEdit:false,
            edit:{

            },
            urole:localStorage.getItem('role'),
         }
         
      },
      mounted(){
                 this.fetchUsers();
                 this.fetchProvince();
                 this.fetchCity();
      },
      methods : {
         editPop(id){
            axios.post('api/getDoctorEditData', {
                  'id':id
               })
            .then(res => {
               console.log('Edit-Data',res);
                     res.data.user.password='';  
                     this.edit = res.data.user
                           axios.post('api/getCity', {
                                    'province_id':res.data.user.province
                              })
                           .then(res => {
                                 console.log('>>>>>>>>>>c',res);
                                 this.city='';
                              if (!Array.isArray(res.data.city)) {
                                   this.cityData.push(res.data.city);
                              } else {
                                 this.cityData = res.data.city;
                              }
                           })
                           .catch(err => {
                                 console.log('errrrrr-',err);
                           })
                              
            })
            .catch(err => {
               console.log('errrrrr-',err);
            });

               
         },
         editUser(){
            // console.log('yes',this.edit);
               this.wrong=false;
               this.right=false;
                axios.post('api/updateDoctor', {
                        'data':this.edit,
                    })
                    .then(response => {
                        if(response.data.res ==false){
                           console.log('ressss');
                            this.wrongEdit=true;
                            this.rightEdit=false;
                            this.msg='No change ';
                            this.fetchUsers();
                            console.log('ok',response);
                        }else{
                              console.log('ssssss');
                              this.rightEdit=true;
                              this.wrongEdit=false;
                              this.msg=response.data.msg;
                              this.fetchUsers();
                              this.email='';
                              this.province='';
                              this.city='';
                              this.password='';
                              this.dateWeb='';
                              this.language='';
                              this.Name='';
                              this.users=[];
                              this.msg='';
                              this.cityData=[];
                        }
                        
                        setTimeout(function(){
                           this.rightEdit=false;
                           this.wrongEdit=false;
                           this.wrong=false;
                           this.right=false;
                           $("#changedate2").modal('hide');
                           
                        },3000);
                    })
                    .catch(err => {
                        this.wrong=true;
                        this.msg='something Went Wrong';
                        console.log('errrrrr-',err);
                    });

                    setTimeout(() => {
                        this.wrongEdit=false;
                        this.rightEdit=false;
                        this.msg='';
                    }, 5000);
                    

         },
         fetchProvince(){
                axios.get('api/getProvince', {
                       })
                    .then(res => {
                        console.log('>>>>>>>>>>p',res);
                        if (!Array.isArray(res.data.province)) {
                        this.provinceData.push(res.data.province);
                      } else {
                        this.provinceData = res.data.province;
                      }
                    })
                    .catch(err => {
                        console.log('errrrrr-',err);
                    });

         },
         fetchCityEdit(){
            
            axios.post('api/getCity', {
                           'province_id':this.edit.province
                       })
                    .then(res => {
                        // console.log('>>>>>>>>>>c',res);
                        this.city='';
                        if (!Array.isArray(res.data.city)) {
                        this.cityData.push(res.data.city);
                      } else {
                        this.cityData = res.data.city;
                      }
                    })
                    .catch(err => {
                        console.log('errrrrr-',err);
                    })
         },
         fetchCity(){
            axios.post('api/getCity', {
                           'province_id':this.province
                       })
                    .then(res => {
                        // console.log('>>>>>>>>>>c',res);
                        this.city='';
                        if (!Array.isArray(res.data.city)) {
                        this.cityData.push(res.data.city);
                      } else {
                        this.cityData = res.data.city;
                      }
                    })
                    .catch(err => {
                        console.log('errrrrr-',err);
                    })
         },
            fetchUsers(){
               axios.post('api/getUsers', {
                        'user_id':this.user_id,
                        'role':this.urole
                       })
                    .then(res => {
                       console.log('>>>>>>>>>>users',res);
                        if (!Array.isArray(res.data.result)) {
                        this.users.push(res.data.result);
                      } else {
                        this.users = res.data.result;
                      }
                    })
                    .catch(err => {
                        console.log('errrrrr-',err);
                    })
                    
            },
            addUser(){
               //   $('#changedate').hide();

                     if(this.role==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please select role';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }
                     if(this.name==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please enter name';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }
                     

                     if(this.email==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please enter email';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }
                     if(this.password==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please enter password';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }

                     if(this.province==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please select province';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }

                     if(this.dateWeb==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please select date of webinar';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }

                     if(this.city==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please select city';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }

                     if(this.language==''){
                           this.wrong=true;
                           this.right=false;
                           this.msg='Please select language';
                           return;
                     }else{
                           this.wrong=true;
                           this.right=false;
                           this.msg='';                        
                     }

                  this.wrong=false;
                  this.right=false;
                axios.post('api/register', {
                        'email':this.email,
                        'password':this.password,
                        'role':this.role,
                        'dateWeb':this.dateWeb,
                        'province':this.province,
                        'city':this.city,
                        'name':this.Name,
                        'language':this.language,
                        'user_id':this.user_id
                    })
                    .then(response => {
                        if(response.data.status == false){
                            this.wrong=true;
                            this.right=false;
                            this.msg=response.data.msg;
                            console.log('no',response);
                        }else{
                            console.log('yes',response);
                           this.right=true;
                           this.wrong=false;
                           this.msg=response.data.msg;
                           this.fetchUsers();
                           this.email='';
                           this.province='';
                           this.city='';
                           this.password='';
                           this.dateWeb='';
                           this.language='';
                           this.Name='';
                           this.role='';
                           this.users=[];
                           this.cityData=[];
                        }
                    })
                    .catch(err => {
                        this.wrong=true;
                        this.msg='something Went Wrong';

                        console.log('errrrrr-',err);


                    });
                    setTimeout(() => {
                        this.wrong=false;
                        this.right=false;
                        this.msg='';
                    }, 5000);

            }
      }
}
</script>
<style scoped>

</style>