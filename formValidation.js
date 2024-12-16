// Function to validate the form
function validateForm() {
    // Get the form elements
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var errorMessages = [];

    // Validate first name
    if (firstName == "") {
        errorMessages.push("First name is required.");
    }

    // Validate last name
    if (lastName == "") {
        errorMessages.push("Last name is required.");
    }

    // Validate phone number
    if (phone == "") {
        errorMessages.push("Phone number is required.");
    }

    // Validate email
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (email == "") {
        errorMessages.push("Email is required.");
    } else if (!emailPattern.test(email)) {
        errorMessages.push("Please enter a valid email address.");
    }

    // If there are any errors, display them and prevent form submission
    if (errorMessages.length > 0) {
        var errorDiv = document.getElementById("errorMessages");
        errorDiv.innerHTML = "";
        errorMessages.forEach(function(message) {
            var p = document.createElement("p");
            p.textContent = message;
            errorDiv.appendChild(p);
        });
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
