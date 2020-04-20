<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://unpkg.com/qs/dist/qs.js"></script>


<style>
.tile {
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 2px 3px -1px rgba(151, 171, 187, 0.7);
  float: left;
  transform-style: preserve-3d;
  margin: 10px 5px;
}
.banner-img {
  padding: 0px 0px 0;
  width: 100%;
}
.banner-img img {
  width: 100%;
  border-radius: 3px;
  height: 200px !important;
}
.stats {
  background: #ffffff;
  overflow: auto;
  padding: 0 15px;
  font-size: 11px;
  color: #59687f;
  font-weight: 600;
}
.stats div {
  float: left;
  text-align: left;
}
.stats div:nth-of-type(3) {
  border: none;
}
div.footer {
  text-align: center;
  position: relative;
  margin-top: 15px;
  margin-bottom: 15px;
}
div.footer a.Cbtn {
  display: table;
  width: auto; /*matching the parents div width*/
  margin: 1.3em auto 0;
  padding: 10px 90px;
  border-radius: 3px;
  font-weight: 700;
  text-transform: uppercase;
  max-width: 500px;
  min-width: 10px;
}
div.footer a.Cbtn-primary {
  background-color: #ff7300;
  color: #fff;
}
div.footer a.Cbtn-primary:hover {
  background-color: #e0914f;
  color: black;
}
div.footer a.Cbtn-danger {
  background-color: #fc5a5a;
  color: #fff;
}
div.footer a.Cbtn-danger:hover {
  background-color: #fd7676;
}
.wef-strong {
  float: left;
}
.wef-header {
  padding: 10px 15px;
  text-align: left !important;
  color: #59687f;
  font-size: 600;
  font-size: 18px;
  position: relative;
}
.grid-wrap {
  display: grid;
  grid-template-columns: 1fr;
  margin-bottom: 38px;
  grid-gap:8px;
}

@media screen and (min-width: 500px) {
  .grid-wrap {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media screen and (min-width: 800px) {
  .grid-wrap {
    grid-template-columns: 1fr 1fr 1fr 1fr ;
  }
}
</style>



<div id="category-page">

    
    <div>
    
    
        <h1 style="position: absolute;top: 50px;left: 50px;color: white;font-size: 48px;font-weight: 400;">{{categoryDisplay.name}}</h1>
        
        <img v-bind:src="categoryDisplay.imageBannerURL" style="height: 290px;width: 100%;" />

    </div>

    <div class="grid-wrap">

    <div  v-for="event in eventsPerCategory">
        <div class="tile" >
            <div class="wrapper">

                    <div class="banner-img">
                        <a v-bind:href="'https://ydf.tulumi.com/event/?id=' + event.id">
                        <!-- <a v-bind:href="'http://events.test/event/?id=' + event.id"> -->
                            <img v-bind:src="event.image"/>
                        </a>
                    </div>

                    <div class="wef-header">{{event.name}}</div>
                    <div class="stats">
                        <span class="wef-strong">{{event.date}}</span>
                    </div>
                    <div class="stats">
                        <span class="wef-strong">{{event.genre}}</span>
                    </div>
                    <div class="footer">
                        <!-- <a v-bind:href="'http://events.test/event/?id=' + event.id" class="Cbtn Cbtn-primary">View</a> -->
                        <a v-bind:href="'https://ydf.tulumi.com/event/?id=' + event.id" class="Cbtn Cbtn-primary">View</a>
                    </div>
            </div>
        </div>
    </div>

</div>

</div>


<script>

 var months = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
];

var days = [
  'Sun',
  'Mon',
  'Tue',
  'Wed',
  'Thu',
  'Fri',
  'Sat'
];

var categPage = new Vue({
    el : "#category-page",
    data : {
        test : "Hello World",
        eventsPerCategory : [],
        categoryName: '',
        categoryDisplay : {name : "", imageBannerURL : ""}
    },
    created(){
        var urlParam = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            urlParam[key] = value;
        });

        if(urlParam.categ === "festivals_parades"){
            this.categoryDisplay.name = "Festival";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/festivals-1.png";
            
        }else if(urlParam.categ === "comedy"){
            this.categoryDisplay.name = "comedy";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/comedy-1.png";
            
        }else if(urlParam.categ === "family_fun_kids"){
            this.categoryDisplay.name = "Family";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/family-1.png";
            
        }else if(urlParam.categ === "singles_social"){
            this.categoryDisplay.name = "Nightlife";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/nightlife-1.png";
            
        }else if(urlParam.categ === "performing_arts"){
            this.categoryDisplay.name = "Performing Arts";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/performing-arts-1.png";
            
        }else if(urlParam.categ === "sports"){
            this.categoryDisplay.name = "Sports";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/sports-1.png";
            
        }else if(urlParam.categ === "music"){
            this.categoryDisplay.name = "Concert";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/concert-1.png";
            
        }else if(urlParam.categ === "food"){
            this.categoryDisplay.name = "Food and Wine";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/food-and-wine-1.png";
            
        }else if(urlParam.categ === "clubs_associations"){
            this.categoryDisplay.name = "Networking";
            this.categoryDisplay.imageBannerURL = "https://ydf.tulumi.com/wp-content/uploads/2020/04/networking-1.png";
        }



        this.categoryName = urlParam.categ;
    },
    mounted(){
        // var url = `http://api.eventful.com/json/events/search?app_key=Vsw2p5hBJfkPRZ4M&where=27.994402,-81.760254&within=65550&oauth_nonce=16680057&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1585705754&oauth_version=1.0&oauth_signature=sho1odEu%2Ft%2FNLHQnIawte2%2BZbJU%3D&category=${this.categoryName}&oauth_consumer_key=819e35b34e2086058569`
        // const url = `http://events.test/wp-admin/admin-ajax.php?action=test_req`
        const url = `https://ydf.tulumi.com/wp-admin/admin-ajax.php?action=test_req`

        const objReq = {"action":"test_req", "categ": this.categoryName}
        // console.log(objReq)

        axios.post(url, Qs.stringify( objReq ))
        .then ((res)=> {
            var normalizeMe = res.data;
            // console.log(res)
            this.eventsPerCategory = normalizeMe.map((efEvent) => {

                event = {};
                // console.log('name : ', efEvent.title)
                event['id'] = efEvent.id;
                event['name'] = efEvent.title;
                // console.log(event.name)

                // console.log('URL : ',efEvent.url)
                event['url'] = efEvent.url;

                // console.log('image : ',efEvent.image ? efEvent.image.medium.url : 'N/A')
                event['image'] = efEvent.image ? efEvent.image.medium.url : '';

                // console.log('date : ', efEvent.start_time)
                // console.log('date : ',efEvent.dates.start.dateTime ? efEvent.dates.start.dateTime : efEvent.dates.start.localDate)
                
                eventTime = new Date(efEvent.start_time);
                var dayName = days[eventTime.getDay()];
                var monthName= months[eventTime.getMonth()];
                date = eventTime.getDate();
                
                hrs = eventTime.getHours();
                hrs = (hrs % 12) || 12;
                var AmOrPm = hrs >= 12 ? 'PM' : 'AM';
                
                tme = eventTime.getMinutes();
                
                var formatted = `${dayName}, ${monthName} ${date} - ${hrs}:${tme == 0 ? "00" : tme} ${AmOrPm}`;
                event['date'] = formatted;
                // event['date'] = efEvent.start_time;

                // console.log('genre : ',efEvent.classifications[0].genre.name)
                event['genre'] =  'N/A';

                // console.log('Venue Name : ',efEvent.venue_address)
                event['venue'] = efEvent.venue_address;

                // console.log('City : ',efEvent.city_name)
                event['city'] = efEvent.city_name;

                // console.log('description : ',efEvent.description ? efEvent.description : 'N/A')
                event['desc'] = efEvent.description ? efEvent.description : 'N/A';

                // console.log('creator  : ',efEvent.owner)
                event['creator'] = efEvent.owner;

                // console.log('latitude  : ',efEvent.latitude)
                // console.log('longitude  : ',efEvent.longitude)
                event['latitude'] = efEvent.latitude;
                event['longitude'] = efEvent.longitude;

                return event;
            })

        })
        .catch ((error)=> console.log(error))
        
    }
})


</script>