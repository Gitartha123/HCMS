<style>
    @media screen and (min-width: 992px) {
        .topnav {
            right:0;left:15%;position:absolute;
        }
    }
    .fa fa-bell{
        rotation: 45deg;
    }
</style>

<script src="public/js/photovalidation.js"></script>
<div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center" id="body">
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
       <div class="w3-row w3-row-padding w3-margin">
           <div class="w3-quarter w3-margin">
               <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                   <a style="text-decoration: none; " href="{{ url('viewrequest2') }}">
                       <i class="w3-xxxlarge fa fa-user" style="color: white"></i>
                       <br><strong class="w3-margin" style="color:white">EMPLOYEE REQUESTS</strong>
                       @php
                            $count =DB::table('request')->where('count','=',0)->count();
                               @endphp
                       <span  class="w3-card w3-blue w3-right w3-large w3-padding  w3-circle"><i class="fa fa-bell-o w3-xlarge" style="transform: rotate(45deg)"></i>{{ $count }}</span>
                   </a>
               </div>
           </div>
           <div class="w3-quarter w3-margin">
               <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                   <a style="text-decoration: none; " href="{{ url('viewrequest2') }}">
                       <i class="w3-xxxlarge fa fa-home" style="color: white"></i>
                       <i class="w3-xlarge fa fa-arrow-right" style="color: white"></i>
                       <br><strong class="w3-margin" style="color:white">LEAVE REQUESTS</strong>
                       @php
                           $count =DB::table('request')->where('count','=',0)->count();
                       @endphp
                       <span  class="w3-card w3-blue w3-right w3-large w3-padding  w3-circle"><i class="fa fa-bell-o w3-xlarge" style="transform: rotate(45deg)"></i>{{ $count }}</span>
                   </a>
               </div>
           </div>
           <div class="w3-quarter">

           </div>
           <div class="w3-quarter">

           </div>
       </div>
    </div>
</div>
</body>









