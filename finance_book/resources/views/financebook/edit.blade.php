<!DOCTYPE html>
<html>
<head>
    <title>Edit Catatan: {{ $note->id }}</title>
   <style>
    body { font-family: Arial, sans-serif; margin: 20px; max-width: 600px; }
    .form-group { margin-bottom: 15px; }
    
    label { 
        display: block; 
        margin-bottom: 5px; 
        font-weight: bold; 
        color: #004085; 
    }
    

    input[type="text"], input[type="date"], input[type="number"], select, textarea { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #b8daff; 
        border-radius: 4px; 
        box-sizing: border-box; 
    }
    
    .btn { padding: 12px 20px; margin: 5px; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; }
    
    .btn-primary { background-color: #007bff; color: white; }
    

    .btn-secondary { 
        background-color: #87CEEB;
        color: #000; 
    }
    
    .btn-success { 
        background-color: #0dcaf0; 
        color: #000; 
    }
    

    .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
    .alert { padding: 15px; margin: 10px 0; border-radius: 4px; }
    

    .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    
    .info-box { background-color: #e3f2fd; padding: 15px; border-radius: 4px; border-left: 4px solid #2196f3; }
</style>
</head>
<body>
    <h1>✏️ Edit Catatan Keuangan</h1>
    
    <div class="info-box">
        <strong>📝 Sedang mengedit catatan ID:</strong> {{ $note->id }}
        <br>
        <small>({{ $note->description ?? 'Tanpa Keterangan' }})</small>
    </div>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>❌ Terjadi kesalahan:</strong>
            <ul style="margin: 10px 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('financebook.update', $note->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="date">🗓️ Tanggal Transaksi:</label>
            <input type="date" 
                   id="date" 
                   name="date" 
                   value="{{ old('date', $note->date) }}" required>
            @error('date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="amount">💰 Jumlah (Rp):</label>
            <input type="number" 
                   id="amount" 
                   name="amount" 
                   value="{{ old('amount', $note->amount) }}" placeholder="Contoh: 50000"
                   required>
            @error('amount')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="type">📊 Tipe Transaksi:</label>
            <select id="type" name="type" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="income" 
                    {{ old('type', $note->type) == 'income' ? 'selected' : '' }}>
                    Pemasukan (Income)
                </option>
                <option value="expense" 
                    {{ old('type', $note->type) == 'expense' ? 'selected' : '' }}>
                    Pengeluaran (Expense)
                </option>
            </select>
            @error('type')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">📑 Keterangan (Opsional):</label>
            <textarea id="description" 
                      name="description" 
                      rows="4"
                      placeholder="Contoh: Beli kopi susu">{{ old('description', $note->description) }}</textarea> @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">
                💾 Update Catatan
            </button>
            
            <a href="{{ route('financebook.show', $note->id) }}" class="btn btn-success">
                👁️ Lihat Detail
            </a>
            
            <a href="{{ route('financebook.index') }}" class="btn btn-secondary">
                ↩️ Batal
            </a>
        </div>
    </form>
    
    <div style="margin-top: 30px; padding: 15px; background-color: #f8f9fa; border-radius: 4px;">
        <h3>📋 Informasi Asli</h3>
        <p><strong>ID:</strong> {{ $note->id }}</p>
        <p><strong>Jumlah Asli:</strong> Rp {{ number_format($note->amount, 0, ',', '.') }}</p>
        <p><strong>Dibuat:</strong> {{ $note->created_at->format('d M Y') }}</p>
    </div>
</body>
</html>