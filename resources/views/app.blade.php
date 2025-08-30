<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Travel Packages - Discover Amazing Destinations</title>
    <meta name="description" content="Explore amazing travel packages to destinations around the world. Find your perfect adventure with our curated selection of tours and experiences.">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Preload critical fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Loading state styles -->
    <style>
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s ease-out;
        }
        
        .loading-screen.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: white;
            font-size: 18px;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>
    
    <!-- Vite Assets -->
    @if(file_exists(public_path('build/manifest.json')))
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        @if(isset($manifest['resources/js/app.js']['css']))
            @foreach($manifest['resources/js/app.js']['css'] as $css)
                <link rel="stylesheet" href="/build/{{ $css }}">
            @endforeach
        @endif
    @endif
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="text-center">
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading Travel Packages...</div>
        </div>
    </div>

    <!-- Vue App Mount Point -->
    <div id="app"></div>

    <!-- Scripts -->
    @if(file_exists(public_path('build/manifest.json')))
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        @if(isset($manifest['resources/js/app.js']['file']))
            <script src="/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
        @endif
    @else
        <!-- Fallback for development -->
        <script type="module" src="http://localhost:3000/@vite/client"></script>
        <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
    @endif
    
    <script>
        // Hide loading screen when Vue app is ready
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const loadingScreen = document.getElementById('loading-screen');
                if (loadingScreen) {
                    loadingScreen.classList.add('fade-out');
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 300);
                }
            }, 1000);
        });
    </script>
</body>
</html>
