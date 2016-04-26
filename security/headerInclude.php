<?php include '../view/headerInclude.php'; ?>
<section class="content">
    <script type="text/javascript" src="attributes.js"></script>

    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title"><?php echo $title ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <div class="container" id='body'>
            <div class="row">
                <div class="col-sm-12">
                <div class="security">
		<?php if (userIsAuthorized("SecurityManageUsers")) {  ?>
				<a href="../security/index.php?action=SecurityManageUsers">Manage Users</a> &nbsp;
		<?php } 
			if (userIsAuthorized("SecurityManageFunctions")) {  ?>
				<a href="../security/index.php?action=SecurityManageFunctions">Manage Functions</a> &nbsp;
		<?php } 
			if (userIsAuthorized("SecurityManageRoles")) {  ?>
				<a href="../security/index.php?action=SecurityManageRoles">Manage Roles</a> &nbsp;
		<?php }
			if (loggedIn()) {  ?>
				<a href="../security/index.php?action=SecurityLogOut">Log Out</a>
		<?php } else { 
				echo "<a href=\"../security/index.php?action=SecurityLogin&amp;RequestedPage=" . urlencode($_SERVER['REQUEST_URI']) . "\">Log In</a>";
		} ?>
