// Modern Products Page Interactivity

document.addEventListener('DOMContentLoaded', function() {
    // Fade-in animations
    const fadeElements = document.querySelectorAll('.fade-in');
    
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
    
    fadeElements.forEach(element => {
        fadeObserver.observe(element);
    });
    
    // Staggered animations for product cards
    const staggerItems = document.querySelectorAll('.stagger-item');
    
    // Intersection Observer for staggered items
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
    
    staggerItems.forEach(item => {
        staggerObserver.observe(item);
    });
    
    // Filter functionality
    const filterForm = document.getElementById('filterForm');
    const resetButton = document.getElementById('resetFilter');
    const categorySelect = document.getElementById('category');
    const searchInput = document.getElementById('search');
    
    if (resetButton) {
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Reset form fields
            if (categorySelect) categorySelect.value = '';
            if (searchInput) searchInput.value = '';
            
            // Submit the form
            if (filterForm) filterForm.submit();
        });
    }
    
    // Debounce function for search input
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Auto-submit form on search input after delay
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            if (filterForm) filterForm.submit();
        }, 500)); // 500ms delay
    }
    
    // Category select change
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            if (filterForm) filterForm.submit();
        });
    }
    
    // Mobile filter toggle
    const mobileFilterToggle = document.getElementById('mobileFilterToggle');
    const filterContainer = document.getElementById('filterContainer');
    
    if (mobileFilterToggle && filterContainer) {
        mobileFilterToggle.addEventListener('click', function() {
            filterContainer.classList.toggle('hidden');
            
            // Change icon based on state
            const showIcon = this.querySelector('.show-icon');
            const hideIcon = this.querySelector('.hide-icon');
            
            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden');
                hideIcon.classList.toggle('hidden');
            }
        });
    }
    
    // Back to top button
    const backToTopBtn = document.getElementById('backToTop');
    
    if (backToTopBtn) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'visible');
                backToTopBtn.classList.add('opacity-0', 'invisible');
            }
        });
        
        // Scroll to top when clicked
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
