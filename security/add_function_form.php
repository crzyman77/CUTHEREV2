<?php
	$title = "Control Panel - Add Function";
	require '../security/headerInclude.php';
?>

	<h2>Add Function</h2>

	<form action="../security/index.php?action=SecurityProcessFunctionAddEdit" method="post">
            <div class="form-group col-md-3">
                <label>Name:</label> <input type="text" name="Name" size="20" class="form-control" value="" maxlength="64" autofocus required ><br/> 
                <label>Description:</label> <input type="text" name="Description" class="form-control" size="20" value=""><br/> 
                <br/>

                <input type="submit" class="btn btn-common" value="Submit" />
            </div>
	</form>
	</div>
<?php
	require '../security/footerInclude.php';
?>
