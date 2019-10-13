<?php
class User{
    // database connection and table name
    private $conn;
    private $table_name = "phoneuser";
    // user functions
    public $Username;
	public $Password;
	public $BusinessName; 
	public $FamilyName; 
	public $GivenName; 
	public $Title; 
	public $Email; 
	public $ContactNumber; 
	public $Country; 
	public $StateProvinceRegion; 
	public $CountyDistrict; 
	public $CityTown; 
	public $PostalCode; 
	public $StreetAddress; 
	public $Premises;
	public $isAdmin;
	public $error;
	public $errorOccured = false;
    // constructor
    public function __construct($db){
        $this->conn = $db;	
    }
	
	function addUser(){
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					Username=:Username, Password=:Password,BusinessName=:BusinessName, FamilyName=:FamilyName, GivenName=:GivenName, Title=:Title, Email=:Email, ContactNumber=:ContactNumber, Country=:Country, StateProvinceRegion=:StateProvinceRegion, CountyDistrict=:CountyDistrict, CityTown=:CityTown, PostalCode=:PostalCode, StreetAddress=:StreetAddress, Premises=:Premises, isAdmin=:isAdmin";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize and binding values
		
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);
		
		$this->Password=htmlspecialchars(strip_tags($this->Password));
		$stmt->bindParam(":Password", $this->Password);


		if ($this->BusinessName == NULL){
			$this->BusinessName=htmlspecialchars(strip_tags($this->BusinessName));
			$stmt->bindValue(":BusinessName", null, PDO::PARAM_NULL);
		} else {
			$this->BusinessName=htmlspecialchars(strip_tags($this->BusinessName));
			$stmt->bindParam(":BusinessName", $this->BusinessName);
		}
		
		$this->FamilyName=htmlspecialchars(strip_tags($this->FamilyName));
		$stmt->bindParam(":FamilyName", $this->FamilyName);
		
		$this->GivenName=htmlspecialchars(strip_tags($this->GivenName));
		$stmt->bindParam(":GivenName", $this->GivenName);
		
		$this->Title=htmlspecialchars(strip_tags($this->Title));
		$stmt->bindParam(":Title", $this->Title);
		
		$this->Email=htmlspecialchars(strip_tags($this->Email));
		$stmt->bindParam(":Email", $this->Email);
		
		$this->ContactNumber=htmlspecialchars(strip_tags($this->ContactNumber));
		$stmt->bindParam(":ContactNumber", $this->ContactNumber);
		
		$this->Country=htmlspecialchars(strip_tags($this->Country));
		$stmt->bindParam(":Country", $this->Country);
		
		$this->StateProvinceRegion=htmlspecialchars(strip_tags($this->StateProvinceRegion));
		$stmt->bindParam(":StateProvinceRegion", $this->StateProvinceRegion);
		
		if ($this->CountyDistrict == NULL){
			$this->CountyDistrict=htmlspecialchars(strip_tags($this->CountyDistrict));
			$stmt->bindValue(":CountyDistrict", null, PDO::PARAM_NULL);
		} else {
			$this->CountyDistrict=htmlspecialchars(strip_tags($this->CountyDistrict));
			$stmt->bindParam(":CountyDistrict", $this->CountyDistrict);
		}
		
		$this->CityTown=htmlspecialchars(strip_tags($this->CityTown));
		$stmt->bindParam(":CityTown", $this->CityTown);
		
		$this->PostalCode=htmlspecialchars(strip_tags($this->PostalCode));
		$stmt->bindParam(":PostalCode", $this->PostalCode);
		
		$this->StreetAddress=htmlspecialchars(strip_tags($this->StreetAddress));
		$stmt->bindParam(":StreetAddress", $this->StreetAddress);
		
		if ($this->Premises == NULL){
			$this->Premises=htmlspecialchars(strip_tags($this->Premises));
			$stmt->bindValue(":Premises", null, PDO::PARAM_NULL);
		} else {
			$this->Premises=htmlspecialchars(strip_tags($this->Premises));
			$stmt->bindParam(":Premises", $this->Premises);
		}

		$this->isAdmin=htmlspecialchars(strip_tags($this->isAdmin));
		$stmt->bindParam(":isAdmin", $this->isAdmin);
		
		// execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        $this->error = "Unexpected error occured, try again in few minutes!";
        return false;
	}


	function editUser(){
		// query to insert record
		$query = "Update 	" . $this->table_name . " SET BusinessName=:BusinessName, FamilyName=:FamilyName, GivenName=:GivenName, Title=:Title, Email=:Email, ContactNumber=:ContactNumber, Country=:Country, StateProvinceRegion=:StateProvinceRegion, CountyDistrict=:CountyDistrict, CityTown=:CityTown, PostalCode=:PostalCode, StreetAddress=:StreetAddress, Premises=:Premises,isAdmin=:isAdmin where Username=:Username";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize and binding values
		
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);


		if ($this->BusinessName == NULL){
			$stmt->bindValue(":BusinessName", null, PDO::PARAM_NULL);
		} else {
			$this->BusinessName=htmlspecialchars(strip_tags($this->BusinessName));
			$stmt->bindParam(":BusinessName", $this->BusinessName);
		}
		
		$this->FamilyName=htmlspecialchars(strip_tags($this->FamilyName));
		$stmt->bindParam(":FamilyName", $this->FamilyName);
		
		$this->GivenName=htmlspecialchars(strip_tags($this->GivenName));
		$stmt->bindParam(":GivenName", $this->GivenName);
		
		$this->Title=htmlspecialchars(strip_tags($this->Title));
		$stmt->bindParam(":Title", $this->Title);
		
		$this->Email=htmlspecialchars(strip_tags($this->Email));
		$stmt->bindParam(":Email", $this->Email);
		
		$this->ContactNumber=htmlspecialchars(strip_tags($this->ContactNumber));
		$stmt->bindParam(":ContactNumber", $this->ContactNumber);
		
		$this->Country=htmlspecialchars(strip_tags($this->Country));
		$stmt->bindParam(":Country", $this->Country);
		
		$this->StateProvinceRegion=htmlspecialchars(strip_tags($this->StateProvinceRegion));
		$stmt->bindParam(":StateProvinceRegion", $this->StateProvinceRegion);
		
		if ($this->CountyDistrict == NULL){
			$stmt->bindValue(":CountyDistrict", null, PDO::PARAM_NULL);
		} else {
			$this->CountyDistrict=htmlspecialchars(strip_tags($this->CountyDistrict));
			$stmt->bindParam(":CountyDistrict", $this->CountyDistrict);
		}
		
		$this->CityTown=htmlspecialchars(strip_tags($this->CityTown));
		$stmt->bindParam(":CityTown", $this->CityTown);
		
		$this->PostalCode=htmlspecialchars(strip_tags($this->PostalCode));
		$stmt->bindParam(":PostalCode", $this->PostalCode);
		
		$this->StreetAddress=htmlspecialchars(strip_tags($this->StreetAddress));
		$stmt->bindParam(":StreetAddress", $this->StreetAddress);
		
		if ($this->Premises == NULL){
			$stmt->bindValue(":Premises", null, PDO::PARAM_NULL);
		} else {
			$this->Premises=htmlspecialchars(strip_tags($this->Premises));
			$stmt->bindParam(":Premises", $this->Premises);
		}

		$this->isAdmin=htmlspecialchars(strip_tags($this->isAdmin));
		$stmt->bindParam(":isAdmin", $this->isAdmin);

        if($stmt->execute()){

            return true;
        }
        $this->error = "Unexpected error occured, try again in few minutes!";
        return false;


    }

	function login(){

        // query to insert record
        $query = "select  * from 
					" . $this->table_name . "
				where
				Username=:Username and Password=:Password";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize and binding values

        $this->Username=htmlspecialchars(strip_tags($this->Username));
        $stmt->bindParam(":Username", $this->Username);

        $this->Password=htmlspecialchars(strip_tags($this->Password));
        $stmt->bindParam(":Password", $this->Password);

        // execute query
        $stmt->execute();
        return $stmt;
	}
	function loginCheck(){

		// query to insert record
		$query = "select  * from 
					" . $this->table_name . "
				where
				Username=:Username and Password=:Password";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize and binding values
		
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);

		$this->Password=htmlspecialchars(strip_tags($this->Password));
		$stmt->bindParam(":Password", $this->Password);
		
		// execute query
		$stmt->execute();
		
		return $stmt;
	}
    // fetching User
    function fetchAllUser(){
		// select all query
		$isAdmin=$this->isAdmin;

		$query = "SELECT Username,BusinessName, GivenName, FamilyName, Title, Email, ContactNumber, Country, StateProvinceRegion, CountyDistrict, CityTown, PostalCode, StreetAddress, Premises,IF (isAdmin = 1, 'Admin', 'User') AS isAdmin FROM  " . $this->table_name." where 1";
			//if($isAdmin==0)
			//{
            //  $query.=" and  Username=:Username";
			//}
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	 // fetching User
    function fetchUser(){
		// select all query
		$query = "SELECT Username,BusinessName, GivenName ,FamilyName, Title, Email, ContactNumber, Country, StateProvinceRegion, CountyDistrict, CityTown, PostalCode, StreetAddress, Premises,isAdmin FROM  " . $this->table_name." Where Username=:Username";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	function deleteAllUser(){
		// select all query
		$query = "DELETE FROM  " . $this->table_name;
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
	}

	function deleteUser(){
		$query1 = "SELECT nucleus_hive.NucBoxNo FROM nucleus_hive INNER JOIN purchased_colony ON nucleus_hive.NucBoxNo = purchased_colony.NucBoxNo INNER JOIN colony ON purchased_colony.ColonyNo = colony.ColonyNo INNER JOIN hive ON colony.HiveID = hive.HiveID INNER JOIN apiary ON hive.ApiaryNumber = apiary.ApiaryNumber INNER JOIN apiarist ON apiary.ApiaristUsername = apiarist.Username where Username=:Username";
		// prepare query statement
		$stmt1 = $this->conn->prepare($query1);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt1->bindParam(":Username", $this->Username);
		// execute query
		$stmt1->execute();
		$nbnDelete = $stmt1->fetchAll(PDO::FETCH_COLUMN);
		
		for ($i = 0; $i < sizeof($nbnDelete); $i++){
			$query1a = "DELETE FROM nucleus_hive WHERE NucBoxNo=:NucBoxNo";
			
			$stmt1a = $this->conn->prepare($query1a);
			$stmt1a->bindParam(":NucBoxNo", $nbnDelete[$i]);
			// execute query
			$stmt1a->execute();
		}	
		
		$query2 =
		"SELECT honey_honeycomb_harvest.HarvestID FROM honey_honeycomb_harvest INNER JOIN hive_harvest ON honey_honeycomb_harvest.HarvestID = hive_harvest.HarvestID INNER JOIN hive ON hive_harvest.HiveID = hive.HiveID INNER JOIN apiary ON hive.ApiaryNumber = apiary.ApiaryNumber INNER JOIN apiarist ON apiary.ApiaristUsername = apiarist.Username WHERE Username ='" . $this->Username . "' UNION SELECT bee_package_queen_harvest.HarvestID FROM bee_package_queen_harvest INNER JOIN queen_bee ON bee_package_queen_harvest.QueenBeeID = queen_bee.QueenBeeID INNER JOIN apiarist ON queen_bee.ApiaristUsername = apiarist.Username WHERE Username ='" . $this->Username . "' UNION SELECT nuc_harvest.HarvestID FROM nuc_harvest INNER JOIN nucleus_hive ON nuc_harvest.NucBoxNo = nucleus_hive.NucBoxNo INNER JOIN colony ON nucleus_hive.ColonyNo = colony.ColonyNo INNER JOIN hive ON colony.HiveID = hive.HiveID INNER JOIN apiary ON hive.ApiaryNumber = apiary.ApiaryNumber INNER JOIN apiarist ON apiary.ApiaristUsername = apiarist.Username WHERE Username ='" . $this->Username . "'";

		// prepare query statement
		$stmt2 = $this->conn->prepare($query2);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt2->bindParam(":Username", $this->Username);
		// execute query
		$stmt2->execute();
		$hidDelete = $stmt2->fetchAll(PDO::FETCH_COLUMN);
		
		
		for ($i = 0; $i < sizeof($hidDelete); $i++){
			$query2a = "DELETE FROM harvest WHERE HarvestID=:HarvestID";
			
			$stmt2a = $this->conn->prepare($query2a);
			$stmt2a->bindParam(":HarvestID", $hidDelete[$i]);
			// execute query
			$stmt2a->execute();
		}
	
		$query3 =
		"DELETE FROM queen_bee WHERE ApiaristUsername=:Username";
		
		$query4 =
		"DELETE FROM phoneuser WHERE Username=:Username";
		
		// prepare query statement
		$stmt3 = $this->conn->prepare($query3);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt3->bindParam(":Username", $this->Username);
		// execute query
		$stmt3->execute();
		
		// prepare query statement
		$stmt4 = $this->conn->prepare($query4);
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt4->bindParam(":Username", $this->Username);
		// execute query
		$stmt4->execute();
		
		$queryHist = "DELETE FROM history WHERE TableName='Apiarist' AND TableID=:TableID";
		// prepare query statement
		$stmtHist = $this->conn->prepare($queryHist);
		$stmtHist->bindParam(":TableID", $this->Username);
		// execute query
		$stmtHist->execute();
		
		return $stmt4;
	}
	
    //already exist check
    
	function isAlreadyExist(){
		$query = "SELECT * 
			FROM 
				" . $this->table_name . " 
			WHERE 
				Email='".$this->Email."'";
		
		// prepare query statement
		$stmt = $this->conn->prepare($query);

		$this->Email=htmlspecialchars(strip_tags($this->Email));
		$stmt->bindParam(":Email", $this->Email);
		
		// execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
		   return false;
		}
	}

	function isEmailAlreadyExist(){
		$query = "SELECT * 
			FROM 
				" . $this->table_name . " 
			WHERE 
				Email=:Email";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
				$this->Email=htmlspecialchars(strip_tags($this->Email));
		$stmt->bindParam(":Email", $this->Email);
		
		// execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
		   return false;
		}
	}
	function isUsernameAlreadyExist(){
		$query = "SELECT * 
			FROM 
				" . $this->table_name . " 
			WHERE 
				Username=:Username";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
				$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);
		
		
		
		// execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
		   return false;
		}
	}

function isEmailAlreadyExistEdit(){
		$queryGet = "SELECT Email FROM phoneuser WHERE Username=:Username";
			// prepare query statement
		$stmtGet = $this->conn->prepare($queryGet);
				$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmtGet->bindParam(":Username", $this->Username);	
		$stmtGet->execute();
		
		$oldEmail = $stmtGet->fetch(PDO::FETCH_ASSOC)['Email'];
		
		$query = "SELECT * 
			FROM 
				" . $this->table_name . " 
			WHERE 
				Email=:Email AND NOT Email=:OldEmail";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
				$this->Email=htmlspecialchars(strip_tags($this->Email));
		$stmt->bindParam(":Email", $this->Email);
		$stmt->bindParam(":OldEmail", $oldEmail);
		
		// execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
		   return false;
		}
	}

	function resetPassword(){
		// query to insert record
		$query = "Update 	" . $this->table_name . " SET Password=:Password where Username=:Username";
		// prepare query
		$stmt = $this->conn->prepare($query);
		// sanitize and binding values
		
		$this->Username=htmlspecialchars(strip_tags($this->Username));
		$stmt->bindParam(":Username", $this->Username);

		$this->Password=htmlspecialchars(strip_tags($this->Password));
		$stmt->bindParam(":Password", $this->Password);
		
		// execute query
		if($stmt->execute()){
			return true;
		}
		$this->error = "Unexpected error occured, try again in few minutes!";
		return false;     
	}
	
	function validatePass(){
		$query = "SELECT * 
			FROM 
				phoneuser
			WHERE 
				Username=:Username
			AND 
				Password=:Password";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
				$this->Username=htmlspecialchars(strip_tags($this->Username));
				$this->Password=htmlspecialchars(strip_tags($this->Password));
		$stmt->bindParam(":Username", $this->Username);
		$stmt->bindParam(":Password", $this->Password);

		// execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
		   return false;
		}
	}
	
	function errorOccured(){
		$this->error = "invalid Parameters";
		$this->errorOccured = true;
		return false;
	}
}