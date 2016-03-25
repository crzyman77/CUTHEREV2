 <?php
  
    $title = "Database Tests";
    require '../view/headerInclude.php';  
 ?>
<div id="body">
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Test Case 1 </h1>
                            <div>
   <?php 
   $username = 'C.Gillis@eagle.clarion.edu';
   $password = 'Gk$98pbw';
        function loginStudent($username,$password){
       //"{outlook.office365.com:993/imap/ssl}",
        if ($mbox=@imap_open("{outlook.office365.com:993/imap/ssl/novalidate-cert}", $username, $password))
        {
         echo "<h1>Connected</h1>\n";
         $imap_obj = imap_check($mbox);
            if(isset($imap_obj)){
                return true;
                //Call Check-in Function
            }else{
                return false;
            }
         imap_close($mbox);
        }else{
         echo "<h1>FAIL!</h1>\n Errors: <br/>";
            print_r(imap_errors());
            echo "<br/> Alerts: \n";
            print_r(imap_alerts());
            return false;
        }
        
        //return false;
    }
    loginStudent($username, $password);
                          ?>  </div>
                     </div>
                </div>
         
                 
            </div>
        </div>
   </section>
    <section id="services">
            <div>

                <p id="test"></p>
             <!-- <button onclick="myFunction()">Try it</button> -->
              <button onclick="locationCheck()">Get Location</button>
              

            </div>
        </section>
    
</div>
    <!--/#services-->

    

<?php
    require '../view/footerInclude.php';
?>