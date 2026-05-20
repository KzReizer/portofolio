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
            :root {
                --page: #f6f1e8;
                --page-cool: #eef4f2;
                --surface: #ffffff;
                --surface-strong: #fbfcfa;
                --ink: #15191d;
                --muted: #68727a;
                --line: #d8d9d0;
                --deep: #101820;
                --deep-soft: #1b2630;
                --green: #187c67;
                --green-dark: #0d5b4c;
                --green-soft: #dceee8;
                --amber: #b06b22;
                --amber-soft: #f5e4cf;
                --blue: #355c7d;
                --rose: #a63d40;
                --shadow: 0 18px 50px rgba(21, 25, 29, 0.09);
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                background: var(--page);
                color: var(--ink);
                font-family: Figtree, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                letter-spacing: 0;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            img {
                display: block;
                max-width: 100%;
            }

            button,
            input,
            textarea {
                font: inherit;
            }

            textarea {
                resize: vertical;
            }

            .site-shell {
                min-height: 100vh;
                background:
                    linear-gradient(180deg, var(--page) 0%, #fbfaf6 52%, var(--page-cool) 100%);
            }

            .site-header {
                position: sticky;
                top: 0;
                z-index: 10;
                border-bottom: 1px solid rgba(216, 217, 208, 0.9);
                background: rgba(246, 241, 232, 0.93);
                backdrop-filter: blur(16px);
            }

            .nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                width: min(1120px, calc(100% - 32px));
                margin: 0 auto;
                padding: 18px 0;
            }

            .brand {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                min-width: 0;
                color: var(--ink);
                font-weight: 800;
            }

            .brand-mark {
                display: grid;
                width: 36px;
                height: 36px;
                place-items: center;
                border: 1px solid rgba(16, 24, 32, 0.18);
                border-radius: 8px;
                background: var(--deep);
                color: #f7efe0;
                font-size: 13px;
                flex: 0 0 auto;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .nav-links a {
                padding: 8px 12px;
                border-radius: 8px;
                color: var(--muted);
                font-size: 14px;
                font-weight: 700;
            }

            .nav-links a:hover,
            .nav-links a:focus {
                background: var(--green-soft);
                color: var(--green-dark);
            }

            .container {
                width: min(1120px, calc(100% - 32px));
                margin: 0 auto;
            }

            .hero {
                display: grid;
                grid-template-columns: minmax(0, 1.1fr) minmax(260px, 0.72fr);
                gap: 48px;
                align-items: center;
                min-height: calc(100vh - 73px);
                padding: 70px 0 46px;
            }

            .eyebrow {
                margin: 0 0 16px;
                color: var(--green-dark);
                font-size: 13px;
                font-weight: 800;
                text-transform: uppercase;
            }

            .hero h1 {
                margin: 0;
                max-width: 760px;
                color: var(--ink);
                font-size: 56px;
                line-height: 1.02;
                font-weight: 800;
            }

            .lead {
                max-width: 640px;
                margin: 22px 0 0;
                color: var(--muted);
                font-size: 19px;
                line-height: 1.75;
            }

            .hero-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 28px;
            }

            .pill {
                display: inline-flex;
                align-items: center;
                min-height: 38px;
                padding: 8px 13px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.8);
                color: var(--muted);
                font-size: 14px;
                font-weight: 700;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 32px;
            }

            .button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 42px;
                padding: 10px 16px;
                border: 1px solid var(--green);
                border-radius: 8px;
                background: var(--green);
                color: #ffffff;
                font-weight: 800;
                cursor: pointer;
            }

            .button:hover,
            .button:focus {
                background: var(--green-dark);
                border-color: var(--green-dark);
            }

            .button-secondary {
                border-color: var(--line);
                background: var(--surface);
                color: var(--ink);
            }

            .button-secondary:hover,
            .button-secondary:focus {
                background: var(--green-soft);
                border-color: #b7d8cc;
            }

            .button-danger {
                border-color: var(--rose);
                background: var(--rose);
            }

            .button-light {
                border-color: var(--line);
                background: transparent;
                color: var(--muted);
            }

            .portrait-frame {
                justify-self: end;
                width: min(100%, 350px);
            }

            .portrait {
                display: grid;
                width: 100%;
                aspect-ratio: 4 / 5;
                overflow: hidden;
                place-items: center;
                border: 1px solid rgba(16, 24, 32, 0.17);
                border-radius: 8px;
                background:
                    linear-gradient(135deg, rgba(24, 124, 103, 0.2), rgba(176, 107, 34, 0.17)),
                    var(--surface);
                box-shadow: var(--shadow);
            }

            .portrait img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .portrait-placeholder {
                color: var(--deep);
                font-size: 72px;
                font-weight: 800;
            }

            .section {
                padding: 78px 0;
                border-top: 1px solid var(--line);
            }

            .section-header {
                display: grid;
                grid-template-columns: 260px minmax(0, 1fr);
                gap: 32px;
                align-items: start;
                margin-bottom: 32px;
            }

            .section-kicker {
                margin: 0;
                color: var(--amber);
                font-size: 13px;
                font-weight: 800;
                text-transform: uppercase;
            }

            .section-title {
                margin: 0;
                font-size: 34px;
                line-height: 1.18;
            }

            .section-copy {
                margin: 12px 0 0;
                color: var(--muted);
                line-height: 1.75;
            }

            .split-grid {
                display: grid;
                grid-template-columns: minmax(0, 0.92fr) minmax(0, 1.08fr);
                gap: 26px;
                align-items: start;
            }

            .info-list {
                display: grid;
                gap: 14px;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .info-list li {
                display: flex;
                justify-content: space-between;
                gap: 18px;
                padding: 14px 0;
                border-bottom: 1px solid var(--line);
                color: var(--muted);
            }

            .info-list strong {
                color: var(--ink);
            }

            .skill-grid,
            .project-grid,
            .timeline-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
            }

            .timeline-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .card {
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
                box-shadow: 0 12px 40px rgba(21, 25, 29, 0.05);
            }

            .skill-card {
                padding: 18px;
            }

            .skill-card h3,
            .timeline-card h3,
            .project-card h3 {
                margin: 0;
                font-size: 18px;
            }

            .skill-card p,
            .timeline-card p,
            .project-card p {
                color: var(--muted);
                line-height: 1.65;
            }

            .meter {
                width: 100%;
                height: 9px;
                overflow: hidden;
                border-radius: 99px;
                background: #e9e2d6;
            }

            .meter span {
                display: block;
                height: 100%;
                border-radius: inherit;
                background: linear-gradient(90deg, var(--green), var(--amber));
            }

            .timeline-card,
            .project-card {
                padding: 22px;
            }

            .period {
                margin: 0 0 10px;
                color: var(--green-dark);
                font-size: 14px;
                font-weight: 800;
            }

            .project-card {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .project-image {
                display: grid;
                min-height: 180px;
                overflow: hidden;
                place-items: center;
                border-radius: 8px;
                background:
                    linear-gradient(135deg, rgba(53, 92, 125, 0.18), rgba(176, 107, 34, 0.18)),
                    #f5efe4;
                color: var(--deep);
                font-weight: 800;
            }

            .project-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .tech {
                color: var(--amber);
                font-size: 14px;
                font-weight: 800;
            }

            .empty-state {
                grid-column: 1 / -1;
                padding: 26px;
                border: 1px dashed var(--line);
                border-radius: 8px;
                color: var(--muted);
                background: rgba(255, 255, 255, 0.72);
            }

            .footer {
                padding: 30px 0 44px;
                border-top: 1px solid var(--line);
                color: var(--muted);
            }

            .dashboard-shell {
                display: grid;
                grid-template-columns: 284px minmax(0, 1fr);
                min-height: 100vh;
                background: #f4f1e9;
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
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                padding-bottom: 22px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            }

            .sidebar-mark {
                display: grid;
                width: 42px;
                height: 42px;
                place-items: center;
                border-radius: 8px;
                background: var(--green);
                color: #ffffff;
                font-weight: 800;
            }

            .sidebar-brand strong {
                display: block;
                color: #ffffff;
                line-height: 1.1;
            }

            .sidebar-brand span {
                color: #aebbc4;
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
                border-radius: 8px;
                color: #c9d3d8;
                font-weight: 750;
            }

            .dashboard-nav a:hover,
            .dashboard-nav a:focus {
                border-color: rgba(255, 255, 255, 0.12);
                background: var(--deep-soft);
                color: #ffffff;
            }

            .sidebar-footer {
                display: grid;
                gap: 10px;
                margin-top: auto;
                padding-top: 24px;
            }

            .sidebar-footer .button {
                width: 100%;
            }

            .sidebar-user {
                padding: 12px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.05);
                color: #dbe4e7;
                font-size: 14px;
            }

            .sidebar-user strong {
                display: block;
                color: #ffffff;
            }

            .logout-button {
                width: 100%;
                border-color: rgba(255, 255, 255, 0.16);
                background: transparent;
                color: #f7efe0;
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
            }

            .dashboard-subtitle {
                max-width: 660px;
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.65;
            }

            .dashboard-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .alert {
                margin-bottom: 18px;
                padding: 14px 16px;
                border-radius: 8px;
                border: 1px solid var(--line);
                background: var(--surface);
            }

            .alert-success {
                border-color: #afcfbf;
                background: #edf8f2;
                color: #245444;
            }

            .alert-error {
                border-color: #e4b7b8;
                background: #fff3f3;
                color: #8b2f2f;
            }

            .metric-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 14px;
                margin-bottom: 24px;
            }

            .metric-card {
                position: relative;
                overflow: hidden;
                padding: 18px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
                box-shadow: 0 12px 34px rgba(21, 25, 29, 0.06);
            }

            .metric-card::before {
                content: "";
                position: absolute;
                inset: 0 auto 0 0;
                width: 5px;
                background: var(--green);
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
            }

            .metric-card span {
                display: block;
                margin-top: 8px;
                color: var(--muted);
                font-size: 14px;
                font-weight: 700;
            }

            .admin-section {
                scroll-margin-top: 18px;
                margin-top: 22px;
            }

            .admin-panel {
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
                box-shadow: 0 16px 46px rgba(21, 25, 29, 0.07);
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
            }

            .admin-panel-head p {
                margin: 6px 0 0;
                color: var(--muted);
                line-height: 1.55;
            }

            .admin-panel-body {
                padding: 22px;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .form-grid.compact {
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 12px;
            }

            .field {
                display: grid;
                gap: 7px;
            }

            .field.full,
            .check-field.full {
                grid-column: 1 / -1;
            }

            label,
            .field-label {
                color: #59636b;
                font-size: 13px;
                font-weight: 800;
            }

            input,
            textarea {
                width: 100%;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: #ffffff;
                color: var(--ink);
                padding: 11px 12px;
                outline: none;
            }

            input:focus,
            textarea:focus {
                border-color: var(--green);
                box-shadow: 0 0 0 3px rgba(24, 124, 103, 0.13);
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
                gap: 10px;
                align-items: center;
                margin-top: 16px;
            }

            .records {
                display: grid;
                gap: 12px;
                margin-top: 20px;
            }

            .record {
                padding: 16px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: #fbfaf6;
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
                border: 1px solid var(--line);
                border-radius: 8px;
                background: #efe7da;
                color: var(--muted);
                font-size: 12px;
                font-weight: 700;
            }

            .thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

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

            @media (max-width: 900px) {
                .hero,
                .section-header,
                .split-grid,
                .dashboard-topbar {
                    grid-template-columns: 1fr;
                }

                .hero {
                    min-height: auto;
                    padding-top: 46px;
                }

                .hero h1 {
                    font-size: 42px;
                }

                .portrait-frame {
                    justify-self: start;
                    width: min(100%, 320px);
                }

                .skill-grid,
                .project-grid,
                .timeline-grid,
                .metric-grid,
                .form-grid,
                .form-grid.compact {
                    grid-template-columns: 1fr;
                }

                .nav,
                .admin-panel-head,
                .dashboard-topbar {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .nav-links,
                .dashboard-actions {
                    justify-content: flex-start;
                }
            }

            @media (max-width: 640px) {
                .container,
                .nav {
                    width: min(100% - 24px, 1120px);
                }

                .dashboard-main {
                    padding: 20px 14px 32px;
                }

                .dashboard-nav {
                    grid-template-columns: 1fr;
                }

                .hero h1 {
                    font-size: 34px;
                }

                .lead {
                    font-size: 17px;
                }

                .section {
                    padding: 56px 0;
                }

                .section-title,
                .dashboard-title {
                    font-size: 28px;
                }

                .hero-actions,
                .form-actions,
                .dashboard-actions {
                    flex-direction: column;
                    align-items: stretch;
                }

                .button,
                .button-secondary,
                .button-danger,
                .button-light {
                    width: 100%;
                }
            }
               /* -------------------------------------------------------------
                VARIABEL & RESET (ditingkatkan)
            ------------------------------------------------------------- */
            :root {
                --page: #fef8ed;
                --page-cool: #eef4f2;
                --surface: #ffffff;
                --surface-strong: #fbfcfa;
                --ink: #15191d;
                --muted: #5f6c74;
                --line: #e2dfd7;
                --deep: #101820;
                --deep-soft: #1b2a32;
                --green: #1f8a70;
                --green-dark: #0f5e4c;
                --green-soft: #e0f0ea;
                --amber: #e28c2e;
                --amber-soft: #fef0e2;
                --blue: #3a6b8c;
                --rose: #c65d5a;
                --shadow-sm: 0 12px 28px rgba(0, 0, 0, 0.05);
                --shadow-md: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
                --shadow-hover: 0 30px 45px -12px rgba(0, 0, 0, 0.15);
                --transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
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

            .section, .hero, .card, .portrait-frame {
                animation: fadeInUp 0.7s ease-out forwards;
            }

            /* Wrapper utama */
            .site-shell {
                min-height: 100vh;
                background: radial-gradient(circle at 10% 20%, rgba(31, 138, 112, 0.02), transparent 70%),
                            linear-gradient(145deg, var(--page) 0%, #fef5ea 100%);
            }

            /* HEADER lebih modern */
            .site-header {
                position: sticky;
                top: 0;
                z-index: 50;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                background: rgba(254, 248, 237, 0.85);
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
            }

            .brand-mark {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, var(--green), var(--green-dark));
                border-radius: 14px;
                display: grid;
                place-items: center;
                color: white;
                font-size: 1rem;
                box-shadow: var(--shadow-sm);
                transition: transform 0.2s;
            }

            .brand:hover .brand-mark {
                transform: scale(1.05) rotate(2deg);
            }

            .nav-links a {
                padding: 10px 18px;
                border-radius: 40px;
                font-weight: 600;
                transition: var(--transition);
                color: var(--muted);
                letter-spacing: -0.2px;
            }

            .nav-links a:hover {
                background: var(--green-soft);
                color: var(--green-dark);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(31, 138, 112, 0.1);
            }

            /* HERO */
            .hero {
                display: grid;
                grid-template-columns: 1fr 0.8fr;
                gap: 56px;
                align-items: center;
                min-height: calc(100vh - 85px);
                padding: 60px 0 70px;
            }

            .eyebrow {
                margin-bottom: 20px;
                color: var(--green);
                font-size: 13px;
                font-weight: 800;
                letter-spacing: 2px;
                text-transform: uppercase;
                background: var(--green-soft);
                display: inline-block;
                padding: 5px 14px;
                border-radius: 60px;
            }

            .hero h1 {
                font-size: 64px;
                line-height: 1.05;
                background: linear-gradient(145deg, var(--ink), var(--green-dark));
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

            .hero-meta .pill {
                background: rgba(255,255,255,0.9);
                backdrop-filter: blur(4px);
                border: 1px solid var(--line);
                border-radius: 60px;
                padding: 8px 20px;
                font-weight: 600;
                transition: var(--transition);
            }

            .hero-meta .pill:hover {
                transform: translateY(-3px);
                box-shadow: var(--shadow-sm);
                border-color: var(--green);
            }

            /* BUTTONS */
            .button {
                border-radius: 60px;
                padding: 12px 28px;
                font-weight: 700;
                transition: var(--transition);
                box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            }

            .button:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 20px -8px rgba(31, 138, 112, 0.4);
            }

            .button-primary {
                background: var(--green);
                border: none;
            }

            .button-secondary {
                background: white;
                border: 1px solid var(--line);
                color: var(--ink);
            }

            .button-secondary:hover {
                background: var(--green-soft);
                border-color: var(--green);
            }

            /* PORTRAIT dengan efek glassmorphism */
            .portrait-frame {
                justify-self: end;
                width: min(100%, 320px);
            }

            .portrait {
                border-radius: 36px;
                background: rgba(255,255,255,0.5);
                backdrop-filter: blur(2px);
                box-shadow: var(--shadow-md);
                transition: var(--transition);
                border: 1px solid rgba(255,255,255,0.6);
            }

            .portrait:hover {
                transform: scale(1.02);
                box-shadow: var(--shadow-hover);
            }

            /* SECTION umum */
            .section {
                padding: 90px 0;
                border-top: 1px solid var(--line);
                position: relative;
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
                background: var(--amber-soft);
                display: inline-block;
                padding: 5px 14px;
                border-radius: 60px;
            }

            .section-title {
                font-size: 40px;
                font-weight: 800;
                line-height: 1.2;
                background: linear-gradient(120deg, var(--ink), var(--deep-soft));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            /* Kartu Skill */
            .skill-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 28px;
            }

            .card {
                border-radius: 28px;
                background: var(--surface);
                border: 1px solid var(--line);
                transition: var(--transition);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
            }

            .card:hover {
                transform: translateY(-8px);
                box-shadow: var(--shadow-hover);
                border-color: rgba(31,138,112,0.3);
            }

            .skill-card {
                padding: 28px;
            }

            .skill-card h3 {
                font-size: 1.5rem;
                margin-bottom: 6px;
            }

            .meter {
                margin-top: 20px;
                background: #e9e2d4;
                border-radius: 60px;
                height: 8px;
                overflow: hidden;
            }

            .meter span {
                display: block;
                height: 100%;
                background: linear-gradient(90deg, var(--green), var(--amber));
                border-radius: 60px;
                transition: width 0.6s ease;
            }

            /* Timeline & project cards */
            .timeline-card, .project-card {
                padding: 28px;
            }

            .period {
                color: var(--green-dark);
                font-weight: 800;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                margin-bottom: 14px;
            }

            .project-image {
                border-radius: 20px;
                overflow: hidden;
                transition: transform 0.4s;
            }

            .project-card:hover .project-image {
                transform: scale(0.98);
            }

            .tech {
                color: var(--amber);
                font-weight: 700;
                font-size: 0.8rem;
                text-transform: uppercase;
            }

            /* Empty state */
            .empty-state {
                grid-column: 1 / -1;
                background: rgba(255,255,240,0.7);
                backdrop-filter: blur(4px);
                border-radius: 48px;
                text-align: center;
                padding: 48px;
                color: var(--muted);
                font-weight: 500;
            }

            /* Footer */
            .footer {
                border-top: 1px solid var(--line);
                padding: 40px 0;
                text-align: center;
                background: rgba(254,245,230,0.5);
            }

            /* RESPONSIVE - lebih halus */
            @media (max-width: 1024px) {
                .hero { grid-template-columns: 1fr; text-align: center; gap: 40px; }
                .hero h1 { font-size: 52px; }
                .lead { max-width: 100%; }
                .portrait-frame { justify-self: center; }
                .section-header { grid-template-columns: 1fr; gap: 16px; }
                .section-title { font-size: 32px; }
            }

            @media (max-width: 700px) {
                .nav { flex-direction: column; gap: 16px; }
                .nav-links { justify-content: center; }
                .hero h1 { font-size: 42px; }
                .skill-grid, .timeline-grid, .project-grid { grid-template-columns: 1fr; }
                .section { padding: 60px 0; }
                .button { width: 100%; justify-content: center; }
            }

            /* Efek tambahan : scroll reveal native + interaksi */
            .card, .hero, .section-header, .portrait-frame {
                will-change: transform, opacity;
            }

            a, button {
                cursor: pointer;
            }

            /* Smooth shadow untuk semua kartu */
            .timeline-card, .skill-card, .project-card {
                transition: var(--transition);
            }

            /* background animasi subtle pada hero */
            .hero {
                background: radial-gradient(ellipse at 80% 20%, rgba(31,138,112,0.03), transparent);
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
