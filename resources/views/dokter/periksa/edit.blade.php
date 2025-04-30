@extends('layouts.app')

@section('title', 'Janji Temu')

@section('content')
<div class="container">
    <h4>Janji Temu dengan {{ $pasien->nama }}</h4>

    <form action="{{ route('periksa.simpan', $pasien->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Biaya Konsultasi</label>
            <input type="number" name="biaya_konsultasi" id="biaya_konsultasi" class="form-control" placeholder="Contoh: 50000" required>
        </div>
        <div class="form-group">
            <label>Obat (Pilih satu atau lebih)</label>
            <div class="obat-list" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                @foreach ($obatList as $obat)
                    <div class="form-check">
                        <input type="checkbox" name="obat_nama[]" id="obat_{{ $obat->id }}" class="form-check-input obat-checkbox" value="{{ $obat->nama_obat }}" data-harga="{{ $obat->harga }}">
                        <label class="form-check-label" for="obat_{{ $obat->id }}">
                            {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga) }}
                        </label>
                    </div>
                @endforeach
                @if($obatList->isEmpty())
                    <p>Tidak ada obat tersedia</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Total Harga</label>
            <input type="text" id="total_harga" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-success">Simpan Janji</button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script loaded'); // Debug: Confirm script execution

    // Get DOM elements
    const biayaKonsultasi = document.getElementById('biaya_konsultasi');
    const obatCheckboxes = document.querySelectorAll('.obat-checkbox');
    const totalHarga = document.getElementById('total_harga');

    // Check if elements are found
    console.log('Elements:', {
        biayaKonsultasi: !!biayaKonsultasi,
        obatCheckboxes: obatCheckboxes.length,
        totalHarga: !!totalHarga
    });

    // Function to update total price
    function updateTotal() {
        console.log('Updating total'); // Debug: Confirm function call
        let total = parseFloat(biayaKonsultasi.value) || 0;
        console.log('Biaya Konsultasi:', total); // Debug: Log consultation fee

        // Sum prices of all checked drugs
        let drugCost = 0;
        obatCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const harga = parseFloat(checkbox.dataset.harga) || 0;
                drugCost += harga;
                console.log('Drug:', { name: checkbox.value, harga }); // Debug: Log each drug
            }
        });
        total += drugCost;
        console.log('Drug Cost Total:', drugCost); // Debug: Log total drug cost

        totalHarga.value = 'Rp ' + total.toLocaleString('id-ID');
        console.log('Total Harga:', totalHarga.value); // Debug: Log final total
    }

    // Add event listeners
    if (biayaKonsultasi) {
        biayaKonsultasi.addEventListener('input', () => {
            console.log('Biaya Konsultasi changed:', biayaKonsultasi.value); // Debug
            updateTotal();
        });
    }
    obatCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            console.log('Obat changed:', checkbox.value, 'Checked:', checkbox.checked); // Debug
            updateTotal();
        });
    });

    // Initial calculation
    updateTotal();
});
</script>
@endpush
@endsection