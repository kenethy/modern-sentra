<div class="partners-section py-16 sm:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-light text-gray-900 mb-3">Partner <span class="font-semibold">Kami</span></h2>
            <div class="w-20 h-1 bg-gradient-to-r from-gray-200 via-gray-400 to-gray-200 mx-auto"></div>
        </div>

        <div class="partners-grid">
            <!-- Partner 1 - SVG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner1.svg') }}" alt="Partner 1" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 2 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner2.png') }}" alt="Partner 2" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 3 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner3.png') }}" alt="Partner 3" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 4 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner4.png') }}" alt="Partner 4" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 5 - JPG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner5.jpg') }}" alt="Partner 5" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 6 - JPG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner6.jpg') }}" alt="Partner 6" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 7 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner7.png') }}" alt="Partner 7" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 8 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner8.png') }}" alt="Partner 8" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>

            <!-- Partner 9 - PNG -->
            <div class="partner-item">
                <img src="{{ asset('images/partners/partner9.png') }}" alt="Partner 9" class="partner-logo"
                    style="filter: none !important;"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
            </div>
        </div>
    </div>
</div>

<style>
    .partners-section {
        position: relative;
    }

    .partners-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0));
    }

    .partners-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    @media (min-width: 640px) {
        .partners-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .partner-item {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        padding: 1.5rem;
        background-color: white;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .partner-item:hover {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    }

    .partner-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(to right, transparent, rgba(153, 118, 92, 0.3), transparent);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .partner-item:hover::after {
        transform: scaleX(1);
    }

    .partner-logo {
        max-height: 60px;
        max-width: 100%;
        object-fit: contain;
        opacity: 0.85;
        transition: all 0.4s ease;
        filter: none !important;
        -webkit-filter: none !important;
    }

    .partner-item:hover .partner-logo {
        opacity: 1;
        transform: scale(1.05);
    }
</style>