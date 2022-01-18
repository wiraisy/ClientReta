$(document).ready(function() {
    // $('#selectPesananSebelum').change(function() {
    //     // Get value selected option
    //     var id_item = $(this).val();
    //     var selectedOption = document.getElementsByClassName(`${id_item}`);

    //     if (selectedOption.length == 0) {
    //         getProductResult(id_item);
    //     } else {
    //         var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
    //         document.getElementById(`qty-${id_item}`).value = new_qty;
    //         $("#selectPesananSebelum").prop('selectedIndex', 0);
    //     }

    //     function getProductResult(selected_opt) {
    //         // Append Element List Pesanan
    //         var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Sebelumnya</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

    //         $('.list-pesanan').append(listPesanan);

    //         $("#selectPesananSebelum").prop('selectedIndex', 0);


    //         document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
    //             $(`.${selected_opt}`).remove();
    //             $("#selectPesananSebelum").prop('selectedIndex', 0);
    //         }
    //     };
    // });

    // $('#selectPesananUmum').change(function() {
    //     // Get value selected option
    //     var id_item = $(this).val();
    //     var selectedOption = document.getElementsByClassName(`${id_item}`);

    //     if (selectedOption.length == 0) {
    //         getProductResult(id_item);
    //     } else {
    //         var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
    //         document.getElementById(`qty-${id_item}`).value = new_qty;
    //         $("#selectPesananUmum").prop('selectedIndex', 0);
    //     }

    //     function getProductResult(selected_opt) {
    //         // Append Element List Pesanan
    //         var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Umum</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

    //         $('.list-pesanan').append(listPesanan);

    //         $("#selectPesananUmum").prop('selectedIndex', 0);


    //         document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
    //             $(`.${selected_opt}`).remove();
    //             $("#selectPesananUmum").prop('selectedIndex', 0);
    //         }
    //     };
    // });


    // $('#selectPesananAndalan').change(function() {
    //     // Get value selected option
    //     var id_item = $(this).val();
    //     var selectedOption = document.getElementsByClassName(`${id_item}`);

    //     if (selectedOption.length == 0) {
    //         getProductResult(id_item);
    //     } else {
    //         var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
    //         document.getElementById(`qty-${id_item}`).value = new_qty;
    //         $("#selectPesananAndalan").prop('selectedIndex', 0);
    //     }

    //     function getProductResult(selected_opt) {
    //         // Append Element List Pesanan
    //         var listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Andalan</h5><input type="hidden" value="Loose Powder" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${selected_opt}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. 250.000</h5><input type="hidden" value="250000" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${selected_opt}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);

    //         $('.list-pesanan').append(listPesanan);

    //         $("#selectPesananAndalan").prop('selectedIndex', 0);


    //         document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
    //             $(`.${selected_opt}`).remove();
    //             $("#selectPesananAndalan").prop('selectedIndex', 0);
    //         }
    //     };
    // });
});

// Still Bug
// $('#selectPesananUmum').change(function() {
//     // Get value selected option
//     var id_item = $(this).val();
//     var selectedOption = document.getElementsByClassName(`${id_item}`);

//     // Get Data From API
//     // fetch
//     // var myHeaders = new Headers();
//     // myHeaders.append("Access-Control-Request-Headers", "Origin");
//     // myHeaders.append("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");

//     // var requestOptions = {
//     //     method: 'GET',
//     //     headers: myHeaders,
//     //     redirect: 'follow'
//     // };

//     // fetch("http://202.157.184.70:8080/reta-api/Produk/GetProdukbyId/10", requestOptions)
//     //     .then(response => response.text())
//     //     .then(result => console.log(result))
//     //     .catch(error => console.log('error', error));

//     // Ajax 1
//     // var getdata = {
//     //     "url": "http://202.157.184.70:8080/reta-api/Produk/GetProdukbyId/" + id_item,
//     //     "method": "GET",
//     //     "mode": "no-cors",
//     //     "timeout": 0,
//     //     "headers": {
//     //         "Accept": "application/json",
//     //         "Access-Control-Allow-Origin": "*",
//     //         "Access-Control-Allow-Methods": "*",
//     //         "Access-Control-Allow-Credentials": true,
//     //         "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
//     //     }
//     // };

//     // $.ajax(getdata).done(function(response) {
//     //     var res = JSON.parse(response);
//     //     console.log(response);

//     //     if (selectedOption.length == 0) {
//     //         // Append Element List Pesanan
//     //         var listPesanan = $(`<div class="form-group ${res.content.idproduk}"><div class="row align-items-center bg-secondary mt-2"><div class="col-md-4"><h5>Produk Umum</h5><input type="hidden" value="${res.content.namabarang}" name="nama_product[]"/></div><div class="col-md-2"><input type="number" id="qty-${res.content.idproduk}" class="form-control text-center" value="0" style="width: 100px;"/></div><div class="col-md-3"><h5 style="text-align: right;">Rp. ${res.content.hargajual}</h5><input type="hidden" value="${res.content.hargajual}" name="harga_product[]"/></div><div class="col-md-3"><div style="text-align: right;"><i id="remove-${res.content.idproduk}" class="fa fa-trash btn-remove" ></i></div></div></div></div>`);
//     //         $('.list-pesanan').append(listPesanan);
//     //         $("#selectPesananUmum").prop('selectedIndex', 0);

//     //         document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
//     //             $(`.${selected_opt}`).remove();
//     //             $("#selectPesananUmum").prop('selectedIndex', 0);
//     //         }
//     //     } else {
//     //         var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
//     //         document.getElementById(`qty-${id_item}`).value = new_qty;
//     //         $("#selectPesananUmum").prop('selectedIndex', 0);
//     //     }
//     // });

// });