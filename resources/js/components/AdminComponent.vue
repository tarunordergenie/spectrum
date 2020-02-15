<template>
    <div class="admin">
         <Header />
        <section class="login-section ">
         <div class="set-header">
            <img src="public/assets/img/header1.jpg">
            <div class="set-text">
               <h2 class="htext _h2"> <span>Admin Tools</span></h2>
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
                     <a :href="'/'+this.$foldername+'#/dashboard'"   class="btn btn-sm btn-info pull-right"> Back</a>
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
                                 <td><span class="bleft">Province</span></td>
                                 <td><span class="bleft">City</span></td>
                                 <td><span class="bleft"> Language</span></td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr v-for="(user, index) in users">
                                 <td>{{index+1}}</td>
                                 <td><span class="bleft2">{{user.name}}</span></td>
                                 <td><span class="bleft2">{{user.email}}</span></td>
                                 <td><span class="bleft2">{{user.Province_Name}}</span> </td>
                                 <td><span class="bleft2">{{user.City_Name}}</span> </td>
                                 <td><span class="bleft2 center">{{user.language}}</span></td>
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
               <h3 class="modal-title h3">Add Client </h3>
            </div>
            <div class="modal-body">
               <form>
                    
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
                           <option v-for="province in provinceData" :value="province.Province_ID">{{province.Province_Name}}</option>

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
                       <div v-if="right" class="alert alert-success">Client Added Successfully</div>
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
<!-- end modal   -->

      
   <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <!-- -->
   
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
            role:'client',
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

         }
         
      },
      mounted(){
                 this.fetchUsers();
                 this.fetchProvince();
                 this.fetchCity();
      },
      methods : {
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
                    })
         },
         fetchCity(){
            axios.post('api/getCity', {
                           'province_id':this.province
                       })
                    .then(res => {
                        console.log('>>>>>>>>>>c',res);
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
                              'user_id':'1',
                              'role':'client',
                       })
                    .then(res => {
                     //   console.log('>>>>>>>>>>',res);
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
                 $('#changedate').hide();
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
                       
                        if(response.data.status !='failed'){
                            this.wrong=true;
                            this.right=false;
                           this.msg=response.data.msg;
                           this.fetchUsers();
                            console.log('ok',response);


                        }else{
                            this.right=true;
                            this.wrong=false;
                            
                           this.msg=response.data.msg;
                           // console.log('faiel',response);
                           this.fetchUsers();
                                       this.email='';
                                       this.province='';
                                       this.city='';
                                       this.password='';
                                       this.dateWeb='';
                                       this.language='';
                                       this.Name='';
                                       this.wrong=false;
                                       this.users=[];
                                       this.right=false;
                                       this.msg='';
                                       this.cityData=[];

                        }



                    })
                    .catch(err => {
                        this.wrong=true;
                        this.msg='something Went Wrong';

                        console.log('errrrrr-',err);


                    })
            }
      }
}
</script>
<style scoped>

</style>