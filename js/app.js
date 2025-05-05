document.getElementById('appointmentForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const name = document.getElementById('customer-name').value;
    const email = document.getElementById('customer-email').value;
    const service = document.getElementById('service').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    // Display confirmation message
    const confirmationMessage = `
        Thank you, ${name}! Your appointment for ${service} on ${date} at ${time} has been booked.
    `;
    document.getElementById('confirmation-message').innerText = confirmationMessage;

    // Optionally, you can reset the form after submission
    document.getElementById('appointmentForm').reset();
});