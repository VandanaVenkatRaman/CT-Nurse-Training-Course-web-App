<?php
class Page
{
// class Page's attributes
public $content;
public $title = 	"Admin | Dashboard";
public $keywords = 	"Admin";
public $H2 = "";
public $headinclude = "../include/head-page-template.txt";
//public $footerinclude = "../include/admin-footer-page-template.js";
// class Page's operations
public function __set($name, $value)
{
    $this->$name = $value;
}

public function Display()
{
    echo "<!DOCTYPE html>\n";
    echo "<html lang='en'>\n<head>\n";
    $this -> DisplayTitle();
    $this -> DisplayKeywords();
    $this -> DisplayHeader();
    $this -> DisplayHeadInclude();
    echo "\n</head>\n<body>\n";
    $this -> DisplayLeftPanel();
    $this -> DisplayEmail();
    $this -> DisplayRightPanel();
    echo "<div class='page-content'>\n";
    $this->DisplayH2();
    echo $this->content;
    echo "</div>\n";
    $this -> DisplayFooterInclude();
    echo "</body>\n</html>\n";
}

public function DisplayTitle()
{
    echo "<title>".$this->title."</title>";
}

public function DisplayKeywords()
{
    echo "<meta name=\"keywords\" content=\"".$this->keywords."\"/>";
}
public function DisplayHeader()
{
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.js"></script>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/custom.css">
	<link rel="stylesheet" href="../css/table.css">

    <!-- DASHBOARD CSS -->

    <link rel="stylesheet" href="../lib/dashboard/css/font-awesome.min.css">
    <link rel="stylesheet" href="../lib/dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/dashboard/css/themify-icons.css">
    <link rel="stylesheet" href="../lib/dashboard/css/flag-icon.min.css">
    <link rel="stylesheet" href="../lib/dashboard/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../lib/dashboard/scss/style.css">
    <link href="../lib/dashboard/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
	
	<style>
	#tablestyle {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
	}
	#tablestyle td, #tablestyle th {
    border: 1px solid #ddd;
    padding: 8px;
	}
	#tablestyle tr:hover {background-color: #ddd;}
	#tablestyle tr:nth-child(even) {
    background-color: #eee;
	}
	#tablestyle tr:nth-child(odd) {
    background-color: #fff;
	}
	#tablestyleth, td {
    padding: 15px;
    text-align: left;
	}
	#tablestyle th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4286f4;
    color: white;
	}
	</style>

    <script src="../lib/dashboard/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../lib/dashboard/js/plugins.js"></script>
    <script src="../lib/dashboard/js/main.js"></script>


    <script src="../lib/dashboard/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="../lib/dashboard/js/dashboard.js"></script>
    <script src="../lib/dashboard/js/widgets.js"></script>
    <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../lib/dashboard/js/lib/vector-map/country/jquery.vmap.world.js"></script>

    <?php
}

public function DisplayHeadInclude()
{
    include($this->headinclude);
}

public function DisplayLeftPanel()
{
?>

<!-- Left Panel -->

<aside id="left-panel" class="left-panel blue-bkgd">
    <nav class="navbar navbar-expand-sm navbar-default blue-bkgd">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="admin_dashboard.php"><img src="../images/logo-white.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="admin_dashboard.php"><img src="../images/logo-white-small.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-file"></i>Instructions</a>
                </li> -->
                <h3 class="menu-title">Module Instructions </h3>
                <li class="menu-item-has-children dropdown">
                    <a href="admin_addModule.php"><i class="menu-icon fa fa-file"></i>Add Module</a>
                    <a href="admin_removeModule.php"><i class="menu-icon fa fa-file"></i>Delete Module</a>
                    <a href="admin_editModule.php"><i class="menu-icon fa fa-file"></i>Edit Module </a>

                </li>
                <h3 class="menu-title">Test Questions and Answers</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="admin_addQuestion.php"><i class="menu-icon fa fa-file"></i>Add Question</a>
                    <a href="admin_removeQuestion.php"><i class="menu-icon fa fa-file"></i>Remove Question</a>
                    <a href="#"><i class="menu-icon fa fa-file"></i>Edit Answer</a>
                </li>

                <h3 class="menu-title">REPORTS</h3>
                <li class="menu-item-has-children dropdown"></li>
                   <li> <a id="report_1" class="report" href="admin_Reports.php"><i class="menu-icon fa fa-file"></i>View Report</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <?php
                        }

                        public function DisplayEmail()
                        {
                            echo $_SESSION["email"];
                        }

                        public function DisplayRightPanel()
                        {
                        ?>
                        <!-- Left Panel -->

                        &nbsp;<i class="menu-icon fa fa-user x2"></i>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

            </div>
        </div>


    </header>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
		
		<div class="content mt-3" id="reportid" style="display:none;">
			<h2 style="text-align: center">Test Reports</h2>
			<div id="reportsall" class="text-dark col-md-12">
			
			</div>
			
		</div>
		
		<div class="content mt-3" id="course" style="display:none;">
				                    <iframe width="750" height="600" scrolling="no" frameborder="0"  style="overflow:hidden;" src="http://my.visme.co/projects/dmvvdg0k-6ep5dm1gwej75dz3">
				                        </iframe><br> <br>
			
                  
			</div>
			
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">&nbsp;</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
 <script src="../lib/dashboard/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="../lib/dashboard/js/plugins.js"></script>
        <script src="../lib/dashboard/js/main.js"></script>


            <script src="../lib/dashboard/js/lib/chart-js/Chart.bundle.js"></script>
            <script src="../lib/dashboard/js/dashboard.js"></script>
            <script src="../lib/dashboard/js/widgets.js"></script>
            <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.js"></script>
            <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.min.js"></script>
            <script src="../lib/dashboard/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
            <script src="../lib/dashboard/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <?php
    }

    public function DisplayFooterInclude()
    {
        include($this->footerinclude);
    }

    public function IsURLCurrentPage($url)
    {
        if(strpos($_SERVER['PHP_SELF'], $url )==false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function DisplayH2()
    {
        echo "<h2>".$this->H2."</h2>";
    }

    }
    ?>
