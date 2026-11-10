<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'Pizzaplex Control' }}</title>

<!-- Favicon Freddy Fazbear -->
<link rel="icon" type="image/jpeg" href="{{ asset('images/freddy.jpg') }}">
<link rel="shortcut icon" type="image/jpeg" href="{{ asset('images/freddy.jpg') }}">
<link rel="apple-touch-icon" href="{{ asset('images/freddy.jpg') }}">

<!-- Google Fonts: Share Tech Mono (FNAF Main Menu font) & Inter & Rajdhani -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">

<!-- Native CSS Style (Design System: FNAF Main Menu Edition) -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!-- Alpine.js CDN for UI interactivity and status filtering -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
