<?php
$server   = "localhost"; $username = "root"; $password = "root"; $database = "stock";
$connection = mysqli_connect($server,$username,$password,$database) or die("Check your settings.  ERRx : " . mysqli_error($connection));
if (isset($_REQUEST['stockcode']))
{
    $query = $_REQUEST['stockcode'];
    $sql = "SELECT stockcode, description FROM temp WHERE (stockcode LIKE '%{$query}%' OR description LIKE '%{$query}%') ORDER BY popular DESC;";
    $result = mysqli_query($connection, $sql);
    $array = array();
    while ($row = $result->fetch_assoc()) {
        $array[] = array('label' => $row['stockcode'] . ', ' . htmlentities($row['description']), 'value' => $row['stockcode']);
    }
    echo json_encode($array);
}
