$(document).ready(function() {
    $('#selectPesananSebelum').change(function() {
        // Get value selected option
        var id_item = $(this).val();
        var selectedOption = document.getElementsByClassName(`${id_item}`);

        if (selectedOption.length == 0) {
            getProductResult(id_item);
        } else {
            var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
            document.getElementById(`qty-${id_item}`).value = new_qty;
            $("#selectPesananSebelum").prop('selectedIndex', 0);
        }

        function getProductResult(selected_opt) {
            // Append Element List Pesanan
            var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Sebelumnya</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

            $('.list-pesanan').append(listPesanan);

            $("#selectPesananSebelum").prop('selectedIndex', 0);


            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`.${selected_opt}`).remove();
                $("#selectPesananSebelum").prop('selectedIndex', 0);
            }
        };
    });

    $('#selectPesananUmum').change(function() {
        // Get value selected option
        var id_item = $(this).val();
        var selectedOption = document.getElementsByClassName(`${id_item}`);

        if (selectedOption.length == 0) {
            getProductResult(id_item);
        } else {
            var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
            document.getElementById(`qty-${id_item}`).value = new_qty;
            $("#selectPesananUmum").prop('selectedIndex', 0);
        }

        function getProductResult(selected_opt) {
            // Append Element List Pesanan
            var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Umum</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

            $('.list-pesanan').append(listPesanan);

            $("#selectPesananUmum").prop('selectedIndex', 0);


            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`.${selected_opt}`).remove();
                $("#selectPesananUmum").prop('selectedIndex', 0);
            }
        };
    });

    $('#selectPesananAndalan').change(function() {
        // Get value selected option
        var id_item = $(this).val();
        var selectedOption = document.getElementsByClassName(`${id_item}`);

        if (selectedOption.length == 0) {
            getProductResult(id_item);
        } else {
            var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
            document.getElementById(`qty-${id_item}`).value = new_qty;
            $("#selectPesananAndalan").prop('selectedIndex', 0);
        }

        function getProductResult(selected_opt) {
            // Append Element List Pesanan
            var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Andalan</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

            $('.list-pesanan').append(listPesanan);

            $("#selectPesananAndalan").prop('selectedIndex', 0);


            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`.${selected_opt}`).remove();
                $("#selectPesananAndalan").prop('selectedIndex', 0);
            }
        };
    });
});