<?php
/*
 * Page index.php
 *
 * 
 */
$currDir = dirname(__FILE__);
include("{$currDir}/header.php"); 
?>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      	<div class="container px-4">
	        <a class="navbar-brand" href="index.php">
				<img src="images/brand/jbdc-logo.png" />
	        </a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbar-collapse-main">
	          	<!-- Collapse header -->
		        <div class="navbar-collapse-header d-md-none">
		            <div class="row">
		              	<div class="col-6 collapse-brand">
			                <a href="index.php">
			                	<img src="images/brand/jbdc-logo.png" />
			                </a>
		              	</div>
		              	<div class="col-6 collapse-close">
			                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
			                  <span></span>
			                  <span></span>
			                </button>
		              	</div>
		            </div>
		        </div>		        
	        </div>
	   	</div>
    </nav>


    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      	<div class="container">
	        <div class="header-body text-center mb-7">
		        <div class="row justify-content-center">
		            <div class="col-lg-5 col-md-6">
						<h1 class="text-white">Welcome!</h1>
						<p class="text-lead text-light">The JBDC Attendance Log allows us to manage our Employees</p>
		            </div>
		        </div>
	        </div>
      	</div>
      	<div class="separator separator-bottom separator-skew zindex-100">
			<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg"><polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon></svg>
      	</div>
    </div>

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      	<div class="row justify-content-center">
        	<div class="col-lg-5 col-md-7">
          		<div class="card bg-secondary shadow border-0">
		            <div class="card-header bg-transparent pb-2">
		            	<div class="text-muted text-center mt-2 mb-3">User Login</div>
		            </div>
            		<div class="card-body px-lg-5 py-lg-2">
		            	<?php
						if (isset($_SESSION['user_id'])) {
							echo 'You are logged out';
						}
						else { ?>		
							<form id="login_form" class="loginForm" method="POST" action="includes/login.php">
				                <div class="form-group mb-3">
				                  	<div class="input-group input-group-alternative">
					                    <div class="input-group-prepend">
					                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
					                    </div>

							   			<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
				                  	</div>
				                </div>
				                <div class="form-group">
				                  	<div class="input-group input-group-alternative">
					                    <div class="input-group-prepend">
					                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
					                    </div>

				                    	<input type="password" id="inputPassword" name="loginPassword" class="form-control" placeholder="Password" required>
				                  	</div>
				                </div>
				                <div class="text-center">
				                	<button name="loginBtn" type="submit" class="btn btn-primary my-4">Sign in</button>
				                </div>		               
				           	</form>
				        <?php
						}
						?>
            		</div>
		          	<div class="row mt-3">
			            <div class="col-12 text-center p-3">
			           		<a href="mailto:helpdesk@jbdc.net?subject=Password Reset for Attendance Log" class=""><small>Forgot password?</small></a>
			            </div>
		          	</div>
       			</div>
      		</div>
    	</div>
  	</div>
  
<?php include("{$currDir}/footer.php"); ?>




