// Modern Contact Page Interactivity

document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for fade-in elements
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        fadeObserver.observe(element);
    });
    
    // Staggered animations for cards
    const staggerObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add delay based on index
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 100); // 100ms stagger
                
                staggerObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    document.querySelectorAll('.stagger-item').forEach(item => {
        staggerObserver.observe(item);
    });
    
    // Form validation and animation
    const contactForm = document.getElementById('contactForm');
    const formInputs = document.querySelectorAll('.form-input');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            
            // Simple validation
            formInputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    
                    // Add error message if it doesn't exist
                    let errorMessage = input.parentNode.querySelector('.error-message');
                    if (!errorMessage) {
                        errorMessage = document.createElement('p');
                        errorMessage.className = 'text-red-500 text-sm mt-1 error-message';
                        errorMessage.textContent = 'Field ini wajib diisi';
                        input.parentNode.appendChild(errorMessage);
                    }
                } else {
                    input.classList.remove('border-red-500');
                    
                    // Remove error message if it exists
                    const errorMessage = input.parentNode.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });
            
            if (isValid) {
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md z-50 animate-on-scroll visible';
                successMessage.innerHTML = `
                    <div class="flex items-center">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Pesan Terkirim!</p>
                            <p class="text-sm">Terima kasih telah menghubungi kami. Kami akan segera merespons pesan Anda.</p>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(successMessage);
                
                // Reset form
                contactForm.reset();
                
                // Remove success message after 5 seconds
                setTimeout(() => {
                    successMessage.classList.add('opacity-0');
                    setTimeout(() => {
                        successMessage.remove();
                    }, 300);
                }, 5000);
            }
        });
        
        // Clear error on input
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                
                const errorMessage = this.parentNode.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
            });
        });
    }
    
    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        if (question && answer) {
            question.addEventListener('click', function() {
                const isOpen = answer.classList.contains('block');
                
                // Close all answers
                document.querySelectorAll('.faq-answer').forEach(a => {
                    a.classList.remove('block');
                    a.classList.add('hidden');
                });
                
                document.querySelectorAll('.faq-icon').forEach(icon => {
                    icon.classList.remove('rotate-180');
                });
                
                // Toggle current answer
                if (!isOpen) {
                    answer.classList.remove('hidden');
                    answer.classList.add('block');
                    
                    const icon = question.querySelector('.faq-icon');
                    if (icon) {
                        icon.classList.add('rotate-180');
                    }
                }
            });
        }
    });
    
    // Copy to clipboard functionality
    const copyButtons = document.querySelectorAll('.copy-button');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const textToCopy = this.dataset.copy;
            
            if (textToCopy) {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Show copied message
                    const originalText = this.innerHTML;
                    this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Disalin!
                    `;
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 2000);
                });
            }
        });
    });
});
