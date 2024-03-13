<?php
require_once('config.php');

function execute($sql)
{
    // save data into table
    // open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    // insert, update, delete 
    mysqli_query($con, $sql);

    // close connection 
    mysqli_close($con);
}

//Trả về 1 mảng dữ liệu
function executeResult($sql)
{
    //save data into table
    //open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    // select 
    $result = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_array($result, 1)) {
        $data[] = $row;
    }

    //close connection
    mysqli_close($con);
    return $data;
}

//Trả về 1 dữ liệu
function executeSingleResult($sql)
{
    //save data into table
    //open connection to database
    $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    // select 

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, 1);

    //close connection
    mysqli_close($con);
    return $row;
}
