// Simple login form validation
function validateLoginForm() {
    let uname = document.forms["loginForm"]["username"].value;
    let pwd = document.forms["loginForm"]["password"].value;

    if (uname === "" || pwd === "") {
        alert("Both fields are required!");
        return false;
    }
    return true;
}

// Feedback submission success message
function feedbackSubmitted() {
    alert("Thanks for your feedback!");
}

// Complaint submission success
function complaintSubmitted() {
    alert("Your complaint has been submitted successfully.");
}