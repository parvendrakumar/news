<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Story Not Found | City News</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary: #dc2626;
            --primary-dark: #991b1b;
            --bg-start: #0f172a;
            --bg-end: #020617;
            --text-main: #f8fafc;
            --text-dim: #94a3b8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-start) 0%, var(--bg-end) 100%);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        /* Ambient Glow */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.15) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
        }

        .error-code {
            font-size: clamp(8rem, 20vw, 12rem);
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(to bottom, #fff 30%, var(--text-dim) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -5px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5));
            position: relative;
        }

        .error-code::after {
            content: '404';
            position: absolute;
            left: 2px;
            top: 2px;
            z-index: -1;
            color: var(--primary);
            -webkit-text-fill-color: var(--primary);
            opacity: 0.5;
            filter: blur(8px);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        p {
            font-size: 1.1rem;
            color: var(--text-dim);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        @media (min-width: 480px) {
            .actions { flex-direction: row; justify-content: center; }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.4);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -10px rgba(220, 38, 38, 0.6);
        }

        .btn-outline {
            border: 2px solid rgba(148, 163, 184, 0.2);
            color: var(--text-main);
        }

        .btn-outline:hover {
            background: rgba(148, 163, 184, 0.1);
            border-color: var(--text-main);
            transform: translateY(-3px);
        }

        /* Decorative Elements */
        .decor {
            position: absolute;
            font-size: 0.7rem;
            font-weight: 900;
            color: var(--primary);
            opacity: 0.3;
            text-transform: uppercase;
            letter-spacing: 5px;
            white-space: nowrap;
        }

        .decor-top { top: 10%; left: 50%; transform: translateX(-50%); }
        .decor-bottom { bottom: 10%; left: 50%; transform: translateX(-50%); }

        /* News Ticker Style Animation */
        @keyframes shine {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(200%) skewX(-15deg); }
        }

        .btn-primary { position: relative; overflow: hidden; }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 30%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
            transform: skewX(-15deg);
            animation: shine 3s infinite;
        }
    </style>
</head>
<body>
    <div class="glow"></div>
    
    <div class="decor decor-top">Breaking News: Page Lost in Transmition</div>

    <div class="container">
        <div class="error-code">404</div>
        <h1>Headline Missing</h1>
        <p>
            The story you are looking for has been archived or moved to a different beat. 
            Don't worry, our reporters are still on the ground.
        </p>

        <div class="actions">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i> Back to Front Page
            </a>
            <a href="javascript:history.back()" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Previous Story
            </a>
        </div>
    </div>

    <div class="decor decor-bottom">© City News Portal - All Rights Reserved</div>
</body>
</html>
