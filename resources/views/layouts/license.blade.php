{{-- MRH License — shared layout for all license state pages. Self-contained
     (no external CSS/JS), themed as a secure activation gateway. --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title', 'License') · {{ config('app.name', 'Application') }}</title>

    <style>
        :root {
            --ink:        #0e1330;
            --ink-2:      #171d47;
            --surface:    #ffffff;
            --line:       #e7e8f0;
            --muted:      #6b7192;
            --text:       #1c2140;
            --brand:      #5b5bff;
            --brand-2:    #8a6bff;
            --amber:      #f5b544;
            --amber-deep: #d98a1f;
            --danger-bg:  #fdecec;
            --danger-bd:  #f5c2c2;
            --danger-tx:  #a3282f;
            --ok:         #1fa971;
            --radius:     20px;
            --shadow:     0 24px 70px -20px rgba(14,19,48,.45);
        }

        * { box-sizing: border-box; }

        html, body { margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto,
                         Helvetica, Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(1200px 600px at 15% -10%, #232a63 0%, transparent 55%),
                radial-gradient(1000px 620px at 110% 10%, #3a2f74 0%, transparent 50%),
                linear-gradient(160deg, var(--ink) 0%, var(--ink-2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 18px;
            -webkit-font-smoothing: antialiased;
        }

        /* Ambient grid + scanning beam behind the card */
        .gate-bg {
            position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 0;
        }
        .gate-bg::before {
            content: ""; position: absolute; inset: -2px;
            background-image:
                linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: radial-gradient(900px 500px at 50% 30%, #000 0%, transparent 75%);
        }
        .gate-beam {
            position: absolute; left: 0; right: 0; height: 220px;
            background: linear-gradient(180deg, transparent, rgba(138,107,255,.16), transparent);
            filter: blur(6px);
            animation: sweep 7s linear infinite;
        }
        @keyframes sweep {
            0%   { transform: translateY(-30vh); opacity: 0; }
            15%  { opacity: 1; }
            85%  { opacity: 1; }
            100% { transform: translateY(120vh); opacity: 0; }
        }

        .gate-shell { position: relative; z-index: 1; width: 100%; max-width: 452px; }

        .gate-card {
            position: relative;
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        /* Top brand rail */
        .gate-rail {
            height: 6px;
            background: linear-gradient(90deg, var(--brand), var(--brand-2) 55%, var(--amber));
        }

        .gate-body { padding: 40px 34px 34px; }

        .gate-emblem {
            width: 68px; height: 68px; margin: 0 auto 22px;
            border-radius: 18px;
            display: grid; place-items: center;
            color: #fff;
            background: linear-gradient(150deg, var(--brand), var(--brand-2));
            box-shadow: 0 12px 26px -8px rgba(91,91,255,.6);
            position: relative;
        }
        .gate-emblem svg { width: 32px; height: 32px; display: block; }
        .gate-emblem[data-state="danger"] {
            background: linear-gradient(150deg, #e2545b, #b8323a);
            box-shadow: 0 12px 26px -8px rgba(184,50,58,.55);
        }
        .gate-emblem[data-state="warn"] {
            background: linear-gradient(150deg, var(--amber), var(--amber-deep));
            box-shadow: 0 12px 26px -8px rgba(217,138,31,.55);
        }

        .gate-eyebrow {
            text-align: center;
            font-size: 11px; font-weight: 700; letter-spacing: .18em;
            text-transform: uppercase; color: var(--brand);
            margin: 0 0 8px;
        }
        .gate-title {
            text-align: center;
            font-size: 25px; line-height: 1.15; font-weight: 800;
            letter-spacing: -.02em; color: var(--ink);
            margin: 0 0 10px;
        }
        .gate-lead {
            text-align: center; font-size: 14.5px; line-height: 1.55;
            color: var(--muted); margin: 0 auto 26px; max-width: 34ch;
        }

        .gate-alert {
            display: flex; gap: 10px; align-items: flex-start;
            background: var(--danger-bg); border: 1px solid var(--danger-bd);
            color: var(--danger-tx);
            border-radius: 12px; padding: 12px 14px; margin: 0 0 22px;
            font-size: 13.5px; line-height: 1.5; text-align: left;
        }
        .gate-alert svg { flex: 0 0 auto; width: 18px; height: 18px; margin-top: 1px; }
        .gate-alert ul { margin: 0; padding-left: 18px; }

        .field { text-align: left; margin: 0 0 18px; }
        .field-label {
            display: block; font-size: 12.5px; font-weight: 600;
            color: var(--text); margin: 0 0 7px; letter-spacing: .01em;
        }
        .field-input {
            width: 100%; border: 1.5px solid var(--line); border-radius: 12px;
            padding: 14px 15px; font-size: 16px; letter-spacing: .06em;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            color: var(--ink); background: #fbfbfe; text-transform: uppercase;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }
        .field-input::placeholder { color: #b7bad0; letter-spacing: .18em; }
        .field-input:focus {
            outline: none; border-color: var(--brand); background: #fff;
            box-shadow: 0 0 0 4px rgba(91,91,255,.14);
        }

        .meta-row {
            display: flex; flex-wrap: wrap; gap: 8px; align-items: center;
            margin: 11px 0 0;
        }
        .chip {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 11.5px; font-weight: 600; color: var(--text);
            background: #f2f3fb; border: 1px solid var(--line);
            border-radius: 999px; padding: 5px 11px;
        }
        .chip .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--ok); }
        .chip .dot.pulse { animation: pulse 1.8s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .35; } }
        .chip code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 11.5px; color: var(--brand);
        }

        .btn-activate {
            width: 100%; border: 0; cursor: pointer;
            margin-top: 22px; padding: 15px 18px;
            font-size: 15.5px; font-weight: 700; letter-spacing: .01em; color: #fff;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            box-shadow: 0 14px 26px -10px rgba(91,91,255,.7);
            transition: transform .12s, box-shadow .12s, filter .12s;
            display: inline-flex; align-items: center; justify-content: center; gap: 9px;
        }
        .btn-activate:hover { transform: translateY(-1px); filter: brightness(1.04); }
        .btn-activate:active { transform: translateY(0); }
        .btn-activate svg { width: 17px; height: 17px; }

        .gate-foot {
            text-align: center; margin: 14px 0 0;
            color: rgba(255,255,255,.55); font-size: 12px; letter-spacing: .04em;
        }
        .gate-foot strong { color: rgba(255,255,255,.8); font-weight: 600; }

        @media (max-width: 420px) {
            .gate-body { padding: 32px 22px 26px; }
            .gate-title { font-size: 22px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .gate-beam, .chip .dot.pulse { animation: none; }
        }
    </style>
    @stack('head')
</head>
<body>
    <div class="gate-bg"><div class="gate-beam"></div></div>

    <div class="gate-shell">
        <div class="gate-card">
            <div class="gate-rail"></div>
            <div class="gate-body">
                @yield('content')
            </div>
        </div>
        <p class="gate-foot"><strong>{{ config('app.name', 'Application') }}</strong> · Secure License Gateway</p>
    </div>

    @stack('scripts')
</body>
</html>
