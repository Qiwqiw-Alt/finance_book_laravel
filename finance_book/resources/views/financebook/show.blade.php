<!DOCTYPE html>
<html>
<head>
    <title>Detail Catatan: {{ $note->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 800px; }
        
        .card { 
            border: 1px solid #b8daff; 
            border-radius: 8px; 
            padding: 20px; 
            margin: 20px 0; 
        }
    
        .card-header { 
            border-bottom: 1px solid #b8daff; 
            padding-bottom: 10px; 
            margin-bottom: 15px; 
        }
        
        .card-title { 
            font-size: 24px; 
            margin: 0; 
            color: #0d47a1;
        }
        
        .info-row { display: flex; margin: 10px 0; }
        .info-label { 
            font-weight: bold; 
            width: 150px; 
            color: #004085; 
        }
        .info-value { flex: 1; }
        
        .btn { 
            padding: 10px 15px; 
            margin: 5px; 
            text-decoration: none; 
            border-radius: 4px; 
            display: inline-block; 
            border: none;
            cursor: pointer;
        }
        
        .btn-warning { 
            background-color: #87CEEB; 
            color: #000; 
        }
      
        .btn-secondary { 
            background-color: #007bff; 
            color: white; 
        }
    
        .btn-danger { 
            background-color: #000080; 
            color: white; 
            font-family: Arial, sans-serif; 
            font-size: 14px;
        }
        
        .badge { 
            padding: 5px 10px; 
            border-radius: 12px; 
            font-size: 12px; 
            font-weight: bold; 
        }
        
        .badge-income { 
            background-color: #87CEEB;
            color: #000; 
        }
        
        .badge-expense { 
            background-color: #0d47a1; 
            color: white; 
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">💸 Detail Catatan Keuangan</h1>
        </div>
        
        <div class="info-row">
            <div class="info-label">🆔 ID Catatan:</div>
            <div class="info-value">{{ $note->id }}</div>
        </div>
        
        <div class="info-row">
            <div class="info-label">🗓️ Tanggal:</div>
            <div class="info-value">
                {{ \Carbon\Carbon::parse($note->date)->format('l, d F Y') }}
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">💰 Jumlah:</div>
            <div class="info-value" style="font-weight: bold; font-size: 1.1em;">
                Rp {{ number_format($note->amount, 0, ',', '.') }}
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">📊 Tipe:</div>
            <div class="info-value">
                @if($note->type == 'income')
                    <span class="badge badge-income">Pemasukan</span>
                @else
                    <span class="badge badge-expense">Pengeluaran</span>
                @endif
            </div>
        </div>
        
        <div class="info-row">
            <div class="info-label">📑 Keterangan:</div>
            <div class="info-value" style="white-space: pre-wrap;">{{ $note->description ?? '-' }}</div>
        </div>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">

        <div class="info-row">
            <div class="info-label">Dibuat pada:</div>
            <div class="info-value">{{ $note->created_at->format('d M Y, H:i:s') }}</div>
        </div>
         <div class="info-row">
            <div class="info-label">Diubah pada:</div>
            <div class="info-value">{{ $note->updated_at->format('d M Y, H:i:s') }}</div>
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('financebook.edit', $note->id) }}" class="btn btn-warning">
            ✏️ Edit Catatan
        </a>
        
        <a href="{{ route('financebook.index') }}" class="btn btn-secondary">
            ↩️ Kembali ke Daftar
        </a>
        
        <form action="{{ route('financebook.destroy', $note->id) }}" 
              method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Yakin ingin menghapus catatan ini?')">
                🗑️ Hapus Catatan
            </button>
        </form>
    </div>
    
</body>
</html>
