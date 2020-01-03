<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  	<script>
	  var editIcon = "<button>Edit</button>";
	$(document).ready(function() {
		getAllUsers()
	    $("#register").click(function() {
	        $.ajax({
	        	type: "POST",
	        	url: "http://localhost/MysqlCRUD/register.php",
	        	success: function(result) {
	        		if(result.resultCode == "Success") { 
	        			$("#loading").html(result.message);
	        			$("#user-table").css("visibility","visible");
	        			$('#user-table tbody').append("<tr><td>" +result.id+ "</td><td>" +result.email+ "</td><td>" +result.password+ "</td></tr> ");
	        		} else {
	            		$("#snackbar").html(result.resultCode);
	        			$("#snackbar").attr('class','show');
						setTimeout(function(){
	        $("#snackbar").attr('class','');
		}, 3000);
	        		}
	        	},
    			data: $("#user_detail_form_data").serialize(),
	        	error: function() {
      				$('#user-table').html('<p>An error has occurred</p>');
   				},
	        });
	    });
	    function getAllUsers() {
	        $.ajax({
	        	type: "GET",
	        	url: "http://localhost/MysqlCRUD/display.php",
	        	success: function(result) {
	        		if(result.resultCode == "Success") { 
	        			$("#loading").html("Loaded the table");
	        				$("#user-table").css("visibility","visible");
		        			for(var i = 0; i < result.records.length; i++) {
		        				$('#user-table tbody').append(
									"<tr><td>" +result.records[i].id+ "</td><td>" +
									result.records[i].email+ 
									"</td><td>" +
									result.records[i].password+ 
									"</td><td>" +
									editIcon +
									"</td></tr>");
							}
	        		} else {
	        			$("#loading").html(result.message);
	        			$("#snackbar").html(result.message);
	        			$("#snackbar").attr('class','show');
						setTimeout(function(){
	        $("#snackbar").attr('class','');
		}, 3000);
	        		}
	        	},
	        	error: function() {
	  				$('#user-table').html('<p>An error has occurred</p>');
					},
	        });
		}
	});
	</script>
	<style type="text/css">
		#snackbar {
		    visibility: hidden;
		    min-width: 250px;
		    margin-left: -125px;
		    background-color: #333;
		    color: #fff;
		    text-align: center;
		    border-radius: 2px;
		    padding: 16px;
		    position: fixed;
		    z-index: 1;
		    left: 50%;
		    top: 30px;  /*make it as bottom if you want to show in bottom*/
		    font-size: 17px;
		}

		#snackbar.show {
		    visibility: visible;
		    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		    animation: fadein 0.5s, fadeout 0.5s 2.5s;
		}

		@-webkit-keyframes fadein {
		    from {top: 0; opacity: 0;}  /*make it as bottom if you want to show in bottom*/
		    to {top: 30px; opacity: 1;}
		}

		@keyframes fadein {
		    from {top: 0; opacity: 0;}
		    to {top: 30px; opacity: 1;}
		}

		@-webkit-keyframes fadeout {
		    from {top: 30px; opacity: 1;} 
		    to {top: 0; opacity: 0;}
		}

		@keyframes fadeout {
		    from {top: 30px; opacity: 1;}
		    to {top: 0; opacity: 0;}
		}
	</style>
</head>
<body>
	<div class="container">
	  <h2>Registration</h2>
	  <form id = "user_detail_form_data">
	  	<div class="form-group">
  			<label for="email">Email:</label>
  			<div id="snackbar"></div>
			<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
	    </div>
	    <div class="form-group">
	      	<label for="pwd">Password:</label>
	      	<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
	    </div>
	    	<button id = "register" type="button" class="btn btn-primary">Submit</button>
	  </form>
	</div>
	<div class = "container">
		<div class = "form-group"><br><br>
			<div class = "table" id = "loading">Loading ...</div>
			<table class = "table table-border" id = "user-table" style = "visibility: hidden;">
			<thead>
				<th>id</th>
				<th>email</th>
				<th>password</th>
				<th>Update</th>
				<th>Delete</th>
			</thead>
			<tbody>
			    <tr>
			    </tr>
			</tbody>
			</table>
		</div>
	</div>
</body>
</html>