<!DOCTYPE html>
<html>

<style type="text/css">
    .navbar {
        padding: 2px 10px;
    }
</style>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="javascript: void" onclick="window.location='index.php'"><img src="images/TIMS_logo.png" width="100px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="javascript: void" onclick="window.location='index.php'">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      TIMS
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <div class="dropdown-header">Tesoro Information<br>Management System</div>
                		<a class="dropdown-item" href="javascript: void" onclick="window.location='TIMS_login.php'">Log In</a>
                		<a class="dropdown-item" href="javascript: void" onclick="window.location='TIMS_login.php?register=true'">Sign Up</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>