<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your App Name</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4285F4;
            --primary-hover: #3367D6;
            --text: #202124;
            --text-light: #5F6368;
            --border: #DADCE0;
            --white: #FFFFFF;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            --shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8F9FA;
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            line-height: 1.5;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .logo {
            margin-bottom: 24px;
            font-size: 24px;
            font-weight: 600;
            color: var(--text);
        }

        .logo span {
            color: var(--primary);
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--text-light);
            margin-bottom: 32px;
            font-size: 15px;
        }

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 24px;
            background-color: var(--white);
            color: var(--text-light);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 24px;
        }

        .google-btn:hover {
            background-color: #F8F9FA;
            border-color: #C4C7CC;
        }

        .google-btn:active {
            background-color: #F1F3F4;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: var(--text-light);
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border);
        }

        .divider::before {
            margin-right: 16px;
        }

        .divider::after {
            margin-left: 16px;
        }

        .footer {
            margin-top: 32px;
            font-size: 13px;
            color: var(--text-light);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                border-radius: 0;
                min-height: 100vh;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Welcome back</h1>
        <p class="subtitle">Sign in to continue to your account</p>

        <a href="/auth/login" class="google-btn">
            <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
            </svg>
            Continue with Google
        </a>

        <div class="divider">or</div>

        <div class="footer">
            By continuing, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>
        </div>
    </div>
</body>

</html>