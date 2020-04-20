<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">


<style>
.search-bar-title{
    font-family: Montserrat,sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 60px !important;
    line-height: 65px !important;
    letter-spacing: .1px;
    color: #000;
    text-align: left;
}
.search-field{
    font-size: 24px !important;
    border:none !important;
    background-color: white !important;
    border-radius: 8px !important; 
    box-shadow:  6px 6px 9px #d9d9d9,-6px -6px 9px #ffffff !important;
    margin-right: 8px !important;
}
.search-btn{
    padding: 0 !important;
    color: #ffffff;
    border-color: #ffffff !important;
    background-color: #ffffff !important;
    
    border-radius: 8px !important; 
    padding: 8px 24px !important;
    box-shadow:  6px 6px 9px #d9d9d9,-6px -6px 9px #ffffff !important;
    
}
    .inp-search{
        width: 43%;
        flex: 43%;
    }
    .inp-location{
        width: 43%;
        flex: 43%;
    }
@media only screen and (min-width: 300px) and (max-width: 500px){

    .inp-search{
        width: 100%;
        flex: 100%;
        margin-top: 20px;
    }
    .inp-location{
        width: 100%;
        flex: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
        
    }
}
</style>

<div id="search-bar">

    <h1 class="search-bar-title">Find Stuff to Do<br>Near You</h1>
    
    <div style="padding:24px;">

        <input type="text" placeholder="Search for Events" class="search-field inp-search"  id="search-i" v-model="query"/>
        
        <select class="search-field inp-location" id="city-s" v-model="city" >
            <option value="" disabled selected hidden>Anywhere in Florida</option>
            <option>Miami</option>
            <option>Daytona</option>
            <option>Orlando</option>
            <option>Houston</option>
            <option>Jacksonville</option>
            <option>Myers</option>
            <option>Pensacola</option>
            <option>St. Petersburg</option>
            <option>Tampa</option>
        </select>

        <button class="search-btn" v-on:click="search"><i class="material-icons md-48" style="line-height: 2 !important; color: #77777b !important;">search</i></button>

    </div>

</div>


<script>

var searchBar = new Vue({
    el: '#search-bar',
    data: {
        query : '',
        city : ''
    },
    methods : {
        search : function(){
            this.city = this.city.length == 0 ? 'florida' : this.city;

            // var still = this.query.includes(" ");
            var passQuery = this.query.split(" ").join("+");
            var passCity = this.city.split(" ").join("+");


            window.location.replace(`${window.location.origin}/search/?city=${passCity}&keyword=${passQuery}`);
            /*
            const urlParams = new URLSearchParams(window.location.search);
            const product = urlParams.get('keyword')

            */
        }
    }
})

</script>