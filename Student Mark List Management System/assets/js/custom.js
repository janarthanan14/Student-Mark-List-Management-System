window.addEventListener("DOMContentLoaded", () => {
    // global configuration
    const globalConfig = {
        speed: 20,
        animationSmooth: "3s ease-out",
        strokeBottom: 3,
        // colorSlice: "#5285E1",
        // colorCircle: "#5285E1",
        round: true,
        stroke: 6,
    };

    const global = new CircularProgressBar("global", globalConfig);
    global.initial();

    // update global example when change range
    const pieGlobal = document.querySelectorAll(".global");
    range.addEventListener("input", (e) => {
        pieGlobal.forEach((el, index) => {
            const options = {
                index: index + 1,
                percent: e.target.value
            };
            global.animationTo(options);
        });
    });
});


$(document).ready(function() {
    $(".toa").fadeIn(400).delay(1500).fadeOut(400);
});

function printData() {
    var divToPrint = document.getElementById("printContent");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}



$("print-btn").on("click", function() {
    printData();
});



document.querySelectorAll(".menu-link").forEach((link) => {
    if (link.href === window.location.href) {
        link.classList.add("active");
    }
});



// Select thead titles from Dom
const headCol1 = document.querySelector(".responsive-table__head__title--1");
const headCol2 = document.querySelector(".responsive-table__head__title--2");
const headCol3 = document.querySelector(".responsive-table__head__title--3");
const headCol4 = document.querySelector(".responsive-table__head__title--4");
const headCol5 = document.querySelector(".responsive-table__head__title--5");
const headCol6 = document.querySelector(".responsive-table__head__title--6");
const headCol7 = document.querySelector(".responsive-table__head__title--7");

// Select tbody text from Dom
const bodyCol1 = document.querySelectorAll(".responsive-table__body__text--1");
const bodyCol2 = document.querySelectorAll(".responsive-table__body__text--2");
const bodyCol3 = document.querySelectorAll(".responsive-table__body__text--3");
const bodyCol4 = document.querySelectorAll(".responsive-table__body__text--4");
const bodyCol5 = document.querySelectorAll(".responsive-table__body__text--5");
const bodyCol6 = document.querySelectorAll(".responsive-table__body__text--6");
const bodyCol7 = document.querySelectorAll(".responsive-table__body__text--7");

// Select all tbody table row from Dom
const totalTableBodyRow = document.querySelectorAll(
    ".responsive-table__body .responsive-table__row"
);

// Get thead titles and append those into tbody table data items as a "data-title" attribute
for (let i = 0; i < totalTableBodyRow.length; i++) {
    bodyCol1[i].setAttribute("data-title", headCol1.innerText);
    bodyCol2[i].setAttribute("data-title", headCol2.innerText);
    bodyCol3[i].setAttribute("data-title", headCol3.innerText);
    bodyCol4[i].setAttribute("data-title", headCol4.innerText);
    bodyCol5[i].setAttribute("data-title", headCol5.innerText);
    bodyCol6[i].setAttribute("data-title", headCol6.innerText);
    bodyCol7[i].setAttribute("data-title", headCol7.innerText);
}



$(".dashb-card-value").each(function() {
    $(this)
        .prop("Counter", 0)
        .animate({
            Counter: $(this).text(),
        }, {
            duration: 2200,
            easing: "swing",
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
        });
});



$(document).ready(function() {
    $("#jqDataTable").DataTable({
        select: false,
        columnDefs: [{
            className: "Name",
            visible: false,
            searchable: false,
        }, ],
        lengthMenu: [
            [10, 25, 50, -1],
            [5, 10, 25, 50, 'All'],
        ],
    }); //End of create main table

    $(function() {
        $('.dataTables_length select').addClass('form-select');
        $('.dataTables_filter input').addClass('form-control subjectFieldForm-control');
    });
});

$(document).ready(function() {
    let addSubInputCounter = 1;

    $('#addSub1').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter++;
        $('#dynamic_field1').append('<div class="subjectFieldWrapper mb-24" id="addSem1Sub' + addSubInputCounter + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter + ' Name"  name="subName1[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter + ' Code"  name="subCode1[]"><select class="form-select" name="subType1[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter >= 1) {
            $(".btn_remove1").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove1', function() {
        addSubInputCounter--;
        $("#dynamic_field1").children().last().remove();
        if (addSubInputCounter <= 1) {
            $(".btn_remove1").addClass('d-none');
        }
    });



    let addSubInputCounter2 = 1;

    $('#addSub2').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter2++;
        $('#dynamic_field2').append('<div class="subjectFieldWrapper mb-24" id="addSem2Sub' + addSubInputCounter2 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter2 + ' Name"  name="subName2[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter2 + ' Code"  name="subCode2[]"><select class="form-select" name="subType2[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter2 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter2 >= 1) {
            $(".btn_remove2").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove2', function() {
        addSubInputCounter2--;
        $("#dynamic_field2").children().last().remove();
        if (addSubInputCounter2 <= 1) {
            $(".btn_remove2").addClass('d-none');
        }
    });



    let addSubInputCounter3 = 1;

    $('#addSub3').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter3++;
        $('#dynamic_field3').append('<div class="subjectFieldWrapper mb-24" id="addSem3Sub' + addSubInputCounter3 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter3 + ' Name"  name="subName3[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter3 + ' Code"  name="subCode3[]"><select class="form-select" name="subType3[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter3 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter3 >= 1) {
            $(".btn_remove3").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove3', function() {
        addSubInputCounter3--;
        $("#dynamic_field3").children().last().remove();
        if (addSubInputCounter3 <= 1) {
            $(".btn_remove3").addClass('d-none');
        }
    });




    let addSubInputCounter4 = 1;

    $('#addSub4').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter4++;
        $('#dynamic_field4').append('<div class="subjectFieldWrapper mb-24" id="addSem4Sub' + addSubInputCounter4 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter4 + ' Name"  name="subName4[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter4 + ' Code"  name="subCode4[]"><select class="form-select" name="subType4[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter4 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter4 >= 1) {
            $(".btn_remove4").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove4', function() {
        addSubInputCounter4--;
        $("#dynamic_field4").children().last().remove();
        if (addSubInputCounter4 <= 1) {
            $(".btn_remove4").addClass('d-none');
        }

    });



    let addSubInputCounter5 = 1;

    $('#addSub5').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter5++;
        $('#dynamic_field5').append('<div class="subjectFieldWrapper mb-24" id="addSem5Sub' + addSubInputCounter5 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter5 + ' Name"  name="subName5[]"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter5 + ' Code"  name="subCode5[]"><select class="form-select" name="subType5[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter5 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter5 >= 1) {
            $(".btn_remove5").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove5', function() {
        addSubInputCounter5--;
        $("#dynamic_field5").children().last().remove();
        if (addSubInputCounter5 <= 1) {
            $(".btn_remove5").addClass('d-none');
        }
    });



    let addSubInputCounter6 = 1;

    $('#addSub6').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter6++;
        $('#dynamic_field6').append('<div class="subjectFieldWrapper mb-24" id="addSem6Sub' + addSubInputCounter6 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter6 + ' Name"  name="subName6[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter6 + ' Code"  name="subCode6[]"><select class="form-select" name="subType6[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter6 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter6 >= 1) {
            $(".btn_remove6").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove6', function() {
        addSubInputCounter6--;
        $("#dynamic_field6").children().last().remove();
        if (addSubInputCounter6 <= 1) {
            $(".btn_remove6").addClass('d-none');
        }
    });



    let addSubInputCounter7 = 1;

    $('#addSub7').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter7++;
        $('#dynamic_field7').append('<div class="subjectFieldWrapper mb-24" id="addSem7Sub' + addSubInputCounter7 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter7 + ' Name"  name="subName7[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter7 + ' Code"  name="subCode7[]"><select class="form-select" name="subType7[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter7 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter7 >= 1) {
            $(".btn_remove7").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove7', function() {
        addSubInputCounter7--;
        $("#dynamic_field7").children().last().remove();
        if (addSubInputCounter7 <= 1) {
            $(".btn_remove7").addClass('d-none');
        }
    });


    let addSubInputCounter8 = 1;

    $('#addSub8').click(function() {
        console.log("it's working.. :)");
        addSubInputCounter8++;
        $('#dynamic_field8').append('<div class="subjectFieldWrapper mb-24" id="addSem8Sub' + addSubInputCounter8 + '"><input type="text" class="form-control subjectFieldForm-control" placeholder="Enter Subject ' + addSubInputCounter8 + ' Name"  name="subName8[]"><input type="text" class="form-control subjectFieldForm-control" placeholder=" Enter Subject ' + addSubInputCounter8 + ' Code"  name="subCode8[]"><select class="form-select" name="subType8[]"> <option disabled selected value="default">Select Subject ' + addSubInputCounter8 + ' Type</option> <option>Theory</option> <option>Practical</option></select></div>');
        if (addSubInputCounter8 >= 1) {
            $(".btn_remove8").removeClass('d-none');
        }
    });

    $(document).on('click', '.btn_remove8', function() {
        addSubInputCounter8--;
        $("#dynamic_field8").children().last().remove();
        if (addSubInputCounter8 <= 1) {
            $(".btn_remove8").addClass('d-none');
        }
    });
});

// $(document).ready(function() {
//     if ($(".checkBoxCheck").is(":checked")) {

//     }
// });

for (i = new Date().getFullYear(); i > 1990; i--) {
    $('#studentBatch').append($('<option />').val(i).html(i));
}

$(document).ready(function() {
    $('#studentTableList').DataTable({
        select: false,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "columnDefs": [{
            className: "Name",
            "visible": false,
            "searchable": false
        }],
        "info": false
    }); //End of create main table

    $(".btn_remove8").addClass('d-none');
});