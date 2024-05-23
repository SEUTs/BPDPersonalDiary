<html>
<body>
    
<?php
    include_once 'datCon.php';

    $username = $_REQUEST['username'];
        
    $event = $_REQUEST['event'];
    $justified = $_REQUEST['justified'];
    $duration = $_REQUEST['duration'];
    $cause = $_REQUEST['cause'];
    $intesity = $_REQUEST['intensity'];
    $date = $_REQUEST['date'];
    $details = $_REQUEST['details'];

    $sql = "INSERT INTO `" . $username . "` ( `crisis`, `justified`, `duration`, `cause`, `intensity`, `date`, `details` ) VALUES ( '" . $event . "', '" . $justified . "', '" . $duration . "', '" . $cause . "', '" . $intesity . "', '" .  $date . "', '" . $details . "');";

    if(mysqli_query($con, $sql))
        header("Location: mainPage.php?username=" . $username);
    else
        header("Location: currentEvent.php" . $username); 
?>
</body>
</html>   