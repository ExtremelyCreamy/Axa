<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['process-submit']))
{
    $csv = array('application/vnd.ms-excel','text/plain','text/csv');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csv))
    {
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $infirst = fgets(fopen($_FILES['file']['tmp_name'], 'r'));
            $header = explode(",",$infirst);
            echo "<div>";
            $csvfile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvfile);
            while(($line = fgetcsv($csvfile)) !== FALSE)
            {
                $_n=0;
                foreach($line as $item)
                {
                    echo "<div style='display:inline-block; width:200px;'>".$header[$_n]."</div>";
                    echo "<div style='display:inline-block;'>".$item."</div>";
                    echo "<br />";
                    $_n++;
                }

            }
            echo "</div>";
            fclose($csvfile);
            $report = '?status=1';
        }
        else
        {
            $report = '?status=0';
        }
    }
    else
    {
        $report = '?status=2';
    }
}

