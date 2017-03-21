<?php

$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";
$client = new SoapClient($test_url);


$params = array("AXA-BEL-001",1);
$response = $client->__soapCall("ExportStockStatus",$params);
$formatted_xml = new SimpleXMLElement($response);
$count = $formatted_xml->STOCK_ITEM->LEVEL;
$count = ($count+1);

$site = "Head Office";

$menu = array("SKU (CODE)","ID","Description","Buy Price","Sell Price","WebSell Price","Bundle Price","Safe Level","Min Level","Level (Stock)","Status");
$menuitem = array("SKU","ID","DESC","BUY_PRICE","SELL_PRICE","WEBSELL_PRICE","BUNDLE_PRICE","SAFE_LEVEL","MIN_LEVEL","LEVEL","STATUS");




/* $myXMLData = '<?xml version="1.0" encoding="utf-8"?><STOCK_ITEM><STOCK_CODE>AXA-BEL-001</STOCK_CODE><LEVEL>3</LEVEL></STOCK_ITEM>';
$myXMLData = '<?xml version="1.0" encoding="utf-8"?><STOCK_ITEM CODE="AXA-BEL-001"><LEVEL>3</LEVEL></STOCK_ITEM>';
$myXMLData = '<?xml version="1.0" encoding="utf-8"?><STOCK_ITEM ID="10" CODE="21015606" DESC="Admiralty Leisure Chart Folio - Ramsgate to Tower Bridge" OTHER_REF="9780707780771"><LEVEL>2</LEVEL>';
$myXMLData .='<BUY_PRICE>29.90</BUY_PRICE><STATUS>1</STATUS></STOCK_ITEM>'; */

$myXMLData = '<?xml version="1.0"?>
<STOCK_STATUS SITE="Head Office">
    <STOCK_ITEM CODE="AXA-BEL-001"><LEVEL>'.$count.'</LEVEL></STOCK_ITEM>
    <STOCK_ITEM CODE="AXA-BEL-002"><LEVEL>5</LEVEL></STOCK_ITEM>
    <STOCK_ITEM CODE="AXA-DOR-002" DESC="Doro PhoneEasy 508 GR (064792)"><LEVEL>4</LEVEL></STOCK_ITEM>
    <STOCK_ITEM CODE="AXA-BEL-010" DESC="Dummy Product"><LEVEL>5</LEVEL><TYPE>AXA Health Care Product</TYPE></STOCK_ITEM>
</STOCK_STATUS>
';

$xml = simplexml_load_string($myXMLData);

$params =array($myXMLData,1,1);

$response = $client->__soapCall("ImportStockStatus",$params);

echo ($response->Count)." Records updated";












