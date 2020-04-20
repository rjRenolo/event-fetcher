
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://unpkg.com/qs/dist/qs.js"></script>

<style>
.sect-c {
  /* border: 1px solid green; ------------------------------------------------------------------------------ */
  /* background: #f9f9f9;
  margin: 50px 0;
  padding-bottom: 5rem;
  border-radius: 6px; */
  border-radius: 12px;
background: #ffffff;
box-shadow:  9px 9px 18px #d4d4d4, -9px -9px 18px #ffffff;
    margin: 50px 0;
    padding-bottom: 5rem;
}

.group-one {
  margin-bottom: 5rem;
}

.img-sustain {
  width: 100%;
  height: 100%;
}

.separ {
  margin: 15px 0;
}

/*   -------- 2nd group landing page below-------   */
.format-container {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 90%;
}

.grp-once {
  height: auto;
  margin-top: 20px;
  padding: 10px;
  /* border-radius: 5px; */
  /* background: #ffffff; */
  /* box-shadow: 3px 6px rgba(0, 0, 0, 0.1) !important; */
  /* border-top: 2px solid black; */
  border-radius: 12px;
background: #ffffff;
box-shadow:  9px 9px 18px #d4d4d4, -9px -9px 18px #ffffff;
}

/* container */
.contain {
  /* border: 0.5px solid red !important; ------------------------------------------------------------------------------ */
  padding-bottom: 3rem;
}

.alignleft {
  font-weight: 600;
  float: left;
  padding: 10px;
  /* border: 0.5px solid green; ------------------------------------------------------------------------------ */
}

.alignright {
  font-weight: 600;
  float: right;
  padding: 10px;
  /* border: 0.5px solid green; ------------------------------------------------------------------------------ */
}

.divxy {
  vertical-align: middle;
  margin: 50px 0;
}

.divy {
  /* margin-top: 15px;  */
  text-align: left;
  padding: 10px;
  /* border: 0.5px solid red !important; ------------------------------------------------------------------------------ */
}
.chip-wrapper{
    border-radius: 12px;
background: #ffffff;
box-shadow:  9px 9px 18px #d4d4d4, 
             -9px -9px 18px #ffffff;
             padding: 8px 12px;
             margin-right: 8px;
}
.event-span{
    font-size: 24px;
    font-weight: 400;
    font-family: roboto;
}
.event-title-h1{
    /* font-family: Montserrat,sans-serif; */
    font-family: roboto;
    font-size: 46px;
    font-weight: 300;
    letter-spacing: .1px;
    text-align: center;
    color: #1e1f22;
}
.event-link{
    font-size: 16px;
    font-weight: 600;
    letter-spacing: .1px;
    color: #78818b;
    text-transform: uppercase;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: linear-gradient(67deg,#f5286e,#fc6d43);
    width: 85px;
    cursor: pointer;
    line-height: 30px;
}
.event-desc{
    font-size: 18px;
    line-height: 1.67;
    letter-spacing: .1px;
    text-align: justify;
    white-space: pre-line;
}
</style>


<div id="single-event">
<section class="sect-c">
        <div class="row group-one">
            <div class="col-lg-6 col-md-12 ">
                <div class="mini-banner">    
                    <img class="img-sustain" v-bind:src="event.image" />
                </div>
            </div>
            <div class="col-lg-6 col-md-12 ">
                <div class="mini-banner text-center">
                    <h3 class="separ" class="event-title-h1">{{event.name}}</h3>


                    <div style="display:flex; margin-bottom: 8px;">
                        <div class="chip-wrapper">
                            <span class="event-span">Start</span>
                        </div>
                        <div style="display:flex; display: flex;width: 80%;justify-content: space-evenly; " class="chip-wrapper">
                            <span class="event-span">{{event.date}}</span>
                            <!-- <span class="event-span">{time}</span> -->
                        </div>
                    </div>

                    <!-- <div style="display:flex">
                        <div class="chip-wrapper">
                            <span class="event-span">Start</span>
                        </div>
                        <div style="display:flex; display: flex;width: 80%;justify-content: space-evenly; " class="chip-wrapper">
                            <span class="event-span">{Date 1}</span>
                            <span class="event-span">{time}</span>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        <div class="container format-container">
        <div class="grp-once">
        <div class="contain">
            <div class="alignleft">DESCRIPTION</div>
            <div class="alignright"><a v-bind:href="event.url" target="_blank" class="event-link">WEBSITE > </a></div>
        </div>
        <div class="">
                <div class="divy">
                <p class="event-desc">
                    {{event.desc}}
                </p>
                </div>
            </div>
        </div>


        <div class="grp-once">
        <div class="contain">
            <div class="alignleft">LOCATION</div>
            <!-- https://www.google.com/maps/place/33.7717008,-84.3726049 -->
            <div class="alignright"><a v-bind:href="'https://www.google.com/maps/place/' + event.latitude + ',' + event.longitude" target="_blank" class="event-link">DIRECTIONS > </a></div>
        </div>
        <div class="text-center">
                <div class="divxy">
                    <h3 style="margin-bottom: 4px;">{{event.city}}</h3>
                    <p>{{event.venue}}</p>
                </div>
            </div>
        </div>


        <div class="grp-once">
        <div class="contain">
            <div class="alignleft">EVENT CREATOR</div>
            <div class="alignright"></div>
        </div>
        <div class="text-center">
                <div class="divy text-center">
                <h3 style="margin-bottom: 4px;">{{event.creator}}</h3>
                </div>
            </div>
        </div>
        </div>
        </section>
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

var ev = new Vue({
    el : "#single-event",
    data : {
        events : [],
        eventId : '',
        event : {}
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
            event['date'] = efEvent.start_time;

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
    mounted() {
        var urlParam = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            urlParam[key] = value;
        });
        this.eventId = urlParam.id;
        // const ev = this.event;
        // console.log(isEmpty(ev))
        this.events.map(event => {
            if(event.id === urlParam.id){
                this.event = event;
            }
        })

        if(isEmpty(this.event)){
            // call ajax that will query the event
            const url = `https://ydf.tulumi.com/wp-admin/admin-ajax.php?action=single_event`
            const objReq = {"action":"single_event", "id": this.eventId}

            axios.post(url, Qs.stringify( objReq ))
            .then ((res)=> {
                const efEvent = res.data;
                event = {};
                // console.log('name : ', efEvent.title)
                event['id'] = efEvent.id;
                event['name'] = efEvent.title;
                // console.log(event.name)

                // console.log('URL : ',efEvent.url)
                event['url'] = efEvent.url;

                // console.log('image : ',efEvent.image ? efEvent.image.medium.url : 'N/A')
                event['image'] = efEvent.images ? efEvent.images.image.medium.url : '';

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

                this.event = event;


            }).catch((err)=>console.log(err));
        }


        function isEmpty(obj) {
            for(var key in obj) {
                if(obj.hasOwnProperty(key))
                    return false;
            }
            return true;
        }
    }
})
</script>