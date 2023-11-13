<?php
@include 'database.php';

$sql = "SELECT DISTINCT officeName FROM offices";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Queue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/displayqueue.css">
    <link href='http://fonts.googleapis.com/css?family=' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="main-container">
        <!-- TOP CONTAINER STARTS (NOW SERVING & DATETIME) -->
        <header class="heading-datetime-container">
            <div class="heading-container-serving">
                <h1 class="heading-text-serving">NOW SERVING</h1>
            </div>
            <div class="datetime-container">
                <h3 id="date"></h3>
                <h1 id="time"></h1>
            </div>
        </header>
        <!-- TOP CONTAINER ENDS (NOW SERVING & DATETIME) -->

        <!-- OFFICES WITH QUEUE STARTS -->
        <?php
        if ($result->num_rows > 0) {
            // Output a single section tag for all office containers
            echo '<section class="offices-container">';

            // Output office containers dynamically based on the data
            while ($row = $result->fetch_assoc()) {
                $officeName = $row["officeName"];

                // Fetch data for the current office
                $officeDataSql = "SELECT * FROM offices WHERE officeName = '$officeName'";
                $officeDataResult = $conn->query($officeDataSql);

                if ($officeDataResult->num_rows > 0) {
                    echo '<div class="' . $officeName . '-office-container office">';
                    echo '<div class="heading-container">';
                    echo '<h1 class="heading-text">' . $officeName . '</h1>';
                    echo '</div>';
                    echo '<div class="' . $officeName . '-queue-container">';

                    while ($officeRow = $officeDataResult->fetch_assoc()) {
                        echo '<div class="' . $officeName . '-queue queue">';
                        echo '<h2 class="queue-text">R001</h2>'; //paki delete na lang nito if yung pag generate dynamic na
                        // echo '<h2>' . $officeRow["queueNumber"] . '</h2>'; //eto ipapalit once na dynamic na yung pag generate
                        // echo '<h2>' . $officeRow["window"] . '</h2>'; // eto for window lagay na lang conditional if meron yung inyo or wala
                        echo '</div>';
                    }

                    echo '</div>'; // Close queue container
                    echo '</div>'; // Close office container
                }
            }

            // Close the section tag after all office containers
            echo '</section>';
        } else {
            echo "0 results";
        }
        ?>
        <!-- OFFICES WITH QUEUE ENDS -->


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/displayscript.js"></script>
</body>

</html>