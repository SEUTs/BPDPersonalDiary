<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Is it justified</title>
    
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <astronaut>
       <center>
                        Welcome,
                        <?php 
                            $username = $_REQUEST['username'];
                            echo $username . "<br><br><br>";
           ?>
          <table>
              <tr>
                  <td>           
                    <form action="addHabit.php" method="post">
                        <?php 
                            $username = $_REQUEST['username'];
                            echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\" id=\"shouldntBeSeen\">";
                        ?>
                        <button class="addNewEvent" id="addNewEvent4">Add habit</button>
                    </form>
                  </td>
                  <td>
                    <form action="currentEvent.php" method="post">
                        <?php 
                            $username = $_REQUEST['username'];
                            echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\" id=\"shouldntBeSeen\">";
                        ?>
                        <button class="addNewEvent" id="addNewEvent1">Add event</button>
                    </form>
                  </td>
              </tr>
              <tr>
                  <td>
                      
                        <form action="habits.php" method="post">
                            <?php 
                                $username = $_REQUEST['username'];
                                echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\" id=\"shouldntBeSeen\">";
                            ?>
                            <button class="addNewEvent" id="addNewEvent3">View habits</button>
                        </form>
                </td>
                <td>
                    <form action="displayEvents.php" method="post">
                        <?php 
                            $username = $_REQUEST['username'];
                            echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\" id=\"shouldntBeSeen\">";
                        ?>
                        <button class="addNewEvent" id="addNewEvent2">View events</button>
                    </form>
                 </td>
              </tr>
          </table>
        </center>
    </astronaut>
    <howToUse>
        <a href="howToUse.html">How to use?</a>
    </howToUse>
</body>
</html>