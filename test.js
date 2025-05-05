document.getElementById('loginForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const messageElement = document.getElementById('message');

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password })
        });

        const data = await response.json();

        if (data.success) {
            // Redirect on successful login
            window.location.href = data.redirect;
        } else {
            // Show error message
            messageElement.innerText = data.message || 'Login failed';
        }
    } catch (error) {
        messageElement.innerText = 'An error occurred during login';
        console.error('Login error:', error);
    }
});