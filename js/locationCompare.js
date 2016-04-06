/* 
 * Same functionality as the the cuThereMaps.js file
 * Wanted to copy off so when I tear down to insert the php data I dont break exsisiting functionality
 * Hopefully wont break anything major
 * 
 * 
 * Created: 02.22 
 * Last to Edit: Chris
 */

/*
 * The hope is the json_encoded array from the php will come in here
 *  Assign each element to a variable
 *  Thorw the varialbes into the polygon set up we have below
 *  Then be able to compare against the users current location we recieve
 *  
 *  We will then print out a result based on if they hit the polygon or not
 *          Green Scree = Good
 *          Yellow Screen = Try Again
 *          Red Screen = BAD
 *          
 *           
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

/*
 * Function that retrieves the json object from the PHP file
 *  Assigns each element of the array object to the correct variable
 *  Since its always the same data, I just hard coded
 *
 *
 *Becker Hard Code Value:
 *                      Clarion, PA 16214
                        41.205796, -79.379616
 *  
 *   
 */
count = 0;
error = "I messed up";
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
         {lat: corner4_lat, lng: corner4_lng}    
         ];
       
         //Write out location for testing
    console.log(JSON.stringify(userLocation));
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
    } else{ // NOT IN POLYGON
   // var selectedClasses =JSON.stringify(getSelectedClasses());
    // ONLY HERE FOR TESTING, SINCE WE ARE ALWAYS FALSE
    // Need to redirect back to a page...... ??????eventList?????????
   // Would like this to be the event they are on, may take some work because we need venueID and eventID
//    $.post('../model/extraCreditAjax.php',{'class': selectedClasses},function(response){
//        console.log(response);
//       });
    alert("You were unable to check-in, Please Try again");
    window.location.assign("../controller/controller.php?action=EventDetails&EventID="+$('#eventId').html()+"&VenueID=6"+$('#venueId')+"");
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

//Testing Function to save lots of pionts to DB to build better POLYGONS
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
         {lat: corner4_lat, lng: corner4_lng}    
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
//         var selectedClasses =JSON.stringify(getSelectedClasses());
//         $.post('../model/extraCreditAjax.php',{'class': selectedClasses},function(response){ 
//             console.log(response);
//            });
//     window.location.assign("../controller/controller.php?action=AddStudent&IsWithinPolygon="+isWithinPolygon+"");
    } else{ // NOT IN POLYGON
 
//    alert("You were unable to check-in, Please Try again");
//    window.location.assign("../controller/controller.php?action=EventDetails&EventID="+$('#eventId').html()+"&VenueID=6"+$('#venueId')+"");
       var event = $('#eventId').html;
       window.location.assign("../controller/controller.php?action=AddStudent&IsWithinPolygon="+isWithinPolygon+"&CurrentLocation="+userLocation+"EventId="+event+"");

         
         
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
