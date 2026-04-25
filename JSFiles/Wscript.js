// BoConcept Professionals Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.createElement('div');
    menuToggle.classList.add('menu-toggle');
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.main-header').appendChild(menuToggle);

    // Create mobile menu
    const mobileMenu = document.createElement('div');
    mobileMenu.classList.add('mobile-menu');
    mobileMenu.innerHTML = document.querySelector('.main-nav').innerHTML;
    document.querySelector('header').appendChild(mobileMenu);

    // Toggle mobile menu
    menuToggle.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');
        menuToggle.classList.toggle('active');
        
        // Prevent body scrolling when menu is open
        if (mobileMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            mobileMenu.classList.remove('active');
            menuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Form validation
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        // Populate dropdowns with data
        populateDropdowns();
        
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Basic validation
            let isValid = true;
            const requiredFields = contactForm.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    // Add error message if not already present
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
            
            // Email validation
            const emailField = document.getElementById('email');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    isValid = false;
                    emailField.classList.add('error');
                    
                    // Add error message if not already present
                    const errorMessage = emailField.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'Please enter a valid email address';
                        emailField.parentElement.appendChild(message);
                    }
                }
            }
            
            // Phone validation
            const phoneField = document.getElementById('phone');
            if (phoneField && phoneField.value) {
                const phoneRegex = /^[0-9]{6,15}$/;
                if (!phoneRegex.test(phoneField.value.replace(/\s+/g, ''))) {
                    isValid = false;
                    phoneField.classList.add('error');
                    
                    // Add error message if not already present
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
                // Simulate form submission
                const submitBtn = contactForm.querySelector('.submit-btn');
                const originalText = submitBtn.textContent;
                
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';
                
                // Add loading indicator
                const loadingIndicator = document.createElement('div');
                loadingIndicator.classList.add('loading-indicator');
                submitBtn.appendChild(loadingIndicator);
                
                setTimeout(() => {
                    // Show success message
                    contactForm.style.display = 'none';
                    
                    const successMessage = document.createElement('div');
                    successMessage.classList.add('success-message');
                    successMessage.innerHTML = `
                        <h3>Thank you for your message!</h3>
                        <p>We will get back to you soon.</p>
                        <button class="back-btn">Back to form</button>
                    `;
                    contactForm.parentElement.appendChild(successMessage);
                    
                    // Back button functionality
                    successMessage.querySelector('.back-btn').addEventListener('click', function() {
                        successMessage.remove();
                        contactForm.style.display = 'block';
                        contactForm.reset();
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    });
                }, 1500);
            } else {
                // Scroll to first error
                const firstError = contactForm.querySelector('.error');
                if (firstError) {
                    firstError.focus();
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
        
        // Real-time validation
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }

    // Field validation function
    function validateField(field) {
        if (field.hasAttribute('required') && !field.value.trim()) {
            field.classList.add('error');
            
            // Add error message if not already present
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
            
            // Additional validation for email
            if (field.type === 'email' && field.value.trim()) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.value)) {
                    field.classList.add('error');
                    
                    // Add error message if not already present
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'Please enter a valid email address';
                        field.parentElement.appendChild(message);
                    }
                }
            }
            
            // Additional validation for phone
            if (field.id === 'phone' && field.value.trim()) {
                const phoneRegex = /^[0-9]{6,15}$/;
                if (!phoneRegex.test(field.value.replace(/\s+/g, ''))) {
                    field.classList.add('error');
                    
                    // Add error message if not already present
                    const errorMessage = field.parentElement.parentElement.querySelector('.error-message');
                    if (!errorMessage) {
                        const message = document.createElement('div');
                        message.classList.add('error-message');
                        message.textContent = 'Please enter a valid phone number';
                        field.parentElement.parentElement.appendChild(message);
                    }
                }
            }
        }
    }

    // Populate dropdowns with sample data
    function populateDropdowns() {
        const topicSelect = document.getElementById('topic');
        if (topicSelect) {
            const topicOptions = [
                'General Inquiry', 
                'Project Collaboration', 
                'Product Information', 
                'Trade Program', 
                'Contract Furnishing',
                'Interior Design Services',
                'Other'
            ];
            
            topicOptions.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.toLowerCase().replace(/\s+/g, '-');
                optionElement.textContent = option;
                topicSelect.appendChild(optionElement);
            });
        }
        
        const professionSelect = document.getElementById('profession');
        if (professionSelect) {
            const professionOptions = [
                'Interior Designer', 
                'Architect', 
                'Property Developer', 
                'Contractor', 
                'Facility Manager',
                'Hospitality Manager',
                'Real Estate Agent',
                'Project Manager',
                'Other'
            ];
            
            professionOptions.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.toLowerCase().replace(/\s+/g, '-');
                optionElement.textContent = option;
                professionSelect.appendChild(optionElement);
            });
        }
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add animation on scroll for elements
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.tool-card, .project-card, .benefit-item');
        const windowHeight = window.innerHeight;
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            
            if (elementPosition < windowHeight - 100) {
                element.classList.add('animate');
            }
        });
    };

    // Run animation check on scroll
    window.addEventListener('scroll', animateOnScroll);
    
    // Add search functionality
    const searchIcon = document.querySelector('.search-icon');
    if (searchIcon) {
        const searchOverlay = document.createElement('div');
        searchOverlay.classList.add('search-overlay');
        searchOverlay.innerHTML = `
            <div class="search-container">
                <form class="search-form">
                    <input type="text" placeholder="What can we help you find?" aria-label="Search input">
                    <button type="submit" aria-label="Submit search"><i class="fas fa-search"></i></button>
                </form>
                <button class="close-search" aria-label="Close search"><i class="fas fa-times"></i></button>
            </div>
        `;
        document.body.appendChild(searchOverlay);
        
        searchIcon.addEventListener('click', function(e) {
            e.preventDefault();
            searchOverlay.classList.add('active');
            
            // Prevent body scrolling when search is open
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                searchOverlay.querySelector('input').focus();
            }, 100);
        });
        
        searchOverlay.querySelector('.close-search').addEventListener('click', function() {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        searchOverlay.querySelector('.search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const query = this.querySelector('input').value.trim();
            if (query) {
                // Simulate search
                const searchResults = document.createElement('div');
                searchResults.classList.add('search-results');
                searchResults.innerHTML = `
                    <h3>Search results for: "${query}"</h3>
                    <p>No results found. Please try a different search term.</p>
                `;
                
                const existingResults = searchOverlay.querySelector('.search-results');
                if (existingResults) {
                    existingResults.remove();
                }
                
                searchOverlay.querySelector('.search-container').appendChild(searchResults);
            }
        });
        
        // Close search on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Add styles for dynamically created elements
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
        
        .mobile-menu ul {
            flex-direction: column;
            list-style: none;
        }
        
        .mobile-menu li {
            margin: 15px 0;
        }
        
        .search-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .search-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .search-container {
            width: 80%;
            max-width: 800px;
            position: relative;
        }
        
        .search-form {
            width: 100%;
            display: flex;
            border-bottom: 2px solid white;
        }
        
        .search-form input {
            flex: 1;
            padding: 15px;
            font-size: 18px;
            background: transparent;
            border: none;
            color: white;
            font-weight: 300;
        }
        
        .search-form input::placeholder {
            color: rgba(255,255,255,0.7);
        }
        
        .search-form button {
            background: transparent;
            border: none;
            color: white;
            font-size: 18px;
            padding: 15px;
            cursor: pointer;
        }
        
        .close-search {
            position: absolute;
            top: -40px;
            right: 0;
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        
        .search-results {
            color: white;
            margin-top: 30px;
            font-weight: 300;
        }
        
        .search-results h3 {
            margin-bottom: 15px;
            font-weight: 300;
        }
        
        .tool-card, .project-card, .benefit-item {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .tool-card.animate, .project-card.animate, .benefit-item.animate {
            opacity: 1;
            transform: translateY(0);
        }
        
        input.error, select.error, textarea.error {
            border-color: #ff3860;
        }
        
        .error-message {
            color: #ff3860;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .success-message {
            text-align: center;
            padding: 40px;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .success-message h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .success-message p {
            margin-bottom: 20px;
        }
        
        .back-btn {
            background-color: #000;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .back-btn:hover {
            background-color: #333;
        }
        
        .loading-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 10px;
            vertical-align: middle;
        }
        
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            .mobile-menu {
                display: block;
            }
        }
    `;
    document.head.appendChild(style);

    // Newsletter signup in header
    const signupLink = document.querySelector('.signup-link');
    if (signupLink) {
        signupLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create newsletter popup
            const newsletterPopup = document.createElement('div');
            newsletterPopup.classList.add('newsletter-popup');
            newsletterPopup.innerHTML = `
                <div class="newsletter-container">
                    <button class="close-newsletter" aria-label="Close newsletter signup"><i class="fas fa-times"></i></button>
                    <h3>Subscribe to our newsletter</h3>
                    <p>Get a front row seat to our collection launches and trends – directly to your inbox.</p>
                    <form class="newsletter-popup-form">
                        <input type="email" placeholder="Your email address" aria-label="Email for newsletter" required>
                        <button type="submit">Sign up</button>
                    </form>
                    <div class="newsletter-consent">
                        <p>By signing up, you agree to our <a href="#">Privacy Policy</a> and consent to receive marketing emails.</p>
                    </div>
                </div>
            `;
            document.body.appendChild(newsletterPopup);
            
            // Add popup styles
            const popupStyle = document.createElement('style');
            popupStyle.textContent = `
                .newsletter-popup {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.7);
                    z-index: 1001;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    visibility: hidden;
                    transition: opacity 0.3s;
                }
                
                .newsletter-popup.active {
                    opacity: 1;
                    visibility: visible;
                }
                
                .newsletter-container {
                    background-color: white;
                    padding: 40px;
                    max-width: 500px;
                    position: relative;
                    text-align: center;
                }
                
                .close-newsletter {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    background: transparent;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                }
                
                .newsletter-container h3 {
                    font-size: 24px;
                    margin-bottom: 15px;
                }
                
                .newsletter-container p {
                    margin-bottom: 20px;
                }
                
                .newsletter-popup-form {
                    display: flex;
                    margin-bottom: 20px;
                }
                
                .newsletter-popup-form input {
                    flex: 1;
                    padding: 12px;
                    border: 1px solid #ddd;
                }
                
                .newsletter-popup-form button {
                    background-color: #000;
                    color: white;
                    border: none;
                    padding: 12px 25px;
                    cursor: pointer;
                }
                
                .newsletter-consent {
                    font-size: 12px;
                }
                
                .newsletter-consent a {
                    text-decoration: underline;
                }
                
                @media (max-width: 576px) {
                    .newsletter-container {
                        width: 90%;
                        padding: 30px 20px;
                    }
                    
                    .newsletter-popup-form {
                        flex-direction: column;
                    }
                    
                    .newsletter-popup-form input {
                        margin-bottom: 10px;
                    }
                }
            `;
            document.head.appendChild(popupStyle);
            
            // Show popup with animation
            setTimeout(() => {
                newsletterPopup.classList.add('active');
            }, 10);
            
            // Close popup
            const closeBtn = newsletterPopup.querySelector('.close-newsletter');
            closeBtn.addEventListener('click', function() {
                newsletterPopup.classList.remove('active');
                setTimeout(() => {
                    newsletterPopup.remove();
                }, 300);
            });
            
            // Form submission
            const newsletterForm = newsletterPopup.querySelector('.newsletter-popup-form');
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input').value.trim();
                
                if (email) {
                    // Show success message
                    newsletterPopup.querySelector('.newsletter-container').innerHTML = `
                        <button class="close-newsletter" aria-label="Close newsletter signup"><i class="fas fa-times"></i></button>
                        <h3>Thank you for subscribing!</h3>
                        <p>You'll now receive the latest news and updates from BoConcept.</p>
                    `;
                    
                    // Reattach close event
                    newsletterPopup.querySelector('.close-newsletter').addEventListener('click', function() {
                        newsletterPopup.classList.remove('active');
                        setTimeout(() => {
                            newsletterPopup.remove();
                        }, 300);
                    });
                    
                    // Auto close after delay
                    setTimeout(() => {
                        newsletterPopup.classList.remove('active');
                        setTimeout(() => {
                            newsletterPopup.remove();
                        }, 300);
                    }, 3000);
                }
            });
            
            // Close on outside click
            newsletterPopup.addEventListener('click', function(e) {
                if (e.target === newsletterPopup) {
                    newsletterPopup.classList.remove('active');
                    setTimeout(() => {
                        newsletterPopup.remove();
                    }, 300);
                }
            });
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && newsletterPopup.classList.contains('active')) {
                    newsletterPopup.classList.remove('active');
                    setTimeout(() => {
                        newsletterPopup.remove();
                    }, 300);
                }
            });
        });
    }

    // Initial animation check
    animateOnScroll();
});