<?php
// include database and functions files
include_once 'config/database.php';
include_once 'user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare User object
$User = new User($db);
$User->Username = isset($_POST['Username']) ? $_POST['Username'] : $User->errorOccured();
$User->Password = isset($_POST['Password']) ? $_POST['Password'] : $User->errorOccured();
$User->BusinessName = isset($_POST['BusinessName']) ? $_POST['BusinessName'] : NULL;
$User->FamilyName = isset($_POST['FamilyName']) ? $_POST['FamilyName'] : $User->errorOccured();
$User->GivenName = isset($_POST['GivenName']) ? $_POST['GivenName'] : $User->errorOccured();
$User->Title = isset($_POST['Title']) ? $_POST['Title'] : $User->errorOccured();
$User->Email = isset($_POST['Email']) ? $_POST['Email'] : $User->errorOccured();
$User->ContactNumber = isset($_POST['ContactNumber']) ? $_POST['ContactNumber'] : $User->errorOccured();
$User->Country = isset($_POST['Country']) ? $_POST['Country'] : $User->errorOccured();
$User->StateProvinceRegion = isset($_POST['StateProvinceRegion']) ? $_POST['StateProvinceRegion'] : $User->errorOccured();
$User->CountyDistrict = isset($_POST['CountyDistrict']) ? $_POST['CountyDistrict'] : NULL;
$User->CityTown = isset($_POST['CityTown']) ? $_POST['CityTown'] : $User->errorOccured();
$User->PostalCode = isset($_POST['PostalCode']) ? $_POST['PostalCode'] : $User->errorOccured();
$User->StreetAddress = isset($_POST['StreetAddress']) ? $_POST['StreetAddress'] : $User->errorOccured();
$User->Premises = isset($_POST['Premises']) ? $_POST['Premises'] : NULL;
$User->isAdmin = isset($_POST['isAdmin'])? $_POST['isAdmin']:0;

// read the details of User to be edited
if($User->addUser())
{    // get retrieved row
    $res_msg=array(
			"status" => true,
			"response" => "User registered successfully"
			);
}
else
{
	 $res_msg=array(
					"status" => false,
					"response" => $User->error
				); 
}

// make it json format
echo(json_encode($res_msg));
?>