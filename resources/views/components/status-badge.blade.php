@props([
    'status' => 'Active'
])

@php
    $statusClass = strtolower($status);
@endphp

<span class="ascii-status ascii-status--{{ $statusClass }}">
    <span class="ascii-bracket">[</span>
    <span class="ascii-status__text">{{ strtoupper($status) }}</span>
    <span class="ascii-bracket">]</span>
</span>
