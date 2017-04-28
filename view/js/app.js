$(document).ready(function(){
	
	$("#registerForm").submit(function(e){
	    var postData = $(this).serializeArray();
	    var formURL = $(this).attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	if(jqXHR.responseText == 'success'){
	        		$("#registerModal").modal("hide");
	        		$('#successModal').modal('show');
	        	}else{
	        		$(".existMessage").show();
	        	}
	        	

	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	    e.preventDefault(); //STOP default action
	});

	$("#register").click(function() {
		$("#registerForm").submit();
	});

	$("#signInForm").submit(function(e){
	    var postData = $(this).serializeArray();
	    var formURL = $(this).attr("action");
	    $.ajax(
	    {
	        url : formURL,
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	console.log(jqXHR.responseText);
	        	window.location.href = "./home.php";

	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	    e.preventDefault(); //STOP default action
	});

	$("#signIn").click(function() {
		$("#signInForm").submit();
	})

	$(".userTypeSelectBtn").click(function(){
		var userType = $(this).data('user');
		if(userType == 'rider'){
			window.location.href = "rider.php";
		}else if(userType == 'driver'){
			window.location.href = "driver.php";
		}
	})


	// google map autoload
	function initializeFrom() {
		var input = document.getElementById('searchTextFieldFrom');
		var autocomplete = new google.maps.places.Autocomplete(input);
	}
	google.maps.event.addDomListener(window, 'load', initializeFrom);

	function initializeTo() {
		var input = document.getElementById('searchTextFieldTo');
		var autocomplete = new google.maps.places.Autocomplete(input);
	}
	google.maps.event.addDomListener(window, 'load', initializeTo);

	// search auto load get longitude and latitude

	$(".riderSearchBtn").click(function() {
		getCordFrom();
		getCordTo();
		$(".seachRideDiv").show();
	});

	$(".searchRideBtn").click(function(){

		$.ajax({
			url: "../serverAPI/userManagement/searchRide.php",
			type: "POST",
			data: {"source":searchSource[0]+" "+searchSource[1],
					"destination": searchDest[0]+" "+searchDest[1]},
			success: function(data, textStatus,jqXHR){
				 //console.log(jqXHR.responseText);
				 if(jqXHR.responseText){
					var arrayOutput = JSON.parse(jqXHR.responseText);
					for(var i=0;i<arrayOutput.length;i++){
						var searchHtml = '<div class="row"><div class="col-md-2"></div><div class="col-md-8 searchIterate"><h4>Info About this Ride</h4><hr><h3>Name: <span class="searchName searchPoints">'+arrayOutput[i]['First_name']+" "+arrayOutput[i]['Last_name']+'</span></h3><h3>Email: <span class="searchEmail searchPoints">'+arrayOutput[i]['Email_id']+'</span></h3><h3>Phone: <span class="searchPhone searchPoints">'+arrayOutput[i]['Phone_number']+'</span></h3><h3>Traveling From: <span class="searchFromHeader searchPoints">'+arrayOutput[i]['SourceLat']+" "+arrayOutput[i]['SourceLong']+'</span></h3><h3>Traveling To: <span class="searchToHeader searchPoints">'+arrayOutput[i]['DestinationLat']+" "+arrayOutput[i]['DestinationLong']+'</span></h3><h3>Date: <span class="searchDateOfJourney searchPoints">'+arrayOutput[i]['date']+'</span></h3><h3>Seats Available: <span class="searchSeatsAvailable searchPoints">'+arrayOutput[i]['Seats']+'</span></h3><h4>Luggage option: <span class="searchLuggageSpace searchPoints">'+arrayOutput[i]['Luggage']+'</span></h4><h4>Weekly Travel option: <span class="searchWeeklyTravel searchPoints">'+arrayOutput[i]['Weekly']+'</span></h4><button class="btn btn-success" type="button">Contact this Person</button></div><div class="col-md-2"></div></div>';
						$('.searchResultDiv').append(searchHtml);
					} 	
				 }
				
			},
			error:function(jqXHR,textStatus,errorThrown){
				console.log("error");
			}
		});
	})


	function getCordFrom(){
		var searchLat;
		var searchLong;
		var postData = $("#searchTextFieldFrom").val();
		$.ajax(
	    {
	        url : "https://maps.googleapis.com/maps/api/geocode/json?address="+postData+"&key=AIzaSyBE65mPIaGbBUs9atfrOpcY7bZCfszzXlk",
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	var output = JSON.parse(jqXHR.responseText);
	        	searchSource[0] = output.results[0].geometry.location.lat;
	        	searchSource[1] = output.results[0].geometry.location.lng;
	        	printLatLong(searchSource[0],searchSource[1]);
	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	}


	function getCordTo(){

		var searchLat;
		var searchLong;
		var postData = $("#searchTextFieldTo").val();
		$.ajax(
	    {
	        url : "https://maps.googleapis.com/maps/api/geocode/json?address="+postData+"&key=AIzaSyBE65mPIaGbBUs9atfrOpcY7bZCfszzXlk",
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	var output = JSON.parse(jqXHR.responseText);
	        	searchDest[0] = output.results[0].geometry.location.lat;
	        	searchDest[1] = output.results[0].geometry.location.lng;
	        	printLatLong(searchDest[0],searchDest[1]);
	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	}

	var source = [];
	var destination = [];

	var searchSource = [];
	var searchDest = [];

	function printLatLong(lat,long){
		console.log(lat,long);
		//storeit(source,lat,long);
	}


	// ride register
	// google map autoload
	function initializeRideFrom() {
		var input = document.getElementById('riderFieldFrom');
		var autocomplete = new google.maps.places.Autocomplete(input);
	}
	google.maps.event.addDomListener(window, 'load', initializeRideFrom);

	function initializeRideTo() {
		var input = document.getElementById('riderFieldTo');
		var autocomplete = new google.maps.places.Autocomplete(input);
	}
	google.maps.event.addDomListener(window, 'load', initializeRideTo);
	
	

	$(".setLocation").click(function(){
		getRideCordFrom();
		getRideCordTo();
	})


	$("#registerRideBtn").click(function() {
		if($('.luggage').prop("checked")){
			var luggage = "yes";
		}
		if($('.wkly').prop("checked")){
			var weekly = "yes";
		}
		$.ajax(
	    {
	        url : "../serverAPI/userManagement/registerRide.php",
	        type: "POST",
	        data : {"fromAddress":source[0]+" "+source[1],
	    			"toAddress":+destination[0]+" "+destination[1],
	    			"date":$(".date").val(),
	    			"numberOfSeat": $('.numberOfSeat').val(),
	    			"luggage":luggage,
	    			"weekly":weekly},
	        success:function(data, textStatus, jqXHR) 
	        {
	        	console.log(jqXHR.responseText);
	        	if(jqXHR.responseText=='success'){
	        		$(".registerRideForm").hide();
	        		$(".fromHeader").html($("#riderFieldFrom").val());
	        		$(".toHeader").html($("#riderFieldTo").val());
	        		$(".dateOfJourney").html($(".date").val());
	        		$(".seatsAvailable").html($('.numberOfSeat').val());
	        		$(".luggageSpace").html(luggage);
	        		$(".weeklyTravel").html(weekly);

	        		$(".summary").show();
	        	}

	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	});

	function getRideCordFrom(){
		var searchLat;
		var searchLong;
		var postData = $("#riderFieldFrom").val();
		$.ajax(
	    {
	        url : "https://maps.googleapis.com/maps/api/geocode/json?address="+postData+"&key=AIzaSyBE65mPIaGbBUs9atfrOpcY7bZCfszzXlk",
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	var output = JSON.parse(jqXHR.responseText);
	        	source[0] = output.results[0].geometry.location.lat;
	        	source[1] = output.results[0].geometry.location.lng;
	        	printLatLong(source[0],source[1]);
	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	}


	function getRideCordTo(){

		var searchLat;
		var searchLong;
		var postData = $("#riderFieldTo").val();
		$.ajax(
	    {
	        url : "https://maps.googleapis.com/maps/api/geocode/json?address="+postData+"&key=AIzaSyBE65mPIaGbBUs9atfrOpcY7bZCfszzXlk",
	        type: "POST",
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	        	var output = JSON.parse(jqXHR.responseText);
	        	destination[0] = output.results[0].geometry.location.lat;
	        	destination[1] = output.results[0].geometry.location.lng;
	        	printLatLong(destination[0],destination[1]);
	            //data: return data from server
	        },
	        error: function(jqXHR, textStatus, errorThrown) 
	        {
	        	console.log("error");
	            //if fails      
	        }
	    });
	}
	// end
	

})