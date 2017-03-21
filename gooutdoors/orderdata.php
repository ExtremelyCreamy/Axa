<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";

$myXMLData = '<SALES_ORDERS>
<SALES_ORDER>
        <CUSTOMER_DETAIL>
            <IS_NEW_CUSTOMER/>
            <COMPANY_CODE>KSD001</COMPANY_CODE>
            <OTHER_REF/>
            <WEB_USER/>
            <COMPANY_CLASS></COMPANY_CLASS>
            <COMPANY_TYPE></COMPANY_TYPE>
            <COMPANY_NAME>Keystone Software Development Ltd</COMPANY_NAME>
            <WEB_SITE/>
            <SOURCE_CODE></SOURCE_CODE>
            <MAILING_STATUS/>
            <OPTIN_NEWSLETTER>-1</OPTIN_NEWSLETTER>
            <TAX_REFERENCE/>
 
            <GIFT_AID/>
            <VAT_RELIEF_QUALIFIED/>
            <ADDRESSES>
                <INVADDR>
                    <IADDRESS_ID OTHER_REF="ABC">ABC</IADDRESS_ID>
                    <IADDRESS1>Century House</IADDRESS1>
                    <IADDRESS2>84 Commercial Road</IADDRESS2>
                    <IADDRESS3/>
                    <ITOWN>Grantham</ITOWN>
                    <ICOUNTY>Lincolnshire</ICOUNTY>
                    <IPOSTCODE>NG31 6DB</IPOSTCODE>
                    <ICOUNTRY_CODE/>
                    <ICOUNTRY_NAME/>
                    <ICONTACT_ID OTHER_REF="ABC">ABC</ICONTACT_ID>
                    <ITITLE>Mr</ITITLE>
                    <IFORENAME>Mike</IFORENAME>
                    <ISURNAME>Cockfield</ISURNAME>
                    <ITEL>01476 562447</ITEL>
                    <IFAX/>
                    <IMOBILE/>
                    <IEMAIL></IEMAIL>
                    <IEMAIL_SUBSCRIBER/>
                    <IDOB/>
                    <IORGANISATION/>
                    <IPREFERRED_COMMUNICATION_METHOD/>
                </INVADDR>
                <DELADDR>
                    <DADDRESS_ID OTHER_REF="ABC">ABC</DADDRESS_ID>
                    <DADDRESS1>Century House</DADDRESS1>
                    <DADDRESS2>84 Commercial Road</DADDRESS2>
                    <DADDRESS3/>
                    <DTOWN>Grantham</DTOWN>
                    <DCOUNTY>Lincolnshire</DCOUNTY>
                    <DPOSTCODE>NG31 6DB</DPOSTCODE>
                    <DCOUNTRY_CODE/>
                    <DCOUNTRY_NAME/>
                    <DCONTACT_ID OTHER_REF="ABC">ABC</DCONTACT_ID>
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
            <INTERNAL_REF TYPE_ID="ABC" TYPE_DESC="ABC" VTYPE_ID="ABC">ABC</INTERNAL_REF>
            <ORDER_DATE>2017-02-20</ORDER_DATE>
            <DELIVERY_DATE>2017-02-21</DELIVERY_DATE>
            <ORDER_AMOUNT>56.99</ORDER_AMOUNT>
            <ORDER_CURRENCY_CODE>GBP</ORDER_CURRENCY_CODE>
            <SITE>Head Office</SITE>
            <ASSOCIATED_REF>DK07151556O</ASSOCIATED_REF>
            <AGENT>Test Agent</AGENT>
            <ORDER_NOTE/>
            <INVOICE_NOTE/>
            <DELIVERY_NET/>
            <DELIVERY_TAX/>
            <DELIVERY_GRS/>
            <COURIER_CODE/>
            <COURIER_DESC/>
            <PO_NUMBER>XXYZ</PO_NUMBER>
            <KEYCODE_CODE/>
            <BRAND></BRAND>
            <SALES_SOURCE>D4IT</SALES_SOURCE>
            <COURIER_NOTE></COURIER_NOTE>
            <INV_PRIORITY/>
            <GIFT_AID/>
            <MANUAL_RECEIVED>0</MANUAL_RECEIVED>
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
				<STOCK_CODE>21015607</STOCK_CODE>
				<MAPPING_TYPE>1</MAPPING_TYPE>
				<STOCK_DESC></STOCK_DESC>
				<ORDER_QTY>1</ORDER_QTY>
				<SITE>Head Office</SITE>
				<ASSOCIATED_REF>100010311</ASSOCIATED_REF>
			</ORDER_ITEM>
        </ORDER_ITEMS>
    </SALES_ORDER>
</SALES_ORDERS>';

/* $myXMLData = '<SALES_ORDERS>
	<SALES_ORDER>
		<CUSTOMER_DETAIL>
			<IS_NEW_CUSTOMER>1</IS_NEW_CUSTOMER>
			<COMPANY_CODE/>
			<OTHER_REF/>
			<OTHER_REF_TYPE/>
			<WEB_USER/>
			<COMPANY_CLASS/>
			<COMPANY_TYPE/>
			<COMPANY_NAME>Test Company</COMPANY_NAME>
            <WEB_SITE/>
            <SOURCE_CODE/>
            <MAILING_STATUS/>
            <TAX_REFERENCE/>
            <UDA/>
			<ADDRESSES>
				<INVADDR>               
					<IADDRESS1>1 Cowbridge Road East</IADDRESS1>
					<ITOWN>Caerdydd Caerdydd GB</ITOWN>
					<IPOSTCODE>AA1 1AA</IPOSTCODE>
					<ITITLE>Mr</ITITLE>
					<IFORENAME>Nathan</IFORENAME>
					<ISURNAME>Annand</ISURNAME>
				</INVADDR>
				<DELADDR>             
					<DADDRESS1>1 Cowbridge Road East</DADDRESS1>
					<DTOWN>Caerdydd Caerdydd GB</DTOWN>
					<DPOSTCODE>AA1 1BB</DPOSTCODE>
					<DTITLE>Mr</DTITLE>
					<DFORENAME>Nathan</DFORENAME>
					<DSURNAME>Annand</DSURNAME>
				</DELADDR>
			</ADDRESSES>
		</CUSTOMER_DETAIL>
		<ORDER_HEADER>
			<ORDER_DATE>2017-02-20</ORDER_DATE>
			<DELIVERY_DATE>2017-02-21</DELIVERY_DATE>
			<PO_NUMBER>100010311</PO_NUMBER>
		</ORDER_HEADER>
		<ORDER_ITEMS>
			<ORDER_ITEM>
				<STOCK_CODE>AXA-QAR-005</STOCK_CODE>
				<MAPPING_TYPE>1</MAPPING_TYPE>
				<STOCK_DESC>QardioBase Wireless Smart Scale</STOCK_DESC>
				<ORDER_QTY>1</ORDER_QTY>
				<SITE>Head Office</SITE>
				<ASSOCIATED_REF>100010311</ASSOCIATED_REF>
			</ORDER_ITEM>
		</ORDER_ITEMS>
	</SALES_ORDER>
</SALES_ORDERS>'; */

$client = new SoapClient($test_url);
$params = array($myXMLData);
$response = $client->__soapCall("ImportOrders",$params);
echo "<pre>";
print_r($response);
echo "</pre>";