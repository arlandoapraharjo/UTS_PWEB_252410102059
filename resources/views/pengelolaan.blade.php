@extends('layouts.app')

@section('content')
<div class="content-panel" x-data="{ currentFilter: 'All' }">
    <!-- Unit Management Header -->
    <header class="content-header">
        <h1 class="content-title">Unit Management</h1>
    </header>

    <!-- Horizontal Minimalist Text Status Filter -->
    <div class="text-filter">
        <span class="text-filter__label">&gt;&gt; FILTER:</span>
        <div class="text-filter__links">
            @foreach(['All', 'Active', 'Charging', 'Maintenance', 'Glitch'] as $index => $filterOption)
                @if($index > 0)
                    <span class="text-filter__sep">|</span>
                @endif
                <button
                    type="button"
                    class="text-filter__item"
                    :class="{ 'text-filter__item--active': currentFilter === '{{ $filterOption }}' }"
                    @click="currentFilter = '{{ $filterOption }}'"
                >
                    <span class="text-filter__arrow">&gt;&gt;</span>
                    {{ strtoupper($filterOption) }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Animatronic Zones Directory - Field Spec Sheet Format -->
    <div class="spec-sector-list">
        @foreach($units as $zona => $daftarUnit)
            <div class="spec-sector">
                <!-- Terminal Sector Header -->
                <div class="spec-sector__header">
                    <span class="spec-sector__rule">---</span>
                    <span class="spec-sector__title">[ SECTOR: {{ strtoupper($zona) }} ]</span>
                    <span class="spec-sector__count">({{ count($daftarUnit) }} {{ count($daftarUnit) === 1 ? 'UNIT' : 'UNITS' }})</span>
                    <span class="spec-sector__rule-fill">------------------------------------------------</span>
                </div>

                <!-- Unit Entries in Sector -->
                <div class="spec-sector__entries">
                    @foreach($daftarUnit as $unit)
                        <div
                            class="spec-entry"
                            x-show="currentFilter === 'All' || currentFilter.toLowerCase() === '{{ strtolower($unit['status']) }}'"
                            x-transition
                        >
                            <div class="spec-entry__line1">
                                <span class="spec-prefix">&gt;&gt;</span>
                                <span class="spec-code">[{{ $unit['kode'] }}]</span>
                                <span class="spec-name">{{ strtoupper($unit['nama']) }}</span>
                            </div>
                            <div class="spec-entry__line2">
                                <span class="spec-indent"></span>
                                <span class="spec-label">ROLE:</span> <span class="spec-val">{{ $unit['peran'] }}</span>
                                <span class="spec-sep">|</span>
                                <span class="spec-label">LAST SERVICE:</span> <span class="spec-val">{{ \Carbon\Carbon::parse($unit['servis'])->format('d M Y') }}</span>
                            </div>
                            <div class="spec-entry__line3">
                                <span class="spec-indent"></span>
                                <span class="spec-label">BAT:</span>
                                <x-battery-bar :level="$unit['baterai']" />
                                <span class="spec-sep">|</span>
                                <span class="spec-label">STATUS:</span>
                                <x-status-badge :status="$unit['status']" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
