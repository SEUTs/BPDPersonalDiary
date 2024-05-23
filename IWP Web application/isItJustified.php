<!-- currentCrisis.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <noisestorm>
        <form action="test.php" method="post">
            <center><label for="crisis">Is it justified? </label></center>
            <input type="text" id="crisis" name="crisis" class="insertCrisis">
            
    
            
            <?php 
        $crisis = $_REQUEST['crisis'];
        echo "<input type=\"hidden\" id=\"crisis\" name=\"crisis\" value= \"" . $crisis . "\">"; ?>
        <input type="checkbox" name="justification" value="yes" id="yes" />
        <label for="justification">Yes</label>
        <input type="checkbox" name="justification" value="no" id="no" />
        <label for="justification">No</label>
            <br>
            <center><button id="nextStepBtn">Next step</button></center>
        </form>
    </noisestorm>
    
</body>
</html>