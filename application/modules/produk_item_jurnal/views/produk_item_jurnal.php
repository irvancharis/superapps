            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row mx-1 mx-md-0 mx-lg-0">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>JURNAL ITEM - AREA</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>AREA</label>
                                            <select required name="AREA_PENEMPATAN" id="AREA_PENEMPATAN"
                                                class="form-control">
                                                <option value="" class="text-center" selected disabled>-- Pilih Area --
                                                </option>
                                                <?php foreach ($get_area as $row) : ?>
                                                    <option value="<?= $row->KODE_AREA; ?>"><?= $row->NAMA_AREA; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan area!
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>RUANGAN</label>
                                            <select required name="RUANGAN_PENEMPATAN" id="RUANGAN_PENEMPATAN"
                                                class="form-control select2">
                                                <option value="" class="text-center" selected disabled>-- Pilih Ruangan
                                                    --</option>
                                                <?php foreach ($get_ruangan as $row) : ?>
                                                    <option value="<?= $row->KODE_RUANGAN; ?>"><?= $row->NAMA_RUANGAN; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>LOKASI</label>
                                            <select required name="LOKASI_PENEMPATAN" id="LOKASI_PENEMPATAN"
                                                class="form-control select2">
                                                <option value="" class="text-center" selected disabled>-- Pilih Lokasi
                                                    --</option>
                                                <?php foreach ($get_lokasi as $row) : ?>
                                                    <option value="<?= $row->KODE_LOKASI; ?>"><?= $row->NAMA_LOKASI; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>DEPARTEMEN</label>
                                            <select required name="DEPARTEMEN_PENEMPATAN" id="DEPARTEMEN_PENEMPATAN"
                                                class="form-control select2">
                                                <option value="" class="text-center" selected disabled>-- Pilih
                                                    Departemen --</option>
                                                <?php foreach ($get_departemen as $row) : ?>
                                                    <option value="<?= $row->KODE_DEPARTEMEN; ?>">
                                                        <?= $row->NAMA_DEPARTEMEN; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan ruangan!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>JURNAL ITEM - PRODUK</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>KODE ITEM</label>
                                            <select required name="PRODUK_ITEM" id="PRODUK_ITEM"
                                                class="form-control select2">
                                                <option value="" class="text-center" selected disabled>-- Pilih Item --
                                                </option>
                                                <?php foreach ($M_PRODUK_ITEM as $row) : ?>
                                                    <option value="<?= $row->KODE_ITEM; ?>"><?= $row->NAMA_ITEM; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Silahkan masukkan KODE ITEM!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p class="clearfix">
                                            <span class="float-left">
                                                NAMA ITEM
                                            </span>
                                            <span class="float-right text-muted" id="NAMA_ITEM">
                                                -
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">
                                                KATEGORI
                                            </span>
                                            <span class="float-right text-muted" id="KATEGORI">
                                                -
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">
                                                KETERANGAN ITEM
                                            </span>
                                            <span class="float-right text-muted" id="KETERANGAN_ITEM">
                                                -
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">
                                                SATUAN
                                            </span>
                                            <span class="float-right text-muted" id="SATUAN">
                                                <a href="#">-</a>
                                            </span>
                                        </p>
                                        <p class="clearfix">
                                            <span class="float-left">
                                                FOTO
                                            </span>
                                            <span class="float-right text-muted foto-item" id="FOTO">
                                                -
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary d-block mx-auto mb-4" id="btn-show-produk"> <i
                            class="fa fa-search"></i> SHOW PRODUK</button>

                    <div class="row mx-1 mx-md-0 mx-lg-0">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-center">
                                    <h4>DETAIL INFO PRODUK/ITEM JURNAL</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="TABEL">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-1">#</th>
                                                    <th class="text-center col-1">KODE TRANSAKSI</th>
                                                    <th class="text-center col-2">TGL TRANSAKSI</th>
                                                    <th class="text-center col-3">JENIS TRANSAKSI</th>
                                                    <th class="text-center col-1">JML</th>
                                                    <th class="text-center col-1">IN/OUT</th>
                                                    <th class="text-center col-1">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected-items-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            </body>


            <script>
                $(document).ready(function() {
                    $('#TABEL').dataTable({
                        paging: false
                    });

                    localStorage.removeItem(
                        'FormMapping');



                    $('select').on('change', function() {
                        saveFormData();
                    });

                    // Form Data Save to Local Storage
                    function saveFormData() {
                        let formData = {
                            AREA: $('#AREA_PENEMPATAN').val(),
                            DEPARTEMEN: $('#DEPARTEMEN_PENEMPATAN').val(),
                            RUANGAN: $('#RUANGAN_PENEMPATAN').val(),
                            LOKASI: $('#LOKASI_PENEMPATAN').val(),
                        };

                        localStorage.setItem('FormMapping', JSON.stringify(formData));
                    }

                    $('#formHapusproduk').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" +
                                "produk_item/hapus", // Endpoint untuk proses input
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                let res = JSON.parse(response);
                                if (res.success) {
                                    swal('Sukses', 'Hapus Data Berhasil!', 'success').then(function() {
                                        $('#hapusModal').modal('hide');
                                        location.reload();
                                    });
                                } else {
                                    alert('Gagal menghapus data: ' + response.error);
                                }
                            },
                            error: function() {
                                alert('Gagal melakukan proses.');
                            }
                        });
                    });

                    // Get Ruangan By Area
                    $('#AREA_PENEMPATAN').on('change', function() {
                        let area = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "maping_ruangan/get_maping_ruangan_by_area/" + $(this).val(),
                            type: "POST",
                            data: {
                                AREA_PENEMPATAN: area
                            },
                            success: function(response) {
                                var ruangan = JSON.parse(response);
                                var data_ruangan = ruangan;
                                var $ruanganPenempatan = $('#RUANGAN_PENEMPATAN');
                                var $lokasiPenempatan = $('#LOKASI_PENEMPATAN');

                                $ruanganPenempatan.empty().append(
                                    '<option value="" class="text-center" selected disabled>-- Pilih Ruangan --</option>'
                                );
                                $lokasiPenempatan.empty().append(
                                    '<option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>'
                                );

                                $.each(data_ruangan, function(index, lokasi) {
                                    $ruanganPenempatan.append($('<option>', {
                                        value: lokasi.KODE_RUANGAN,
                                        text: lokasi.NAMA_RUANGAN
                                    }));
                                });

                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });
                    });

                    // Get Lokasi By Ruangan
                    $('#RUANGAN_PENEMPATAN').on('change', function() {
                        let ruangan = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "transaksi_pengadaan/get_lokasi_by_ruangan",
                            type: "POST",
                            data: {
                                RUANGAN_PENEMPATAN: ruangan
                            },
                            success: function(response) {
                                var lokasi = JSON.parse(response);
                                var data_lokasi = lokasi.data;
                                var $lokasiPenempatan = $('#LOKASI_PENEMPATAN');

                                $lokasiPenempatan.empty().append(
                                    '<option value="" class="text-center" selected disabled>-- Pilih Lokasi --</option>'
                                );

                                $.each(data_lokasi, function(index, lokasi) {
                                    $lokasiPenempatan.append($('<option>', {
                                        value: lokasi.KODE_LOKASI,
                                        text: lokasi.NAMA_LOKASI
                                    }));
                                });

                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });
                    });


                    // Get Data Produk Lock
                    $('#btn-show-produk').on('click', function() {
                        var AREA_PENEMPATAN = $('#AREA_PENEMPATAN').val();
                        var DEPARTEMEN_PENEMPATAN = $('#DEPARTEMEN_PENEMPATAN').val();
                        var RUANGAN_PENEMPATAN = $('#RUANGAN_PENEMPATAN').val();
                        var LOKASI_PENEMPATAN = $('#LOKASI_PENEMPATAN').val();
                        var PRODUK_ITEM = $('#PRODUK_ITEM').val();

                        // Validasi minimal satu inputan diisi
                        if (!AREA_PENEMPATAN && !DEPARTEMEN_PENEMPATAN && !RUANGAN_PENEMPATAN && !LOKASI_PENEMPATAN) {
                            $('#selected-items-body').html('<tr><td colspan="10" class="text-center text-warning">Harap isi minimal satu filter (Area, Departemen, Ruangan, atau Lokasi)</td></tr>');
                            return false;
                        }

                        // Tampilkan loading
                        $('#selected-items-body').html('<tr><td colspan="10" class="text-center">Loading data...</td></tr>');

                        // Ajax request ke controller
                        $.ajax({
                            url: '<?php echo site_url("produk_item_jurnal/get_produk_item_jurnal_detail"); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                AREA: AREA_PENEMPATAN,
                                DEPARTEMEN: DEPARTEMEN_PENEMPATAN,
                                RUANGAN: RUANGAN_PENEMPATAN,
                                LOKASI: LOKASI_PENEMPATAN,
                                KODE_ITEM: PRODUK_ITEM
                            },
                            success: function(response) {
                                // Header tabel tetap menampilkan semua kolom
                                var headerHtml = '<tr>' +
                                    '<th class="text-center">#</th>' +
                                    '<th class="text-center">KODE TRANSAKSI</th>' +
                                    '<th class="text-center">TGL TRANSAKSI</th>' +
                                    '<th class="text-center">JENIS TRANSAKSI</th>' +
                                    '<th class="text-center">ITEM</th>' +
                                    '<th class="text-center">KATEGORI</th>' +
                                    '<th class="text-center">KETERANGAN</th>' +
                                    '<th class="text-center">SATUAN</th>' +
                                    '<th class="text-center">FOTO</th>' +
                                    '<th class="text-center">AREA</th>' +
                                    '<th class="text-center">DEPARTEMEN</th>' +
                                    '<th class="text-center">RUANGAN</th>' +
                                    '<th class="text-center">LOKASI</th>' +
                                    '<th class="text-center">JML</th>' +
                                    '<th class="text-center">IN/OUT</th>' +
                                    '<th class="text-center">ACTION</th>' +
                                    '</tr>';

                                // Update header tabel
                                $('#TABEL thead').html(headerHtml);

                                if (response.status == 'success' && response.data.length > 0) {
                                    // Siapkan data untuk DataTables
                                    var tableData = [];
                                    $.each(response.data, function(index, item) {
                                        var fotoHtml = item.FOTO_ITEM ?
                                            '<a class="gallery-item" href="<?php echo base_url("assets/uploads/item/"); ?>' + item.FOTO_ITEM +
                                            '" data-fancybox data-caption="' + item.NAMA_ITEM +
                                            '"><img style="width: 50px; height: 50px; object-fit: cover;" src="<?php echo base_url("assets/uploads/item/"); ?>' +
                                            item.FOTO_ITEM + '" alt="' + item.NAMA_ITEM + '"></a>' :
                                            '<span class="text-muted">No Image</span>';

                                        var rowData = [
                                            (index + 1),
                                            '<a href="javascript:void(0)" data-toggle="tooltip" title="' + item.KODE_TRANSAKSI + '">' + item.KODE_TRANSAKSI.substring(0, 5) + '</a>',
                                            item.TANGGAL_TRANSAKSI,
                                            item.JENIS_TRANSAKSI,
                                            item.NAMA_ITEM || '-',
                                            item.NAMA_PRODUK_KATEGORI || '-',
                                            item.KETERANGAN_ITEM || '-',
                                            item.SATUAN || '-',
                                            fotoHtml,
                                            item.AREA || '-',
                                            item.DEPARTEMEN || '-',
                                            item.RUANGAN || '-',
                                            item.LOKASI || '-',
                                            item.JUMLAH,
                                            (item.IN_OUT == 'IN' ? '<span class="badge bg-success text-white">IN</span>' : '<span class="badge bg-danger text-white">OUT</span>'),
                                            '<button type="button" class="btn btn-sm btn-primary btn-print" data-id="' + item.KODE_TRANSAKSI + '" data-toggle="tooltip" title="Cetak"><i class="fas fa-print"></i></button>'
                                        ];

                                        tableData.push(rowData);

                                        // Inisialisasi Fancybox untuk gambar
                                        Fancybox.bind("[data-fancybox]", {
                                            // Opsi Fancybox
                                            Thumbs: {
                                                autoStart: false,
                                            },
                                            Toolbar: {
                                                display: {
                                                    left: [],
                                                    middle: [],
                                                    right: ["close"],
                                                },
                                            },
                                        });
                                    });

                                    // Hancurkan DataTable jika sudah ada
                                    if ($.fn.DataTable.isDataTable('#TABEL')) {
                                        $('#TABEL').DataTable().destroy();
                                    }

                                    // Inisialisasi DataTables dengan kolom tetap
                                    var dataTable = $('#TABEL').DataTable({
                                        data: tableData,
                                        columns: [{
                                                className: 'text-center',
                                                orderable: false,
                                                searchable: false,
                                                render: function(data, type, row, meta) {
                                                    // Menggunakan meta.row untuk nomor urut yang konsisten
                                                    return meta.row + 1;
                                                }
                                            }, // #
                                            {
                                                data: 1,
                                                className: 'text-center'
                                            }, // KODE TRANSAKSI
                                            {
                                                data: 2,
                                                className: 'text-center'
                                            }, // TGL TRANSAKSI
                                            {
                                                data: 3,
                                                className: 'text-center'
                                            }, // JENIS TRANSAKSI
                                            {
                                                data: 4,
                                                className: 'text-center'
                                            }, // NAMA ITEM
                                            {
                                                data: 5,
                                                className: 'text-center'
                                            }, // KATEGORI
                                            {
                                                data: 6,
                                                className: 'text-center'
                                            }, // KETERANGAN
                                            {
                                                data: 7,
                                                className: 'text-center'
                                            }, // SATUAN
                                            {
                                                data: 8,
                                                className: 'text-center',
                                                orderable: false,
                                                searchable: false,
                                                render: function(data, type, row) {
                                                    return type === 'display' ? data : '';
                                                }
                                            }, // FOTO
                                            {
                                                data: 9,
                                                className: 'text-center'
                                            }, // AREA
                                            {
                                                data: 10,
                                                className: 'text-center'
                                            }, // DEPARTEMEN
                                            {
                                                data: 11,
                                                className: 'text-center'
                                            }, // RUANGAN
                                            {
                                                data: 12,
                                                className: 'text-center'
                                            }, // LOKASI
                                            {
                                                data: 13,
                                                className: 'text-center'
                                            }, // JML
                                            {
                                                data: 14,
                                                className: 'text-center'
                                            }, // IN/OUT
                                            {
                                                data: 15,
                                                className: 'text-center',
                                                orderable: false,
                                                searchable: false
                                            } // ACTION
                                        ],
                                        responsive: true,
                                        language: {
                                            search: "Cari:",
                                            lengthMenu: "Tampilkan _MENU_ data per halaman",
                                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                                            paginate: {
                                                previous: "Sebelumnya",
                                                next: "Selanjutnya"
                                            }
                                        },
                                        dom: 'Bfrtip',
                                        buttons: [
                                            'copy',
                                            'csv',
                                            'excel',
                                            {
                                                extend: 'pdfHtml5',
                                                orientation: 'landscape',
                                                pageSize: 'LEGAL'
                                            },
                                            'print'
                                        ]
                                    });

                                    // Inisialisasi tooltip
                                    $('[data-toggle="tooltip"]').tooltip();

                                    // Event handler untuk tombol print
                                    $('#TABEL').on('click', '.btn-print', function() {
                                        var kodeTransaksi = $(this).data('id');
                                        // Panggil fungsi print disini
                                        printJurnalPerItem(kodeTransaksi);
                                    });

                                    // Tooltip aktif juga untuk child rows saat tombol + ditekan:
                                    $('#TABEL').on('responsive-display.dt', function(e, datatable, row, showHide, update) {
                                        if (showHide) {
                                            $('[data-toggle="tooltip"]').tooltip();
                                        }
                                    });
                                } else {
                                    $('#selected-items-body').html('<tr><td colspan="16" class="text-center">Tidak ada data ditemukan</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                $('#selected-items-body').html('<tr><td colspan="16" class="text-center text-danger">Error: ' + xhr.responseText + '</td></tr>');
                            }
                        });
                    });

                    // Fungsi untuk membangun definisi kolom dinamis (DataTable)
                    function buildColumnsDefinition(dynamicColumns) {
                        var columns = [{
                                data: 0,
                                className: 'text-center',
                                orderable: false
                            },
                            {
                                data: 1,
                                className: 'text-center'
                            },
                            {
                                data: 2,
                                className: 'text-center'
                            },
                            {
                                data: 3,
                                className: 'text-center'
                            }
                        ];

                        // Tambahkan kolom dinamis
                        var dynamicIndex = 4;
                        dynamicColumns.forEach(function(col) {
                            columns.push({
                                data: dynamicIndex++,
                                className: 'text-center'
                            });
                        });

                        // Tambahkan kolom tetap terakhir
                        columns.push({
                            data: dynamicIndex++,
                            className: 'text-center'
                        }, {
                            data: dynamicIndex,
                            className: 'text-center'
                        });

                        return columns;
                    }

                    // Fungsi untuk print jurnal per item
                    function printJurnalPerItem(kodeTransaksi) {
                        // Anda bisa menggunakan window.open untuk membuka halaman print
                        // atau menggunakan AJAX untuk mendapatkan data print terlebih dahulu
                        // window.open('<?php echo site_url("produk_item_jurnal/print_jurnal_per_item/"); ?>' + kodeTransaksi, '_blank');

                        // MAS JUNIYAR
                        window.open('<?php echo site_url("produk_item_jurnal/print_jurnal_item_grouped_by_area/"); ?>', '_blank');
                        // MAS JUNIYAR

                        // Atau jika ingin menggunakan modal:
                        // $('#modal-print').modal('show');
                        // $.ajax({
                        //     url: '<?php echo site_url("produk_item_jurnal/get_data_print"); ?>',
                        //     type: 'POST',
                        //     data: {KODE_TRANSAKSI: kodeTransaksi},
                        //     success: function(response) {
                        //         // Isi modal dengan data print
                        //         $('#print-content').html(response);
                        //     }
                        // });
                    }

                    // Ambil data Produk untuk ditampilkan di field #PRODUK_ITEM berdasarkan AREA_PENEMPATAN, DEPARTEMEN_PENEMPATAN, RUANGAN_PENEMPATAN, LOKASI_PENEMPATAN
                    $('#AREA_PENEMPATAN, #DEPARTEMEN_PENEMPATAN, #RUANGAN_PENEMPATAN, #LOKASI_PENEMPATAN').on('change', function() {
                        var area = $('#AREA_PENEMPATAN').val();
                        var departemen = $('#DEPARTEMEN_PENEMPATAN').val();
                        var ruangan = $('#RUANGAN_PENEMPATAN').val();
                        var lokasi = $('#LOKASI_PENEMPATAN').val();

                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_item_jurnal/get_produk_stok_by_area",
                            type: "POST",
                            dataType: "json",
                            data: {
                                AREA_PENEMPATAN: area,
                                DEPARTEMEN_PENEMPATAN: departemen,
                                RUANGAN_PENEMPATAN: ruangan,
                                LOKASI_PENEMPATAN: lokasi
                            },
                            success: function(response) {
                                if (response.success) {
                                    console.log(response.data);
                                    var $produkItem = $('#PRODUK_ITEM');
                                    $produkItem.empty().append(
                                        '<option value="" class="text-center" selected disabled>-- Pilih Item --</option>'
                                    );

                                    $.each(response.data, function(index, item) {
                                        $produkItem.append($('<option>', {
                                            value: item.KODE_ITEM,
                                            text: item.NAMA_PRODUK
                                        }));
                                    });
                                } else {
                                    var $produkItem = $('#PRODUK_ITEM');
                                    $produkItem.empty().append(
                                        '<option value="" class="text-center" selected disabled>-- Data tidak ditemukan --</option>'
                                    );

                                    $('#NAMA_ITEM').text('-');
                                    $('#KATEGORI').text('-');
                                    $('#KETERANGAN_ITEM').text('-');
                                    $('#SATUAN').text('-');
                                    $('#FOTO').html('-');
                                }
                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });
                    });

                    // Set Detail Info Produk dengan mengambil data Produk dari field #PRODUK_ITEM
                    $('#PRODUK_ITEM').on('change', function() {
                        let produkItem = $(this).val();
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "produk_item_jurnal/get_produk_by_kode_item",
                            type: "POST",
                            dataType: "json",
                            data: {
                                KODE_ITEM: produkItem
                            },
                            success: function(response) {
                                if (response.success) {
                                    let data = response.data;
                                    $('#NAMA_ITEM').text('Tidak Tersedia');
                                    $('#KATEGORI').text('Tidak Tersedia');
                                    $('#KETERANGAN_ITEM').text('Tidak Tersedia');
                                    $('#SATUAN').text('Tidak Tersedia');
                                    $('#FOTO').html('<span class="text-muted">Tidak Ada Foto</span>');

                                    if (data) {
                                        $('#NAMA_ITEM').html('<strong>' + data.NAMA_ITEM + '</strong>');
                                        $('#KATEGORI').html('<em>' + data.NAMA_PRODUK_KATEGORI + '</em>');
                                        $('#KETERANGAN_ITEM').html('<span class="text-info">' + data.KETERANGAN_ITEM + '</span>');
                                        $('#SATUAN').html('<span class="badge bg-primary text-white">' + data.SATUAN + '</span>');
                                        $('#FOTO').html('<a class="gallery-item w-25" href="<?php echo base_url('assets/uploads/item/'); ?>' + data.FOTO_ITEM + '" data-fancybox data-caption="Single image" data-image="<?php echo base_url('assets/uploads/item/'); ?>' + data.FOTO_ITEM + '" data-title="' + data.NAMA_ITEM + '"><img style="width: 100px; padding: 5px;" src="<?php echo base_url('assets/uploads/item/'); ?>' + data.FOTO_ITEM + '" alt="' + data.NAMA_ITEM + '"></a>');
                                    }

                                    // Inisialisasi Fancybox
                                    Fancybox.bind("[data-fancybox]");
                                }
                            },
                            error: function() {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        });
                    });
                });

                function generate_aset(uuid) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>" + "produk_stok/generate_aset/" + uuid,
                        type: "POST",
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.success) {
                                swal('Sukses', 'Simpan Data Berhasil!', 'success').then(function() {
                                    location.href = "<?php echo base_url(); ?>" +
                                        "produk_stok";
                                });
                            } else {
                                swal('Error', 'Tidak dapat terhubung ke server.', 'error');
                            }
                        }
                    });
                }


                function detail_stok(uuid) {

                    $.ajax({
                        url: "<?php echo base_url(); ?>" + "produk_stok/cek_aset/" + uuid,
                        type: "POST",
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.length > 0) {
                                window.location.href = "<?php echo base_url(); ?>produk_stok/detail_stok/" + uuid;
                            } else {
                                swal('Data aset tidak ditemukan', 'Lakukan generate aset terlebih dahulu', 'warning');
                            }
                        }
                    });
                }
            </script>

            </html>