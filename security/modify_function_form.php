<?php
	$title = "Control Panel - Modify Function";
	require '../security/headerInclude.php';
?>
    <h2>Modify Function</h2>

    <form action="../security/index.php?action=SecurityProcessFunctionAddEdit" method="post">
        <div class="form-group col-md-3">    
            <input type="hidden" name="FunctionID" value="<?php echo $id; ?>"/>

            Name:  <input type="text" name="Name" size="20" class="form-control" value="<?php echo $name; ?>" autofocus required  /><br/>
            Description: <input type="text" name="Description" class="form-control" size="20" value="<?php echo $desc; ?>" />

            <br/>

            <input type="submit" class="btn btn-common" value="Submit" />
        </div>
    </form>
	
<?php
	require '../security/footerInclude.php';
?>
