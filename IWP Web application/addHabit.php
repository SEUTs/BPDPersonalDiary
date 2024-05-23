<!--Current crisis-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <noisestorm>
        <form action="postHabit.php" method="post">
            <center>
                <label for="habit">Add a bad habit you<br>wish to get rid of: </label>
            <center>
            </center>
                <input type="text" id="habit" name="habit" autocomplete="off">
            </center>
            
            <br>
            
            <center>
                <label for="datetime-local">When did you decide to<br>make this change? </label>
            </center>
            <center>
                <input type="date" name="date">
            </center>
            
            
            <?php
                $username = $_REQUEST['username'];
                echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\">";
            ?>
            
            <center>
                <button id="nextStepBtn">Post habit</button>
            </center>
        
        </form>
    </noisestorm>    
</body>

</html>




