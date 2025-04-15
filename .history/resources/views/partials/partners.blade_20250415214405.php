<div class="partners-section py-16 sm:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-light text-gray-900 mb-3">Partner <span class="font-semibold">Kami</span></h2>
            <div class="w-20 h-1 bg-gradient-to-r from-gray-200 via-gray-400 to-gray-200 mx-auto"></div>
        </div>

        <div class="partners-grid">
            @for ($i = 1; $i <= 9; $i++) <div class="partner-item">
                <img src="{{ asset('images/partners/partner' . $i . '.png') }}" alt="Partner {{ $i }}"
                    class="partner-logo"
                    onerror="this.onerror=null; this.src='{{ asset('images/partners/placeholder.png') }}'">
        </div>
        @endfor
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
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.4s ease;
    }

    .partner-item:hover .partner-logo {
        filter: grayscale(0%);
        opacity: 1;
    }
</style>