<template>
<div class="login">
      <nav class="navbar navbar-custom set-affix-top"  role="navigation">
            <div class="container-fluid navigation">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                <img src="public/assets/img/logo.png" alt=""  />
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <!-- <ul class="nav navbar-nav">
                    <li>
                        <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">English <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a @click="langc('en')">English</a></li>
                            <li><a @click="langc('fn')">French</a></li>
                        </ul>
                        </div>
                    </li>
                </ul>
                 -->
            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        
         <div class=""></div>
         <section  class="login-section">
            <div class="set-header">
            <img src="public/assets/img/header1.jpg">
            <div class="set-text">
               <h2 class="htext _h2" v-if="lang=='en'"><span>S</span>pectrum <span>T</span>herapeutics <span>E</span>xperience <span>P</span>rogram</h2>

               <h2 class="htext _h2" v-if="lang=='fn'"><span>P</span>rogramme <span>E</span>xpérience de  <span>S</span>pectrum <span>T</span>herapeutics</h2>
               

                   

            </div>
        </div>
         <div class="container-fluid set-questions">
            <div class="row">
               <div class="col-md-12">
               </div>
            </div>
         </div>
         
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <!-- <hr/> -->
                  </div>
               </div>
            </div>
            <div class="container paddingtop-20 ">
               <div class="row">
                  <div class="col-md-6">
                     <div class="leftspace">
                        <h3  class="h3">{{this.$lang.text_1[lang]}}</h3>
                        <p>{{this.$lang.text_2[lang]}}</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="rightspace">
                        <div class="form">
                           <h3 class="h3"></h3>
                           <form > 
                           <div class="form-group">
                              <div class="text01">{{this.$lang.text_3[lang]}}</div>
                              <input type="text"   ref="my_email" class="form-control input-lg" /> 
                           </div>
                           <div class="form-group">
                              <div class="text01">{{this.$lang.text_4[lang]}}</div>
                              <input type="password" ref="my_password" class="form-control input-lg" /> 
                           </div>

                           <div class="form-group">
                              <div class="text01">{{this.$lang.text_5[lang]}}</div>
                              <select @change="langc" v-model="lang" class="form-control input-lg">
                                 <option value="en">English</option>
                                 <option value="fn">French</option>
                              </select>
                           </div>
                           

                           <div v-if="wrong && lang=='en'" class="alert alert-danger">Wrong credentials</div>
                           <div v-if="wrong && lang=='fn'" class="alert alert-danger">Identifiants incorrects</div>
                           

                           <div class="checkbox">
                              <label><input type="checkbox"> {{this.$lang.text_6[lang]}}</label>
                           </div>
                           <div class="text-left">
                              <button @click.prevent="login()"  title="Send Message" class="btn btn-info  btn-lg">{{this.$lang.text_7[lang]}}</button>
                           </div>
                           <p v-if="lang=='en'" class="text-left text-tnc">By entering this site you agree to our    <a target="_blank" :href="'/'+this.$foldername+'/#/privacy'">Privacy Policy</a>.</p>

                           <p  v-if="lang=='fn'" class="text-left text-tnc">En accédant à ce site, vous acceptez notre <a target="_blank" :href="'/'+this.$foldername+'/#/privacy'">politique</a> en matière de protection des renseignements personnels.</p>

                           
                           </form>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         
      <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
      <footer>
            <div class="sub-footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="wow fadeInLeft" data-wow-delay="0.1s">
                           <div class="text-left">
                              <p>© 2020 CTC Communications All rights reserved.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
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
            password:'',
            wrong:false,
            lang:'en',
         }
         
      },
      mounted(){
         localStorage.setItem('language',this.lang);
         console.log('sdddd');
      },
      methods : {
            langc(){
               console.log('this>>>>',this.lang);
            },
            login(){

                  this.email = this.$refs.my_email.value;
                  this.password = this.$refs.my_password.value;

                  this.wrong=false;
                  console.log(this.email);
                  console.log(this.password);

                axios.post('api/login', {
                        'email':this.email,
                        'password':this.password
                    })
                    .then(response => {
                       console.log('>>>>>>>>>>',response);

                            if(response.status==200){
                                localStorage.setItem('token',response.data.token);
                                localStorage.setItem('user_id',response.data.user.id);
                                let user = JSON.stringify(response.data.user);
                                localStorage.setItem('user',user);
                                localStorage.setItem('pre_meeting',response.data.user.pre_meeting);
                                localStorage.setItem('post_meeting',response.data.user.post_meeting);
                                localStorage.setItem('user',user);
                                localStorage.setItem('name',response.data.user.name);
                                localStorage.setItem('login',true);
                                localStorage.setItem('language',this.lang);
                                localStorage.setItem('role',response.data.user.role);
                                 
                                this.$router.push('/dashboard')
                                .then(res=>{
                                    console.log('res>',res);
                                }).catch(err=>{
                                    console.log('err>',err);
                                })

                            }else{
                                 this.wrong=true;
                                 console.log('res',response);
                            }
                    })
                    .catch(err => {
                        this.wrong=true;
                        console.log('errrrrr-',err);
                    })
            }
      }
}
</script>
<style scoped>
.paddingtop-75{
   padding-top: 80px!important;
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
</style>