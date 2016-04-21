<div class="navbar navbar-inverse hidden-xs hidden-sm" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../controller/controller.php?action=Home">Home</a></li>
                        <?php if (userIsAuthorized("AddEvent")) { ?>
                        <li class="dropdown"><a href="../controller/controller.php?action=CheckIn">Event Management<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="../controller/controller.php?action=ListEvents">Event List</a></li>
                                <li><a href="../controller/controller.php?action=AddEvent">Add Event</a></li>
                                <?php if (userIsAuthorized("TestLocation")) { ?>
                                <li><a href="../controller/controller.php?action=TestLocation">Check-In Location Test</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if (userIsAuthorized("dbTest")) { ?>
                        <li><a href="../controller/controller.php?action=dbTest">DB Test Page</a></li>
                        <?php } ?>
                        <?php if(userIsAuthorized("GenReports")) { ?>
                        <li><a href="../controller/controller.php?action=GenReports">Generate Reports</a></li>   
                        <?php } ?>
                        <?php if(userIsAuthorized("DeleteData")){ ?>
                        <li><a href="../controller/controller.php?action=DeleteData">Remove Old Data</a></li>
                        <?php }
			if (!loggedIn()) {
                            echo "<li><a href='../security/index.php?action=SecurityLogin&RequestedPage=" . urlencode($_SERVER['REQUEST_URI'])  .  "'>Admin Log In</a></li>";
			}else {
                            echo "<li><a href='../security/index.php?action=SecurityLogOut&RequestedPage=" . urlencode($_SERVER['REQUEST_URI'])  .  "'>Log Out (" . $_SESSION['UserName'] . ") </a></li>";
                        } ?>
                    </ul>
                </div>
            </div>
        </div>