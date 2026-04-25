document.addEventListener('DOMContentLoaded', function() {
    
    const menuToggle = document.createElement('div');
    menuToggle.classList.add('menu-toggle');
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.navbar .nav-left').appendChild(menuToggle);

    const mobileMenu = document.createElement('div');
    mobileMenu.classList.add('mobile-menu');
    mobileMenu.innerHTML = document.querySelector('.nav-links').innerHTML;
    document.querySelector('header').appendChild(mobileMenu);

    menuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
        if (mobileMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

    document.addEventListener('click', function(event) {
        if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            mobileMenu.classList.remove('active');
            menuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Basic form validation for payment page
    const paymentForm = document.querySelector('.payment-form form');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let isValid = true;
            const requiredFields = paymentForm.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'This field is required';
                        field.parentElement.appendChild(message);
                    }
                } else {
                    field.classList.remove('error');
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });

            const emailField = document.getElementById('email');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    isValid = false;
                    emailField.classList.add('error');
                    const errorMessage = emailField.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'Please enter a valid email address';
                        emailField.parentElement.appendChild(message);
                    }
                }
            }

            const phoneField = document.getElementById('phone');
            if (phoneField && phoneField.value) {
                const phoneRegex = /^[0-9]{6,15}$/;
                if (!phoneRegex.test(phoneField.value.replace(/\s+/g, ''))) {
                    isValid = false;
                    phoneField.classList.add('error');
                    const errorMessage = phoneField.parentElement.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'Please enter a valid phone number';
                        phoneField.parentElement.parentElement.appendChild(message);
                    }
                } else {
                    phoneField.classList.remove('error');
                    const errorMessage = phoneField.parentElement.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            }

            if (isValid) {
                paymentForm.submit(); 
            }
        });

        const inputs = paymentForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    input.classList.add('error');
                    const errorMessage = input.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'This field is required';
                        input.parentElement.appendChild(message);
                    }
                } else {
                    input.classList.remove('error');
                    const errorMessage = input.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });
        });
    }
});

const style = document.createElement('style');
style.textContent = `
    .menu-toggle {
        display: none;
        cursor: pointer;
        font-size: 24px;
    }
    
    .mobile-menu {
        display: none;
        position: fixed;
        top: 0;
        left: -100%;
        width: 80%;
        height: 100vh;
        background-color: white;
        z-index: 1000;
        padding: 50px 20px;
        transition: left 0.3s ease;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        overflow-y: auto;
    }
    
    .mobile-menu.active {
        left: 0;
    }
    
    .mobile-menu .nav-links {
        flex-direction: column;
        list-style: none;
    }
    
    .mobile-menu .nav-links li {
        margin: 15px 0;
    }
    
    input.error, select.error, textarea.error {
        border-color: #ff3860;
    }
    
    .error-message {
        color: #ff3860;
        font-size: 12px;
        margin-top: 5px;
    }
    
    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
        }
        
        .mobile-menu {
            display: block;
        }
        
        .nav-links {
            display: none;
        }
    }
`;
document.head.appendChild(style);