<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/stage2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
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


            $f = fopen($_FILES['file']['tmp_name'], 'r');
            $line = fgets($f);
            fclose($f);
            $cells = explode(",",$line);
            echo "<div class='inline'>";
            $_y = 0;
            foreach($cells as $output)
            {
                $_y++;
                if ($_y % 2 == 0) {
                echo "<div class='cell even bold'>"; } else {
                    echo "<div class='cell odd bold'>";
                }
                echo $output;
                echo "</div>";

            }
            echo "</div>";
            fgetcsv($csvfile);
            $_n=0;
            while (($line = fgetcsv($csvfile)) !== FALSE)
            {
                echo "<div class='inline'>";
                $_y = 0;
                    foreach($line as $output)
                    {
                        $_y++;
                        if($_n<6 && $_n>2) {
                            if ($_y % 2 == 0) {
                                echo "<div id='cell" . $_n . $_y . "' class='cell" . $_y . " cell even'>" . $output . "</div>";
                            } else {
                                echo "<div id='cell" . $_n . $_y . "' class='cell" . $_y . " cell odd'>" . $output . "</div>";
                            }
                        }
                    }
                if($_n<11) {
                    echo "</div>";
                }
                $_n++;
            }
            fclose($csvfile);
            $report = '1';
            ?>


<div class='inline'>
    <?php
    $selection=array('CompanyCode','PO Number','SKU','Quanity');
    $_x=0;
    do{ $_x++; ?>
    <div  style='height:31px; padding-left:5px;'>
        <select id="option<?php echo $_x; ?>" >
            <?php
            foreach($selection as $key => $value){?>
            <option <?php if ($_x==($key+1)){echo "SELECTED";} ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>
        </select>
    </div>
<?php  }while ($_x<$_y); ?>

</div>

            <?php
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
?>
</body>
</html>