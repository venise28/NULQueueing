<?php
session_start(); // Start the session if it hasn't already been started

if (isset($_SESSION["full_name"]) && isset($_SESSION["username"]) && isset($_SESSION["office"])) {
  $full_name = $_SESSION["full_name"];
  $username  = $_SESSION["username"];
  $office  = $_SESSION["office"];

  // Set the default concern in the session during login
  echo "<script> alert('successfully logged in. Welcome, $full_name!\\n\\nOffice: $office' )</script>";
} else {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/header.css" />
  <link rel="stylesheet" type="text/css" href="css/notification.css" />
  <link rel="stylesheet" type="text/css" href="css/tn-list.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script
    src="https://kit.fontawesome.com/bd6fee4447.js"
    crossorigin="anonymous"
  ></script>
  <title>Academics Queue</title>
</head>
<html>
  <body>
    <header>
      <div class="logo-div">
        <img src="img/nu_logo.png" class="logo" />
        <!-- <div class="availability-icon" id="availability-icon"></div> -->
        <div>
          <h1>NU LAGUNA</h1>
          <p>QUEUEING SYSTEM</p>
        </div>
      </div>

      <!-- Profile Icon -->
      <div class="profile-div">
        <i
          class="fa fa-user-circle"
          id="profile-icon"
          onclick="toggleProfileDropdown()"
        ></i>
        <!-- Availability Status Indicator -->
        <div class="status-indicator" id="status-indicator"></div>
        <!-- Dropdown Content -->

        <div class="dropdown-content" id="profile-dropdown-content">
          <div class="profile-info">
            <div class="left-align">
              <div class="profile-info">
                <div class="profile-icon">
                  <i class="fa fa-user-circle fa-fade"></i>
                </div>
                <div class="profile-details">
                  <span id="profile-name">
                    <?php
                      if (isset($_SESSION['full_name'])) {
                        echo $_SESSION['full_name'];
                      } else {
                        echo 'Guest'; // Display a default value if the session is not set
                      }
                      ?>
                  </span><br />
                  <span class="availability-dropdown">
                  <select
                    id="availability"
                    onchange="updateAvailabilityIcon()"
                    onclick="stopPropagation()"
                  >
                    <option value="available"> 
                      <span class="status-dot status-online"></span>🟢 Available
                    </option>
                    <option value="unavailable">
                      <span class="status-dot status-offline"></span>⚪ Unavailable
                    </option>
                  </select>
                  </span>
                </div>
              </div>
              <hr class="dropdown-line" />
              
              <i class="fa-solid fa-arrow-right-from-bracket" style="margin-left: 20px; margin-bottom:20px;"></i>
              <a href="#" onclick="logout()" class="left-align">Log out</a>
            </div>
          </div>
        </div>
      </div>
    </header>

  <div class="main-div">
    <div class="tn-div">
      <div class="tn-header">
        <h2>ACADEMICS QUEUEING</h2>
      </div>
      <!-- Program filter dropdown -->
      <div style="display: flex; margin-bottom: 10px;">
        <select id="program-filter" onchange="populateConcernFilter(this.value); filterByProgram()" style="width: 100%; padding: 5px; ">

            <!-- <select id="program-filter" onchange="populateConcernFilter(this.value)"> -->
            <option value="" selected disabled>➕ Program</option>
            <?php
            // Include your database connection file (db_connection.php)
            include("db_connection.php");

            // Fetch program options from the academics_queue table
            $programQuery = "SELECT DISTINCT program FROM academics_queue";
            $programResult = $conn->query($programQuery);

            while ($row = $programResult->fetch_assoc()) {
                echo "<option value='" . $row['program'] . "'>" . $row['program'] . "</option>";
            }

            $conn->close();
            ?>
        </select>
        <!-- Concern filter dropdown -->
        <select id="concern-filter" onchange="filterByConcern()" style="width: 100%;">
                <!-- Options for concern filter -->
            <!-- Options will be dynamically populated using JavaScript -->
            <option value="" selected></option>
        </select>
        <button onclick="refreshQueue()" style="padding: 5px;">Default</button>
      </div>
      <div id="tnn" style="overflow-y: auto; height: 100%;">
      <!-- Container to display queue-numbers -->
      <div id="tn-list"  class="tn-list"></div>
      </div>

    </div> <!--End of tn-div-->

    <div class="form-div">
        <div class="newque-div">
          <button id="new-queue-button">New Queue <i class="fa-solid fa-square-plus"></i></button>
        </div>
        <div class="info-div">
          <!--Start of info-->
        <h1 id="info-queue-number">Welcome!</h1>
        <div class="time-div">
            <p><i id="info-queue-time">please select queue number</i></p>
            <p hidden><i id="info-queue-timestamp">please select queue number</i></p>
        </div>
        <br /><br />
        <div class="stdID-div">
                      
            <p><b>Student I.D:</b> 
            <b><span id="info-student"></span></b>
            </p>
        </div>

        <div class="stdID-div">
                      
            <p><b>Transaction:</b> 
            <span id="info-transaction"></span>
            </p>
        </div>

        
        <div class="stdID-div">
          
            <p><b>Endorsed from:</b> 
            <span id="info-endorse"></span>
            </p>
        </div>

        <div class="rmk-div">
            <p><b>Remarks:</b></p>
            <div class="msg-div">
              <p> 
              <span id="info-remarks"></span><!--remarks-->
              </p>
            </div>
       
          <div class="btn-div">
            <button onclick="notifyFront()"><i class="fa-solid fa-bell"></i> NOTIFY</button>
            <button id="endorseButton">ENDORSE TO</button>
            <button id="end-button"><i class="fa-solid fa-times-circle"></i>END</button>
          </div>
        </div>
        <!--End of info-div-->
    </div><!--End of form-div-->
    
  </div><!--End of main-div>-->

    <div class="modal-bg">
      <div class="form-modal" id="formModal">
          <div class="modform-div">
              <h1>ENDORSING FORM</h1>
              <form id="endorseForm">
                  <input type="hidden" id="form-queue-timestamp" name="form-queue-timestamp" required />
                  <input type="hidden" id="form-queue-number" name="form-queue-number" required />
                  <div class="mema">
                      <label><b>Student I.D: </b></label>
                      <input type="text" id="student-id" name="student_id" required />
                  </div>

                  <div class="mema">
                      <label><b>Endorsed To: </b></label>
                      <select id="office" name="office" required>
                          <option value="select" disabled selected>Please Select</option>
                          <option value="accounting">ACCOUNTING</option>
                          <option value="registrar">REGISTRAR</option>
                      </select>
                  </div>

                  <div class="mema">
                      <label><b>Transaction: </b></label>
                      <select id="transaction" name="transaction" required>
                          <option value="select" disabled selected>Please Select</option>
                          <option value="accounting">Payment</option>
                          <option value="admission">Others</option>
                      </select>
                  </div>

                  <div class="rms">
                      <label><b>Remarks: </b></label>
                      <textarea id="remarks-form" name="remarks" rows="4" cols="50"></textarea>
                  </div>

                  <div class="modbtn-div">
                      <button id="cancelButton">CANCEL</button>
                      <button type="button" id="doneButton">DONE</button>
                  </div>
              </form>
          </div>
      </div>

      <div class="confirm-modal">
        <div class="confirm-div">
            <h1 id="Confirm-modal">REGISTRAR</h1>
            <p><i>Please proceed to the Registrar's Office. Your tracking number is:</i></p>
            <span id='queue-number'></span>
        </div>

        <div class="confirm-btn">
            <button id="confirm-done-btn">DONE</button>
        </div>
    </div>

      <div class="done-modal">
        <div class="done-div" id="done-div">
          <div class="text-div">
            <i class="fa-solid fa-circle-check"></i>
            <h1>ENDORSED SUCCESSFULLY</h1>
          </div>

          <div class="done-btn">
            <button class="nxt-btn" id="ext-div">EXIT</button>
          </div>
        </div>
      </div>
    </div>

    <!-- For new notification slide -->

    <div class="notification-container" id="notification">
      <img src="img/horn.png" />
      <div class="notification-content">
        <p class="new-tm">NEW TRACKING NUMBER!</p>
        <p style="margin-top: 1px"><b>Loading...</b></p>
      </div>
        <span class="close-button" onclick="closeNotification()">
        <i class="fas fa-xmark"></i>
        </span>
    </div>
    <!-- For new notification slide -->


    <script src="./js/scripts.js"></script>



    <script>

    function populateConcernFilter(program) {
        $.ajax({
            type: "GET",
            url: "fetch_concerns.php",
            data: { program: program },
            success: function (response) {
                $("#concern-filter").html(response);
                filterByProgram(); // Automatically trigger data fetching when the concern filter is populated
            },
            error: function (error) {
                console.error("Error fetching concerns:", error);
            }
        });
    }
    

    function filterByProgram() {
    var selectedProgram = $("#program-filter").val();
    var selectedConcern = $("#concern-filter").val();

    $.ajax({
        type: "GET",
        url: "fetch_data.php",
        data: { program: selectedProgram, concern: selectedConcern },
        success: function (response) {
            $("#tn-list").html(response);
            
        },
        error: function (error) {
            console.error("Error fetching data:", error);
        }
    });
    } 



    function filterByConcern() {
        filterByProgram(); // Call the same function when the concern filter is changed
    }


   
      
        function fetchDefaultConcernQueueNumbers() {
            // Assuming you have a PHP script (e.g., fetch_default_concern.php) to fetch queue numbers
            $.ajax({
                type: "GET",
                url: "fetch_default_concern.php",
                success: function (response) {
                    $("#tn-list").html(response);
                },
                error: function () {
                    // Handle any errors
                    alert("Failed to fetch default concern data.");
                }
            });
        }



        function refreshQueue() {
    // Reset program and concern filters to default values
    $("#program-filter").val("");
    $("#concern-filter").val("");

    // Fetch and display default concern queue numbers
    fetchDefaultConcernQueueNumbers();
}


</script>

  </body>
</html>