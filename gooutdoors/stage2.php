<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("soap.wsdl_cache_enabled", 0);

/* $test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb"; */
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";

echo $live_url;
echo "<br />";
echo "<br />";

$client = new SoapClient($live_url);

$xml = ""; $_n=0; $store="";

echo "Here's some DEBUG to help you work out what is going on";
echo "<br />";

if(isset($_POST['process-submit']))
{
    $csv = array('application/vnd.ms-excel','text/plain','text/csv');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csv))
    {
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $csvfile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvfile);
            while(($line = fgetcsv($csvfile)) !== FALSE)
            {
                if($store==""){$store = $line[0];}
                if(!$line[0] || $line[0]==""){$line[0]="x";}
                if($line[0]!=$store)
                {
                    $params = array($store,1);
                    $response = $client->__soapCall("ExportCompany",$params);
                    $formatted_xml = new SimpleXMLElement($response);
                    foreach($formatted_xml as $output)
                    {
                        include ("xml_build.php");
                    }
                }

                $xml .= "   <ORDER_ITEM>
                                <STOCK_CODE>".$line[2]."</STOCK_CODE>
                                <MAPPING_TYPE>1</MAPPING_TYPE>
                                <STOCK_DESC></STOCK_DESC>
                                <ORDER_QTY>".$line[3]."</ORDER_QTY>
                                <SITE>Head Office</SITE>
                                <ASSOCIATED_REF>".$line[1]."</ASSOCIATED_REF>
                                <PRICE_NET>0.01</PRICE_NET>
				                <PRICE_GRS>0.01</PRICE_GRS>
                            </ORDER_ITEM>";
                $store = $line[0];
                $reference = $line[1];
                $_n++;
            }
            fclose($csvfile);

            $params = array($store,1);
            $response = $client->__soapCall("ExportCompany",$params);
            $formatted_xml = new SimpleXMLElement($response);
            foreach($formatted_xml as $output)
            {
                include ("xml_build.php");
            }

            $report = '1';
        }
        else
        {
            $report = '0';
        }
    }
    else
    {
        $report = '2';
    }
}

echo "<br />";
if($report=='1'){echo "I think things went OK!";}
if($report!='1'){echo "ERROR :-(";}

$formatted_xml = new SimpleXMLElement($final_XML);
/*
echo "<pre>";
print_r($formatted_xml);
echo "</pre>";
*/





