<?php
$urlweb = "https://qblstore.com;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Rekening</title>
    <meta name="description" content="QBLStore meneyediakan tools agar dapat melihat rekening mengurangi indikasi penipuan">
    <meta name="keywords" content="cekrekening, cek rekening, cek ewallet, cek e-wallet, cek namabank, cek nama ewallet">
    <meta property="og:title" content="Cek Rekening - Top Up Sekarang di QBL Store!"/>
    <meta property="og:description" content="QBLStore meneyediakan tools agar dapat melihat rekening mengurangi indikasi penipuan" />
    <meta property="og:url" content="https://qblstore.com/cekrekening/" />
    <meta property="og:image" content="<?php echo $urlweb; ?>/upload/QBLStore-Blog-3.webp"/>
    <meta property="og:type" content="article" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@QBLStore">
    <meta name="twitter:creator" content="@QBLStore">
    <meta name="twitter:title" content="Cek Rekening - Top Up Sekarang di QBL Store!" />
    <meta name="twitter:description" content="QBLStore meneyediakan tools agar dapat melihat rekening mengurangi indikasi penipuan" />
    <meta name="twitter:image" content="<?php echo $urlweb; ?>/upload/QBLStore-Blog-3.webp" />
    <meta name="resource-type" content="document" />
    <meta http-equiv="content-language" content="id" />
    <meta name="author" content="IqbalMind" />
    <meta name="contact" content="qblstore.com" />
    <meta name="copyright" content="Copyright (c) qblstore.com. All Rights Reserved." />
    <meta name="robots" content="index">
    <meta name="theme-color" content="#00008B" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $urlweb; ?>/assets/apple-touch-icon.png">
    <link rel="icon" sizes="192x192" href="<?php echo $urlweb; ?>/assets/android-chrome-192x192.png">
    <link rel="icon" sizes="512x512" href="<?php echo $urlweb; ?>/assets/android-chrome-512x512.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .credit {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 14px;
            color: #555;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .credit a {
            color: #007bff;
            text-decoration: none;
        }

        .credit a:hover {
            color: #007b88;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="background-color: #F5F7F8; min-height: 100vh; padding-top: 50px;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center">Cek Rekening Bank / E-Wallet</h5>
                <form id="formCekRekening" class="mt-4">
                    <div class="form-group">
                        <label for="jenisAkun">Pilih Jenis Akun</label>
                        <select id="jenisAkun" class="form-control" required>
                            <option value="">Pilih Jenis</option>
                            <option value="bank">Bank</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaBank">Pilih Bank/E-Wallet</label>
                        <select id="namaBank" class="form-control" required>
                            <option value="">Pilih Bank / E-Wallet</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="accountNumber">Nomor Rekening</label>
                        <input type="text" id="accountNumber" class="form-control" placeholder="Masukkan Nomor Rekening" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cek Rekening</button>
                </form>
                <div id="result" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>

<div class="credit">
    Thanks to <a href="https://github.com/pilarxyz/cek-rekening" target="_blank">Pilarxyz</a>
</div>

<script>
// Load data bank or e-wallet with SweetAlert loading indicator
$('#jenisAkun').change(function() {
    let jenis = $(this).val();
    $('#namaBank').empty().append('<option value="">Pilih Bank / E-Wallet</option>');

    let url = jenis === 'bank' ? 
              'https://api-rekening.lfourr.com/listBank' : 
              'https://api-rekening.lfourr.com/listEwallet';

    // Show SweetAlert loading
    Swal.fire({
        title: 'Loading...',
        text: 'Memuat data Bank/E-Wallet.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.getJSON(`https://qblstore.com/proxy.php?url=${encodeURIComponent(url)}`, function(response) {
        Swal.close(); // Close the loading indicator
        if (response.status) {
            $.each(response.data, function(i, item) {
                $('#namaBank').append(`<option value="${item.kodeBank}">${item.namaBank}</option>`);
            });
            Swal.fire({
                icon: 'success',
                title: 'Data Loaded',
                text: 'Bank/E-Wallet options loaded successfully.',
                timer: 500,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed to Load Data',
                text: 'Data tidak dapat dimuat. Silakan coba lagi.',
            });
        }
    }).fail(function() {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan dalam memproses permintaan.',
        });
    });
});

// Check bank or e-wallet account with SweetAlert for feedback
$('#formCekRekening').submit(function(e) {
    e.preventDefault();

    let jenisAkun = $('#jenisAkun').val();
    let bankCode = $('#namaBank').val();
    let accountNumber = $('#accountNumber').val();
    let url = jenisAkun === 'bank' ? 
              `https://api-rekening.lfourr.com/getBankAccount?bankCode=${bankCode}&accountNumber=${accountNumber}` : 
              `https://api-rekening.lfourr.com/getEwalletAccount?bankCode=${bankCode}&accountNumber=${accountNumber}`;

    // Show SweetAlert loading
    Swal.fire({
        title: 'Checking...',
        text: 'Memeriksa nomor rekening...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.getJSON(`https://qblstore.com/proxy.php?url=${encodeURIComponent(url)}`, function(response) {
        Swal.close(); // Close the loading indicator
        if (response.status) {
            Swal.fire({
                icon: 'success',
                title: 'Data ditemukan!',
                html: `<strong>Nama Pemilik:</strong> ${response.data.accountname}<br>
                       <strong>Nomor Rekening:</strong> ${response.data.accountnumber}`
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Valid',
                text: 'Data rekening tidak valid atau tidak ditemukan.'
            });
        }
    }).fail(function() {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan dalam memproses permintaan.'
        });
    });
});
</script>
</body>
</html>
