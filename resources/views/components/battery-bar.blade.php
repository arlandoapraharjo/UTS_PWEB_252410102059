@props([
    'level' => 0
])

@php
    $level = max(0, min(100, (int) $level));
    $filled = (int) round($level / 10);
    $empty = 10 - $filled;
    $blocks = str_repeat('█', $filled) . str_repeat('░', $empty);

    if ($level >= 50) {
        $tierClass = 'battery--high';
    } elseif ($level >= 20) {
        $tierClass = 'battery--mid';
    } else {
        $tierClass = 'battery--low';
    }
@endphp

<span class="ascii-battery {{ $tierClass }}">
    <span class="ascii-battery__brackets">[</span><span class="ascii-battery__blocks">{{ $blocks }}</span><span class="ascii-battery__brackets">]</span>
    <span class="ascii-battery__pct">{{ $level }}%</span>
</span>
