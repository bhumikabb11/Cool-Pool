<?php 
session_start();

if(isset($_SESSION['memberId'])){
	 $loggedInUser = $_SESSION['firstName'];
	 $loggedInId = $_SESSION['memberId'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBE65mPIaGbBUs9atfrOpcY7bZCfszzXlk&v=3.exp&libraries=places"></script>

	

</head>
<body>
	<header>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">COOLPOOL</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="places"><a href="home.php">Home</a></li>
		        <?php 
		        if(isset($_SESSION['driver']) && $_SESSION['driver']==1){
		        	echo '<li><a href="myrides.php">My Registered Rides</a></li>';
		        }else{
		        	echo '<li><a href="driver.php">Registere New Rides</a></li>';
		        }
		        ?>
		        
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		      	<?php 
		      		if(isset($loggedInUser) && $loggedInUser != null){

		      			echo '<li><a href="#">Welcome <b>'.$loggedInUser.'</b></a></li>
		      				<li><a href="../serverAPI/userManagement/logout.php">Sign Out</a></li>';
		      		}else{
		      			echo '<li><a href="#" data-toggle="modal" data-target="#signInModal">Sign In</a></li>
		      				<li><a href="#" data-toggle="modal" data-target="#registerModal">Register Now</a></li>';
		      		}
		      	?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</header>

		<!-- Sign-in Modal -->
	<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Sign In</h4>
	      </div>
	      <div class="modal-body">
	        <form method="post" id="signInForm" action="../serverAPI/userManagement/login.php">
			  <div class="form-group">
			    <label for="email">Email address:</label>
			    <input type="email" name="email" class="form-control" id="email">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Password:</label>
			    <input type="password" name="password" class="form-control" id="pwd">
			  </div>
			  <div class="checkbox">
			    <label><input type="checkbox"> Remember me</label>
			  </div>
			  <button type="button" id="signIn" class="btn btn-default">Submit</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- Sign in modal end -->

<!-- Register Modal -->
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Register Your Account</h4>
		      </div>
		      <div class="modal-body">
		        <form method="post" action="../serverAPI/userManagement/registerUser.php" id="registerForm">
		          <div class="alert alert-danger existMessage" role="alert">
		          	<span><b>Error! </b>Email already exists</span>
		          </div>
				  <div class="form-group">
				    <label for="email">Email address:</label>
				    <input type="email" name="email" class="form-control" id="email">
				  </div>
				  <div class="form-group">
				  	<label for="firstName">First Name</label>
				  	<input type="text" name="firstName" class="form-control" id="firstName">
				  </div>
				  <div class="form-group">
				  	<label for="lastName">Last Name</label>
				  	<input type="text" name="lastName" class="form-control" id="lastName">
				  </div>
				  <div class="form-group">
				  	<label for="firstName">Phone Number</label>
				  	<input type="text" name="phoneNumber" class="form-control" id="phoneNumber">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" name="password" class="form-control password" id="pwd">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Confirm Password:</label>
				    <input type="password" class="form-control password" id="pwd">
				  </div>
				  <div class="checkbox ">
				    <div class="userStatus">
				    	<label><input type="checkbox" name="driver" value="driver"> Register as Driver</label>
				    </div>
				  </div>
				  <button type="button" id="register" class="btn btn-default">Submit</button>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
<!-- Register modal end -->

<!-- success message modal-->
	<!-- Modal -->
  <div class="modal fade" id="successModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <div class="alert alert-success" role="alert">
		     <span><b>Success! </b>Registration successful</span>
		  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end -->

</body>