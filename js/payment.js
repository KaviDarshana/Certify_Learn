document.addEventListener('DOMContentLoaded', () => {
    // Get category from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    
    // Display the exam category
    const examCategoryElement = document.getElementById('exam-category');
    if (examCategoryElement && category) {
        // Format the category name for display (convert 'html-intro' to 'HTML Intro')
        const formattedCategory = category
            .split('-')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ');
        examCategoryElement.textContent = formattedCategory;
    }

    // Initialize Stripe
    const stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx'); // Replace with your publishable key
    const elements = stripe.elements();
    
    // Create and mount the card element
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
    });
    cardElement.mount('#card-element');
    
    // Handle real-time validation errors from the card element
    cardElement.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    // Handle form submission for card payment
    const paymentForm = document.getElementById('payment-form');
    paymentForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');
        
        // Disable the submit button to prevent repeated clicks
        submitButton.disabled = true;
        buttonText.style.display = 'none';
        spinner.classList.remove('hidden');
        
        try {
            // Create payment method
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement
            });

            if (error) {
                showError(error.message);
            } else {
                // Send paymentMethod.id to your server
                const response = await processPayment(paymentMethod.id, category);
                
                if (response.success) {
                    showMessage('Payment successful! Redirecting to quiz...');
                    setTimeout(() => {
                        redirectToQuiz(category);
                    }, 2000);
                } else {
                    showError(response.error || 'Payment failed. Please try again.');
                }
            }
        } catch (e) {
            showError('An unexpected error occurred. Please try again.');
            console.error(e);
        } finally {
            // Re-enable the submit button
            submitButton.disabled = false;
            buttonText.style.display = 'block';
            spinner.classList.add('hidden');
        }
    });
    
    // Handle file upload preview
    const fileInput = document.getElementById('slip-file');
    const previewImage = document.getElementById('preview-image');
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Handle form submission for slip upload
    const slipUploadForm = document.getElementById('slip-upload-form');
    slipUploadForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const uploadButton = document.getElementById('upload-button');
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading...';
        
        try {
            // Get form values
            const file = fileInput.files[0];
            const transactionId = document.getElementById('transaction-id').value;
            
            if (!file || !transactionId) {
                throw new Error('Please provide both a payment slip and transaction ID');
            }
            
            // Upload the slip
            const response = await uploadPaymentSlip(file, transactionId, category);
            
            if (response.success) {
                showMessage('Slip uploaded successfully! Your payment is pending verification. Redirecting to quiz...');
                setTimeout(() => {
                    redirectToQuiz(category);
                }, 3000);
            } else {
                showError(response.error || 'Upload failed. Please try again.');
            }
        } catch (e) {
            showError(e.message || 'Upload failed. Please try again.');
            console.error(e);
        } finally {
            uploadButton.disabled = false;
            uploadButton.textContent = 'Upload Slip';
        }
    });
    
    // Helper functions
    function showMessage(message) {
        const messageElement = document.getElementById('payment-message');
        messageElement.textContent = message;
        messageElement.classList.remove('hidden', 'error');
        messageElement.classList.add('success');
    }
    
    function showError(message) {
        const messageElement = document.getElementById('payment-message');
        messageElement.textContent = message;
        messageElement.classList.remove('hidden', 'success');
        messageElement.classList.add('error');
    }
    
    async function processPayment(paymentMethodId, category) {
        // In a real implementation, this would make an API call to your server
        // where you would process the payment with Stripe's API
        
        // For demo purposes, we'll simulate a successful payment
        return new Promise(resolve => {
            setTimeout(() => {
                resolve({ success: true });
            }, 1000);
        });
    }
    
    async function uploadPaymentSlip(file, transactionId, category) {
        // In a real implementation, this would upload the file to your server
        // and store the transaction details in your database
        
        // For demo purposes, we'll simulate a successful upload
        return new Promise(resolve => {
            setTimeout(() => {
                resolve({ success: true });
            }, 1500);
        });
    }
    
    function redirectToQuiz(category) {
        window.location.href = `quiz.html?category=${category}`;
    }
});