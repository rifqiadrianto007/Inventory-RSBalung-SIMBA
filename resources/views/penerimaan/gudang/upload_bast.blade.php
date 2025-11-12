<h2>Upload BAST - Admin Gudang</h2>

<div style="max-width: 700px; margin: 40px auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; background: #f9f9f9;">
    <h2 style="text-align: center;">Upload BAST Final</h2>
    <p style="text-align: center;">Unggah file BAST yang telah ditandatangani.</p>

    <hr>

    <form action="{{ route('gudang.penerimaan.storeFinal', $penerimaan->id_penerimaan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="file_bast"><b>File BAST (PDF)</b></label><br>
            <input type="file" name="file_bast" accept="application/pdf" required style="width:100%; padding:8px;">
        </div>

        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 5px;">
            Upload BAST Final
        </button>

        <a href="{{ route('gudang.penerimaan.index') }}" style="margin-left: 10px;">Batal</a>
    </form>
</div>
