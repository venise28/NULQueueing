function updateAvailabilityIcon() {
    var select = document.getElementById("availability");
    var statusIndicator = document.getElementById("status-indicator");
    var selectedValue = select.value;

    statusIndicator.classList.remove("available", "unavailable");

    if (selectedValue === "available") {
      statusIndicator.classList.add("available");
    } else if (selectedValue === "unavailable") {
      statusIndicator.classList.add("unavailable");
    }
    // Update the status in the database via AJAX
    $.ajax({
            type: "POST",
            url: "update_status.php", // URL to the script that updates the status
            data: { status: selectedValue }, // Send the selected status value
            success: function(response) {
                if (response === "success") {
                    // Status updated successfully
                    console.log("Status updated successfully.");
                } else {
                    console.log("Status updated successfully.");
                }
            }
        });
  }

  function toggleProfileDropdown() {
    var dropdown = document.getElementById("profile-dropdown-content");
    dropdown.classList.toggle("show");
  }

  function stopPropagation() {
    event.stopPropagation();
  }

  function filterByProgram(program) {
    // Use AJAX to fetch data based on the selected program
    $.ajax({
        type: "GET",
        url: "fetch_data.php",
        data: { program: program },
        success: function (response) {
            
            $("#").html(response);
        },
    });
}

function fetchInfo(queueNumber) {
  // Send an AJAX request to fetch data for the clicked queue_number
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);

          // Update the HTML elements with fetched data
          document.getElementById('info-queue-number').textContent = data.queue_number;
          document.getElementById('info-queue-time').textContent = "Queued in " + data.queue_time;
          document.getElementById('info-remarks').textContent = data.remarks;
          document.getElementById('info-student').textContent = data.studentid;
          document.getElementById('info-endorse').textContent = data.endorse;
          document.getElementById('info-transaction').textContent = data.transaction;
          document.getElementById('student-id').value = data.studentid;
          document.getElementById('queue-number').textContent = data.queue_number;
          document.getElementById('form-queue-number').value = data.queue_number;
          document.getElementById('info-queue-timestamp').textContent = data.timestamp;
          // Add more code to update other elements if needed
      }
  };
  xhr.open('POST', 'fetch_info.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('queue_number=' + queueNumber);

  // Prevent the default button behavior
  event.preventDefault();
}

  function logout() {
      $.ajax({
          type: "POST",
          url: "logout.php", // URL to the logout script
          success: function (response) {
              if (response === "success") {
                  // Redirect to a success page or perform desired action
                  window.location.href = "login.html"; // Redirect to the login page
              } else {
                  // Display an error message
                  alert("Logout failed. Please try again.");
              }
          }
      });
  }

  window.onclick = function (event) {
    if (!event.target.matches(".fa-user-circle")) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains("show")) {
          openDropdown.classList.remove("show");
        }
      }
    }
  };

  // Select the button and modal elements
  const modalBg = document.querySelector('.modal-bg');
  const formModal = document.querySelector('.form-modal');
  const doneModal = document.querySelector('.done-modal');
  const confirmModal = document.querySelector('.confirm-modal');

  const endorseButton = document.getElementById('endorseButton');
  const cancelButton = document.getElementById('cancelButton');
  const doneButton = document.getElementById('doneButton');


  const exitButton = document.getElementById('ext-div');
  const nextButton = document.getElementById('nxt-div');
  const confirmButton = document.getElementById('confirm-done-btn');

  const endorseForm = document.querySelector('.modform-div');
  const doneDiv = document.getElementById('done-div');
  const confirmDiv = document.getElementById('confirm-div');
  

  


  endorseButton.addEventListener('click', () => {
    // Toggle the display property of modal elements
    modalBg.style.display = 'flex';
    formModal.style.display = 'flex';
    endorseForm.style.display = 'block';
  });

  // Add a click event listener to the cancel button
  cancelButton.addEventListener('click', (event) => {
    event.preventDefault(); 
    document.getElementById('office').value = 'select';
    document.getElementById('transaction').value = 'select';
    document.getElementById('remarks-form').value = '' ;
    // Toggle the display property of modal elements to hide the modal
    modalBg.style.display = 'none';
    formModal.style.display = 'none';
    endorseForm.style.display = 'none';
});



document.getElementById("doneButton").addEventListener("click", function () {
  // Get the form data
  const form = document.getElementById("endorseForm");
  const formData = new FormData(form);

  fetch("process_form.php", {
      method: "POST",
      body: formData,
  })
      .then((response) => response.text())
      .then(() => {
        const office = document.getElementById("office").value;
        const transaction = document.getElementById("transaction").value;

        
        if (office === 'select' || transaction === 'select') {
          alert("Please select both 'Endorsed To' and 'Transaction' options.");
        } else {
          // Continue with your code
          document.getElementById('Confirm-modal').textContent = office.toUpperCase();
          formModal.style.display = 'none'; 
          confirmModal.style.display = 'flex';
          console.log("Success");
        }
      })
      .catch((error) => {
          console.error("Error:", error);
      });
});

  document.getElementById("confirm-done-btn").addEventListener("click", function () {
    const queueNumber = document.getElementById("form-queue-number").value;

    if (queueNumber) {
        fetch("delete_queue.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "queue_number=" + queueNumber,
        })
            .then((response) => response.text())
            .then(() => {

                document.getElementById('info-queue-number').textContent = "Welcome!";
                document.getElementById('info-queue-time').textContent = "please select queue number" ;
                document.getElementById('info-student').textContent = "";
                document.getElementById('info-transaction').textContent = "";
                document.getElementById('info-endorse').textContent = "";
                document.getElementById('info-remarks').textContent = "";


                doneModal.style.display = 'flex';
                doneDiv.style.display = 'flex';
                confirmModal.style.display = 'none'; // Hide the form modal
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});

  exitButton.addEventListener('click', (event) => {
    event.preventDefault(); 
    document.getElementById('office').value = 'select';
    document.getElementById('transaction').value = 'select';
    document.getElementById('remarks-form').value = '' ;
    // Toggle the display property of modal elements to hide the modal
    modalBg.style.display = 'none';
    doneModal.style.display = 'none';
    doneDiv.style.display = 'none';
  });

  // For new notification slide

 

  function closeNotification() {
    var notification = document.getElementById("notification");
    notification.style.right = "-400px"; // Slide out to the right
  }
  
  function showNotification(newQueueNumber) {
    var notificationContainer = document.getElementById("notification");
    notificationContainer.querySelector("b").textContent = newQueueNumber;
    notificationContainer.style.right = "20px";
    notificationContainer.style.display = "block";
}

function checkForNewQueueNumber() {
    $.ajax({
        type: "POST",
        url: "notification_queue.php",
        data: {},
        success: function (data) {
            if (data && data.newQueueNumber) {
                showNotification(data.newQueueNumber);
            }
        },
        error: function (error) {
            console.error("Error fetching new queue number: " + error);
        }
    });
}


setInterval(checkForNewQueueNumber, 8000);


  //fetching data from the database
  function fetchDataAndPopulate() {
    // Get the selected program and concern
    var selectedProgram = document.getElementById("program-filter").value;
    var selectedConcern = document.getElementById("concern-filter").value;

    $.ajax({
        type: "GET",
        url: "fetch_data.php",
        data: { program: selectedProgram, concern: selectedConcern }, // Include concern parameter
        success: function (response) {
            $("#tn-list").html(response);
        },
        error: function () {
            // Handle any errors
            alert("Failed to fetch data.");
        }
    });
}


// Call the function when needed, for example, when the page loads
$(document).ready(function () {
    fetchDataAndPopulate();
    setInterval(fetchDataAndPopulate, 1000);
});


function notifyFront() {
  // Get the queuenumber from somewhere, e.g., an input field or a variable
  var queuenumber = document.getElementById("info-queue-number").textContent; // Replace with your queuenumber

  // Send an AJAX request to update the status
  $.ajax({
      type: "POST",
      url: "notifyFront.php", // URL to the server-side script
      data: { queuenumber: queuenumber },
      success: function(response) {
          if (response === "success") {
              alert("Status updated successfully.");
              console.log("Status updated successfully.");
          } else {
              alert("Status update failed. Please contact admin.");
              console.log("Status update failed. Please try again.");
          }
      },
      error: function() {
          alert("An error occurred. Please try again.");
      }
  });
  
}

$(document).ready(function() {
  $("#end-button").on("click", function() {
      // Get data from the elements
      var queueNumber = $("#info-queue-number").text();
      var queueTime = $("#info-queue-timestamp").text();
      var studentInfo = $("#info-student").text();
      var transactionInfo = $("#info-transaction").text();
      var endorsementInfo = $("#info-endorse").text();

      // AJAX request to send data to end.php
      $.ajax({
          url: "end.php",
          type: "POST",
          data: {
              queueNumber: queueNumber,
              queueTime: queueTime,
              studentInfo: studentInfo,
              transactionInfo: transactionInfo,
              endorsementInfo: endorsementInfo
          },
          success: function(response) {
              // Handle the response from the server if needed
              console.log(response);
                document.getElementById('info-queue-number').textContent = "Welcome!";
                document.getElementById('info-queue-time').textContent = "please select queue number" ;
                document.getElementById('info-student').textContent = "";
                document.getElementById('info-transaction').textContent = "";
                document.getElementById('info-endorse').textContent = "";
                document.getElementById('info-remarks').textContent = "";
          },
          error: function(error) {
              // Handle errors if any
              console.log(error);
          }
      });
  });
});


