<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="en-us">
    <title>Dash4SKU</title>
    <meta charset="utf-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
    <script src="https://use.fontawesome.com/fe998ee636.js"></script>
    <style>
        h1
        {
            font-size: 24px;
            color: #111;
        }
        .content
        {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }
        .tt-hint,
        .stockcode
        {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }
        .tt-dropdown-menu
        {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('input.stockcode').typeahead({
                name: 'stockcode',
                remote: 'mysql.php?stockcode=%QUERY'

            });
        });

        function FocusOnInput()
        {
            document.getElementById("stockcode").focus();
        }
    </script>
</head>
    <body onload="FocusOnInput()">
        <div class="content">
            <h1><span style="font-weight:700; letter-spacing:-0.1rem;">Dash<span style="color:#D10C84;">4</span><span style="color:#1D6BB2;">SKU</span></span></h1>
            <?php
            $sid = session_id();
            if (isset($_REQUEST['stockcode']))
            {
                $server   = "localhost"; $username = "root"; $password = "root"; $database = "stock";
                $connection = mysqli_connect($server,$username,$password,$database) or die("Check your settings.  ERRx : " . mysqli_error($connection));
                $query = $_REQUEST['stockcode'];
                $sql = "SELECT stockcode, description, price, popular FROM temp WHERE stockcode = '{$query}';";
                $result = mysqli_query($connection, $sql);
                while ($row = $result->fetch_assoc())
                {
                    $output = $row['description'];
                    $popular = $row['popular'];
                    $stockcode = $row['stockcode'];
                }
                $popular++;
                $sql = "UPDATE `stock`.`temp` SET `popular` = '{$popular}' WHERE `temp`.`stockcode` = '{$query}';";
                $result = mysqli_query($connection, $sql);
                if($stockcode)
                {
                    $qty = 0;
                    $sql = "SELECT * FROM `orders` WHERE `id` LIKE '".$sid."' AND `sku` LIKE '".$stockcode."'";
                    $result = mysqli_query($connection, $sql);
                    while ($row = $result->fetch_assoc())
                    {
                        $qty = $row['qty'];
                    }
                    if($qty==0)
                    {
                        $sql = "INSERT INTO `stock`.`orders` (`URN`, `id`, `qty`, `sku`) VALUES (NULL, '" . $sid . "', '1', '" . $stockcode . "');";
                    }
                    else
                    {
                        $qty++; $sql = "UPDATE `stock`.`orders` SET `qty` = '".$qty."' WHERE (`orders`.`id` = '".$sid."' AND `orders`.`sku` = '".$stockcode."');";
                    }
                    $result = mysqli_query($connection, $sql);
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                <tr>
                    <th>SKU</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                <?php
                $sql = "SELECT id,sku,stockcode,description,price,qty,popular FROM orders LEFT JOIN temp ON orders.sku=temp.stockcode ORDER BY qty DESC, popular DESC;";
                $result = mysqli_query($connection, $sql);
                while ($row = $result->fetch_assoc())
                {
                    $cleantext = preg_replace("/[^a-zA-Z0-9 &-]+/", "", $row['description']);
                ?>
                <tr>
                    <td><?php echo $row['sku']; ?></td>
                    <td><?php echo $cleantext; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo "£".$row['price']; ?></td>
                    <td><?php $price = ($row['qty']*$row['price']); echo "£". number_format($price, 2, '.', ''); ?></td>
                 <!-- <td><div style="float:right;"><i class="fa fa-minus-square-o" aria-hidden="true"></i> <i class="fa fa-plus-square-o" aria-hidden="true"></i></div></td> -->
                </tr>
                <?php
                }
                ?>
                </table>
            </div><?php
            } ?>
            <form action="" method="post">
                <input type="text" id="stockcode" name="stockcode" size="30" class="stockcode" placeholder="Please enter SKU or description">
                <input type="submit" style="display:none"/>
            </form>
        </div>
    </body>
</html>