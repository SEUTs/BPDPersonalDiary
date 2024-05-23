<html>
<body>
    
<?php
    include_once 'datCon.php';

    $username = $_REQUEST['username'];
        
    $habit = $_REQUEST['habit'];
    $date = $_REQUEST['date'];

    $sql = "INSERT INTO `" . $username . "habits` ( `habit`, `date`) VALUES ( '" . $habit . "', '" .  $date . "');";

    if(mysqli_query($con, $sql))
        header("Location: mainPage.php?username=" . $username);
    else
        header("Location: addHabit.php" . $username); 
?>
</body>
</html>   