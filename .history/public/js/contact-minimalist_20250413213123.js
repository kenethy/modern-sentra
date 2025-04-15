// Minimalist Contact Page Interactivity

document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simple validation
            let isValid = true;
            const requiredInputs = contactForm.querySelectorAll('[required]');
            
            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md z-50';
                successMessage.innerHTML = `
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Pesan Terkirim!</p>
                            <p class="text-sm">Terima kasih telah menghubungi kami.</p>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(successMessage);
                
                // Reset form
                contactForm.reset();
                
                // Remove success message after 5 seconds
                setTimeout(() => {
                    successMessage.remove();
                }, 5000);
            }
        });
    }
    
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
