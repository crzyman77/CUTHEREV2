/*Main Functionality to compare a succesfully logged in user to the polygon for the venue of the event they are attending
 * 
 *  Uses HTML5 geolocation and the google maps API 
 *
 * Created: 04.15 
 * Last to Edit: Chris
 */
//----------------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------------

// Global Variable that will be used for the polygons
var corner1_lat;
var corner1_lng;
var corner2_lat;
var corner2_lng;
var corner3_lat;
var corner3_lng;
var corner4_lat;
var corner4_lng;
var corner5_lat;
var corner5_lng;
var corner6_lat;
var corner6_lng;

/*
 * Function that retrieves the json object from the PHP file
 *  Assigns each element of the array object to the correct variable
 *  Since its always the same data, I just hard coded
 */
var watchPosArray = [];
function myFunction() {
 
     $.get("../model/locationModel.php?ajax", function(array){
     corner1_lat = parseFloat(array[0]);
     corner1_lng = parseFloat(array[1]);
     corner2_lat = parseFloat(array[2]);
     corner2_lng = parseFloat(array[3]);
     corner3_lat = parseFloat(array[4]);
     corner3_lng = parseFloat(array[5]);
     corner4_lat = parseFloat(array[6]);
     corner4_lng = parseFloat(array[7]);
     corner5_lat = parseFloat(array[8]);
     corner5_lng = parseFloat(array[9]);
     corner6_lat = parseFloat(array[10]);
     corner6_lng = parseFloat(array[11]);
  });   
} //END GET BUILDING FUNC

function eventListLocationCheck(){
        
    myFunction();
    
if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
        initialLocation = new google.maps.LatLng({lat:position.coords.latitude,lng:position.coords.longitude});
        polyCheck();  
        }, 
        function() {
            handleLocationError(true, infoWindow, map.getCenter());
        }, 
        {maximumAge: 30000, timeout: 10000, enableHighAccuracy: true});
      } 
     else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
function error() 
    {
        alert("Error With Location'>Cannot locate user. Please enable Location (and high accuracy mode) on your phone and try again");
    }
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

    // Define the LatLng coordinates for the polygon's path.
 function polyCheck(){
     
     //Grab the user location Again, hopefully to help with accuarcy issues
     var userLocation;
     navigator.geolocation.getCurrentPosition(function(user) {
        userLocation = new google.maps.LatLng({lat:user.coords.latitude,lng:user.coords.longitude}); 
       
         //Define The Polygon of the building we are in for the event
        var polyCoords = [
         {lat: corner1_lat, lng: corner1_lng},
         {lat: corner2_lat, lng: corner2_lng},
         {lat: corner3_lat, lng: corner3_lng},
         {lat: corner4_lat, lng: corner4_lng},
         {lat: corner5_lat, lng: corner5_lng},
         {lat: corner6_lat, lng: corner6_lng}
         ];
       
         //Write out location for testing
    //console.log(JSON.stringify(polyCoords));
            //Build the polygon and compare the loaction
    var buildingPoly = new google.maps.Polygon({path: polyCoords});
    var isWithinPolygon =  google.maps.geometry.poly.containsLocation(userLocation, buildingPoly);
       
       //Print out result
    console.log(isWithinPolygon); 
   
    if(isWithinPolygon === true){
         var selectedClasses =JSON.stringify(getSelectedClasses());
         $.post('../model/extraCreditAjax.php',{'class': selectedClasses},function(response){ 
             console.log(response);
            });
     window.location.assign("../controller/controller.php?action=AddStudent&IsWithinPolygon="+isWithinPolygon+"");
    } else{ 
       alert("Error With Location Check In Due to limitations on the hardware of your device, we are unable to verify your current location. Please try again and if the problem persits, please use the paper sign in option at the enterance of the venue. We are sorry for the inconvience.");
        window.location.assign("../controller/controller.php?action=EventDetails&EventID="+$('#eventId').html()+"&VenueID="+$('#venueId')+"");
    }    
    },function(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
},{maximumAge: 30000, timeout: 10000, enableHighAccuracy: true});
       
 }
     function getSelectedClasses(){
            selectedClasses = [];
        
            var valueString;
            var event = $('#eventId').html();
            var email = $('#studentEmail')[0].value + '@eagle.clarion.edu';
            $("input:checkbox:checked").each(function(){
                valueString = ($(this).val());
                tempRes = valueString.split("/"); // Changed split to '/' due to spaces in instructor names
                res = {class_number: tempRes[0], class_section: tempRes[1], instructor_id: tempRes[2], event_id: event, student_email: email };
                selectedClasses.push(res);
            });
        return selectedClasses;
         }  
};

//Testing Function to save lots of pionts to DB to build better POLYGONS
// JUNK FUNCTION THAT I REALLY DONT NEED ANYMORE
function LocationTesting(){
        
    myFunction();
    
if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
        initialLocation = new google.maps.LatLng({lat:position.coords.latitude,lng:position.coords.longitude});
        polyCheck();  
        }, 
        function() {
            handleLocationError(true, infoWindow, map.getCenter());
        }, 
        {maximumAge: 30000, timeout: 10000, enableHighAccuracy: true});
      } 
     else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
function error() 
    {
	alert("Cannot locate user. Please enable Location (and high accuracy mode) on your phone and try again");
    }
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

    // Define the LatLng coordinates for the polygon's path.
 function polyCheck(){
     
     //Grab the user location Again, hopefully to help with accuarcy issues
     var userLocation;
     navigator.geolocation.getCurrentPosition(function(user) {
        userLocation = new google.maps.LatLng({lat:user.coords.latitude,lng:user.coords.longitude}); 
       
         //Define The Polygon of the building we are in for the event
        var polyCoords = [
         {lat: corner1_lat, lng: corner1_lng},
         {lat: corner2_lat, lng: corner2_lng},
         {lat: corner3_lat, lng: corner3_lng},
         {lat: corner4_lat, lng: corner4_lng},
         {lat: corner5_lat, lng: corner5_lng},
         {lat: corner6_lat, lng: corner6_lng}
         ];
       
         //Write out location for testing
    console.log(JSON.stringify(userLocation));
            //Build the polygon and compare the loaction
    var buildingPoly = new google.maps.Polygon({path: polyCoords});
    var isWithinPolygon =  google.maps.geometry.poly.containsLocation(userLocation, buildingPoly);
       
       //Print out result
    console.log(isWithinPolygon); 
   
     if(isWithinPolygon === true){
        var event = $('#eventId').html();
        window.location.assign("../controller/controller.php?action=AddStudent&IsWithinPolygon="+isWithinPolygon+"&CurrentLocation="+userLocation+"&EventId="+event+"&VenueID="+$('#venueId').html()+"");
    } else{ // NOT IN POLYGON
 
       var event = $('#eventId').html();
        window.location.assign("../controller/controller.php?action=AddStudent&IsWithinPolygon="+isWithinPolygon+"&CurrentLocation="+userLocation+"&EventId="+event+"&VenueID="+$('#venueId').html()+"");

          }    
    },function(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
},{maximumAge: 30000, timeout: 10000, enableHighAccuracy: true});
       
 }
     function getSelectedClasses(){
            selectedClasses = [];
        
            var valueString;
            var event = $('#eventId').html();
            var email = $('#studentEmail')[0].value + '@eagle.clarion.edu';
            $("input:checkbox:checked").each(function(){
                valueString = ($(this).val());
                tempRes = valueString.split("/"); // Changed split to '/' due to spaces in instructor names
                res = {class_number: tempRes[0], class_section: tempRes[1], instructor_id: tempRes[2], event_id: event, student_email: email };
               // alert(JSON.stringify(res));
                selectedClasses.push(res);
              //alert(JSON.stringify(selectedClasses));
            });
           
        //Print's out selected checkboxes
        //This is a test thing, not needed for actal use
//           for(i = 0; i < selectedClasses.length; i++)
//           {
//               $("#test").append(selectedClasses[i].class_number.toString() + " " + selectedClasses[i].class_section.toString() + " " + selectedClasses[i].instructor_name.toString() + "\n");
//           }
      //  alert(JSON.stringify(selectedClasses));
        return selectedClasses;
         }  
 
 
};
