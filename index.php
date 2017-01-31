
<!DOCTYPE html>
<html>

<?php

   include('functions.php');
   session_start();


?>
   <head>
        <meta name="viewport" content="initial-scale=1.0">
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/dropdown.css" media="screen" type="text/css" />


      <style type="text/css">

        .footer{

         }

         #month{padding: 10px;}
         p{color: black; font-family: Futura,Trebuchet MS,Arial,sans-serif;
         font-size: 90%;
         font-weight: normal;}
         h1{color: black; text-align: left;}
         h2{color: black;  text-align: left;}
         h1   { text-align: left; }
         html { height: 1100px; width: 100%;  background-color: #f9f9f9;}

         body {  height: 1100px; width: 100%; background-color: #f9f9f9; overflow-y: scroll;  margin: auto; }

   /* these ids are inside the body container which is 1000 x 1300  */
           #map-container{ height: 700px ; width: 100%; margin: auto; background-color: #f9f9f9;  margin-top: 120px; z-index: 0; padding: 0px; border: 1px solid #f9f9f9; padding-top: 0px; overflow-y: scroll; overflow-x: hidden; }
              #map-canvas { float: left; height: 700px ; width:75%; z-index: 0;  border: 1px solid grey; box-shadow: 0px 5px 4px 2px rgba(0,0,0,.2);}
              #nav{ width: 24.8%; height: 700px; float: left; background-color: #bd0e36; z-index: -1;}
           #bottom{ height: 400px ; width:100%; background-color: white;  margin:auto; z-index: 0; padding: 0px; border: 1px solid #f9f9f9; padding-top: 0px; overflow-y: scroll; overflow-x: hidden; position: relative; float: left; }

      /* top bar fixed */
           #map-top {  height: 120px; width: 100%; position: fixed; top: 0px; left: 0px; background-color: white; z-index: 1;  box-shadow: 0 8px 6px -6px #999;}
           #map-top-inside { height: 100%; width: 30%; background-image: url("toplogo2.jpg"); background-repeat:no-repeat; float:left; z-index: 1;}
           #map-top-inside-middle { height: 100%; width: 40%; background-image: url("toplogo.jpg"); background-repeat:no-repeat; float:left; z-index: 1;}
           #map-top-inside-right { height: 100%; width: 20%;float:right; z-index: 1;}


         div#test{ border:#000 1px solid; padding:10px 40px 40px 40px; }
         .w3-btn { width: 60px; height: 30px; }
         .w3-container{  background-color: grey; height: 30px; width: 60px;}

         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
           width: 100%;
         }
         td {
           border: none;
           text-align: left;
           padding: 10px;
           height: 30px;
         }


         .info{ height: 300px; width: 500px; padding: 0px; margin: 0px;}
         #infotop{width: 100%; height: 40px; background-color: blue;}

         .lists{
           width: 100%;
           background-color: white;
           padding: 5px;

         }
         .lists:hover{
           background-color: #e8e8e8;

           cursor: pointer;
         }
         button.accordion:after {
            content: '\003E';
            font-size: 20px;
            color: white;
            float: right;
            margin-left: 5px;
        }

        button.accordion.active:after {
            content: "\2796";
        }
        ::-webkit-scrollbar {
            width: 15px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */

        }
        /* optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: white;
            border: 1px solid #f4f4f4;


        }
         button.accordion {
           background-color: #bc0d35;
           color: white;
           cursor: pointer;
           padding: 18px;
           width: 100%;
           text-align: left;
            font-size: 100%;
            font-family: Futura,Trebuchet MS,Arial,sans-serif;
            font-size: 96%;
            font-weight: bold;
           border: none;
           outline: none;
           transition: 0.2s;
           border-radius: 0px;
           border: 1px solid #9a0b2c;
           margin-bottom: 0px;

         }
         #tabletop{background-color: #79dd75; font-weight: bold; font-size: 16px;}

         /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
         button.accordion.active, button.accordion:hover {
             background-color: #2480a1;
             border: 1px solid #1d6179;
         }

         /* Style the accordion panel. Note: hidden by default */
         div.panel {
             padding: 0px 0px;
             display: none;
              width: 100%; height: 20%;


         }


         /* The "show" class is added to the accordion panel when the user clicks on one of the buttons. This will show the panel content */
         div.panel.show {
             display: block;
             margin: auto;



         }
         .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

         tr:hover{ cursor: pointer; background-color:#79dd75; }

      </style>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_qy9QdBjjV1w8c4hQ5o52DmAWMact_xg&callback=initMap"
      async defer></script>


      <script type="text/javascript">


      var locations = [
           ['oviatt', 34.240198,-118.529697, 1],
           ['univ_hall',34.239937, -118.532031, 2],
           ['sequoia', 34.240487, -118.528308, 3],
           ['jacaranda',34.241325, -118.528332, 4]
      ];

       var map;
       var marker_store=[];
       var infowindow;
       var response;

      function club_infowindow(z){

          var myLatLng;
          var i;

           for (i = 0; i < marker_store.length; i++) {
                var which_id = marker_store[i].get("id");


              if(z.getAttribute("id") ==  which_id){
          /*        alert("I am an alert box2!" + marker_store[i].get("id") + " | " + z.getAttribute("id") ); */
                  infowindow.close();
                  var formData =  {name: which_id};

                  $.ajax({
                       url: "getcontent.php",
                       type: "post",
                       data: formData,
                       success: function (getresponse) {
                         response = getresponse;
                          // you will get response from your php page (what you echo or print)
                         infowindow.setContent(response);

                       },
                       error: function(jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                       }

                     });


                  infowindow.open(map, marker_store[i]);
                  /*infowindow animation*/
                    var iw_container = $(".gm-style-iw").parent();
                    iw_container.stop().hide();
                    iw_container.fadeIn(800);
                  map.setZoom(18);
                  map.setCenter(marker_store[i].getPosition());
                }
           }
         }
      function reply_image(){

        infowindow.setContent('<div class="info"><div id="infotop"></div><h1>IMAGE GOES HERE</h2><div></div></div>');

      }

      function reply_click(obj){
           var id = obj.id;
           var txt;
           var formData =  {name: id};
           var user_response = window.confirm("Confirm addition to Meeting");

           if (user_response == true) {

           /* returns a Window.alert box after adding to database*/
             $.ajax({
                  url: "addstudent.php",
                  type: "post",
                  data: formData,
                  success: function (response) {
                     // you will get response from your php page (what you echo or print)
                     window.alert(response);

                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                  }

                });


            } else {
                txt = "You have cancelled addition to the meeting";
                  window.alert(txt);
            }
      }




      function createmarker(){
      var i;
      var marker;

        for (i = 0; i < locations.length; i++) {
          marker = new google.maps.Marker({
          animation: google.maps.Animation.DROP,
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,

        });
        marker.set("id", locations[i][3]);
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            map.setZoom(18);
            map.setCenter(marker.getPosition());

        /*    infowindow.setContent("locations[i][0]");
            infowindow.open(map, marker)
        */
          }
        })(marker, i ));



       marker_store.push(marker);
     }


     }




    	function doubleClicked(e)//array for locations
      {

        }

        function init()//initial map location
          {
            	var mapOptions = {
        		    zoom: 17,
        		    center: new google.maps.LatLng(34.240591, -118.528769),
        		    mapTypeId: google.maps.MapTypeId.ROADMAP,
        			disableDoubleClickZoom: true,
        			disableDefaultUI: true,
        			zoomControl: false,
        			draggable: false,
        			scrollwheel: false

        	    }
        	  	map = new google.maps.Map(document.getElementById("map-canvas"),
        	  							mapOptions);
              createmarker();
        	  	google.maps.event.addListener(map, 'dblclick', doubleClicked);
              infowindow = new google.maps.InfoWindow();

        	  }

        	  window.addEventListener("load", init, false);

   </script>


  </head>

  <body>

    <div id="map-top" >
      <div id="map-top-inside">
      </div>
      <div id="map-top-inside-middle">
      </div>
      <div id="map-top-inside-right">
        <?php if(isset($_SESSION['username'])){ echo'<br><h1><a href="logout.php">Logout</a></h1>'; }else{echo'<div class="dropdown"><button class="dropbtn">Login</button><div class="dropdown-content"><a href="login-student.html">Student</a><a href="admin-log.html">Admin</a></div></div>';}?>
      </div>

    </div>

    <div id="map-container">
           <div id="map-canvas"></div>

        <div id="nav">

          <nav>



            <button class="accordion">Engineering & Computer Science</button>
              <div class="panel">
                <table>
        <!-- php function with query goes here to get all club lists -->
                  <?php getcomputer(); ?>
                </table>
              </div>

            <button class="accordion">Business & Economics</button>
              <div class="panel">
                <table>
        <!-- php function with query goes here to get all club lists -->
                  <tr>
                    <td class="list"> php function here3-- </td>
                  </tr>

                </table>
              </div>

            <button class="accordion">Arts Media & Communication</button>
              <div class="panel">
                <table>
        <!-- php function with query goes here to get all club lists -->
                  <tr>
                    <td class="list"> php function here3-- </td>
                  </tr>
                </table>
              </div>
              <button class="accordion">Health  & Human Development</button>
                <div class="panel">
                  <table>
          <!-- php function with query goes here to get all club lists -->
                    <tr>
                      <td class="list"> php function here4-- </td>
                    </tr>
                  </table>
                </div>
          </nav>



      <script  type="text/javascript">
          var acc = document.getElementsByClassName("accordion");
          var i;

          for (i = 0; i < acc.length; i++) {
              acc[i].onclick = function(){
                  this.classList.toggle("active");
                  this.nextElementSibling.classList.toggle("show");
              }
          }

      </script>

      <script type="text/javascript">

          var temp = document.getElementsByTagName("td");


          for(var i=0; i < temp.length; i++){

            temp[i].addEventListener("click", function(){ club_infowindow(this,temp[i]); },false);

          }



      </script>
      <script type="text/javascript">





      </script>
     </div>
    </div>
    <div id="bottom">
    </div>

   </body>

   </html>
