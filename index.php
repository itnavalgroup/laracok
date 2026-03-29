<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Dalam Perbaikan</title>
    <style>
        body { 
            text-align: center; 
            padding: 50px; 
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; 
            background-color: #f8f9fa; 
            color: #333; 
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            margin: 0;
        }
        h1 { 
            font-size: 2.5rem; 
            color: #d9534f; 
            margin-bottom: 15px; 
        }
        p { 
            font-size: 1.1rem; 
            color: #555; 
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .container { 
            max-width: 600px; 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 10px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
        }
        .icon { 
            font-size: 4rem; 
            margin-bottom: 20px; 
            animation: rotate 4s linear infinite;
            display: inline-block;
        }
        @keyframes rotate {
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⚙️</div>
        <h1>Server Sedang Maintenance</h1>
        <p>Mohon maaf atas ketidaknyamanannya. Saat ini sistem sedang dalam masa pemeliharaan (maintenance) karena adanya proses <strong>pemadanan data</strong>.</p>
        <p>Sistem akan kembali dapat diakses segera setelah proses ini selesai. Terima kasih atas pengertian dan kesabaran Anda!</p>
    </div>
</body>
</html>