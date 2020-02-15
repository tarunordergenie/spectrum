<template>
   <div class="profile">
      <Header />
      <section class="login-section ">
         <div class="set-header">
            <img src="public/assets/img/header.jpg">
            <div class="set-text">
               <h2 class="htext _h2">{{this.$lang.text_21[llanguage]}}</h2>
               <a :href="'/'+this.$foldername+'/#/dashboard'" class="btn btn-dafult btn_reset"><i class="fa fa-angle-left"></i> {{this.$lang.text_36[llanguage]}}</a>

            </div>
         </div>
         <div class="container-fluid set-questions">
            <div class="row">
               <div class="col-md-12">
                  <div class="que_top">Profile</div>
               </div>
            </div>
            <div class="col-md-12">
               <center>
                  <h3>Update Profile</h3>
               </center>
                  <div class="row form-group">
                     <div class="col-md-6">
                        <label for="fname">{{this.$lang.text_18[llanguage]}}</label>
                        <input type="text" id="name" name="name" v-model="edit.name" class="form-control input-lg">
                     </div>
                     <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email"  v-model="edit.email" disabled  class="form-control input-lg">
                     </div>
                  </div>
                  <div class="row form-group">
                     <div class="col-md-6">
                        <label for="fname">{{this.$lang.text_19[llanguage]}}</label>
                        <select class="form-control input-lg" v-model="edit.province" @change="fetchCityEdit" >
                           <option value="">{{this.$lang.text_55[llanguage]}}</option>
                           <option  v-for="province in provinceData" :value="province.Province_ID">{{province.Province_Name}}</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label for="lname">{{this.$lang.text_20[llanguage]}}</label>
                        <select class="form-control input-lg" v-model="edit.city">
                           <option value="">{{this.$lang.text_56[llanguage]}}</option>
                           <option  v-for="city in cityData" :value="city.City_ID">{{city.City_Name}}</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-group">
                     <div class="col-md-6">
                        <label for="fname">{{this.$lang.text_4[llanguage]}}</label>
                        <input type="text" id="password" name="password"  v-model="password" class="form-control input-lg">
                     </div>
                     <div class="col-md-6">
                        <label for="lname">Confirm Password</label>
                        <input type="text" id="confirm_password" name="confirm_password" v-model="cpassword" class="form-control input-lg">
                     </div>
                  </div>
                  <center>
                     <div class="form-group">
                           <div id="msg"></div>   
                     </div>
                     <div class="form-group">
                        <input type="button" value="Update" @click="updateProfile" class="btn btn-info">
                     </div>
                     
                  </center>
            </div>
         </div>
      </section>
   </div>
</template>
<script>

import Header from '../components/includes/HeaderComponent';

export default {
	components: {
		Header
   },
   data(){
      return{
         user_id:localStorage.getItem('user_id'),
         provinceData:[],
         password:'',
         cpassword:'',
         cityData:[],
         llanguage:localStorage.getItem('language'),
         edit:{
         },
         msg:'',

      }
   },
   mounted(){

         this.getUserData();
         this.fetchProvince();
         // this.fetchCity();
   },
   methods:{
      updateProfile(){
         this.msg='';
         $("#msg").html('');
         this.edit.name = this.edit.name.trim();
         this.edit.email = this.edit.email.trim();
         this.password = this.password.trim();
         this.cpassword = this.cpassword.trim();
         if(this.edit.name==''){
            this.msg='Name can not be empty';
            $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');
            return;
         }
         if(this.edit.email==''){
            this.msg='Email can not be empty';
            $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');
            return;
         }
         if(this.edit.province==''){
            this.msg='Please select province ';
            $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');
            return;
         }
         if(this.edit.city==''){
            this.msg='Please select city';
            $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');
            return;
         }

            this.edit.password=this.password;

            if(this.password!=''){
                  if(this.password!=this.cpassword){
                     this.msg='Confirm password did not matched';
                     $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');

                     return;  
                  }
            }

                axios.post('api/updateDoctor', {
                        'data':this.edit,
                    })
                    .then(response => {
                               this.msg='Profile update successfull';
                              $("#msg").html('<div class="alert alert-success" style="max-width:500px !important;">'+this.msg+'</div>');

                              setTimeout(() => {
                                    this.msg='';
                                    $("#msg").html('');
                                       
                              }, 5000);
                              
                    })
                    .catch(err => {
                           this.msg='something Went Wrong';
                           $("#msg").html('<div class="alert alert-danger" style="max-width:500px !important;">'+this.msg+'</div>');
                        console.log('errrrrr-',err);
                    });



         
         
         
         



      },
      getUserData(){
         axios.post('api/getUserData', {
                  'sadd':'aaaa',
                  'user_id':this.user_id
				})
				.then(res => {
               console.log('res-', res.data.res[0]);
               this.edit = res.data.res[0];
               let prid = this.edit.province;
               this.fetchCityEdit();
               console.log('reedit-', this.edit);

               
				})
				.catch(err => {
					console.log('errrrrr-', err);
            });
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
   }

    
}
</script>
<style scoped>
  .radio, .checkbox {
    margin-left: 80px;}
    
 .slider .input_inline.min100 {
    width: 150px; 
}  
.que_top{
    margin-bottom: 15px;
    margin-top: 15px;
    background:rgb(109, 198, 250);
    color: aliceblue
}
.que_top::after {
    content: '';
    font-size: 17px;
    border: 17px solid rgb(109, 198, 250);
    position: absolute;
    left: 50%;
    border-left-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    top: 45px;
    display: block;
    width: 1px;
    z-index: 1;
    transform: translateX(-50%);
}
.slider .charts.m_t_0{
    margin-top:10px;
}
.alert{
   max-width: 500px !important;
}
</style>