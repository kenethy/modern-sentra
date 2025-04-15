<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Permintaan Penawaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
        }
        h1 {
            color: #99765c;
            margin-top: 0;
        }
        h2 {
            color: #99765c;
            margin-top: 20px;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #99765c;
            margin: 15px 0;
            padding: 10px;
            background-color: #f9f5f2;
            border-radius: 5px;
            display: inline-block;
        }
        .reason {
            background-color: #f9f5f2;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .button {
            display: inline-block;
            background-color: #99765c;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
        .contact-info {
            background-color: #f9f5f2;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #99765c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name', 'Modern Sentra') }}</h1>
        </div>
        
        <div class="content">
            <p>Halo {{ $quoteRequest->name }},</p>
            
            @if($quoteRequest->response_status == 'accepted')
                <h2>Permintaan Penawaran Anda Disetujui</h2>
                <p>Terima kasih atas permintaan penawaran Anda untuk {{ $quoteRequest->product ? $quoteRequest->product->name : 'produk kami' }}.</p>
                <p>Kami dengan senang hati memberitahukan bahwa permintaan Anda telah <strong>DISETUJUI</strong>.</p>
                
                @if($quoteRequest->quoted_price)
                    <div class="price">
                        Harga Penawaran: Rp {{ number_format($quoteRequest->quoted_price, 0, ',', '.') }}
                    </div>
                @endif
                
                @if($quoteRequest->response_message)
                    <p>{!! nl2br(e($quoteRequest->response_message)) !!}</p>
                @endif
                
                <p>Silakan hubungi kami untuk informasi lebih lanjut atau konfirmasi pemesanan.</p>
                
                <a href="{{ route('contact') }}" class="button">Hubungi Kami</a>
            
            @elseif($quoteRequest->response_status == 'rejected')
                <h2>Tanggapan Permintaan Penawaran</h2>
                <p>Terima kasih atas permintaan penawaran Anda untuk {{ $quoteRequest->product ? $quoteRequest->product->name : 'produk kami' }}.</p>
                <p>Dengan berat hati kami informasikan bahwa kami tidak dapat memenuhi permintaan Anda saat ini.</p>
                
                @if($quoteRequest->rejection_reason)
                    <div class="reason">
                        <strong>Alasan:</strong><br>
                        {!! nl2br(e($quoteRequest->rejection_reason)) !!}
                    </div>
                @endif
                
                @if($quoteRequest->response_message)
                    <p>{!! nl2br(e($quoteRequest->response_message)) !!}</p>
                @endif
                
                <p>Kami tetap berharap dapat melayani Anda di kesempatan lain.</p>
                
                <a href="{{ route('products.index') }}" class="button">Lihat Produk Lainnya</a>
            
            @elseif($quoteRequest->response_status == 'negotiation')
                <h2>Negosiasi Permintaan Penawaran</h2>
                <p>Terima kasih atas permintaan penawaran Anda untuk {{ $quoteRequest->product ? $quoteRequest->product->name : 'produk kami' }}.</p>
                <p>Kami ingin mendiskusikan lebih lanjut mengenai permintaan Anda.</p>
                
                @if($quoteRequest->quoted_price)
                    <div class="price">
                        Harga Penawaran Awal: Rp {{ number_format($quoteRequest->quoted_price, 0, ',', '.') }}
                    </div>
                @endif
                
                @if($quoteRequest->response_message)
                    <p>{!! nl2br(e($quoteRequest->response_message)) !!}</p>
                @endif
                
                <p>Mohon hubungi kami untuk negosiasi lebih lanjut.</p>
                
                <a href="{{ route('contact') }}" class="button">Hubungi Kami</a>
            
            @else
                <h2>Permintaan Penawaran Diterima</h2>
                <p>Terima kasih atas permintaan penawaran Anda untuk {{ $quoteRequest->product ? $quoteRequest->product->name : 'produk kami' }}.</p>
                <p>Tim kami sedang memproses permintaan Anda dan akan segera menghubungi Anda.</p>
                
                @if($quoteRequest->response_message)
                    <p>{!! nl2br(e($quoteRequest->response_message)) !!}</p>
                @endif
            @endif
            
            <div class="contact-info">
                <h3>Informasi Kontak</h3>
                <p>Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami:</p>
                <p>
                    <strong>Telepon:</strong> +62 812 3456 7890<br>
                    <strong>Email:</strong> info@modernsentra.com<br>
                    <strong>Alamat:</strong> Jl. Raya Sidoarjo No. 123, Sidoarjo
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Modern Sentra') }}. Semua hak dilindungi.</p>
            <div class="social-links">
                <a href="#">Facebook</a> | 
                <a href="#">Instagram</a> | 
                <a href="#">WhatsApp</a>
            </div>
        </div>
    </div>
</body>
</html>
