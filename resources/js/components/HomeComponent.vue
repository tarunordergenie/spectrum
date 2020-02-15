<template>
 <div class="home">
   <Header/>
   <section class="login-section ">
      <div class="set-header">
         <img src="public/assets/img/header1.jpg">
         <div class="set-text">
            <h2 class="htext _h2"><span>W</span>elcome <span>T</span>o <span>S</span>pectrum <span>T</span>herapeutics <span>E</span>xperience <span>P</span>rogram</h2>
            <a v-if="role=='2' || role=='3'" :href="'/'+this.$foldername+'/#/dashboard/patientassesment'" class="btn btn-info  btn-lg hasicon"><span class="thum"><img src="public/assets/img/arrow.svg" /></span> Start New Assessment</a>
         </div>
      </div>
      <div class="container-fluid set-questions">
         <div class="row">
            <div class="col-md-12">
            </div>
         </div>
      </div>
      <div class="inner bgwhite paddingtop-20 paddingbot-20">
         <!--paddingtop-20   paddingbot-20 i reomoved-->
         <div class="container-fluid set-questions">
            <div class="row">
               <div class="col-md-9">
                  <h3 class="h3" v-if="role=='2' || role=='3'"  >Patient Management Console</h3>
                  <h3 class="h3" v-if="role=='1'"  >Doctors</h3>
                  <span class="">
                     <!-- <button   type="button">Export</button> -->
                      <download-csv v-if="role=='1'"
                                 :data="jsonData"
                                 :name="dataFile"
                                 :labels="labels"
                                 :fields="fields"
                                 v-on:export-finished="exported"
                        >
                           <button  class="btn btn-info mt-15" style="padding:9px 11px!important;">Export</button>
                        </download-csv>
                  </span>
               </div>
               <div class="col-md-3">
                  <div class="input-group" v-if="role=='2' || role=='3'" >
                     <input type="text" class="form-control" @keyup="filterPatients" v-model="search" placeholder="Search">
                     <span class="input-group-btn">
                     <button type="button" class="btn btn-default" @click="filterPatients">Go</button>
                     </span>
                  </div>
                  <div class="input-group" v-if="role=='1'" >
                     <input type="text" class="form-control" @keyup="filterUser" v-model="search" placeholder="Search">
                     <span class="input-group-btn">
                     <button type="button" class="btn btn-default" @click="filterUser" >Go</button>
                     </span>
                  </div>
                  
               </div>
            </div>
            <div class="row">
               <!-- <pre>
                  {{jsonData}}
               </pre> -->
               <div class="col-md-12">
                  <div class="table-responsive">
                     <table v-if="role=='2' || role=='3'" class="table mytable">
                        <thead>
                           <tr>
                              <td>Patient ID</td>
                              <td v-if="role=='1'"><span class="bleft">Doctor</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Role</span> </td>
                              <td v-if="role=='2' || role=='3'"><span class="bleft">Patient’s Initials</span> </td>
                              <td v-if="role=='2' || role=='3'"><span class="bleft">Date of Next Follow Up</span></td>
                              <td><span class="bleft">Patient Assessment</span></td>
                              <td><span class="bleft">1<sup>st</sup> Patient Follow-Up</span></td>
                              <td><span class="bleft">2<sup>nd</sup> Patient Follow-Up</span> </td>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(patient,index) in patients">
                              <td>PI100-{{patient.id}}</td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.doctor}}</span></td>
                           
                              <td v-if="patient.role=='1' && role=='1'"><span class="bleft2">Admin</span></td>
                              <td v-if="patient.role=='2' && role=='1'"><span class="bleft2">Doctor</span></td>
                              <td v-if="patient.role=='3' && role=='1'"><span class="bleft2">Demo</span></td>
                              
                              
                              <td v-if="role=='2' || role=='3'"><span class="bleft2">{{patient.initials}}</span></td>
                              <td v-if="role=='2' || role=='3'" >
                                 <span class="bleft2"> 
                                 <span class="_setdate">{{patient.next_assessment_date}}</span>  
                                 <a href="javascript:void(0);"  @click="resche(patient.id,patient.next_assessment_date)"  class="tlinks ">Reschedule</a>
                                 </span> 
                              </td>
                              <td>
                                 <span class="bleft2 center date">
                                    <span class="status"> 
                                    <img src="public/assets/img/status_done.svg" />
                                    </span>
                                    <p style="color:blue; font-size: 12px; margin-top:4px!important;">{{patient.assessment_date}}</p>
                                 </span>
                              </td>
                              <td>
                                 <span v-if="patient.followup_type==2 || patient.followup_type==3" class="bleft2 center">
                                    <span class="status"> 
                                    <img src="public/assets/img/status_done.svg" />
                                    </span>
                                    <p style="color:blue; font-size: 12px; margin-top:4px!important;">{{patient.next_assessment_date}}</p>
                                 </span>
                                 <span v-if="patient.followup_type==1" class="bleft2 center">
                                    <span style="font-weight:600;">Scheduled</span>
                                    <p style="color:blue; font-size: 12px; margin-top:4px!important;"  @click="goto2(patient.id,patient.next_assessment_date)"   >Click to Enter</p>
                                 </span>
                              </td>
                              <td>
                                 <span v-if="patient.followup_type==3" class="bleft2 center">
                                    <span class="status"> 
                                    <img src="public/assets/img/status_done.svg" />
                                    </span>
                                    <p style="color:blue; font-size: 12px; margin-top:4px!important;">{{patient.next_assessment_date}}</p>
                                 </span>
                                 <span v-if="patient.followup_type==2" class="bleft2 center">
                                    <span style="font-weight:600;">Scheduled</span>
                                    <p style="color:blue; font-size: 12px; margin-top:4px!important;" @click="goto2(patient.id,patient.next_assessment_date)" >Click to Enter</p>
                                 </span>
                                 <span v-if="patient.followup_type==1" class="bleft2 center">
                                    <span class="status cross">
                                       <!-- <img src="public/assets/img/status_done.svg" /> -->
                                       &times;
                                    </span>
                                    <!-- <p style="color:blue; font-size: 12px; margin-top:2px!important;">{{patient.next_assessment_date}}</p> -->
                                 </span>
                              </td>
                           </tr>
                        </tbody>
                     </table>




                     <table v-if="role=='1'" class="table mytable">
                        <thead>
                           <tr>
                              <td>S No.</td>
                              <td v-if="role=='1'"><span class="bleft">Doctor</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Role</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Email</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Province</span> </td>
                              <td v-if="role=='1'"><span class="bleft">City</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Pre Meeting</span> </td>
                              <td v-if="role=='2' || role=='3'"><span class="bleft">Patient’s Initials</span> </td>
                              <td v-if="role=='2' || role=='3'"><span class="bleft">Date of Next Follow Up</span></td>
                              <td><span class="bleft">Patient Assessment</span></td>
                              <td><span class="bleft">1<sup>st</sup> Patient Follow-Up</span></td>
                              <td><span class="bleft">2<sup>nd</sup> Patient Follow-Up</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Post Meeting</span> </td>
                              <td v-if="role=='1'"><span class="bleft">Edit</span> </td>
                              
                                 

                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(patient,index) in patients">
                              <td>{{index+1}}</td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.name}}</span></td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.role}}</span></td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.email}}</span></td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.Province_Name}}</span></td>
                              <td v-if="role=='1'"><span class="bleft2">{{patient.City_Name}}</span></td>
                              <td>
                                 <span class="bleft2 center date">
                                    <span v-if="patient.pre_meeting==1" class="status"> 
                                    <img src="public/assets/img/status_done.svg" />
                                    </span>
                                    <p v-if="patient.pre_meeting==1" style="color:blue; font-size: 12px; margin-top:4px!important;">{{patient.preDate}}</p>

                                    <span v-if="patient.pre_meeting==0" class="status cross"> 
                                                &times;
                                    </span>
                                    
                                 </span>
                              </td>
                              <td>
                                 <span  class="bleft2 center">
                                    <span  class="status cross"> 
                                             {{patient.count1}}
                                    </span>
                                 </span>
                              </td>
                              <td>
                                 <span  class="bleft2 center">
                                    <span  class="status cross"> 
                                             {{patient.count2}}
                                    </span>
                                 </span>
                              </td>
                              <td>
                                 <span  class="bleft2 center">
                                    <span  class="status cross"> 
                                             {{patient.count3}}
                                    </span>
                                 </span>
                              </td>
                              <td>
                                 <span class="bleft2 center date">
                                    <span v-if="patient.post_meeting==1" class="status"> 
                                    <img src="public/assets/img/status_done.svg" />
                                    </span>
                                    <span v-if="patient.post_meeting==0" class="status cross"> 
                                                &times;
                                    </span>
                                    
                                 </span>
                              </td>
                              <td><span class="bleft2 center">
                                 <button type="buttton" href="#changedate2" data-toggle="modal"  @click="editPop(patient.doc_id)"   class="btn btn-primary">Edit</button>
                                 </span>
                              </td>
                              
                           </tr>
                        </tbody>
                     </table>
                     



                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
 <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
   <div id="presurvey" class="modal  fade  mymodal">
      <form id="preSurvey">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>  -->
                  <!-- <div class="dropdown setlanguage">
                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">English <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="#">English</a></li>
                        <li><a href="#">French</a></li>
                     </ul>
                  </div> -->
                  <h3 class="modal-title h3">Pre-Meeting Survey </h3>
                  <p class="text-sub">Please select from the below options for each question as applicable.</p>
               </div>
               <div class="modal-body">
                  <div class="thanks">
                     <img class="art" src="public/assets/img/art1.svg" alt="">
                     <p class="text">  
                                       Thank you for completing the pre-meeting survey
                                       <br />
                                       <br />
                                       Please proceed  to patient assessment after attending webinar 
                     </p>
                  </div>
                  <div class="table-responsive">
                     <table class="table mytable">
                        <thead>
                           <tr>
                              <td>#</td>
                              <td><span class="bleft2">Questions</span> </td>
                              <td v-for="PreMeetingQuestionsOption in PreMeetingQuestionsOptions"><span class=" text-center textsm ">{{JSON.parse(PreMeetingQuestionsOption.option_text)[language2]}}</span></td>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(PreMeetingQuestion,index) in PreMeetingQuestions">
                              <td><span class="count" :id="'cs-'+index">0{{index+1}}</span> 
                              </td>
                              <td><span class="bleft2 bleft3" :id="'qs-'+index" style="border-right: 1px dashed #ddd!important;">{{JSON.parse(PreMeetingQuestion.questions)[language]}}</span></td>
                              <td v-for="(option,Oindex) in PreMeetingQuestion.options">
                                 <span class=" text-center" :id="'os-'+index" >
                                    <input 
                                       :id=" 'radio-' + option.id" 
                                       class="with-font"  
                                       type="radio" 
                                       v-model="post[index].option_id" :value="option.id"
                                       >
                                    <label :for=" 'radio-' + option.id" ></label>
                                    <!--{{Oindex+1}}  <button   class="btn   btn-promary" ><i class="fa fa-star-o" aria-hidden="true"></i></button>
                                       -->
                                 </span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <br />  
               <!--<div v-if="submit==true  && valid==true" class="alert alert-success text-center">{{msg}}</div>-->
               <!-- <div v-if="submit==true  && valid!=true" class="alert alert-danger text-center">{{msg}}</div> -->
               <div class="modal-footer text-center"> 
                  <button type="button" class="btn btn-info" @click="PreMeetingSubmit" >Submit</button>
                  <button type="button" class="btn btn-default btn_reset"  @click="reset_modal" >Reset</button>
               </div>
               <div class="text-center" v-if="fsubmit==true">
                     <button type="button" class="btn btn-info"   @click="close_modal"  >Close</button>
               </div>
               
            </div>
         </div>
      </form>
   </div>
   <div id="changedate" class="modal  fade  mymodal">
      <div class="modal-dialog">
         <div class="modal-content modal-sm">
            <div class="modal-header">
               <button type="button" class="close active" data-dismiss="modal"   aria-hidden="true">X</button> 
               <h3 class="modal-title h3">Reschedule Date </h3>
            </div>
            <div class="modal-body">
               <!-- <div class="datetimepicker"  id="datetimepicker12"></div> -->
               <div class="text-center">
                  <input type="date" :min="tdate"  v-model="cdate"     class="form-control" />
               </div>
            </div>
            <div class="modal-footer text-center"> 
               <button type="button" class="btn btn-info"  @click="resech_submit()"   >Reschedule</button>
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
                        <!-- <input type="text" class="form-control"  v-model="email">  @change="fetchCityEdit" -->
                        <select class="form-control" v-model="edit.province"  @change="fetchCityEdit" >  
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
               <button type="button" class="btn btn-info"  @click="editUser"   >Edit</button>
               <!-- -->
            </div>
            
         </div>
      </div>
   </div>
   




   <!-- Core JavaScript Files -->
</div>
</template>
<script>

import Header from '../components/includes/HeaderComponent';
import JsonCSV from './includes/JsonCSV';
import JsonPretty from 'vue-json-pretty'

export default {
	components: {
      'Header':Header,
      'download-csv': JsonCSV, 
      'pretty-json': JsonPretty
   },
   data() {
		return {
         jsonData: [],
         dataFile: '_Doctor.csv',
         labels: {
            name: 'Name',
            email: 'Email',
            role:'Role',
            Province_Name:'Province Name',
            City_Name:'City Name',
            pre_meeting: 'Pre meeting',
            post_meeting: 'Post Meeting',
            count1:'Patient assessment',
            count2:'1st Patient Follow-Up',
            count3:'2nd Patient Follow-Up',
         },
        fields : ['name', 'email','role','Province_Name','City_Name', 'pre_meeting', 'preDate','post_meeting','count1','count2','count3'],
         isExported: false,
			PreMeetingQuestions: [],
			patients: [],
			PreMeetingQuestionsOptions: [],
			language: localStorage.getItem('language'),
			post: [],
			submit: '',
			valid: '',
			msg: '',
			role: localStorage.getItem('role'),
			user_id: localStorage.getItem('user_id'),
         currentEditId:0,
         cdate:'',
         pre_meeting:localStorage.getItem('pre_meeting'),
         // newdate:'',
         language2:'en',
         fsubmit:false,
         edit:{

         },
         cityData:[],
         provinceData:[],
         rightEdit:false,
         wrongEdit:false,
         right:false,
         wrong:false,
         tdate:'',
         search:'',
		}
	},
	methods: {   
      filterPatients(){
          if(this.role=='2' || this.role=='3'){
            let txt = this.search;
               if(txt==''){
                  this.fetchPatients();
                  return;
               }
               
            axios.post('api/getPatientsSearch', {
                  'id': this.user_id,
                  'role':this.role,
                  'txt':txt,
               })
               .then(res => {
                  if (!Array.isArray(res.data.patients)) {
                     this.patients.push(res.data.patients);
                  } else {
                     this.patients = res.data.patients;
                  }
                  console.log('res', res);

               })
               .catch(err => {
                  // console.log('errrrrr-', err);
               });
               
         }

      },
      filterUser(){
            let txt = this.search;
      if(this.role=='1'){
                  if(txt==''){               
                     this.fetchDoctorDetails();
                     this.fetchDoctorDetailsExport();
                  }else{
                     
                     axios.post('api/fetchDoctorDetailsForClientSearch', {
                              'id': this.user_id,
                              'type':'all',
                              'txt':txt
                           })
                           .then(res => {
                              if (!Array.isArray(res.data.res)) {
                                 // this.jsonData.push(res.data.res);
                                 this.patients.push(res.data.res);
                              } else {
                                 // this.jsonData=res.data.res;
                                 this.patients=res.data.res;
                              }
                              // console.log('jsonData', res);
                           })
                           .catch(err => {
                              // console.log('errrrrr-', err);
                           });
                     axios.post('api/fetchDoctorDetailsForClientSearch', {
                              'id': this.user_id,
                              'type':'doctor',
                              'txt':txt
                           })
                           .then(res => {
                              if (!Array.isArray(res.data.res)) {
                                 this.jsonData.push(res.data.res);
                                 // this.patients.push(res.data.res);
                              } else {
                                 this.jsonData=res.data.res;
                                 // this.patients=res.data.res;
                              }
                              // console.log('jsonData', res);
                           })
                           .catch(err => {
                              // console.log('errrrrr-', err);
                           });
                                 
                           
                  }
            }
         },
         goto2(id,next_assessment_date){
            // alert('id==',+id+' date=='+next_assessment_date);
            // console.log('id==',+id+' date=='+next_assessment_date);
            if(this.tdate<next_assessment_date){
               alert('Not the assessment date for patient');
            }else{
               alert('We are working on this module');
            }
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
                            this.wrongEdit=true;
                            this.rightEdit=false;
                            this.msg='No change';
                            this.fetchDoctorDetails();
                            this.fetchDoctorDetailsExport();
                            console.log('ok',response);
                        }else{
                              this.rightEdit=true;
                              this.wrongEdit=false;
                              this.msg=response.data.msg;
                              this.fetchDoctorDetails();
                               this.fetchDoctorDetailsExport();


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
                        this.msg='Something Went Wrong';
                        console.log('errrrrr-',err);
                    });
                     setTimeout(() => {
                        this.wrongEdit=false;
                        this.rightEdit=false;
                        this.msg='';
                    }, 5000);

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
       close_modal(){
            $('#presurvey').modal('hide');
      },
      resche(pid,next_assessment_date){
         // alert(pid);
         this.currentEditId=pid;//next_assessment_date
         this.cdate=next_assessment_date;//next_assessment_date
         $("#changedate").modal('show');
      }, 
      resech_submit(){
            console.log('mmm',this.cdate);
			axios.post('api/updatePatientfollowup', {
               'id': this.currentEditId,
               'date':this.cdate
				})
				.then(res => {
					console.log('res-', res);

               this.fetchPatients();
               setTimeout(function(){
                  $("#changedate").modal('hide');
               },500);

				})
				.catch(err => {
					console.log('errrrrr-', err);
            });
            
      },
		fetchPatients() {
         if(this.role=='2' || this.role=='3'){
            axios.post('api/getPatients', {
                  'id': this.user_id,
                  'role':this.role
               })
               .then(res => {
                  if (!Array.isArray(res.data.patients)) {
                     this.patients.push(res.data.patients);
                  } else {
                     this.patients = res.data.patients;
                  }
                  console.log('patients', res);

               })
               .catch(err => {
                  // console.log('errrrrr-', err);
               });
               
         }
		},

		reset_modal() {
			// console.log("reset_modal");
			$(".mymodal tr").each(function () {
				$(this)
					.find(".with-font")
					.each(function (index) {
						this.checked = false;
					});
			});
		},

		PreMeetingSubmit() {

			let totalOption = this.post.length;
			let totalOptionChoosen = 0;
			this.post.forEach(el => {
				if (el.option_id != "") {
					totalOptionChoosen++;
				}
			});

			// console.log('totalOptionChoosen  >>>', totalOptionChoosen);
			// console.log('totalOption  >>>', totalOption);

			if (totalOption == totalOptionChoosen) {
				axios.post('api/PreMeetingInsert', {
						'answer': this.post,
                  'user_id': this.user_id,
                  'role': this.role,
                  'pre_meeting':this.pre_meeting
					})
					.then(res => {
						// console.log('res  >>>', res);
						if (res.data.msg == 'success') {
							localStorage.setItem('pre_meeting', '1')
                     this.submit = true;
                     this.fsubmit=true;
                     
							this.valid = true;
							this.msg = 'Thank you';

							$('.setlanguage').hide();
							$('.mymodal .table-responsive').addClass('hide');
							$('.mymodal .modal-footer').addClass('hide');
							$('.mymodal .text-sub').addClass('hide');

							$('.thanks').fadeIn('400');
							$('.mymodal .close').addClass('active');
							// setTimeout(function () {
							// 	$('#presurvey').modal('hide');
							// }, 800);

						} else {
							// console.log('no   okkkkkkkkkkkkk>>>');
						}

					}).catch(err => {
						// console.log('errr>>>', err);
					});
			} else {
				this.submit = true;
				this.valid = false;
				this.msg = 'Please answer all questions';

			}

		},
		jq() {
			setTimeout(function () {
				$('.mymodal tr').each(function () {
					$(this).find('.btn-promary').each(function (index) {
						$(this).attr('data-num', index)
					});
				});
				$('.btn-promary').click(function () {
					var know = $(this).hasClass('active');
					if (know == false) {
						$(this).addClass('active');
						$(this).closest('td').siblings('td').find('.btn-promary').removeClass('active');
					} else {
						$(this).removeClass('active');
					}
				});
			}, 1000);
		},
		fetchQuestions() {

			axios.post('api/getQuestions', {
					'id': 1
				})
				.then(res => {
					if (!Array.isArray(res.data.questions)) {
						this.PreMeetingQuestions.push(res.data.questions);
					} else {
						this.PreMeetingQuestions = res.data.questions;
					}

					let json = this.PreMeetingQuestions;
					json.forEach(el => {
						//    let push =      
						this.post.push({
							question_id: el.id,
							option_id: '',
							user_id: localStorage.getItem('user_id'),
							survey_type_id: 1,
						});
					});

					this.jq();
					this.PreMeetingQuestionsOptions = this.PreMeetingQuestions[0].options;
					// // console.log('post---',this.post);
				})
				.catch(err => {
					// console.log('errrrrr-', err);
				});

      },
      fetchDoctorDetails(){
         if(this.role=='1'){
            axios.post('api/fetchDoctorDetailsForClient', {
                  'id': this.user_id,
                  'type':'all'
               })
               .then(res => {
                  if (!Array.isArray(res.data.res)) {
                     this.patients.push(res.data.res);
                     // this.jsonData.push(res.data.res);
                  } else {
                     this.patients = res.data.res;
                     // this.jsonData=res.data.res;

                  }
                  console.log('iiiiiiiiiiiii', res);

               })
               .catch(err => {
                  // console.log('errrrrr-', err);
               });
         }
      },
      fetchDoctorDetailsExport(){
         if(this.role=='1'){
            axios.post('api/fetchDoctorDetailsForClient', {
                  'id': this.user_id,
                  'type':'doctor'
               })
               .then(res => {
                  if (!Array.isArray(res.data.res)) {
                     this.jsonData.push(res.data.res);
                  } else {
                     this.jsonData=res.data.res;

                  }
                  console.log('jsonData', res);
               })
               .catch(err => {
                  // console.log('errrrrr-', err);
               });
         }
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
	},

	mounted() {

		this.fetchPatients();
		this.fetchQuestions();
      this.fetchDoctorDetails();
      this.fetchDoctorDetailsExport();
      this.fetchProvince();


      setTimeout(() => {
         var today = new Date();
         let n = today.getTime();
         this.dataFile = n+'_doctorExport.csv';
         var dd = String(today.getDate()).padStart(2, '0');
         var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
         var yyyy = today.getFullYear();
         this.tdate =  yyyy+'-'+mm + '-' + dd;
      }, 2000);
      
      

		$(function () {
			if (localStorage.getItem('pre_meeting') == 0 && localStorage.getItem('role') == '2') {
				$('#presurvey').modal({
					backdrop: 'static',
					keyboard: false
				})
         }
         
         if (localStorage.getItem('pre_meeting') == 0 &&  localStorage.getItem('role') == '3') {
				$('#presurvey').modal({
					backdrop: 'static',
					keyboard: false
				})
			}

		});

		setTimeout(function () {


			$('#datetimepicker12').datepicker({
				inline: true,
				sideBySide: true
			});


		}, 1000);

		function checkbtns() {
			var isvalid = 0;
			var isvalidrow = true;

			$('.mymodal tr').each(function () {
				$(this).find('.btn-promary').each(function (index) {
					if ($(this).hasClass('active')) {
						isvalidrow = true;
						isvalid++;
						return false
					} else {

					}
				});
			});

			if (isvalid == 5) {
				//alert('done') 
				$('.setlanguage').hide();
				$('.mymodal .table-responsive').addClass('hide');
				$('.mymodal .text-sub').addClass('hide');

				$('.thanks').fadeIn('400');
				$('.mymodal .close').addClass('active');
				setTimeout(function () {
					$('#presurvey').modal('hide');
				}, 5000);
			}
		}
	}
}
</script>
<style scoped>
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
      input[type=radio].with-font {
                border: 1px solid blue;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
                
            input[type=radio].with-font ~ label:before {
                font-family: FontAwesome;
                display: inline-block;
                content: "\f006";
                letter-spacing: 10px;
                font-size: 1.3em;
                color: #1d75bc;
                width: 1.4em;
            }

            input[type=radio].with-font:checked ~ label:before  {
                content: "\f005";
                font-size: 1.3em;
                color: #1d75bc;
                letter-spacing: 5px; margin-top: 6px;
            }

            input[type=radio].with-font {
                border: 1px solid blue;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            
            input[type=radio].with-font ~ label:before {
                font-family: FontAwesome;
                display: inline-block;
                content: "\f006";
                letter-spacing: 10px;
                font-size: 1.3em;
                color: #1d75bc;
                width: 1.4em; margin-top: 15px!important; 
            }
            .bleft3  input[type=radio].with-font ~ label:before {  margin-top: 20px; }

            input[type=radio].with-font:checked ~ label:before  {
                content: "\f005";
                font-size: 1.3em;
                color: #1d75bc;
                letter-spacing: 5px;
            }
            .mymodal .count1{
              margin-top:20px;
            }

.mymodal #cs-3{
   margin-top: 20px!important;
}
.cross {
   font-size: 30px !important;
}
p{
   margin: 0px 12px 6px  !important;
}
button.mt-15{
   margin-bottom: 15px !important;
}
</style>