$(document).ready(function() {
    $("#examRegCourseLoad").change(function() {
        window.courseId = $(this).val();

        console.log(courseId);

        $.ajax({
            url: "./ajax/getStudentForExam.php",
            type: "post",
            data: {
                course: courseId,
            },
            dataType: "json",
            success: function(response) {
                console.log("working..");
                var len = response.length;

                console.log(len);

                $("#examRegSnameLoad").empty();
                for (var i = 0; i < len; i++) {
                    var studentId = response[i]["studentId"];
                    var studentName = response[i]["studentName"];

                    $("#examRegSnameLoad").append(
                        "<option value='" + studentId + "'>" + studentName + "</option>"
                    );

                    console.log(studentId, studentName);
                }

                $("#examRegSidLoad").empty();
                for (var i = 0; i < len; i++) {
                    var studentCodeId = response[i]["studentId"];

                    $("#examRegSidLoad").append(
                        "<option class='hide' id='" +
                        studentCodeId +
                        "'>" +
                        studentCodeId +
                        "</option>"
                    );

                    console.log(studentCodeId);
                }
            },
        });
    });
    $("#examRegSnameLoad")
        .change(function() {
            var select = $(this).find(":selected").val();
            $(".hide").hide();
            $("#" + select).show();
        })
        .change();

    $("#examRegCourseLoad").change(function() {
        noSem = $(this).val();

        console.log(noSem);

        $.ajax({
            url: "./ajax/getSemForExam.php",
            type: "post",
            data: {
                totNoSem: noSem,
            },
            dataType: "json",
            success: function(response) {
                console.log("working..");

                $("#examRegSemLoad").empty();
                var noSemforExam = response[0]["noSemester"];
                for (var i = 1; i <= noSemforExam; i++) {
                    $("#examRegSemLoad").append(
                        "<option value='" + i + "'>Semester " + i + "</option>"
                    );

                    console.log(i);
                }
            },
        });
    });

    $("#examRegCourseLoad").change(function() {
        var subCount = 1;
        var courseNameForTable = $(this).val();

        console.log("subjectName: " + courseNameForTable);
        console.log("subjectCount: " + subCount);

        $.ajax({
            url: "./ajax/getSubForExam.php",
            type: "post",
            data: {
                subCourseName: courseNameForTable,
                subSemCount: subCount,
            },
            dataType: "json",
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                var noSubforExam = response["subCount"];
                console.log("total subject count " + noSubforExam);

                $("#loadSubTable").empty();
                $("#loadSubTable").append(
                    "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-5'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Subject Code</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Subject Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject Type </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Approved / Denied</th> </thead> <tbody id='examSubTable' class='responsive-table__body'> </tbody> </table>"
                );

                $("#examSubTable").empty();
                $("#examRegSubLoad").empty();
                for (var i = 0; i < noSubforExam; i++) {
                    var subName = response[i]["subjectName"];
                    var subCode = response[i]["subjectCode"];
                    var subType = response[i]["subjectType"];
                    var sNo = i + 1;
                    $("#examSubTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='subCode" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        subCode +
                        " </td> <td id='subName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        subName +
                        " </td> <td id='subType" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subType +
                        " </td> <td class='responsive-table__body__text responsive-table__body__text--5'> <div class='form-check'> <input class='form-check-input examAuthz" +
                        i +
                        "' type='checkbox' name='examAuthz' id='flexCheckDefault'> </div> </td>  </td> </tr>"
                    );
                    $("#examRegSubLoad").append(
                        "<option value='" + subName + "'>" + subName + "</option>"
                    );
                }
            },
        });
    });

    $("#examRegSemLoad").change(function() {
        var subCount = $(this).val();
        var courseNameForTable = courseId;

        console.log("subjectName: " + courseNameForTable);
        console.log("subjectCount: " + subCount);

        $.ajax({
            url: "./ajax/getSubForExam.php",
            type: "post",
            data: {
                subCourseName: courseNameForTable,
                subSemCount: subCount,
            },
            dataType: "json",
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                var noSubforExam = response["subCount"];
                console.log("total subject count " + noSubforExam);

                $("#examSubTable").empty();
                $("#examRegSubLoad").empty();
                for (var i = 0; i < noSubforExam; i++) {
                    var subName = response[i]["subjectName"];
                    var subCode = response[i]["subjectCode"];
                    var subType = response[i]["subjectType"];
                    var sNo = i + 1;
                    $("#examSubTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='subCode" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        subCode +
                        " </td> <td id='subName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        subName +
                        " </td> <td id='subType" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subType +
                        " </td> <td class='responsive-table__body__text responsive-table__body__text--5'> <div class='form-check'> <input class='form-check-input examAuthz" +
                        i +
                        "' type='checkbox' name='examAuthz' id='flexCheckDefault'> </div> </td>  </tr>"
                    );
                    $("#examRegSubLoad").append(
                        "<option value='" + subName + "'>" + subName + "</option>"
                    );
                }
            },
        });
    });

    $("#saveExamRegData").click(function() {
        var btnChecker,
            $boxes,
            insertDbCourse,
            insertDbSemeseter,
            insertDbStudentName,
            insertDbStudentId,
            insertDbSubCode,
            insertDbSubName,
            insertDbSubType,
            insertDbSubAuthz,
            insertDbTxn,
            insertDbTxnDate;

        btnChecker = $(this).val();

        $boxes = $("input[name=examAuthz]").length;

        console.log($boxes);

        for (var i = 0; i < $boxes; i++) {
            if ($(".examAuthz" + i).is(":checked")) {
                $(".examAuthz" + i).val("approved");
                console.log($(".examAuthz" + i).val());
            } else {
                $(".examAuthz" + i).val("denied");
                console.log($(".examAuthz" + i).val());
            }
        }

        if ($(".form-select option:selected").val() === "0") {
            alert("check all selected fields");
        } else {
            if ($(".form-control").val().length == 0) {
                alert("check all input fields");
            } else {
                for (var iCheck = 0; iCheck < $boxes; iCheck++) {
                    countPlus1 = iCheck + 1;
                    insertDbCourse = $("#examRegCourseLoad").val();
                    insertDbSemeseter = $("#examRegSemLoad").val();
                    insertDbStudentName = $("#examRegSnameLoad").find(":selected").text();
                    insertDbStudentId = $("#examRegSidLoad").val();
                    insertDbSubCode = $("#subCode" + countPlus1).text();
                    insertDbSubName = $("#subName" + countPlus1).text();
                    insertDbSubType = $("#subType" + countPlus1).text();
                    insertDbSubAuthz = $(".examAuthz" + iCheck).val();
                    insertDbTxn = $("input[name=studentTransNo]").val();
                    insertDbTxnDate = $("input[name=studentTransDate]").val();

                    console.log("data " + iCheck + ": " + insertDbCourse);
                    console.log("data " + iCheck + ": " + insertDbSemeseter);
                    console.log("data " + iCheck + ": " + insertDbStudentName);
                    console.log("data " + iCheck + ": " + insertDbStudentId);
                    console.log("data " + iCheck + ": " + insertDbSubCode);
                    console.log("data " + iCheck + ": " + insertDbSubName);
                    console.log("data " + iCheck + ": " + insertDbSubType);
                    console.log("data " + iCheck + ": " + insertDbSubAuthz);
                    console.log("data " + iCheck + ": " + insertDbTxn);
                    console.log("data " + iCheck + ": " + insertDbTxnDate);

                    $.ajax({
                        url: "./ajax/insertExamStudentData.php",
                        type: "post",
                        data: {
                            saveExamRegData: btnChecker,
                            insertDbCourse: insertDbCourse,
                            insertDbSemeseter: insertDbSemeseter,
                            insertDbStudentName: insertDbStudentName,
                            insertDbStudentId: insertDbStudentId,
                            insertDbSubCode: insertDbSubCode,
                            insertDbSubName: insertDbSubName,
                            insertDbSubType: insertDbSubType,
                            insertDbSubAuthz: insertDbSubAuthz,
                            insertDbTxn: insertDbTxn,
                            insertDbTxnDate: insertDbTxnDate,
                        },
                        dataType: "json",
                        success: function() {},
                    });
                }

                if (iCheck === $boxes) {
                    alert("Data successfully inserted.");
                } else {
                    alert("Data failed to insert.");
                }
            }
        }
    });

    // Mark Data Entry

    $("#markAddCourseLoad").change(function() {
        noSem = $(this).val();

        $.ajax({
            url: "./ajax/getSemForExam.php",
            type: "post",
            data: {
                totNoSem: noSem,
            },
            dataType: "json",
            success: function(response) {
                console.log("working..");

                $("#markAddSemLoad").empty();
                var noSemforExam = response[0]["noSemester"];
                for (var i = 1; i <= noSemforExam; i++) {
                    $("#markAddSemLoad").append(
                        "<option value='" + i + "'>Semester " + i + "</option>"
                    );
                }
            },
        });
    });

    $("#markAddCourseLoad").change(function() {
        var subCount = 1;
        window.courseNameForTable = $(this).val();

        $.ajax({
            url: "./ajax/getSubForExam.php",
            type: "post",
            data: {
                subCourseName: courseNameForTable,
                subSemCount: subCount,
            },
            dataType: "json",
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                var noSubforExam = response["subCount"];

                $("#markAddSubLoad").empty();
                for (var i = 0; i < noSubforExam; i++) {
                    var subName = response[i]["subjectName"];
                    // var subCode = response[i]['subjectCode'];
                    $("#markAddSubLoad").append(
                        "<option value='" + subName + "'>" + subName + "</option>"
                    );
                }
            },
        });
    });

    $("#markAddSemLoad").change(function() {
        var subCount = $(this).val();

        $.ajax({
            url: "./ajax/getSubForExam.php",
            type: "post",
            data: {
                subCourseName: courseNameForTable,
                subSemCount: subCount,
            },
            dataType: "json",
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                var noSubforExam = response["subCount"];

                $("#markAddSubLoad").empty();
                for (var i = 0; i < noSubforExam; i++) {
                    var subName = response[i]["subjectName"];
                    // var subCode = response[i]['subjectCode'];
                    $("#markAddSubLoad").append(
                        "<option value='" + subName + "'>" + subName + "</option>"
                    );
                }
            },
        });
        $("#saveMarkData").prop("disabled", false);
    });

    $("#markAddCourseLoad").change(function() {
        var semCount = 1;

        $.ajax({
            url: "./ajax/getStudentForMark.php",
            type: "post",
            data: {
                courseName: courseNameForTable,
                semCount: semCount,
            },
            dataType: "json",
            cache: false,
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                $("#loadStudentTableForMark").empty();
                $("#loadStudentTableForMark").append(
                    "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-5'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Mark Scored </th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                );

                var studentCount = response["studentCount"];

                $("#addMarkTable").empty();
                for (var i = 0; i < studentCount; i++) {
                    var studentId = response[i]["studentId"];
                    var studentName = response[i]["studentName"];
                    var subjectName = response[i]["subjectName"];
                    var sNo = i + 1;
                    $("#addMarkTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='studentId" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        studentId +
                        " </td> <td id='studentName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        studentName +
                        " </td> <td id='subjectName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subjectName +
                        " </td> <td id='markScored" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--5'> <input id='" +
                        studentId +
                        "_mark" +
                        "' type='text' name='addMarks' class='form-control markInput" +
                        sNo +
                        "'> </td> </tr>"
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            },
        });
    });

    $("#markAddSemLoad").change(function() {
        window.semCount = $(this).val();

        $.ajax({
            url: "./ajax/getStudentForMark.php",
            type: "post",
            data: {
                courseName: courseNameForTable,
                semCount: semCount,
            },
            dataType: "json",
            cache: false,
            success: function(response) {
                // var checkName = data;
                // console.log(checkName);
                console.log("working..");

                var studentCount = response["studentCount"];

                $("#addMarkTable").empty();
                for (var i = 0; i < studentCount; i++) {
                    var studentId = response[i]["studentId"];
                    var studentName = response[i]["studentName"];
                    var subjectName = response[i]["subjectName"];
                    var sNo = i + 1;
                    $("#addMarkTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='studentId" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        studentId +
                        " </td> <td id='studentName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        studentName +
                        " </td> <td id='subjectName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subjectName +
                        " </td> <td id='markScored" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--5'> <input id='" +
                        studentId +
                        "_mark" +
                        "' type='text' name='addMarks' class='form-control markInput" +
                        sNo +
                        "'> </td> </tr>"
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            },
        });
    });

    $("#markAddSubLoad").change(function() {
        var semCount = 1;

        var tempSubjectName = $(this).val();

        $.ajax({
            url: "./ajax/getStudentWithSubForMark.php",
            type: "post",
            data: {
                courseName: courseNameForTable,
                semCount: semCount,
                tempSubjectName: tempSubjectName,
            },
            dataType: "json",
            cache: false,
            success: function(response) {
                // var checkName = response;
                // console.log(checkName);
                console.log("working..");

                var studentCount = response["studentCount"];

                $("#addMarkTable").empty();
                for (var i = 0; i < studentCount; i++) {
                    var studentId = response[i]["studentId"];
                    var studentName = response[i]["studentName"];
                    var subjectName = response[i]["subjectName"];
                    var sNo = i + 1;
                    $("#addMarkTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='studentId" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        studentId +
                        " </td> <td id='studentName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        studentName +
                        " </td> <td id='subjectName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subjectName +
                        " </td> <td id='markScored" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--5'> <input id='" +
                        studentId +
                        "_mark" +
                        "' type='text' name='addMarks' class='form-control markInput" +
                        sNo +
                        "'> </td> </tr>"
                    );
                    console.log(studentId);
                    console.log(studentName);
                    console.log(studentId);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            },
        });
        $("#saveMarkData").prop("disabled", false);
    });

    $("#markAddSubLoad").change(function() {
        var tempSubjectName = $(this).val();
        var semCount = $("#markAddSemLoad").val();

        $.ajax({
            url: "./ajax/getStudentWithSubForMark.php",
            type: "post",
            data: {
                courseName: courseNameForTable,
                semCount: semCount,
                tempSubjectName: tempSubjectName,
            },
            dataType: "json",
            cache: false,
            success: function(response) {
                // var checkName = response;
                // console.log(checkName);
                console.log("working..");

                var studentCount = response["studentCount"];

                $("#addMarkTable").empty();
                for (var i = 0; i < studentCount; i++) {
                    var studentId = response[i]["studentId"];
                    var studentName = response[i]["studentName"];
                    var subjectName = response[i]["subjectName"];
                    var sNo = i + 1;
                    $("#addMarkTable").append(
                        "<tr class='responsive-table__row responsive-table__row_col-5'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                        sNo +
                        " </td> <td id='studentId" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                        studentId +
                        " </td> <td id='studentName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                        studentName +
                        " </td> <td id='subjectName" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                        subjectName +
                        " </td> <td id='markScored" +
                        sNo +
                        "' class='responsive-table__body__text responsive-table__body__text--5'> <input id='" +
                        studentId +
                        "_mark" +
                        "' type='text' name='addMarks' class='form-control markInput" +
                        sNo +
                        "'> </td></tr>"
                    );
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            },
        });
    });

    $("#saveMarkData").click(function() {
        var btnChecker,
            markInput,
            insertDbCourse,
            insertDbSemeseter,
            insertDbStudentName,
            insertDbStudentId,
            insertDbSubCode,
            insertDbSubName,
            insertDbSubType,
            insertDbSubAuthz,
            insertDbTxn,
            insertDbTxnDate;

        btnChecker = $(this).val();

        markInput = $("input[name=addMarks]").length;

        console.log(markInput);

        // for (var i = 0; i < markInput; i++) {

        //     if ($(".examAuthz" + i).is(':checked')) {
        //         $(".examAuthz" + i).val('approved');
        //         console.log($(".examAuthz" + i).val());
        //     } else {
        //         $(".examAuthz" + i).val('denied');
        //         console.log($(".examAuthz" + i).val());
        //     }
        // }

        if ($(".form-select option:selected").val() === "0") {
            alert("check all selected fields");
        } else {
            if ($(".form-control").val().length == 0) {
                alert("check all input fields");
            } else {
                for (var iCheck = 0; iCheck < markInput; iCheck++) {
                    countPlus1 = iCheck + 1;
                    insertDbCourse = $("#markAddCourseLoad").val();
                    insertDbSemeseter = $("#markAddSemLoad").val();
                    // insertDbSubName = $("#markAddSubLoad").find(':selected').text();
                    insertDbSubName = $("#markAddSubLoad").val();
                    insertDbStudentId = $("#studentId" + countPlus1).text();
                    insertDbStudentName = $("#studentName" + countPlus1).text();
                    insertDbStudentMark = $(".markInput" + countPlus1).val();

                    console.log("data countPlus1 " + iCheck + ": " + countPlus1);
                    console.log("data " + iCheck + ": " + insertDbCourse);
                    console.log("data " + iCheck + ": " + insertDbSemeseter);
                    console.log("data " + iCheck + ": " + insertDbSubName);
                    console.log("data " + iCheck + ": " + insertDbStudentId);
                    console.log("data " + iCheck + ": " + insertDbStudentName);
                    console.log("data " + iCheck + ": " + insertDbStudentMark);

                    $.ajax({
                        url: "./ajax/insertStudentMarkData.php",
                        type: "post",
                        data: {
                            saveExamRegData: btnChecker,
                            countPlus1: countPlus1,
                            insertDbCourse: insertDbCourse,
                            insertDbSemeseter: insertDbSemeseter,
                            insertDbSubName: insertDbSubName,
                            insertDbStudentId: insertDbStudentId,
                            insertDbStudentName: insertDbStudentName,
                            insertDbStudentMark: insertDbStudentMark,
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                            console.error(status);
                            console.error(error);
                        },
                    });
                }

                if (iCheck === markInput) {
                    alert(
                        "Data successfully inserted.\ndo not overwrite the existing data, clear the old inputs and add new ones."
                    );
                    $("#saveMarkData").prop("disabled", true);
                } else {
                    alert("Data failed to insert.");
                }
            }
        }
    });

    //reports pg

    $("#loadReportsOptions").change(function() {
        var loadReportsValue = $(this).val();
        console.log(loadReportsValue);

        if ($(this).val() === "loadExamCandidates") {
            var courseName, semCount, subName;

            $(".courseOptions").addClass("show");
            $(".courseOptions").removeClass("hide");

            $('#examRegCourseLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                semCount = 1;

                $.ajax({
                    url: "./ajax/getSubDataFromDb.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
            $('#examRegSemLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                var semCount = $(this).val();

                $.ajax({
                    url: "./ajax/getSubDataFromDb.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
            $('#examRegSubLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                semCount = $('#examRegSemLoad').val();
                reportSubName = $(this).val();

                $.ajax({
                    url: "./ajax/getSubDataFromDbWithSubName.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                        tempSubName: reportSubName,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
        }
        else if ($(this).val() === "loadMarks") {
            $('#examRegCourseLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                semCount = 1;

                $.ajax({
                    url: "./ajax/getSubDataFromDb.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
            $('#examRegSemLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                var semCount = $(this).val();

                $.ajax({
                    url: "./ajax/getSubDataFromDb.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
            $('#examRegSubLoad').change(function() {
                courseName = $(".reportCourseSelect").val();
                semCount = $('#examRegSemLoad').val();
                reportSubName = $(this).val();

                $.ajax({
                    url: "./ajax/getSubDataFromDbWithSubName.php",
                    type: "post",
                    data: {
                        courseName: courseName,
                        semCount: semCount,
                        tempSubName: reportSubName,
                    },
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        // var checkName = data;
                        // console.log(checkName);
                        console.log("working..");

                        $("#loadReportsTable").empty();
                        $("#loadReportsTable").append(
                            "<table class='modal-table responsive-table'> <thead class='responsive-table__head'> <tr class='responsive-table__row responsive-table__row_col-7'> <th class='responsive-table__head__title responsive-table__head__title--1'>S No</th> <th class='responsive-table__head__title responsive-table__head__title--2'>Student Id</th> <th class='responsive-table__head__title responsive-table__head__title--3'>Student Name</th> <th class='responsive-table__head__title responsive-table__head__title--4'>Subject </th> <th class='responsive-table__head__title responsive-table__head__title--5'>Subject Type</th> <th class='responsive-table__head__title responsive-table__head__title--6'>Approved / Denied</th> <th class='responsive-table__head__title responsive-table__head__title--7'>Transaction No</th> </thead> <tbody id='addMarkTable' class='responsive-table__body'> </tbody> </table>"
                        );

                        var studentCount = response["courseCount"];

                        console.log(studentCount);

                        $("#addMarkTable").empty();
                        for (var i = 0; i < studentCount; i++) {
                            var studentId = response[i]["studentId"];
                            var studentName = response[i]["studentName"];
                            var subjectName = response[i]["subjectName"];
                            var subjectType = response[i]["subjectType"];
                            var examAuthz = response[i]["examAuthz"];
                            var TransactionNo = response[i]["TransactionNo"];
                            // var TransactionDate = response[i]["TransactionDate"];
                            var sNo = i + 1;
                            $("#addMarkTable").append(
                                "<tr class='responsive-table__row responsive-table__row_col-7'> <td class='responsive-table__body__text responsive-table__body__text--1'> " +
                                sNo +
                                " </td> <td id='studentId" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--2'> " +
                                studentId +
                                " </td> <td id='studentName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--3'> " +
                                studentName +
                                " </td> <td id='subjectName" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--4'> " +
                                subjectName +
                                " </td><td id='subjectType" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--5'> " +
                                subjectType +
                                " </td><td id='examAuthz" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--6'> " +
                                examAuthz +
                                " </td><td id='TransactionNo" +
                                sNo +
                                "' class='responsive-table__body__text responsive-table__body__text--7'> " +
                                TransactionNo +
                                " </td>  </tr>"
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(status);
                        console.error(error);
                    },
                });
            });
        }
        else {
            $("#loadReportsTable").empty();
            $("#courseOptions").empty();
        }
    });
});