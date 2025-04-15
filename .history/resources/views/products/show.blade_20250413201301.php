@extends('layouts.app')

@section('title', $product->name) {{-- Set page title to product name --}}

@section('content')

{{-- Lightbox Script (Copied from previous attempt, assuming it's desired) --}}
<script>
    function openLightbox(imageUrl) {
        document.getElementById('lightboxImage').src = imageUrl;
        document.getElementById('lightbox').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Close lightbox when clicking outside the image
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeLightbox();
                }
            });
        }

        // Close lightbox with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox && lightbox.style.display === 'flex') {
                closeLightbox();
            }
        });

        // Handle thumbnail clicks (if thumbnails exist)
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const mainImage = document.getElementById('mainImage');
                if (mainImage) {
                    mainImage.src = this.querySelector('img').src; // Update main image source
                }
            });
        });
    });
</script>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-5 px-4 sm:px-0" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
