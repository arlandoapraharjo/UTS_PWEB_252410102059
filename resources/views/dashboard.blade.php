@extends('layouts.app')

@section('content')
<div class="content-panel">
    <!-- Dashboard Header -->
    <header class="content-header">
        <h1 class="content-title">Good evening, <span class="text-accent">{{ $username }}</span></h1>
    </header>

    <!-- CCTV Surveillance Section -->
    <section class="cctv-system"
        x-data="{
            isPlaying: true,
            isMuted: true,
            isGlitching: false,
            isFullscreen: false,
            currentTime: '00:00:00.0',

            init() {
                this.tick();
                setInterval(() => this.tick(), 100);
            },
            tick() {
                const d = new Date(), p = n => String(n).padStart(2, '0');
                this.currentTime = `${p(d.getHours())}:${p(d.getMinutes())}:${p(d.getSeconds())}.${Math.floor(d.getMilliseconds() / 100)}`;
            },
            cmd(func) {
                this.$refs.cctvIframe?.contentWindow?.postMessage(JSON.stringify({ event: 'command', func, args: '' }), '*');
            },
            togglePlay() {
                this.isPlaying = !this.isPlaying;
                this.cmd(this.isPlaying ? 'playVideo' : 'pauseVideo');
            },
            toggleMute() {
                this.isMuted = !this.isMuted;
                this.cmd(this.isMuted ? 'mute' : 'unMute');
            },
            reloadFeed() {
                this.isGlitching = true;
                const iframe = this.$refs.cctvIframe;
                if (!iframe) return;
                const src = iframe.src;
                iframe.src = '';
                setTimeout(() => {
                    iframe.src = src;
                    this.isGlitching = false;
                    this.isPlaying = true;
                }, 260);
            }
        }"
        x-on:keydown.window.escape="isFullscreen = false"
    >
        <!-- CCTV Monitor CRT Viewport -->
        <div class="cctv-monitor" :class="{ 'cctv-monitor--glitch': isGlitching, 'cctv-monitor--fullscreen': isFullscreen }">
            <!-- CCTV Monitor Top OSD -->
            <div class="cctv-osd-top">
                <div class="cctv-rec">
                    <span class="cctv-rec-dot"></span>
                    <span class="cctv-rec-text">REC</span>
                </div>
                <div class="cctv-time" x-text="currentTime">00:00:00.0</div>
            </div>

            <!-- CCTV Playback Video Frame (YouTube Loop Embed) -->
            <div class="cctv-viewport">
                <iframe
                    x-ref="cctvIframe"
                    class="cctv-iframe"
                    src="https://www.youtube.com/embed/{{ $cctvCamera['youtube_id'] }}?autoplay=1&mute=1&loop=1&playlist={{ $cctvCamera['youtube_id'] }}&controls=0&modestbranding=1&rel=0&playsinline=1&enablejsapi=1"
                    title="Pizzaplex CCTV Live Playback Feed"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>

                <!-- CRT Visual Layers -->
                <div class="cctv-scanlines"></div>
                <div class="cctv-static" :class="{ 'cctv-static--active': isGlitching }"></div>
                <div class="cctv-vignette"></div>

                <!-- Screen Pause Overlay Indicator -->
                <div class="cctv-play-overlay" x-show="!isPlaying" x-cloak>
                    <span class="cctv-play-icon">[ ⏸ PAUSED ]</span>
                </div>
            </div>

            <!-- Wireframe CCTV Playback Controls Bar -->
            <div class="cctv-controls">
                <div class="cctv-controls__left">
                    <button type="button" class="cctv-ctrl-btn" @click="togglePlay()" :title="isPlaying ? 'Pause Feed' : 'Play Feed'">
                        <span x-text="isPlaying ? '[ ⏸ PAUSE ]' : '[ ▶ PLAY ]'"></span>
                    </button>
                    <button type="button" class="cctv-ctrl-btn" @click="toggleMute()" :title="isMuted ? 'Unmute Audio' : 'Mute Audio'">
                        <span x-text="isMuted ? '[ 🔇 MUTED ]' : '[ 🔊 AUDIO ]'"></span>
                    </button>
                    <button type="button" class="cctv-ctrl-btn" @click="reloadFeed()" title="Reload Stream">
                        <span>[ ⟳ RELOAD ]</span>
                    </button>
                </div>
                <div class="cctv-controls__right">
                    <a href="{{ $cctvCamera['youtube_url'] }}" target="_blank" rel="noopener noreferrer" class="cctv-ctrl-btn" title="Open on YouTube">
                        <span>[ ↗ YOUTUBE ]</span>
                    </a>
                    <button type="button" class="cctv-ctrl-btn" @click="isFullscreen = !isFullscreen" title="Fullscreen CCTV">
                        <span x-text="isFullscreen ? '[ ✕ EXIT FULL ]' : '[ ⛶ FULL VIEW ]'"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Critical Battery Section (< 20%) - Field Spec Sheet Format -->
    <section class="spec-section">
        <div class="spec-section__head">
            <h2 class="spec-section__title">
                <span class="fnaf-arrow">&gt;&gt;</span> CRITICAL BATTERY
            </h2>
            <span class="spec-meta-count">[ {{ count($kritis) }} {{ count($kritis) === 1 ? 'UNIT' : 'UNITS' }} REQUIRE ATTENTION ]</span>
        </div>

        <div class="spec-feed">
            @forelse($kritis as $unit)
                <div class="spec-entry">
                    <div class="spec-entry__line1">
                        <span class="spec-prefix">&gt;&gt;</span>
                        <span class="spec-code">[{{ $unit['kode'] }}]</span>
                        <span class="spec-name">{{ strtoupper($unit['nama']) }}</span>
                    </div>
                    <div class="spec-entry__line2">
                        <span class="spec-indent"></span>
                        <span class="spec-label">SECTOR:</span> <span class="spec-val">{{ strtoupper($unit['zona']) }}</span>
                        <span class="spec-sep">|</span>
                        <span class="spec-label">ROLE:</span> <span class="spec-val">{{ $unit['peran'] }}</span>
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
            @empty
                <div class="spec-empty">
                    <p class="spec-empty__text">&gt;&gt; [ NO ANOMALIES DETECTED // ALL UNITS BATTERY &gt;= 20% ]</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
