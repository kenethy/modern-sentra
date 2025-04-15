// Minimalist Contact Page Interactivity

// WhatsApp Contact Form Integration
function sendWhatsAppMessage(event, directWhatsApp = false) {
    // Prevent form submission if it's a form submit event
    if (event && event.preventDefault && !directWhatsApp) {
        event.preventDefault();
    }

    // Get form values
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();
    const privacyChecked = document.getElementById('privacy').checked;

    // Validate form
    let isValid = true;
    const requiredInputs = document.querySelectorAll('#contactForm [required]');

    requiredInputs.forEach(input => {
        if (!input.value.trim() || (input.type === 'checkbox' && !input.checked)) {
            isValid = false;
            input.classList.add('border-red-500');
        } else {
            input.classList.remove('border-red-500');
        }
    });

    if (!isValid) {
        if (directWhatsApp) {
            alert('Mohon lengkapi semua field yang wajib diisi sebelum mengirim pesan via WhatsApp.');
        }
        return false;
    }

    // Format the message for WhatsApp
    const whatsappMessage =
        `*Pesan dari Website Modern Sentra*
----------------------------
*Nama:* ${name}
*Email:* ${email}
*Telepon:* ${phone || 'Tidak diisi'}
*Subjek:* ${subject}
----------------------------
*Pesan:*
${message}
----------------------------`;

    // Encode the message for URL
    const encodedMessage = encodeURIComponent(whatsappMessage);

    // WhatsApp number
    const whatsappNumber = '+6287752895532';

    // Create WhatsApp URL
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

    // Open WhatsApp in a new tab
    window.open(whatsappUrl, '_blank');

    // If it's a direct WhatsApp button click, we're done
    if (directWhatsApp) {
        return true;
    }

    // For form submission, show a success message
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
    document.getElementById('contactForm').reset();

    // Remove success message after 5 seconds
    setTimeout(() => {
        successMessage.remove();
    }, 5000);

    return false;
}

document.addEventListener('DOMContentLoaded', function () {
    // Form validation - now handled by sendWhatsAppMessage function
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            sendWhatsAppMessage(e);
        });
    }

    // Copy to clipboard functionality
    const copyButtons = document.querySelectorAll('.copy-button');

    copyButtons.forEach(button => {
        button.addEventListener('click', function () {
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
