@if(session('success'))
<div id="successNotification" class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 ease-in-out">
    <div class="p-1 bg-[#d46714]"></div>
    <div class="p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3 w-0 flex-1">
                <p class="text-sm font-medium text-gray-900">{{ session('success') }}</p>
                @if(session('quote_info'))
                <p class="mt-1 text-sm text-gray-500">
                    Tim kami akan menghubungi Anda dalam waktu 1x24 jam pada jam kerja.
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Nomor Referensi: {{ session('quote_info')['reference_number'] }}
                </p>
                @endif
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button id="closeNotification" class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notification = document.getElementById('successNotification');
        const closeBtn = document.getElementById('closeNotification');
        
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                notification.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            });
        }
        
        // Auto close after 8 seconds
        setTimeout(() => {
            if (notification) {
                notification.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            }
        }, 8000);
    });
</script>
@endif
