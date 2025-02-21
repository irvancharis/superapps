<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_PENGHAPUSAN">
                        <div class="card-header">
                            <h4>TRANSAKSI PENGHAPUSAN - PENJADWALAN PENGHAPUSAN</h4>

                        </div>
                        <div class="card-body">


                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <th class="col-3">AREA</th>
                                            <td><?= $get_single->NAMA_AREA; ?></td>
                                        </tr>
                                        <tr>
                                            <th>DEPARTEMEN</th>
                                            <td><?= $get_single->NAMA_DEPARTEMEN; ?></td>
                                        </tr>
                                        <tr>
                                            <th>RUANGAN</th>
                                            <td><?= $get_single->NAMA_RUANGAN; ?></td>
                                        </tr>
                                        <tr>
                                            <th>LOKASI</th>
                                            <td><?= $get_single->NAMA_LOKASI; ?></td>
                                        </tr>
                                        <tr>
                                            <th>KETERANGAN PENGHAPUSAN</th>
                                            <td><?= $get_single->KETERANGAN_PENGHAPUSAN; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="dataprodukitem">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>PRODUK/ITEM</th>
                                            <th>JUMLAH</th>
                                            <th>METODE PENGHAPUSAN</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items-body">
                                    </tbody>
                                </table>
                            </div><br><br>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btn-aprove">
                                    <i class="fa fa-save"></i> UPDATE PENGHAPUSAN</button>
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
        searching: false,
        sorting: false
    });


    simpan_list_produk_ke_localstorage();


    async function simpan_list_produk_ke_localstorage() {
        const response = await fetch(
            '<?=site_url('transaksi_penghapusan/list_produk/').$get_single->UUID_TRANSAKSI_PENGHAPUSAN;?>'
        );
        const products = await response.json();
        localStorage.setItem('storedProdukItems', JSON.stringify(products));

        tampilkan_data_ke_tabel();
    }


    function tampilkan_data_ke_tabel() {
        selectedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
        var tbody = $("#selected-items-body");
        tbody.empty();

        let options = "";
        var metodePenghapusan = <?php echo json_encode($metode_penghapusan); ?>;
        metodePenghapusan.forEach(function(metode) {

            options +=
                `<option value="${metode.KODE_METODE_PENGHAPUSAN}">${metode.NAMA_METODE_PENGHAPUSAN}</option>`;
        });

        selectedItems.forEach(function(item, index) {
            tbody.append(`
                                <tr data-index="${index}">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.KODE_ITEM}">
                                    <td class="text-center col-1"><center><img width="100px" src="<?php echo base_url('assets/uploads/transaksi_penghapusan/')?>${item.FOTO_KONDISI_AWAL}" alt=""></center></td>
                                    <td>${item.NAMA_PRODUK}</td>
                                    <td class="text-center col-1">${item.JUMLAH_PENGHAPUSAN}</td>
                                    <td class="col-4">
                                    <select class="form-control" required class="METODE_PENGHAPUSAN" onchange="set_metode(${index},$(this).val())" name="METODE_PENGHAPUSAN[${index}]">                                                       
                                        <option value="">-- Pilih Metode Penghapusan --</option>
                                        ${options}
                                    </select>
                                    </td>
                                </tr>
                            `);
        });
    }


    $('#FORM_TRANSAKSI_PENGHAPUSAN').on('submit', function(e) {
            e.preventDefault();

            let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
            let formData = JSON.parse(localStorage.getItem('FormPenghapusan')) || {};

            $metode = [
                storedProdukItems.KODE_METODE_PENGHAPUSAN !=''
            ];

            //alert($metode);

            var isComplete = (
                $metode 
            );

            if (storedProdukItems.length == 0) {
                swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                    console.log(storedProdukItems);
                });
            }
            if (!isComplete) {
                swal('Error', 'Lengkapi semua data.', 'error').then(function() {
                    return;
                });
            } else {
            $.ajax({
                url: "<?php echo base_url(); ?>" +
                    "transaksi_penghapusan/update_jadwal_pengahapusan",
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
        }
    });


});

function set_metode(key, val) {
    let METODE_PENGHAPUSAN = val;
    let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
    storedItems[key].KODE_METODE_PENGHAPUSAN = METODE_PENGHAPUSAN;
    localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
};
</script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>