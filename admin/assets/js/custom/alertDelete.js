$(".deleteAlert").on("click", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        title: "Are you sure you want to delete?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});

$(".deletePesanan").on("click", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        title: "Batalkan pesanan ?",
        text: "Pesanan yang terhapus tidak akan diproses dan terhapus dari database server.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});

$(".valdasiPesanan").on("click", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        title: "Validasi pesanan ?",
        text: "Check kembali bukti pembayaran sebelum melakukan validasi.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Validasi!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});