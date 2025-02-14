<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGHAPUSAN">
                        <div class="card-header">
                            <h4>APROVAL KABAG TRANSAKSI PENGHAPUSAN</h4>

                        </div>
                        <div class="card-body">

                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <th>AREA</th>
                                            <td><?= $get_single->NAMA_AREA; ?></td>
                                            <input type="hidden" class="form-control" name="area" id="area" required
                                                value="<?= $get_single->NAMA_AREA; ?>" readonly>
                                        </tr>
                                        <tr>
                                            <th>DEPARTEMEN</th>
                                            <td><?= $get_single->NAMA_DEPARTEMEN; ?></td>
                                            <input type="hidden" class="form-control" name="departemen" id="departemen"
                                                required value="<?= $get_single->NAMA_DEPARTEMEN; ?>" readonly>
                                        </tr>
                                        <tr>
                                            <th>RUANGAN</th>
                                            <td><?= $get_single->NAMA_RUANGAN; ?></td>
                                            <input type="hidden" class="form-control" name="ruangan" id="ruangan"
                                                required value="<?= $get_single->NAMA_RUANGAN; ?>" readonly>
                                        </tr>
                                        <tr>
                                            <th>LOKASI</th>
                                            <td><?= $get_single->NAMA_LOKASI; ?></td>
                                            <input type="hidden" class="form-control" name="lokasi" id="lokasi" required
                                                value="<?= $get_single->NAMA_LOKASI; ?>" readonly>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="dataprodukitem">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>PRODUK/ITEM</th>
                                            <th>STOK SISTEM</th>
                                            <th>STOK REAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items-body">
                                    </tbody>
                                </table>
                            </div><br><br>

                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <label>KETERANGAN</label>
                                <textarea name="CATATAN_PENGHAPUSAN" placeholder="Masukkan keterangan penghapusan"
                                    class="form-control"
                                    id="CATATAN_PENGHAPUSAN"><?= $get_single->CATATAN_PENGHAPUSAN; ?></textarea>
                                <div class="invalid-feedback">
                                    Silahkan masukkan keterangan penghapusan!
                                </div>

                            </div>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-danger" id="btn-disapprove">
                                    <i class="fa fa-save"></i> DISAPROVE</button>
                                <button type="submit" class="btn btn-primary" id="btn-aprove">
                                    <i class="fa fa-save"></i> APROVE</button>
                            </div>
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


    async function simpan_list_produk_ke_localstorage() {
        const response = await fetch(
            '<?=site_url('transaksi_penghapusan/list_produk/').$get_single->UUID_TRANSAKSI_PENGHAPUSAN;?>');
        const products = await response.json();
        localStorage.setItem('storedProdukItems', JSON.stringify(products));

        tampilkan_data_ke_tabel();
    }


    function tampilkan_data_ke_tabel() {
        selectedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
        var tbody = $("#selected-items-body");
        tbody.empty();

        selectedItems.forEach(function(item, index) {
            if (item.STOK_AKTUAL == item.JUMLAH_STOK) {
                tbody.append(`
                                <tr data-index="${index}">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.KODE_ITEM}">
                                    <td><center><img width="100px" src="<?php echo base_url('assets/uploads/item/')?>${item.FOTO_ITEM}" alt=""></center></td>
                                    <td>${item.NAMA_PRODUK}</td>
                                    <td class="text-center">${item.JUMLAH_STOK}</td>
                                    <td><input type="text" class="form-control stok-real" name="STOK_AKTUAL[${index}]" value="${item.STOK_AKTUAL || ''}"></td>                                                                    
                                </tr>
                            `);
            } else {
                tbody.append(`
                                <tr data-index="${index}" style="background-color:rgb(255, 242, 168);">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.KODE_ITEM}">
                                    <td><center><img width="100px" src="<?php echo base_url('assets/uploads/item/')?>${item.FOTO_ITEM}" alt=""></center></td>
                                    <td>${item.NAMA_PRODUK}</td>
                                    <td class="text-center">${item.JUMLAH_STOK}</td>
                                    <td><input type="text" class="form-control stok-real" name="STOK_AKTUAL[${index}]" value="${item.STOK_AKTUAL || ''}"></td>                                                                                                       
                                </tr>
                            `);
            }
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


    $('#FORM_TRANSAKSI_PENGHAPUSAN').on('submit', function(e) {
        e.preventDefault();

        let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        let formData = JSON.parse(localStorage.getItem('FormPenghapusan')) || {};
        formData['CATATAN_PENGHAPUSAN'] = $('#CATATAN_PENGHAPUSAN').val();

        if (storedProdukItems.length == 0) {
            swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                console.log(storedProdukItems);
            });
        }

        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_penghapusan/update_approval_kabag",
            type: "POST",
            data: {
                UUID_TRANSAKSI_PENGHAPUSAN: '<?= $get_single->UUID_TRANSAKSI_PENGHAPUSAN ?>',
                items: storedProdukItems,
                form: formData
            },
            success: function(response) {
                try {
                    let res = JSON.parse(response);
                    if (res.success) {
                        swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                            localStorage.removeItem(
                                'storedProdukItems'
                            ); // Hapus localStorage setelah berhasil
                            location.href = "<?php echo base_url(); ?>" +
                                "transaksi_penghapusan";
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
    });



    // Kirim data untuk disapprove
    $('#btn-disapprove').on('click', function() {
        swal({
            title: 'Masukkan Keterangan Cancel',
            content: {
                element: 'input',
                attributes: {
                    placeholder: 'Keterangan',
                    type: 'text',
                },
            },
        }).then((data) => {
            $.ajax({
                url: "<?php echo base_url(); ?>transaksi_penghapusan/disapprove_kabag/",
                type: "POST",
                data: {
                    UUID_TRANSAKSI_PENGHAPUSAN: '<?= $get_single->UUID_TRANSAKSI_PENGHAPUSAN ?>',
                    KETERANGAN_CANCEL: data
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        swal('Sukses', 'Transaksi Penghapusan Berhasil Ditolak!',
                            'success').then(function() {
                            location.href = "<?php echo base_url(); ?>" +
                                "transaksi_penghapusan";
                        });
                    } else {
                        swal('Gagal', res.error, 'error');
                    }
                }
            })
        });
    });

});
</script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>