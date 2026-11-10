@extends('layouts.app')

@section('content')
<div class="content-panel">
    <!-- Technician Profile Header -->
    <header class="content-header">
        <h1 class="content-title">{{ $username }}</h1>
    </header>

    <div class="spec-dossier">
        <!-- Personnel Dossier Field List -->
        <div class="dossier-fields">
            @foreach([
                'USERNAME' => strtoupper($username),
                'DESIGNATION' => $info['role'],
                'SHIFT SCHEDULE' => $info['shift'],
                'ASSIGNED SECTOR' => $info['zona'],
                'MANAGED UNITS' => "{$info['unit_ditangani']} Animatronic Units",
            ] as $label => $val)
                <div class="dossier-row">
                    <span class="dossier-label">&gt;&gt; {{ $label }}</span>
                    <span class="dossier-dots">....................</span>
                    <span class="dossier-val">{{ $val }}</span>
                </div>
            @endforeach
        </div>

        <!-- Danger Logout Action -->
        <div class="dossier-action">
            <a href="{{ route('login') }}" class="fnaf-menu-btn fnaf-menu-btn--logout">
                <span class="fnaf-arrow">&gt;&gt;</span> Logout
            </a>
        </div>
    </div>
</div>
@endsection
