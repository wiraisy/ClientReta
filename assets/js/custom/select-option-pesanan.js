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

    $('#selectPesananUmum').change(function() {
        // Get value selected option
        let id_item = $(this).val();
        let selectedOption = document.getElementsByClassName(`${id_item}`);
        var custid_user = $('select[name="selectPesananUmum"] :selected').attr('class');

        let settingsdetail = {
            "url": "https://api-reta.id/reta-api/Produk/GetProdukbykodeid/" + id_item,
            "method": "GET",
            "timeout": 0,
            "async": false,
            "headers": {
                "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
            },
        };

        let produkdetail = $.ajax(settingsdetail).done(function(responsedetail) {
            return responsedetail;
        }).responseJSON;

        if (selectedOption.length == 0) {
            getProductResult(id_item, produkdetail);
        } else {
            var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
            document.getElementById(`qty-${id_item}`).value = new_qty;
            $("#selectPesananUmum").prop('selectedIndex', 0);
        }


        function getProductResult(selected_opt, produkdetail) {
            var harga = formatRupiah(produkdetail.hargajual, 'Rp. ');

            // Append Element List Pesanan
            let listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2 py-4"><div class="col-md-4 product-img text-center"><img id="img-${selected_opt}" class="rounded  "></div><div class="col-md-8 product-detail"><h4><strong>${produkdetail.namabarang}</strong></h4><h5>Harga : ${harga}</h5><div class="number my-4"><span class="counter-minus minus-${selected_opt} counter">-</span><input class="mx-2" id="qty-${selected_opt}" type="number" value="1"/><span class="counter-plus plus-${selected_opt} counter">+</span></div><button type="button" class="btn btn-success btn-sm mt-1" id="addToCart-${selected_opt}"><i class="fa fa-cart-plus" style="color: green;"></i><span> Add to Cart</span></button><button type="button" class="btn btn-danger btn-sm mt-1" id="remove-${selected_opt}"><i class="fa fa-trash"></i><span> Remove From List</span></button></div></div></div>`);

            // Format Rupiah
            function formatRupiah(angka, prefix) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // Get Image Produk
            var xhr = new XMLHttpRequest();
            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                    var res = this.response;
                    var url = URL.createObjectURL(res);
                    const img = document.getElementById(`img-${selected_opt}`);
                    img.src = url;
                }
            });
            xhr.open("GET", "https://api-reta.id/reta-api/Produk/getImagebykodeid/" + selected_opt);
            xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");
            xhr.responseType = 'blob';
            xhr.send();

            $('.list-pesanan').prepend(listPesanan);

            $("#selectPesananUmum").prop('selectedIndex', 0);

            $(`#addToCart-${selected_opt}`).click(function() {
                var kodeid = produkdetail.kodeid;
                var custid = custid_user;
                // API Add to Cart
                let settingsadd = {
                    "url": "https://api-reta.id/reta-api/Penjualan/adddetailtocart",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json",
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    },
                    "data": JSON.stringify({
                        "custid": custid,
                        "jumlah": parseInt(document.getElementById(`qty-${selected_opt}`).value),
                        "kodeid": kodeid
                    }),
                };
                $.ajax(settingsadd).done(function() {
                    return false;
                });

                alert("Produk dimasukkan ke dalam keranjang.");

                var settingscart = {
                    "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/" + custid,
                    "method": "GET",
                    "timeout": 0,
                    "async": false,
                    "headers": {
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    },
                };

                var datacart = $.ajax(settingscart).done(function(response) {
                    return response;
                }).responseJSON;

                console.log(datacart.length);

                document.getElementById('cartProduct').dataset.count = parseInt(datacart.length);

                return false;
            });


            $(`.minus-${selected_opt}`).click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });

            $(`.plus-${selected_opt}`).click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });

            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`.${selected_opt}`).remove();
                $("#selectPesananUmum").prop('selectedIndex', 0);
                alert("Produk berhasil dihapus dari keranjang.");
            }
        };
    });


    $('#selectPesananAndalan').change(function() {
        // Get value selected option
        let id_item = $(this).val();
        let selectedOption = document.getElementsByClassName(`${id_item}`);
        var custid_user = $('select[name="selectPesananAndalan"] :selected').attr('class');

        let settingsdetail = {
            "url": "https://api-reta.id/reta-api/Produk/GetProdukbykodeid/" + id_item,
            "method": "GET",
            "timeout": 0,
            "async": false,
            "headers": {
                "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
            },
        };

        let produkdetail = $.ajax(settingsdetail).done(function(responsedetail) {
            return responsedetail;
        }).responseJSON;


        if (selectedOption.length == 0) {
            getProductResult(id_item, produkdetail);
        } else {
            var new_qty = parseInt(document.getElementById(`qty-${id_item}`).value) + 1;
            document.getElementById(`qty-${id_item}`).value = new_qty;
            $("#selectPesananAndalan").prop('selectedIndex', 0);
        }


        function getProductResult(selected_opt, produkdetail) {
            var harga = formatRupiah(produkdetail.hargajual, 'Rp. ');

            // Append Element List Pesanan
            let listPesanan = $(`<div class="form-group ${selected_opt}"><div class="row align-items-center bg-secondary mt-2 py-4"><div class="col-md-4 product-img text-center"><img id="img-${selected_opt}" class="rounded  "></div><div class="col-md-8 product-detail"><h4><strong>${produkdetail.namabarang}</strong></h4><h5>Harga : ${harga}</h5><div class="number my-4"><span class="counter-minus minus-${selected_opt} counter">-</span><input class="mx-2" id="qty-${selected_opt}" type="number" value="1"/><span class="counter-plus plus-${selected_opt} counter">+</span></div><button type="button" id="addToCart-${selected_opt}" class="btn btn-success btn-sm mt-1"><i class="fa fa-cart-plus" style="color: green;"></i><span> Add to Cart</span></button><button type="button" class="btn btn-danger btn-sm mt-1" id="remove-${selected_opt}"><i class="fa fa-trash"></i><span> Remove From List</span></button></div></div></div>`);

            // Format Rupiah
            function formatRupiah(angka, prefix) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // Get Image Produk
            var xhr = new XMLHttpRequest();
            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                    var res = this.response;
                    var url = URL.createObjectURL(res);
                    const img = document.getElementById(`img-${selected_opt}`);
                    img.src = url;
                }
            });
            xhr.open("GET", "https://api-reta.id/reta-api/Produk/getImagebykodeid/" + selected_opt);
            xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");
            xhr.responseType = 'blob';
            xhr.send();

            $('.list-pesanan').prepend(listPesanan);

            $("#selectPesananAndalan").prop('selectedIndex', 0);

            $(`#addToCart-${selected_opt}`).click(function() {
                var kodeid = produkdetail.kodeid;
                var custid = custid_user;
                // API Add to Cart
                let settingsadd = {
                    "url": "https://api-reta.id/reta-api/Penjualan/adddetailtocart",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json",
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    },
                    "data": JSON.stringify({
                        "custid": custid,
                        "jumlah": parseInt(document.getElementById(`qty-${selected_opt}`).value),
                        "kodeid": kodeid
                    }),
                };
                $.ajax(settingsadd).done(function() {
                    return false;
                });

                alert("Produk dimasukkan ke dalam keranjang.");

                var settingscart = {
                    "url": "https://api-reta.id/reta-api/Penjualan/lihatcart/" + custid,
                    "method": "GET",
                    "timeout": 0,
                    "async": false,
                    "headers": {
                        "Authorization": "Basic YWtiYXI6d2lyYWlzeQ=="
                    },
                };

                var datacart = $.ajax(settingscart).done(function(response) {
                    return response;
                }).responseJSON;

                document.getElementById('cartProduct').dataset.count = parseInt(datacart.length);

                return false;
            });

            $(`.minus-${selected_opt}`).click(function() {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });

            $(`.plus-${selected_opt}`).click(function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });

            document.getElementById(`remove-${selected_opt}`).onclick = function(e) {
                $(`.${selected_opt}`).remove();
                $("#selectPesananAndalan").prop('selectedIndex', 0);
            }
        };
    });

});