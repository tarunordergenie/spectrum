/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import vuetify from './vuetify';
import router from './router';
Vue.config.productionTip = false
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.prototype.$foldername = 'spectrum';
 Vue.prototype.$lang = {
    'text_1': {'en':'Welcome' , 'fn':'Bienvenue'},
    'text_2': {'en':'A program to gain a better understanding of initiation and titration principles in the authorization of Spectrum Therapeutics Medical Cannabis (MC) both within your clinical practice with your chronic pain patients and through a group learning environment.' , 'fn':'	Programme visant à vous aider à mieux comprendre les principes d’instauration et d’ajustement posologique propres à l’autorisation d’utilisation du cannabis à des fins médicales de Spectrum TherapeuticsMC dans le cadre de votre pratique clinique auprès de patients souffrant de douleur chronique et d’un processus d’apprentissage collectif.'},
    'text_3': {'en':'Email' , 'fn':'Courriel'},
    'text_4': {'en':'Password' , 'fn':'Mot de passe'},
    'text_5': {'en':'Language' , 'fn':'Langue'},
    'text_6': {'en':'Remember me' , 'fn':'Se souvenir de moi'},
    'text_7': {'en':'Sign in' , 'fn':'Connexion'},
    'text_8': {'en':'By entering this site you agree to our Privacy Policy.' , 'fn':'En accédant à ce site, vous acceptez notre politique en matière de protection des renseignements personnels.'},
    'text_9': {'en':'Doctors' , 'fn':'Médecins'},
    'text_10': {'en':'Role' , 'fn':'Fonction'},
    'text_11': {'en':'S No.' , 'fn':'Numéro de série'},
    'text_12': {'en':'Pre Meeting' , 'fn':'Avant la rencontre'},
    'text_13': {'en':'Patient Assessment' , 'fn':'Évaluation du patient'},
    'text_14': {'en':'patient Follow-Up' , 'fn':'Suivi du patient'},
    'text_15': {'en':'Post Meeting' , 'fn':'Après la rencontre'},
    'text_16': {'en':'© 2020 CTC Communications All rights reserved.' , 'fn':'© 2020 CTC Communications All rights reserved.'},
    'text_17': {'en':'Users ID' , 'fn':'Nom d’utilisateur'},
    'text_18': {'en':'Full Name' , 'fn':'Nom complet'},
    'text_19': {'en':'Province' , 'fn':'Province'},
    'text_20': {'en':'City' , 'fn':'Ville'},
    'text_21': {'en':'Edit' , 'fn':'Modifier '},
    'text_22': {'en':'Pre-Meeting Survey' , 'fn':'Sondage préalable à la rencontre'},
    'text_23': {'en':'Please select from the below options for each question as applicable.' , 'fn':'Veuillez choisir l’une des options suivantes pour chaque question, selon le cas.'},
    'text_24': {'en':'Questions' , 'fn':'Questions'},
    'text_25': {'en':'Very Uncomfortable' , 'fn':'Très mal à l’aise '},
    'text_26': {'en':'Uncomfortable' , 'fn':'Mal à l’aise'},
    'text_27': {'en':'Neither Uncomfortable Nor Comfortable' , 'fn':'Ni mal à l’aise ni à l’aise '},
    'text_28': {'en':'Comfortable' , 'fn':'À l’aise'},
    'text_29': {'en':'Very Comfortable' , 'fn':'Très à l’aise'},
    'text_30': {'en':'Thank you for completing the pre-meeting survey!' , 'fn':'Merci d’avoir répondu au sondage préalable à la rencontre.'},
    'text_31': {'en':'Please proceed to patient assessment after attending webinar!' , 'fn':'Veuillez passer à l’évaluation du patient après avoir participé au webinaire!'},
    'text_32': {'en':'Start new assessment' , 'fn':'Commencer une nouvelle évaluation'},
    'text_33': {'en':'Patient Management Console' , 'fn':'Tableau de bord pour la prise en charge du patient '},
    'text_34': {'en':'Patient’s Initials' , 'fn':'Initiales du patient '},
    'text_35': {'en':'Date of Next Follow Up' , 'fn':'Date du prochain suivi'},
    'text_36': {'en':'Back' , 'fn':'Retour'},
    'text_37': {'en':'Patient Information' , 'fn':'Renseignements sur le patient'},
    'text_38': {'en':'PHYSICIAN MEDICAL CANNABIS AUTHORIZATION' , 'fn':'AUTORISATION D’UTILISATION DE CANNABIS À DES FINS MÉDICALES PAR UN MÉDECIN'},
    'text_39': {'en':'Type' , 'fn':'Type'},
    'text_40': {'en':'Submit' , 'fn':'Soumettre'},
    'text_41': {'en':'Logout' , 'fn':'Déconnexion'},
    'text_42': {'en':'Reset' , 'fn':'Réinitialisation'},
    'text_43': {'en':'Thank you for completing the patient assessment survey!' , 'fn':'Merci d’avoir répondu au sondage d’évaluation du patient!'},
    'text_44': {'en':'Home' , 'fn':'Accueil'},
    'text_45': {'en':'Do Another' , 'fn':'Répondre à un autre sondage'},
    'text_46': {'en':'Reschedule' , 'fn':'Reporter'},
    'text_47': {'en':'Scheduled' , 'fn':'Prévu'},
    'text_48': {'en':'Click to Enter' , 'fn':'Cliquer pour entrer'},
    'text_49': {'en':'Go' , 'fn':'Commencer'},
    'text_50': {'en':'Search' , 'fn':'Recherche'},
    'text_51': {'en':'Users' , 'fn':'Users'},
    'text_52': {'en':'Add' , 'fn':'Add'},
    'text_53': {'en':'Add Doctor' , 'fn':'Add Doctor'},
    'text_54': {'en':'Select role' , 'fn':'Select role'},
    'text_55': {'en':'Select province' , 'fn':'Select province'},
    'text_56': {'en':'Select city' , 'fn':'Select city'},
    'text_57': {'en':'Date Of Webinar' , 'fn':'Date Of Webinar'},
    'text_58': {'en':'dd-mm-yyyy' , 'fn':'dd-mm-yyyy'},
    'text_59': {'en':'select language' , 'fn':'select language'},
} ;
 
import App from './components/AppComponent';
import Header from './components/includes/HeaderComponent.vue';
import Footer from './components/includes/FooterComponent.vue';
new Vue({
    el: '#app',
    vuetify,
    router,
    components:{
        'App':App,
        'Header':Header,
        'Footer':Footer,
    }
});
