<div class="section">
    <div class="container">
        <div style="text-align: center;">
            <?php if ($databukti == true) { ?>
                <h3 class="display-4 mb-0">Mohon tunggu validasi bukti pembayaran anda oleh admin.</h3>
            <?php } else { ?>
            <h3 class="display-4 mb-0">Transaksi anda telah kadaluarsa.</h3>
            <?php } ?>
            <img class="img-fluid" src="<?= base_url() ?>assets/oops.jpg" alt="" style="width: 50%;">
        </div>
    </div>
</div>
