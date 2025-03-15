<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SAGROUP</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bundles/datatables/datatables.min.css') ?>">


    <!-- Main Content -->

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card-body">
            <h4 class="text-center" style="border-bottom:1px solid rgb(228, 228, 228)">
                DATA PRODUK</h4>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel">
                    <thead>
                        <tr>
                            <th class="text-center col-2">FOTO ITEM</th>
                            <th class="text-center col-1">KODE PRODUK</th>
                            <th>NAMA PRODUK</th>
                            <th class="col-1">JUMLAH STOK</th>
                            <th class="text-center col-1">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $index => $d) : ?>
                        <tr>
                            <td class="text-center col-1">
                                <input type="hidden" name="UUID_STOK[]" value="<?php echo $d->UUID_STOK; ?>">
                                <input type="hidden" name="KODE_ITEM[]" value="<?php echo $d->KODE_ITEM; ?>">
                                <input type="hidden" name="FOTO_ITEM[]" value="<?php echo $d->FOTO_ITEM; ?>">
                                <input type="hidden" name="NAMA_PRODUK[]" value="<?php echo $d->NAMA_PRODUK; ?>">
                                <input type="hidden" name="JUMLAH_STOK[]" value="<?php echo $d->JUMLAH_STOK; ?>">

                                <img width="150px" style="cursor: pointer;"
                                    src="<?php echo base_url('assets/uploads/item/') . $d->FOTO_ITEM; ?>"
                                    alt="Thumbnail" class="thumbnail" onclick="showPopup(this)">

                                <script>
                                function showPopup(img) {
                                    let popupDiv = document.createElement("div");
                                    popupDiv.style.position = "fixed";
                                    popupDiv.style.top = "0";
                                    popupDiv.style.left = "0";
                                    popupDiv.style.width = "100%";
                                    popupDiv.style.height = "100%";
                                    popupDiv.style.background = "rgba(255, 255, 255, 0.82)";
                                    popupDiv.style.display = "flex";
                                    popupDiv.style.justifyContent = "center";
                                    popupDiv.style.alignItems = "center";
                                    popupDiv.style.cursor = "pointer";
                                    popupDiv.style.zIndex = "9999";

                                    let popupImg = document.createElement("img");
                                    popupImg.src = img.src;
                                    popupImg.style.maxWidth = "100%";
                                    popupImg.style.maxHeight = "100%";
                                    popupImg.style.borderRadius = "10px";
                                    popupImg.style.zIndex = "10000";

                                    popupDiv.appendChild(popupImg);
                                    popupDiv.onclick = function() {
                                        document.body.removeChild(popupDiv);
                                    };

                                    document.body.appendChild(popupDiv);
                                }
                                </script>

                            </td>
                            <td class="text-center"><?php echo $d->KODE_ITEM; ?></td>
                            <td><?php echo $d->NAMA_PRODUK; ?></td>
                            <td class="text-center"><?php echo $d->JUMLAH_STOK; ?></td>
                            <td class="text-center col-1">
                                <a href="#" class="btn btn-primary addItem"
                                    data-kode="<?php echo $d->KODE_ITEM; ?>">Tambah</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- General JS Scripts -->
        <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>

        <script src="<?php echo base_url('assets/bundles/datatables/datatables.min.js') ?>"></script>
        <!-- Page Specific JS File -->

        </body>


        <script>
        document.addEventListener("DOMContentLoaded", function() {
            let storedProdukItems = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

            document.querySelectorAll(".addItem").forEach(function(button) {
                let kodeItem = button.getAttribute("data-kode");

                // Cek apakah produk sudah ada di localStorage
                let isExist = storedProdukItems.some(item => item.KODE_ITEM === kodeItem);

                if (isExist) {
                    button.style.display = "none"; // Sembunyikan tombol jika sudah ada
                }
            });
        });

        $('#tabel').dataTable({
            paging: false,
            searching: true,
            info: false
        });

        $('#tabel_filter input').focus();

        $('.addItem').on('click', function() {
            let dataItem = JSON.parse(localStorage.getItem('storedProdukItems')) || [];

            // Ambil UUID_STOK dari input
            let newUUID = $(this).closest('tr').find('td').find('input').eq(0).val();

            // Cek apakah UUID_STOK sudah ada dalam dataItem
            let isExist = dataItem.some(item => item.UUID_STOK === newUUID);

            if (isExist) {
                alert('Produk ini sudah ditambahkan!');
            } else {
                // Jika belum ada, tambahkan ke dalam array
                dataItem.push({
                    UUID_STOK: newUUID,
                    KODE_ITEM: $(this).closest('tr').find('td').find('input').eq(1).val(),
                    FOTO_ITEM: $(this).closest('tr').find('td').find('input').eq(2).val(),
                    NAMA_PRODUK: $(this).closest('tr').find('td').find('input').eq(3).val(),
                    JUMLAH_STOK: $(this).closest('tr').find('td').find('input').eq(4).val(),
                });

                // Simpan kembali ke localStorage
                localStorage.setItem('storedProdukItems', JSON.stringify(dataItem));
                this.style.display = "none";
                window.parent.postMessage({
                    action: 'updateTable'
                }, '*');
            }
        });

        function detail_stok(UUID_STOK, UUID_ASET) {
            window.open("<?php echo base_url('produk_stok/produk_aset_histori/') ?>" + UUID_STOK + "/" + UUID_ASET,
                '_blank');
        }
        </script>


        <!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>