document.getElementById("userForm").addEventListener("submit", function (event) {
    clearErrorMessages();

    var nameInput = document.getElementById("name");
    if (nameInput.value.trim() === "") {
        displayError("Name is required");
        event.preventDefault();
    }

    var emailInput = document.getElementById("email");
    if (!isValidEmail(emailInput.value)) {
        displayError("Invalid email address");
        event.preventDefault();
    }

    var ageInput = document.getElementById("age");
    var age = parseInt(ageInput.value, 10);
    if (isNaN(age) || age <= 0) {
        displayError("Age must be a positive integer");
        event.preventDefault();
    }

});

function calculateAge() {
    var dobInput = document.getElementById("dob").value;
    var dob = new Date(dobInput);
    var today = new Date();

    var age = today.getFullYear() - dob.getFullYear();

    if (today.getMonth() < dob.getMonth() ||
        (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
        age--;
    }

    document.getElementById("age").value = age;
}

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function displayError(message) {
    var errorMessageContainer = document.getElementById("errorMessages");
    var errorParagraph = document.createElement("p");
    errorParagraph.textContent = message;
    errorMessageContainer.appendChild(errorParagraph);
}

function clearErrorMessages() {
    var errorMessageContainer = document.getElementById("errorMessages");
    errorMessageContainer.innerHTML = ""; // Clear existing error messages
}
