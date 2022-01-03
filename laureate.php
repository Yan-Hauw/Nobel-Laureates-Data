<?php
// get the id parameter from the request
$id = intval($_GET['id']);

// set the Content-Type header to JSON, 
// so that the client knows that we are returning JSON data
header('Content-Type: application/json');


$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

/*
Send the following fake JSON as the result
{  "id": $id,
    "givenName": { "en": "A. Michael" },
    "familyName": { "en": "Spencer" },
    "affiliations": [ "UCLA", "White House" ]
}
*/
$query1 = "SELECT givenName, familyName, gender, orgName FROM Laureates where id = $id";
$query2 = "SELECT birthdate, birthcity, birthcountry from Birth where id = $id";
$query3 = "SELECT foundingdate, foundingcity, foundingcountry from Founded where id = $id";
$query4 = "SELECT * from NobelPrizes where id = $id";

$rs1 = $db->query($query1);
$rs2 = $db->query($query2);
$rs3 = $db->query($query3);
$rs4 = $db->query($query4);


$row1 = $rs1->fetch_assoc();
$givenName = $row1['givenName'];
$familyName = $row1['familyName'];
$gender = $row1['gender'];
$orgName = $row1['orgName'];

$row2 = $rs2->fetch_assoc();
$birthdate = $row2['birthdate'];
$birthcity = $row2['birthcity'];
$birthcountry = $row2['birthcountry'];

$row3 = $rs3->fetch_assoc();
$foundingdate = $row3['foundingdate'];
$foundingcity = $row3['foundingcity'];
$foundingcountry = $row3['foundingcountry'];




$output["id"] = strval($id);

if(!is_null($givenName))
{
    $output["givenName"] = (object)["en" => $givenName];
}
if(!is_null($familyName))
{
    $output["familyName"] = (object)["en" => $familyName];
}
if(!is_null($gender))
{
    $output["gender"] = $gender;
}
if( !is_null($birthdate) || !is_null($birthcity) ||!is_null($birthcountry)) //query2
{
    $birth = array();
    if(!is_null($birthdate))
    {
        $birth["date"] = $birthdate;
    }
    if(!is_null($birthcity) ||!is_null($birthcountry))
    {
        $place = array();
        if(!is_null($birthcity))
        {
            $place["city"] = (object)["en" => $birthcity];
        }
        if(!is_null($birthcountry))
        {
            $place["country"] = (object)["en" => $birthcountry];
        }
        $birth["place"] = $place;
    }
    $output["birth"] = $birth;
}
if(!is_null($orgName)) //query 3
{
    $output["orgName"] = (object)["en" => $orgName];
    $founded = array();
    if(!is_null(foundingdate))
    {
        $founded["date"] = $foundingdate;
    }
    if(!is_null($foundingcity) || !is_null($foundingcountry))
    {
        $place = array();
        if(!is_null($foundingcity))
            $place["city"] = (object)["en" => $foundingcity];
        if(!is_null($foundingcountry))
            $place["country"] = (object)["en" => $foundingcountry];
        $founded["place"] = $place;
    }
    $output["founded"] = $founded;
}

$nobelPrizes = array();
while($row4 = $rs4->fetch_assoc())
{
    $pid = $row4['id'];
    $awardYear = $row4['awardYear'];
    $category = $row4['category'];
    $sortOrder = $row4['sortOrder'];
    $nobelPrize = array();
    if(!is_null($pid))
    {
        if(!is_null($awardYear))
        $nobelPrize["awardYear"] = $awardYear;
        if(!is_null($category))
        $nobelPrize["category"] = (object)["en" => $category];
        if(!is_null($sortOrder))
        $nobelPrize["sortOrder"] = $sortOrder;
        //echo gettype($rs5);
        $query5 = "SELECT * from Affiliations where awardYear = $awardYear AND category = '$category' AND sortOrder = $sortOrder";
        $rs5 = $db->query($query5);
        $affs = array();
        while($row5 = $rs5->fetch_assoc())
        {
            $aff = array();
            $affname = $row5['affname'];
            $affcity = $row5['affcity'];
            $affcountry = $row5['affcountry'];
            if(!is_null($affname))
                $aff["name"] = ["en" =>$affname];
            if(!is_null($affcity))
                $aff["city"] = ["en" => $affcity];
            if(!is_null($affcountry))
                $aff["country"] = ["en" => $affcountry];
            if(!empty($aff))    
                $affs[] = $aff;
        }
        if(!empty($affs))
            $nobelPrize["affiliations"] = $affs;
            
    }
        if(!empty($nobelPrize))
            $nobelPrizes[] = $nobelPrize;
}
if(!empty($nobelPrizes))
    $output["nobelPrizes"] = $nobelPrizes;
echo json_encode($output);
?>  
