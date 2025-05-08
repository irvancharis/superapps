            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" enctype="multipart/form-data" novalidate=""
                                    id="FORM_TRANSAKSI_PRODUKSI_TAMBAH">
                                    <div class="card-header">
                                        <h4>INPUT TRANSAKSI PRODUKSI</h4>

                                    </div>


                                    
                                    <div class="card-body">


                                    <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>PRODUKSI ITEM / PRODUK </label>
                                                <select required name="PRODUKSI_ITEM" id="PRODUKSI_ITEM" class="form-control">
                                                    <option value="" class="text-center" selected disabled>-- Pilih
                                                        Item / Produk
                                                        --</option>
                                                    <?php foreach ($get_produk as $row) : ?>
                                                        <option value="<?= $row->KODE_ITEM; ?>"><?= $row->NAMA_ITEM; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>JUMLAH PRODUKSI</label>
                                                <input type="number" name="JUMLAH_PRODUKSI" id="JUMLAH_PRODUKSI"
                                                    class="form-control">
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                        </div>                                            

                                        <br><br>
                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            KOMPOSISI PRODUK</h4>
                                        <br>

                                        <div class="table-responsive">
                                            <div class="card-header-action text-right">
                                                <a id="btnshowproduk" href="#" class="btn btn-primary"><i
                                                        class="fas fa-search"></i></a>
                                            </div>
                                            <table class="table table-striped" id="dataprodukitem">
                                                <thead>
                                                    <tr>
                                                        <th>FOTO</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="text-center col-3">JUMLAH</th>
                                                        <th class="text-center col-1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>

                                        <br><br>

                                        <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                                            LOKASI PRODUKSI</h4>
                                        <br>
                                        <div class="row mt-2">
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>AREA</label>
                                                <select required name="AREA" id="AREA" class="form-control">
                                                    <option value="<?php echo $this->session->userdata('ID_AREA'); ?>" class="text-center" selected><?php echo $this->session->userdata('NAMA_AREA'); ?></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan AREA!
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-md-6 col-lg-6">
                                                <label>DEPARTEMEN</label>
                                                <select required read_only name="DEPARTEMEN" id="DEPARTEMEN"
                                                    class="form-control">
                                                    <option value="<?php echo $this->session->userdata('ID_DEPARTEMEN'); ?>" class="text-center" selected><?php echo $this->session->userdata('NAMA_DEPARTEMEN'); ?></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan masukkan DEPARTEMENT!
                                                </div>
                                            </div>
                                        </div>                                        

                                        <div class="form-group col-12 col-md-12 col-lg-12">
                                            <label>KETERANGAN</label>
                                            <textarea name="KETERANGAN"
                                                placeholder="Masukkan keterangan produksi" class="form-control"
                                                id="KETERANGAN"></textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan keterangan produksi!
                                            </div>


                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-primary" id="btn-simpan">
                                                <i class="fa fa-save"></i> SIMPAN
                                            </button>
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

                    let formData = JSON.parse(localStorage.getItem('FormProduksi'));

                    loadFormData();


                    $('#btnshowproduk').on('click', function() {

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_produksi/get_maping_default",
                            type: "POST",
                            success: function(response) {
                                let maping = JSON.parse(response);

                                Fancybox.show([{
                                    src: "<?php echo base_url('transaksi_produksi/get_produk_maping/'); ?>" +
                                        maping.AREA + "/" + maping.RUANGAN + "/" +
                                        maping
                                        .LOKASI + "/" + maping.DEPARTEMEN,
                                    type: "iframe",
                                    preload: false,
                                    width: "100%",
                                    height: "100%",
                                }, ]);
                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });

                    })

                    $('#dataprodukitem').dataTable({
                        paging: false,
                        searching: false,
                        info: false
                    });

                    // Cek apakah sudah ada data di LocalStorage
                    let storedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];

                    loadSelectedItems();

                    // Tangkap event dari Fancybox
                    window.addEventListener('message', function(event) {
                        if (event.data.action === 'updateTable') {
                            loadSelectedItems();
                        }
                    });

                    $('#btn-riset').on('click', function() {
                        localStorage.removeItem('storedProdukItems');
                        localStorage.removeItem('FormProduksi');
                        location.reload();
                    });
                    
                    // Simpan data ketika input berubah
                    $('select').on('change', function() {
                        saveFormData();
                    });
                    $('#PRODUKSI_ITEM').on('change', function() {
                        saveFormData();
                    });
                    $('#JUMLAH_PRODUKSI').on('change', function() {
                        saveFormData();
                    });
                    $('#KETERANGAN').on('change', function() {
                        saveFormData();
                    });

                    // Fungsi Load Data dari Local Storage
                    function loadSelectedItems() {
                        storedProdukItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
                        var tbody = $("#selected-items-body");
                        tbody.empty();

                        storedProdukItems.forEach(function(item, index) {
                            tbody.append(`
                                <tr data-index="${index}">
                                    <td class="text-center col-1"><center><img width="100px" src="<?php echo base_url('assets/uploads/item/') ?>${item.FOTO_ITEM}" alt=""></center></td>    
                                    <td>${item.NAMA_PRODUK}</td>
                                    <input type="hidden" class="form-control UUID_STOK" name="UUID_STOK[${index}]" value="${item.UUID_STOK || ''}">
                                    <input type="hidden" class="form-control KODE_ITEM" name="KODE_ITEM[${index}]" value="${item.KODE_ITEM || ''}">
                                    <td class="text-center col-3"><input type="number" required class="form-control JUMLAH_KEBUTUHAN" a="JUMLAH_KEBUTUHAN" name="JUMLAH_KEBUTUHAN[${index}]" value="${item.JUMLAH_KEBUTUHAN || ''}"></td>
                                    <td class="text-center col-1">
                                        <button class="btn btn-danger remove-item" data-index="${index}">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });

                        attachInputListeners();

                    }

                    // Hapus data local Storage
                    $('#selected-items-body').on('click', '.remove-item', function() {
                        let selectedItems = JSON.parse(localStorage.getItem("storedProdukItems")) || [];
                        let index = $(this).data("index");

                        if (index > -1) {
                            selectedItems.splice(index, 1);
                            localStorage.setItem("storedProdukItems", JSON.stringify(
                                selectedItems)); // Perbaikan di sini
                        }

                        loadSelectedItems();
                    });


                    function attachInputListeners() {
                        $('.JUMLAH_KEBUTUHAN').on('input', function() {
                            let rowIndex = $(this).closest('tr').data('index');
                            let fieldName = $(this).attr('a');
                            let storedItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

                            storedItems[rowIndex][fieldName] = $(this).val();
                            localStorage.setItem('storedProdukItems', JSON.stringify(storedItems));
                        });
                    }

                });

                $('#FORM_TRANSAKSI_PRODUKSI_TAMBAH').on('submit', function(e) {
                    e.preventDefault();

                    swal({
                        title: 'KONFIRMASI',
                        text: 'Yakin Ingin Simpan?',
                        icon: 'warning',
                        buttons: {
                            cancel: {
                                text: 'Tidak',
                                value: false,
                                visible: true,
                                closeModal: true
                            },
                            confirm: {
                                text: 'Ya',
                                value: true,
                                visible: true,
                                closeModal: true
                            }
                        },
                        dangerMode: true
                    }).then((confirm) => {
                        if (confirm) {
                            let formData = new FormData(this);
                            let requiredFields = ['AREA', 'DEPARTEMEN', 'KETERANGAN'];
                            let isEmpty = requiredFields.some(field => !formData.get(field));

                            if (isEmpty) {
                                swal('Error', 'Lengkapi semua data.', 'error');
                            }

                            let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

                            if (storedProdukItems.length == 0 || storedProdukItems.some(item => !item.JUMLAH_KEBUTUHAN )) {
                                swal('Error', 'Lengkapi data produk.', 'error').then(function() {
                                    console.log(storedProdukItems);
                                });
                            } else {
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "transaksi_produksi/insert",
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        let res = JSON.parse(response);
                                        if (res.success) {
                                            swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                                                localStorage.removeItem(
                                                    'storedProdukItems'
                                                ); // Hapus localStorage setelah disimpan
                                                localStorage.removeItem(
                                                    'FormProduksi'
                                                ); // Hapus localStorage setelah disimpan
                                                location.href = "<?php echo base_url(); ?>" +
                                                    "transaksi_produksi";
                                            });
                                        } else {
                                            swal('Gagal', res.error, 'error');
                                        }
                                    }
                                });
                            }
                        }
                    });
                });

                // Form Data Save to Local Storage
                function saveFormData() {
                    let formData = {
                        AREA: $('#AREA').val(),
                        DEPARTEMEN: $('#DEPARTEMEN').val(),
                        PRODUKSI_ITEM: $('#PRODUKSI_ITEM').val(),
                        JUMLAH_PRODUKSI: $('#JUMLAH_PRODUKSI').val(),
                        KETERANGAN: $('#KETERANGAN').val() == '' ? null : $('#KETERANGAN').val()
                    };

                    localStorage.setItem('FormProduksi', JSON.stringify(formData));
                }

                // Form Data Load from Local Storage
                function loadFormData() {
                    let formData = JSON.parse(localStorage.getItem('FormProduksi'));
                    if (formData) {
                        $('#AREA').val(formData.AREA);
                        $('#DEPARTEMEN').val(formData.DEPARTEMEN);
                        $('#PRODUKSI_ITEM').val(formData.PRODUKSI_ITEM);
                        $('#JUMLAH_PRODUKSI').val(formData.JUMLAH_PRODUKSI);                       
                        $('#KETERANGAN').val(formData.KETERANGAN);
                    }
                }
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>