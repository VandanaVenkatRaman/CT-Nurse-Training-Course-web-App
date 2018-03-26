<?php
	class Page
	{
		// class Page's attributes
		public $content;
		public $title = 	"Connecticut Nurses Training Application | Dashboard";
		public $keywords = 	"Connecticut Nurses Training Application";
		public $H2 = "";
		public $headinclude = "../include/page-template.txt";

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

			<!-- DASHBOARD CSS -->

			<link rel="stylesheet" href="../lib/dashboard/css/font-awesome.min.css">
			<link rel="stylesheet" href="../lib/dashboard/css/bootstrap.min.css">
			<link rel="stylesheet" href="../lib/dashboard/css/themify-icons.css">
			<link rel="stylesheet" href="../lib/dashboard/css/flag-icon.min.css">
			<link rel="stylesheet" href="../lib/dashboard/css/cs-skin-elastic.css">
			<link rel="stylesheet" href="../lib/dashboard/scss/style.css">
			<link href="../lib/dashboard/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

			<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

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
				<a class="navbar-brand" href="dashboard.php"><img src="../images/logo-white.png" alt="Logo"></a>
				<a class="navbar-brand hidden" href="dashboard.php"><img src="../images/logo-white-small.png" alt="Logo"></a>
		</div>

		<div id="main-menu" class="main-menu collapse navbar-collapse">
				<ul class="nav navbar-nav">
						<!-- <li class="active">
								<a href="index.html"> <i class="menu-icon fa fa-file"></i>Instructions</a>
						</li> -->
						<h3 class="menu-title">Settings</h3>
						<li class="menu-item-has-children dropdown">
								<a href="#"><i class="menu-icon fa fa-user"></i>Profile</a>
								<a href="#"><i class="menu-icon fa fa-bullhorn"></i>Notifications</a>
								<a href="forgot_password_validate_email.php"><i class="menu-icon fa fa-user-secret"></i>Reset Password</a>
						</li>
						<h3 class="menu-title">ASSIGNED COURSES</h3><!-- /.menu-title -->
						<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" id="course1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-1</a>
								<ul class="sub-menu children dropdown-menu">
										<li><i class="fa fa-table"></i><a href="instructions-quiz-1.php">Instructions</a></li>
										<li><i class="fa fa-table"></i><a id="quiz_1" class="courseQuiz" href="quiz-template.php">Quiz</a></li>
								</ul>
						</li>
						<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" id="course2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-2</a>
								<ul class="sub-menu children dropdown-menu">
										<li><i class="fa fa-table"></i><a href="instructions-quiz-2.php">Instructions</a></li>
										<li><i class="fa fa-table"></i><a id="quiz_2" class="courseQuiz" href="quiz-template.php">Quiz</a></li>
								</ul>
						</li>

						<h3 class="menu-title">COMPLETED COURSE REPORTS</h3>
						<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-3</a>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-4</a>
						</li>
						<li class="menu-item-has-children dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Course List Sample</a>
								<ul class="sub-menu children dropdown-menu">
										<li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
										<li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
								</ul>
						</li>
						<h3 class="menu-title">Help</h3>
						<li class="menu-item-has-children dropdown">
								<a href="faq.php"><i class="menu-icon fa fa-question"></i>FAQs</a>
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
												<a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

												<a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

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


<?php
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
