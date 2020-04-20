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


<div id="search-page">
    <h4>There are {{events.length}} “{{query.split("+").join(" ")}}” events in this area.</h4>
    <div class="grid-wrap">
    <div  v-for="event in events">
        <div class="tile" >
            <div class="wrapper">

                    <div class="banner-img">
                        <!-- <a v-bind:href="'http://events.test/event/?id=' + event.id"> -->
                        <a v-bind:href="'https://ydf.tulumi.com/event/?id=' + event.id">
                            <img v-bind:src="event.image"/>
                        </a>
                    </div>

                    <div class="wef-header">{{excerpt(event.name)}}</div>
                    <div class="stats">
                        <span class="wef-strong">{{event.date}}</span>
                    </div>
                    <div class="stats">
                        <span class="wef-strong">{{event.genre}}</span>
                    </div>
                    <div class="footer">
                        <a v-bind:href="'https://ydf.tulumi.com/event/?id=' + event.id" class="Cbtn Cbtn-primary">View</a>
                        <!-- <a v-bind:href="'http://events.test/event/?id=' + event.id" class="Cbtn Cbtn-primary">View</a> -->
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

var searchPage = new Vue({
    el: '#search-page',
    data : {
        test : 'asdsad',
        query : '',
        city : '',
        url : '',
        events : [],
        eventCount : null,
        queryDisplay : '',
        date:''
    },
    created(){
        const urlParams = new URLSearchParams(window.location.search);
        this.query = urlParams.get('keyword') ? urlParams.get('keyword').toLowerCase().split(" ").join("+") : '';
        this.city = urlParams.get('city').toLowerCase().split(" ").join("+");
        this.date = urlParams.get('filtered').includes('month') ? months[new Date().getMonth() + 1] : urlParams.get('filtered');


        this.url = window.location.origin;
        // console.log("month",this.date);
        // console.log(this.date.includes("month"));

    },    
    methods : {
        excerpt : function(val) {
          return val.length > 24 ? val.substr(0, 24) + "..." : val;
      }
    },
    mounted() {
        const url = `${window.location.origin}/wp-admin/admin-ajax.php?action=search_event`;
        const objReq = {"action":"search_event", "keyword": this.query, "city" : this.city, "date":this.date }
        // console.log(url);
        axios.post(url, Qs.stringify( objReq )).then((res) => {
            console.log(res)

            const normalizedMe = res.data.events.event;
            this.events = normalizedMe.map((efEvent) => {
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
        }).catch(err => console.log(err));
    }
})

</script>

