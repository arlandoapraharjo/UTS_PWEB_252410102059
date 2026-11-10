@extends('layouts.app')

@section('body_class', 'page-login')
@section('hideNav', true)

@section('content')
<div class="fnaf-screen fnaf-screen--login">
    <div class="fnaf-left-panel">
        <!-- Title Stack at Left Side (FNAF Main Menu Style) -->
        <div class="fnaf-menu-title">
            <span class="fnaf-title-line">5 Malam</span>
            <span class="fnaf-title-line fnaf-accent">Haur Haur</span>
        </div>

        <!-- Pure Wireframe Terminal Prompt Login Form -->
        <form action="{{ route('login.submit') }}" method="POST" class="wire-form">
            @csrf

            <!-- Operator ID Field -->
            <div class="wire-field">
                <label for="username" class="wire-label">
                    <span class="fnaf-prompt">&gt;&gt;</span> username:
                </label>
                <div class="wire-input-wrap">
                    <span class="wire-prefix">&gt;</span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="wire-input @error('username') wire-input--error @enderror"
                        placeholder="technician"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        autofocus
                        required
                    >
                    <span class="wire-cursor">_</span>
                </div>
                @error('username')
                    <span class="wire-error">&gt;&gt; ERROR: {{ $message }}</span>
                @enderror
            </div>

            <!-- Passcode Field -->
            <div class="wire-field">
                <label for="password" class="wire-label">
                    <span class="fnaf-prompt">&gt;&gt;</span> password:
                </label>
                <div class="wire-input-wrap">
                    <span class="wire-prefix">&gt;</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="wire-input @error('password') wire-input--error @enderror"
                        placeholder="••••"
                        autocomplete="current-password"
                        required
                    >
                    <span class="wire-cursor">_</span>
                </div>
                @error('password')
                    <span class="wire-error">&gt;&gt; ERROR: {{ $message }}</span>
                @enderror
            </div>

            <!-- Start Shift Button -->
            <div class="wire-action">
                <button type="submit" class="fnaf-menu-btn">
                    <span class="fnaf-arrow">&gt;&gt;</span> login
                </button>
            </div>
        </form>
    </div>
</div>

<x-footer />
@endsection
