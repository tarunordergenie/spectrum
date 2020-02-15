<template>
<div class="dashboard">
      <!-- <Header /> -->
      <router-view></router-view>
      <Footer />
   
</div>  
</template>
<script>
        
    import Header from '../components/includes/HeaderComponent';
    import Footer from '../components/includes/FooterComponent';

    export default {
        mounted() {
            console.log('App Component mounted.')

        },
        components: {
               Header,
               Footer
            }
    }
</script>
<style scoped>

</style>