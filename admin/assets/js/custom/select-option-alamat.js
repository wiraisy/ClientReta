$(document).ready(function() {
    $('#selectProvinsi').change(function() {
        // Get value selected option
        let id_provinsi = $(this).val();
        var settings = {
            "url": "https://apiongkir.reta.co.id/api/country/id/" + id_provinsi,
            "method": "GET",
            "timeout": 0
        };

        $.ajax(settings).done(function(response) {
            var data = response.rajaongkir.results;
            var formoption = "";
            $.each(data, function(v) {
                var id_country = data[v].city_id;
                var country = data[v].city_name;
                var type = data[v].type;
                formoption += "<option value='" + id_country + "'>" + type + " " + country + "</option>";
            });
            $('#selectKota').append(`<optgroup label="Pilih Kota / Kabupaten" id="${id_provinsi}">${formoption}</optgroup>`);
        });

        document.getElementById('hiddenProvinsi').value = this.options[this.selectedIndex].text;
        document.getElementById("selectKota").removeChild(document.getElementById("selectKota").firstElementChild);
    });

    // Get cost pengiriman
    $('input[type=radio][name=jasaEkspedisi]').change(function() {
        var jasaEkspedisi = this.value;
        let weight = document.getElementById('countAllQty').value;
        let idkota = document.getElementById('idKotaPengiriman').value;
        var data = {
            "origin": "41",
            "destination": idkota,
            "weight": weight,
            "courier": jasaEkspedisi
        };
        var settings = {
            "url": "https://apiongkir.reta.co.id/api/cost",
            "method": "POST",
            "timeout": 0,
            "async": false,
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            "data": data
        };

        var response = $.ajax(settings).done(function(response) {
            return response;
        }).responseJSON;
        console.log(response.rajaongkir.results[0])
        var ongkosKirim;
        if (jasaEkspedisi == 'pos') {
            ongkosKirim = response.rajaongkir.results[0].costs[1].cost[0].value;
        } else {
            ongkosKirim = response.rajaongkir.results[0].costs[2].cost[0].value;
        };

        if (jasaEkspedisi == "pos") {
            document.getElementById('namaekspedisi').value = "POS";
        } else if (jasaEkspedisi == "tiki") {
            document.getElementById('namaekspedisi').value = "TIKI";
        } else {
            document.getElementById('namaekspedisi').value = "JNE";
        }

        // Set Price in View
        document.getElementById('costPengiriman').innerHTML = formatRupiah(ongkosKirim, 'Rp. ');
        document.getElementsByClassName("costDeliver").value = parseInt(ongkosKirim);

        // Set Total Cost
        if (document.getElementsByClassName("costAsuransi").value == undefined) {
            var totalPenjualan = parseInt(ongkosKirim) + parseInt(document.getElementById('subTotal').value);
            document.getElementById('totalCost').innerHTML = formatRupiah(totalPenjualan, 'Rp. ');
        } else {
            var totalPenjualan = parseInt(ongkosKirim) + parseInt(document.getElementById('subTotal').value) + parseInt(document.getElementsByClassName("costAsuransi").value);
            document.getElementById('totalCost').innerHTML = formatRupiah(totalPenjualan, 'Rp. ');
        }

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
    });

    // Tambah Biaya Asuransi
    $('input[type=checkbox][name=asuransi]').change(function() {
        let costAsuransi = document.getElementById('costAsuransi');
        let costAsuransiInput = document.getElementsByClassName("costAsuransi");
        let subTotal = document.getElementById('subTotal').value;
        let costDeliver = document.getElementsByClassName("costDeliver").value;

        if ($(this).prop('checked') == true) {
            costAsuransi.innerHTML = 'Rp. 5000';
            costAsuransiInput.value = 5000;
        } else {
            costAsuransi.innerHTML = 'Rp. -';
            costAsuransiInput.value = 0;
        }

        if (costDeliver == undefined) {
            totalPenjualan = parseInt(subTotal) + parseInt(costAsuransiInput.value);
            document.getElementById('totalCost').innerHTML = formatRupiah(totalPenjualan, 'Rp. ');
        } else {
            totalPenjualan = parseInt(subTotal) + parseInt(costDeliver) + parseInt(costAsuransiInput.value);
            document.getElementById('totalCost').innerHTML = formatRupiah(totalPenjualan, 'Rp. ');
        }

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
    });

});