<?php
    // echo 'check2';
    include_once('connectvars.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die('Failed to connect to server');

    $ques_no_php = $_GET['id'];
    $query = "SELECT * FROM quiz WHERE id =" . $ques_no_php . " ";
    $result = mysqli_query($dbc, $query)
        or die('error in quering dB');
    $myobj = new stdClass();
    while ($row = mysqli_fetch_array($result)) {

        $myobj->serial = $row['id'];
        $myobj->ques = $row['ques'];
        $myobj->option_1 = $row['option_1'];
        $myobj->option_2 = $row['option_2'];
        $myobj->option_3 = $row['option_3'];
        $myobj->option_4 = $row['option_4'];
        $myobj->ans = $row['ans'];
        $myJSON = json_encode($myobj);
        echo $myJSON;
        
        break;
    }
?>