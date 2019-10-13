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
$isAdmin=$_SESSION['isAdmin'];
$sql=" SELECT * FROM phoneuser WHERE username='{$AccountName}'";

$mysqli_result = $db->query($sql);

$row = $mysqli_result-> fetch(MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Account</title>
		<meta charset="utf-8" />
	  <!-- Theme style -->
		<link rel="stylesheet" href="css/AdminLTE.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/app.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
		<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>

        <script type ="text/javascript">
            function check_info() // The main function that check whether all the input data is valid or not.
            {
		
					var validSub = 1;
					var Username = '<?php echo $row['Username'];?>';
					var registration_brand=$('#RegistrationBrand').val();
					var registration_territory=$('#RegistrationTerritory').val();
					var business_name=$('#BusinessName').val();
					var family_name=$('#FamilyName').val();
					var given_name=$('#GivenName').val();
					var title=$('#Title').val();
					var email=$('#Email').val();
					var contact_number=$('#ContactNumber').val();
					var country=$('#Country').val();
					var state=$('#StateProvinceRegion').val();
					var district=$('#CountyDistrict').val(); 
					var city_town=$('#CityTown').val();
					var postal_code=$('#PostalCode').val();
					var street_address=$('#StreetAddress').val();
					var premises=$('#Premises').val();
                    var isAdmin = '<?php echo $isAdmin ?>';


					  if(family_name==""){
						$('#reg-fName').show();
						$('#reg-fNameL').show();
						validSub = 0;
					  } else {
						  $('#reg-fName').hide();
						  $('#reg-fNameL').hide();
					  }
					  
					  if(given_name==""){
						$('#reg-gName').show();
						$('#reg-gNameL').show();
						validSub = 0;
					  } else {
						  $('#reg-gName').hide();
						$('#reg-gNameL').hide();
					  }
					  
					  if(title==""){
						$('#reg-title').show();
						$('#reg-titleL').show();
						validSub = 0;
					  }else {
						  $('#reg-title').hide();
						$('#reg-titleL').hide();
					  }
					  
					  if(email==""){
						$('#reg-emailVal').hide();
						$('#reg-emailExist').hide();
						$('#reg-email').show();
						$('#reg-emailL').show();
						validSub = 0;
					  } else {
						  var reg = /(.+)@(.+){2,}\.(.+){2,}/;
						  if (!reg.test(email)){
							  $('#reg-email').hide();
							  $('#reg-emailExist').hide();
							  $('#reg-emailVal').show();
							  $('#reg-emailL').show();
							  validSub = 0;
						  } else {
                              var form_dataEmail=new FormData();
							  form_dataEmail.append('Email', email);
							
							  $.ajax({
							  type: "post",
							  url: api_url+'editUserValidate.php',
							  data: form_dataEmail,
							  contentType: false,
							  cache: false,
							  processData: false,
							  dataType:'JSON',
							  async:false,
							  success: function(data){
								  if(data.statusEmail==false) {
									  $('#reg-email').hide();
									  $('#reg-emailVal').hide();
									  $('#reg-emailExist').hide();
									  $('#reg-emailL').hide();
								  } else {
									  $('#reg-email').hide();
									  $('#reg-emailVal').hide();
									  $('#reg-emailExist').show();
									  $('#reg-emailL').show();	
									  validSub = 0;
								  }    
								}
							  });			  			  
						  }
					  }
					  
					  if(contact_number=="") {
						$('#reg-number').show();
						$('#reg-numberL').show();
						validSub = 0;
					  }else {
						   $('#reg-number').hide();
						$('#reg-numberL').hide();
					  }
					  
					  if(country==""){
					   $('#reg-cty').show();
					   $('#reg-ctyL').show();
						validSub = 0;
					  }else {
						  $('#reg-cty').hide();
					   $('#reg-ctyL').hide();
					  }
					  
					  if(state==""){
						$('#reg-spr').show();
						$('#reg-sprL').show();
						validSub = 0;
					  }else {
						  $('#reg-spr').hide();
						$('#reg-sprL').hide();
					  }
					  
					  if(city_town==""){
						$('#reg-ct').show();
						$('#reg-ctL').show();
						validSub = 0;
					  }else {
						  $('#reg-ct').hide();
						$('#reg-ctL').hide();
					  }
					  
					  if(postal_code=="") {
						$('#reg-postal').show();
						$('#reg-postalL').show();
						validSub = 0;
					  }else {
						  $('#reg-postal').hide();
						$('#reg-postalL').hide();
					  }
					  
					  if(street_address==""){
						$('#reg-add').show();
						$('#reg-addL').show();
						validSub = 0;
					  } else {
						  $('#reg-add').hide();
						$('#reg-addL').hide();
					  }	
						  
					if (validSub == 1) {
						var form_data=new FormData();
						form_data.append('Username',Username);
						if (business_name != "") form_data.append('BusinessName',business_name);
						form_data.append('FamilyName',family_name); 
						form_data.append('GivenName',given_name); 
						form_data.append('Title',title); 
						form_data.append('Email',email); 
						form_data.append('ContactNumber',contact_number); 
						form_data.append('Country',country); 
						form_data.append('StateProvinceRegion',state);
						if (district != "") form_data.append('CountyDistrict',district); 
						form_data.append('CityTown',city_town); 
						form_data.append('PostalCode',postal_code);
						form_data.append('StreetAddress',street_address);
						if (premises != "") form_data.append('Premises',premises);
						form_data.append('isAdmin',isAdmin);
						
						$.ajax({
						type: "post",
						url: api_url+'editUser.php',
						data: form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:'JSON',
						success: function(data){
						  if(data.status==true)
						  {
							  window.location.href="accounts.profile.php";
						   
						  }  
						  else if(data.status==false)
						  {
						      alert("error");
						  }    
						}
						});
					}
							
            }// end method.
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
                                            <li><a href="data.php">Data</a></li>
                                            <li><a href="cart.php">my Cart</li>
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
                <h3>Edit User Profile</h3>
            </section>

            <!-- Main content -->
            <section class="content">
                    <div class="card-columns">
                        <!-- general information -->
                        <div class="card">
                            <div class="card-header">
                                <h5>General information</h5>
                            </div>

                            <div class="card-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="Title" style="font-family: 'pt sans', sans-serif">Title:</label>
                                        <input type="text" class="form-control" id="Title" name="Title" placeholder="Optional" value= "<?php echo $row['Title'];?>">
										<div id="reg-title" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-titleL" style="display: none;">
                                    </div>

                                    <div class="form-group">
                                        <label for="BusinessName" style="font-family: 'pt sans', sans-serif">Business Name:</label>
                                        <input type="text" class="form-control" id="BusinessName" name="BusinessName" placeholder="Optional" value= "<?php echo $row['BusinessName'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="GivenName" style="font-family: 'pt sans', sans-serif">Given Name:</label>
                                        <input type="text" class="form-control" id="GivenName" name="GivenName" placeholder=" Given Name" value="<?php echo $row['GivenName'];?>">
										<div id="reg-gName" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-gNameL" style="display: none;">
                                    </div>
                                    <div class="form-group">
                                        <label for="FamilyName" style="font-family: 'pt sans', sans-serif">Family Name:</label>
                                        <input type="text" class="form-control" id="FamilyName" name="FamilyName" placeholder=" Family Name" value="<?php echo $row['FamilyName'];?>">
										<div id="reg-fName" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-fNameL" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- contact information -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Contact information</h5>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ContactNumber" style="font-family: 'pt sans', sans-serif">Phone Number:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' placeholder="Phone Number"  id="ContactNumber" name="ContactNumber" value="<?php echo $row['ContactNumber'];?>">
                                    </div>
                                </div>
										<div id="reg-number" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-numberL" style="display: none;">

                                <div class="form-group">
                                    <label for="Email" style="font-family: 'pt sans', sans-serif">Email:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email" id="Email" name="Email" value="<?php echo $row['Email'];?>">
                                    </div>
										<div id="reg-emailVal" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">Email is invalid.</div>
										<div id="reg-emailExist" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">Email has already been registered!</div>
										<div id="reg-email" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-emailL" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <!-- address information -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Address Information</h5>
                                <ul class="nav nav-tabs nav-justified card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#Mailing" role="tab" data-toggle="tab">Residential</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Mailing">
                                        <div class="form-group">
                                            <label for="Country">Country</label>
                                            <select   class="form-control"  style="width: 100%;" name="Country" id="Country">
                                                <option selected="selected"><?php echo $row['Country'];?></option>
                                                <option value="Afganistan">Afghanistan</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Belarus">Belarus</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="British Indian Ocean Ter">British Indian Ocean Ter</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burkina Faso">Burkina Faso</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Canary Islands">Canary Islands</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman Islands">Cayman Islands</option> <option value="Central African Republic">Central African Republic</option> <option value="Chad">Chad</option> <option value="Channel Islands">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Christmas Island">Christmas Island</option> <option value="Cocos Island">Cocos Island</option> <option value="Colombia">Colombia</option> <option value="Comoros">Comoros</option> <option value="Congo">Congo</option> <option value="Cook Islands">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Cote DIvoire">Cote D\'Ivoire</option> <option value="Croatia">Croatia</option> <option value="Cuba">Cuba</option> <option value="Curaco">Curacao</option> <option value="Cyprus">Cyprus</option> <option value="Czech Republic">Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value="Estonia">Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Falkland Islands">Falkland Islands</option> <option value="Faroe Islands">Faroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="French Southern Ter">French Southern Ter</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Germany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="Great Britain">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Hawaii">Hawaii</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Iran">Iran</option> <option value="Iraq">Iraq</option> <option value="Ireland">Ireland</option> <option value="Isle of Man">Isle of Man</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value="Kiribati">Kiribati</option> <option value="Korea North">Korea North</option> <option value="Korea Sout">Korea South</option> <option value="Kuwait">Kuwait</option> <option value="Kyrgyzstan">Kyrgyzstan</option> <option value="Laos">Laos</option> <option value="Latvia">Latvia</option> <option value="Lebanon">Lebanon</option> <option value="Lesotho">Lesotho</option> <option value="Liberia">Liberia</option> <option value="Libya">Libya</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malaysia">Malaysia</option> <option value="Malawi">Malawi</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall Islands">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mayotte">Mayotte</option> <option value="Mexico">Mexico</option> <option value="Midway Islands">Midway Islands</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar</option> <option value="Nambia">Nambia</option> <option value="Nauru">Nauru</option> <option value="Nepal">Nepal</option> <option value="Netherland Antilles">Netherland Antilles</option> <option value="Netherlands">Netherlands (Holland, Europe)</option> <option value="Nevis">Nevis</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Niue">Niue</option> <option value="Norfolk Island">Norfolk Island</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value="Pakistan">Pakistan</option> <option value="Palau Island">Palau Island</option> <option value="Palestine">Palestine</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Phillipines">Philippines</option> <option value="Pitcairn Island">Pitcairn Island</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Republic of Montenegro">Republic of Montenegro</option> <option value="Republic of Serbia">Republic of Serbia</option> <option value="Reunion">Reunion</option> <option value="Romania">Romania</option> <option value="Russia">Russia</option> <option value="Rwanda">Rwanda</option> <option value="St Barthelemy">St Barthelemy</option> <option value="St Eustatius">St Eustatius</option> <option value="St Helena">St Helena</option> <option value="St Kitts-Nevis">St Kitts-Nevis</option> <option value="St Lucia">St Lucia</option> <option value="St Maarten">St Maarten</option> <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option> <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option> <option value="Saipan">Saipan</option> <option value="Samoa">Samoa</option> <option value="Samoa American">Samoa American</option> <option value="San Marino">San Marino</option> <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Senegal">Senegal</option> <option value="Serbia">Serbia</option> <option value="Seychelles">Seychelles</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovakia">Slovakia</option> <option value="Slovenia">Slovenia</option> <option value="Solomon Islands">Solomon Islands</option> <option value="Somalia">Somalia</option> <option value="South Africa">South Africa</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Tahiti">Tahiti</option> <option value="Taiwan">Taiwan</option> <option value="Tajikistan">Tajikistan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Tokelau">Tokelau</option> <option value="Tonga">Tonga</option> <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option> <option value="Tunisia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option> <option value="Tuvalu">Tuvalu</option> <option value="Uganda">Uganda</option> <option value="Ukraine">Ukraine</option> <option value="United Arab Erimates">United Arab Emirates</option> <option value="United Kingdom">United Kingdom</option> <option value="United States of America">United States of America</option> <option value="Uraguay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City State">Vatican City State</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option> <option value="Virgin Islands (USA)">Virgin Islands (USA)</option> <option value="Wake Island">Wake Island</option> <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option>';
                                            </select>
										<div id="reg-cty" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-ctyL" style="display: none;">
                                        </div>

                                        <div class="form-group">
                                            <label for="StateProvinceRegion">State/Province/Region</label>
                                            <input type="text" class="form-control" id="StateProvinceRegion" name="StateProvinceRegion" value="<?php echo $row['StateProvinceRegion'];?>">
										<div id="reg-spr" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-sprL" style="display: none;">
                                        </div>

                                        <div class="form-group">
                                            <label for="CountyDistrict">County or District</label>
                                            <input type="text" class="form-control" id="CountyDistrict" name="CountyDistrict" placeholder="Optional" value="<?php echo $row['CountyDistrict'];?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="CityTown">City or Town</label>
                                            <input type="text" class="form-control" id="CityTown" name="CityTown" value="<?php echo $row['CityTown'];?>">
										<div id="reg-ct" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-ctL" style="display: none;">
                                        </div>

                                        <div class="form-group">
                                            <label for="PostalCode">Postal Code</label>
                                            <input type="text" class="form-control" id="PostalCode" name="PostalCode" value="<?php echo $row['PostalCode'];?>">
										<div id="reg-postal" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-postalL" style="display: none;">
                                        </div>
										
                                        <div class="form-group">
                                            <label for="StreetAddress">Street Address</label>
                                            <input type="text" class="form-control" id="StreetAddress" name="StreetAddress" value="<?php echo $row['StreetAddress'];?>">
										<div id="reg-add" class="error_text" style="font-family: 'pt sans', sans-serif; display: none;">This field is required.</div><br id="reg-addL" style="display: none;">
                                        </div>
										
                                        <div class="form-group">
                                            <label for="Premises">Premises</label>
                                            <input type="text" class="form-control" id="Premises" name="Premises" placeholder="Optional" value="<?php echo $row['Premises'];?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <a role="button" class="btn btn-secondary mr-3" href="accounts.profile.php">Cancel</a>
                        <button class="btn btn-honey" onclick="check_info()">Save</button>
                    </div>
            </section>
        </div>
    </div>
	</div>
</div>
</article>

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
							<li>&copy; MeBeezBiz</li><li>Design: <a href="#">Hive Fives</a></li>
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
        <!-- <script type="text/javascript" src="assets/js/main.js"></script> -->
        <script src="js/app.js"></script>
        <script src="js/main.js"></script>

	</body>
</html>