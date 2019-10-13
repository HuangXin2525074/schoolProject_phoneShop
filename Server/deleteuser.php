<?php
class deleteUser
{
    private $conn;

    public function __construct($db){
        $this->conn = $db;

    }
    function delete_User($id)
    {
        $query1 = "SELECT Nucleus_Hive.NucBoxNo FROM Nucleus_Hive INNER JOIN Purchased_Colony ON Nucleus_Hive.NucBoxNo = Purchased_Colony.NucBoxNo INNER JOIN Colony ON Purchased_Colony.ColonyNo = Colony.ColonyNo INNER JOIN Hive ON Colony.HiveID = Hive.HiveID INNER JOIN Apiary ON Hive.ApiaryNumber = Apiary.ApiaryNumber INNER JOIN Apiarist ON Apiary.ApiaristUsername = Apiarist.Username where Username=:Username";
        // prepare query statement
        $stmt1 = $this->conn->prepare($query1);

        $stmt1->bindParam(":Username", $id);
        // execute query
        $stmt1->execute();
        $nbnDelete = $stmt1->fetchAll(PDO::FETCH_COLUMN);

        for ($i = 0; $i < sizeof($nbnDelete); $i++) {
            $query1a = "DELETE FROM Nucleus_Hive WHERE NucBoxNo=:NucBoxNo";

            $stmt1a = $this->conn->prepare($query1a);
            $stmt1a->bindParam(":NucBoxNo", $nbnDelete[$i]);
            // execute query
            $stmt1a->execute();
        }

        $query2 =
            "SELECT Honey_Honeycomb_Harvest.HarvestID FROM Honey_Honeycomb_Harvest INNER JOIN Hive_Harvest ON Honey_Honeycomb_Harvest.HarvestID = Hive_Harvest.HarvestID INNER JOIN Hive ON Hive_Harvest.HiveID = Hive.HiveID INNER JOIN Apiary ON Hive.ApiaryNumber = Apiary.ApiaryNumber INNER JOIN Apiarist ON Apiary.ApiaristUsername = Apiarist.Username WHERE Username=:Username UNION SELECT Bee_Package_Queen_Harvest.HarvestID FROM Bee_Package_Queen_Harvest INNER JOIN Queen_Bee ON Bee_Package_Queen_Harvest.QueenBeeID = Queen_Bee.QueenBeeID INNER JOIN Apiarist ON Queen_Bee.ApiaristUsername = Apiarist.Username WHERE Username=:Username UNION SELECT Nuc_Harvest.HarvestID FROM Nuc_Harvest INNER JOIN Nucleus_Hive ON Nuc_Harvest.NucBoxNo = Nucleus_Hive.NucBoxNo INNER JOIN Colony ON Nucleus_Hive.ColonyNo = Colony.ColonyNo INNER JOIN Hive ON Colony.HiveID = Hive.HiveID INNER JOIN Apiary ON Hive.ApiaryNumber = Apiary.ApiaryNumber INNER JOIN Apiarist ON Apiary.ApiaristUsername = Apiarist.Username WHERE Username=:Username";

        // prepare query statement
        $stmt2 = $this->conn->prepare($query2);

        $stmt2->bindParam(":Username", $id);
        // execute query
        $stmt2->execute();
        $hidDelete = $stmt2->fetchAll(PDO::FETCH_COLUMN);


        for ($i = 0; $i < sizeof($hidDelete); $i++) {
            $query2a = "DELETE FROM Harvest WHERE HarvestID=:HarvestID";

            $stmt2a = $this->conn->prepare($query2a);
            $stmt2a->bindParam(":HarvestID", $hidDelete[$i]);
            // execute query
            $stmt2a->execute();
        }

        $query3 =
            "DELETE FROM Queen_Bee WHERE ApiaristUsername=:Username";

        $query4 =
            "DELETE FROM phoneuser WHERE Username=:Username";

        // prepare query statement
        $stmt3 = $this->conn->prepare($query3);

        $stmt3->bindParam(":Username", $id);
        // execute query
        $stmt3->execute();

        // prepare query statement
        $stmt4 = $this->conn->prepare($query4);

        $stmt4->bindParam(":Username", $id);

        // execute query
        $stmt4->execute();

        return $stmt4;
    }

}

?>