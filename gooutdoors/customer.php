<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";
$client = new SoapClient($test_url);

$enquiry = $_GET['e'];

$params = array($enquiry,1);
$response = $client->__soapCall("ExportCompany",$params);
$formatted_xml = new SimpleXMLElement($response);
echo "<pre>";
foreach($formatted_xml as $output)
{

    $cid = $output->COMPANY_ID;
    $cname = $output->COMPANY_NAME;
    $code = $output->COMPANY_CODE;
    $aid = ($output->ADDRESSES->ADDRESS->ADDRESS_ID);
    $add1 = ($output->ADDRESSES->ADDRESS->ADDR1);
    $add2 = ($output->ADDRESSES->ADDRESS->ADDR2);
    $add3 = ($output->ADDRESSES->ADDRESS->ADDR3);
    $town = ($output->ADDRESSES->ADDRESS->TOWN);
    $county = ($output->ADDRESSES->ADDRESS->COUNTY);
    $postcode = $output->ADDRESSES->ADDRESS->POSTCODE;
    /* echo "<strong>".$code."</strong> ".$add1;
    if($add2!=""){echo ", ".$add2;}
    if($add3!=""){echo ", ".$add3;}
    if($town!=""){echo ", ".$town;}
    if($county!=""){echo ", ".$county;}
    if($postcode!=""){echo ", ".$postcode;}
    echo "<br />"; */

}






$myXMLData = '<SALES_ORDERS>
<SALES_ORDER>
        <CUSTOMER_DETAIL>
            <IS_NEW_CUSTOMER/>
            <COMPANY_CODE>'.$code.'</COMPANY_CODE>
            <OTHER_REF/>
            <WEB_USER/>
            <COMPANY_CLASS></COMPANY_CLASS>
            <COMPANY_TYPE></COMPANY_TYPE>
            <COMPANY_NAME>'.$cname.'</COMPANY_NAME>
            <WEB_SITE/>
            <SOURCE_CODE></SOURCE_CODE>
            <MAILING_STATUS/>
            <OPTIN_NEWSLETTER>-1</OPTIN_NEWSLETTER>
            <TAX_REFERENCE/>
 
            <GIFT_AID/>
            <VAT_RELIEF_QUALIFIED/>
            <ADDRESSES>
                <INVADDR>
                    <IADDRESS_ID OTHER_REF="'.$aid.'">'.$aid.'</IADDRESS_ID>
                    <IADDRESS1>'.$add1.'</IADDRESS1>
                    <IADDRESS2>'.$add2.'</IADDRESS2>
                    <IADDRESS3>'.$add3.'</IADDRESS3>
                    <ITOWN>'.$town.'</ITOWN>
                    <ICOUNTY>'.$county.'</ICOUNTY>
                    <IPOSTCODE>'.$postcode.'</IPOSTCODE>
                    <ICOUNTRY_CODE/>
                    <ICOUNTRY_NAME/>
                    <ICONTACT_ID></ICONTACT_ID>
                    <ITITLE></ITITLE>
                    <IFORENAME></IFORENAME>
                    <ISURNAME></ISURNAME>
                    <ITEL></ITEL>
                    <IFAX/>
                    <IMOBILE/>
                    <IEMAIL></IEMAIL>
                    <IEMAIL_SUBSCRIBER/>
                    <IDOB/>
                    <IORGANISATION/>
                    <IPREFERRED_COMMUNICATION_METHOD/>
                </INVADDR>
                <DELADDR>
                    <DADDRESS_ID OTHER_REF="'.$aid.'">'.$aid.'</DADDRESS_ID>
                    <DADDRESS1>'.$add1.'</DADDRESS1>
                    <DADDRESS2>'.$add2.'</DADDRESS2>
                    <DADDRESS3>'.$add3.'</DADDRESS3>
                    <DTOWN>'.$town.'</DTOWN>
                    <DCOUNTY>'.$county.'</DCOUNTY>
                    <DPOSTCODE>'.$postcode.'</DPOSTCODE>
                    <DCOUNTRY_CODE/>
                    <DCOUNTRY_NAME/>
                    <DCONTACT_ID></DCONTACT_ID>
                    <DTITLE/>
                    <DFORENAME/>
                    <DSURNAME/>
                    <DTEL/>
                    <DFAX/>
                    <DMOBILE/>
                    <DEMAIL/>
                    <DEMAIL_SUBSCRIBER/>
                    <DDOB/>
                    <DORGANISATION/>
                    <DPREFERRED_COMMUNICATION_METHOD/>
                </DELADDR>
            </ADDRESSES>
            <CUSTOM>
          
            </CUSTOM>
        </CUSTOMER_DETAIL>
        
        <ORDER_HEADER>
            <INTERNAL_REF></INTERNAL_REF>
            <ORDER_DATE>2017-02-21</ORDER_DATE>
            <DELIVERY_DATE>2017-02-22</DELIVERY_DATE>
            <ORDER_AMOUNT>0.00</ORDER_AMOUNT>
            <ORDER_CURRENCY_CODE>GBP</ORDER_CURRENCY_CODE>
            <SITE>Head Office</SITE>
            <ASSOCIATED_REF>12345XX</ASSOCIATED_REF>
            <AGENT>Test Agent</AGENT>
            <ORDER_NOTE/>
            <INVOICE_NOTE/>
            <DELIVERY_NET/>
            <DELIVERY_TAX/>
            <DELIVERY_GRS/>
            <COURIER_CODE/>
            <COURIER_DESC/>
            <PO_NUMBER>12345XX</PO_NUMBER>
            <KEYCODE_CODE/>
            <BRAND></BRAND>
            <SALES_SOURCE>D4IT</SALES_SOURCE>
            <COURIER_NOTE></COURIER_NOTE>
            <INV_PRIORITY/>
            <GIFT_AID/>
            <MANUAL_RECEIVED></MANUAL_RECEIVED>
            <REQUIRED_BY_DATE/>
            <CLIENT_NAME/>
            <CUSTOM>

            </CUSTOM>
            <COMM_LOGS>
            </COMM_LOGS>
            <WEBSITE_NAME></WEBSITE_NAME>
            <CHANNEL_ID></CHANNEL_ID>
            <SHIP_DATE/>
            <CONSIGNMENT_REF/>
        </ORDER_HEADER>
        
        <ORDER_ITEMS>    
            <ORDER_ITEM>
				<STOCK_CODE>OSO1</STOCK_CODE>
				<MAPPING_TYPE>1</MAPPING_TYPE>
				<STOCK_DESC></STOCK_DESC>
				<ORDER_QTY>1</ORDER_QTY>
				<SITE>Head Office</SITE>
				<ASSOCIATED_REF>12345XX</ASSOCIATED_REF>
			</ORDER_ITEM>
			<ORDER_ITEM>
				<STOCK_CODE>OSO2</STOCK_CODE>
				<MAPPING_TYPE>1</MAPPING_TYPE>
				<STOCK_DESC></STOCK_DESC>
				<ORDER_QTY>10</ORDER_QTY>
				<SITE>Head Office</SITE>
				<ASSOCIATED_REF>12345XX</ASSOCIATED_REF>
			</ORDER_ITEM>
        </ORDER_ITEMS>
    </SALES_ORDER>
</SALES_ORDERS>';


$client = new SoapClient($test_url);
$params = array($myXMLData);
$response = $client->__soapCall("ImportOrders",$params);
echo "<pre>";
print_r($response);
echo "</pre>";


/*


$enquiry = "OSO1";
$params = array($enquiry,1);
$response = $client->__soapCall("ExportStock",$params);
$formatted_xml = new SimpleXMLElement($response);
foreach($formatted_xml as $output)
{
    print_r($output);
}



/*
$myXMLData =
    '<?xml version="1.0" encoding="utf-8"?>
        <COMPANYS>
        <COMPANY>
		<COMPANY_CODE/>
		<COMPANY_NAME>Tim Lawton</COMPANY_NAME>
		<OTHER_REF/>
		<WEB_SITE/>
		<COMPANY_CLASS/>
		<COMPANY_TYPE/>
		<COMPANY_STATUS>Active</COMPANY_STATUS>
		<COMPANY_SOURCE/>
		<SOURCE_CODE></SOURCE_CODE>
		<DATE_CREATED/>
		<COMPANY_ID/>
		<PROFORMA/>
		<SORDER_LOCKED/>
		<SUPPLIER>0</SUPPLIER>
		<EC_COMPANY>0</EC_COMPANY>
		<PAYS_VAT>0</PAYS_VAT>
		<POCODE_REQUIRED>0</POCODE_REQUIRED>
		<EARN_AND_REDEEM_REWARD_POINTS>0</EARN_AND_REDEEM_REWARD_POINTS>
		<REWARD_POINT_BALANCE/>
		<REWARD_POINTS_UPDATED/>
		<WEB_USER/>
		<WEB_PASSWORD/>
		<AGENT_NAME/>
		<TAX_REFERENCE/>
		<MAILING_STATUS></MAILING_STATUS>
		<CUSTOMER_DISCOUNT></CUSTOMER_DISCOUNT>
		<SALE_SOURCE></SALE_SOURCE>
		<PAYMENT_TYPE>Account</PAYMENT_TYPE>
		<CURRENCY_CODE>GBP</CURRENCY_CODE>
		<PRICE_LISTS>
		</PRICE_LISTS>
		<ADDRESSES>
			<ADDRESS>
				<ADDR1>4 Navigator Way</ADDR1>
				<ADDR2/>
				<ADDR3/>
				<TOWN>Truro</TOWN>
				<COUNTY>Cornwall</COUNTY>
				<POSTCODE>TR1 3GE</POSTCODE>
				<ADDRTYPE/>
				<EMAIL>mrlawton@gmail.com</EMAIL>
				<TEL/>
				<FAX/>
				<COUNTRY/>
				<COUNTRY_CODE/>
				<ADDRESS_ID/>
				<INACTIVE>0</INACTIVE>
				<CONTACTS>
					<CONTACT>
						<TITLE>Mr</TITLE>
						<FORENAME>Tim</FORENAME>
						<SURNAME>Lawton</SURNAME>
						<JOBTITLE/>
						<TEL/>
						<FAX/>
						<MOBILE/>
						<EMAIL>mrlawton@gmail.com</EMAIL>
						<NOTE/>
						<EMAILSUBSCRIBE>-1</EMAILSUBSCRIBE>
						<DOB/>
						<CONTACT_ID/>
						<INACTIVE>0</INACTIVE>
						<PREFERRED_COMMUNICATION_METHOD/>
					</CONTACT>
				</CONTACTS>
			</ADDRESS>
		</ADDRESSES>
		<COUNTRY/>
		<COUNTRY_CODE/>
	</COMPANY>
	</COMPANYS>';

    $client = new SoapClient($test_url);
    $params = array($myXMLData,0);
    $response = $client->__soapCall("ImportCompany",$params);
    print_r($response);

    echo "x";