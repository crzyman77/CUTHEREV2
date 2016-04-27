<?php
	$title = "Control Panel - Add Role";
	require '../security/headerInclude.php';
?>

	<h2>Add Role</h2>

	<form action="../security/index.php?action=SecurityProcessRoleAddEdit" method="post">
            <div class="form-group col-md-3">
                <label>Name:</label> <input type="text" name="Name" size="20" class="form-control" value="" autofocus required ><br/>
                <label>Description:</label> <input type="text" name="Description" class="form-control" size="20" value=""><br/>
                <br/>

                <input type="submit" class="btn btn-common" value="Submit" />
            </div>
	</form>

<?php
	require '../security/footerInclude.php';
?>

