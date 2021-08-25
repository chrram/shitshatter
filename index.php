<!DOCTYPE html>
<html>
    <head>
        <title>Shit shat away!</title>
    </head>
    <body>
        <form>

        </form>

        <?php

    
        $conn = new mysqli("localhost", "root@localhost");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "Anonymous shit shat.";
            
        ?>

    </body>
</html>