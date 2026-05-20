<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Portfolio')</title>

        <style>
            :root {
                --bg: #f5f7f2;
                --surface: #ffffff;
                --surface-soft: #eef4ef;
                --ink: #181b1a;
                --muted: #66706b;
                --line: #dce3dd;
                --accent: #2f6f62;
                --accent-strong: #174f46;
                --accent-soft: #dbece6;
                --warm: #a95f4a;
                --danger: #a33b3b;
                --shadow: 0 18px 55px rgba(24, 27, 26, 0.08);
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                background: var(--bg);
                color: var(--ink);
                font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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
            }

            .site-header {
                position: sticky;
                top: 0;
                z-index: 10;
                border-bottom: 1px solid rgba(220, 227, 221, 0.86);
                background: rgba(245, 247, 242, 0.92);
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
                font-weight: 700;
            }

            .brand-mark {
                display: grid;
                width: 34px;
                height: 34px;
                place-items: center;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
                color: var(--accent-strong);
                font-size: 14px;
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
                font-weight: 600;
            }

            .nav-links a:hover,
            .nav-links a:focus {
                background: var(--accent-soft);
                color: var(--accent-strong);
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
                color: var(--accent-strong);
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
                background: rgba(255, 255, 255, 0.72);
                color: var(--muted);
                font-size: 14px;
                font-weight: 650;
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
                border: 1px solid var(--accent);
                border-radius: 8px;
                background: var(--accent);
                color: #ffffff;
                font-weight: 750;
                cursor: pointer;
            }

            .button:hover,
            .button:focus {
                background: var(--accent-strong);
                border-color: var(--accent-strong);
            }

            .button-secondary {
                border-color: var(--line);
                background: var(--surface);
                color: var(--ink);
            }

            .button-secondary:hover,
            .button-secondary:focus {
                background: var(--surface-soft);
                border-color: var(--line);
            }

            .button-danger {
                border-color: var(--danger);
                background: var(--danger);
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
                border: 1px solid var(--line);
                border-radius: 8px;
                background:
                    linear-gradient(135deg, rgba(47, 111, 98, 0.16), rgba(169, 95, 74, 0.12)),
                    var(--surface);
                box-shadow: var(--shadow);
            }

            .portrait img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .portrait-placeholder {
                color: var(--accent-strong);
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
                color: var(--warm);
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
                box-shadow: 0 12px 40px rgba(24, 27, 26, 0.05);
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
                background: var(--surface-soft);
            }

            .meter span {
                display: block;
                height: 100%;
                border-radius: inherit;
                background: linear-gradient(90deg, var(--accent), var(--warm));
            }

            .timeline-card,
            .project-card {
                padding: 22px;
            }

            .period {
                margin: 0 0 10px;
                color: var(--accent-strong);
                font-size: 14px;
                font-weight: 750;
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
                    linear-gradient(135deg, rgba(47, 111, 98, 0.14), rgba(169, 95, 74, 0.16)),
                    var(--surface-soft);
                color: var(--accent-strong);
                font-weight: 800;
            }

            .project-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .tech {
                color: var(--warm);
                font-size: 14px;
                font-weight: 750;
            }

            .empty-state {
                grid-column: 1 / -1;
                padding: 26px;
                border: 1px dashed var(--line);
                border-radius: 8px;
                color: var(--muted);
                background: rgba(255, 255, 255, 0.55);
            }

            .footer {
                padding: 30px 0 44px;
                border-top: 1px solid var(--line);
                color: var(--muted);
            }

            .admin-page {
                padding: 34px 0 72px;
            }

            .admin-hero {
                display: flex;
                justify-content: space-between;
                gap: 24px;
                align-items: flex-start;
                margin-bottom: 26px;
            }

            .admin-hero h1 {
                margin: 0;
                font-size: 38px;
                line-height: 1.15;
            }

            .admin-hero p {
                max-width: 640px;
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.65;
            }

            .alert {
                margin-bottom: 20px;
                padding: 14px 16px;
                border-radius: 8px;
                border: 1px solid var(--line);
                background: var(--surface);
            }

            .alert-success {
                border-color: #b8d8c8;
                background: #edf8f2;
                color: #245444;
            }

            .alert-error {
                border-color: #ecc0c0;
                background: #fff3f3;
                color: #8b2f2f;
            }

            .stats {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 12px;
                margin-bottom: 28px;
            }

            .stat {
                padding: 18px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
            }

            .stat strong {
                display: block;
                font-size: 30px;
            }

            .stat span {
                color: var(--muted);
                font-size: 14px;
            }

            .admin-section {
                padding: 30px 0;
                border-top: 1px solid var(--line);
            }

            .admin-section:first-of-type {
                border-top: 0;
            }

            .admin-section h2 {
                margin: 0 0 18px;
                font-size: 26px;
            }

            .admin-surface {
                padding: 22px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface);
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

            .field.full {
                grid-column: 1 / -1;
            }

            label,
            .field-label {
                color: var(--muted);
                font-size: 13px;
                font-weight: 750;
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
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(47, 111, 98, 0.13);
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
                margin-top: 18px;
            }

            .record {
                padding: 16px;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.72);
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

            .delete-form {
                margin-top: 12px;
            }

            .thumb {
                width: 92px;
                height: 92px;
                overflow: hidden;
                border: 1px solid var(--line);
                border-radius: 8px;
                background: var(--surface-soft);
            }

            .thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            @media (max-width: 900px) {
                .hero,
                .section-header,
                .split-grid,
                .admin-hero {
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
                .stats,
                .form-grid,
                .form-grid.compact {
                    grid-template-columns: 1fr;
                }

                .nav {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .nav-links {
                    justify-content: flex-start;
                }
            }

            @media (max-width: 560px) {
                .container,
                .nav {
                    width: min(100% - 24px, 1120px);
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
                .admin-hero h1 {
                    font-size: 28px;
                }

                .hero-actions,
                .form-actions {
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
        </style>

        @stack('styles')
    </head>
    <body>
        @yield('content')
    </body>
</html>
