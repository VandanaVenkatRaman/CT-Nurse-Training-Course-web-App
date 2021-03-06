<script type="text/javascript">
var currentCourseId;
$(document).ready(function() {

    // JS for Quiz
    $(".courseQuiz").click(function (e) {
        $("#instructions").hide();
        $("#profile").hide();
        $("#dash-inx").hide();
        e.preventDefault();
        $("#questionAndAnswerResult").hide();
        $("#mandatoryQuestionAnswer").hide();
        currentCourseId = $(this).attr('id').split("_")[1];
        $("#pageHeader").text("Answer the below questions ");
        $.ajax({
            url: 'quiz.php',
            type: 'post',
            data: {'action': 'getQuizQuestionsAnswers', 'courseId': currentCourseId},
            success: function (data) {
                populateQuestionsAndAnswers(data);
                $('.welcome').hide();
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
            html += questionNumber + ") " + question;
            html += "</div>";
            html += "<div class=\"answer\">";
            for (var index in answers) {
                html += "<input type=\"radio\" name=\"q" + questionNumber + "\" value=\"" + answers[index].answerId + "\" required>" + "&nbsp;&nbsp;" + answers[index].answerText + "<br>";
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
                data: {'action': 'submitQuizAnswers', 'ansCollection': ansCollection,'courseId': currentCourseId},
                success: function (data) {
                    if (data.Percentage >= 80){
                        $("#questionAndAnswerResult").html("Your Score: "+ data.Percentage +"<br/>Course Completed Successfully! ");
                        $("#questionAndAnswerResult").removeClass("alert-danger");
                        $("#questionAndAnswerResult").addClass("alert-success");
                    }
                    else if(data.Percentage< 80 && data.Attempt < 3){
                        $("#questionAndAnswerResult").html("Your Score: "+ data.Percentage +"<br/>Please Retake the Course! ");
                        $("#questionAndAnswerResult").removeClass("alert-success");
                        $("#questionAndAnswerResult").addClass("alert-danger");
                    }
                    else {
                        $("#questionAndAnswerResult").html("Your Score: "+ data.Percentage +"<br/>Course Completed! You exceeded the number of attempts. Can't Retake ");
                        $("#questionAndAnswerResult").removeClass("alert-success");
                        $("#questionAndAnswerResult").addClass("alert-danger");
                    }

                    $("#questionAndAnswerResult").show();
                    if (data.EmailSent) {
                        alert("Copy of your report has been emailed to you.");
                    }
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }
            });
        }
    });

    // JS for Instructions
    $(".instruction").click(function(e) {
        $("#quiz").hide();
        $("#profile").hide();
        $("#dash-inx").hide();

        currentCourseId = $(this).attr('id').split("_")[1];

        e.preventDefault();
        $.ajax({
            url: 'instructions.php',
            type: 'post',
            data: {'action': 'getCourseMaterial', 'courseId': currentCourseId},
            success: function (data) {
                populateCourseMaterial(data);
                $('.welcome').hide();
            },
            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    });

    function populateCourseMaterial(data) {
        var course = data[currentCourseId];
        $("#pageHeader").text("Tutorial for Course "+ course.courseName);
        var html = "";
        var material = course.courseDocument;
        html += "<iframe src=\'" + material + "\' height='600px' width='100%'></iframe>";

        $("#instructions").empty();
        $("#instructions").html(html);
        $("#instructions").show();
    }

    // JS for Profile Page
    $(".Profile").click(function (e) {
        $("#quiz").hide();
        $("#instructions").hide();
        $("#dash-inx").hide();
        e.preventDefault();
        var userId = $('.userId').text();
        $.ajax({
            url: 'view_profile.php',
            type: 'post',
            data: {'action': 'getUserDetails', 'userId': userId},
            success: function (data) {
                populateUserInformation(data);
                $('.welcome').hide();
            },
            error: function (xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    });

    function populateUserInformation(data) {
        $("#pageHeader").html("User Information");
        $("#fname").html("<span class='font-bold'>First Name: </span>"+data.firstName);
        $("#lname").html("<span class='font-bold'>Last Name: </span>"+data.lastName);
        $("#emailaddress").html("<span class='font-bold'>Email: </span>"+data.email);
        $("#univName").html("<span class='font-bold'>University Name: </span>"+data.universityName);
        $("#gradYear").html("<span class='font-bold'>Graduation Year: </span>"+data.graduationYear);
        $("#profile").show();
    }
});


</script>

<script type="text/javascript">
    function hideButtons() {
        var x = document.getElementById("quizButtons");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    </script>
