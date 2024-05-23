<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   

    <center>
    <table id="DisplayedEvents">
        <tr id="PTR2">
            <td id="PTD2">Event</td>
            <td id="PTD2">Justified?</td>
            <td id="PTD2">Duration</td>
            <td id="PTD2">Cause</td>
            <td id="PTD2">Intesity</td>
            <td id="PTD2">Date</td>
            <td id="PTD2">More details</td>
        </tr>
        <?php
            include_once "datCon.php";

            $username = $_REQUEST['username'];

            $sql = "SELECT * FROM " . $username;
            $result = mysqli_query($con, $sql)or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td class=\"PTDB\">" . $row['crisis'] . "</td>";
                    echo "<td class=\"PTD\">";
                    if ($row['justified'] == '1')
                        echo "Yes";
                    else
                        echo "No";
                    echo "</td>";
                
                    /*
                    $timeMinutes = $row['duration'];
                    $timeHours = 0;
                    while ($timeMinutes >= 60) {
                        $timeHours = $timeHours + 1;
                        $timeMinutes = $timeMinutes - 60;
                    }
                    if ($timeMinutes > 0)
                        $time = $timeHours . " hours and " . $timeMinutes . " minutes";
                    else
                        $time = $timeHours . " hours";
                    */
                
                    echo "<td class=\"PTD\">" . $row['duration'] . " minutes </td>";
                    echo "<td class=\"PTDB\">" . $row['cause'] . "</td>";
                    echo "<td class=\"PTD\">" . $row['intensity'] . "</td>";
                    echo "<td class=\"PTD\">" . $row['date'] . "</td>";
                    echo "<td class=\"PTDB\" style=\"width: 52%\">" . $row['details'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    </center>
    
    <div id='JavaScriptButtons'>
        <button id='JustifiedBtn'>Calculate justified percentage</button>
        <button id='TotalEventTimeBtn'>Calculate total event time</button>
        <button id='DayScoreBtn'>Calculate day score</button>
    </div>
    
    <br><br>
    <div class='displayDiv' id='JustifiedDisplay'></div>
    <div class='displayDiv' id='TotalEventTimeDisplay'></div>
    <div class='displayDiv' id='DayScoreDisplay'></div>
    
    <div id='safetyButtons'>
        <button id='safetyBtn'>Safety</button>
        <button id='extraSafetyBtn'>Full safety</button>
    </div>
        
    <script>
        
        let table = document.getElementsByClassName('PTD');
        let hiddenTable = document.getElementsByClassName('PTDB');
        
        
        
        
        
            let JustifiedNotDisplayed = true;
            let JustifiedButton = document.getElementById('JustifiedBtn');
        
        function displayJustified() {
            if (!fullSafetyOn) {
                if (JustifiedNotDisplayed){
                    JustifiedNotDisplayed = false;

                    let justified = 0;
                    for (let i = 0; i < table.length; i++)
                        if (table[i].innerHTML == 'Yes')
                            justified++;

                    document.getElementById('JustifiedDisplay').innerHTML = justified + " out of " + (table.length/4) + " were justified ( " + parseFloat(justified*400/table.length) + "% ). <br>";

                    document.getElementById('JustifiedBtn').innerHTML = "Hide justified percentage";
                }
                else {
                    JustifiedNotDisplayed = true;

                    document.getElementById('JustifiedDisplay').innerHTML = "";

                    document.getElementById('JustifiedBtn').innerHTML = "Calculate justified percentage";
                }
            }
        }
        JustifiedButton.addEventListener('click', displayJustified);
        
        
        
            let TotalEventTimeNotDisplayed = true;
            let TotalEventTimeButton = document.getElementById('TotalEventTimeBtn');
        
        function displayTotalEventTime() {
            if (!fullSafetyOn) {
                if (TotalEventTimeNotDisplayed) {
                    let totalTime = 0;
                    for (let i = 0; i < table.length; i++)
                        if (i % 4 == 1)
                            totalTime += parseInt(table[i].innerHTML);

                    let averageMinutes = totalTime/(table.length/4),
                        averageHours = 0;
                    while (averageMinutes >= 60){
                        averageHours++;
                        averageMinutes -= 60;
                    }
                    if (averageMinutes % 1 > 0.5)
                        averageMinutes++;
                    
                    let totalHours = 0;
                    while (totalTime >= 60){
                        totalHours++;
                        totalTime -= 60; 
                    }
                    
                    document.getElementById('TotalEventTimeDisplay').innerHTML = "Total events time: " + totalHours + " hours and " + totalTime + " minutes in " + (table.length/4) + " days. (" + averageHours + " hours and " + parseInt(averageMinutes) + " minutes per event day)<br>";
                    
                    document.getElementById('TotalEventTimeBtn').innerHTML = "Hide total event time";
                    TotalEventTimeNotDisplayed = false;
                }
                else {
                    document.getElementById('TotalEventTimeDisplay').innerHTML = "";
                    
                    document.getElementById('TotalEventTimeBtn').innerHTML = "Calculate total event time";
                    TotalEventTimeNotDisplayed = true;
                }
            }
        }
        TotalEventTimeButton.addEventListener('click', displayTotalEventTime);
        
        
        
            let dayScoreNotDisplayed = true;
            let dayScoreButton = document.getElementById('DayScoreBtn');
        
        function displayDayScore() {
            if (!fullSafetyOn) {
                if (dayScoreNotDisplayed) {
                    let day = [],
                        intensity = [0],
                        counter = [];
                    let j = 0;
                    for (let i = 0; i < table.length; i++)
                        if (i % 4 == 3){
                            found = false;
                            for (j = 0; j < day.length; j++)
                                if (day[j] == table[i].innerHTML){
                                    found = true;
                                    break;
                                }
                            if (found) {
                                intensity[j] += parseInt(table[i-1].innerHTML) * Math.sqrt(parseInt(table[i-2].innerHTML));
                                counter[j]++;
                            } else {
                                day[j] = table[i].innerHTML;
                                intensity[j] = parseInt(table[i-1].innerHTML) * Math.sqrt(parseInt(table[i-2].innerHTML));
                                counter[j] = 1;
                            }
                        }
                    
                    for (j = 0; j < day.length; j++)
                        intensity[j] = parseFloat(intensity[j] / counter[j]);
                                
                    let display = "<table><tr><td>Day</td><td>Intensity</td>";
                    for (j = 0; j < day.length; j++)
                        display += "<tr><td>" + day[j] + "</td><td>" + intensity[j] + "</td></tr>";
                    display += "</table><br>";

                    document.getElementById('DayScoreDisplay').innerHTML = topWorstDays(day, intensity);
                    dayScoreNotDisplayed = false;
                    document.getElementById('DayScoreBtn').innerHTML = "Hide day score";
                }
                else {
                    document.getElementById('DayScoreDisplay').innerHTML = "";
                    dayScoreNotDisplayed = true;
                    document.getElementById('DayScoreBtn').innerHTML = "Calculate day score";
                    
                    for (let j = 0; j < table.length; j++)
                        table[j].style.backgroundColor = "#000066";
                    for (let j = 0; j < hiddenTable.length; j++)
                        hiddenTable[j].style.backgroundColor = "#000066";
                }
            }
        }
        dayScoreButton.addEventListener('click', displayDayScore);
        
        
        function topWorstDays(day, score) {
            let displayedDays = [];
            let displayedScores = [];
            for (let i = 0; i < day.length; i++) {
                console.log(day[i], score[i]);
            }
            for (let i = 0; i < day.length; i++) {
                let currentWorstDay = day[i];
                let currentWorstScore = score[i];
                let index = 0;
                for (let j = 0; j < day.length; j++)
                    if (currentWorstScore < score[j]) {
                        currentWorstScore = score[j];
                        currentWorstDay = day[j];
                        index = j;
                    }
                displayedDays[i] = currentWorstDay;
                displayedScores[i] = currentWorstScore;
                score[index] = 0;
            }
            
            let display = "<br><table><tr><th>Top worst days</th></tr>";
            
            for (let i = 0; i < day.length; i++) {
                let relativeScore = parseInt(displayedScores[i]/displayedScores[0] * 100);
                
                if (relativeScore > 24) {
                    if (relativeScore > 49) {
                        if (relativeScore > 74) {
                            color = "#990000";
                        }
                        else
                            color = "#cc8800";
                    }
                    else
                        color = "#0088cc";
                }
                else
                    color = "#00b36b";
                
                display += "<tr><td>" + (i+1) + ". " + displayedDays[i] + ": &nbsp;&nbsp;&nbsp;" + relativeScore + "% relative score " + "</td></tr>";
                
                for (let j = 0; j < table.length; j++)
                    if (j % 4 == 3) 
                        if (table[j].innerHTML == displayedDays[i]) {
                            hiddenTable[parseInt(j/4)*3].style.backgroundColor = color;
                            table[j-3].style.backgroundColor = color;
                            table[j-2].style.backgroundColor = color;
                            hiddenTable[parseInt(j/4)*3+1].style.backgroundColor = color;
                            table[j-1].style.backgroundColor = color;
                            table[j].style.backgroundColor = color;
                            hiddenTable[parseInt(j/4)*3+2].style.backgroundColor = color;
                        }
            }
                
            display += "</table><br>";
            return display;
        }
        
        
        
        
            let safetyOn = false;
            let safeInitially = false;
            let fullSafetyOn = false;

            let safetyButton = document.getElementById('safetyBtn');
            let hiddenElements = document.getElementsByClassName('PTDB');
        
        function safetyMode() {
            if (safetyOn) {
                for (let i = 0; i < hiddenElements.length; i++)
                    hiddenElements[i].style.color = "white";
                
                if (fullSafetyOn)
                    safetyModeExtra();
                
                safetyButton.style.backgroundColor = "darkred";
                safetyOn = false;
            }
            else{
                for (let i = 0; i < hiddenElements.length; i++)
                    hiddenElements[i].style.color = "rgba(0, 0, 0, 0)";
                safetyButton.style.backgroundColor = "darkgreen";
                safetyOn = true;
            }
        }
        safetyButton.addEventListener('click', safetyMode);
        
        
        
            let extraSafetyButton = document.getElementById('extraSafetyBtn');
        
        function safetyModeExtra() { 
            if(fullSafetyOn){
                if (!safeInitially){
                    fullSafetyOn = false;
                    safetyMode();
                }
                
                extraSafetyButton.style.backgroundColor = 'darkred';
                fullSafetyOn = false;
                
            } else {
                safeInitially = safetyOn;
                if(!safetyOn){
                    safetyMode();
                }
                
                if (!JustifiedNotDisplayed)
                    displayJustified();
                if (!TotalEventTimeNotDisplayed)
                    displayTotalEventTime();
                if (!dayScoreNotDisplayed)
                    displayDayScore();
                
                extraSafetyButton.style.backgroundColor = 'darkgreen';
                fullSafetyOn = true;
            }
        }
        extraSafetyButton.addEventListener('click', safetyModeExtra);
        
        safetyMode();
        
    </script>
    
</body>
</html>