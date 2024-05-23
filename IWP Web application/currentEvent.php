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
        <form action="postEvent.php" method="post">
            <center>
                <label for="event">Event: </label>
            <center>
            </center>
                <input type="text" id="insertCrisis" name="event" autocomplete="off">
            </center>
            
            <br>
            
            <center>
                <label for="justified">Was it justified? </label>
            <center>
            </center>
                <input type="radio" name="justified" value="1" id="yes" />
                Yes
                <input type="radio" name="justified" value="0" id="no" />
                No
            </center>
            <br>
            
            <center>
                <label for="duration">How long did it last for?</label>
            </center>
            <center>
                <input id="shortInputHours" type="number" name="durationHours" min="0" value="0">
                hours
                <input id="shortInputMinutes" type="number" name="durationMinutes" min="0" max="59" value="0">
                minutes
            </center>
            <br>
            
            <center>
                <label for="cause">What caused it?</label>
            </center>
            <center>
                <input type="text" name="cause" autocomplete="off">
            </center>
            <br>
            
            <center>
                <label for="intensity">How intense was it?</label>
            </center>
            <center>
                <input list="intesityScale" name="intensity">
                
                <datalist id="intesityScale">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </datalist>
            </center>
            <br>
            
            <center>
                <label for="datetime-local">When did it occur?</label>
            </center>
            <center>
                <input type="date" name="date">
            </center>
            <br>
            
            <center>
                <label for="details">Extra details</label>
            </center>
            <center>
                <textarea name="details" cols="60" rows="12"></textarea>
            </center>
            
            <center>
                <button id="nextStepBtn">Next step</button>
            </center>
            
            <?php
                $username = $_REQUEST['username'];
                echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\">";
            ?>
            
            <input type="hidden" name="duration" id='hiddenInput' value='0'>
        
        </form>
    </noisestorm>

    <script>
        let inputMinutes = document.getElementById('shortInputMinutes');
        let inputHours = document.getElementById('shortInputHours');

        function getDuration(){
            let minutes = parseInt(document.getElementById('shortInputHours').value) * 60 + 
                          parseInt(document.getElementById("shortInputMinutes").value);
            
            document.getElementById('hiddenInput').value = minutes;
            console.log(document.getElementById('hiddenInput').value);
        }

        inputMinutes.addEventListener('change', getDuration);
        inputHours.addEventListener('change', getDuration);
    </script>
    
</body>

</html>




