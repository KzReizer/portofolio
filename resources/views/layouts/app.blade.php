<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Portfolio'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        /* -------------------------------------------------------------
            TEMA HIGH-FIDELITY: DEEP NAVY + TEAL NEON + AMBER GOLD (GLASS)
        ------------------------------------------------------------- */
        :root {
            --page: #060b16;        /* Deep space navy background */
            --page-cool: #0b132b;   /* Midnight indigo */
            --surface: rgba(22, 33, 62, 0.45);     /* Sleek Glass surface */
            --surface-strong: rgba(15, 23, 42, 0.85); /* Solid glass base */
            --surface-card: rgba(26, 38, 74, 0.35);
            --ink: #f8fafc;         /* High-contrast off-white text */
            --muted: #94a3b8;       /* Muted slate text */
            --line: rgba(255, 255, 255, 0.08); /* Fine glass division lines */
            --line-active: rgba(45, 212, 191, 0.25);
            --deep: #030712;        /* True black/deep navy sidebar */
            --deep-soft: #080d1a;
            --green: #2dd4bf;       /* Neon Teal accent */
            --green-dark: #0d9488;
            --green-soft: rgba(45, 212, 191, 0.12);
            --amber: #fbbf24;       /* Radiant Gold accent */
            --amber-dark: #d97706;
            --amber-soft: rgba(251, 191, 36, 0.12);
            --blue: #38bdf8;        /* Electric Sky Blue */
            --blue-soft: rgba(56, 189, 248, 0.12);
            --rose: #f43f5e;        /* Soft Rose Red */
            --rose-soft: rgba(244, 63, 94, 0.12);
            
            /* Shadows & Advanced Glows */
            --shadow-sm: 0 8px 32px rgba(0, 0, 0, 0.25);
            --shadow-md: 0 16px 40px -10px rgba(0, 0, 0, 0.45);
            --shadow-hover: 0 25px 60px -12px rgba(45, 212, 191, 0.15);
            --shadow-glow-green: 0 0 20px rgba(45, 212, 191, 0.25);
            --shadow-glow-amber: 0 0 20px rgba(251, 191, 36, 0.2);
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--page);
            color: var(--ink);
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        /* -------------------------------------------------------------
            CUSTOM MODERN SCROLLBAR
        ------------------------------------------------------------- */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--page);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 99px;
            border: 2px solid var(--page);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--green);
        }

        /* -------------------------------------------------------------
            GLOBAL ENHANCEMENTS
        ------------------------------------------------------------- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.05); }
        }

        /* -------------------------------------------------------------
            LAYOUT & BACKGROUND UTAMA
        ------------------------------------------------------------- */
        .site-shell {
            min-height: 100vh;
            background-color: var(--page);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(45, 212, 191, 0.07) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(56, 189, 248, 0.06) 0%, transparent 45%),
                linear-gradient(145deg, var(--page) 0%, #080d19 100%);
            position: relative;
        }

        /* Ambient grid pattern overlay */
        .site-shell::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        /* Floating glass header */
        .site-header {
            position: sticky;
            top: 20px;
            z-index: 50;
            border: 1px solid var(--line);
            background: rgba(8, 13, 26, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            margin: 0 auto;
            width: min(1200px, calc(100% - 32px));
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            transition: var(--transition);
        }

        .site-header:hover {
            border-color: rgba(45, 212, 191, 0.2);
            box-shadow: 0 12px 40px rgba(45, 212, 191, 0.08);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: 100%;
            margin: 0 auto;
            padding: 16px 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.25rem;
            transition: var(--transition);
            color: var(--ink);
            text-decoration: none;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #030712;
            font-size: 1.1rem;
            font-weight: 900;
            box-shadow: 0 4px 12px rgba(45, 212, 191, 0.25);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .brand:hover .brand-mark {
            transform: scale(1.1) rotate(5deg);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-links a {
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            color: var(--muted);
            text-decoration: none;
            letter-spacing: -0.1px;
            border: 1px solid transparent;
        }

        .nav-links a:hover,
        .nav-links a:focus {
            background: var(--green-soft);
            color: var(--green);
            border-color: rgba(45, 212, 191, 0.15);
            transform: translateY(-2px);
        }

        /* Container */
        .container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* -------------------------------------------------------------
            HERO SECTION
        ------------------------------------------------------------- */
        .hero {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 56px;
            align-items: center;
            min-height: calc(100vh - 120px);
            padding: 60px 0 80px;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) ease-out;
        }

        .eyebrow {
            margin-bottom: 20px;
            color: var(--green);
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: var(--green-soft);
            border: 1px solid rgba(45, 212, 191, 0.2);
            display: inline-block;
            padding: 6px 16px;
            border-radius: 60px;
            box-shadow: 0 4px 10px rgba(45, 212, 191, 0.05);
        }

        .hero h1 {
            font-size: clamp(2.5rem, 5.5vw, 4.2rem);
            line-height: 1.1;
            font-weight: 900;
            background: linear-gradient(135deg, var(--ink) 30%, var(--green) 70%, var(--blue) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }

        .lead {
            font-size: 1.2rem;
            color: var(--muted);
            line-height: 1.7;
            max-width: 90%;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 32px;
        }

        .pill {
            background: rgba(22, 33, 62, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--line);
            border-radius: 60px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: var(--transition);
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pill:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: rgba(45, 212, 191, 0.3);
            color: var(--green);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 36px;
        }

        /* -------------------------------------------------------------
            BUTTONS (PREMIUM GLOW & INTERACTION)
        ------------------------------------------------------------- */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 60px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid transparent;
            gap: 10px;
            text-decoration: none;
        }

        .button:hover {
            transform: translateY(-3px);
        }

        .button:active {
            transform: translateY(1px);
        }

        .button-primary,
        .button:not(.button-secondary):not(.button-light):not(.button-danger) {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-dark) 100%);
            color: #030712;
            box-shadow: 0 4px 14px rgba(45, 212, 191, 0.25);
        }

        .button-primary:hover,
        .button:not(.button-secondary):not(.button-light):not(.button-danger):hover {
            background: linear-gradient(135deg, var(--green) 0%, var(--green) 100%);
            box-shadow: var(--shadow-glow-green);
            color: #030712;
        }

        .button-secondary {
            background: rgba(22, 33, 62, 0.6);
            border: 1px solid var(--line);
            color: var(--ink);
            backdrop-filter: blur(8px);
        }

        .button-secondary:hover {
            background: var(--green-soft);
            border-color: var(--green);
            color: var(--green);
            box-shadow: 0 4px 14px rgba(45, 212, 191, 0.1);
        }

        .button-danger {
            background: var(--rose-soft);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: var(--rose);
        }

        .button-danger:hover {
            background: var(--rose);
            color: #030712;
            box-shadow: 0 0 15px rgba(244, 63, 94, 0.3);
            border-color: var(--rose);
        }

        .button-light {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--muted);
        }

        .button-light:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--ink);
        }

        /* -------------------------------------------------------------
            PORTRAIT / AVATAR
        ------------------------------------------------------------- */
        .portrait-frame {
            justify-self: end;
            width: min(100%, 350px);
            position: relative;
        }

        /* Dynamic background light orb behind portrait */
        .portrait-frame::before {
            content: "";
            position: absolute;
            inset: -20px;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%);
            z-index: 0;
            border-radius: 50%;
            animation: pulseGlow 6s ease-in-out infinite;
        }

        .portrait {
            position: relative;
            border-radius: 40px;
            background: rgba(26, 38, 74, 0.3);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.08);
            overflow: hidden;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .portrait:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: var(--shadow-hover);
            border-color: var(--green);
        }

        .portrait img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portrait:hover img {
            transform: scale(1.04);
        }

        .portrait-placeholder {
            color: var(--green);
            font-size: 80px;
            font-weight: 900;
            letter-spacing: -2px;
            text-align: center;
        }

        /* -------------------------------------------------------------
            SECTION SETUP
        ------------------------------------------------------------- */
        .section {
            padding: 100px 0;
            border-top: 1px solid var(--line);
            position: relative;
            z-index: 10;
        }

        .section-header {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 48px;
            margin-bottom: 56px;
            align-items: start;
        }

        .section-kicker {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--amber);
            text-transform: uppercase;
            letter-spacing: 2px;
            background: var(--amber-soft);
            border: 1px solid rgba(251, 191, 36, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            padding: 6px 18px;
            border-radius: 99px;
            box-shadow: 0 4px 10px rgba(251, 191, 36, 0.05);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 900;
            line-height: 1.2;
            background: linear-gradient(135deg, var(--ink), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-top: 8px;
            letter-spacing: -0.01em;
        }

        .section-copy {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.75;
        }

        /* Creative background variants per section */
        #skills {
            background: radial-gradient(circle at 10% 40%, rgba(45, 212, 191, 0.04), transparent 60%);
        }
        #experience {
            background: radial-gradient(ellipse at 50% 50%, rgba(56, 189, 248, 0.03), transparent 70%);
        }
        #education {
            background: radial-gradient(circle at 90% 20%, rgba(251, 191, 36, 0.03), transparent 60%);
        }
        #projects {
            background: radial-gradient(circle at 20% 80%, rgba(45, 212, 191, 0.04), transparent 60%);
        }
        #about {
            background: linear-gradient(180deg, transparent, rgba(3, 7, 18, 0.4), transparent);
        }

        /* -------------------------------------------------------------
            CARDS (GLASSMORPHIC CARDS)
        ------------------------------------------------------------- */
        .card {
            border-radius: var(--radius-lg);
            background: rgba(22, 33, 62, 0.35);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--line);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, transparent 100%);
            pointer-events: none;
            z-index: 1;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(45, 212, 191, 0.35);
            background: rgba(26, 38, 74, 0.45);
        }

        /* Skill Card & Grid */
        .skill-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
        }

        .skill-card {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
        }

        .skill-card h3 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--green);
            letter-spacing: -0.2px;
        }

        .skill-card p {
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .meter {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 60px;
            overflow: hidden;
            margin-top: 20px;
            position: relative;
        }

        .meter span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--blue));
            border-radius: 60px;
            transition: width 1s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 0 10px rgba(45, 212, 191, 0.4);
        }

        /* Timeline & Project Cards */
        .timeline-grid,
        .project-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 32px;
        }

        .timeline-card,
        .project-card {
            padding: 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .period {
            font-weight: 800;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
            color: var(--amber);
            background: var(--amber-soft);
            padding: 4px 12px;
            border-radius: 40px;
            width: fit-content;
            border: 1px solid rgba(251, 191, 36, 0.15);
        }

        .timeline-card h3,
        .project-card h3 {
            margin: 0 0 8px 0;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -0.3px;
        }

        .timeline-card p,
        .project-card p {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .timeline-card p strong {
            color: #cbd5e1;
            font-weight: 600;
        }

        .project-image {
            border-radius: 16px;
            overflow: hidden;
            min-height: 190px;
            background: rgba(3, 7, 18, 0.5);
            border: 1px solid var(--line);
            display: grid;
            place-items: center;
            transition: transform 0.4s var(--transition);
            margin-bottom: 20px;
            position: relative;
        }

        .project-card:hover .project-image {
            transform: scale(0.98);
            border-color: rgba(45, 212, 191, 0.2);
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s var(--transition);
        }

        .project-card:hover .project-image img {
            transform: scale(1.05);
        }

        .project-image span {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--muted);
        }

        .tech {
            display: inline-block;
            background: var(--green-soft);
            border: 1px solid rgba(45, 212, 191, 0.15);
            padding: 4px 14px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--green);
            margin-top: 14px;
            width: fit-content;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            background: rgba(22, 33, 62, 0.2);
            backdrop-filter: blur(8px);
            border-radius: var(--radius-lg);
            border: 1.5px dashed var(--line);
            padding: 56px;
            text-align: center;
            color: var(--muted);
            font-weight: 600;
            font-size: 1.05rem;
        }

        /* Split Grid (About) */
        .split-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
            gap: 32px;
            align-items: start;
        }

        .info-list {
            display: grid;
            gap: 14px;
            list-style: none;
            padding: 0;
        }

        .info-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            background: rgba(22, 33, 62, 0.25);
            backdrop-filter: blur(8px);
            padding: 18px 22px;
            border-radius: var(--radius-md);
            border: 1px solid var(--line);
            transition: var(--transition);
            color: var(--muted);
            font-size: 0.95rem;
        }

        .info-list li:hover {
            background: rgba(26, 38, 74, 0.4);
            transform: translateX(6px);
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--green);
            border-color: rgba(45, 212, 191, 0.2);
        }

        .info-list strong {
            color: var(--ink);
            font-weight: 700;
        }

        /* -------------------------------------------------------------
            DASHBOARD (SIDEBAR & MAIN GLASS SaaS PANEL)
        ------------------------------------------------------------- */
        .dashboard-shell {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            min-height: 100vh;
            background-color: var(--page);
            background-image: 
                radial-gradient(circle at 300px 100px, rgba(45, 212, 191, 0.05) 0%, transparent 60%),
                linear-gradient(135deg, var(--page) 0%, #080d19 100%);
        }

        .dashboard-sidebar {
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 32px 24px;
            background: rgba(3, 7, 18, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 10px 0 35px rgba(0, 0, 0, 0.4);
            border-right: 1px solid var(--line);
            z-index: 40;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--line);
        }

        .sidebar-mark {
            display: grid;
            width: 44px;
            height: 44px;
            place-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            color: #030712;
            font-weight: 900;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px rgba(45, 212, 191, 0.3);
        }

        .sidebar-brand strong {
            display: block;
            color: var(--ink);
            font-size: 1rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .sidebar-brand span {
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .dashboard-nav {
            display: grid;
            gap: 8px;
            margin-top: 32px;
        }

        .dashboard-nav a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 18px;
            border: 1px solid transparent;
            border-radius: var(--radius-md);
            color: var(--muted);
            font-weight: 700;
            font-size: 0.9rem;
            transition: var(--transition);
            text-decoration: none;
        }

        .dashboard-nav a:hover,
        .dashboard-nav a:focus {
            border-color: rgba(45, 212, 191, 0.2);
            background: var(--green-soft);
            color: var(--green);
            transform: translateX(6px);
            box-shadow: inset 0 0 10px rgba(45, 212, 191, 0.05);
        }

        .dashboard-nav a span {
            font-size: 0.75rem;
            opacity: 0.5;
            background: rgba(255, 255, 255, 0.05);
            padding: 2px 8px;
            border-radius: 20px;
        }

        .dashboard-nav a:hover span {
            background: rgba(45, 212, 191, 0.15);
            color: var(--green);
            opacity: 0.8;
        }

        .sidebar-footer {
            display: grid;
            gap: 12px;
            margin-top: auto;
            padding-top: 24px;
            border-top: 1px solid var(--line);
        }

        .sidebar-user {
            padding: 16px;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, 0.02);
            color: var(--muted);
            font-size: 0.8rem;
        }

        .sidebar-user strong {
            display: block;
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .logout-button {
            width: 100%;
            border: 1px solid var(--line) !important;
            background: transparent !important;
            color: var(--muted) !important;
            padding: 10px !important;
        }

        .logout-button:hover {
            background: var(--rose-soft) !important;
            color: var(--rose) !important;
            border-color: rgba(244, 63, 94, 0.3) !important;
            box-shadow: 0 4px 12px rgba(244, 63, 94, 0.1) !important;
        }

        .dashboard-main {
            min-width: 0;
            padding: 44px;
            overflow-y: auto;
            position: relative;
        }

        .dashboard-topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 32px;
            position: relative;
            z-index: 10;
        }

        .dashboard-title {
            margin: 0;
            font-size: 2.5rem;
            line-height: 1.1;
            font-weight: 900;
            background: linear-gradient(135deg, var(--ink), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -1px;
        }

        .dashboard-subtitle {
            max-width: 700px;
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.6;
        }

        .dashboard-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        /* Alerts Custom Design */
        .alert {
            margin-bottom: 24px;
            padding: 16px 20px;
            border-radius: var(--radius-md);
            border: 1px solid var(--line);
            font-weight: 600;
            font-size: 0.95rem;
            animation: fadeInUp 0.4s ease;
        }

        .alert-success {
            border-color: var(--green);
            background: var(--green-soft);
            color: var(--green);
            box-shadow: 0 0 15px rgba(45, 212, 191, 0.05);
        }

        .alert-error {
            border-color: var(--rose);
            background: var(--rose-soft);
            color: var(--rose);
            box-shadow: 0 0 15px rgba(244, 63, 94, 0.05);
        }

        .alert ul {
            padding-left: 20px;
            margin-top: 8px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        /* Dashboard Stat Metrics */
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .metric-card {
            position: relative;
            overflow: hidden;
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: rgba(22, 33, 62, 0.3);
            backdrop-filter: blur(8px);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(255, 255, 255, 0.15);
        }

        .metric-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 5px;
            background: var(--green);
            border-radius: 4px 0 0 4px;
        }

        .metric-card:nth-child(2)::before {
            background: var(--amber);
        }
        .metric-card:nth-child(3)::before {
            background: var(--blue);
        }
        .metric-card:nth-child(4)::before {
            background: var(--rose);
        }

        .metric-card strong {
            display: block;
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1;
            color: var(--ink);
            letter-spacing: -1px;
        }

        .metric-card span {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* -------------------------------------------------------------
            ADMIN PANEL (SaaS FORMS)
        ------------------------------------------------------------- */
        .admin-section {
            scroll-margin-top: 30px;
            margin-top: 36px;
            animation: fadeInUp 0.5s ease;
        }

        .admin-panel {
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: rgba(22, 33, 62, 0.25);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
        }

        .admin-panel:hover {
            box-shadow: var(--shadow-md);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .admin-panel.alt-green { border-top: 4px solid var(--green); }
        .admin-panel.alt-amber { border-top: 4px solid var(--amber); }
        .admin-panel.alt-blue { border-top: 4px solid var(--blue); }
        .admin-panel.alt-rose { border-top: 4px solid var(--rose); }

        .admin-panel-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            padding: 28px;
            border-bottom: 1px solid var(--line);
            background: rgba(15, 23, 42, 0.4);
        }

        .admin-panel-head h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 1.2;
            color: var(--ink);
            letter-spacing: -0.3px;
        }

        .admin-panel-head p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .admin-panel-body {
            padding: 28px;
        }

        /* Form Layout Elements */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .form-grid.compact {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full,
        .full {
            grid-column: 1 / -1;
        }

        label,
        .field-label {
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid var(--line) !important;
            border-radius: 14px !important;
            background: rgba(3, 7, 18, 0.6) !important;
            color: var(--ink) !important;
            padding: 12px 16px !important;
            outline: none !important;
            font-family: inherit;
            font-size: 0.95rem !important;
            transition: var(--transition) !important;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2) !important;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.15), 
                        inset 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        input[type="file"] {
            padding: 9px 12px !important;
            cursor: pointer;
        }

        input[type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            cursor: pointer;
            accent-color: var(--green);
            box-shadow: none !important;
        }

        .check-field {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin-top: 24px;
        }

        /* CRUD Records Custom Design */
        .records {
            display: grid;
            gap: 16px;
            margin-top: 28px;
            border-top: 1px solid var(--line);
            padding-top: 28px;
        }

        .record {
            padding: 24px;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: rgba(18, 25, 38, 0.4);
            transition: var(--transition);
        }

        .record:hover {
            background: rgba(26, 38, 74, 0.45);
            box-shadow: var(--shadow-sm);
            transform: translateX(4px);
            border-color: rgba(45, 212, 191, 0.25);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 20px;
        }

        .record-header strong {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -0.2px;
        }

        .record-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .delete-form {
            margin-top: 16px;
            display: inline-block;
        }

        .thumb {
            display: grid;
            width: 100px;
            height: 100px;
            overflow: hidden;
            place-items: center;
            border-radius: 16px;
            background: rgba(3, 7, 18, 0.6);
            color: var(--muted);
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid var(--line);
        }

        .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Footer */
        .footer {
            border-top: 1px solid var(--line);
            padding: 40px 0;
            text-align: center;
            background: rgba(3, 7, 18, 0.85);
            backdrop-filter: blur(10px);
            color: var(--muted);
            font-size: 0.9rem;
            font-weight: 600;
            position: relative;
            z-index: 10;
        }

        /* -------------------------------------------------------------
            RESPONSIVENESS (FLAWLESS PIXEL COHESION)
        ------------------------------------------------------------- */
        @media (max-width: 1100px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
            }
            .dashboard-sidebar {
                position: relative;
                height: auto;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                border-right: none;
                border-bottom: 1px solid var(--line);
            }
            .dashboard-nav {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .sidebar-footer {
                margin-top: 24px;
            }
        }

        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 48px;
                padding-top: 40px;
            }
            .hero h1 {
                font-size: clamp(2.2rem, 5vw, 3.5rem);
            }
            .lead {
                max-width: 100%;
            }
            .portrait-frame {
                justify-self: center;
            }
            .section-header {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .section-title {
                font-size: 2.2rem;
            }
            .metric-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .split-grid,
            .dashboard-topbar {
                grid-template-columns: 1fr;
            }
            .hero {
                min-height: auto;
            }
            .skill-grid,
            .project-grid,
            .timeline-grid,
            .form-grid,
            .form-grid.compact {
                grid-template-columns: 1fr;
            }
            .nav-links,
            .dashboard-actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 700px) {
            .nav {
                flex-direction: column;
                gap: 16px;
                padding: 16px;
            }
            .nav-links {
                justify-content: center;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .section {
                padding: 60px 0;
            }
            .button {
                width: 100%;
                justify-content: center;
            }
            .metric-grid {
                grid-template-columns: 1fr;
            }
            .dashboard-main {
                padding: 24px 16px;
            }
        }

        a, button {
            cursor: pointer;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .card,
        .skill-grid,
        .timeline-grid,
        .project-grid,
        .split-grid {
            margin-inline: auto;
        }
        </style>

        @stack('styles')
    </head>
    <body>
        @if (isset($slot))
            <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')

                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        @else
            @yield('content')
        @endif

        @stack('scripts')
    </body>
</html>