<?php    
session_start();
if(isset($_SESSION['isAdmin']))
{
		 if(isset($_SESSION['Username']))
		{
		    $Username=$_SESSION['Username'];
		     $isAdmin=$_SESSION['isAdmin'];
		}
		else if(!isset($_SESSION['Username']))  
		{
		 header("Location: index.php?err=login");
		}	
}
else
{
	header("Location: index.php?err=login");
}
include_once '../Server/config/database.php';


$database = new Database();
$db = $database->getConnection();

$AccountName=$_SESSION['Username'];

$sql=" SELECT * FROM phoneuser WHERE username='{$AccountName}'";

$mysqli_result = $db->query($sql);


$row = $mysqli_result-> fetch(MYSQLI_ASSOC);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Account</title>
		<meta charset="utf-8" />
	  <!-- Theme style -->
		<link rel="stylesheet" href="css/AdminLTE.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/app.css" />
		<link rel="stylesheet" href="css/tabulator.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>

		
        <script type ="text/javascript">

            function check()
            {
                window.location.href="../Server/deleteAccount.php?id=<?=$AccountName;?>"

           }
        </script>
		
	</head>
	<body class="is-preload">
		<!-- Page Wrapper -->
			<div id="page-wrapper">
				<!-- Header -->
					<header id="header">
						<h1><a href="data.php">E-Phone</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
                                            <li><a href="accounts.profile.php" id="">Account</a></li>
                                            <li><a href="data.php">Sell Portal</a></li>
                                            <li><a href="faq.html" id="">FAQ</a></li>
											<li><a href="../Server/logout.php" id="">Log Out</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
				<!-- Main -->
					<article id="main">
						<header>
							<h1>Account Page</h1>
							<p>Access and Edit Account Information</p>
						</header>

<div class="py-5">
    <div class="container">
        <div>
            <section class="content-header">
                <h3>User Profile</h3>
                <div>
                    <a class="btn btn-honey btn-sm" href="accounts.profile.edit.php" role="button">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <button type="button" class="btn btn-honey btn-sm" data-toggle="modal" data-target="#modalConfirmDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="profile-username text-center">
                                    <?php echo $row['Username'];?>
                                </h5>

                                <p class="text-muted text-center"><?php 
																		if ($row['isAdmin'] == 0){
																			echo 'User';
																		} else {
																			echo 'Site Administrator';
																		} 
																		?></p>	

								
                            </div>
                            <div class="card-footer p-0 d-flex justify-content-center bg-honey">
    							<button name="button" id="account_change_pass" class="btn btn-honey btn-sm w-100" data-toggle="tooltip" title="Change current account password">
    								<i class="fa fa-key"></i>
    								<span class="btn-text" >Change Password</span>
    							</button>
	                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-7 col-lg-8 col-xl-9 mt-4 mt-md-0">
                        <div>
                            <ul class="nav nav-tabs nav-justified my-3 my-sm-0">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#Overview" role="tab" data-toggle="tab">Overview</a>
                                </li>
                            </ul>

                            <div class="tab-content m-3">
                                <div class="tab-pane fade show active" role="tabpanel" id="Overview">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h5>General information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Business Name: </div>
                                                <div class="col-6 col-lg-8 body-text"><?php echo $row['BusinessName'];?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Name:</div> 
                                                <div class="col-6 col-lg-8 body-text"><?php echo $row['Title']; ?> <?php echo $row['GivenName'];?> <?php echo $row['FamilyName'];?></div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h5>Contact information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Phone Number:</div> 
                                                <div class="col-6 col-lg-8 body-text"><?php echo $row['ContactNumber'];?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Email:</div> 
                                                <div class="col-6 col-lg-8 body-text break-word"><?php echo $row['Email'];?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h5>Address Information</h5>
                                        </div>
										<div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="Mailing">
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Country:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['Country'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">State/Province/Region:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['StateProvinceRegion'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">County or District:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['CountyDistrict'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">City or Town:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['CityTown'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Street Address:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['StreetAddress'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Premises:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['Premises'];?></div>
        											</div>
        											<div class="row mb-3">
        												<div class="col-6 col-lg-4 font-weight-bold text-dark body-text">Postal Code:</div> 
        												<div class="col-6 col-lg-8 body-text"><?php echo $row['PostalCode'];?></div>
        											</div>
        										</div>
										    </div>
										</div>
									</div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
				<div id="modalConfirmDelete" class="modal fade">
					<div class="modal-dialog modal-warning">
						<div class="modal-content">
							<div class="modal-header deleteAcc">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<div class="icon-box" >
									<i class="material-icons">&#xE5CD;</i>
								</div>				
							</div>
							<div class="modal-body deleteAcc">			
								<h4 class="modal-title">Are you sure?</h4>	
								<br><p style="color: #212529;">Do you really want to delete your account? This process cannot be undone.</p>
							</div>
							<div class="modal-footer deleteAcc">
								<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-danger" onclick="check();">Delete</button>
							</div>
						</div>
					</div>
				</div>   
            </section>
        </div>
	</div>
</div>
</article>

<div id="changePassModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-honey">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form>
	          <div id="move-hive-msg"></div>
	          <div class="form-group">
	            <label for="old_password">Current Password <span class="text-danger">*</span></label>
				<input type="password" id="old_password" name="old_password" class="form-control">
				<div id="old_passwordVal" class="error_text"  style="display:none;">Old password is incorrect.</div>
				<div id="old_passwordError" class="error_text"  style="display:none;">This field is required.</div><br id="old_passwordErrorL" style="display:none;">
	            </br><label for="new_password">New Password <span class="text-danger">*</span></label>
				<input type="password" id="new_password" name="new_password" class="form-control">
				<div id="new_passwordSame" class="error_text" style="display:none;">New password cannot be the same as old password.</div>
				<div id="new_passwordVal" class="error_text" style="display:none;">Password must be longer than 8 characters and contain at least one character and one digit.</div>
				<div id="new_passwordError" class="error_text" style="display:none;">This field is required.</div><br id="new_passwordErrorL" style="display:none;">
	            </br><label for="rep_password">Confirm Password <span class="text-danger">*</span></label>
				<input type="password" id="rep_password" name="rep_password" class="form-control">
				<div id="rep_passwordVal" class="error_text" style="display:none;">Does not match entered password.</div>
				<div id="rep_passwordError" class="error_text" style="display:none;">This field is required.</div><br id="rep_passwordErrorL" style="display:none;">
	          </div>
	          <div class="col-md-12 text-right">
	          	<button type="button" id="changePassBtn" class="btn btn-honey">Update</button>
	          </div>
  		</form>
      </div>
    </div>
  </div>
</div>


<div id="changePassSuccessModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4>Success!</h4>	
				<p style="color: #808080;">Your password has been changed.</p>
				<button class="btn btn-success" data-dismiss="modal"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
			</div>
		</div>
	</div>
</div> 
<!-- //--// -->

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; I-Phone</li><li>Design: <a href="#">Huang Xin</a></li>
						</ul>
					</footer>

			</div>

</div>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js" ></script>
        <script src="js/jquery.scrollex.min.js"></script>
        <script src="js/jquery.scrolly.min.js"></script>
        <script src="js/browser.min.js"></script>
        <script src="js/breakpoints.min.js"></script>
        <script src="js/util.js"></script>
        <script src="js/xlsx.js"></script>
        <script src="js/jszip.js"></script>
        <script src="js/xlsx.full.min.js"></script>
        <script type="text/javascript" src="js/tabulator.min.js"></script>
        <script src="js/jquery_wrapper.js" ></script>
        <script src="js/jquery_wrapper.min.js" ></script>
        <script src="js/app.js"></script>
		
        <script src="js/main.js"></script>
<script>


			   $('#account_change_pass').click(function(){
					$('#old_password').val('');
					$('#new_password').val('');
					$('#rep_password').val('');
					$('#old_passwordVal').hide();
					$('#old_passwordError').hide();
					$('#old_passwordErrorL').hide();
					$('#new_passwordSame').hide();
					$('#new_passwordVal').hide();
					$('#new_passwordError').hide();
					$('#new_passwordErrorL').hide();
					$('#rep_passwordVal').hide();
					$('#rep_passwordError').hide();
					$('#rep_passwordErrorL').hide();			   
				   
				  $('#changePassModal').modal('toggle'); 
			   });
			   $('#changePassBtn').click(function(){
				   var validForm = 1;
				   
				   var Username = '<?php echo $AccountName?>';
				   //old_passwordVal
				   var oldPassword = $('#old_password').val();
				   var newPassword = $('#new_password').val();
				   var repPassword = $('#rep_password').val();	
				   var oldPassValid = 0;
		
				   if (oldPassword == ''){
					  $('#old_passwordVal').hide();
					  $('#old_passwordError').show();
					  $('#old_passwordErrorL').show();	
					  validForm = 0;					   
				   } else {
					  var form_data=new FormData();
						form_data.append('Username', Username);
					  form_data.append('Password', oldPassword);					  
					  
					  $.ajax({
					  type: "post",
					  url: api_url+'changeUserPassValidate.php',
					  data: form_data,
					  contentType: false,
					  cache: false,
					  processData: false,
					  dataType:'JSON',
					  async:false,
					  success: function(data){
						  if(data.status==true) {
							  $('#old_passwordVal').hide();
							  $('#old_passwordError').hide();
							  $('#old_passwordErrorL').hide();
							  oldPassValid = 1;
						  } else {	
							  $('#old_passwordVal').show();
							  $('#old_passwordError').hide();
							  $('#old_passwordErrorL').show();
							  validForm = 0;				  
						  }    
						}
					  });					   
				   }
				   
				  if(newPassword=="") {
					$('#new_passwordSame').hide();
					$('#new_passwordVal').hide();
					$('#new_passwordError').show();
					$('#new_passwordErrorL').show();
					validForm = 0;
				  } else {
					 if (oldPassValid == 1 && oldPassword == newPassword){
						$('#new_passwordSame').show();
						$('#new_passwordVal').hide();
						$('#new_passwordError').hide();
						$('#new_passwordErrorL').show();
						validForm = 0;
					 } else {
						  var countChar = 0;
						  var countNum = 0;
						  if (newPassword.length >= 8) {
							  for (var i=0; i<newPassword.length; i++){
								  if ($.isNumeric(newPassword.charAt(i))){
									  countNum++;
								  } else if (newPassword.charAt(i).toLowerCase() != newPassword.charAt(i).toUpperCase()){
									  countChar++;
								  }
							  }
						  }
						  if (countChar > 0 && countNum > 0) {
							$('#new_passwordSame').hide();
							$('#new_passwordVal').hide();
							$('#new_passwordError').hide();
							$('#new_passwordErrorL').hide();
						 } else {
							$('#new_passwordSame').hide();
							$('#new_passwordVal').show();
							$('#new_passwordError').hide();
							$('#new_passwordErrorL').show();
							 validForm = 0;
						 }						 
					 }
				  }	

				  if(repPassword=="") {
					$('#rep_passwordVal').hide();
					$('#rep_passwordError').show();
					$('#rep_passwordErrorL').show();
					validForm = 0;
				  } else {
					  if (newPassword == repPassword) {
						$('#rep_passwordVal').hide();
						$('#rep_passwordError').hide();
						$('#rep_passwordErrorL').hide();
					 } else {
						$('#rep_passwordVal').show();
						$('#rep_passwordError').hide();
						$('#rep_passwordErrorL').show();
							 validForm = 0;
					 }
				  }
				  
				  if (validForm == 0) return;

				  var form_dataNew=new FormData();
					form_dataNew.append('Username', Username);
				  form_dataNew.append('Password', newPassword);
				  $.ajax({
				  type: "post",
				  url: api_url+'changeUserPass.php',
				  data: form_dataNew,
				  contentType: false,
				  cache: false,
				  processData: false,
				  dataType:'JSON',
				  async:false,
				  success: function(data){
					  if(data.status==true) {
						  $('#changePassSuccessModal').modal('toggle');
					  } else {				  
					  }    
						$('#changePassModal').modal('toggle'); 
					}
				  });
			   });
		



</script>




	</body>
</html>