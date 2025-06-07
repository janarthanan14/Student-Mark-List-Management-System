<?php $title = "dashboard"; ?>

<?php include 'header.php' ?>

<!-- db-checker -->

<?php if (!$conn) { ?>

    <div class="toa">

        <div id="t2">
            failed to connect to database.. :(
        </div>

    </div>

<?php } else { ?>

    <div class="toa">

        <div id="t1">
            Database successfully connected.. :)
        </div>

    </div>

<?php } ?>

<main class="content dashb-content">

    <div class="dashb-card-wapper">
        <div class="dashb-card student-card">
            <h3 class="dashb-card-title">Students</h3>
            <p class="dashb-card-value">2332</p>
        </div>
        <div class="dashb-card staff-card">
            <h3 class="dashb-card-title">Staff's</h3>
            <p class="dashb-card-value">42</p>
        </div>
        <div class="dashb-card course-card">
            <h3 class="dashb-card-title">Course</h3>
            <p class="dashb-card-value">20</p>
        </div>
        <div class="dashb-card schedule-card pin red-pin">
            <h3 class="dashb-schedule-title"><?php echo date("d/m/Y") . " Schedule";?></h3>
            <p>1. Metting with Staff's</p>
            <p>2. Tour Plan for Students</p>
        </div>
    </div>

    <div class="over-view">

        <div class="admission">
            <h3 class="over-view-title">Admission</h3>
            <div class="circular-progress-bar">
                <div class="global" data-pie='{ "percent": 89, "colorSlice": "#BF360C", "colorCircle": "#f1f1f1"}'>
                </div>
            </div>
        </div>

        <div class="fees">
            <h3 class="over-view-title">Fee collection</h3>
            <div class="circular-progress-bar">
                <div class="global" data-pie='{ "percent": 70,  "colorCircle": "#f1f1f1"}'></div>
            </div>
        </div>

        <div class="syllabus">
            <h3 class="over-view-title">Syllabus</h3>
            <div class="circular-progress-bar">
                <div class="global" data-pie='{ "percent": 80, "colorSlice": "#00ac48", "colorCircle": "#f1f1f1"}'>
                </div>
            </div>
        </div>

        <div class="sports">
            <h3 class="over-view-title">Sports Activity</h3>
            <div class="circular-progress-bar">
                <div class="global" data-pie='{ "percent": 60,"colorSlice": "#ff0030", "colorCircle": "#f1f1f1"}'></div>
            </div>
        </div>

    </div>

</main>

<?php include 'footer.php' ?>