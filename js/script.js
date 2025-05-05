function handleBooking(event) {
    event.preventDefault(); // Prevent the form from submitting

    const name = document.getElementById('name').value;
    const service = document.getElementById('service').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    // Simulate a booking process (replace this with actual functionality)
    alert(`Appointment booked!\nName: ${name}\nService: ${service}\nDate: ${date}\nTime: ${time}`);

    // Optionally, reset the form after submission
    document.getElementById('bookingForm').reset();
}