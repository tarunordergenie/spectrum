<template>
<div class="Patientassesment">

      <Header />
   
   <section class="login-section ">
      <div class="set-header">
         <img src="public/assets/img/header.jpg">
         <div class="set-text">
            <h2 class="htext _h2">Patient Assessment</h2>
            <a :href="'/'+this.$foldername+'/#/dashboard'" class="btn btn-dafult btn_reset"><i class="fa fa-angle-left"></i> Back</a>
         </div>
      </div>
      <div class="container-fluid set-questions">
         <div class="row">
            <div class="col-md-12">
               <div class="que_top">PATIENT INFORMATION</div>
            </div>
         </div>
         <!-- Q1 -->
         <div class="row" v-for="(Question,index) in firstAssesmentQuestions" >
            <div class="" v-if="(index==10)">
               <div class="col-md-12">
                  <div class="que_top">PHYSICIAN MEDICAL CANNABIS AUTHORIZATION</div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="slider active" style="padding: 0px 15px;" tabindex='1' :id="'slider-'+index" >
                  <div class="block  ">
                     <div class="heading">
                        <span>{{index+1}}</span>
                        <div class="text">
                           {{JSON.parse(Question.questions)[language]}}
                           <em class="sm" v-if="Question.question_subtext!=''">{{JSON.parse(Question.question_subtext)[language]}}</em> 
                        </div>
                     </div>
                  </div>

                  

                  <div class="charts mrgn_88" v-if="Question.question_type_id=='1' && index!=2">

                              <!-- @keypress="isNumber($event)"  -->
                           <textarea  class="form-control" v-model="firstAssesmentAnswers[index].ans"  ></textarea>
                           
                           <!-- <input v-if="index==2" type="text"    v-model="firstAssesmentAnswers[index].ans"/> -->
                  </div>


                   <div class="charts mrgn_88" v-if="Question.question_type_id=='1' && index==2" >
                        <div class="row">
                           <div class="col-lg-2" id="age_element">
                              <span v-if="language=='en'" class="pull-left">Please Enter Age :</span>
                              <span v-if="language=='fn'" class="pull-left">Veuillez entrer l'âge:</span>
                              </div>
                           <div class="col-lg-2">
                              <input type="text" maxlength="3" class="agre form-control" v-model="firstAssesmentAnswers[index].ans" id="age" @keypress="isNumber($event)" >

                              <!-- <span class="row hide paddingtop-20" id="age_msg"></span> -->

                           </div>
                        </div>
                     </div>    
              

                  <div class="charts m_t_0 " v-if="(Question.question_type_id=='2')">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-4" v-for="options in Question.options">
                              <div class="radio"> <label><input type="radio" :value="options.id"  v-bind:class="{ 'showinput5': options.specify }"  :name="'q'+index+''"  v-model="firstAssesmentAnswers[index].ans" > {{JSON.parse(options.option_text)[language]}} 
                              <input v-if="(options.specify==1)" 
                                       v-model="firstAssesmentAnswers[index].specify[options.id].txt" 
                                       type="text" class="form-control input-sm sss hide input_inline">
                            </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="charts m_t_0 " v-if="(Question.question_type_id=='3') && (Question.id)!=21">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-4 mt-u" v-for="options in Question.options">
                              <div class="checkbox">
                                  <label><input type="checkbox"  v-bind:class="{ 'showinput': options.specify }" :value="options.id"  v-model="firstAssesmentAnswers[index].ans"  name="q9[]"> {{JSON.parse(options.option_text)[language]}}</label>
                                  <input v-if="(options.specify==1)" 
                                       v-model="firstAssesmentAnswers[index].specify[options.id].txt" 
                                       type="text" class="form-control input-sm sss hide input_inline">
                                  </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>

                  
            <div class="charts m_t_0" v-if="(Question.question_type_id=='3') && (Question.id)==21" >

               <div class="container-fluid">

                     <div v-for="options in Question.options">

                        <div class="row" >
                           <div class="col-md-12">
                                 <div class="checkbox"> <label><input v-bind:class=" options.id==109 ? 'q12other' : 'q12' "  type="checkbox" :value="options.id" v-model="firstAssesmentAnswers[index].ans"  name="q12"> {{JSON.parse(options.option_text)[language]}} </label>
                                       
                                 </div>
                           </div>
                        </div>      

                        <div v-for="(subQuestion,index2) in Question.subQuestions">
                           <div class="option " data-for="107"  v-if="(subQuestion.id==22)  && (options.id==107)" >
                              <div class="container-fluid"  >
                                 <div class="row">
                                    <div class="col-md-6 text-right">
                                       <span class="text2"> {{JSON.parse(subQuestion.questions)[language]}} </span>
                                       <span class="text3"> {{JSON.parse(subQuestion.question_subtext)[language]}} </span>
                                    </div>
                                    <div class="col-md-6 ">
                                    <div class="setborderleft" v-if="(subQuestion.id==22) && (options.id==107) && (language=='en')">
                                       Increase dose by
                                       <input type="text" class="form-control input-sm input_inline "
                                               maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                          /> ml, every <input type="text" class="form-control input-sm input_inline"
                                                maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans1"
                                          /> days, until <input type="text" class="form-control input-sm input_inline"
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans2"
                                          /> ml per day of maximum volume is reached.
                                       </div>

                                       <div class="setborderleft" v-if="(subQuestion.id==22) && (options.id==107) && (language=='fn')">
                                       Augmenter la dose de
                                       <input type="text" class="form-control input-sm input_inline "
                                               maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                          /> mg/mL tous les <input type="text" class="form-control input-sm input_inline"
                                                maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans1"
                                          /> jours jusqu’à l’atteinte d’une dose/d’un volume maximal de
                                           <input type="text" class="form-control input-sm input_inline"
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans2"
                                          /> mg/mL.
                                       </div>
                                       

                                    </div>
                                 </div>
                              </div>
                           </div>


                           <div class="option "  data-for="108" v-if="(subQuestion.id==23) && (options.id==108)" >
                              <div class="container-fluid" >
                                 <div class="row">
                                    <div class="col-md-6 text-right">
                                       <span class="text2"> {{JSON.parse(subQuestion.questions)[language]}}</span>
                                       <span class="text3"> {{JSON.parse(subQuestion.question_subtext)[language]}}</span>
                                    </div>
                                    <div class="col-md-6 ">
                                    <div class="setborderleft" v-if="(subQuestion.id==23) && (options.id==108) &&  (language=='en')">
                                       Increase dose by  
                                       <input type="text" class="form-control input-sm input_inline" 
                                         maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                          /> number of softgel, every <input type="text" class="form-control input-sm input_inline" 
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans1"
                                          /> days until <input type="text" class="form-control input-sm input_inline" 
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans2"
                                          /> softgels of maximum dose is reached.
                                    </div>

                                    <div class="setborderleft" v-if="(subQuestion.id==23) && (options.id==108) && (language=='fn')">
                                       Increase dose by  
                                       <input type="text" class="form-control input-sm input_inline" 
                                         maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                          /> number of softgel, every <input type="text" class="form-control input-sm input_inline" 
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans1"
                                          /> days until <input type="text" class="form-control input-sm input_inline" 
                                            maxlength="4"  @keypress="isNumber2($event)"
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans2"
                                          /> softgels of maximum dose is reached.
                                    </div>
                                    

                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           
                        </div>
                        
                        
                        
                     </div>

                     


                     </div>
                  </div>
                  

                  <div class="charts mrgn_88" v-if="(Question.question_type_id=='4')">
                     <div class="row">
                        <div class="col-lg-2">
                           <span v-if="language=='en'" class="pull-left">Please Enter Year :</span>
                           <span v-if="language=='fn'" class="pull-left">Veuillez entrer l'année:</span>
                        </div>
                        <div class="col-lg-5">
                           <!-- <select class="form-control" v-model="firstAssesmentAnswers[index].ans"> -->
                              <input type="text"  maxlength="4"  @keypress="isNumber2($event)"  style="margin-top:-10px !important;width:150px"    v-model="firstAssesmentAnswers[index].ans" class="form-control input-sm agre input_inline"   >
                             
                        </div>
                        <div class="col-lg-7">
                        </div>
                     </div>
                  </div>
                  <div class="charts mrgn_88" v-if="(Question.question_type_id=='5')">
                     <div class="row">
                        <div class="col-md-3">
                           <span v-if="language=='en'" class="pull-left">
                                 Please Select Date :
                           </span>
                           <span v-if="language=='fn'" class="pull-left">
                                 Veuillez sélectionner la date:
                           </span>
                           

                        </div>
                        <div class="col-md-2">
                           <div class="form-group marginbot-0">
                              <div class='input-group date' :id=" 'datepicker-' + index">
                                 <input type="date"  :min="tdate" class="form-control bbb" :id=" 'f-' + index"  v-model="firstAssesmentAnswers[index].ans" />
                                 <!-- <span class="input-group-addon">
                                 <span class="fa fa-calendar"></span>
                                 </span> -->

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                           <div class="col-md-3"></div>
                           <div class="col-md-6" :id=" 'm-' + index" ></div>
                           <div class="col-md-3"></div>
                     </div>
                  </div>
                  <!----subquestion--->
                  <div class="charts mymodal qtable m_t_0" v-if="(Question.question_type_id=='6')" >
                     <div class="table-responsive">
                        <table class="table mytable">
                           <thead>
                              <tr>
                                 <td><span class="bleft2">#</span></td>
                                 <td><span class="bleft2">Type</span> </td>
                                 <td>
                                    <span class="bleft2  text-center" style="display: inline-flex!important;"> 
                                    <span class="seticon ">
                                       <img src="public/assets/img/icon01.svg" style="float:left:important;">
                                    </span >
                                    <span style="padding:20px!important">THC Dominant</span>
                                    
                                     
                                    </span>
                                 </td>
                                 <td>
                                    <span class="bleft2  text-center" style="display: inline-flex!important;"> 
                                    <span class="seticon"><img src="public/assets/img/icon02.svg"></span> 
                                    <span style="padding:20px!important">Balanced</span>

                                    </span>
                                 </td>
                                 <td>
                                    <span class="bleft2  text-center" style="display: inline-flex!important;"> 
                                    <span class="seticon"><img src="public/assets/img/icon03.svg"></span> 
                                    <span style="padding:20px!important">CBD Dominant</span>

                                    </span>
                                 </td>
                              </tr>
                           </thead>
                           <tbody>
                              <!-- min_h_100 -->
                              <tr v-for="(subQuestion,index2) in Question.subQuestions">
                                 <td><span class="count">0{{index2+1}}</span> </td>
                                 <td><span class="bleft2 "> {{JSON.parse(subQuestion.questions)[language]}}     <em class="sm"> {{JSON.parse(subQuestion.question_subtext)[language]}}</em> </span></td>
                                 <td v-for="subOptions in subQuestion.options">
                                    <span class="bleft2 ">
                                       <span class="set_checkbox">
                                       <input type="checkbox"   
                                          :value="subOptions.id"  
                                          v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                          >
                                          <span v-html="JSON.parse(subOptions.option_text)[language]"></span>
                                       <!-- {{}} -->
                                       </span> 
                                       <div class="setinputs">

                                          <p class="text" v-if="subQuestion.id==18 && language=='en'" >Please indicate the total daily dose of the prescribed 
                                             Spectrum Therapeutics oil product? 
                                          </h>
                                          <p class="smtext" v-if="subQuestion.id==18 && language=='en'">(Please indicate value in ml per day)</p>

                                          <p class="text" v-if="(subQuestion.id==19 || subQuestion.id==20 ) && language=='en'">Please indicate the total daily number of the prescribed Spectrum Therapeutics softgel product?
                                          </p>
                                          <p class="smtext" v-if="(subQuestion.id==19  || subQuestion.id==20) && language=='en'">(Please specify the quantity for each prescribed softgel. E.g. 2 red, 1 yellow)</p>

                                          <p class="text" v-if="subQuestion.id==18 && language=='fn'" >Veuillez indiquer la dose quotidienne totale du produit de Spectrum Therapeutics prescrit sous forme d’huile.
                                          </p>
                                          <p class="smtext" v-if="subQuestion.id==18 && language=='fn'">(Veuillez inscrire une valeur en mL par jour.)</p>

                                          <p class="text" v-if="(subQuestion.id==19 || subQuestion.id==20 ) && language=='fn'">Veuillez indiquer la quantité totale quotidienne du produit de Spectrum Therapeutics prescript sous forme de gélules.
                                          </p>
                                          <p class="smtext" v-if="(subQuestion.id==19  || subQuestion.id==20) && language=='fn'"> (Veuillez préciser le nombre de chaque type de gélules prescrites, p. ex. 2 rouges, 1 jaune)</p>

                                          

                                          

                                          

                                          <input type="text"
                                               maxlength="4"  @keypress="isNumber2($event)"
                                             v-if="(subOptions.specify==1)"
                                             v-model="firstAssesmentAnswers[index].subQuestions[index2].specify[subOptions.id].txt" 
                                             class="form-control input-sm" > 
                                       </div>




                                    </span>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!----//subquestion--->

                  <!----subquestionRadio--->
                  <div class="option"  :data-for="index" v-if="(Question.subQuestions.length) && (Question.question_type_id!=6) && (Question.id!=21)">
                     <div class="container-fluid">
                        <div class="row" v-for="(subQuestion,index2) in Question.subQuestions">
                           <div class="col-md-6 text-right">
                              <span class="text2">  {{JSON.parse(subQuestion.questions)[language]}}  </span>
                           </div>
                           <div class="col-md-6 ">
                              <div class="radio radioleft"  v-for="suboption in subQuestion.options"> <label><input type="radio" 
                                 :value="suboption.id"  
                                 v-model="firstAssesmentAnswers[index].subQuestions[index2].ans"
                                 name="q5_1"
                                 >
                                 {{JSON.parse(suboption.option_text)[language]}}
                                 
                                 </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!----//subquestionRadio--->

                  <div class="alert alert-danger hide " :id="'err-'+index" ><span class="_mrgn_88">{{msg}}</span></div>
                  <div class="action text-center">
                     <div class="line">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 text-center">
            </div>
            <div class="col-md-6 text-center">
                  
            </div>
            <div class="col-md-3 text-center">
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 text-center">
               <button  class="btn btn-info" type="button" @click="submit">Submit</button>
            </div>
         </div>
         <div class="row  paddingtop-98" >
            <div class="col-md-12 text-center">
            </div>
         </div>
      </div>

     <div id="presurvey" class="modal  fade  mymodal">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
               <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                  <h3 class="modal-title h3"> Patient Assessment Survey </h3>
               </div>
               <div class="modal-body">

               <div class="thanks active">
                  <img class="art" src="public/assets/img/art1.svg" alt="">
                  <p class="text">Thank you for completing the patient assessment survey!</p>
               </div>
               
               </div>
               <div class="modal-footer text-center"> 
                  <button type="button" class="btn btn-info" @click="gotohome" >Home</button>
                  <button type="button" class="btn btn-default btn_reset"  @click="doanother" >Add new patient assessment  </button>
               </div>
         </div>
      </div>
   </div>



   </section>
</div>
</template>
<script>

import Header from '../components/includes/HeaderComponent';

export default {
      components:{
         Header
      },
	data() {
		return {
			firstAssesmentQuestions: [],
			language: localStorage.getItem('language'),
			firstAssesmentAnswers: [],
         submitted:false,
         error:false,
         success:false,
         msg:'',
         tdate:'',
		}   
	},
	mounted() {
      this.getFirstAssetment();


      setTimeout(() => {
         var today = new Date();
         var dd = String(today.getDate()).padStart(2, '0');
         var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
         var yyyy = today.getFullYear();

         today =  yyyy+'-'+mm + '-' + dd;
         this.tdate= today;
      this.firstAssesmentAnswers[0].ans=today;
      this.firstAssesmentAnswers[12].ans=today;
         
      }, 2000);



   		// $(function () {
         //    $("#presurvey").modal('show');
         // });

	},
	methods: {
      gotohome(){
            $("#presurvey").modal('hide');
            this.$router.push('/dashboard')
            .then(res=>{
                  console.log('res>',res);
            }).catch(err=>{
                  console.log('err>',err);
            })   
      },
      doanother(){
            $("#presurvey").modal('hide');
            this.$router.go(0);
      },
      isNumber2(evt){
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
         evt.preventDefault();;
         } else {
         return true;
         }

      },
      isNumber: function(evt) {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
         evt.preventDefault();;
         } else {
         return true;
         }
         
      },
		submit() {
         //  window.loacation="/#/dashboard";
         const self = this;

         this.submitted=false;
           if(this.firstAssesmentAnswers[0].ans==''){
               $("#slider-0").focus();
               $("#err-0").removeClass('hide');
               this.error=true;
               this.submitted=true;
               this.msg='Please fill first assessment date';
               return;
           }else{
               $("#err-0").addClass('hide');
           } 
           if(this.firstAssesmentAnswers[1].ans==''){
               this.error=true;
               $("#slider-1").focus();

               this.submitted=true;
               this.msg='Please fill patient initials';
               $("#err-1").removeClass('hide');
               return;
           }else{
               $("#err-1").addClass('hide');
           }
           if(this.firstAssesmentAnswers[2].ans==''){
               this.error=true;
               $("#slider-2").focus();

               this.submitted=true;
               this.msg='Please fill patient age';
               $("#err-2").removeClass('hide');
               return;
           }else{
               $("#err-2").addClass('hide');
           }

           if(this.firstAssesmentAnswers[2].ans<18 || this.firstAssesmentAnswers[2].ans>100){
               this.error=true;
               $("#slider-2").focus();

               this.submitted=true;
               this.msg='Patient age must be between 18 to 100';
               $("#err-2").removeClass('hide');
               return;
           }else{
               $("#err-2").addClass('hide');
           }

           
           if(this.firstAssesmentAnswers[3].ans==''){
               this.error=true;
               $("#slider-3").focus();

               this.submitted=true;
               this.msg='Please select  one option';
               $("#err-3").removeClass('hide');
               return;
           }else{
               $("#err-3").addClass('hide');

           }
           
            if(this.firstAssesmentAnswers[4].ans==''){
                  this.error=true;
                  $("#slider-4").focus();

                  this.submitted=true;
                  this.msg='Please Select one option';
                  $("#err-4").removeClass('hide');
                  return;
            }else{
                  $("#err-4").addClass('hide');

            }

         if(this.firstAssesmentAnswers[5].ans==''){
                  this.error=true;
                  $("#slider-5").focus();

                  this.submitted=true;
                  this.msg='Please Select one option';
                  $("#err-5").removeClass('hide');
                  return;
            }else{
                  $("#err-5").addClass('hide');

            }

            
         if(this.firstAssesmentAnswers[6].ans=='' ){
                  this.error=true;
                  $("#slider-6").focus();

                  this.submitted=true;
                  this.msg='Please enter year ';
                  $("#err-6").removeClass('hide');
                  return;
            }else{
                  $("#err-6").addClass('hide');
            }


         let date =  new Date();
         let  year = date.getFullYear();
         let lastYear = year-100; 

            

         if(this.firstAssesmentAnswers[6].ans<lastYear || this.firstAssesmentAnswers[6].ans>year  ){
                  this.error=true;
                  $("#slider-6").focus();

                  this.submitted=true;
                  this.msg='Year must be between '+lastYear+' to '+year;
                  $("#err-6").removeClass('hide');
                  return;
            }else{
                  $("#err-6").addClass('hide');
            }

            

            

            
         if(this.firstAssesmentAnswers[7].ans==''){
                  this.error=true;
                  $("#slider-7").focus();

                  this.submitted=true;
                  this.msg='Please select atleast one option ';
                  $("#err-7").removeClass('hide');
                  return;
            }else{
                  $("#err-7").addClass('hide');

            }

            
         if(this.firstAssesmentAnswers[8].ans==''){
                  this.error=true;
                  $("#slider-8").focus();

                  this.submitted=true;
                  this.msg='Please select atleast one option ';
                  $("#err-8").removeClass('hide');
                  return;
            }else{
                  $("#err-8").addClass('hide');

            }
            
         if(this.firstAssesmentAnswers[9].ans==''){
                  this.error=true;
                  $("#slider-9").focus();

                  this.submitted=true;
                  this.msg='Please select  one option ';
                  $("#err-9").removeClass('hide');
                  return;
            }else{
                  $("#err-9").addClass('hide');

            }

            if(this.firstAssesmentAnswers[10].subQuestions[0].ans=='' && this.firstAssesmentAnswers[10].subQuestions[1].ans=='' && this.firstAssesmentAnswers[10].subQuestions[2].ans==''){
                  this.error=true;
                  $("#slider-10").focus();
                  this.submitted=true;
                  this.msg='Please select atlease   one option and fill the text box ';
                  $("#err-10").removeClass('hide');
                  return;
            }else{
                  $("#err-10").addClass('hide');

            }

            // if(this.firstAssesmentAnswers[10].subQuestions[1].ans==''){
            //       this.error=true;
            //       $("#slider-10").focus();

            //       this.submitted=true;
            //       this.msg='Please select atlease   one option and fill the text box.';
            //       $("#err-10").removeClass('hide');
            //       return;
            // }else{
            //       $("#err-10").addClass('hide');

            // }
            // if(this.firstAssesmentAnswers[10].subQuestions[2].ans==''){
            //       this.error=true;
            //       $("#slider-10").focus();

            //       this.submitted=true;
            //       this.msg='Please select atlease   one option and fill the text box.. ';
            //       $("#err-10").removeClass('hide');
            //       return;
            // }else{
            //       $("#err-10").addClass('hide');

            // }

            if(this.firstAssesmentAnswers[11].ans==''){
                  this.error=true;
                  $("#slider-11").focus();

                  this.submitted=true;
                  this.msg='Please select atleast  one option and fill the text boxes.. ';
                  $("#err-11").removeClass('hide');
                  return;
            }else{
                  $("#err-11").addClass('hide');

            }
            
            

            if(this.firstAssesmentAnswers[12].ans==''){
                  this.error=true;
                  $("#slider-12").focus();

                  this.submitted=true;
                  this.msg='Please select next follow up date ';
                  $("#err-12").removeClass('hide');
                  return;
            }else{
                  $("#err-12").addClass('hide');

            }
            
            
            
           
            $("#presurvey").modal('show');
           
			axios.post('api/addFirstAssetment', {
					'assessment_date': this.firstAssesmentAnswers[0].ans,
					'patient_initial': this.firstAssesmentAnswers[1].ans,
					'next_assesment': this.firstAssesmentAnswers[12].ans,
					'answer': this.firstAssesmentAnswers,
					'user_id': localStorage.getItem('user_id'),
					'language': this.language,
					'survey_type': '2',
				})
				.then(res => {
               if(res.data.msg=='success'){
                  this.submitted=true;
                  this.success=true;
                  this.error=false;

                  

               }else{
                  this.submitted=true;
                  this.success=false;
                  this.error=true;
               }

               
                  

				}).catch(err => {
               
                  this.submitted=true;
                  this.success=false;
                  this.error=true;
                  this.msg='Something Went Wrong';

				});
		},
		getFirstAssetment() {
			axios.post('api/getFirstAssetment', {
               'id': 1,
               'language':'en'
				})
				.then(res => {
					if (!Array.isArray(res.data.questions)) {
						this.firstAssesmentQuestions.push(res.data.questions);
					} else {
						this.firstAssesmentQuestions = res.data.questions;
					}
					const questions = this.firstAssesmentQuestions;


					questions.forEach((element, index, array) => {
						//console.log(element); // 100, 200, 300
						let quesID = element.id;
						let options = element.options;
						let pid = element.parent_question_id;
						let push = {
							question_id: quesID,
							ans: [],
							survey_type_id: 2,
							parent_question_id: pid,
							subQuestions: [],
							specify: [],
						}

						options.forEach((elementO, index, array) => {
							if (elementO.specify == 1) {
								let ssp = {
									op: elementO.id,
									txt: ''
								}

								if (elementO.id != null && elementO.id != undefined && elementO.id != '') {
									push.specify[elementO.id] = ssp;

								}
							}
						});


						for (let i = 0; i < push.specify.length; i++) {
							let ssp = {
								op: i,
								txt: ''
							}
							push.specify[i] = ssp
						}
						if (element.subQuestions.length) {
							const subQuestions = element.subQuestions;
							subQuestions.forEach((element, index, array) => {
								let quesID_ = element.id;
								let options = element.options;
								let pid = element.parent_question_id;

								let pushSub = {
									question_id: quesID_,
									ans: [],
									survey_type_id: 2,
									parent_question_id: pid,
									specify: [],

								}
								options.forEach((elementO, index, array) => {
									if (elementO.specify == 1) {
										let ssp = {
											op: elementO.id,
											txt: ''
										}
										pushSub.specify[elementO.id] = ssp;
									}
								});
								for (let i = 0; i < pushSub.specify.length; i++) {
									let ssp = {
										op: i,
										txt: ''
									}
									pushSub.specify[i] = ssp
								}
								push.subQuestions.push(pushSub);
							});
						}
						this.firstAssesmentAnswers.push(push);
					});
				})
				.catch(err => {
				})
		}
	}
}
</script>
<style scoped>
label{margin-left: 20px;}
#datepicker-0{width:180px; margin: 0 20px 20px 20px;}
#datepicker-0 > span:hover{cursor: pointer;}

#datepicker-12{width:180px; margin: 0 20px 20px 20px;}
#datepicker-12 > span:hover{cursor: pointer;}
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
div{
   outline: none;
}
.sss{
   margin-left: 10px !important;
    margin-top: -1px !important;
    width: 118px !important;
}
.agre{
      border-radius: 4px !important;
      border-width: 1px !important;
      /* box-shadow: 2px 1px !important; */
      /* padding:2px !important; */
      outline: 0 !important;
}
.alert-danger{
   color: #ec0000 !important;
   background-color:#fff !important;
   font-size: 15px !important;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance:textfield;
}


/* body {
  font-size:16px;
  padding:3rem;
  background:#f1f1f4;
}

.bbb{
  border-radius: 5px !important;

}

input[type="date"] {
  display:block;
  position:relative;
  padding:1rem 3.5rem 1rem 0.75rem;
  
  font-size:1.5rem;
  font-family:Arial;
  
  border:1px solid #8292a2;
  border-radius:0.25rem;
  background:
    white
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='22' viewBox='0 0 20 22'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23688EBB' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' transform='translate(1 1)'%3E%3Crect width='18' height='18' y='2' rx='2'/%3E%3Cpath d='M13 0L13 4M5 0L5 4M0 8L18 8'/%3E%3C/g%3E%3C/svg%3E")
    right 1rem
    center
    no-repeat;
  
  cursor:pointer;
}

input[type="date"]:focus {
  outline:none;
  border-color:#3acfff;
  box-shadow:0 0 0 0.25rem rgba(0, 120, 250, 0.1);
}

::-webkit-datetime-edit {}
::-webkit-datetime-edit-fields-wrapper {}
::-webkit-datetime-edit-month-field:hover,
::-webkit-datetime-edit-day-field:hover,
::-webkit-datetime-edit-year-field:hover {
  background:rgba(0, 120, 250, 0.1);
}
::-webkit-datetime-edit-text {
  opacity:0;
}
::-webkit-clear-button,
::-webkit-inner-spin-button {
  display:none;
}
::-webkit-calendar-picker-indicator {
  position:absolute;
  width:2.5rem;
  height:100%;
  top:0;
  right:0;
  bottom:0;
  
  opacity:0;
  cursor:pointer;
  
  color:rgba(0, 120, 250, 1);
  background:rgba(0, 120, 250, 1);
 
}

input[type="date"]:hover::-webkit-calendar-picker-indicator { opacity:0.05; }
input[type="date"]:hover::-webkit-calendar-picker-indicator:hover { opacity:0.15; } */

._mrgn_88{
   
   margin-left:75px !important;
}
.mt-18{
   margin-top: -18px !important;
   /* font-size: 10px !important; */
}
.thanks{
   display:block !important;
}
.mt-u{
   min-height: 93px !important;
}
</style>