            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form class="needs-validation" novalidate=""
                                    id="FORM_TRANSAKSI_PENGADAAN_PROSES_PENGADAAN">
                                    <div class="card-header">
                                        <h4>TRANSAKSI PENGADAAN - PENERIMAAN KIRIMAN BARANG</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <tr>
                                                    <th class="col-2">AREA</th>
                                                    <td><?= $m_kiriman_barang->NAMA_AREA; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>DEPARTEMEN</th>
                                                    <td><?= $m_kiriman_barang->NAMA_DEPARTEMEN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>RUANGAN</th>
                                                    <td><?= $m_kiriman_barang->NAMA_RUANGAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>LOKASI</th>
                                                    <td><?= $m_kiriman_barang->NAMA_LOKASI; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>KETERANGAN PENGAJUAN</th>
                                                    <td><?= $m_kiriman_barang->KETERANGAN_PENGAJUAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>NO. REGISTER</th>
                                                    <td><?= $m_kiriman_barang->NO_REGISTER; ?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm" id="table-approval-produk">
                                                <thead>
                                                    <tr>
                                                        <th class="col-2">FOTO PRODUK</th>
                                                        <th>PRODUK/ITEM</th>
                                                        <th class="col-1">JUMLAH</th>
                                                        <th class="col-3">KEPERLUAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="selected-items-body">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="form-group col-12 col-md-12 col-lg-6 text-center ">
                                                <br>
                                                <br>
                                                <center>
                                                    <label>NO.RESI / KODE PENGIRIMAN</label><span
                                                        class="text-danger float-right font-italic font-weight-600"></span>
                                                    <input autofocus required type="text" class="form-control"
                                                        id="NO_RESI" name="NO_RESI"
                                                        value="<?= $m_kiriman_barang->NO_RESI; ?>">
                                                    <input type="hidden" class="form-control" id="NO_RESI"
                                                        name="KODE_USER_PENERIMA_KIRIMAN"
                                                        value="<?= $this->session->userdata('ID_KARYAWAN') ?>">
                                                    <div class="invalid-feedback">
                                                        Masukkan NO. RESI !
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center row">
                                        <!-- Tombol PROSES PENGADAAN di tengah -->
                                        <div class="col-12 col-md-8 col-lg-7 col-xl-7 mb-2 mb-md-0 text-md-right">
                                            <button type="submit" class="btn btn-success" id="btn-approve"><i
                                                    class="fa fa-check"></i> TERIMA KIRIMAN BARANG</button>
                                        </div>

                                        <!-- Tombol KEMBALI di kanan -->
                                        <div class="col-12 col-md-4 col-lg-5 col-xl-5 text-md-right">
                                            <a href="<?php echo base_url(); ?>transaksi_pengadaan"
                                                class="btn btn-secondary"><i class="fa fa-arrow-left"></i> KEMBALI</a>
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
    console.log('<?php echo $this->session->userdata('ID_KARYAWAN'); ?>');

    $('#table-approval-produk').DataTable({
        paging: false,
        searching: false,
        sorting: false,
        ordering: false,
        info: false,
        responsive: {
            details: {
                type: 'column',
                display: $.fn.dataTable.Responsive.display
                    .childRowImmediate, // Menampilkan detail langsung                
            }
        }
    });

    let idTransaksi = "<?php echo $id_transaksi_pengadaan; ?>"; // ID transaksi dari PHP

    $('#NO_RESI').on('change', function() {
        saveFormData();
    })

    function loadSelectedItems() {
        let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
        let tbody = $("#selected-items-body");
        tbody.empty();

        selectedItems.forEach(function(item, index) {
            tbody.append(`
                                <tr data-index="${index}">
                                    <input type="hidden" name="KODE_PRODUK_ITEM[${index}]" value="${item.id}">
                                    <td class="text-center">
                                    <img style="width: 100px;" src="<?php echo base_url('assets/uploads/item/'); ?>${item.foto}" alt="">
                                    </td>
                                    <td>${item.nama}</td>
                                    <td class="text-center col-1"><input type="number" class="form-control jumlah" name="JUMLAH_PENGADAAN[${index}]" value="${item.jumlah || ''}" disabled></td>
                                    <td class="text-center col-3"><input type="text" class="form-control keperluan" name="KEPERLUAN[${index}]" value="${item.keperluan || ''}" disabled></td>
                                </tr>
                            `);
        });
        attachInputListeners();

        // Initialize Chocolate JS
        if (jQuery().Chocolat) {
            $(".gallery").Chocolat({
                className: 'gallery',
                imageSelector: '.gallery-item',
                imageSize: 'contain', // Menyesuaikan gambar agar pas dalam layar
                fullScreen: false, // Tidak otomatis fullscreen
                backgroundColor: 'rgba(0,0,0,0.9)', // Background gelap
            });
        }
    }

    function loadDataFromDB() {
        // Cek apakah sudah ada flag bahwa data sudah di-load dari DB
        if (sessionStorage.getItem("dbDataLoaded")) {
            console.log("Data dari database sudah dimuat sebelumnya. Skip pengambilan ulang.");
            loadSelectedItems();
            return;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>transaksi_pengadaan/get_data_transaksi_detail/" +
                idTransaksi,
            type: "GET",
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    let storedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
                    let dbItems = res.data.map(item => ({
                        id: item.KODE_PRODUK_ITEM,
                        nama: item.NAMA_ITEM,
                        jumlah: item.JUMLAH_PENGADAAN,
                        keperluan: item.KEPERLUAN,
                        foto: item.FOTO_ITEM
                    }));

                    // Gabungkan data, tetapi hanya simpan yang tidak duplikat
                    let mergedItems = [...dbItems, ...storedItems].reduce((acc, curr) => {
                        if (!acc.some(item => item.id === curr.id)) {
                            acc.push(curr);
                        }
                        return acc;
                    }, []);

                    localStorage.setItem("selectedItems", JSON.stringify(mergedItems));

                    // Tandai bahwa data dari database sudah dimasukkan ke localStorage
                    sessionStorage.setItem("dbDataLoaded", "true");

                    loadSelectedItems();
                }
            }
        });
    }

    loadDataFromDB();

    // Fungsi untuk menangani input perubahan data
    function attachInputListeners() {
        $('.jumlah, .keperluan').on('input', function() {
            let rowIndex = $(this).closest('tr').data('index');
            let fieldName = $(this).hasClass('jumlah') ? 'jumlah' : 'keperluan';

            let selectedItems = JSON.parse(localStorage.getItem("selectedItems")) || [];
            selectedItems[rowIndex][fieldName] = $(this).val();
            localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
        });
    }

    // Form Data Save to Local Storage
    function saveFormData() {
        let formData = {
            NO_RESI: $('#NO_RESI').val(),
        };

        localStorage.setItem('formPengadaan', JSON.stringify(formData));
    }

    // Update data ke database
    $('#FORM_TRANSAKSI_PENGADAAN_PROSES_PENGADAAN').on('submit', function(e) {
        e.preventDefault();

        let selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
        let formData = JSON.parse(localStorage.getItem('formPengadaan')) || [];

        if (selectedItems.length == 0) {
            swal('Error', 'Tidak ada produk yang dipilih.', 'error');
            return;
        }

        if (!formData.NO_RESI) {
            swal('Error', 'Lengkapi semua data.', 'error');
            return;
        }

        // Kirim data untuk update
        $.ajax({
            url: "<?php echo base_url(); ?>transaksi_pengadaan/update_m_kiriman_barang", // Ubah menjadi update
            type: "POST",
            data: {
                id_transaksi: idTransaksi, // Kirim ID transaksi agar dapat diupdate
                items: selectedItems,
                form: formData
            },
            success: function(response) {
                let res = JSON.parse(response);
                if (res.success) {
                    swal('Sukses', 'Pengadaan Berhasil Di Proses!', 'success').then(
                        function() {
                            localStorage.removeItem(
                                'selectedItems'); // Hapus localStorage setelah disimpan
                            localStorage.removeItem(
                                'formPengadaan'); // Hapus localStorage setelah disimpan
                            sessionStorage.removeItem(
                                "dbDataLoaded"); // Hapus localStorage setelah disimpan
                            location.href = "<?php echo base_url(); ?>" +
                                "transaksi_pengadaan";
                        });
                } else {
                    swal('Gagal', res.error, 'error');
                }
            },
            error: function() {
                swal('Error', 'Terjadi kesalahan pada server.', 'error');
            }
        });
    });
});

// Hapus semua data localStorage & sessionStorage ketika user meninggalkan halaman
$(window).on('beforeunload', function() {
    localStorage.clear(); // Hapus semua data localStorage
    sessionStorage.clear(); // Hapus semua data sessionStorage
});
            </script>
            </body>

            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>