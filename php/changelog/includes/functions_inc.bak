<?php
function changeLogList(){
    //create connection
    $conn = db_connect();

    //$conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {die("Connection failed: " . mysqli_connect_error());}


    //$sql = "SELECT * FROM users WHERE TypeId > 1 AND TypeId < 4";//set sql statement
    $sql = "SELECT * FROM change_log";//set sql statement

    //var_dump($sql);
    //die();
    $result = mysqli_query($conn, $sql);//grab tables



    echo
    '
    
    <ul class="outer">
     <!--COLUMNS-->
                <li class="tableHead">
                    <ul class="inner">
                        <li>UserId</li>
                        <li>Date/Time</li>
                        <li>Event</li>
                    </ul>
                </li>
     <!--ROWS-->
    
    ';
    while($row = mysqli_fetch_assoc($result)){//fetch data from associate array
        $usrid = dbOut($row['UserId']);
        $dateTime = dbOut($row['LogTime']);
        $message = dbOut($row['Message']);

        echo '
                <li>
                        <ul class="inner">
                            <li>' . $usrid . ' </li>
                            <li>' . $dateTime . '</li>
                            <li>' . $message . '</li>
                        </ul>
                </li>
            
            ';
    }//end while

    //release result

    //close db connection
    mysqli_close($conn);
} #end changeLogList()

function dbOut($str){
    if($str!=""){$str = stripslashes(trim($str));}//strip out slashes entered for SQL safety
    return $str;
} #end dbOut()
