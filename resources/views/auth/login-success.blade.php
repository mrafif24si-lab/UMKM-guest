<!DOCTYPE html>
<html>
<head>
    <title>Login Berhasil - UMKM Desa</title>
    <style>
        body { 
            font-family: Arial; 
            background-color: #fff8f0; 
            margin: 0; 
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .success-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .success-header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: left;
        }
        .user-info p {
            margin: 8px 0;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        .btn-primary {
            background: orange;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-primary:hover {
            background: #e65c00;
        }
        .btn-secondary:hover {
            background: #545b62;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <h2>Login Berhasil!</h2>
        </div>
        
        <div style="font-size: 18px; margin-bottom: 20px;">
            <p><strong>Selamat, anda sudah berhasil login!!</strong></p>
            <p>Silahkan belanja sekarang.</p>
        </div>

        <div class="user-info">
            <h3>Informasi Login:</h3>
            <p><strong>Username:</strong> {{ $username }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <div class="button-group">
            <a href="{{ route('Auth.index') }}" class="btn btn-secondary">Kembali ke Login</a>
            <a href="{{ route('home') }}" class="btn btn-primary">Dashboard Utama</a>
        </div>
    </div>
</body>
</html>