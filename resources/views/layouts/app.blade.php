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
            TEMA KONTRAST & ELEGAN: DEEP NAVY + GOLD / TEAL
        ------------------------------------------------------------- */
        :root {
            --page: #0a0f1c;        /* latar utama gelap */
            --page-cool: #0f1624;   /* gradien kedua */
            --surface: #1a2235;     /* kartu, panel */
            --surface-strong: #121926;
            --ink: #eef2ff;         /* teks utama terang */
            --muted: #94a3b8;       /* teks sekunder abu-abu */
            --line: #2d3a5e;        /* garis pemisah */
            --deep: #070b14;        /* sidebar, footer */
            --deep-soft: #0f172a;
            --green: #2dd4bf;       /* teal terang (aksen) */
            --green-dark: #14b8a6;
            --green-soft: #134e4a;
            --amber: #fbbf24;       /* emas/amber */
            --amber-soft: #451a03;
            --blue: #60a5fa;
            --rose: #fb7185;
            
            /* Efek & bayangan */
            --shadow-sm: 0 12px 28px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 20px 35px -10px rgba(0, 0, 0, 0.4);
            --shadow-hover: 0 30px 45px -12px rgba(0, 0, 0, 0.5);
            --shadow-glow-green: 0 0 12px rgba(45, 212, 191, 0.4);
            --shadow-glow-amber: 0 0 12px rgba(251, 191, 36, 0.3);
            --transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
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
        }

        /* Animasi global */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* -------------------------------------------------------------
            LAYOUT & BACKGROUND UTAMA
        ------------------------------------------------------------- */
        .site-shell {
            min-height: 100vh;
            background: radial-gradient(circle at 10% 20%, rgba(45, 212, 191, 0.05), transparent 70%),
                        linear-gradient(145deg, var(--page) 0%, #0e1422 100%);
        }

        /* Header Sticky + Blur (glass) */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(45, 212, 191, 0.2);
            background: rgba(10, 15, 28, 0.85);
            backdrop-filter: blur(20px);
            transition: background 0.2s;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: min(1200px, calc(100% - 48px));
            margin: 0 auto;
            padding: 20px 0;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.2rem;
            transition: var(--transition);
            color: var(--ink);
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #0a0f1c;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s;
        }

        .brand:hover .brand-mark {
            transform: scale(1.05) rotate(2deg);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-links a {
            padding: 10px 18px;
            border-radius: 40px;
            font-weight: 600;
            transition: var(--transition);
            color: var(--muted);
            letter-spacing: -0.2px;
        }

        .nav-links a:hover,
        .nav-links a:focus {
            background: rgba(45, 212, 191, 0.15);
            color: var(--green);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(45, 212, 191, 0.1);
        }

        /* Container umum */
        .container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        /* -------------------------------------------------------------
            HERO SECTION
        ------------------------------------------------------------- */
        .hero {
            display: grid;
            grid-template-columns: 1fr 0.8fr;
            gap: 56px;
            align-items: center;
            min-height: calc(100vh - 85px);
            padding: 60px 0 70px;
            animation: fadeInUp 0.7s ease-out;
        }

        .eyebrow {
            margin-bottom: 20px;
            color: var(--green);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: rgba(45, 212, 191, 0.2);
            display: inline-block;
            padding: 5px 14px;
            border-radius: 60px;
        }

        .hero h1 {
            font-size: 64px;
            line-height: 1.05;
            background: linear-gradient(145deg, var(--ink), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 16px;
        }

        .lead {
            font-size: 1.2rem;
            color: var(--muted);
            line-height: 1.6;
            max-width: 90%;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .pill {
            background: rgba(26, 34, 53, 0.9);
            backdrop-filter: blur(4px);
            border: 1px solid var(--line);
            border-radius: 60px;
            padding: 8px 20px;
            font-weight: 600;
            transition: var(--transition);
            color: var(--muted);
        }

        .pill:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
            border-color: var(--green);
            color: var(--green);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 32px;
        }

        /* -------------------------------------------------------------
            BUTTONS (GLOW & INTERAKTIF)
        ------------------------------------------------------------- */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 60px;
            padding: 12px 28px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border: none;
            gap: 8px;
        }

        .button:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-glow-green);
        }

        .button:active {
            transform: translateY(1px);
        }

        .button-primary,
        .button:not(.button-secondary):not(.button-light):not(.button-danger) {
            background: var(--green);
            color: #0a0f1c;
            border: none;
        }

        .button-primary:hover,
        .button:not(.button-secondary):not(.button-light):not(.button-danger):hover {
            background: var(--green-dark);
            box-shadow: var(--shadow-glow-green);
            color: white;
        }

        .button-secondary {
            background: var(--surface);
            border: 1px solid var(--line);
            color: var(--ink);
        }

        .button-secondary:hover {
            background: rgba(45, 212, 191, 0.15);
            border-color: var(--green);
            color: var(--green);
        }

        .button-danger {
            background: var(--rose);
            border-color: var(--rose);
            color: white;
        }

        .button-danger:hover {
            background: #e05a5a;
            box-shadow: 0 0 8px rgba(251, 113, 133, 0.5);
        }

        .button-light {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--muted);
        }

        .button-light:hover {
            background: rgba(45, 212, 191, 0.1);
            border-color: var(--green);
            color: var(--green);
        }

        /* -------------------------------------------------------------
            PORTRAIT / FOTO
        ------------------------------------------------------------- */
        .portrait-frame {
            justify-self: end;
            width: min(100%, 320px);
        }

        .portrait {
            border-radius: 36px;
            background: rgba(26, 34, 53, 0.7);
            backdrop-filter: blur(4px);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid rgba(45, 212, 191, 0.3);
            overflow: hidden;
        }

        .portrait:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-hover);
            border-color: var(--green);
        }

        .portrait img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .portrait-placeholder {
            color: var(--green);
            font-size: 72px;
            font-weight: 800;
            padding: 40px;
            text-align: center;
            background: var(--surface);
        }

        /* -------------------------------------------------------------
            SECTION UMUM (dengan background unik per bagian)
        ------------------------------------------------------------- */
        .section {
            padding: 90px 0;
            border-top: 1px solid var(--line);
            position: relative;
            animation: fadeInUp 0.7s ease-out;
        }

        .section-header {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 48px;
            margin-bottom: 48px;
        }

.section-kicker {
    font-size: 14px;
    font-weight: 800;
    color: var(--amber);
    text-transform: uppercase;
    letter-spacing: 2px;

    background: rgba(251, 191, 36, 0.15);

    display: flex;
    justify-content: center;
    align-items: center;

    width: fit-content;

    padding: 12px 28px;

    border-radius: 999px;

    margin: 0 auto;
}

        .section-title {
            font-size: 40px;
            font-weight: 800;
            line-height: 1.2;
            background: linear-gradient(120deg, var(--ink), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .section-copy {
            margin: 12px 0 0;
            color: var(--muted);
            line-height: 1.75;
        }

        /* Background artistik per section */
        #skills {
            background: radial-gradient(circle at 10% 40%, rgba(45, 212, 191, 0.05), transparent);
        }
        #experience {
            background: repeating-linear-gradient(45deg, rgba(96, 165, 250, 0.03) 0px, rgba(96, 165, 250, 0.03) 1px, transparent 1px, transparent 12px);
        }
        #education {
            background: radial-gradient(ellipse at 70% 30%, rgba(251, 191, 36, 0.04), transparent);
        }
        #projects {
            background: repeating-radial-gradient(circle at 20% 30%, rgba(45, 212, 191, 0.03) 0px, rgba(45, 212, 191, 0.03) 2px, transparent 2px, transparent 8px);
        }
        #about {
            background: linear-gradient(115deg, rgba(45, 212, 191, 0.03) 0%, rgba(251, 191, 36, 0.03) 100%);
        }

        /* -------------------------------------------------------------
            CARD (BASE) + INTERAKSI GLASS
        ------------------------------------------------------------- */
        .card {
            border-radius: 28px;
            background: rgba(26, 34, 53, 0.85);
            backdrop-filter: blur(4px);
            border: 1px solid var(--line);
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(45, 212, 191, 0.6);
            background: var(--surface);
        }

        /* Skill Card */
        .skill-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
        }

        .skill-card {
            padding: 28px;
        }

        .skill-card h3 {
            font-size: 1.5rem;
            margin-bottom: 12px;
            color: var(--green);
        }

        .skill-card p {
            color: var(--muted);
            line-height: 1.65;
        }

        .meter {
            width: 100%;
            height: 8px;
            background: #2d3a5e;
            border-radius: 60px;
            overflow: hidden;
            margin-top: 20px;
        }

        .meter span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, var(--green), var(--amber));
            border-radius: 60px;
            transition: width 0.6s ease;
        }

        /* Timeline & Project Cards */
        .timeline-grid,
        .project-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 28px;
        }

        .timeline-card,
        .project-card {
            padding: 28px;
        }

        .period {
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            margin-bottom: 14px;
            color: var(--amber);
        }

        .timeline-card h3,
        .project-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.35rem;
            color: var(--ink);
        }

        .timeline-card p,
        .project-card p {
            color: var(--muted);
            line-height: 1.65;
        }

        .project-image {
            border-radius: 20px;
            overflow: hidden;
            min-height: 180px;
            background: #0f172a;
            display: grid;
            place-items: center;
            transition: transform 0.4s ease;
        }

        .project-card:hover .project-image {
            transform: scale(0.98);
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tech {
            display: inline-block;
            background: rgba(251, 191, 36, 0.2);
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--amber);
            margin-top: 12px;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            background: rgba(26, 34, 53, 0.8);
            backdrop-filter: blur(8px);
            border-radius: 48px;
            border: 1px dashed var(--amber);
            padding: 48px;
            text-align: center;
            color: var(--muted);
            font-weight: 500;
        }

        /* Split Grid (About) */
        .split-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.92fr) minmax(0, 1.08fr);
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
            gap: 18px;
            background: rgba(26, 34, 53, 0.6);
            backdrop-filter: blur(4px);
            padding: 16px;
            border-radius: 20px;
            transition: var(--transition);
            color: var(--muted);
        }

        .info-list li:hover {
            background: var(--surface);
            transform: translateX(6px);
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--green);
        }

        .info-list strong {
            color: var(--ink);
        }

        /* -------------------------------------------------------------
            DASHBOARD (SIDEBAR & MAIN)
        ------------------------------------------------------------- */
        .dashboard-shell {
            display: grid;
            grid-template-columns: 284px minmax(0, 1fr);
            min-height: 100vh;
            background: var(--page);
        }

        .dashboard-sidebar {
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 24px;
            background: var(--deep);
            color: #f7efe0;
            box-shadow: 6px 0 18px rgba(0, 0, 0, 0.3);
            border-right: 1px solid var(--line);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 22px;
            border-bottom: 1px solid rgba(45, 212, 191, 0.3);
        }

        .sidebar-mark {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border-radius: 12px;
            background: var(--green);
            color: #0a0f1c;
            font-weight: 800;
        }

        .sidebar-brand strong {
            display: block;
            color: var(--ink);
            line-height: 1.1;
        }

        .sidebar-brand span {
            color: var(--muted);
            font-size: 13px;
        }

        .dashboard-nav {
            display: grid;
            gap: 8px;
            margin-top: 24px;
        }

        .dashboard-nav a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 12px;
            border: 1px solid transparent;
            border-radius: 12px;
            color: var(--muted);
            font-weight: 750;
            transition: var(--transition);
        }

        .dashboard-nav a:hover,
        .dashboard-nav a:focus {
            border-color: var(--green);
            background: rgba(45, 212, 191, 0.1);
            color: var(--green);
            transform: translateX(4px);
        }

        .sidebar-footer {
            display: grid;
            gap: 10px;
            margin-top: auto;
            padding-top: 24px;
        }

        .sidebar-user {
            padding: 12px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
            color: var(--muted);
            font-size: 14px;
        }

        .sidebar-user strong {
            display: block;
            color: var(--ink);
        }

        .logout-button {
            width: 100%;
            border-color: var(--line);
            background: transparent;
            color: var(--muted);
        }

        .logout-button:hover {
            background: rgba(251, 113, 133, 0.15);
            color: var(--rose);
            border-color: var(--rose);
        }

        .dashboard-main {
            min-width: 0;
            padding: 34px;
        }

        .dashboard-topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 22px;
        }

        .dashboard-title {
            margin: 0;
            font-size: 38px;
            line-height: 1.08;
            font-weight: 800;
            background: linear-gradient(145deg, var(--ink), var(--green));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .dashboard-subtitle {
            max-width: 660px;
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .dashboard-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        /* Alert */
        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: var(--surface);
        }

        .alert-success {
            border-color: var(--green);
            background: rgba(45, 212, 191, 0.1);
            color: var(--green);
        }

        .alert-error {
            border-color: var(--rose);
            background: rgba(251, 113, 133, 0.1);
            color: var(--rose);
        }

        /* Metric Cards */
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .metric-card {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--green);
        }

        .metric-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 6px;
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
            font-size: 32px;
            line-height: 1;
            color: var(--ink);
        }

        .metric-card span {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        /* Admin Panel */
        .admin-section {
            scroll-margin-top: 18px;
            margin-top: 22px;
        }

        .admin-panel {
            border: 1px solid var(--line);
            border-radius: 28px;
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .admin-panel:hover {
            box-shadow: var(--shadow-md);
        }

        .admin-panel.alt-green {
            border-top: 5px solid var(--green);
        }
        .admin-panel.alt-amber {
            border-top: 5px solid var(--amber);
        }
        .admin-panel.alt-blue {
            border-top: 5px solid var(--blue);
        }
        .admin-panel.alt-rose {
            border-top: 5px solid var(--rose);
        }

        .admin-panel-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
            padding: 22px;
            border-bottom: 1px solid var(--line);
            background: var(--surface-strong);
        }

        .admin-panel-head h2 {
            margin: 0;
            font-size: 24px;
            line-height: 1.2;
            color: var(--ink);
        }

        .admin-panel-head p {
            margin: 6px 0 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .admin-panel-body {
            padding: 22px;
        }

        /* Form Elements */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-grid.compact {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full,
        .check-field.full {
            grid-column: 1 / -1;
        }

        label,
        .field-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 800;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: var(--deep);
            color: var(--ink);
            padding: 11px 14px;
            outline: none;
            transition: var(--transition);
        }

        input:focus,
        textarea:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(45, 212, 191, 0.2);
        }

        input[type="file"] {
            padding: 9px 12px;
        }

        input[type="checkbox"] {
            width: auto;
        }

        .check-field {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin-top: 20px;
        }

        /* Records */
        .records {
            display: grid;
            gap: 16px;
            margin-top: 20px;
        }

        .record {
            padding: 18px;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: rgba(18, 25, 38, 0.8);
            transition: var(--transition);
        }

        .record:hover {
            background: var(--surface);
            box-shadow: var(--shadow-sm);
            transform: translateX(4px);
            border-color: var(--green);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
        }

        .record-header strong {
            overflow-wrap: anywhere;
            color: var(--ink);
        }

        .record-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .delete-form {
            margin-top: 12px;
        }

        .thumb {
            display: grid;
            width: 92px;
            height: 92px;
            overflow: hidden;
            place-items: center;
            border-radius: 16px;
            background: var(--deep);
            color: var(--muted);
            font-size: 12px;
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
            background: rgba(7, 11, 20, 0.9);
            backdrop-filter: blur(4px);
            color: var(--muted);
        }

        /* -------------------------------------------------------------
            RESPONSIVE (tetap sama)
        ------------------------------------------------------------- */
        @media (max-width: 1100px) {
            .dashboard-shell {
                grid-template-columns: 1fr;
            }
            .dashboard-sidebar {
                position: relative;
                height: auto;
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
                gap: 40px;
            }
            .hero h1 {
                font-size: 52px;
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
                font-size: 32px;
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
                padding-top: 46px;
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
            }
            .nav-links {
                justify-content: center;
            }
            .hero h1 {
                font-size: 42px;
            }
            .section {
                padding: 60px 0;
            }
            .button {
                width: 100%;
                justify-content: center;
            }
            .dashboard-nav {
                grid-template-columns: 1fr;
            }
            .metric-grid {
                grid-template-columns: 1fr;
            }
            .dashboard-main {
                padding: 20px 14px 32px;
            }
        }

        /* Efek tambahan */
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
.split-grid{
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