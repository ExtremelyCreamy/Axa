<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$test_url = "https://khaos.dashsw.co.uk/test/KhaosDASH.exe/wsdl/IKosWeb";
$live_url = "https://khaos.dashsw.co.uk/KhaosDASH.exe/wsdl/IKosWeb";
$client = new SoapClient($test_url);



if(isset($_POST['process-submit']))
{
    $csv = array('application/vnd.ms-excel', 'text/plain', 'text/csv');
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csv))
    {
        if (is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $csvfile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvfile);
            while (($line = fgetcsv($csvfile)) !== FALSE)
            {
                    echo $line[0];
                    echo "<br />";
            }
            fclose($csvfile);
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

