<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* STUNNING AUTHENTICATION STYLES (GLASSMORPHISM & ACCENT GLOWS) */
            body {
                background-color: #030712 !important;
                background-image: 
                    radial-gradient(at 0% 0%, hsla(174, 65%, 15%, 0.4) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, hsla(38, 92%, 15%, 0.3) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, hsla(244, 55%, 15%, 0.4) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, hsla(174, 65%, 15%, 0.3) 0px, transparent 50%) !important;
                font-family: 'Figtree', sans-serif;
                color: #e2e8f0;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: relative;
                overflow-x: hidden;
            }

            /* Decorative Background Glows */
            .bg-glow-1 {
                position: absolute;
                width: 350px;
                height: 350px;
                background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%);
                top: 15%;
                left: 10%;
                z-index: 0;
                pointer-events: none;
            }
            .bg-glow-2 {
                position: absolute;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(251, 191, 36, 0.08) 0%, transparent 70%);
                bottom: 15%;
                right: 10%;
                z-index: 0;
                pointer-events: none;
            }

            .auth-container {
                width: 100%;
                max-width: 440px;
                padding: 2.5rem;
                background: rgba(15, 23, 42, 0.65) !important;
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.08) !important;
                box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.6), 
                            0 0 40px rgba(45, 212, 191, 0.03) !important;
                border-radius: 28px !important;
                z-index: 10;
                position: relative;
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .auth-container:hover {
                border-color: rgba(45, 212, 191, 0.2) !important;
                box-shadow: 0 30px 70px -15px rgba(0, 0, 0, 0.7), 
                            0 0 50px rgba(45, 212, 191, 0.05) !important;
            }

            .auth-logo {
                margin-bottom: 1.5rem;
                display: flex;
                justify-content: center;
                z-index: 10;
            }

            .logo-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #2dd4bf, #14b8a6);
                border-radius: 20px;
                box-shadow: 0 8px 20px rgba(45, 212, 191, 0.3);
                font-weight: 800;
                color: #030712;
                font-size: 1.5rem;
                transition: transform 0.3s ease;
            }

            .logo-icon:hover {
                transform: scale(1.08) rotate(3deg);
            }

            /* Inputs & Labels styling override */
            label, .input-label {
                color: #94a3b8 !important;
                font-size: 0.85rem !important;
                font-weight: 600 !important;
                margin-bottom: 0.5rem !important;
                display: block;
                letter-spacing: 0.025em;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                background: rgba(3, 7, 18, 0.6) !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                color: #f8fafc !important;
                border-radius: 14px !important;
                padding: 0.75rem 1rem !important;
                font-size: 0.95rem !important;
                width: 100% !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2) !important;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #2dd4bf !important;
                box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.15), 
                            inset 0 2px 4px rgba(0, 0, 0, 0.1) !important;
                outline: none !important;
            }

            /* Primary Button override */
            button[type="submit"], 
            .btn-primary-action {
                background: linear-gradient(135deg, #2dd4bf 0%, #14b8a6 100%) !important;
                color: #030712 !important;
                font-weight: 700 !important;
                padding: 0.8rem 1.8rem !important;
                border-radius: 14px !important;
                border: none !important;
                cursor: pointer !important;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
                box-shadow: 0 4px 14px rgba(45, 212, 191, 0.3) !important;
                width: 100%;
                font-size: 0.95rem !important;
                text-transform: none !important;
                letter-spacing: normal !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            button[type="submit"]:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(45, 212, 191, 0.5) !important;
                color: #ffffff !important;
                background: linear-gradient(135deg, #2dd4bf 0%, #0d9488 100%) !important;
            }

            button[type="submit"]:active {
                transform: translateY(1px);
            }

            /* Links styling override */
            a.underline {
                color: #94a3b8 !important;
                text-decoration: none !important;
                transition: color 0.2s ease !important;
                font-size: 0.85rem !important;
            }

            a.underline:hover {
                color: #fbbf24 !important;
                text-shadow: 0 0 8px rgba(251, 191, 36, 0.2) !important;
            }

            /* Checkbox */
            input[type="checkbox"] {
                border-radius: 6px !important;
                background-color: rgba(3, 7, 18, 0.6) !important;
                border-color: rgba(255, 255, 255, 0.15) !important;
                color: #14b8a6 !important;
                transition: all 0.2s ease !important;
            }

            input[type="checkbox"]:focus {
                ring-color: #14b8a6 !important;
                box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2) !important;
            }

            /* Errors formatting */
            .text-red-600 {
                color: #fb7185 !important;
                font-size: 0.8rem !important;
                font-weight: 500 !important;
            }

            /* Footer text */
            .auth-footer {
                margin-top: 1.5rem;
                text-align: center;
                font-size: 0.85rem;
                color: #64748b;
                z-index: 10;
            }

            .auth-footer a {
                color: #2dd4bf;
                text-decoration: none;
                font-weight: 600;
            }

            .auth-footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg-glow-1"></div>
        <div class="bg-glow-2"></div>

        <div class="auth-logo">
            <a href="/">
                <div class="logo-icon">P</div>
            </a>
        </div>

        <div class="auth-container">
            {{ $slot }}
        </div>

        <div class="auth-footer">
            &copy; 2026 {{ config('app.name', 'Portfolio') }}. All rights reserved.
        </div>
    </body>
</html>
