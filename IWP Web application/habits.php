<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <center>
        <table id="DisplayedHabits">
            <tr id="PTR2H">
                <td id="PTD2H">Habit</td>
                <td id="PTD2H">Added on</td>
                <td id="PTD2H">Days since<br>added</td>
            </tr>
            <?php
                include_once "datCon.php";

                $username = $_REQUEST['username'];
                $index = 0;
                $sql = "SELECT * FROM " . $username . "habits";
                $result = mysqli_query($con, $sql)or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td class=\"PTDBH\">" . $row['habit'] . "</td>";
                        
                        $idDate = "changeable" . $index;
                        $index++;
                        echo "<td class=\"lastDate\" id=\"" . $idDate . "\">" . $row['date'] . "</td>";
                        echo "<td class=\"daysCounter\"></td>";
                    echo "</tr>";
                }
            ?>
              
        </table>
    </center>
    <div id='safetyButtons'>
        <button id='safetyBtn'>Safety</button>
    </div>
    
    <script>
        let hiddenElements = document.getElementsByClassName('PTDBH');
        let safetyButton = document.getElementById('safetyBtn');
        let safetyOn = false;
        
        function safetyMode() {
            if (safetyOn) {
                for (let i = 0; i < hiddenElements.length; i++)
                    hiddenElements[i].style.color = "white";
                
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
        
        safetyMode();
        
        function getCounter() {
            
            var today = new Date();
            var yearToday = today.getFullYear(),
                monthToday = today.getMonth()+1,
                dayToday = today.getDate();
            
            let daysCounter = document.getElementsByClassName("daysCounter"),
                lastDate = document.getElementsByClassName("lastDate");

            for (let i = 0; i < lastDate.length; i++) {
                let yearThen = parseInt(lastDate[i].innerHTML.charAt(0) + lastDate[i].innerHTML.charAt(1) + 
                               lastDate[i].innerHTML.charAt(2) + lastDate[i].innerHTML.charAt(3)),
                    monthThen = parseInt(lastDate[i].innerHTML.charAt(5)+lastDate[i].innerHTML.charAt(6)),
                    dayThen = parseInt(lastDate[i].innerHTML.charAt(8)+lastDate[i].innerHTML.charAt(9));
                
                let dayDifference = 0;
                    
                if (dayToday < dayThen)
                    dayDifference = dayToday - dayThen + 1;
                else
                    dayDifference = dayToday - dayThen;
                
                while (yearToday != yearThen) {
                    if (yearThen % 4 == 0)
                        dayDifference += 366;
                    else
                        dayDifference += 365;
                    yearThen++;
                }
                    
                while (monthThen < monthToday) {
                    if (monthThen == 1 || monthThen == 3 || monthThen == 5 || monthThen == 7 || monthThen == 8 || monthThen == 10)
                        dayDifference += 31;
                    else if (monthThen == 4 || monthThen == 6 || monthThen == 9 || monthThen == 11)
                        dayDifference += 30;
                    else if (yearToday % 4 == 0)
                        dayDifference += 29;
                    else
                        dayDifference += 28;
                    monthThen++;
                }
                
                let addAYear = false;
                while (monthThen > monthToday) {
                    addAYear = true;
                    if (monthThen == 1 || monthThen == 3 || monthThen == 5 || monthThen == 7 || monthThen == 8 || monthThen == 10)
                        dayDifference -= 31;
                    else if (monthThen == 4 || monthThen == 6 || monthThen == 9 || monthThen == 11)
                        dayDifference -= 30;
                    else if (yearToday % 4 == 0)
                        dayDifference -= 29;
                    else
                        dayDifference -= 28;
                    monthThen--;
                }
                
                if (addAYear) {
                    if (yearToday % 4 == 0)
                        dayDifference += 366;
                    else
                        dayDifference += 365;
                }
                
                daysCounter[i].innerHTML = dayDifference + " days";
            }
        }
        
        getCounter();
        
    </script>
</body>
</html>