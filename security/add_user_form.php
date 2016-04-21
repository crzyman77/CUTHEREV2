<?php
	$title = "Control Panel - Add User";
	require '../security/headerInclude.php';
?>
<script>
    function checkUserName(submit) {
	$.getJSON("../security/index.php",{action: "SecurityCheckUserNameExists", username: $('#UserName').val()},
            function(jsonReturned) {
		alert(JSON.stringify(jsonReturned));
		if (jsonReturned.dupeFound) {
                    alert('That username is already in use.');
                    $('#UserName').select();
                } else if (submit) {
                    $('#AddUserForm').submit();
		}
            }
	);
    }
</script>
    <h1>Add User</h1>

    <form id="AddUserForm" action="../security/index.php?action=SecurityProcessUserAddEdit" method="post">

        <label>First Name*:</label> <input type="text" name="FirstName" size="20" value="" autofocus required ><br/>

        <label>Last Name*:</label> <input type="text" name="LastName" size="20" value=""><br/>

        <label>User Name*:</label> <input type="text" name="UserName" id="UserName" onchange="checkUserName(false)" size="20" value="" required ><br/>

        <label>Password*:</label> <input type="password" name="Password" size="20" value=""><br/>

        <label>Email*:</label> <input type="text" name="Email" size="20" value=""><br/>

        <br/>

        <input type="submit" value="Submit" />

    </form>

<?php
	require '../security/footerInclude.php';
?>
