<template>
    <div class="header">
        <nav class="navbar navbar-custom set-affix-top"  role="navigation">
            <div class="container-fluid navigation">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" :href="'/'+this.$foldername+'/#/dashboard'">
                <img src="public/assets/img/logo.png" alt=""  />
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li v-if="login">
                        <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"> 
                            <div class="userdiv">
                                <span class="name" v-if="role=='2' || role=='3'">Dr. {{name}}</span>
                                <span class="name" v-if="role=='1' || role=='0'"> {{name}}</span>
                                <span class="thum">{{thumb}}</span>
                            </div>
                            <!-- <b class="caret"></b> -->
                            </a>
                        <ul class="dropdown-menu">
                            <li v-if="role=='1'"><a :href="'/'+this.$foldername+'/#/dashboard/users'">Users</a></li>
                            
                            <li><a :href="'/'+this.$foldername+'/#/dashboard/profile'">Edit Profile</a></li>
                            <li><a href="javascript:void(0)" @click="logout">Logout</a></li>
                        </ul>
                        </div>
                        
                    </li>
                     <!-- <li>
                        <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">English <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                        </ul>
                        </div>
                    </li> -->
                     
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>    
    </div>
</template>
<script>
export default {
        data(){
            return{
                login:false,
                role:'',
                name:localStorage.getItem('name').toUpperCase(),
                thumb:'',
            }
        },
        mounted() {
            // console.log('Header Component mounted.',this.login);
            if(localStorage.getItem('token')){
                this.login=true;
            }else{
                this.login=false;
            }
            this.role=localStorage.getItem('role')
            var myStr = this.name.trim();
            var strArray = myStr.trim().split(" ");
            // console.log('ppppppp',strArray.length);
            if(strArray.length>1){
                    this.thumb = strArray[0].charAt(0)+strArray[1].charAt(0);		
            }else{
                    this.thumb = strArray[0].charAt(0)+strArray[0].charAt(1);		
            }
            this.thumb=this.thumb.toUpperCase();
        },
        methods:{
            logout:function(){
                localStorage.clear();
                this.login=false;
                this.$router.push('/');
                
            }
        } 
}
</script>
<style scoped>

</style>