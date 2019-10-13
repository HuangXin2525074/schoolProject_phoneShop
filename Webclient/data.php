<?php
session_start();
include_once '../Server/config/database.php';

if(isset($_GET['id'])) {
    if (isset($_SESSION['isAdmin'])) {
        if (isset($_SESSION['Username'])) {
            $Username = $_SESSION['Username'];
            $isAdmin = $_SESSION['isAdmin'];
        }
        else {

                $isAdmin = $_GET['id'];
                $Username = "Visitor";
        }
    }
    else{
        $isAdmin = $_GET['id'];
        $Username="Visitor";
    }
}
else
{
    if (isset($_SESSION['isAdmin'])) {
        if (isset($_SESSION['Username'])) {
            $Username = $_SESSION['Username'];
            $isAdmin = $_SESSION['isAdmin'];
        } else {
            header("Location: index.php?err=login");
        }
    }
        else
{
header("Location: index.php?err=login");

}
}






?>

<!DOCTYPE HTML>

<html>
<head>
    <title>Data Portal</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/select2.min.css" />
    <link rel="stylesheet" href="css/tabulator_bootstrap4.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="js/jquery.min.js"></script>

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
                            <?php if( $Username!="Visitor") {
                                echo "<li><a href=\"accounts.profile.php\">Account</a></li>";
                                echo " <li><a href=\"#\" id=\"CartModalBar\">my Cart</li>";
                                echo "<li><a href=\"myOrders.php\">My Orders</a></li>";
                           }
                            ?>
                            <li><a href="data.php">Sell Portal</a></li>
                            <li><a href="../Server/logout.php" id="">Log Out</a></li>

                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <article id="main">
        <header>
            <h1>Sell Portal</h1>
            <p>Purchasing Item Here</p>
        </header>



    <div class="py-5">
        <div class="container">

            <div id="response-msg"></div>
            <input type="hidden" name="Username" id="Username" value="<?php echo $Username;?>">
            <input type="hidden" name="isAdmin" id="isAdmin" value="<?php echo $isAdmin;?>">
            <input  type="hidden" name="viewTableName" id="viewTableName" value="">
            <input type="hidden" name="viewPK" id="viewPK" value="">
            <input type="date" id="dateTest" value="" hidden>
            <!--used to store values pertaining to the current record being viewed in the view modal-->

            <div class="container-fluid">


                <div class="table-category-controls">
                    <!-- /////////////////////////Categories///////////////////////////// -->
                    <div class="category-select">
                        <label>Category: </label>
                        <select id="main-cat" class="form-control form-control-sm" onchange="categoryChanged();">
                            <?php if($isAdmin == 1){
                                echo "<option value=\"Admin\">Admin</option>";
                            }?>
                            <option value="All Device">All Device</option>
                            <option value="iphone">iphone</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Huawei">Huawei</option>
                            <option value="Xiaomi">Xiaomi</option>
                        </select>
                    </div>

                </div>
                <hr>
                <!-- /////////////////////////////////// Main Controls//////////////////////////// -->
                <div id="Main-mbb-controls" class="table-controls">
                    <div class="table-control-inputs">
                        <div class="search-table">
                            <i class="fa fa-search fa-fw"></i>
                            <input name="name" type="text" class="form-control form-control-sm" placeholder="Search">
                        </div>

                        <select id="Main-mbb-columns" class="form-control form-control-sm">
                            <option value="Select Column" disabled selected="selected">Select Column</option>
                            <option value="Username">Username</option>
                            <option value="Email">Email</option>
                            <option value="ContactNumber">ContactNumber</option>
                        </select>
                    </div>


                    <div class="table-control-buttons">
                        <button type="button" name="add" id="RelatedMain-mbb-add" class="btn btn-honey btn-sm" data-toggle="tooltip" title="Add a new record to the current table.">
                            <i class="fa fa-plus"></i>
                            <span class="btn-text"> Add Row</span>
                        </button>
                        <button type="button" name="delete" id="Main-mbb-delete_all" class="btn btn-honey btn-sm" data-toggle="tooltip" title="Delete one or more selected records in the table.">
                            <i class="fa fa-trash"></i>
                            <span class="btn-text"> Delete</span>
                        </button>
                    </div>
                    <script>
                        var admin = document.getElementById("isAdmin").innerHTML;

                        if(admin == 1) {
                            $('.table-control-buttons').show();
                        }
                        else {
                            $('.table-control-buttons').hide();
                        }
                    </script>

                </div>
                <div id="Main-mbb-table" display="none;"></div>


    </div>
    </div>
    </article>


    <div id="addUserModal" class="modal fade aboveView" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h4 class="modal-title" id="add_user_modal_title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body"  id="add_user_modal_body">
                    <form>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Personal Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Username">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_username" placeholder="Username">
                                    <div id="add_user_userVal" class="error_text">Username must be between 8-30 characters in length.</div>
                                    <div id="add_user_userExist" class="error_text">Username already exists!</div>
                                    <div id="add_user_user_err" class="error_text">This field is required.</div><br id="add_user_user_errL">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="upassword" id="add_password" placeholder="Password">
                                    <div id="add_user_passVal" class="error_text">Password must be longer than 8 characters and contain at least one character and one digit.</div>
                                    <div id="add_user_pass_err" class="error_text">This field is required.</div><br id="add_user_pass_errL">
                                </div>

                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control" id="add_business_name" placeholder="Business Name">
                                </div>

                                <div class="form-group">
                                    <label for="family_name">Family Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_family_name" placeholder="Family Name">
                                    <div id="add_user_fname_err" class="error_text">This field is required.</div><br id="add_user_fname_errL">
                                </div>

                                <div class="form-group">
                                    <label for="given_name">Given Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_given_name" placeholder="Given Name">
                                    <div id="add_user_gname_err" class="error_text">This field is required.</div><br id="add_user_gname_errL">
                                </div>

                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_title" placeholder="Title">
                                    <div id="add_user_title_err" class="error_text">This field is required.</div><br id="add_user_title_errL">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_email" placeholder="Email">
                                    <div id="add_user_emailVal" class="error_text">Email is invalid.</div>
                                    <div id="add_user_emailExist" class="error_text">Email has already been registered!</div>
                                    <div id="add_user_email_err" class="error_text">This field is required.</div><br id="add_user_email_errL">
                                </div>

                                <div class="form-group">
                                    <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_contact_number" placeholder="Contact Number">
                                    <div id="add_user_number_err" class="error_text">This field is required.</div><br id="add_user_number_errL">
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Residential Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="country">Country <span class="text-danger">*</span></label>
                                    <select  class="form-control" id="add_user_country" placeholder="Country">
                                    <option value="Afganistan">Afghanistan</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Belarus">Belarus</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="British Indian Ocean Ter">British Indian Ocean Ter</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burkina Faso">Burkina Faso</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Canary Islands">Canary Islands</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman Islands">Cayman Islands</option> <option value="Central African Republic">Central African Republic</option> <option value="Chad">Chad</option> <option value="Channel Islands">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Christmas Island">Christmas Island</option> <option value="Cocos Island">Cocos Island</option> <option value="Colombia">Colombia</option> <option value="Comoros">Comoros</option> <option value="Congo">Congo</option> <option value="Cook Islands">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Cote DIvoire">Cote D\'Ivoire</option> <option value="Croatia">Croatia</option> <option value="Cuba">Cuba</option> <option value="Curaco">Curacao</option> <option value="Cyprus">Cyprus</option> <option value="Czech Republic">Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value="Estonia">Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Falkland Islands">Falkland Islands</option> <option value="Faroe Islands">Faroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="French Southern Ter">French Southern Ter</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Germany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="Great Britain">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Hawaii">Hawaii</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Iran">Iran</option> <option value="Iraq">Iraq</option> <option value="Ireland">Ireland</option> <option value="Isle of Man">Isle of Man</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value="Kiribati">Kiribati</option> <option value="Korea North">Korea North</option> <option value="Korea Sout">Korea South</option> <option value="Kuwait">Kuwait</option> <option value="Kyrgyzstan">Kyrgyzstan</option> <option value="Laos">Laos</option> <option value="Latvia">Latvia</option> <option value="Lebanon">Lebanon</option> <option value="Lesotho">Lesotho</option> <option value="Liberia">Liberia</option> <option value="Libya">Libya</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malaysia">Malaysia</option> <option value="Malawi">Malawi</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall Islands">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mayotte">Mayotte</option> <option value="Mexico">Mexico</option> <option value="Midway Islands">Midway Islands</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar</option> <option value="Nambia">Nambia</option> <option value="Nauru">Nauru</option> <option value="Nepal">Nepal</option> <option value="Netherland Antilles">Netherland Antilles</option> <option value="Netherlands">Netherlands (Holland, Europe)</option> <option value="Nevis">Nevis</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Niue">Niue</option> <option value="Norfolk Island">Norfolk Island</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value="Pakistan">Pakistan</option> <option value="Palau Island">Palau Island</option> <option value="Palestine">Palestine</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Phillipines">Philippines</option> <option value="Pitcairn Island">Pitcairn Island</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Republic of Montenegro">Republic of Montenegro</option> <option value="Republic of Serbia">Republic of Serbia</option> <option value="Reunion">Reunion</option> <option value="Romania">Romania</option> <option value="Russia">Russia</option> <option value="Rwanda">Rwanda</option> <option value="St Barthelemy">St Barthelemy</option> <option value="St Eustatius">St Eustatius</option> <option value="St Helena">St Helena</option> <option value="St Kitts-Nevis">St Kitts-Nevis</option> <option value="St Lucia">St Lucia</option> <option value="St Maarten">St Maarten</option> <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option> <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option> <option value="Saipan">Saipan</option> <option value="Samoa">Samoa</option> <option value="Samoa American">Samoa American</option> <option value="San Marino">San Marino</option> <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Senegal">Senegal</option> <option value="Serbia">Serbia</option> <option value="Seychelles">Seychelles</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovakia">Slovakia</option> <option value="Slovenia">Slovenia</option> <option value="Solomon Islands">Solomon Islands</option> <option value="Somalia">Somalia</option> <option value="South Africa">South Africa</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Tahiti">Tahiti</option> <option value="Taiwan">Taiwan</option> <option value="Tajikistan">Tajikistan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Tokelau">Tokelau</option> <option value="Tonga">Tonga</option> <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option> <option value="Tunisia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option> <option value="Tuvalu">Tuvalu</option> <option value="Uganda">Uganda</option> <option value="Ukraine">Ukraine</option> <option value="United Arab Erimates">United Arab Emirates</option> <option value="United Kingdom">United Kingdom</option> <option value="United States of America">United States of America</option> <option value="Uraguay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City State">Vatican City State</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option> <option value="Virgin Islands (USA)">Virgin Islands (USA)</option> <option value="Wake Island">Wake Island</option> <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option>';
                                    </select>

                                    <div id="add_user_cty_err" class="error_text">This field is required.</div><br id="add_user_cty_errL">
                                </div>

                                <div class="form-group">
                                    <label for="state">State/Province/Region <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_state" placeholder="State/Province/Region">
                                    <div id="add_user_spr_err" class="error_text">This field is required.</div><br id="add_user_spr_errL">
                                </div>

                                <div class="form-group">
                                    <label for="district">County or District</label>
                                    <input type="text" class="form-control" id="add_county_district" placeholder="District">
                                </div>

                                <div class="form-group">
                                    <label for="city_town">City or Town <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_city_town" placeholder="City Town">
                                    <div id="add_user_citytown_err" class="error_text">This field is required.</div><br id="add_user_citytown_errL">
                                </div>

                                <div class="form-group">
                                    <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_postal_code" placeholder="Postal Code">
                                    <div id="add_user_postal_err" class="error_text">This field is required.</div><br id="add_user_postal_errL">
                                </div>

                                <div class="form-group">
                                    <label for="street_address">Street Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_street_address" placeholder="Street Address">
                                    <div id="add_user_street_err" class="error_text">This field is required.</div><br id="add_user_street_errL">
                                </div>

                                <div class="form-group">
                                    <label for="premises">Premises</label>
                                    <input type="text" class="form-control" id="add_premises" placeholder="Street Address">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="add_isAdmin" placeholder="RPremises" value="admin"><label for="adminPriv">&nbsp&nbspUser has site admin privileges. <span class="text-danger">*</span></label><br>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="add_user_btn" class="btn  btn-honey">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //add User// -->

    <div id="addSuccessModal" class="modal fade aboveView">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Add successful!</h4>
                    <p style="color: #212529;">Your record has been added.</p>
                    <button class="btn btn-success" data-dismiss="modal" id="refresh"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>

    <div id="OrderSuccessModal" class="modal fade aboveView">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Order successful!</h4>
                    <p style="color: #212529;">Your order has been added.</p><br>Here is your OrderID:<br>
                    <p style="color: #212529;" id="OrderID"></p>
                    <button class="btn btn-success" data-dismiss="modal" id="refreshOrder"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>



    <div id="errorModalRet" class="modal fade aboveView" style="top: 20%; position: absolute;">
        <div class="modal-dialog modal-baderr">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4 class="modal-title">Sorry!</h4><br><br>
                    <p class="text-center" style="color: #212529;">Your action has failed.<br>Please try again in a few minutes or contact help.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <div id="EmptyCartModal" class="modal fade aboveView" style="top: 20%; position: absolute;">
        <div class="modal-dialog modal-baderr">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4 class="modal-title">Sorry!</h4><br><br>
                    <p class="text-center" style="color: #212529;">Empty Cart items.<br>Please Order item from sell portal.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="DeleteNoneSelectedModal" class="modal fade aboveView">
        <div class="modal-dialog modal-error">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4>No records selected</h4>
                    <p style="color: #212529;">Please click on one or more records to delete.</p>
                    <button class="btn btn-honey" data-dismiss="modal">Go Back</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteItemModal" class="modal fade aboveView">
        <div class="modal-dialog modal-warning">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="icon-box" >
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">Are you sure?</h4>
                    <br><p style="color: #212529;">Do you really want to delete these Item records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" id="deleteItemBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteUserModal" class="modal fade aboveView">
        <div class="modal-dialog modal-warning">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="icon-box" >
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">Are you sure?</h4>
                    <br><p style="color: #212529;">NOTE: Deleting these selected users cannot be undone, and all associated records will be lost! Do you still want to continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" id="deleteUserBtn" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div id="deletionSuccessModal" class="modal fade aboveView">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Deletion successful!</h4>
                    <p style="color: #212529;">Your selected records have been removed.</p>
                    <button class="btn btn-success" data-dismiss="modal"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h5 class="modal-title" id="myViewModalLabel">View Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <div id="view_body_User">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Personal Information</h6>
                            </div>
                            <div class="card-body">
                                <label for="isadmin" class="view_details_label">Account Type: </label>
                                <span id="view_isadmin" class="view_details_value"></span><br><br>

                                <label for="Username" class="view_details_label">Username: </label>
                                <span id="view_username" class="view_details_value"></span><br>


                                <label for="business_name" class="view_details_label">Business Name: </label>
                                <span id="view_business_name" class="view_details_value"></span><br>

                                <label for="family_name" class="view_details_label">Family Name: </label>
                                <span id="view_family_name" class="view_details_value"></span><br>

                                <label for="given_name" class="view_details_label">Given Name: </label>
                                <span id="view_given_name" class="view_details_value"></span><br>

                                <label for="title" class="view_details_label">Title: </label>
                                <span id="view_title" class="view_details_value"></span><br>

                                <label for="email" class="view_details_label">Email: </label>
                                <span id="view_email" class="view_details_value"></span><br>

                                <label for="contact_number" class="view_details_label">Contact Number: </label>
                                <span id="view_contact_number" class="view_details_value"></span>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Residential Address</h6>
                            </div>
                            <div class="card-body">
                                <label for="country" class="view_details_label">Country: </label>
                                <span id="view_user_country" class="view_details_value"></span><br>

                                <label for="state" class="view_details_label">State/Province/Region: </label>
                                <span id="view_state" class="view_details_value"></span><br>

                                <label for="district" class="view_details_label">County or District: </label>
                                <span id="view_county_district" class="view_details_value"></span><br>

                                <label for="city_town" class="view_details_label">City or Town: </label>
                                <span id="view_city_town" class="view_details_value"></span><br>

                                <label for="postal_code" class="view_details_label">Postal Code: </label>
                                <span id="view_postal_code" class="view_details_value"></span><br>

                                <label for="street_address" class="view_details_label">Street Address: </label>
                                <span id="view_street_address" class="view_details_value"></span><br>

                                <label for="premises" class="view_details_label">Premises: </label>
                                <span id="view_premises" class="view_details_value"></span>
                            </div>
                        </div>
                    </div>

                    <div id="view_body_item">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Basic Information</h6>
                            </div>
                            <div class="card-body">


                                <label for="ItemName" class="view_details_label">Item Name: </label>
                                <span id="view_ItemName" class="view_details_value"></span><br>

                                <label for="Color" class="view_details_label">Color: </label>
                                <span id="view_Color" class="view_details_value"></span><br>

                                <label for="Capacity" class="view_details_label">Capacity: </label>
                                <span id="view_Capacity" class="view_details_value"></span><br>

                                <label for="Display" class="view_details_label">Display: </label>
                                <span id="view_Display" class="view_details_value"></span><br>

                                <label for="Chip" class="view_details_label">Chip: </label>
                                <span id="view_Chip" class="view_details_value"></span><br>

                                <label for="Camera" class="view_details_label">Camera: </label>
                                <span id="view_Camera" class="view_details_value"></span><br>

                                <label for="Store" class="view_details_label">Store: </label>
                                <span id="view_Store" class="view_details_value"></span><br>

                                <label for="Price" class="view_details_label">Price: </label>
                                <span id="view_Price" class="view_details_value"></span><br>
                            </div>
                        </div>
                    </div>

                    <div class="NoShowItem">
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <label for="Number" class="view_details_label">Number of Item: </label>
                                <input type="Number" class="form-control" id="Add_Order" placeholder="NumberItem">
                                <div id="edit_Qty_antVal" class="error_text">Store must be positive.</div>
                                <div id="edit_NoStore_antVal" class="error_text">Out of Store.</div>

                                <div id="edit_Qty_err" class="error_text">This field is required.</div><br>

                            </div>
                            <button type="button" id="add_cart_btn" class="btn  btn-honey">Add to my cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- //add apiarist// -->

    <div id="editUserModal" class="modal fade aboveView" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h4 class="modal-title" id="edit_user_modal_title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="edit-apiarist-msg" class="response-msg1"></div>
                <div class="modal-body"  id="edit_user_modal_body">
                    <form>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Personal Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Username">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_username" placeholder="Username" readonly="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control" id="edit_business_name" placeholder="Business Name">
                                </div>
                                <div class="form-group">
                                    <label for="family_name">Family Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_family_name" placeholder="Family Name">
                                    <div id="edit_user_fname_err" class="error_text">This field is required.</div><br id="edit_user_fname_errL">
                                </div>
                                <div class="form-group">
                                    <label for="given_name">Given Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_given_name" placeholder="Given Name">
                                    <div id="edit_user_gname_err" class="error_text">This field is required.</div><br id="edit_user_gname_errL">
                                </div>
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_title" placeholder="Title">
                                    <div id="edit_user_title_err" class="error_text">This field is required.</div><br id="edit_user_title_errL">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_email" placeholder="Email">
                                    <div id="edit_user_emailVal" class="error_text">Email is invalid.</div>
                                    <div id="edit_user_emailExist" class="error_text">Email has already been registered!</div>
                                    <div id="edit_user_email_err" class="error_text">This field is required.</div><br id="edit_user_email_errL">
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_contact_number" placeholder="Contact Number">
                                    <div id="edit_user_number_err" class="error_text">This field is required.</div><br id="edit_user_number_errL">
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Residential Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="country">Country <span class="text-danger">*</span></label>
                                    <select  class="form-control" id="edit_user_country" placeholder="Country"> <option value="Afganistan">Afghanistan</option> <option value="Albania">Albania</option> <option value="Algeria">Algeria</option> <option value="American Samoa">American Samoa</option> <option value="Andorra">Andorra</option> <option value="Angola">Angola</option> <option value="Anguilla">Anguilla</option> <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option> <option value="Argentina">Argentina</option> <option value="Armenia">Armenia</option> <option value="Aruba">Aruba</option> <option value="Australia">Australia</option> <option value="Austria">Austria</option> <option value="Azerbaijan">Azerbaijan</option> <option value="Bahamas">Bahamas</option> <option value="Bahrain">Bahrain</option> <option value="Bangladesh">Bangladesh</option> <option value="Barbados">Barbados</option> <option value="Belarus">Belarus</option> <option value="Belgium">Belgium</option> <option value="Belize">Belize</option> <option value="Benin">Benin</option> <option value="Bermuda">Bermuda</option> <option value="Bhutan">Bhutan</option> <option value="Bolivia">Bolivia</option> <option value="Bonaire">Bonaire</option> <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option> <option value="Botswana">Botswana</option> <option value="Brazil">Brazil</option> <option value="British Indian Ocean Ter">British Indian Ocean Ter</option> <option value="Brunei">Brunei</option> <option value="Bulgaria">Bulgaria</option> <option value="Burkina Faso">Burkina Faso</option> <option value="Burundi">Burundi</option> <option value="Cambodia">Cambodia</option> <option value="Cameroon">Cameroon</option> <option value="Canada">Canada</option> <option value="Canary Islands">Canary Islands</option> <option value="Cape Verde">Cape Verde</option> <option value="Cayman Islands">Cayman Islands</option> <option value="Central African Republic">Central African Republic</option> <option value="Chad">Chad</option> <option value="Channel Islands">Channel Islands</option> <option value="Chile">Chile</option> <option value="China">China</option> <option value="Christmas Island">Christmas Island</option> <option value="Cocos Island">Cocos Island</option> <option value="Colombia">Colombia</option> <option value="Comoros">Comoros</option> <option value="Congo">Congo</option> <option value="Cook Islands">Cook Islands</option> <option value="Costa Rica">Costa Rica</option> <option value="Cote DIvoire">Cote D\'Ivoire</option> <option value="Croatia">Croatia</option> <option value="Cuba">Cuba</option> <option value="Curaco">Curacao</option> <option value="Cyprus">Cyprus</option> <option value="Czech Republic">Czech Republic</option> <option value="Denmark">Denmark</option> <option value="Djibouti">Djibouti</option> <option value="Dominica">Dominica</option> <option value="Dominican Republic">Dominican Republic</option> <option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> <option value="Egypt">Egypt</option> <option value="El Salvador">El Salvador</option> <option value="Equatorial Guinea">Equatorial Guinea</option> <option value="Eritrea">Eritrea</option> <option value="Estonia">Estonia</option> <option value="Ethiopia">Ethiopia</option> <option value="Falkland Islands">Falkland Islands</option> <option value="Faroe Islands">Faroe Islands</option> <option value="Fiji">Fiji</option> <option value="Finland">Finland</option> <option value="France">France</option> <option value="French Guiana">French Guiana</option> <option value="French Polynesia">French Polynesia</option> <option value="French Southern Ter">French Southern Ter</option> <option value="Gabon">Gabon</option> <option value="Gambia">Gambia</option> <option value="Georgia">Georgia</option> <option value="Germany">Germany</option> <option value="Ghana">Ghana</option> <option value="Gibraltar">Gibraltar</option> <option value="Great Britain">Great Britain</option> <option value="Greece">Greece</option> <option value="Greenland">Greenland</option> <option value="Grenada">Grenada</option> <option value="Guadeloupe">Guadeloupe</option> <option value="Guam">Guam</option> <option value="Guatemala">Guatemala</option> <option value="Guinea">Guinea</option> <option value="Guyana">Guyana</option> <option value="Haiti">Haiti</option> <option value="Hawaii">Hawaii</option> <option value="Honduras">Honduras</option> <option value="Hong Kong">Hong Kong</option> <option value="Hungary">Hungary</option> <option value="Iceland">Iceland</option> <option value="India">India</option> <option value="Indonesia">Indonesia</option> <option value="Iran">Iran</option> <option value="Iraq">Iraq</option> <option value="Ireland">Ireland</option> <option value="Isle of Man">Isle of Man</option> <option value="Israel">Israel</option> <option value="Italy">Italy</option> <option value="Jamaica">Jamaica</option> <option value="Japan">Japan</option> <option value="Jordan">Jordan</option> <option value="Kazakhstan">Kazakhstan</option> <option value="Kenya">Kenya</option> <option value="Kiribati">Kiribati</option> <option value="Korea North">Korea North</option> <option value="Korea Sout">Korea South</option> <option value="Kuwait">Kuwait</option> <option value="Kyrgyzstan">Kyrgyzstan</option> <option value="Laos">Laos</option> <option value="Latvia">Latvia</option> <option value="Lebanon">Lebanon</option> <option value="Lesotho">Lesotho</option> <option value="Liberia">Liberia</option> <option value="Libya">Libya</option> <option value="Liechtenstein">Liechtenstein</option> <option value="Lithuania">Lithuania</option> <option value="Luxembourg">Luxembourg</option> <option value="Macau">Macau</option> <option value="Macedonia">Macedonia</option> <option value="Madagascar">Madagascar</option> <option value="Malaysia">Malaysia</option> <option value="Malawi">Malawi</option> <option value="Maldives">Maldives</option> <option value="Mali">Mali</option> <option value="Malta">Malta</option> <option value="Marshall Islands">Marshall Islands</option> <option value="Martinique">Martinique</option> <option value="Mauritania">Mauritania</option> <option value="Mauritius">Mauritius</option> <option value="Mayotte">Mayotte</option> <option value="Mexico">Mexico</option> <option value="Midway Islands">Midway Islands</option> <option value="Moldova">Moldova</option> <option value="Monaco">Monaco</option> <option value="Mongolia">Mongolia</option> <option value="Montserrat">Montserrat</option> <option value="Morocco">Morocco</option> <option value="Mozambique">Mozambique</option> <option value="Myanmar">Myanmar</option> <option value="Nambia">Nambia</option> <option value="Nauru">Nauru</option> <option value="Nepal">Nepal</option> <option value="Netherland Antilles">Netherland Antilles</option> <option value="Netherlands">Netherlands (Holland, Europe)</option> <option value="Nevis">Nevis</option> <option value="New Caledonia">New Caledonia</option> <option value="New Zealand">New Zealand</option> <option value="Nicaragua">Nicaragua</option> <option value="Niger">Niger</option> <option value="Nigeria">Nigeria</option> <option value="Niue">Niue</option> <option value="Norfolk Island">Norfolk Island</option> <option value="Norway">Norway</option> <option value="Oman">Oman</option> <option value="Pakistan">Pakistan</option> <option value="Palau Island">Palau Island</option> <option value="Palestine">Palestine</option> <option value="Panama">Panama</option> <option value="Papua New Guinea">Papua New Guinea</option> <option value="Paraguay">Paraguay</option> <option value="Peru">Peru</option> <option value="Phillipines">Philippines</option> <option value="Pitcairn Island">Pitcairn Island</option> <option value="Poland">Poland</option> <option value="Portugal">Portugal</option> <option value="Puerto Rico">Puerto Rico</option> <option value="Qatar">Qatar</option> <option value="Republic of Montenegro">Republic of Montenegro</option> <option value="Republic of Serbia">Republic of Serbia</option> <option value="Reunion">Reunion</option> <option value="Romania">Romania</option> <option value="Russia">Russia</option> <option value="Rwanda">Rwanda</option> <option value="St Barthelemy">St Barthelemy</option> <option value="St Eustatius">St Eustatius</option> <option value="St Helena">St Helena</option> <option value="St Kitts-Nevis">St Kitts-Nevis</option> <option value="St Lucia">St Lucia</option> <option value="St Maarten">St Maarten</option> <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option> <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option> <option value="Saipan">Saipan</option> <option value="Samoa">Samoa</option> <option value="Samoa American">Samoa American</option> <option value="San Marino">San Marino</option> <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option> <option value="Saudi Arabia">Saudi Arabia</option> <option value="Senegal">Senegal</option> <option value="Serbia">Serbia</option> <option value="Seychelles">Seychelles</option> <option value="Sierra Leone">Sierra Leone</option> <option value="Singapore">Singapore</option> <option value="Slovakia">Slovakia</option> <option value="Slovenia">Slovenia</option> <option value="Solomon Islands">Solomon Islands</option> <option value="Somalia">Somalia</option> <option value="South Africa">South Africa</option> <option value="Spain">Spain</option> <option value="Sri Lanka">Sri Lanka</option> <option value="Sudan">Sudan</option> <option value="Suriname">Suriname</option> <option value="Swaziland">Swaziland</option> <option value="Sweden">Sweden</option> <option value="Switzerland">Switzerland</option> <option value="Syria">Syria</option> <option value="Tahiti">Tahiti</option> <option value="Taiwan">Taiwan</option> <option value="Tajikistan">Tajikistan</option> <option value="Tanzania">Tanzania</option> <option value="Thailand">Thailand</option> <option value="Togo">Togo</option> <option value="Tokelau">Tokelau</option> <option value="Tonga">Tonga</option> <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option> <option value="Tunisia">Tunisia</option> <option value="Turkey">Turkey</option> <option value="Turkmenistan">Turkmenistan</option> <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option> <option value="Tuvalu">Tuvalu</option> <option value="Uganda">Uganda</option> <option value="Ukraine">Ukraine</option> <option value="United Arab Erimates">United Arab Emirates</option> <option value="United Kingdom">United Kingdom</option> <option value="United States of America">United States of America</option> <option value="Uraguay">Uruguay</option> <option value="Uzbekistan">Uzbekistan</option> <option value="Vanuatu">Vanuatu</option> <option value="Vatican City State">Vatican City State</option> <option value="Venezuela">Venezuela</option> <option value="Vietnam">Vietnam</option> <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option> <option value="Virgin Islands (USA)">Virgin Islands (USA)</option> <option value="Wake Island">Wake Island</option> <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option> <option value="Yemen">Yemen</option> <option value="Zaire">Zaire</option> <option value="Zambia">Zambia</option> <option value="Zimbabwe">Zimbabwe</option>';
                                    </select>




                                    <div id="edit_user_cty_err" class="error_text">This field is required.</div><br id="edit_user_cty_errL">
                                </div>
                                <div class="form-group">
                                    <label for="state">State/Province/Region <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_state" placeholder="State/Province/Region">
                                    <div id="edit_user_spr_err" class="error_text">This field is required.</div><br id="edit_user_spr_errL">
                                </div>
                                <div class="form-group">
                                    <label for="district">County or District</label>
                                    <input type="text" class="form-control" id="edit_county_district" placeholder="District">
                                </div>
                                <div class="form-group">
                                    <label for="city_town">City or Town <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_city_town" placeholder="City Town">
                                    <div id="edit_user_citytown_err" class="error_text">This field is required.</div><br id="edit_user_citytown_errL">
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_postal_code" placeholder="Postal Code">
                                    <div id="edit_user_postal_err" class="error_text">This field is required.</div><br id="edit_user_postal_errL">
                                </div>
                                <div class="form-group">
                                    <label for="street_address">Street Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_street_address" placeholder="Street Address">
                                    <div id="edit_user_street_err" class="error_text">This field is required.</div><br id="edit_user_street_errL">
                                </div>
                                <div class="form-group">
                                    <label for="premises">Premises</label>
                                    <input type="text" class="form-control" id="edit_premises" placeholder="Street Address">
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <input type="checkbox" id="edit_isAdmin" placeholder="RPremises" value="admin"><label for="adminPriv">&nbsp&nbspUser has site admin privileges.</label><br>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="button" id="edit_user_btn" class="btn  btn-honey">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="editSuccessModal" class="modal fade aboveView">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Edit successful!</h4>
                    <p style="color: #212529;">Your record has been edited.</p>
                    <button class="btn btn-success" data-dismiss="modal"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>


    <div id="resetPasswordPrompt" class="modal fade">
        <div class="modal-dialog modal-warning">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="icon-box" >
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">Are you sure?</h4>
                    <br><p style="color: #212529;">Do you really want to reset this account's password? This process cannot be undone.</p>
                    <input type="hidden" name="ResetPassUser" id="ResetPassUser" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" id="resetPasswordPromptBtn" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
    </div>


    <div id="resetPasswordModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h4>Reset successful!</h4>
                    <p style="color: #212529;">The selected account's password has been reset.<br><br>Here is the new password:<br></p>
                    <p style="color: #212529;" id="resetPassTxt"></p>
                    <button class="btn btn-success" data-dismiss="modal"><span>Continue Browsing</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div>


    <!-- //add item// -->
    <div id="addItemModal" class="modal fade aboveView" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h4 class="modal-title" id="add_account_modal_title">Add Device</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="add-account-item-msg"></div>
                <div class="modal-body" id="add_account_modal_body">
                    <form>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Device Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ItemName">Item Name <span class="text-danger">*</span></label>
                                    <input type="itemName" class="form-control" id="add_ItemName" placeholder="Item Name">
                                    <div id="add_item_err" class="error_text">This field is required.</div><br id="add_ItemName_errL">
                                </div>

                                <div class="form-group">
                                    <label for="ItemType">Item Type <span class="text-danger">*</span></label>
                                    <input type="itemType" class="form-control" id="add_ItemType" placeholder="Item Type">
                                    <div id="add_ItemType_err" class="error_text">This field is required.</div><br id="add_ItemType_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Color">Color <span class="text-danger">*</span></label>
                                    <input type="Color_" class="form-control" id="add_Color" placeholder="Color">
                                    <div id="add_Color_err" class="error_text">This field is required.</div><br id="add_Color_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Capacity">Capacity <span class="text-danger">*</span></label>
                                    <input type="Capacity" class="form-control" id="add_Capacity" placeholder="Capacity">
                                    <div id="add_Capacity_err" class="error_text">This field is required.</div><br id="add_Capacity_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Display">Display <span class="text-danger">*</span></label>
                                    <input type="Display" class="form-control" id="add_Display" placeholder="Display">
                                    <div id="add_Display_err" class="error_text">This field is required.</div><br id="add_Display_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Chip">Chip <span class="text-danger">*</span></label>
                                    <input type="Chip" class="form-control" id="add_Chip" placeholder="Chip">
                                    <div id="add_Chip_err" class="error_text">This field is required.</div><br id="add_Chip_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Camera">Camera <span class="text-danger">*</span></label>
                                    <input type="Camera" class="form-control" id="add_Camera" placeholder="Camera">
                                    <div id="add_Camera_err" class="error_text">This field is required.</div><br id="add_Camera_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Store">Store <span class="text-danger">*</span></label>
                                    <input type="Store" class="form-control" id="add_Store" placeholder="Store">
                                    <div id="add_Store_err" class="error_text">This field is required.</div><br id="add_Store_errL">
                                </div>


                                <div class="form-group">
                                    <label for="Price">Price <span class="text-danger">*</span></label>
                                    <input type="Number" class="form-control" id="add_Price_Amount" placeholder="Price" >
                                    <div id="add_Price_amtVal" class="error_text">This amount must be positive.</div>
                                    <div id="add_Price_amt_err" class="error_text">This field is required.</div><br id="add_Price_amt_errL">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="add_item_btn" class="btn  btn-honey">Add</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <!-- //edit item// -->
    <div id="editAccountItemModal" class="modal fade aboveView" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h4 class="modal-title" id="edit_account_modal_title">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="edit-account-item-msg"></div>
                <div class="modal-body" id="edit_account_modal_body">
                    <form>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Basic Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ItemID">Item ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_ItemID" placeholder="ItemID" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="ItemName">Item Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_ItemName" placeholder="ItemName">
                                    <div id="edit_ItemName_err" class="error_text">This field is required.</div><br id="edit_ItemName_errL">
                                </div>
                                <div class="form-group">
                                    <label for="ItemName">Item Type <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_ItemType" placeholder="ItemType">
                                    <div id="edit_ItemType_err" class="error_text">This field is required.</div><br id="edit_ItemType_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Color">Color <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_Color" placeholder="ItemColor">
                                    <div id="edit_Color_err" class="error_text">This field is required.</div><br id="edit_Color_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Capacity">Capacity <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_Capacity" placeholder="Capacity">
                                    <div id="edit_Capacity_err" class="error_text">This field is required.</div><br id="edit_Capacity_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Display">Display <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_Display" placeholder="ItemColor">
                                    <div id="edit_Display_err" class="error_text">This field is required.</div><br id="edit_Display_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Chip">Chip <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_Chip" placeholder="Chip">
                                    <div id="edit_Chip_err" class="error_text">This field is required.</div><br id="edit_Chip_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Camera">Camera <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_Camera" placeholder="Chip">
                                    <div id="edit_Camera_err" class="error_text">This field is required.</div><br id="edit_Camera_errL">
                                </div>
                                <div class="form-group">
                                    <label for="Camera">Store <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit_Store" placeholder="Store">
                                    <div id="edit_Store_antVal" class="error_text">Store must be positive.</div>
                                    <div id="edit_Store_err" class="error_text">This field is required.</div><br id="edit_Camera_errL">

                                </div>


                                <div class="form-group">
                                    <label for="Price">Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit_Price" placeholder="Amount" >
                                    <div id="edit_Price_amtVal" class="error_text">This amount must be positive.</div>
                                    <div id="edit_Price_amt_err" class="error_text">This field is required.</div><br id="edit_Price_amt_errL">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="button" id="edit_item_btn" class="btn  btn-honey">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="CartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-honey">
                    <h5 class="modal-title" id="myViewModalLabel">My Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">

                    <div id="HistoryContainer_ViewModal">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Items Selected</h6>
                            </div>
                            <div class="card-body">
                                <div class="col-table mt-3">
                                    <div class="col-table-header">
                                        <div class="row">
                                            <div class="col-6 text-center"><b>Item Name</b></div>
                                            <div class="col-3 text-left"><b>QTY</b></div>
                                            <div class="col-3 text-left"><b>Price</b></div>
                                        </div>
                                    </div>
                                    <div class="col-table-body" style="height:200px" id="viewModalChartBody">
                                    </div>
                                </div>

                                <div>Total Price: <span class="text-danger"> $</span> <span id="TotalPrice"></span></div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" id="submit_order_btn" class="btn  btn-honey">Submit Order</button>
                            <button type="button" id="clear_cart_btn" class="btn  btn-honey">Clear Cart</button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>








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
    <script type="text/javascript" src="js/user.js"></script>
    <script type="text/javascript" src="js/data.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/items.js"></script>
    <script type="text/javascript" src="js/mycart.js"></script>
    <script type="text/javascript" src="js/iphone.js"></script>
    <script type="text/javascript" src="js/samsung.js"></script>
    <script type="text/javascript" src="js/huawei.js"></script>
    <script type="text/javascript" src="js/xiaomi.js"></script>
</body>
</html>

<script>

$('#refreshOrder').click(function()
{

        location.reload();


});



$('#CartModalBar').click(function() {
    $('body').removeClass('is-menu-visible');
    $("#CartModal").modal('toggle');

    var Username= $('#Username').val();


     $.ajax({
         type: "post",
         url: api_url+'getCart.php',
         data:{Username:Username},
         dataType:'JSON',
         async: false,
         success: function(data)
         {
             var cartStr = "";
             if(data.length ==0)
             {
                 cartStr="<div class=\"row\"><div class=\"col-12 text-center\"><br><br><br><br>-----No items to display.-----</b></div></div>";
             }
             else 
             {
                 for(var i=0;i<data.length;i++)
                 {
                     cartStr += "<div class=\"row changelogEntry\">";
                     cartStr += "<div class=\"col-6  text-center ItemName\">" +   data[i]['ItemName'] +"</div>";
                     cartStr += "<div class=\"col-3 text-left QTY\">" + data[i]['Qty'] + "</div>";
                     cartStr += "<div class=\"col-3 text-left Price\">" + data[i]['Price'] + "</div>";
                     cartStr += "</div>";
                 }

                 
                 
             }
             $('#viewModalChartBody').html(cartStr);


         }

     });



    $.ajax({
        type: "post",
        url: api_url+'getTotalPrice.php',
        data:{Username:Username},
        dataType:'JSON',
        async: false,
        success: function(data)
        {
            var TotalPrice;
            if(data.length ==0)
            {
                TotalPrice=0;
            }
            else
            {
                TotalPrice= data['total'];


            }
            $('#TotalPrice').html( TotalPrice);


        }

    });


});



$(document).ready( function () {



    if ($('#isAdmin').val() == 1)
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"Username\">Username</option><option value=\"Email\">Email</option><option value=\"ContactNumber\">ContactNumber</option>");

        //$('.table-control-buttons').show(); // show the Addrow and delete function

        showUserTable();
    }

    if($('#isAdmin').val() == 3)
    {
        $('.NoShowItem').hide();
    }

    categoryChanged();

    $('#edit_NoStore_antVal').hide();




});

$('#refresh').click(function(){
   location.reload();
});

function categoryChanged() {


    var cat = $("#main-cat option:selected").val();


    if(cat =="Admin")
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"Username\">Username</option><option value=\"Email\">Email</option><option value=\"ContactNumber\">ContactNumber</option>");
        showUserTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();
        $('.NoShowItem').hide();
        $('.table-control-buttons').show();
    }

    if(cat =="All Device")
    {

        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"ItemID\">ItemID</option><option value=\"ItemName\">ItemName</option><option value=\"Color\">Color</option><option value=\"Capacity\">Capacity</option><option value=\"Price\">Price</option>");
        showItemTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();

        var admin = $('#isAdmin').val();

        if(admin == 1) {
            $('.table-control-buttons').show();
        }
        else {
            $('.table-control-buttons').hide();
        }
    }

    if(cat =="iphone")
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"ItemID\">ItemID</option><option value=\"ItemName\">ItemName</option><option value=\"Color\">Color</option><option value=\"Capacity\">Capacity</option><option value=\"Price\">Price</option>");
          showiphoneTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();
        $('.table-control-buttons').hide();
    }

    if(cat=="Samsung")
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"ItemID\">ItemID</option><option value=\"ItemName\">ItemName</option><option value=\"Color\">Color</option><option value=\"Capacity\">Capacity</option><option value=\"Price\">Price</option>");
        showSamsungTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();
        $('.table-control-buttons').hide();
    }

    if(cat=="Huawei")
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"ItemID\">ItemID</option><option value=\"ItemName\">ItemName</option><option value=\"Color\">Color</option><option value=\"Capacity\">Capacity</option><option value=\"Price\">Price</option>");
        showHuaweiTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();
        $('.table-control-buttons').hide();
    }
    if(cat=="Xiaomi")
    {
        $('#Main-mbb-columns').html("<option value=\"Select Column\" disabled selected=\"selected\">Select Column</option><option value=\"ItemID\">ItemID</option><option value=\"ItemName\">ItemName</option><option value=\"Color\">Color</option><option value=\"Capacity\">Capacity</option><option value=\"Price\">Price</option>");
        showXiaomiTable();
        $('#edit_Qty_err').hide();
        $('#edit_Qty_antVal').hide();
        $('.table-control-buttons').hide();
    }



};








</script>