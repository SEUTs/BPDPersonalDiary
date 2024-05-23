<?php include_once "datCon.php"; ?>
<!DOCTYPE html>

<html>
  <head>
    <title>
      Verifying...
    </title>
    
    <link rel="stylesheet" href="css/style.css" />
  </head>
   <body>
    <defqwop>
        Welcome
    </defqwop>
    <tristam>
        <h3>Log into your account</h3>
        <form action="verify.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="username">Username: </label>
                    </td>
                    <td>
                        <input id=firstInput type="text" id="username" name="username" size="23"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:&nbsp;</label>
                    </td>
                    <td>
                        <input id=secondInput type="password" id="password" name="password" size="23"/>
                    </td>
                </tr>
            </table>
            
            <center>
            <button id="firstButton" type="submit">Log in</button>
            <br>
            <button id="button" type="submit">Sign up</button>
            </center>
        </form>
    </tristam>
  <?php
    include_once 'datCon.php';
       
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql)or die(mysqli_error($con));
    
    while($row = mysqli_fetch_array($result))
        if($username == $row['username'] && $password == $row['password']) {
            header("Location: mainPage.php?username=" . $username);
            exit();
    }
    else
        echo "Error, unknown account";
  ?>
</body>
</html>
