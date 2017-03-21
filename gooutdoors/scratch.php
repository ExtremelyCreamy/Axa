<?php
$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";
$client = new SoapClient($test_url);
$store = "GO001";
$params = array($store,1);
$response = $client->__soapCall("ExportCompany",$params);
$formatted_xml = new SimpleXMLElement($response);

echo "<pre>";
print_r($formatted_xml);
echo "</pre>";