<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Horizon Post</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|outfit:500,600,700" rel="stylesheet" />
    <style>
        :root,
        html[data-theme="dark"] {
            --orange: #f26522;
            --orange-hover: #e05512;
            --orange-soft: rgba(242, 101, 34, 0.14);
            --orange-border: rgba(242, 101, 34, 0.28);
            --accent-text: #ffb48a;
            --table-head-text: #ffc49a;
            --text: #e8eef7;
            --muted: #93a4bc;
            --line: rgba(255, 255, 255, 0.1);
            --bg: #0a1220;
            --bg-soft: #0d1728;
            --surface: #122033;
            --surface-2: #182a42;
            --surface-3: #1e334f;
            --nav-bg-1: rgba(20, 34, 56, 0.98);
            --nav-bg-2: rgba(11, 20, 36, 0.96);
            --sidebar-bg-1: #14233a;
            --sidebar-bg-2: #101c2e;
            --sidebar-bg-3: #0d1726;
            --ico-bg-1: #2a4060;
            --ico-bg-2: #1a2c44;
            --hover-bg: rgba(255, 255, 255, 0.05);
            --chip-bg: rgba(255, 255, 255, 0.04);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            --modal-backdrop: rgba(0, 0, 0, 0.55);
            --badge-ring: rgba(13, 23, 40, 0.65);
            --content-glow: rgba(242, 101, 34, 0.08);
            --success-bg: rgba(34, 197, 94, 0.15);
            --success-border: rgba(34, 197, 94, 0.4);
            --success-text: #bbf7d0;
            --sidebar-w: 270px;
            --green: #22c55e;
            --yellow: #eab308;
            --red: #ef4444;
        }

        html[data-theme="light"] {
            --orange: #e85d1c;
            --orange-hover: #d14f12;
            --orange-soft: rgba(232, 93, 28, 0.12);
            --orange-border: rgba(232, 93, 28, 0.28);
            --accent-text: #c24a12;
            --table-head-text: #fff7f0;
            --text: #0b1628;
            --muted: #5b6d86;
            --line: rgba(11, 22, 40, 0.1);
            --bg: #eef2f7;
            --bg-soft: #f7f9fc;
            --surface: #ffffff;
            --surface-2: #ffffff;
            --surface-3: #1a2d45;
            --nav-bg-1: #ffffff;
            --nav-bg-2: #f8fafc;
            --sidebar-bg-1: #ffffff;
            --sidebar-bg-2: #f7f9fc;
            --sidebar-bg-3: #eef2f7;
            --ico-bg-1: #fff1e8;
            --ico-bg-2: #ffe3d4;
            --hover-bg: rgba(11, 22, 40, 0.04);
            --chip-bg: rgba(11, 22, 40, 0.04);
            --shadow: 0 10px 28px rgba(11, 22, 40, 0.08);
            --modal-backdrop: rgba(11, 22, 40, 0.35);
            --badge-ring: #ffffff;
            --content-glow: rgba(232, 93, 28, 0.08);
            --success-bg: rgba(34, 197, 94, 0.12);
            --success-border: rgba(34, 197, 94, 0.35);
            --success-text: #166534;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: "DM Sans", system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            transition: background 0.25s ease, color 0.25s ease;
        }

        a { color: inherit; text-decoration: none; }

        /* Tables: en-têtes et données centrés (règle globale projet) */
        table,
        table th,
        table td {
            text-align: center !important;
            vertical-align: middle !important;
        }

        .topnav {
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.75rem 1.15rem;
            background: linear-gradient(180deg, var(--nav-bg-1), var(--nav-bg-2));
            border-bottom: 1px solid var(--orange-border);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-family: "Outfit", sans-serif;
            font-weight: 700;
            letter-spacing: 0.02em;
            white-space: nowrap;
            color: var(--text);
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(145deg, #ff7a3a, var(--orange) 45%, #d94c12);
            display: grid;
            place-items: center;
            font-size: 1rem;
            color: #fff;
            font-weight: 800;
            box-shadow: 0 8px 18px rgba(242, 101, 34, 0.35);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            flex-wrap: wrap;
            padding: 0.2rem;
            border-radius: 16px;
            background: var(--chip-bg);
            border: 1px solid var(--line);
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.45rem 0.8rem 0.45rem 0.45rem;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--muted);
            border: 1px solid transparent;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }

        .nav-links a:hover {
            background: var(--hover-bg);
            color: var(--text);
            transform: translateY(-1px);
        }

        .nav-links a.active {
            background: linear-gradient(180deg, var(--orange-soft), transparent);
            color: var(--text);
            border-color: var(--orange-border);
            box-shadow: 0 6px 16px rgba(242, 101, 34, 0.12);
        }

        .nav-ico {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            display: inline-grid;
            place-items: center;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--ico-bg-1), var(--ico-bg-2));
            border: 1px solid var(--line);
            color: var(--accent-text);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12);
        }

        .nav-links a.active .nav-ico {
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 10px rgba(242, 101, 34, 0.35);
        }

        .nav-links a .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 1.2rem;
            height: 1.2rem;
            margin-left: 0.15rem;
            padding: 0 0.35rem;
            border-radius: 999px;
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
            line-height: 1;
            box-shadow: 0 0 0 2px var(--badge-ring);
            animation: pulse-badge 1.4s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .theme-toggle {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            border: 1px solid var(--orange-border);
            background: linear-gradient(180deg, var(--orange-soft), transparent);
            color: var(--accent-text);
            display: inline-grid;
            place-items: center;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        }

        .theme-toggle:hover {
            transform: translateY(-1px);
            color: var(--orange);
            background: var(--orange-soft);
        }

        .theme-toggle .icon-sun { display: none; }
        .theme-toggle .icon-moon { display: block; }
        html[data-theme="light"] .theme-toggle .icon-sun { display: block; }
        html[data-theme="light"] .theme-toggle .icon-moon { display: none; }

        .logout-btn {
            width: 100%;
            border: 1px solid var(--orange-border);
            background: linear-gradient(180deg, var(--orange-soft), transparent);
            color: var(--accent-text);
            border-radius: 12px;
            padding: 0.7rem 0.9rem;
            font: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .logout-btn:hover {
            background: var(--orange);
            color: #fff;
            border-color: var(--orange);
        }

        .layout {
            display: grid;
            grid-template-columns: var(--sidebar-w) 1fr;
            min-height: calc(100vh - 64px);
        }

        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-bg-1) 0%, var(--sidebar-bg-2) 55%, var(--sidebar-bg-3) 100%);
            border-right: 1px solid var(--orange-border);
            padding: 1.15rem 0.8rem;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 64px);
        }

        .sidebar-top {
            flex: 1;
            min-height: 0;
        }

        .sidebar h2 {
            font-family: "Outfit", sans-serif;
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 0.75rem;
            margin-bottom: 0.85rem;
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 14px;
            background: var(--chip-bg);
            border: 1px solid var(--line);
        }

        .profile-card--nav {
            padding: 0.35rem 0.7rem 0.35rem 0.35rem;
            gap: 0.6rem;
        }

        .profile-card--nav .profile-photo {
            width: 40px;
            height: 40px;
        }

        .profile-photo {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--orange);
            box-shadow: 0 0 0 3px var(--orange-soft);
            flex-shrink: 0;
            background: var(--ico-bg-2);
        }

        .profile-meta {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .profile-name {
            font-family: "Outfit", sans-serif;
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 160px;
        }

        .profile-role {
            font-size: 0.75rem;
            color: var(--accent-text);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--line);
        }

        .side-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .side-links > li > a,
        .side-group > .side-parent {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.72rem 0.75rem;
            border-radius: 14px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.92rem;
            border: 1px solid transparent;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }

        .side-links > li > a:hover,
        .side-group > .side-parent:hover {
            background: var(--hover-bg);
            color: var(--text);
            transform: translateX(2px);
        }

        .side-links > li > a.active,
        .side-group.has-active > .side-parent {
            background: linear-gradient(90deg, var(--orange-soft), transparent);
            color: var(--text);
            border-color: var(--orange-border);
            box-shadow: inset 3px 0 0 var(--orange);
        }

        .side-ico {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            display: inline-grid;
            place-items: center;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--ico-bg-1), var(--ico-bg-2));
            border: 1px solid var(--line);
            color: var(--accent-text);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.12),
                0 6px 14px rgba(0, 0, 0, 0.08);
        }

        .side-links > li > a.active .side-ico,
        .side-group.has-active > .side-parent .side-ico {
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            border-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0 6px 14px rgba(242, 101, 34, 0.35);
        }

        .side-group > .side-parent {
            width: 100%;
            justify-content: space-between;
            border: 1px solid transparent;
            background: transparent;
            font: inherit;
            cursor: pointer;
            text-align: left;
        }

        .side-group.open > .side-parent {
            background: var(--hover-bg);
            color: var(--text);
        }

        .side-parent-left {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .side-caret {
            width: 0.55rem;
            height: 0.55rem;
            border-right: 2px solid currentColor;
            border-bottom: 2px solid currentColor;
            transform: rotate(-45deg);
            transition: transform 0.2s ease;
            opacity: 0.8;
            margin-right: 0.2rem;
        }

        .side-group.open .side-caret {
            transform: rotate(45deg);
        }

        .sub-links {
            list-style: none;
            display: none;
            flex-direction: column;
            gap: 0.25rem;
            padding: 0.25rem 0 0.4rem 0.55rem;
            margin-left: 1.05rem;
            border-left: 1px dashed var(--orange-border);
        }

        .side-group.open .sub-links {
            display: flex;
        }

        .sub-links a {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.62rem 0.75rem;
            border-radius: 12px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.86rem;
            border: 1px solid transparent;
        }

        .sub-links a:hover {
            background: var(--hover-bg);
            color: var(--text);
        }

        .sub-links a.active {
            background: linear-gradient(90deg, var(--orange-soft), transparent);
            color: var(--text);
            border-color: var(--orange-border);
        }

        .sub-ico {
            width: 28px;
            height: 28px;
            border-radius: 9px;
            display: inline-grid;
            place-items: center;
            background: linear-gradient(145deg, var(--ico-bg-1), var(--ico-bg-2));
            border: 1px solid var(--line);
            color: var(--accent-text);
        }

        .sub-links a.active .sub-ico {
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
        }

        .content {
            padding: 1.5rem 1.5rem 2rem;
            background:
                radial-gradient(circle at top right, var(--content-glow), transparent 40%),
                var(--bg);
        }

        .page-title {
            font-family: "Outfit", sans-serif;
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            color: var(--text);
        }

        .page-title.is-hidden {
            display: none;
        }

        .content.is-compact {
            padding-top: 1rem;
        }

        .panel.is-flush {
            min-height: auto;
            padding-top: 0.85rem;
        }

        .panel.is-flush .data-table {
            margin-top: 0.75rem;
        }

        .alert-ok {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .card {
            background: var(--surface-2);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.1rem 1.15rem;
            text-align: center;
            box-shadow: var(--shadow);
        }

        .card .label {
            color: var(--muted);
            font-size: 0.85rem;
            margin-bottom: 0.45rem;
        }

        .card .value {
            font-family: "Outfit", sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: var(--text);
        }

        .panel {
            background: var(--surface-2);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.25rem;
            min-height: 280px;
            box-shadow: var(--shadow);
        }

        .panel h3 {
            font-family: "Outfit", sans-serif;
            font-size: 1.05rem;
            margin-bottom: 0.75rem;
            text-align: center;
            color: var(--text);
        }

        .panel h3.section-title {
            margin-bottom: 0;
            text-align: left;
        }

        .panel > p {
            color: var(--muted);
            line-height: 1.55;
            text-align: center;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
            font-size: 0.86rem;
            overflow: hidden;
            border-radius: 12px;
            border: 1px solid var(--orange-border);
            background: var(--surface);
        }

        .data-table th,
        .data-table td {
            padding: 0.75rem 0.55rem;
            border-bottom: 1px solid var(--line);
            color: var(--text);
        }

        .data-table th,
        table thead th {
            background: linear-gradient(180deg, var(--surface-3) 0%, #16283d 100%);
            color: var(--table-head-text);
            font-size: 0.74rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            font-weight: 700;
            white-space: nowrap;
            border-bottom: 2px solid var(--orange);
            box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.06);
        }

        html[data-theme="light"] .data-table th,
        html[data-theme="light"] table thead th {
            background: linear-gradient(180deg, #1f3350 0%, #16263c 100%);
        }

        .data-table thead th:first-child {
            border-top-left-radius: 11px;
        }

        .data-table thead th:last-child {
            border-top-right-radius: 11px;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: var(--orange-soft);
        }

        .table-wrap { overflow-x: auto; }

        .empty-state {
            color: var(--muted);
            padding: 1.5rem 0 0.5rem;
            text-align: center;
        }

        .statut-select {
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid transparent;
            border-radius: 999px;
            padding: 0.4rem 1.8rem 0.4rem 0.75rem;
            font: inherit;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: right 0.55rem center;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='3'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            min-width: 120px;
        }

        .statut-select.en_attente {
            background-color: rgba(234, 179, 8, 0.2);
            color: #ca8a04;
            border-color: rgba(234, 179, 8, 0.45);
        }

        html[data-theme="dark"] .statut-select.en_attente { color: #fde047; }

        .statut-select.valide {
            background-color: rgba(34, 197, 94, 0.2);
            color: #16a34a;
            border-color: rgba(34, 197, 94, 0.45);
        }

        html[data-theme="dark"] .statut-select.valide { color: #86efac; }

        .statut-select.refuse {
            background-color: rgba(239, 68, 68, 0.2);
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.45);
        }

        html[data-theme="dark"] .statut-select.refuse { color: #fca5a5; }

        .statut-select option { color: #0b1628; background: #fff; }

        .actions {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            flex-wrap: wrap;
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--chip-bg);
            color: var(--text);
            cursor: pointer;
            display: inline-grid;
            place-items: center;
            font-size: 0.85rem;
        }

        .icon-btn:hover { border-color: var(--orange); color: var(--orange); }
        .icon-btn.danger:hover { border-color: var(--red); color: var(--red); }

        .toolbar {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1.25rem;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            background:
                linear-gradient(135deg, var(--orange-soft), transparent 55%),
                var(--chip-bg);
            border: 1px solid var(--orange-border);
        }

        .section-title {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
            text-align: left;
            font-family: "Outfit", sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--text);
        }

        .section-title-ico {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-grid;
            place-items: center;
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            box-shadow: 0 8px 18px rgba(242, 101, 34, 0.3);
            flex-shrink: 0;
        }

        .section-title-text {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
            align-items: flex-start;
        }

        .section-title-text small {
            font-family: "DM Sans", sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-text);
        }

        .section-actions {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .section-actions .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
        }

        .btn-add {
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            box-shadow: 0 6px 14px rgba(242, 101, 34, 0.25);
        }

        .btn-add:hover { filter: brightness(1.05); }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .status-badge.actif {
            background: rgba(34, 197, 94, 0.18);
            color: #16a34a;
        }

        html[data-theme="dark"] .status-badge.actif { color: #86efac; }

        .status-badge.suspendu {
            background: rgba(239, 68, 68, 0.18);
            color: #dc2626;
        }

        html[data-theme="dark"] .status-badge.suspendu { color: #fca5a5; }

        tr.is-suspended td {
            opacity: 0.72;
        }

        .icon-btn.warn:hover {
            border-color: var(--yellow);
            color: var(--yellow);
        }

        .add-panel {
            display: none;
            margin-bottom: 1rem;
            padding: 1.1rem 1.15rem;
            border-radius: 14px;
            border: 1px solid var(--orange-border);
            background:
                linear-gradient(135deg, var(--orange-soft), transparent 50%),
                var(--surface);
        }

        .add-panel.open { display: block; }

        .add-panel h4 {
            font-family: "Outfit", sans-serif;
            font-size: 1.05rem;
            margin-bottom: 0.9rem;
            text-align: center;
            color: var(--text);
        }

        .add-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.85rem;
        }

        .add-grid .field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .add-grid label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: center;
        }

        .add-grid input,
        .add-grid select {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--chip-bg);
            color: var(--text);
            border-radius: 10px;
            padding: 0.7rem 0.85rem;
            font: inherit;
            text-align: center;
        }

        .add-grid select option {
            color: #0b1628;
            background: #fff;
        }

        .add-actions {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        @media (max-width: 720px) {
            .add-grid { grid-template-columns: 1fr; }
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 0.65rem 1.1rem;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-print {
            background: linear-gradient(145deg, #ff8a4c, var(--orange));
            color: #fff;
            box-shadow: 0 6px 14px rgba(242, 101, 34, 0.25);
        }

        .btn-print:hover {
            filter: brightness(1.05);
        }

        .btn-close {
            background: transparent;
            border: 1px solid var(--line);
            color: var(--text);
        }

        .btn-close:hover {
            border-color: var(--orange);
            color: var(--orange);
        }

        .menu-toggle {
            display: none;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--text);
            border-radius: 10px;
            padding: 0.45rem 0.7rem;
            font: inherit;
            cursor: pointer;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: var(--modal-backdrop);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 1rem;
        }

        .modal-backdrop.open { display: flex; }

        .modal {
            width: min(560px, 100%);
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.25rem;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--shadow);
        }

        .modal h3 {
            font-family: "Outfit", sans-serif;
            margin-bottom: 1rem;
            text-align: center;
            color: var(--text);
        }

        .modal .field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            margin-bottom: 0.75rem;
            text-align: left;
        }

        .modal label {
            font-size: 0.78rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 600;
            text-align: center;
        }

        .modal input {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--chip-bg);
            color: var(--text);
            border-radius: 10px;
            padding: 0.7rem 0.85rem;
            font: inherit;
            text-align: center;
        }

        .modal input:disabled {
            opacity: 0.85;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 0.65rem;
            margin-top: 1rem;
        }

        @media print {
            .topnav, .sidebar, .toolbar, .actions, .menu-toggle, .logout-btn, .nav-links, .theme-toggle, .section-actions { display: none !important; }
            .layout { display: block; }
            .content { padding: 0; background: #fff; color: #000; }
            .panel { border: none; background: #fff; }
            .data-table th, .data-table td { color: #000; border-color: #ccc; }
            .data-table th, table thead th {
                background: #eee !important;
                color: #111 !important;
                border-bottom: 2px solid #f26522 !important;
            }
        }

        @media (max-width: 980px) {
            .cards { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .nav-links { display: none; }
            .layout { grid-template-columns: 1fr; }
            .sidebar {
                display: none;
                position: fixed;
                inset: 64px auto 0 0;
                width: min(280px, 86vw);
                height: calc(100vh - 64px);
                min-height: calc(100vh - 64px);
                z-index: 40;
                box-shadow: 12px 0 40px rgba(0, 0, 0, 0.35);
            }
            .sidebar.open { display: block; }
            .menu-toggle { display: inline-flex; }
        }

        @media (max-width: 560px) {
            .cards { grid-template-columns: 1fr; }
            .profile-card--nav .profile-meta { display: none; }
        }
    </style>
    <script>
        (function () {
            const saved = localStorage.getItem('horizon-theme');
            const theme = saved === 'light' || saved === 'dark' ? saved : 'dark';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body>
    @php
        $titles = [
            'dashboard' => 'Tableau de Bord',
            'partenaires' => 'Partenaires',
            'fiche-partenaire' => 'Fiche Partenaire',
            'balance-partenaire' => 'Balance Partenaire',
            'commandes' => 'Commandes',
            'paiement' => 'État Paiement',
            'parametres' => 'Paramètres',
            'admin' => 'Admin',
            'nvx-insc' => 'Nouvelles Inscriptions',
            'livreurs' => 'Livreurs',
            'rapports' => 'Rapports',
            'configurations' => 'Configurations',
        ];
        $title = $titles[$section] ?? 'Administration';
    @endphp

    <header class="topnav">
        <div style="display:flex;align-items:center;gap:0.75rem;">
            <button class="menu-toggle" type="button" id="menu-toggle" aria-label="Menu">☰</button>
            <div class="brand">
                <span class="brand-mark">H</span>
                <span>HORIZON POST</span>
            </div>
        </div>

        <nav class="nav-links" aria-label="Navigation principale">
            <a href="{{ route('admin.section', 'admin') }}" class="{{ $section === 'admin' ? 'active' : '' }}">
                <span class="nav-ico" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v4M12 19v4M4.2 4.2l2.8 2.8M17 17l2.8 2.8M1 12h4M19 12h4M4.2 19.8l2.8-2.8M17 7l2.8-2.8"/><circle cx="12" cy="12" r="3"/></svg>
                </span>
                Admin
            </a>
            <a href="{{ route('admin.section', 'nvx-insc') }}" class="{{ $section === 'nvx-insc' ? 'active' : '' }}">
                <span class="nav-ico" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>
                </span>
                Nvx Insc
                @if (($nvxCount ?? 0) > 0)
                    <span class="badge">{{ $nvxCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.section', 'livreurs') }}" class="{{ $section === 'livreurs' ? 'active' : '' }}">
                <span class="nav-ico" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="18" r="2"/><circle cx="19" cy="18" r="2"/><path d="M5 18H3V7a1 1 0 0 1 1-1h9l4 5h3a2 2 0 0 1 2 2v5h-2"/><path d="M13 6v5h5"/></svg>
                </span>
                Livreurs
            </a>
            <a href="{{ route('admin.section', 'rapports') }}" class="{{ $section === 'rapports' ? 'active' : '' }}">
                <span class="nav-ico" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 14l4-4 4 3 5-6"/></svg>
                </span>
                Rapports
            </a>
            <a href="{{ route('admin.section', 'configurations') }}" class="{{ $section === 'configurations' ? 'active' : '' }}">
                <span class="nav-ico" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
                </span>
                Configurations
            </a>
        </nav>

        <div class="nav-right">
            <button
                type="button"
                class="theme-toggle"
                id="theme-toggle"
                aria-label="Basculer mode sombre ou clair"
                title="Mode sombre / clair"
            >
                <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M21 14.5A8.5 8.5 0 1 1 9.5 3a7 7 0 0 0 11.5 11.5z"/>
                </svg>
                <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="12" cy="12" r="4"/>
                    <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>
                </svg>
            </button>
            <div class="profile-card profile-card--nav">
                <img
                    class="profile-photo"
                    src="{{ asset('images/avatar-admin.svg') }}"
                    alt="Photo de profil"
                    width="40"
                    height="40"
                >
                <div class="profile-meta">
                    <span class="profile-name">{{ $user['login'] ?? 'Admin' }}</span>
                    <span class="profile-role">
                        @php
                            $roleLabel = match ($user['statut'] ?? 'admin') {
                                'admin' => 'Administrateur',
                                'client' => 'Client',
                                'livreur' => 'Livreur',
                                'agence' => 'Agence',
                                default => $user['statut'] ?? 'Admin',
                            };
                        @endphp
                        {{ $roleLabel }}
                    </span>
                </div>
            </div>
        </div>
    </header>

    <div class="layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-top">
                <h2>Menu</h2>
                <ul class="side-links">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ $section === 'dashboard' ? 'active' : '' }}">
                        <span class="side-ico" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
                        </span>
                        Tableau de Bord
                    </a>
                </li>
                <li class="side-group {{ in_array($section, ['fiche-partenaire', 'balance-partenaire'], true) ? 'open has-active' : '' }}" id="partenaires-group">
                    <button type="button" class="side-parent" id="partenaires-toggle" aria-expanded="{{ in_array($section, ['fiche-partenaire', 'balance-partenaire'], true) ? 'true' : 'false' }}">
                        <span class="side-parent-left">
                            <span class="side-ico" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </span>
                            Partenaires
                        </span>
                        <span class="side-caret" aria-hidden="true"></span>
                    </button>
                    <ul class="sub-links">
                        <li>
                            <a href="{{ route('admin.section', 'fiche-partenaire') }}" class="{{ $section === 'fiche-partenaire' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/></svg>
                                </span>
                                Fiche Partenaire
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.section', 'balance-partenaire') }}" class="{{ $section === 'balance-partenaire' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M5 8h4a3 3 0 0 1 0 6H5m14-3h-5a3 3 0 0 0 0 6h5"/></svg>
                                </span>
                                Balance Partenaire
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.section', 'commandes') }}" class="{{ $section === 'commandes' ? 'active' : '' }}">
                        <span class="side-ico" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 8l-9 5-9-5 9-5 9 5z"/><path d="M3 8v8l9 5 9-5V8"/></svg>
                        </span>
                        Commandes
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.section', 'paiement') }}" class="{{ $section === 'paiement' ? 'active' : '' }}">
                        <span class="side-ico" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                        </span>
                        Etat Paiement
                    </a>
                </li>
                    <li>
                    <a href="{{ route('admin.section', 'parametres') }}" class="{{ $section === 'parametres' ? 'active' : '' }}">
                        <span class="side-ico" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        </span>
                        Paramètres
                    </a>
                </li>
                </ul>
            </div>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main class="content {{ in_array($section, ['fiche-partenaire', 'balance-partenaire'], true) ? 'is-compact' : '' }}">
            <h1 class="page-title {{ in_array($section, ['fiche-partenaire', 'balance-partenaire'], true) ? 'is-hidden' : '' }}">{{ $title }}</h1>

            @if (session('admin_success') && $section !== 'fiche-partenaire')
                <div class="alert-ok">{{ session('admin_success') }}</div>
            @endif

            @if ($section === 'dashboard')
                <div class="cards">
                    <div class="card"><div class="label">Commandes du jour</div><div class="value">128</div></div>
                    <div class="card"><div class="label">Partenaires actifs</div><div class="value">{{ ($partenaires ?? null) ? $partenaires->count() : \App\Models\Partenaire::count() }}</div></div>
                    <div class="card"><div class="label">Nvx inscriptions</div><div class="value">{{ $nvxCount }}</div></div>
                    <div class="card"><div class="label">Paiements en attente</div><div class="value">12</div></div>
                </div>
            @endif

            <section class="panel {{ $section === 'fiche-partenaire' ? 'is-flush' : '' }}">
                @if ($section === 'nvx-insc')
                    <h3>Nouvelle inscription</h3>
                    @if (($inscriptions ?? collect())->isEmpty())
                        <p class="empty-state">Aucune inscription en attente ou refusée.</p>
                    @else
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nom Complet</th>
                                        <th>Téléphone</th>
                                        <th>E-mail</th>
                                        <th>Ville</th>
                                        <th>Magasin</th>
                                        <th>CIN</th>
                                        <th>Banque</th>
                                        <th>RIB</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscriptions as $insc)
                                        <tr>
                                            <td>{{ $insc->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $insc->nom_complet }}</td>
                                            <td>{{ $insc->telephone }}</td>
                                            <td>{{ $insc->email }}</td>
                                            <td>{{ $insc->ville }}</td>
                                            <td>{{ $insc->magasin }}</td>
                                            <td>{{ $insc->cin }}</td>
                                            <td>{{ $insc->banque }}</td>
                                            <td>{{ $insc->rib }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.inscriptions.statut', $insc) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select
                                                        name="statut"
                                                        class="statut-select {{ $insc->statut }}"
                                                        onchange="this.form.submit()"
                                                    >
                                                        <option value="valide" @selected($insc->statut === 'valide')>Valider</option>
                                                        <option value="en_attente" @selected($insc->statut === 'en_attente')>En Attente</option>
                                                        <option value="refuse" @selected($insc->statut === 'refuse')>Refuser</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'fiche-partenaire')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Partenaires</small>
                                Fiche Partenaires
                            </span>
                        </h3>
                        <div class="section-actions">
                            <button type="button" class="btn btn-add" id="open-add-partenaire">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>
                                Ajouter
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-close">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                                Fermer
                            </a>
                        </div>
                    </div>

                    <div class="add-panel" id="add-partenaire-panel">
                        <h4>Nouveau partenaire</h4>
                        <form method="POST" action="{{ route('admin.partenaires.store') }}">
                            @csrf
                            <div class="add-grid">
                                <div class="field">
                                    <label for="add_nom">Nom Partenaire</label>
                                    <input id="add_nom" type="text" name="nom_client" required>
                                </div>
                                <div class="field">
                                    <label for="add_contact">Contact</label>
                                    <input id="add_contact" type="text" name="telephone" placeholder="00212..." required>
                                </div>
                                <div class="field">
                                    <label for="add_ville">Ville</label>
                                    <input id="add_ville" type="text" name="ville" required>
                                </div>
                                <div class="field">
                                    <label for="add_type">Type Partenaire</label>
                                    <select id="add_type" name="type_partenaire" required>
                                        <option value="">Choisir</option>
                                        <option value="Magasin">Magasin</option>
                                        <option value="Agence">Agence</option>
                                        <option value="Entreprise">Entreprise</option>
                                        <option value="Particulier">Particulier</option>
                                    </select>
                                </div>
                                <div class="field" style="grid-column: 1 / -1;">
                                    <label for="add_paiement">Mode Paiement</label>
                                    <select id="add_paiement" name="mode_paiement" required>
                                        <option value="">Choisir</option>
                                        <option value="Espèces">Espèces</option>
                                        <option value="Virement">Virement</option>
                                        <option value="Chèque">Chèque</option>
                                        <option value="Carte">Carte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="add-actions">
                                <button type="submit" class="btn btn-add">Valider</button>
                                <button type="button" class="btn btn-close" id="close-add-partenaire">Fermer</button>
                            </div>
                        </form>
                    </div>

                    @if (($partenaires ?? collect())->isEmpty())
                        <p class="empty-state">Aucun partenaire pour le moment.</p>
                    @else
                        <div class="table-wrap" id="partenaires-print-area">
                            <table class="data-table" id="partenaires-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Nom Partenaire</th>
                                        <th>Contact</th>
                                        <th>Ville</th>
                                        <th>Type Partenaire</th>
                                        <th>Mode Paiement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partenaires as $p)
                                        <tr
                                            class="{{ ($p->statut ?? 'actif') === 'suspendu' ? 'is-suspended' : '' }}"
                                            data-id="{{ $p->id }}"
                                            data-nom="{{ $p->nom_client }}"
                                            data-contact="{{ $p->telephone }}"
                                            data-ville="{{ $p->ville }}"
                                            data-type="{{ $p->type_partenaire }}"
                                            data-paiement="{{ $p->mode_paiement }}"
                                            data-date="{{ $p->created_at->format('d/m/Y') }}"
                                        >
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->nom_client }}</td>
                                            <td>{{ $p->telephone }}</td>
                                            <td>{{ $p->ville }}</td>
                                            <td>{{ $p->type_partenaire ?: '—' }}</td>
                                            <td>{{ $p->mode_paiement ?: '—' }}</td>
                                            <td>
                                                <div class="actions">
                                                    <button type="button" class="icon-btn" title="Voir" onclick="openPartenaireModal('view', this.closest('tr'))" aria-label="Voir">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </button>
                                                    <button type="button" class="icon-btn" title="Modifier" onclick="openPartenaireModal('edit', this.closest('tr'))" aria-label="Modifier">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.partenaires.suspend', $p) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="icon-btn warn" title="{{ ($p->statut ?? 'actif') === 'suspendu' ? 'Réactiver' : 'Suspendre' }}" aria-label="Suspendre">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M10 15V9M14 15V9"/></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'balance-partenaire')
                    <h3>Balance Partenaire</h3>
                    @if (($partenaires ?? collect())->isEmpty())
                        <p class="empty-state">Aucun partenaire pour afficher la balance.</p>
                    @else
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom Client</th>
                                        <th>Magasin</th>
                                        <th>Débit</th>
                                        <th>Crédit</th>
                                        <th>Solde</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partenaires as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->nom_client }}</td>
                                            <td>{{ $p->magasin }}</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="toolbar">
                            <button type="button" class="btn btn-print" onclick="window.print()">Imprimer</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-close">Fermer</a>
                        </div>
                    @endif

                @else
                    <h3>{{ $title }}</h3>
                    <p>
                        @switch($section)
                            @case('commandes') Suivez et traitez les commandes en cours. @break
                            @case('paiement') Consultez l’état des paiements et règlements. @break
                            @case('parametres') Configurez les paramètres généraux de la plateforme. @break
                            @case('livreurs') Gérez le réseau de livreurs Horizon Post. @break
                            @case('rapports') Analysez les performances et statistiques. @break
                            @case('configurations') Paramétrez les options avancées du système. @break
                            @case('admin') Vue administrateur principale. @break
                            @default Bienvenue sur le tableau de bord Horizon Post.
                        @endswitch
                    </p>
                @endif
            </section>
        </main>
    </div>

    <div class="modal-backdrop" id="partenaire-modal" role="dialog" aria-modal="true">
        <div class="modal">
            <h3 id="modal-title">Partenaire</h3>
            <form method="POST" id="partenaire-form">
                @csrf
                @method('PUT')
                <div class="field"><label>Date</label><input id="m_date" type="text" disabled></div>
                <div class="field"><label>ID</label><input id="m_id" type="text" disabled></div>
                <div class="field"><label>Nom Partenaire</label><input id="m_nom" name="nom_client" type="text" required></div>
                <div class="field"><label>Contact</label><input id="m_contact" name="telephone" type="text" required></div>
                <div class="field"><label>Ville</label><input id="m_ville" name="ville" type="text" required></div>
                <div class="field">
                    <label>Type Partenaire</label>
                    <select id="m_type" name="type_partenaire" required>
                        <option value="Magasin">Magasin</option>
                        <option value="Agence">Agence</option>
                        <option value="Entreprise">Entreprise</option>
                        <option value="Particulier">Particulier</option>
                    </select>
                </div>
                <div class="field">
                    <label>Mode Paiement</label>
                    <select id="m_paiement" name="mode_paiement" required>
                        <option value="Espèces">Espèces</option>
                        <option value="Virement">Virement</option>
                        <option value="Chèque">Chèque</option>
                        <option value="Carte">Carte</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-close" onclick="closePartenaireModal()">Fermer</button>
                    <button type="submit" class="btn btn-add" id="modal-save">Valider</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        toggle?.addEventListener('click', () => sidebar.classList.toggle('open'));

        const themeToggle = document.getElementById('theme-toggle');
        themeToggle?.addEventListener('click', () => {
            const current = document.documentElement.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('horizon-theme', next);
        });

        const partenairesToggle = document.getElementById('partenaires-toggle');
        const partenairesGroup = document.getElementById('partenaires-group');
        partenairesToggle?.addEventListener('click', () => {
            partenairesGroup.classList.toggle('open');
            partenairesToggle.setAttribute(
                'aria-expanded',
                partenairesGroup.classList.contains('open') ? 'true' : 'false'
            );
        });

        const addPanel = document.getElementById('add-partenaire-panel');
        document.getElementById('open-add-partenaire')?.addEventListener('click', () => {
            addPanel?.classList.add('open');
        });
        document.getElementById('close-add-partenaire')?.addEventListener('click', () => {
            addPanel?.classList.remove('open');
        });

        document.querySelectorAll('.statut-select').forEach((select) => {
            const sync = () => {
                select.classList.remove('en_attente', 'valide', 'refuse');
                select.classList.add(select.value);
            };
            select.addEventListener('change', sync);
            sync();
        });

        function openPartenaireModal(mode, row) {
            const modal = document.getElementById('partenaire-modal');
            const form = document.getElementById('partenaire-form');
            const id = row.dataset.id;
            form.action = `/admin/partenaires/${id}`;

            document.getElementById('m_date').value = row.dataset.date;
            document.getElementById('m_id').value = id;
            document.getElementById('m_nom').value = row.dataset.nom;
            document.getElementById('m_contact').value = row.dataset.contact;
            document.getElementById('m_ville').value = row.dataset.ville;
            document.getElementById('m_type').value = row.dataset.type || 'Magasin';
            document.getElementById('m_paiement').value = row.dataset.paiement || 'Virement';

            const editable = mode === 'edit';
            ['m_nom','m_contact','m_ville','m_type','m_paiement'].forEach((fid) => {
                document.getElementById(fid).disabled = !editable;
            });

            document.getElementById('modal-title').textContent = editable ? 'Modifier partenaire' : 'Voir partenaire';
            document.getElementById('modal-save').style.display = editable ? 'inline-block' : 'none';
            modal.classList.add('open');
        }

        function closePartenaireModal() {
            document.getElementById('partenaire-modal').classList.remove('open');
        }

        document.getElementById('partenaire-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'partenaire-modal') closePartenaireModal();
        });
    </script>
</body>
</html>
