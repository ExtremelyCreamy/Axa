<?php

function xml2array($xml)
{
    $arr = array();
    foreach ($xml as $element)
    {
        $tag = $element->getName();
        $e = get_object_vars($element);
        if (!empty($e))
        {
            $arr[$tag] = $element instanceof SimpleXMLElement ? xml2array($element) : $e;
        }
        else
        {
            $arr[$tag] = trim($element);
        }
    }
    return $arr;
}

$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";
$client = new SoapClient($test_url);

$server   = "localhost"; $username = "root"; $password = "root"; $database = "stock";
$connection = mysqli_connect($server,$username,$password,$database) or die("Check your settings.  ERRx : " . mysqli_error($connection));

$sql = "CREATE TABLE `stock`.`temp` ( `urn` INT NOT NULL AUTO_INCREMENT , `stockcode` VARCHAR(12) NOT NULL , `description` TEXT NOT NULL , `price` VARCHAR(7) NOT NULL , PRIMARY KEY (`urn`)) ENGINE = InnoDB;";
mysqli_query($connection, $sql);

$params = array("Dash4It");
$response = $client->__soapCall("ExportPriceList", $params);
$formatted_xml = new SimpleXMLElement($response);

$_a = array(); $_b = array(); $_c = array();

foreach ($formatted_xml as $result)
{
    foreach ($result as $output)
    {
        $final = (xml2array($output));
        $_a[] = ($final['StockCode']);
        $_b[] = ($final['StockDesc']);
        $_c[] = ($final['CalculatedPrice']);


    }
}

/*
$sql = "SELECT * FROM `stock`.`temp`;";
$newresult = mysqli_query($connection,$sql);
while ($_temp = $newresult->fetch_assoc()) {
    echo $_temp['description'];
}
*/
$sql = "";
foreach($_a as $key => $value)
{
    $sql.= "INSERT INTO `stock`.`temp` (`urn`, `stockcode`, `description`, `price`) VALUES (NULL, '" . $value . "', '" . $_b[$key] . "', '" . $_c[$key] . "');";
}
echo $sql;
