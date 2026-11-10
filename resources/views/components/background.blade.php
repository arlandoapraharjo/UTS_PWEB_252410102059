@props([
    'image' => 'images/menu-bg.jpg'
])

<div class="bg" aria-hidden="true">
    <img class="bg__media bg__image" src="{{ asset($image) }}" alt="" />

    <!-- Static CRT & Vignette layers -->
    <div class="bg__overlay"></div>
    <div class="bg__noise"></div>
    <div class="bg__scan"></div>
    <div class="bg__vhs-bar"></div>
    <div class="bg__vignette"></div>
</div>
