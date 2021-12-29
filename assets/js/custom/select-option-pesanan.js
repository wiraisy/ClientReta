$(document).ready(function() {

    $('#selectPesananSebelum').change(function() {
        // Get value selected option
        var id_item = $(this).val();

        getProductResult(id_item);

        function getProductResult(selected_opt) {
            // Append Element List Pesanan
            var listPesanan = $(`<div class="row align-items-center bg-secondary mt-2" id="${selected_opt}"><div class="col-md-4"><h5>Loose Powder</h5></div><div class="col-md-2"><input type="number" class="form-control-sm text-center" /></div><div class="col-md-3"><h5 style="text-align: right;">Rp. XXXXXXX</h5></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${id_item}" class="fa fa-trash btn-remove" ></i></div></div></div>`);

            $('.list-pesanan').append(listPesanan);

            $('#selectPesananSebelum option[value=' + selected_opt + ']').prop('disabled', true);

            $("#selectPesananSebelum").prop('selectedIndex', 0);

            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`#${selected_opt}`).remove();
                $(`#selectPesananSebelum option[value='${selected_opt}']`).removeAttr("disabled");
                $("#selectPesananSebelum").prop('selectedIndex', 0);
            }
        };

    });

});