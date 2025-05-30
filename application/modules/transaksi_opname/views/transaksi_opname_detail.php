<!-- Main Content -->

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form class="needs-validation" novalidate="" id="FORM_TRANSAKSI_OPNAME">
                        <div class="card-header">
                            <h4>DETAIL TRANSAKSI OPNAME</h4>

                        </div>
                        <div class="card-body">


                            <div class="form-group col-12 col-md-12 col-lg-12">
                                <table class="table table-striped table-sm ">
                                    <tbody>
                                        <tr>
                                            <th>KODE TRANSAKSI</th>
                                            <td><?= $get_single->UUID_TRANSAKSI_OPNAME; ?></td>
                                        </tr>
                                        <tr>
                                            <th>AREA</th>
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
                                            <th>KETERANGAN OPNAME</th>
                                            <td><?= $get_single->CATATAN_OPNAME; ?></td>
                                        </tr>
                                        <tr>
                                            <th>STATUS</th>
                                            <td><?= $get_single->STATUS_OPNAME; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-sm" id="dataprodukitem">
                                    <thead>
                                        <tr>
                                            <th>IMAGE</th>
                                            <th>PRODUK/ITEM</th>
                                            <th class="text-center">STOK SISTEM</th>
                                            <th class="text-center">STOK REAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="selected-items-body">
                                    </tbody>
                                </table>
                            </div><br><br>

                            <div class="row justify-content-center align-items-center">
                                <div class="form-group col-3 col-md-3 col-lg-3 text-center">
                                    <label>PETUGAS OPNAME :</label><br>
                                    <span><?php echo $get_single->NAMA_USER_PELAKSANA; ?></span>
                                </div>
                                <div class="form-group col-3 col-md-3 col-lg-3 text-center">
                                    <label>KABAG :</label><br>
                                    <span><?php echo $get_single->NAMA_APROVAL_KABAG; ?></span>
                                </div>
                                <div class="form-group col-3 col-md-3 col-lg3 text-center">
                                    <label>GM :</label><br>
                                    <span><?php echo $get_single->NAMA_APROVAL_GM; ?></span>
                                </div>
                                <div class="form-group col-3 col-md-3 col-lg-3 text-center">
                                    <label>HEAD :</label><br>
                                    <span><?php echo $get_single->NAMA_APROVAL_HEAD; ?></span>
                                </div>                                
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
            '<?=site_url('transaksi_opname/list_produk/').$get_single->UUID_TRANSAKSI_OPNAME;?>');
        const products = await response.json();
        localStorage.setItem('storedProdukItems', JSON.stringify(products));

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
                                    <td class="text-center col-2"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/')?>${item.FOTO_ITEM}" alt="Thumbnail" style="cursor: pointer;" class="thumbnail" onclick="showPopup(this)"></center></td>
                                    <td>${item.NAMA_PRODUK}</td>
                                    <td class="text-center col-2">${item.JUMLAH_STOK}</td>
                                    <td class="text-center col-2">${item.STOK_AKTUAL}</td>                                    
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


    $('#FORM_TRANSAKSI_OPNAME').on('submit', function(e) {
        e.preventDefault();

        let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];
        let formData = JSON.parse(localStorage.getItem('FormOpname')) || {};

        if (storedProdukItems.length == 0) {
            swal('Error', 'Tidak ada produk yang dipilih.', 'error').then(function() {
                console.log(storedProdukItems);
            });
        }

        $.ajax({
            url: "<?php echo base_url(); ?>" + "transaksi_opname/update_approval_head",
            type: "POST",
            data: {
                UUID_TRANSAKSI_OPNAME: '<?= $get_single->UUID_TRANSAKSI_OPNAME ?>',
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
                                "transaksi_opname";
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
                url: "<?php echo base_url(); ?>transaksi_opname/disapprove_head/",
                type: "POST",
                data: {
                    UUID_TRANSAKSI_OPNAME: '<?= $get_single->UUID_TRANSAKSI_OPNAME ?>',
                    KETERANGAN_CANCEL_KABAG: data
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.success) {
                        swal('Sukses', 'Transaksi Opname Berhasil Ditolak!',
                            'success').then(function() {
                            location.href = "<?php echo base_url(); ?>" +
                                "transaksi_opname";
                        });
                    } else {
                        swal('Gagal', res.error, 'error');
                    }
                }
            })
        });
    });

});


function showPopup(img) {
    let popupDiv = document.createElement("div");
    popupDiv.style.position = "fixed";
    popupDiv.style.top = "0";
    popupDiv.style.left = "0";
    popupDiv.style.width = "100%";
    popupDiv.style.height = "100%";
    popupDiv.style.background = "rgba(0, 0, 0, 0.8)";
    popupDiv.style.display = "flex";
    popupDiv.style.justifyContent = "center";
    popupDiv.style.alignItems = "center";
    popupDiv.style.cursor = "pointer";
    popupDiv.style.zIndex = "9999";

    let popupImg = document.createElement("img");
    popupImg.src = img.src;
    popupImg.style.maxWidth = "80%";
    popupImg.style.maxHeight = "80%";
    popupImg.style.borderRadius = "10px";
    popupImg.style.zIndex = "10000";

    popupDiv.appendChild(popupImg);
    popupDiv.onclick = function() {
        document.body.removeChild(popupDiv);
    };

    document.body.appendChild(popupDiv);
}
</script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>