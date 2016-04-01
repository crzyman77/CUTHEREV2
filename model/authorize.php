<?php
    //header("Content-type:application/ajax");
           $username = $_POST['username'];
           $password = $_POST['pass'];
       //"{outlook.office365.com:993/imap/ssl}",
        //$username = 'C.Gillis@eagle.clarion.edu';
        //$password = 'Gk$98pbw';
           
        if ($mbox=@imap_open("{outlook.office365.com:993/imap/ssl/novalidate-cert}", $username, $password))
        {
            echo 'true';
        }else{
            echo 'Please Enter your Student Email and Valid Password';
//         echo "<h1>FAIL!</h1>\n Errors: <br/>";
//            print_r(imap_errors());
//            echo "<br/> Alerts: \n";
//            print_r(imap_alerts());
//            return false;
        }
        
        //return false;
    





