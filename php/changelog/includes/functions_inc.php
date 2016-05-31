<?php
function changeLogList(){
    //create connection
    $conn = db_connect();

    // Check connection
    if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
    $sql = "SELECT * FROM change_list;";//set sql statement
    $result = mysqli_query($conn, $sql);//grab tables

    $changeLogs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($changeLogs, $row);
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);

    return array_reduce($changeLogs, function($html, $changeLog) {
        $listItemFormat = 
            "<li>
                <ul class='inner'>
                    <li>%s</li>
                    <li>%s</li>
                    <li>%s</li>
                </ul>
            </li>";
        return $html 
            . sprintf($listItemFormat
            , dbOut($changeLog['Name'])
            , dbOut($changeLog['LogTime'])
            , dbOut($changeLog['Message']));
    });
} #end changeLogList()

function dbOut($str){
    if($str!=""){$str = stripslashes(trim($str));}//strip out slashes entered for SQL safety
    return $str;
} #end dbOut()

?>
