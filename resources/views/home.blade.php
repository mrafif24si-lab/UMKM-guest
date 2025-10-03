<!DOCTYPE html>
<html>
<head>
    <title>UMKM Desa</title>
    <style>
        body { 
            font-family: Arial; 
            background-color: #fff8f0; 
            margin: 0; 
            padding: 0; 
        }
        header { 
            background: orange; 
            color: white; 
            padding: 15px; 
            text-align: center; 
        }
        .container { 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 20px; 
        }
        .umkm-item, .produk-item { 
            background: white; 
            padding: 15px; 
            margin: 10px 0; 
            border-left: 4px solid orange; 
        }
        .produk-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 15px; 
        }
        button { 
            background: orange; 
            color: white; 
            border: none; 
            padding: 8px 15px; 
            cursor: pointer; 
        }
        footer { 
            background: #e65c00; 
            color: white; 
            text-align: center; 
            padding: 15px; 
            margin-top: 30px; 
        }
        /* Tambahkan style untuk nav */
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #ffeb3b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lapak UMKM Desa</h1>
        <nav>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="{{ route('Auth.index') }}">Login</a>
        </nav>
    </header>

    <div class="container">
        <h2>Selamat Datang di UMKM Desa</h2>
        <p>Dukung produk lokal desa kami</p>

        <h3>Daftar UMKM</h3>
        @foreach($umkm as $item)
        <div class="umkm-item">
            <strong>{{ $item['nama'] }}</strong> - {{ $item['produk'] }}
        </div>
        @endforeach

        <h3 id="produk">Produk Terbaru</h3>
        <div class="produk-grid">
            @foreach($produk as $item)
            <div class="produk-item">
                <strong>{{ $item['nama'] }}</strong><br>
                Rp {{ number_format($item['harga'], 0, ',', '.') }}<br>
                <button>Pesan Sekarang</button>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>