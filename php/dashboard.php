
<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Connecticut Nurses Training Application | Dashboard</title>
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

    </head>

    <body>


            <!-- Left Panel -->

        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="./"><img src="../images/ct-assoc-logo-svg.svg" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
                </div>

                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.html"> <i class="menu-icon fa fa-user"></i>About </a>
                        </li>
                        <h3 class="menu-title">ASSIGNED COURSES</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" id="course1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-1</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="">Course</a></li>
                                <li><i class="fa fa-table"></i><a id="quiz_1" class="courseQuiz" href="">Quiz</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" id="course2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Course-2</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="">Course</a></li>
                                <li><i class="fa fa-table"></i><a id="quiz_2" class="courseQuiz" href="">Quiz</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Course List Sample</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                                <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
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
                        <h3 class="menu-title">Settings</h3>
                        <h3 class="menu-title">Help</h3>
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
                                <img class="user-avatar rounded-circle" src="../images/admin.jpg" alt="User Avatar">
                            </a>

                            <div class="user-menu dropdown-menu">
                                    <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                    <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                    <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                    <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
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
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3" id="quiz" style="display:none;">
                <h2 style="text-align: center">Take a Quiz</h2>
                <h4 id="mandatoryQuestionAnswer"class="alert alert-danger" style="display: none;">You have not answered all the questions</h4>
                <h4 id="questionAndAnswerResult"class="alert alert-info" style="display: none;"></h4>
                <div id="questionsAndAnswers" class="text-dark col-md-12">
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" id="submitQuizAns" class="btn btn-block btn-primary" name ="submit">Submit</button>
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

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".courseQuiz").click(function (e) {
                        $("#questionAndAnswerResult").hide();
                        $("#mandatoryQuestionAnswer").hide();
                        e.preventDefault();
                        var courseId = $(this).attr('id').split("_")[1];
                        $.ajax({
                            url: 'quiz.php',
                            type: 'post',
                            data: {'action': 'getQuizQuestionsAnswers', 'courseId': courseId},
                            success: function (data) {
                                populateQuestionsAndAnswers(data);
                            },
                            error: function (xhr, desc, err) {
                                console.log(xhr);
                                console.log("Details: " + desc + "\nError:" + err);
                            }
                        });
                    });

                    function populateQuestionsAndAnswers(data) {
                        var html = "";
                        var questionNumber = 1;
                        for (var question in data) {
                            var answers = data[question];
                            html += "<div id=\"q" + questionNumber + "\">";
                            html += "<div class=\"question\">";
                            html += "Q" + questionNumber + ") " + question;
                            html += "</div>";
                            html += "<div class=\"answer\">";
                            for (var index in answers) {
                                html += "<input type=\"radio\" name=\"q" + questionNumber + "\" value=\"" + answers[index].answerId + "\" required>" + answers[index].answerText + "<br>";
                            }
                            html += "<br>";
                            html += "</div>";
                            html += "</div>";

                            questionNumber++;

                        }

                        $("#questionsAndAnswers").empty();
                        $("#questionsAndAnswers").html(html);
                        $("#quiz").show();
                    }
                });

                $("#submitQuizAns").click(function (e) {
                    e.preventDefault();
                    var ansCollection =[];
                    var allQuestionsChecked = true;
                    $('#questionsAndAnswers').children().each(function() {

                        var id = $(this).attr('id');
                        if (!($('input[name=' + id + ']').is(':checked'))) {
                            $("#mandatoryQuestionAnswer").show();
                            allQuestionsChecked = false;
                            return;
                        }
                        var value = $('input[name=' + id + ']:checked').val();
                        ansCollection.push(value);
                    });

                    if (allQuestionsChecked) {
                        $("#mandatoryQuestionAnswer").hide();
                        $.ajax({
                            url: 'quiz.php',
                            type: 'post',
                            data: {'action': 'submitQuizAnswers', 'ansCollection': ansCollection},
                            success: function (data) {
                                $("#questionAndAnswerResult").text("Correct Ans: "+ data.CorrectAns +" Wrong Answers:" + data.WrongAns );
                                $("#questionAndAnswerResult").show();
                            },
                            error: function (xhr, desc, err) {
                                console.log(xhr);
                                console.log("Details: " + desc + "\nError:" + err);
                            }
                        });
                    }
                });
            </script>
    </body>

    </html
