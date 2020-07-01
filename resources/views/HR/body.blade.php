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
<div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center" id="body"  style="background-image: url('{{ asset('resources/views/image/effective-employee-management.jpg') }}'); background-repeat: no-repeat;   background-size: auto;   background-position: center; height:100%;-webkit-background-size:cover;">
    @include('header')
    <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
       <div class="w3-row w3-row-padding w3-margin">
           <div class="w3-quarter w3-margin">
               <div class="w3-card-4 w3-round w3-padding zoom"; style="background-image: url('{{ asset('resources/views/image/Top-60-Employee-Engagement-image43-1024x510(2).png') }}');background-repeat: no-repeat;   background-size: auto;   background-position: center;height: 100px;-webkit-background-size:cover;">
                   <a style="text-decoration: none; "onclick="document.getElementById('id01').style.display ='block'">
                       <i class="w3-xxxlarge fa fa-user" style="color: white"></i>
                       <br><strong class="w3-margin" style="color:white">EMPLOYEE REQUESTS</strong>
                       @php
                            $count =DB::table('request')->where('count','=',0)->count();
                            $count2 = DB::table('employeeleave')->where('count','=',0)->count();
                               @endphp
                       <span  class="w3-card w3-blue w3-right w3-large w3-padding  w3-circle"><i class="fa fa-bell-o w3-xlarge" style="transform: rotate(45deg)"></i>{{ $count + $count2}}</span>
                   </a>
               </div>
           </div>

           <div class="w3-quarter w3-margin">
               <div class="w3-card-4 w3-round w3-padding zoom"; style="background-image: url('{{ asset('resources/views/image/index(1).png') }}');background-repeat: no-repeat;   background-size: auto;   background-position: center;height: 100px;-webkit-background-size:cover;">
                   <a style="text-decoration: none; "onclick="document.getElementById('id05').style.display ='block'">
                       <i class="w3-xxxlarge fa fa-plane" style="color: white"></i>
                       <br><strong class="w3-margin" style="color:white">MANAGE HOLIDAY</strong>
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


<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center " id="body" style="background-color: rgba(0,0,0,0.5)">
                <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
                      <span onclick="document.getElementById('id01').style.display='none'"
                            class="w3-button w3-display-topright w3-red"><i class="fa fa-close"></i> </span>
                    <div class="w3-row w3-row-padding w3-margin">
                        <div class="w3-half">
                            <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                                <a style="text-decoration: none; " href="{{ url('employeeleaverequest') }}">
                                    <i class="w3-xxxlarge fa fa-home" style="color: white"></i>
                                    <i class="w3-xlarge fa fa-arrow-right" style="color: white"></i>
                                    <br><strong class="w3-margin" style="color:white">LEAVE REQUESTS</strong>
                                    <span  class="w3-card w3-blue w3-right w3-large w3-padding  w3-circle"><i class="fa fa-bell-o w3-xlarge" style="transform: rotate(45deg)"></i>{{ $count2 }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="w3-half">
                            <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                                <a style="text-decoration: none; " href="{{ url('viewrequest2') }}">
                                    <i class="w3-xxxlarge fa fa-phone" style="color: white"></i>
                                    <br><strong class="w3-margin" style="color:white">CONTACT UPDATE REQUESTS</strong>
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
        </div>
    </div>
</div>
<div id="id05" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center " id="body" style="background-color: rgba(0,0,0,0.5)">
                <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
                      <span onclick="document.getElementById('id05').style.display='none'"
                            class="w3-button w3-display-topright w3-red"><i class="fa fa-close"></i> </span>
                    <div class="w3-row w3-row-padding w3-margin">
                        <div class="w3-half">
                            <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                                <a style="text-decoration: none; " onclick="document.getElementById('id06').style.display ='block'">
                                    <i class="w3-xxxlarge fa fa-plus" style="color: white"></i>
                                    <br><strong class="w3-margin" style="color:white">ADD HOLIDAY</strong>
                                </a>
                            </div>
                        </div>
                        <div class="w3-half">
                            <div class="w3-card-4 w3-round w3-padding zoom"; style="background-color: #00CC66;height: 100px;">
                                <a style="text-decoration: none; " href="{{ url('showholidaylist') }}">
                                    <i class="w3-xxxlarge fa fa-list" style="color: white"></i>
                                    <br><strong class="w3-margin" style="color:white">VIEW HOLIDAY LIST</strong>
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
        </div>
    </div>
</div>

<div id="id06" class="w3-modal ">
    <div class="w3-modal-content">
        <div class="w3-container w3-center w3-margin" >
            <div class="w3-card-4 w3-padding  w3-animate-zoom  item topnav w3-center w3-light-blue" id="body" style="max-width: 500px;">
                <div class="w3-card-4  w3-padding w3-border-aqua w3-round-medium ">
                      <span onclick="document.getElementById('id06').style.display='none'"
                            class="w3-button w3-display-topright w3-red"><i class="fa fa-close"></i> </span>
                    <div class="w3-row w3-row-padding w3-margin">
                        <div class="w3-card-4 w3-round w3-padding"; style="background-color: #00CC66;">
                            <form action="{{ route('saveholiday') }}" method="post">
                                @csrf
                                    <div class='input-group date' id='Date' name="dob">
                                        <input type='text'  class="w3-input w3-border " placeholder="From" id="dob" name="from" autocomplete="off" >
                                        <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                                    </div>
                                <p></p>
                                <div class='input-group date' id='Joindate'>
                                    <input type='text' class="w3-input w3-border" id="joindate" name="to" placeholder="To" autocomplete="off">
                                    <span class="input-group-addon ">
                  <span class="glyphicon glyphicon-calendar "></span>
              </span>
                                </div>

                                <p></p>
                                <input type="text" class="w3-input" placeholder="Event" name="event">

                                <p></p>
                                <button type="submit" class="w3-btn w3-hover-red w3-round w3-light-blue">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>









