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
        document.getElementById("selectKota").removeChild(document.getElementById("selectKota").firstElementChild);
    });
    // Post Alamat Kirim
    $('#addAlamatKirim').on('click', function() {
        let idpasien = document.getElementById("idpasien").value;
        let alamat = document.getElementById("alamatpenerima").value;
        let idprovinsi = $('#selectProvinsi').find(":selected").val();
        let provinsi = $('#selectProvinsi').find(":selected").text();
        let idkota = $('#selectKota').find(":selected").val();
        let kota = $('#selectKota').find(":selected").text();

        if (alamat == "" || idprovinsi == "" && idkota == "") {
            alert("Dimohon untuk mengisi semua field tersedia.");
        } else {
            let data = `{\n    \"alamat\": \"${alamat}\",\n    \"idkabupaten\": ${idprovinsi},\n    \"idkecamatan\": 0,\n    \"idpasien\":${idpasien},\n    \"idpropinsi\": ${idprovinsi},\n    \"kabupaten\": \"${kota}\",\n    \"kecamatan\": \"\",\n    \"propinsi\": \"${provinsi}\"\n}`;
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "https://api-reta.id/reta-api/AlamatKirimAPI/SimpanAlamat");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Authorization", "Basic YWtiYXI6d2lyYWlzeQ==");

            xhr.send(data);
        }
        location.reload();
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

        var ongkosKirim;
        if (jasaEkspedisi == 'pos') {
            ongkosKirim = response.rajaongkir.results[0].costs[1].cost[0].value;
        } else {
            ongkosKirim = response.rajaongkir.results[0].costs[2].cost[0].value;
        };

        // Set Price in View
        document.getElementById('costPengiriman').innerHTML = "Rp. " + ongkosKirim;
        // Set Total Cost
        document.getElementById('totalCost').innerHTML = "Rp. " + (parseInt(ongkosKirim) + parseInt(document.getElementById('subTotal').value));
    });
});