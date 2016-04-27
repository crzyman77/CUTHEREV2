<?php
	$title = "Control Panel - Modify Role";
	require '../security/headerInclude.php';
?>
<?php

    $i = 0;
    foreach ($hasAttrResults as $row) {
        $has_attributes[$i]["id"] = $row["FunctionID"];
        $has_attributes[$i]["name"] = $row["Name"];
        ++$i;
    }

    $i = 0;
    foreach ($hasNotAttrResults as $row) {
        $hasnt_attributes[$i]["id"] = $row["FunctionID"];
        $hasnt_attributes[$i]["name"] = $row["Name"];
        ++$i;
    }

    $select1 = "<select id=\"hasAttributes\" class=\"form-control\" name=\"hasAttributes[]\" size=\"10\" style=\"width:300px;\" multiple=\"multiple\">\n";
    for($i = 0; $i < count($has_attributes); ++$i) {
        $attrid = $has_attributes[$i]["id"];
        $attrname = $has_attributes[$i]["name"];
        $select1 .= "<option value=\"$attrid\">$attrname</option>\n";
    }
    $select1 .= "</select>";

    $select2 = "<select id=\"hasntAttributes\" class=\"form-control\" name=\"hasntAttributes[]\" size=\"10\" style=\"width:300px;\" multiple=\"multiple\">\n";
    for($i = 0; $i < count($hasnt_attributes); ++$i) {
        $attrid = $hasnt_attributes[$i]["id"];
        $attrname = $hasnt_attributes[$i]["name"];
        $select2 .= "<option value=\"$attrid\">$attrname</option>\n";
    }
    $select2 .= "</select>";
?>
        <h2>Modify Role</h2>

        <form action="../security/index.php?action=SecurityProcessRoleAddEdit" method="post" onsubmit="selectAll('hasAttributes')">
            <div class="col-md-12">
                <input type="hidden" name="RoleID" value="<?php echo $id; ?>"/>
                <div class="form-group col-md-3">
                    Name:  <input type="text" name="Name" size="20" class="form-control" value="<?php echo $name; ?>" autofocus required  /><br/>
                    Description: <input type="text" name="Description" class="form-control" size="20" value="<?php echo $desc; ?>" />
                </div>
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <b>Is</b><br/>
                            <?php echo $select1; ?>
                        </td>

                        <td>
                            <button type="button" class="btn btn-block" onclick="swap('hasAttributes','hasntAttributes')"><i class="glyphicon glyphicon-chevron-right"></i></button><br/>
                            <br/>
                            <button type="button" class="btn btn-block" onclick="swap('hasntAttributes','hasAttributes')"><i class="glyphicon glyphicon-chevron-left"></i></buton><br/>
                        </td>

                        <td>
                            <b>Is Not</b><br/>
                            <?php echo $select2; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <br/>
            <input type="submit" class="btn btn-common" value="Submit" />
        </form>
<?php
	require '../security/footerInclude.php';
?>
