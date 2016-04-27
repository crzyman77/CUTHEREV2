<?php
	$title = "Login";
	require '../security/headerInclude.php';
?>
    <h1>Login</h1>

    <form action="../security/index.php?action=SecurityProcessLogin" method="post">
        <div class="form-group col-md-12">
            <div class="col-md-3">
                Username: <input type="text" class="form-control" name="username" /><br/>
                Password: <input type="password" class="form-control" name="password" /><br/><br/>
                <input type="hidden" name="RequestedPage" value="<?php echo $_GET['RequestedPage'] ?>" />
            </div>
        </div>
        <input type="submit" class="btn btn-common" value="Submit"/>
        
        <?php
            if (isset($_GET['LoginFailure'])) {
                echo '<p/><h4> Invalid Username or Password.  Please try again.</h4>';
            }
        ?>

    </form>

<?php
	require '../security/footerInclude.php';
?>