function handleLoginSubmit(event) {
    event.preventDefault();
    console.log('Login form submitted');

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!email || !password) {
        alert('All fields are required!');
        return;
    }

    submitLogin(email, password);
}

async function submitLogin(email, password) {
    try {
        const response = await fetch('/user-login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password }),
        });

        const result = await response.json();
        console.log('Response from server:', result);

        if (result.success) {
            window.location.href = '/home';
        } else {
            alert(result.message || 'Login failed');
        }
    } catch (error) {
        console.error('Error during login:', error);
        alert('An error occurred. Please try again later.');
    }
}

function initializeLoginForm() {
    const loginForm = document.getElementById('loginForm');
   
    if (!loginForm) {
        console.error('Form with ID "loginForm" not found!');
        return;
    }

    loginForm.addEventListener('submit', handleLoginSubmit);
}

// Initialize the script once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', initializeLoginForm);
