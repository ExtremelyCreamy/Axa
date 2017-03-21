<?php
$cid = $output->COMPANY_ID;
$cname = $output->COMPANY_NAME;
$code = $output->COMPANY_CODE;
$aid = ($output->ADDRESSES->ADDRESS->ADDRESS_ID);
$add1 = ($output->ADDRESSES->ADDRESS->ADDR1); $add1 = htmlspecialchars($add1);
$add2 = ($output->ADDRESSES->ADDRESS->ADDR2); $add2 = htmlspecialchars($add2);
$add3 = ($output->ADDRESSES->ADDRESS->ADDR3);
$town = ($output->ADDRESSES->ADDRESS->TOWN);
$county = ($output->ADDRESSES->ADDRESS->COUNTY);
$postcode = $output->ADDRESSES->ADDRESS->POSTCODE;
$final_XML="<SALES_ORDERS>";
$myXMLData = '
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
            <OPTIN_NEWSLETTER></OPTIN_NEWSLETTER>
            <TAX_REFERENCE/>
            <GIFT_AID/>
            <VAT_RELIEF_QUALIFIED/>
            <ADDRESSES>
                <INVADDR>
                    <IADDRESS_ID OTHER_REF="'.$aid.'">'.$aid.'></IADDRESS_ID>
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
                    <DFORENAME></DFORENAME>
                    <DSURNAME></DSURNAME>
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
            <CUSTOM></CUSTOM>
        </CUSTOMER_DETAIL>
        <ORDER_HEADER>
            <INTERNAL_REF></INTERNAL_REF>
            <ORDER_DATE>2017-03-14</ORDER_DATE>
            <DELIVERY_DATE>2017-03-16</DELIVERY_DATE>
            <ORDER_AMOUNT></ORDER_AMOUNT>
            <ORDER_CURRENCY_CODE>GBP</ORDER_CURRENCY_CODE>
            <SITE>Head Office</SITE>
            <ASSOCIATED_REF>'.$reference.'</ASSOCIATED_REF>
            <AGENT></AGENT>
            <ORDER_NOTE/>
            <INVOICE_NOTE/>
            <DELIVERY_NET/>
            <DELIVERY_TAX/>
            <DELIVERY_GRS/>
            <COURIER_CODE>DPD24</COURIER_CODE>
            <COURIER_DESC/>
            <PO_NUMBER>'.$reference.'</PO_NUMBER>
            <KEYCODE_CODE/>
            <BRAND>VW</BRAND>
            <SALES_SOURCE>DW</SALES_SOURCE>
            <COURIER_NOTE></COURIER_NOTE>
            <INV_PRIORITY/>
            <GIFT_AID/>
            <MANUAL_RECEIVED>0</MANUAL_RECEIVED>
            <REQUIRED_BY_DATE/>
            <CLIENT_NAME/>
            <CUSTOM/>
            <COMM_LOGS/>
            <WEBSITE_NAME></WEBSITE_NAME>
            <CHANNEL_ID></CHANNEL_ID>
            <SHIP_DATE/>
            <CONSIGNMENT_REF/>
        </ORDER_HEADER>
        ';
$order_items="<ORDER_ITEMS>".$xml."</ORDER_ITEMS>";
$xml="";
$closed = "</SALES_ORDER>";
$final_XML .= $myXMLData.$order_items.$closed;
$final_XML .= "</SALES_ORDERS>";
$client = new SoapClient($live_url);
$params = array($final_XML);
$response = $client->__soapCall("ImportOrders",$params);

echo "<pre>";
    print_r($response);
echo "</pre>";

/* $formatted_xml = new SimpleXMLElement($order_items);

print_r($formatted_xml);

echo "<br/>"; echo "<br/>"; */