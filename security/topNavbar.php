<!-- Top navbar -->
<div class="nav-container">
	<div class="container-fluid"> 
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
					<a class="navbar-brand" href="#"><img class="security-logo" src="<?php echo PREPEND_PATH; ?>images/brand/E-Log-Logo.png" class="navbar-brand-img" alt="JBDC Logo"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse justify-content-end" id="navbarText">
						<ul class="navbar-nav">
							<li class="nav-item text-uppercase t-date">Today is: <?php echo date("M d, Y"); ?></li>
							<li class="nav-item t-user">Welcome Back - <?php echo $securityUser; ?></li>
							<li class="nav-item"><a class="" href="#editSecurity" role="button" data-toggle="modal" data-target="#editSecurity"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Edit Profile</a></li>
							<li class="nav-item">
								<a class="nav-link" href="#logout" role="button" data-toggle="modal" data-target="#logoutModal">
									<div class="media align-items-center">
									  	<div class="media-body ml-2 d-lg-block">
											<span class="mb-0 text-sm font-weight-bold text-uppercase">Logout</span>
									  	</div>
									</div>
							 	</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>
		<!--

		<div class="col-6 col-md-4">
		
			<div class=" d-sm-flex d-md-flex">
				
				
			</div>
		</div>

		<div class="col-6 col-md-8">

			<nav class="navbar navbar-expand-lg justify-content-end">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						
					</div>
				</div>
			</nav>
		
			<ul class="navbar-nav align-items-center justify-content-end d-sm-flex d-md-flex">
			  	<li class="nav-item">
				 	<div class="media align-items-center">
					  	<div class="media-body ml-2 mr-4 d-lg-block">
						 	<span class="mb-0 text-sm font-weight-bold text-white"></span>
					  	</div>
					</div>
			  	</li>
			  	<li class="nav-item">
					<div class="media align-items-center">
					  	<div class="media-body ml-2 d-lg-block">
							<span class="mb-0 text-sm font-weight-bold text-capitalize text-underline text-white"></span>
					  	</div>
					</div>
			  	</li>
			  	<li class="nav-item">
			  		<div class="media align-items-center">
			  			<div class="media-body ml-2 d-lg-block text-white">
			  				
			  			</div>
			  		</div>
			  	</li>

			  	<li class="nav-item">
				 	
			  	</li>
			</ul>
		</div>
	</div>
	
  </nav> 

 <?php include("{$currDir}/modal.php"); ?>