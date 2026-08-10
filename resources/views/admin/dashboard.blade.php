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
            --nav-bg-1: rgba(20, 34, 56, 0.92);
            --nav-bg-2: rgba(11, 20, 36, 0.88);
            --sidebar-bg-1: #14233a;
            --sidebar-bg-2: #101c2e;
            --sidebar-bg-3: #0d1726;
            --ico-bg-1: #2a4060;
            --ico-bg-2: #1a2c44;
            --hover-bg: rgba(255, 255, 255, 0.05);
            --chip-bg: rgba(255, 255, 255, 0.04);
            --shadow: 0 12px 32px rgba(0, 0, 0, 0.28);
            --shadow-soft: 0 4px 16px rgba(0, 0, 0, 0.18);
            --modal-backdrop: rgba(0, 0, 0, 0.55);
            --badge-ring: rgba(13, 23, 40, 0.65);
            --content-glow: rgba(242, 101, 34, 0.1);
            --success-bg: rgba(34, 197, 94, 0.15);
            --success-border: rgba(34, 197, 94, 0.4);
            --success-text: #bbf7d0;
            --sidebar-w: 278px;
            --green: #22c55e;
            --yellow: #eab308;
            --red: #ef4444;
            --glass: rgba(255, 255, 255, 0.03);
            --ring: 0 0 0 1px rgba(255, 255, 255, 0.06);
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
            --bg: #e8eef6;
            --bg-soft: #f4f7fb;
            --surface: #ffffff;
            --surface-2: #ffffff;
            --surface-3: #1a2d45;
            --nav-bg-1: rgba(255, 255, 255, 0.92);
            --nav-bg-2: rgba(248, 250, 252, 0.9);
            --sidebar-bg-1: #ffffff;
            --sidebar-bg-2: #f7f9fc;
            --sidebar-bg-3: #eef2f7;
            --ico-bg-1: #fff1e8;
            --ico-bg-2: #ffe3d4;
            --hover-bg: rgba(11, 22, 40, 0.04);
            --chip-bg: rgba(11, 22, 40, 0.035);
            --shadow: 0 14px 36px rgba(11, 22, 40, 0.1);
            --shadow-soft: 0 6px 18px rgba(11, 22, 40, 0.06);
            --modal-backdrop: rgba(11, 22, 40, 0.35);
            --badge-ring: #ffffff;
            --content-glow: rgba(232, 93, 28, 0.1);
            --success-bg: rgba(34, 197, 94, 0.12);
            --success-border: rgba(34, 197, 94, 0.35);
            --success-text: #166534;
            --glass: rgba(255, 255, 255, 0.65);
            --ring: 0 0 0 1px rgba(11, 22, 40, 0.05);
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
            padding: 0.7rem 1.2rem;
            background:
                linear-gradient(120deg, rgba(242, 101, 34, 0.12), transparent 28%),
                linear-gradient(180deg, var(--nav-bg-1), var(--nav-bg-2));
            border-bottom: 1px solid var(--orange-border);
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(18px) saturate(1.2);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-family: "Outfit", sans-serif;
            font-weight: 700;
            letter-spacing: 0.03em;
            white-space: nowrap;
            color: var(--text);
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 13px;
            background: linear-gradient(145deg, #ff8a4c, var(--orange) 48%, #c94410);
            display: grid;
            place-items: center;
            font-size: 1.05rem;
            color: #fff;
            font-weight: 800;
            box-shadow:
                0 10px 22px rgba(242, 101, 34, 0.38),
                inset 0 1px 0 rgba(255, 255, 255, 0.35);
            position: relative;
        }

        .brand-mark::after {
            content: "";
            position: absolute;
            inset: -3px;
            border-radius: 15px;
            border: 1px solid var(--orange-border);
            opacity: 0.7;
            pointer-events: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            flex-wrap: wrap;
            padding: 0.28rem;
            border-radius: 18px;
            background:
                linear-gradient(180deg, var(--glass), transparent),
                var(--chip-bg);
            border: 1px solid var(--line);
            box-shadow: var(--ring), inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.4rem 0.85rem 0.4rem 0.4rem;
            border-radius: 13px;
            font-size: 0.86rem;
            font-weight: 600;
            color: var(--muted);
            border: 1px solid transparent;
            position: relative;
            transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-links a:hover {
            background: var(--hover-bg);
            color: var(--text);
            transform: translateY(-1px);
            border-color: var(--line);
        }

        .nav-links a.active {
            background: linear-gradient(165deg, rgba(242, 101, 34, 0.22), rgba(242, 101, 34, 0.06));
            color: var(--text);
            border-color: var(--orange-border);
            box-shadow:
                0 8px 18px rgba(242, 101, 34, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .nav-links a.active::after {
            content: "";
            position: absolute;
            left: 18%;
            right: 18%;
            bottom: 3px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, transparent, var(--orange), transparent);
            opacity: 0.85;
        }

        .nav-ico {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: inline-grid;
            place-items: center;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--ico-bg-1), var(--ico-bg-2));
            border: 1px solid var(--line);
            color: var(--accent-text);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.14);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-links a:hover .nav-ico {
            transform: scale(1.04);
        }

        .nav-links a.active .nav-ico {
            background: linear-gradient(145deg, #ff9a63, var(--orange));
            color: #fff;
            border-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0 6px 14px rgba(242, 101, 34, 0.4);
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
            background:
                radial-gradient(circle at top left, rgba(242, 101, 34, 0.14), transparent 42%),
                linear-gradient(180deg, var(--sidebar-bg-1) 0%, var(--sidebar-bg-2) 55%, var(--sidebar-bg-3) 100%);
            border-right: 1px solid var(--orange-border);
            padding: 1.15rem 0.85rem;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 64px);
            box-shadow: inset -1px 0 0 rgba(255, 255, 255, 0.03);
        }

        .sidebar-top {
            flex: 1;
            min-height: 0;
        }

        .sidebar h2 {
            font-family: "Outfit", sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 0.85rem;
            margin-bottom: 0.95rem;
            opacity: 0.9;
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 16px;
            background:
                linear-gradient(145deg, rgba(242, 101, 34, 0.1), transparent 60%),
                var(--chip-bg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-soft);
        }

        .profile-card--nav {
            padding: 0.32rem 0.75rem 0.32rem 0.32rem;
            gap: 0.6rem;
            border-radius: 999px;
            background:
                linear-gradient(145deg, rgba(242, 101, 34, 0.12), transparent 55%),
                var(--chip-bg);
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
            font-size: 0.72rem;
            color: var(--accent-text);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
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
            gap: 0.4rem;
        }

        .side-links > li > a,
        .side-group > .side-parent {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.8rem;
            border-radius: 14px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid transparent;
            background: transparent;
            transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .side-links > li > a:hover,
        .side-group > .side-parent:hover {
            background: linear-gradient(90deg, var(--hover-bg), transparent);
            color: var(--text);
            transform: translateX(3px);
            border-color: var(--line);
        }

        .side-links > li > a.active,
        .side-group.has-active > .side-parent {
            background: linear-gradient(100deg, rgba(242, 101, 34, 0.2), rgba(242, 101, 34, 0.04) 70%, transparent);
            color: var(--text);
            border-color: var(--orange-border);
            box-shadow:
                inset 3px 0 0 var(--orange),
                0 8px 18px rgba(242, 101, 34, 0.1);
        }

        .side-ico {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-grid;
            place-items: center;
            flex-shrink: 0;
            background: linear-gradient(145deg, var(--ico-bg-1), var(--ico-bg-2));
            border: 1px solid var(--line);
            color: var(--accent-text);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.14),
                0 6px 14px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .side-links > li > a:hover .side-ico,
        .side-group > .side-parent:hover .side-ico {
            transform: scale(1.05);
        }

        .side-links > li > a.active .side-ico,
        .side-group.has-active > .side-parent .side-ico {
            background: linear-gradient(145deg, #ff9a63, var(--orange));
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 16px rgba(242, 101, 34, 0.38);
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
            background: linear-gradient(90deg, var(--hover-bg), transparent);
            color: var(--text);
            border-color: var(--line);
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
            transition: transform 0.22s ease;
            opacity: 0.75;
            margin-right: 0.25rem;
        }

        .side-group.open .side-caret {
            transform: rotate(45deg);
            color: var(--orange);
            opacity: 1;
        }

        .sub-links {
            list-style: none;
            display: none;
            flex-direction: column;
            gap: 0.28rem;
            padding: 0.35rem 0 0.45rem 0.45rem;
            margin: 0.15rem 0 0.2rem 1.15rem;
            border-left: 2px solid transparent;
            border-image: linear-gradient(180deg, var(--orange), transparent) 1;
        }

        .side-group.open .sub-links {
            display: flex;
            animation: sideSubIn 0.22s ease;
        }

        @keyframes sideSubIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .sub-links a {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.58rem 0.75rem;
            border-radius: 12px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.84rem;
            border: 1px solid transparent;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }

        .sub-links a:hover {
            background: var(--hover-bg);
            color: var(--text);
            transform: translateX(2px);
        }

        .sub-links a.active {
            background: linear-gradient(90deg, rgba(242, 101, 34, 0.18), transparent);
            color: var(--text);
            border-color: var(--orange-border);
            box-shadow: inset 2px 0 0 var(--orange);
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
            background: linear-gradient(145deg, #ff9a63, var(--orange));
            color: #fff;
            border-color: transparent;
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
            margin-bottom: 1.35rem;
        }

        .card {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(160deg, rgba(255, 255, 255, 0.04), transparent 45%),
                var(--surface-2);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 1.2rem 1.2rem 1.15rem;
            text-align: left;
            box-shadow: var(--shadow-soft);
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, #ff9a63, var(--orange));
            border-radius: 18px 0 0 18px;
        }

        .card::after {
            content: "";
            position: absolute;
            top: -40%;
            right: -20%;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(242, 101, 34, 0.18), transparent 68%);
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: var(--orange-border);
            box-shadow: var(--shadow);
        }

        .card .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
            position: relative;
            z-index: 1;
        }

        .card .card-ico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-grid;
            place-items: center;
            background: linear-gradient(145deg, rgba(242, 101, 34, 0.22), rgba(242, 101, 34, 0.08));
            border: 1px solid var(--orange-border);
            color: var(--accent-text);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12);
        }

        .card .card-chip {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-text);
            padding: 0.28rem 0.55rem;
            border-radius: 999px;
            background: var(--orange-soft);
            border: 1px solid var(--orange-border);
        }

        .card .label {
            color: var(--muted);
            font-size: 0.84rem;
            font-weight: 600;
            margin-bottom: 0.35rem;
            position: relative;
            z-index: 1;
        }

        .card .value {
            font-family: "Outfit", sans-serif;
            font-size: 1.85rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
            position: relative;
            z-index: 1;
            line-height: 1.1;
        }

        .card.card--partners::before { background: linear-gradient(180deg, #60a5fa, #2563eb); }
        .card.card--partners .card-ico {
            color: #93c5fd;
            background: linear-gradient(145deg, rgba(37, 99, 235, 0.22), rgba(37, 99, 235, 0.08));
            border-color: rgba(37, 99, 235, 0.35);
        }
        .card.card--partners .card-chip {
            color: #93c5fd;
            background: rgba(37, 99, 235, 0.14);
            border-color: rgba(37, 99, 235, 0.3);
        }
        .card.card--partners::after {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.18), transparent 68%);
        }

        .card.card--insc::before { background: linear-gradient(180deg, #4ade80, #16a34a); }
        .card.card--insc .card-ico {
            color: #86efac;
            background: linear-gradient(145deg, rgba(22, 163, 74, 0.22), rgba(22, 163, 74, 0.08));
            border-color: rgba(22, 163, 74, 0.35);
        }
        .card.card--insc .card-chip {
            color: #86efac;
            background: rgba(22, 163, 74, 0.14);
            border-color: rgba(22, 163, 74, 0.3);
        }
        .card.card--insc::after {
            background: radial-gradient(circle, rgba(22, 163, 74, 0.18), transparent 68%);
        }

        .card.card--pay::before { background: linear-gradient(180deg, #fbbf24, #d97706); }
        .card.card--pay .card-ico {
            color: #fcd34d;
            background: linear-gradient(145deg, rgba(217, 119, 6, 0.22), rgba(217, 119, 6, 0.08));
            border-color: rgba(217, 119, 6, 0.35);
        }
        .card.card--pay .card-chip {
            color: #fcd34d;
            background: rgba(217, 119, 6, 0.14);
            border-color: rgba(217, 119, 6, 0.3);
        }
        .card.card--pay::after {
            background: radial-gradient(circle, rgba(217, 119, 6, 0.18), transparent 68%);
        }

        html[data-theme="light"] .card.card--partners .card-chip,
        html[data-theme="light"] .card.card--partners .card-ico { color: #1d4ed8; }
        html[data-theme="light"] .card.card--insc .card-chip,
        html[data-theme="light"] .card.card--insc .card-ico { color: #15803d; }
        html[data-theme="light"] .card.card--pay .card-chip,
        html[data-theme="light"] .card.card--pay .card-ico { color: #b45309; }

        .panel {
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.03), transparent 28%),
                var(--surface-2);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 1.25rem;
            min-height: 280px;
            box-shadow: var(--shadow-soft);
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
            text-align: center;
            vertical-align: middle;
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
            padding: 0.9rem 1.05rem;
            border-radius: 16px;
            background:
                linear-gradient(120deg, rgba(242, 101, 34, 0.16), transparent 42%),
                linear-gradient(180deg, var(--glass), transparent),
                var(--chip-bg);
            border: 1px solid var(--orange-border);
            box-shadow: var(--ring), inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        .section-title {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            margin: 0;
            text-align: left;
            font-family: "Outfit", sans-serif;
            font-size: 1.18rem;
            font-weight: 700;
            letter-spacing: -0.015em;
            color: var(--text);
        }

        .section-title-ico {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-grid;
            place-items: center;
            background: linear-gradient(145deg, #ff9a63, var(--orange));
            color: #fff;
            box-shadow:
                0 10px 20px rgba(242, 101, 34, 0.32),
                inset 0 1px 0 rgba(255, 255, 255, 0.28);
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

        .etat-badge {
            display: inline-block;
            padding: 0.25rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .etat-badge.confirmee {
            background: rgba(34, 197, 94, 0.18);
            color: #16a34a;
        }

        .etat-badge.annulee {
            background: rgba(239, 68, 68, 0.18);
            color: #dc2626;
        }

        .etat-badge.retour {
            background: rgba(245, 158, 11, 0.2);
            color: #d97706;
        }

        .etat-badge.reportee {
            background: rgba(59, 130, 246, 0.18);
            color: #2563eb;
        }

        html[data-theme="dark"] .etat-badge.confirmee { color: #86efac; }
        html[data-theme="dark"] .etat-badge.annulee { color: #fca5a5; }
        html[data-theme="dark"] .etat-badge.retour { color: #fcd34d; }
        html[data-theme="dark"] .etat-badge.reportee { color: #93c5fd; }

        .livreurs-map-wrap {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--orange-border);
            background: var(--surface);
        }

        .map-collapsible.is-hidden {
            display: none;
        }

        .map-toggle-ico--show { display: none; }
        .btn.is-map-hidden .map-toggle-ico--hide { display: none; }
        .btn.is-map-hidden .map-toggle-ico--show { display: block; }

        #livreurs-map,
        .livreurs-map {
            width: 100%;
            height: min(70vh, 620px);
            min-height: 420px;
            z-index: 1;
        }

        .map-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem 1.25rem;
            justify-content: center;
            align-items: center;
            padding: 0.85rem 1rem;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 0.85rem;
        }

        .map-legend strong {
            color: var(--orange);
            font-weight: 700;
        }

        .legend-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 0.25rem;
            vertical-align: middle;
            border: 1px solid rgba(255, 255, 255, 0.55);
        }

        .legend-livreur { background: #f26522; }
        .legend-client { background: #1d4ed8; }

        .leaflet-popup-content {
            text-align: center;
            margin: 0.65rem 0.85rem;
            color: #0b1628;
        }

        .leaflet-popup-content .popup-name {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .leaflet-popup-content .popup-meta {
            font-size: 0.8rem;
            color: #475569;
            line-height: 1.45;
        }

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

        .modal input,
        .modal select {
            width: 100%;
            border: 1px solid var(--line);
            background: var(--chip-bg);
            color: var(--text);
            border-radius: 10px;
            padding: 0.7rem 0.85rem;
            font: inherit;
            text-align: center;
        }

        .modal select option {
            color: #0b1628;
            background: #fff;
        }

        .modal input:disabled,
        .modal select:disabled {
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
        $destinataireSections = ['fiche-destinataire', 'historique-livraison', 'balances-paiement'];
        $livreurSections = ['fiche-livreur', 'etat-livraison', 'carte-livreurs'];
        $configSections = ['utilisateur', 'configurations'];
        $compactSections = array_merge(
            ['fiche-partenaire', 'balance-partenaire'],
            $destinataireSections,
            $livreurSections,
            $configSections
        );
        $titles = [
            'dashboard' => 'Tableau de Bord',
            'partenaires' => 'Partenaires',
            'fiche-partenaire' => 'Fiche Partenaire',
            'balance-partenaire' => 'Balance Partenaire',
            'destinataires' => 'Destinataires',
            'fiche-destinataire' => 'Fiche Destinataire',
            'historique-livraison' => 'Historique Livraison',
            'balances-paiement' => 'Balances Paiement',
            'commandes' => 'Commandes',
            'paiement' => 'État Paiement',
            'parametres' => 'Paramètres',
            'admin' => 'Admin',
            'nvx-insc' => 'Nouvelles Inscriptions',
            'livreurs' => 'Livreurs',
            'fiche-livreur' => 'Fiche Livreur',
            'etat-livraison' => 'Etat Livraison',
            'carte-livreurs' => 'Carte Livreurs',
            'rapports' => 'Rapports',
            'configurations' => 'Configurations',
            'utilisateur' => 'Utilisateur',
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
            <a href="{{ route('admin.section', 'fiche-livreur') }}" class="{{ in_array($section, $livreurSections, true) ? 'active' : '' }}">
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
            <a href="{{ route('admin.section', 'utilisateur') }}" class="{{ in_array($section, $configSections, true) ? 'active' : '' }}">
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
                <li class="side-group {{ in_array($section, $destinataireSections, true) ? 'open has-active' : '' }}" id="destinataires-group">
                    <button type="button" class="side-parent" id="destinataires-toggle" aria-expanded="{{ in_array($section, $destinataireSections, true) ? 'true' : 'false' }}">
                        <span class="side-parent-left">
                            <span class="side-ico" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            Destinataires
                        </span>
                        <span class="side-caret" aria-hidden="true"></span>
                    </button>
                    <ul class="sub-links">
                        <li>
                            <a href="{{ route('admin.section', 'fiche-destinataire') }}" class="{{ $section === 'fiche-destinataire' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/></svg>
                                </span>
                                Fiche Destinataire
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.section', 'historique-livraison') }}" class="{{ $section === 'historique-livraison' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                </span>
                                Historique Livraison
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.section', 'balances-paiement') }}" class="{{ $section === 'balances-paiement' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M5 8h4a3 3 0 0 1 0 6H5m14-3h-5a3 3 0 0 0 0 6h5"/></svg>
                                </span>
                                Balances Paiement
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="side-group {{ in_array($section, $livreurSections, true) ? 'open has-active' : '' }}" id="livreurs-group">
                    <button type="button" class="side-parent" id="livreurs-toggle" aria-expanded="{{ in_array($section, $livreurSections, true) ? 'true' : 'false' }}">
                        <span class="side-parent-left">
                            <span class="side-ico" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5" cy="18" r="2"/><circle cx="19" cy="18" r="2"/><path d="M5 18H3V7a1 1 0 0 1 1-1h9l4 5h3a2 2 0 0 1 2 2v5h-2"/><path d="M13 6v5h5"/></svg>
                            </span>
                            Livreurs
                        </span>
                        <span class="side-caret" aria-hidden="true"></span>
                    </button>
                    <ul class="sub-links">
                        <li>
                            <a href="{{ route('admin.section', 'fiche-livreur') }}" class="{{ $section === 'fiche-livreur' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/></svg>
                                </span>
                                Fiche Livreur
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.section', 'etat-livraison') }}" class="{{ $section === 'etat-livraison' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                </span>
                                Etat Livraison
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.section', 'carte-livreurs') }}" class="{{ $section === 'carte-livreurs' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                Carte Livreurs
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
                <li class="side-group {{ in_array($section, $configSections, true) ? 'open has-active' : '' }}" id="configurations-group">
                    <button type="button" class="side-parent" id="configurations-toggle" aria-expanded="{{ in_array($section, $configSections, true) ? 'true' : 'false' }}">
                        <span class="side-parent-left">
                            <span class="side-ico" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>
                            </span>
                            Configurations
                        </span>
                        <span class="side-caret" aria-hidden="true"></span>
                    </button>
                    <ul class="sub-links">
                        <li>
                            <a href="{{ route('admin.section', 'utilisateur') }}" class="{{ $section === 'utilisateur' ? 'active' : '' }}">
                                <span class="sub-ico" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                Utilisateur
                            </a>
                        </li>
                    </ul>
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

        <main class="content {{ in_array($section, $compactSections, true) ? 'is-compact' : '' }}">
            <h1 class="page-title {{ in_array($section, $compactSections, true) ? 'is-hidden' : '' }}">{{ $title }}</h1>

            @if (session('admin_success') && ! in_array($section, ['fiche-partenaire', 'fiche-destinataire', 'fiche-livreur', 'utilisateur'], true))
                <div class="alert-ok">{{ session('admin_success') }}</div>
            @endif

            @if ($section === 'dashboard')
                <div class="cards">
                    <article class="card card--orders">
                        <div class="card-top">
                            <span class="card-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 8l-9 5-9-5 9-5 9 5z"/><path d="M3 8v8l9 5 9-5V8"/></svg>
                            </span>
                            <span class="card-chip">Jour</span>
                        </div>
                        <div class="label">Commandes du jour</div>
                        <div class="value">128</div>
                    </article>
                    <article class="card card--partners">
                        <div class="card-top">
                            <span class="card-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </span>
                            <span class="card-chip">Actifs</span>
                        </div>
                        <div class="label">Partenaires actifs</div>
                        <div class="value">{{ ($partenaires ?? null) ? $partenaires->count() : \App\Models\Partenaire::count() }}</div>
                    </article>
                    <article class="card card--insc">
                        <div class="card-top">
                            <span class="card-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>
                            </span>
                            <span class="card-chip">Nvx</span>
                        </div>
                        <div class="label">Nvx inscriptions</div>
                        <div class="value">{{ $nvxCount }}</div>
                    </article>
                    <article class="card card--pay">
                        <div class="card-top">
                            <span class="card-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                            </span>
                            <span class="card-chip">Attente</span>
                        </div>
                        <div class="label">Paiements en attente</div>
                        <div class="value">12</div>
                    </article>
                </div>
            @endif

            <section class="panel {{ in_array($section, ['dashboard', 'fiche-partenaire', 'fiche-destinataire', 'historique-livraison', 'balances-paiement', 'fiche-livreur', 'etat-livraison', 'carte-livreurs', 'utilisateur'], true) ? 'is-flush' : '' }}">
                @if ($section === 'dashboard')
                    @include('admin.partials.livreurs-map', [
                        'mapPoints' => $mapPoints ?? [],
                        'mapId' => 'dashboard-livreurs-map',
                        'showMapHeader' => true,
                        'showMapClose' => false,
                        'mapTitle' => 'Localisation livreurs & clients',
                    ])

                @elseif ($section === 'nvx-insc')
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
                                    <label for="add_statue">Statue</label>
                                    <select id="add_statue" name="statue" required>
                                        <option value="">Choisir</option>
                                        <option value="Rev">Rev</option>
                                        <option value="Ste">Ste</option>
                                        <option value="Divers">Divers</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="add_ville">Ville</label>
                                    <input id="add_ville" type="text" name="ville" required>
                                </div>
                                <div class="field" style="grid-column: 1 / -1;">
                                    <label for="add_activite">Activité</label>
                                    <input id="add_activite" type="text" name="activite" required>
                                </div>
                            </div>
                            <div class="add-actions">
                                <button type="submit" class="btn btn-add">Valider</button>
                                <button type="button" class="btn btn-close" id="close-add-partenaire">Fermer</button>
                            </div>
                        </form>
                    </div>

                    @if (($partenaires ?? collect())->isEmpty())
                        <div id="partenaires-list">
                            <p class="empty-state">Aucun partenaire pour le moment.</p>
                        </div>
                    @else
                        <div class="table-wrap" id="partenaires-list">
                            <table class="data-table" id="partenaires-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Nom Partenaire</th>
                                        <th>Contact</th>
                                        <th>Statue</th>
                                        <th>Ville</th>
                                        <th>Activité</th>
                                        <th>Solde</th>
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
                                            data-statue="{{ $p->statue }}"
                                            data-ville="{{ $p->ville }}"
                                            data-activite="{{ $p->activite }}"
                                            data-date="{{ $p->created_at->format('d/m/Y') }}"
                                        >
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->nom_client }}</td>
                                            <td>{{ $p->telephone }}</td>
                                            <td>{{ $p->statue ?: '—' }}</td>
                                            <td>{{ $p->ville }}</td>
                                            <td>{{ $p->activite ?: '—' }}</td>
                                            <td>{{ number_format((float) ($p->solde ?? 0), 2, '.', ' ') }}</td>
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

                @elseif ($section === 'fiche-destinataire')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Destinataires</small>
                                Fiche Destinataire
                            </span>
                        </h3>
                        <div class="section-actions">
                            <button type="button" class="btn btn-add" id="open-add-destinataire">
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

                    <div class="add-panel" id="add-destinataire-panel">
                        <h4>Nouveau destinataire</h4>
                        <form method="POST" action="{{ route('admin.destinataires.store') }}">
                            @csrf
                            <div class="add-grid">
                                <div class="field">
                                    <label for="add_d_nom">Nom Complet</label>
                                    <input id="add_d_nom" type="text" name="nom_complet" required>
                                </div>
                                <div class="field">
                                    <label for="add_d_contact">Contact</label>
                                    <input id="add_d_contact" type="text" name="contact" placeholder="00212..." required>
                                </div>
                                <div class="field">
                                    <label for="add_d_ville">Ville</label>
                                    <input id="add_d_ville" type="text" name="ville" required>
                                </div>
                                <div class="field">
                                    <label for="add_d_activite">Activité</label>
                                    <input id="add_d_activite" type="text" name="activite" required>
                                </div>
                            </div>
                            <div class="add-actions">
                                <button type="submit" class="btn btn-add">Valider</button>
                                <button type="button" class="btn btn-close" id="close-add-destinataire">Fermer</button>
                            </div>
                        </form>
                    </div>

                    @if (($destinataires ?? collect())->isEmpty())
                        <div id="destinataires-list">
                            <p class="empty-state">Aucun destinataire pour le moment.</p>
                        </div>
                    @else
                        <div class="table-wrap" id="destinataires-list">
                            <table class="data-table" id="destinataires-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Nom Complet</th>
                                        <th>Contact</th>
                                        <th>Ville</th>
                                        <th>Activité</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($destinataires as $d)
                                        <tr
                                            data-id="{{ $d->id }}"
                                            data-nom="{{ $d->nom_complet }}"
                                            data-contact="{{ $d->contact }}"
                                            data-ville="{{ $d->ville }}"
                                            data-activite="{{ $d->activite }}"
                                            data-date="{{ $d->created_at->format('d/m/Y') }}"
                                        >
                                            <td>{{ $d->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $d->id }}</td>
                                            <td>{{ $d->nom_complet }}</td>
                                            <td>{{ $d->contact }}</td>
                                            <td>{{ $d->ville }}</td>
                                            <td>{{ $d->activite }}</td>
                                            <td>
                                                <div class="actions">
                                                    <button type="button" class="icon-btn" title="Voir" onclick="openDestinataireModal(this.closest('tr'))" aria-label="Voir">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </button>
                                                    <button type="button" class="icon-btn" title="Imprimer" onclick="printDestinataireRow(this.closest('tr'))" aria-label="Imprimer">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'historique-livraison')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Destinataires</small>
                                Historique Livraison
                            </span>
                        </h3>
                        <div class="section-actions">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-close">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                                Fermer
                            </a>
                        </div>
                    </div>
                    @if (($livraisonHistoriques ?? collect())->isEmpty())
                        <p class="empty-state">Aucun historique de livraison pour le moment.</p>
                    @else
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nom Complet</th>
                                        <th>Nombres Cmd</th>
                                        <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($livraisonHistoriques as $h)
                                        <tr>
                                            <td>{{ $h->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $h->destinataire?->nom_complet ?? '—' }}</td>
                                            <td>{{ $h->nombres_cmd }}</td>
                                            <td>
                                                <span class="etat-badge {{ $h->etat }}">
                                                    {{ \App\Models\LivraisonHistorique::etatLabel($h->etat) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'balances-paiement')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 3v18M5 8h4a3 3 0 0 1 0 6H5m14-3h-5a3 3 0 0 0 0 6h5"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Destinataires</small>
                                Balances Paiement
                            </span>
                        </h3>
                        <div class="section-actions">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-close">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                                Fermer
                            </a>
                        </div>
                    </div>
                    @if (($destinataires ?? collect())->isEmpty())
                        <p class="empty-state">Aucune balance de paiement pour le moment.</p>
                    @else
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom Complet</th>
                                        <th>Activité</th>
                                        <th>Nbrs Cmd Confirmée</th>
                                        <th>Total Paiement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($destinataires as $d)
                                        @php
                                            $confirmees = $d->historiques->where('etat', 'confirmee');
                                            $nbrs = (int) $confirmees->sum('nombres_cmd');
                                            $total = (float) $confirmees->sum('total_paiement');
                                        @endphp
                                        <tr>
                                            <td>{{ $d->id }}</td>
                                            <td>{{ $d->nom_complet }}</td>
                                            <td>{{ $d->activite }}</td>
                                            <td>{{ $nbrs }}</td>
                                            <td>{{ number_format($total, 2, '.', ' ') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'fiche-livreur')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="5" cy="18" r="2"/><circle cx="19" cy="18" r="2"/><path d="M5 18H3V7a1 1 0 0 1 1-1h9l4 5h3a2 2 0 0 1 2 2v5h-2"/><path d="M13 6v5h5"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Livreurs</small>
                                Fiche Livreur
                            </span>
                        </h3>
                        <div class="section-actions">
                            <button type="button" class="btn btn-add" id="open-add-livreur">
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

                    <div class="add-panel" id="add-livreur-panel">
                        <h4>Nouveau livreur</h4>
                        <form method="POST" action="{{ route('admin.livreurs.store') }}">
                            @csrf
                            <div class="add-grid">
                                <div class="field">
                                    <label for="add_l_nom">Nom Complet</label>
                                    <input id="add_l_nom" type="text" name="nom_complet" required>
                                </div>
                                <div class="field">
                                    <label for="add_l_contact">Contact</label>
                                    <input id="add_l_contact" type="text" name="contact" placeholder="00212..." required>
                                </div>
                                <div class="field">
                                    <label for="add_l_email">E-mail</label>
                                    <input id="add_l_email" type="email" name="email" required>
                                </div>
                                <div class="field">
                                    <label for="add_l_ville">Ville</label>
                                    <input id="add_l_ville" type="text" name="ville" required>
                                </div>
                                <div class="field">
                                    <label for="add_l_adresse">Quartier / Adresse</label>
                                    <input id="add_l_adresse" type="text" name="adresse" placeholder="ex: Kamlia" required>
                                </div>
                                <div class="field" style="grid-column: 1 / -1;">
                                    <label for="add_l_paiement">Type Paiement</label>
                                    <select id="add_l_paiement" name="type_paiement" required>
                                        <option value="">Choisir</option>
                                        <option value="Salaire">Salaire</option>
                                        <option value="Commission">Commission</option>
                                        <option value="Pourcentage">Pourcentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="add-actions">
                                <button type="submit" class="btn btn-add">Valider</button>
                                <button type="button" class="btn btn-close" id="close-add-livreur">Fermer</button>
                            </div>
                        </form>
                    </div>

                    @if (($livreurs ?? collect())->isEmpty())
                        <div id="livreurs-list">
                            <p class="empty-state">Aucun livreur pour le moment.</p>
                        </div>
                    @else
                        <div class="table-wrap" id="livreurs-list">
                            <table class="data-table" id="livreurs-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Nom Complet</th>
                                        <th>Contact</th>
                                        <th>E-mail</th>
                                        <th>Ville</th>
                                        <th>Quartier / Adresse</th>
                                        <th>Type Paiement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($livreurs as $l)
                                        <tr
                                            class="{{ ($l->statut ?? 'actif') === 'suspendu' ? 'is-suspended' : '' }}"
                                            data-id="{{ $l->id }}"
                                            data-nom="{{ $l->nom_complet }}"
                                            data-contact="{{ $l->contact }}"
                                            data-email="{{ $l->email }}"
                                            data-ville="{{ $l->ville }}"
                                            data-adresse="{{ $l->adresse }}"
                                            data-paiement="{{ $l->type_paiement }}"
                                            data-date="{{ $l->created_at->format('d/m/Y') }}"
                                        >
                                            <td>{{ $l->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $l->id }}</td>
                                            <td>{{ $l->nom_complet }}</td>
                                            <td>{{ $l->contact }}</td>
                                            <td>{{ $l->email }}</td>
                                            <td>{{ $l->ville }}</td>
                                            <td>{{ $l->adresse ?: '—' }}</td>
                                            <td>{{ $l->type_paiement }}</td>
                                            <td>
                                                <div class="actions">
                                                    <button type="button" class="icon-btn" title="Voir" onclick="openLivreurModal('view', this.closest('tr'))" aria-label="Voir">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </button>
                                                    <button type="button" class="icon-btn" title="Modifier" onclick="openLivreurModal('edit', this.closest('tr'))" aria-label="Modifier">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.livreurs.suspend', $l) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="icon-btn warn" title="{{ ($l->statut ?? 'actif') === 'suspendu' ? 'Réactiver' : 'Suspendre' }}" aria-label="Suspendre">
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

                @elseif ($section === 'etat-livraison')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Livreurs</small>
                                Etat Livraison
                            </span>
                        </h3>
                        <div class="section-actions">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-close">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                                Fermer
                            </a>
                        </div>
                    </div>
                    @if (($etatLivraisons ?? collect())->isEmpty())
                        <p class="empty-state">Aucun état de livraison pour le moment.</p>
                    @else
                        <div class="table-wrap">
                            <table class="data-table" id="etat-livraison-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Livreur</th>
                                        <th>Ville</th>
                                        <th>Nom Client</th>
                                        <th>Montant Colis</th>
                                        <th>Statue</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($etatLivraisons as $e)
                                        <tr
                                            data-date="{{ $e->created_at->format('d/m/Y') }}"
                                            data-livreur="{{ $e->livreurLabel() }}"
                                            data-ville="{{ $e->ville }}"
                                            data-client="{{ $e->nom_client }}"
                                            data-montant="{{ number_format((float) $e->montant_colis, 2, '.', ' ') }}"
                                            data-statue="{{ \App\Models\EtatLivraison::statueLabel($e->statue) }}"
                                            data-statue-key="{{ $e->statue }}"
                                        >
                                            <td>{{ $e->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $e->livreurLabel() }}</td>
                                            <td>{{ $e->ville }}</td>
                                            <td>{{ $e->nom_client }}</td>
                                            <td>{{ number_format((float) $e->montant_colis, 2, '.', ' ') }}</td>
                                            <td>
                                                <span class="etat-badge {{ $e->statue }}">
                                                    {{ \App\Models\EtatLivraison::statueLabel($e->statue) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="actions">
                                                    <button type="button" class="icon-btn" title="Voir" onclick="openEtatLivraisonModal(this.closest('tr'))" aria-label="Voir">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </button>
                                                    <button type="button" class="icon-btn" title="Imprimer" onclick="printEtatLivraisonRow(this.closest('tr'))" aria-label="Imprimer">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                @elseif ($section === 'carte-livreurs')
                    @include('admin.partials.livreurs-map', [
                        'mapPoints' => $mapPoints ?? [],
                        'mapId' => 'livreurs-map',
                        'showMapHeader' => true,
                        'showMapClose' => true,
                        'mapTitle' => 'Carte Livreurs',
                    ])

                @elseif ($section === 'utilisateur')
                    <div class="section-header">
                        <h3 class="section-title">
                            <span class="section-title-ico" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                </svg>
                            </span>
                            <span class="section-title-text">
                                <small>Configurations</small>
                                Utilisateur
                            </span>
                        </h3>
                        <div class="section-actions">
                            <button type="button" class="btn btn-add" id="open-add-utilisateur">
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

                    <div class="add-panel" id="add-utilisateur-panel">
                        <h4>Nouvel utilisateur</h4>
                        <form method="POST" action="{{ route('admin.utilisateurs.store') }}">
                            @csrf
                            <div class="add-grid">
                                <div class="field">
                                    <label for="add_u_nom">Nom Complet</label>
                                    <input id="add_u_nom" type="text" name="nom_complet" required>
                                </div>
                                <div class="field">
                                    <label for="add_u_contact">Contact</label>
                                    <input id="add_u_contact" type="text" name="contact" placeholder="00212..." required>
                                </div>
                                <div class="field">
                                    <label for="add_u_email">E-mail</label>
                                    <input id="add_u_email" type="email" name="email" required>
                                </div>
                                <div class="field">
                                    <label for="add_u_statue">Statue</label>
                                    <select id="add_u_statue" name="statue" required>
                                        <option value="">Choisir</option>
                                        <option value="admin">Administrateur</option>
                                        <option value="client">Client</option>
                                        <option value="livreur">Livreur</option>
                                        <option value="agence">Agence</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="add_u_login">Login</label>
                                    <input id="add_u_login" type="text" name="login" required>
                                </div>
                                <div class="field">
                                    <label for="add_u_password">Mot de Passe</label>
                                    <input id="add_u_password" type="text" name="password" required>
                                </div>
                            </div>
                            <div class="add-actions">
                                <button type="submit" class="btn btn-add">Valider</button>
                                <button type="button" class="btn btn-close" id="close-add-utilisateur">Fermer</button>
                            </div>
                        </form>
                    </div>

                    @if (($utilisateurs ?? collect())->isEmpty())
                        <div id="utilisateurs-list">
                            <p class="empty-state">Aucun utilisateur pour le moment.</p>
                        </div>
                    @else
                        <div class="table-wrap" id="utilisateurs-list">
                            <table class="data-table" id="utilisateurs-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Nom Complet</th>
                                        <th>Contact</th>
                                        <th>E-mail</th>
                                        <th>Statue</th>
                                        <th>Login</th>
                                        <th>Mot de Passe</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($utilisateurs as $u)
                                        <tr
                                            class="{{ ($u->statut ?? 'actif') === 'suspendu' ? 'is-suspended' : '' }}"
                                            data-id="{{ $u->id }}"
                                            data-nom="{{ $u->nom_complet }}"
                                            data-contact="{{ $u->contact }}"
                                            data-email="{{ $u->email }}"
                                            data-statue="{{ $u->statue }}"
                                            data-login="{{ $u->login }}"
                                            data-password="{{ $u->password }}"
                                            data-date="{{ $u->created_at->format('d/m/Y') }}"
                                        >
                                            <td>{{ $u->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $u->nom_complet }}</td>
                                            <td>{{ $u->contact }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->statueLabel() }}</td>
                                            <td>{{ $u->login }}</td>
                                            <td>{{ $u->password }}</td>
                                            <td>
                                                <div class="actions">
                                                    <button type="button" class="icon-btn" title="Voir" onclick="openUtilisateurModal('view', this.closest('tr'))" aria-label="Voir">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    </button>
                                                    <button type="button" class="icon-btn" title="Modifier" onclick="openUtilisateurModal('edit', this.closest('tr'))" aria-label="Modifier">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.utilisateurs.suspend', $u) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="icon-btn warn" title="{{ ($u->statut ?? 'actif') === 'suspendu' ? 'Réactiver' : 'Suspendre' }}" aria-label="Suspendre">
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
                <div class="field">
                    <label>Statue</label>
                    <select id="m_statue" name="statue" required>
                        <option value="Rev">Rev</option>
                        <option value="Ste">Ste</option>
                        <option value="Divers">Divers</option>
                    </select>
                </div>
                <div class="field"><label>Ville</label><input id="m_ville" name="ville" type="text" required></div>
                <div class="field"><label>Activité</label><input id="m_activite" name="activite" type="text" required></div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-close" onclick="closePartenaireModal()">Fermer</button>
                    <button type="submit" class="btn btn-add" id="modal-save">Valider</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="destinataire-modal" role="dialog" aria-modal="true">
        <div class="modal">
            <h3>Voir destinataire</h3>
            <div class="field"><label>Date</label><input id="d_date" type="text" disabled></div>
            <div class="field"><label>ID</label><input id="d_id" type="text" disabled></div>
            <div class="field"><label>Nom Complet</label><input id="d_nom" type="text" disabled></div>
            <div class="field"><label>Contact</label><input id="d_contact" type="text" disabled></div>
            <div class="field"><label>Ville</label><input id="d_ville" type="text" disabled></div>
            <div class="field"><label>Activité</label><input id="d_activite" type="text" disabled></div>
            <div class="modal-actions">
                <button type="button" class="btn btn-close" onclick="closeDestinataireModal()">Fermer</button>
                <button type="button" class="btn btn-add" onclick="printDestinataireModal()">Imprimer</button>
            </div>
        </div>
    </div>

    <div class="modal-backdrop" id="livreur-modal" role="dialog" aria-modal="true">
        <div class="modal">
            <h3 id="livreur-modal-title">Livreur</h3>
            <form method="POST" id="livreur-form">
                @csrf
                @method('PUT')
                <div class="field"><label>Date</label><input id="l_date" type="text" disabled></div>
                <div class="field"><label>ID</label><input id="l_id" type="text" disabled></div>
                <div class="field"><label>Nom Complet</label><input id="l_nom" name="nom_complet" type="text" required></div>
                <div class="field"><label>Contact</label><input id="l_contact" name="contact" type="text" required></div>
                <div class="field"><label>E-mail</label><input id="l_email" name="email" type="email" required></div>
                <div class="field"><label>Ville</label><input id="l_ville" name="ville" type="text" required></div>
                <div class="field"><label>Quartier / Adresse</label><input id="l_adresse" name="adresse" type="text" required></div>
                <div class="field">
                    <label>Type Paiement</label>
                    <select id="l_paiement" name="type_paiement" required>
                        <option value="Salaire">Salaire</option>
                        <option value="Commission">Commission</option>
                        <option value="Pourcentage">Pourcentage</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-close" onclick="closeLivreurModal()">Fermer</button>
                    <button type="submit" class="btn btn-add" id="livreur-modal-save">Valider</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="utilisateur-modal" role="dialog" aria-modal="true">
        <div class="modal">
            <h3 id="utilisateur-modal-title">Utilisateur</h3>
            <form method="POST" id="utilisateur-form">
                @csrf
                @method('PUT')
                <div class="field"><label>Date</label><input id="u_date" type="text" disabled></div>
                <div class="field"><label>Nom Complet</label><input id="u_nom" name="nom_complet" type="text" required></div>
                <div class="field"><label>Contact</label><input id="u_contact" name="contact" type="text" required></div>
                <div class="field"><label>E-mail</label><input id="u_email" name="email" type="email" required></div>
                <div class="field">
                    <label>Statue</label>
                    <select id="u_statue" name="statue" required>
                        <option value="admin">Administrateur</option>
                        <option value="client">Client</option>
                        <option value="livreur">Livreur</option>
                        <option value="agence">Agence</option>
                    </select>
                </div>
                <div class="field"><label>Login</label><input id="u_login" name="login" type="text" required></div>
                <div class="field"><label>Mot de Passe</label><input id="u_password" name="password" type="text" required></div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-close" onclick="closeUtilisateurModal()">Fermer</button>
                    <button type="submit" class="btn btn-add" id="utilisateur-modal-save">Valider</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="etat-livraison-modal" role="dialog" aria-modal="true">
        <div class="modal">
            <h3>Voir état livraison</h3>
            <div class="field"><label>Date</label><input id="el_date" type="text" disabled></div>
            <div class="field"><label>Livreur</label><input id="el_livreur" type="text" disabled></div>
            <div class="field"><label>Ville</label><input id="el_ville" type="text" disabled></div>
            <div class="field"><label>Nom Client</label><input id="el_client" type="text" disabled></div>
            <div class="field"><label>Montant Colis</label><input id="el_montant" type="text" disabled></div>
            <div class="field"><label>Statue</label><input id="el_statue" type="text" disabled></div>
            <div class="modal-actions">
                <button type="button" class="btn btn-close" onclick="closeEtatLivraisonModal()">Fermer</button>
                <button type="button" class="btn btn-add" onclick="printEtatLivraisonModal()">Imprimer</button>
            </div>
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

        const destinatairesToggle = document.getElementById('destinataires-toggle');
        const destinatairesGroup = document.getElementById('destinataires-group');
        destinatairesToggle?.addEventListener('click', () => {
            destinatairesGroup.classList.toggle('open');
            destinatairesToggle.setAttribute(
                'aria-expanded',
                destinatairesGroup.classList.contains('open') ? 'true' : 'false'
            );
        });

        const livreursToggle = document.getElementById('livreurs-toggle');
        const livreursGroup = document.getElementById('livreurs-group');
        livreursToggle?.addEventListener('click', () => {
            livreursGroup.classList.toggle('open');
            livreursToggle.setAttribute(
                'aria-expanded',
                livreursGroup.classList.contains('open') ? 'true' : 'false'
            );
        });

        const configurationsToggle = document.getElementById('configurations-toggle');
        const configurationsGroup = document.getElementById('configurations-group');
        configurationsToggle?.addEventListener('click', () => {
            configurationsGroup.classList.toggle('open');
            configurationsToggle.setAttribute(
                'aria-expanded',
                configurationsGroup.classList.contains('open') ? 'true' : 'false'
            );
        });

        const addPanel = document.getElementById('add-partenaire-panel');
        const partenairesList = document.getElementById('partenaires-list');
        document.getElementById('open-add-partenaire')?.addEventListener('click', () => {
            addPanel?.classList.add('open');
            if (partenairesList) partenairesList.style.display = 'none';
        });
        document.getElementById('close-add-partenaire')?.addEventListener('click', () => {
            addPanel?.classList.remove('open');
            if (partenairesList) partenairesList.style.display = '';
        });

        const addDestPanel = document.getElementById('add-destinataire-panel');
        const destinatairesList = document.getElementById('destinataires-list');
        document.getElementById('open-add-destinataire')?.addEventListener('click', () => {
            addDestPanel?.classList.add('open');
            if (destinatairesList) destinatairesList.style.display = 'none';
        });
        document.getElementById('close-add-destinataire')?.addEventListener('click', () => {
            addDestPanel?.classList.remove('open');
            if (destinatairesList) destinatairesList.style.display = '';
        });

        const addLivreurPanel = document.getElementById('add-livreur-panel');
        const livreursList = document.getElementById('livreurs-list');
        document.getElementById('open-add-livreur')?.addEventListener('click', () => {
            addLivreurPanel?.classList.add('open');
            if (livreursList) livreursList.style.display = 'none';
        });
        document.getElementById('close-add-livreur')?.addEventListener('click', () => {
            addLivreurPanel?.classList.remove('open');
            if (livreursList) livreursList.style.display = '';
        });

        const addUtilisateurPanel = document.getElementById('add-utilisateur-panel');
        const utilisateursList = document.getElementById('utilisateurs-list');
        document.getElementById('open-add-utilisateur')?.addEventListener('click', () => {
            addUtilisateurPanel?.classList.add('open');
            if (utilisateursList) utilisateursList.style.display = 'none';
        });
        document.getElementById('close-add-utilisateur')?.addEventListener('click', () => {
            addUtilisateurPanel?.classList.remove('open');
            if (utilisateursList) utilisateursList.style.display = '';
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
            document.getElementById('m_statue').value = row.dataset.statue || 'Divers';
            document.getElementById('m_ville').value = row.dataset.ville;
            document.getElementById('m_activite').value = row.dataset.activite || '';

            const editable = mode === 'edit';
            ['m_nom','m_contact','m_statue','m_ville','m_activite'].forEach((fid) => {
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

        function openDestinataireModal(row) {
            document.getElementById('d_date').value = row.dataset.date;
            document.getElementById('d_id').value = row.dataset.id;
            document.getElementById('d_nom').value = row.dataset.nom;
            document.getElementById('d_contact').value = row.dataset.contact;
            document.getElementById('d_ville').value = row.dataset.ville;
            document.getElementById('d_activite').value = row.dataset.activite;
            document.getElementById('destinataire-modal').classList.add('open');
        }

        function closeDestinataireModal() {
            document.getElementById('destinataire-modal').classList.remove('open');
        }

        function printDestinataireRow(row) {
            openDestinataireModal(row);
            setTimeout(() => window.print(), 150);
        }

        function printDestinataireModal() {
            window.print();
        }

        document.getElementById('destinataire-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'destinataire-modal') closeDestinataireModal();
        });

        function openLivreurModal(mode, row) {
            const modal = document.getElementById('livreur-modal');
            const form = document.getElementById('livreur-form');
            const id = row.dataset.id;
            form.action = `/admin/livreurs/${id}`;

            document.getElementById('l_date').value = row.dataset.date;
            document.getElementById('l_id').value = id;
            document.getElementById('l_nom').value = row.dataset.nom;
            document.getElementById('l_contact').value = row.dataset.contact;
            document.getElementById('l_email').value = row.dataset.email;
            document.getElementById('l_ville').value = row.dataset.ville;
            document.getElementById('l_adresse').value = row.dataset.adresse || '';
            document.getElementById('l_paiement').value = row.dataset.paiement || 'Salaire';

            const editable = mode === 'edit';
            ['l_nom','l_contact','l_email','l_ville','l_adresse','l_paiement'].forEach((fid) => {
                document.getElementById(fid).disabled = !editable;
            });

            document.getElementById('livreur-modal-title').textContent = editable ? 'Modifier livreur' : 'Voir livreur';
            document.getElementById('livreur-modal-save').style.display = editable ? 'inline-block' : 'none';
            modal.classList.add('open');
        }

        function closeLivreurModal() {
            document.getElementById('livreur-modal').classList.remove('open');
        }

        document.getElementById('livreur-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'livreur-modal') closeLivreurModal();
        });

        function openUtilisateurModal(mode, row) {
            const modal = document.getElementById('utilisateur-modal');
            const form = document.getElementById('utilisateur-form');
            const id = row.dataset.id;
            form.action = `/admin/utilisateurs/${id}`;

            document.getElementById('u_date').value = row.dataset.date;
            document.getElementById('u_nom').value = row.dataset.nom;
            document.getElementById('u_contact').value = row.dataset.contact;
            document.getElementById('u_email').value = row.dataset.email;
            document.getElementById('u_statue').value = row.dataset.statue || 'admin';
            document.getElementById('u_login').value = row.dataset.login;
            document.getElementById('u_password').value = row.dataset.password;

            const editable = mode === 'edit';
            ['u_nom','u_contact','u_email','u_statue','u_login','u_password'].forEach((fid) => {
                document.getElementById(fid).disabled = !editable;
            });

            document.getElementById('utilisateur-modal-title').textContent = editable ? 'Modifier utilisateur' : 'Voir utilisateur';
            document.getElementById('utilisateur-modal-save').style.display = editable ? 'inline-block' : 'none';
            modal.classList.add('open');
        }

        function closeUtilisateurModal() {
            document.getElementById('utilisateur-modal').classList.remove('open');
        }

        document.getElementById('utilisateur-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'utilisateur-modal') closeUtilisateurModal();
        });

        function openEtatLivraisonModal(row) {
            document.getElementById('el_date').value = row.dataset.date;
            document.getElementById('el_livreur').value = row.dataset.livreur;
            document.getElementById('el_ville').value = row.dataset.ville;
            document.getElementById('el_client').value = row.dataset.client;
            document.getElementById('el_montant').value = row.dataset.montant;
            document.getElementById('el_statue').value = row.dataset.statue;
            document.getElementById('etat-livraison-modal').classList.add('open');
        }

        function closeEtatLivraisonModal() {
            document.getElementById('etat-livraison-modal').classList.remove('open');
        }

        function printEtatLivraisonRow(row) {
            openEtatLivraisonModal(row);
            setTimeout(() => window.print(), 150);
        }

        function printEtatLivraisonModal() {
            window.print();
        }

        document.getElementById('etat-livraison-modal')?.addEventListener('click', (e) => {
            if (e.target.id === 'etat-livraison-modal') closeEtatLivraisonModal();
        });
    </script>
</body>
</html>
