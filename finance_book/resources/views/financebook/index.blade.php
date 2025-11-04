<!DOCTYPE html>
<html>
<head>
    <title>Daftar Catatan Keuangan</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
        }
        
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        
        th { 
            background-color: #0d47a1; 
            color: white; 
        }
    
        .btn { 
            padding: 8px 12px; 
            margin: 2px; 
            text-decoration: none; 
            border-radius: 4px; 
            border: none;
            cursor: pointer;
        }
        
        .btn-primary { 
            background-color: #007bff;
            color: white; 
        }
        
        .btn-success { 
            background-color: #0dcaf0; 
            color: #000; 
        }
       
        .btn-warning { 
            background-color: #87CEEB; 
            color: #000; 
        }
    
        .btn-danger { 
            background-color: #000080; 
            color: white; 
        }
        
        .alert { 
            padding: 15px; 
            margin: 10px 0; 
            border-radius: 4px; 
        }
    
        .alert-success { 
            background-color: #cce5ff;
            color: #004085; 
            border: 1px solid #b8daff; 
        }
     
        .search-form { 
            margin: 15px 0; 
            display: flex; 
        }
        .search-form input[type="text"] { 
            flex: 1; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 4px 0 0 4px; 
        }
        
        .search-form button { 
            padding: 10px 15px; 
            border: none; 
            background-color: #007bff; 
            color: white; 
            cursor: pointer; 
            border-radius: 0 4px 4px 0; 
        }
    </style>
</head>
<body>
   <h1>📚 Daftar Catatan Keuangan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('financebook.create') }}" class="btn btn-primary">
            ➕ Tambah Catatan Baru
        </a>
        
        <form action="{{ route('financebook.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Cari di keterangan..." value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>
    </div>
    <table>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Uang</th>
                <th>Tipe Transaksi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notes as $note) 
            <tr>
                <td>{{ $note->id }}</td>
                <td>{{ \Carbon\Carbon::parse($note->date)->format('d M Y') }}</td>
                
                <td class="{{ $note->type == 'income' ? 'income' : 'expense' }}">
                    {{ $note->type == 'income' ? '+' : ' ' }} 
                    Rp {{ number_format($note->amount, 0, ',', '.') }}
                </td>
                <td>
                    {{ $note->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                </td>
                
                <td>{{ $note->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('financebook.show', $note->id) }}" class="btn btn-success">
                        👁️ Lihat
                    </a>
                    <a href="{{ route('financebook.edit', $note->id) }}" class="btn btn-warning">
                        ✏️ Edit
                    </a>
                    
                    <form action="{{ route('financebook.destroy', $note->id) }}" 
                          method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Yakin ingin menghapus catatan ini?')">
                            🗑️ Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px;">
                    📝 Belum ada data keuangan. 
                    <a href="{{ route('financebook.create') }}">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top: 20px; color: #666;">
        Total: {{ $notes->count() }} catatan
    </p>
</body>
</html>
