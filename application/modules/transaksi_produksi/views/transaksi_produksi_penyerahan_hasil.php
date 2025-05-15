<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PRODUKSI">
                        <div class="card-header">
                            <h4>PENYERAHAN HASIL PRODUKSI</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12 col-md-6 col-lg-6">
                                    <h4 class="text-left" style="border-bottom:1px solid rgb(228, 228, 228)">LOKASI ASAL</h4>
                                    <br>
                                    <table class="table table-striped table-sm ">
                                        <tbody>
                                            <tr>
                                                <th class="text-left col-4">AREA ASAL</th>
                                                <td><?php echo $lokasi_asal->NAMA_AREA; ?></td>
                                                <input type="hidden" class="form-control" name="area" id="area" required
                                                    value="NAMA_AREA_AWAL" readonly>
                                            </tr>
                                            <tr>
                                                <th>DEPARTEMEN ASAL</th>
                                                <td><?php echo $lokasi_asal->NAMA_DEPARTEMEN; ?></td>
                                                <input type="hidden" class="form-control" name="departemen"
                                                    id="departemen" required
                                                    value="NAMA_DEPARTEMEN_AWAL" readonly>
                                            </tr>
                                            <tr>
                                                <th>RUANGAN ASAL</th>
                                                <td><?php echo $lokasi_asal->NAMA_RUANGAN; ?></td>
                                                <input type="hidden" class="form-control" name="ruangan" id="ruangan"
                                                    required value="NAMA_RUANGAN_AWAL" readonly>
                                            </tr>
                                            <tr>
                                                <th>LOKASI ASAL</th>
                                                <td><?php echo $lokasi_asal->NAMA_LOKASI; ?></td>
                                                <input type="hidden" class="form-control" name="lokasi" id="lokasi"
                                                    required value="NAMA_LOKASI_AWAL" readonly>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group col-12 col-md-6 col-lg-6">
                                    <h4 class="text-left" style="border-bottom:1px solid rgb(228, 228, 228)">LOKASI PRODUKSI</h4>
                                    <br>
                                    <table class="table table-striped table-sm ">
                                        <tbody>
                                            <tr>
                                                <th class="text-left col-4">AREA PRODUKSI</th>
                                                <td><?php echo $get_single->NAMA_AREA; ?></td>
                                                <input type="hidden" class="form-control" name="area" id="area" required
                                                    value="NAMA_AREA_AKHIR" readonly>
                                            </tr>
                                            <tr>
                                                <th>DEPARTEMEN PRODUKSI</th>
                                                <td><?php echo $get_single->NAMA_DEPARTEMEN; ?></td>
                                                <input type="hidden" class="form-control" name="departemen"
                                                    id="departemen" required
                                                    value="NAMA_DEPARTEMEN_AKHIR" readonly>
                                            </tr>
                                            <tr>
                                                <th>RUANGAN PRODUKSI</th>
                                                <td><?php echo $get_single->NAMA_RUANGAN; ?></td>
                                                <input type="hidden" class="form-control" name="ruangan" id="ruangan"
                                                    required value="NAMA_RUANGAN_AKHIR" readonly>
                                            </tr>
                                            <tr>
                                                <th>LOKASI PRODUKSI</th>
                                                <td><?php echo $get_single->NAMA_LOKASI; ?></td>
                                                <input type="hidden" class="form-control" name="lokasi" id="lokasi"
                                                    required value="NAMA_LOKASI_AKHIR" readonly>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group col-12 col-md-12 col-lg-12">
                                    <table class="table table-striped table-sm ">
                                        <tbody>
                                            <tr>
                                                <th class="text-left col-3">KETERANGAN : <?php echo $get_single->KETERANGAN; ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dataprodukitem">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>PRODUK / ITEM</th>
                                            <th>JUMLAH</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items-body">
                                    </tbody>
                                </table>
                            </div><br><br>

                            <h6 class="text-danger font-italic">*) ISI DATA DI BAWAH :</h6>
                            <div class="row justify-content-center align-items-center">
                                <div class="form-group col-6 col-md-6 col-lg-6">
                                    <label>JUMLAH HASIL PRODUKSI :</label>
                                    <input type="number" class="form-control" name="JUMLAH_HASIL_PRODUKSI" id="JUMLAH_HASIL_PRODUKSI" required>
                                    <div class="invalid-feedback">
                                        Masukkan JUMLAH HASIL PRODUKSI !
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btn-aprove">
                                    <i class="fa fa-save"></i> Selesai</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


<?php $this->load->view('layout/footer'); ?>

<script>
    $(document).ready(function() {


        $('#dataprodukitem').dataTable({
            paging: false,
            searching: false
        });

        simpan_list_produk_ke_localstorage();
        simpan_list_maping_ke_localstorage();
        simpan_data_lokasi_asal_ke_localstorage();

        async function simpan_data_lokasi_asal_ke_localstorage() {
            const lokasiAsal = <?php echo json_encode($lokasi_asal); ?>;
            localStorage.setItem('lokasiAsal', JSON.stringify(lokasiAsal));
            console.log(JSON.parse(localStorage.getItem('lokasiAsal')));
        }

        async function simpan_list_produk_ke_localstorage() {
            const response = await fetch(
                '<?= site_url('transaksi_produksi/list_produk/') . $get_single->UUID_TRANSAKSI_PRODUKSI; ?>'
            );
            const products = await response.json();
            localStorage.setItem('storedProdukItems', JSON.stringify(products));

            tampilkan_data_ke_tabel();
        }

        async function simpan_list_maping_ke_localstorage() {
            const response = await fetch(
                '<?= site_url('transaksi_produksi/list_maping/') . $get_single->UUID_TRANSAKSI_PRODUKSI; ?>'
            );
            const products = await response.json();
            localStorage.setItem('list_maping', JSON.stringify(products));

            tampilkan_data_ke_tabel();
        }


        function tampilkan_data_ke_tabel() {
            selectedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
            var tbody = $("#selected-items-body");
            tbody.empty();

            selectedItems.forEach(function(item, index) {
                tbody.append(`
                                <tr data-index="${index}">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.KODE_ITEM}">
                                    <td class="text-center col-2"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/') ?>${item.FOTO_ITEM}" alt=""></center></td>
                                    <td>${item.NAMA_ITEM}</td>
                                    <td class="text-center col-1">${item.JUMLAH_KEBUTUHAN}</td>
                                    <td class="col-4">${item.KETERANGAN}</td>
                                </tr>
                            `);
            });
            // Perbarui listener input setelah render ulang
            attachInputListeners();
        }

        function attachInputListeners() {
            $('#selected-items-body').on('input', '.stok-real', function() {
                let rowIndex = $(this).closest('tr').data('index');
                let stokReal = $(this).val();

                let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
                storedItems[rowIndex].STOK_AKTUAL = stokReal;
                localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
            });
        }

        $('#selected-items-body').on('input', '.stok-real', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let stokReal = $(this).val();

            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            storedItems[rowIndex].STOK_AKTUAL = stokReal;
            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
        });


        $('#FORM_TRANSAKSI_PRODUKSI').on('submit', function(e) {
            e.preventDefault();

            let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            let formData = JSON.parse(localStorage.getItem('list_maping')) || [];
            let lokasiAsal = JSON.parse(localStorage.getItem('lokasiAsal')) || [];

            if (storedProdukItems.length == 0) {
                swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                    console.log(storedProdukItems);
                });
            }

            if ($('#JUMLAH_HASIL_PRODUKSI').val() == '' || $('#JUMLAH_HASIL_PRODUKSI').val() == null) {
                swal('Error', 'Masukkan jumlah hasil produksi.', 'error').then(function() {
                    console.log(formData);
                });
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>" +
                        "transaksi_produksi/update_proses_penyerahan_hasil",
                    type: "POST",
                    data: {
                        UUID_TRANSAKSI_PRODUKSI: '<?= $get_single->UUID_TRANSAKSI_PRODUKSI ?>',
                        items: storedProdukItems,
                        form: formData,
                        lokasiAsal: lokasiAsal,
                        JUMLAH_HASIL_PRODUKSI: $('#JUMLAH_HASIL_PRODUKSI').val()
                    },
                    success: function(response) {
                        try {
                            let res = JSON.parse(response);
                            if (res.success) {
                                swal('Sukses', 'Simpan Data Berhasil!', 'success').then(
                                    function() {
                                        localStorage.removeItem(
                                            'storedProdukItems'
                                        ); // Hapus localStorage setelah berhasil
                                        location.href = "<?php echo base_url(); ?>" +
                                            "transaksi_produksi";
                                    });
                            } else {
                                swal('Gagal', res.error, 'error');
                            }
                        } catch (error) {
                            console.error('Parsing JSON gagal:', error);
                            swal('Error', 'Terjadi kesalahan pada server.', 'error');
                        }
                    }
                });
            }


        });




    });
</script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>