<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<style>
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




<div id="see-more-events">
    <div class="grid-wrap">

        <div  v-for="event in eventsToShow">
            <div class="tile" >
                <div class="wrapper">

                        <div class="banner-img">
                            <!-- <a v-bind:href="'http://events.test/event/?id=' + event.id"> -->
                            <a v-bind:href="'https://ydf.tulumi.com/event/?id=' + event.id">
                                <img v-bind:src="event.image"/>
                            </a>
                        </div>

                        <!--<div class="wef-header">{{event.name}}</div>-->
                        <div class="wef-header">{{excerpt(event.name)}}</div>
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

        <div align="center">
            <input v-on:click="see" id="semore" type="submit" name="seeMore" value="See More" style="color: #06c; background-color: transparent !important; border: 2px solid #06c;"/>
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

var seeMoreEvents = new Vue({
    el: "#see-more-events",
    data: {
        events : [],
        eventsToShow : [],
        min: 0,
        max : 4
    },
    methods : {
        see : function(){
            this.max += 4; 
            this.eventsToShow = this.events.slice(this.min, this.max);
            
        },
        excerpt : function(val) {
          return val.length > 26 ? val.substr(0, 26) + "..." : val;
      }
        
    },
    created(){
        events = [];
        events = ticketmaster.map((tmEvent) => {
            event = {};
            // console.log('name : ', tmEvent.name)
            event['id'] = tmEvent.id;
            event['name'] = tmEvent.name;

            // console.log('URL : ',tmEvent.url)
            event['url'] = tmEvent.url;

            // console.log('image : ',tmEvent.images[4].url)
            event['image'] = tmEvent.images[4].url;

            // console.log('data : ',tmEvent.dates.start)
            // console.log('date : ',tmEvent.dates.start.dateTime ? tmEvent.dates.start.dateTime : tmEvent.dates.start.localDate)
            
            eventTime = new Date(tmEvent.dates.start.dateTime ? tmEvent.dates.start.dateTime : tmEvent.dates.start.localDate);
            var dayName = days[eventTime.getDay()];
            var monthName= months[eventTime.getMonth()];
            date = eventTime.getDate();
            
            hrs = eventTime.getHours();
            hrs = (hrs % 12) || 12;
            var AmOrPm = hrs >= 12 ? 'PM' : 'AM';
            
            tme = eventTime.getMinutes();
            
            var formatted = `${dayName}, ${monthName} ${date} - ${hrs}:${tme == 0 ? "00" : tme} ${AmOrPm}`;
            event['date'] = formatted;
            
            // event['date'] = tmEvent.dates.start.dateTime ? tmEvent.dates.start.dateTime : tmEvent.dates.start.localDate;

            // console.log('genre : ',tmEvent.classifications[0].genre.name)
            event['genre'] =  tmEvent.classifications[0].genre.name;

            // console.log('Venue Name : ',tmEvent._embedded.venues[0].name)
            event['venue'] = tmEvent._embedded.venues[0].name;

            // console.log('City : ',tmEvent._embedded.venues[0].city.name)
            event['city'] = tmEvent._embedded.venues[0].city.name;

            // console.log('description : ',tmEvent._embedded.venues[0].city.name)
            event['desc'] = 'N/A';

            // console.log('creator  : ',tmEvent.promoter ? tmEvent.promoter.name : "N/A")
            event['creator'] = tmEvent.promoter ? tmEvent.promoter.name : 'N/A';

            // console.log('latitude  : ',tmEvent._embedded.venues[0].location.latitude)
            // console.log('longitude  : ',tmEvent._embedded.venues[0].location.longitude)
            event['latitude'] = tmEvent._embedded.venues[0].location.latitude;
            event['longitude'] = tmEvent._embedded.venues[0].location.longitude;


            return event;

            // console.log('---------------------------------------------------------------------------------------------------------------------------------------------------------------')
        })

        eventful.map((efEvent) => {
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
            // console.log(event)
            // console.log('---------------------------------------------------------------------------------------------------------------------------------------------------------------');

            events = [...events, event]
        })

        // console.log(events)
        this.events = events;

    },
    mounted(){
        this.eventsToShow = this.events.slice(this.min, this.max);
    }
})

</script>


<script>

document.addEventListener('DOMContentLoaded', (event) => {
    const doc = event.target;
    var excerptMe = doc.getElementsByClassName('wef-header');
    for(i = 0; i < excerptMe.length; i++){
        excerptMe[i].innerText = excerptMe[i].innerText.length > 26 ? excerptMe[i].innerText.substr(0, 26) + "..." : excerptMe[i].innerText;
    }
    
})
</script>