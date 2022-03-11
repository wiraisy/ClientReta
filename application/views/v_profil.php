    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?= base_url() ?>assets/img/faces/team-4.jpg"><span class="font-weight-bold"><br><?= $this->session->userdata('data_user_reta')['data']['custnama'] ?></span>
                <span class="text-black-50">Status : Member</span>
                </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profil Member</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Nama</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Nama" value="<?= $this->session->userdata('data_user_reta')['data']['custnama'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Customer ID</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Customer ID" value="<?= $this->session->userdata('data_user_reta')['data']['custid'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Nomer Ponsel</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan No. Hp" value="<?= $this->session->userdata('data_user_reta')['data']['hp1'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Alamat" value="<?= $this->session->userdata('data_user_reta')['data']['alamat'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Tanggal Lahir</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Tanggal Lahir" value="<?= date("d-M-Y", ((int)$this->session->userdata('data_user_reta')['data']['tgllahir']/1000) ); ?>"></div>
                        <div class="col-md-12"><label class="labels">Jenis Kelamin</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Jenis Kelamin" value="<?= $this->session->userdata('data_user_reta')['data']['gender1'] ?>"></div>
                        <div class="col-md-12"><label class="labels">Tanggal Registrasi</label><input type="text" class="form-control" disabled="true" placeholder="Masukkan Tanggal Registrasi" value="<?= date("d-M-Y", ((int)$this->session->userdata('data_user_reta')['data']['tglgabung']/1000) ); ?>"></div>
                        <div class="col-md-12"><label class="labels">Profesi</label><input type="text" class="form-control" disabled="true" placeholder="profesi" value="<?= $this->session->userdata('data_user_reta')['data']['pekerjaan'] ?>"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form action="<?= base_url() ?>profil/addAlamatKirim" method="POST">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Alamat Pengiriman</h4>
                        </div>
                        <input type="hidden" name="idAlamatKirim" value="<?= ($dataAlamat) ? $dataAlamat[0]['idkirim'] : '' ?>">
                        <div class="col-md-12">
                            <label class="labels">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?= ($dataAlamat) ? $dataAlamat[0]['alamat'] : '' ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="pilih-produk">Pilih Provinsi</label>
                            <select class="form-control" name="selectProvinsi" id="selectProvinsi" required>
                                <option value="<?= ($dataAlamat) ? $dataAlamat[0]['idpropinsi'] : '' ?>" selected><?= ($dataAlamat) ? $dataAlamat[0]['propinsi'] : 'Pilih Provinsi' ?></option>
                                <?php if($dataProvinsi['rajaongkir']['status']['code']===200){ ?>
                                    <?php foreach ($dataProvinsi['rajaongkir']['results'] as $row_dataProvinsi) { ?>
                                        <option value="<?= $row_dataProvinsi['province_id'] ?>"><?= $row_dataProvinsi['province'] ?></option>
                                    <?php } ?>
                                <?php }else{?>
                                        <option disabled>Data Provinsi Tidak Tersedia</option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="provinsi" id="hiddenProvinsi">
                            <script>
                                document.getElementById('hiddenProvinsi').value=$('#selectProvinsi').find(":selected").text();
                            </script>
                        </div>
                        <div class="col-md-12">
                            <label for="pilih-produk">Pilih Kota / Kabupaten</label>
                            <select class="form-control" name="selectKota" id="selectKota" onchange="document.getElementById('hiddenKabupaten').value=this.options[this.selectedIndex].text" required>
                                <option value="<?= ($dataAlamat) ? $dataAlamat[0]['idkabupaten'] : '' ?>" selected><?= ($dataAlamat) ? $dataAlamat[0]['kabupaten'] : 'Pilih Kota / Kabupaten' ?></option>
                            </select>
                            <input type="hidden" name="kabupaten" id="hiddenKabupaten">
                            <script>
                                document.getElementById('hiddenKabupaten').value=$('#selectKota').find(":selected").text();
                            </script>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Address</button></div>            
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
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
                formoption += "<option value='" + id_country + "' class='newOption-"+id_provinsi+"'>" + type + " " + country + "</option>";
            });
            $('#selectKota').append(`<optgroup label="Pilih Kota / Kabupaten" id="${id_provinsi}">${formoption}</optgroup>`);
        });
        
        document.getElementById('hiddenProvinsi').value=this.options[this.selectedIndex].text;
        document.getElementById("selectKota").removeChild(document.getElementById("selectKota").firstElementChild);
    });
    </script>