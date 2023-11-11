<?php
@include '../database.php';
session_start();

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SADMIN DASHBOARD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/offices.css">
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../script/script.js"></script>


    <div class="container-fluid">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>



            $(document).ready(function () {

                document.getElementById('btn-print-this').addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent the form from being submitted
                });

                selectOffice = document.querySelector('#officeSelect');
                officeout = selectOffice.value;
                document.querySelector('.officeout').textContent = officeout;


                var e = document.getElementById("monthSelectStart");
                monthout = e.options[e.selectedIndex].text;
                document.querySelector('.monthout').textContent = monthout;

                selectYear = document.querySelector('#yearSelect');
                yearout = selectYear.value;
                document.querySelector('.yearout').textContent = yearout;

                $("#monthSelectStart").on("change", function () {

                    var e = document.getElementById("monthSelectStart");
                    monthout = e.options[e.selectedIndex].text;
                    document.querySelector('.monthout').textContent = monthout;

                });

                $("#monthSelectEnd").on("change", function () {

                    var e = document.getElementById("monthSelectEnd");
                    monthoutend = 'to ' + e.options[e.selectedIndex].text;
                    document.querySelector('.monthoutend').textContent = monthoutend;

                });

                $("#yearSelect").on("change", function () {

                    var e = document.getElementById("yearSelect");
                    yearout = ' ' + e.options[e.selectedIndex].text;
                    document.querySelector('.yearout').textContent = yearout;

                });

                $("#monthSelectStart, #monthSelectEnd, #yearSelect, #officeSelect").on("change", function () {
                    // Get selected month and office values
                    var selectedMonthStart = $("#monthSelectStart").val();
                    var selectedMonthEnd = $("#monthSelectEnd").val();
                    var selectedOffice = $("#officeSelect").val();
                    var selectedYear = $("#yearSelect").val();

                    // Perform an AJAX request to retrieve updated data
                    $.ajax({
                        type: "POST",
                        url: "update_chart.php",
                        data: {
                            monthstart: selectedMonthStart,
                            monthend: selectedMonthEnd,
                            office: selectedOffice,
                            year: selectedYear
                        },
                        success: function (response) {
                            // Update the content div with the updated data
                            const newData = JSON.parse(response);
                            myChart.data.datasets[0].data = newData.customer;
                            myChart.data.labels = newData.week;
                            myChart.update();
                            console.log(newData.customer);
                        }
                    });
                });


            });
        </script>


        <div class="row">


            <?php include 'aside.php'; ?>

            <div class="col-9 offset-3">

                <h4 class="fs-2 pt-5 ps-5 pb-2 nu_color text-start">REPORT</h4>
                <hr>

                <h4 class="fs-2 pt-3 ps-5 pb-2 nu_color text-center"> Please select an office to generate a report </h4>

                <div class="text-center">
                    <form action="export.php" method="post">
                        <select class="form-select-sm" name="officeSelect" id="officeSelect"
                            aria-label="Default select example">
                            <?php
                            @include 'database.php';
                            $sql = "SELECT * FROM offices";
                            $result = $conn->query($sql);
                            ?>
                            <option value="ALL-OFFICES">All Offices</option>

                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $officeName = $row["officeName"];
                                    echo '<option value="' . $officeName . '">' . $officeName . '</option>';
                                }
                            } else {
                                echo '<option value="">No offices available</option>';
                            }
                            ?>
                        </select>
                        <select class="form-select-sm" name="monthSelectStart" id="monthSelectStart"
                            aria-label="Default select example">
                            <option selected value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>

                        -

                        <select class="form-select-sm" name="monthSelectEnd" id="monthSelectEnd"
                            aria-label="Default select example">
                            <option selected value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>

                        <select class="form-select-sm" name="yearSelect" id="yearSelect"
                            aria-label="Default select example">
                            <option selected value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>

                        <button id="btn-print-this" class="btn btn-success btn-sm"> Print
                        </button>


                        <input type="submit" value="Export CSV">
                    </form>


                </div>


                <div id="content">

                    <div class="row justify-content-center mt-5" style="height:35vh; width:auto;">
                        <span class="officeout text-center fs-5 fw-bold nu_color"></span>
                        <div style="display: inline-block;" class="text-center">
                            <span class="monthout text-center fs-5 fw-bold nu_color"></span>
                            <span class="monthoutend text-center fs-5 fw-bold nu_color"></span>
                            <span class="yearout text-center fs-5 fw-bold nu_color"></span>
                        </div>

                        <?php
                        $tquery = $conn->query("SELECT week.week_name, 
                        IFNULL(AVG(timeout - timestamp), 0) AS average_time
                 FROM (
                     SELECT 'WEEK 1' AS week_name
                     UNION
                     SELECT 'WEEK 2' AS week_name
                     UNION
                     SELECT 'WEEK 3' AS week_name
                     UNION
                     SELECT 'WEEK 4' AS week_name
                 ) AS week
                 LEFT JOIN academics_logs al ON
                     (DAY(al.timestamp) BETWEEN 
                         CASE week.week_name
                             WHEN 'WEEK 1' THEN 1
                             WHEN 'WEEK 2' THEN 8
                             WHEN 'WEEK 3' THEN 15
                             WHEN 'WEEK 4' THEN 22
                         END
                     AND
                         CASE week.week_name
                             WHEN 'WEEK 1' THEN 7
                             WHEN 'WEEK 2' THEN 14
                             WHEN 'WEEK 3' THEN 21
                             WHEN 'WEEK 4' THEN DAY(LAST_DAY(al.timestamp))
                         END)
                     AND MONTH(al.timestamp) = 10
                 GROUP BY week.week_name;
                                            ");

                        foreach ($tquery as $data) {
                            $name[] = $data['week_name'];
                            $time[] = $data['average_time'];
                        }
                        ?>


                        <canvas class="align-items-center" id="myChartBar"></canvas>
                        <canvas class="align-items-center" id="myLineChart"></canvas>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>

                            const ctx1 = document.getElementById('myLineChart');

                            new Chart(ctx1, {
                                type: 'line',
                                data: {
                                    labels: <?php echo json_encode($name) ?>,
                                    datasets: [{
                                        label: 'Time',
                                        data: <?php echo json_encode($time) ?>,
                                        borderColor: "#3EDAD8",
                                        backgroundColor: ["#3EDAD8", "#3EDAD8", "#2D8BBA", "#2F5F98", "#2C92D5"],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'AVERAGE TIME PER WEEK',
                                        }
                                    }
                                }
                            });

                            const ctx2 = document.getElementById('myChartBar');

                            const myChart = new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: ["WEEK 1", "WEEK 2", "WEEK 3", "WEEK 4"],
                                    datasets: [{
                                        label: 'Customers',
                                        data: ["0", "0", "0", "0"],
                                        backgroundColor: ["#34418E"],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    indexAxis: 'y',
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'CUSTOMERS PER WEEK',
                                        }
                                    }
                                }

                            });




                        </script>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    </div>

                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="chart.js"></script>
            <script src="../script/printThis.js"></script>
            <script src="../script/custom.js"></script>
        </div>
</body>


</html>