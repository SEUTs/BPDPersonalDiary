  <?php
    include_once 'datCon.php';

    $username = $_REQUEST['user'];
    $password = $_REQUEST['passwd'];


    
    $doesntExist = true;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql)or die(mysqli_error($con));
    
    while($row = mysqli_fetch_array($result))
        if($username == $row['username']) {
            $doesntExist = false;
    }

    if($doesntExist){

        $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '" . $username . "', '" . $password . "');";

        mysqli_query($con, $sql);

        $sql = "CREATE TABLE `bpd app`.`" . $username . "` ( `id` INT NOT NULL AUTO_INCREMENT , `crisis` TEXT NOT NULL , `justified` BOOLEAN NOT NULL , `duration` INT NOT NULL, `cause` TEXT NOT NULL , `intensity` INT NOT NULL , `date` DATE NOT NULL , PRIMARY KEY (`id`),  `details` TEXT NOT NULL) ENGINE = InnoDB;";

        if(mysqli_query($con, $sql));

        $sql = "CREATE TABLE `bpd app`.`" . $username . "habits` ( `id` INT NOT NULL AUTO_INCREMENT , `habit` TEXT NOT NULL , `date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

        if(mysqli_query($con, $sql));
        header("Location: mainPage.php?username=" . $username);
    }
    else {
        header("Location: signUp.html");
    }
 ?>