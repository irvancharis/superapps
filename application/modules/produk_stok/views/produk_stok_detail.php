            <!-- Main Content -->

            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>DETAIL PRODUK STOK</h4>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-2">QR</th>
                                                    <th>NAMA PRODUK</th>
                                                    <th class="text-center col-2">PIC</th>
                                                    <th class="text-center col-2">FOTO ITEM</th>
                                                    <th class="text-center col-2"><button
                                                            class="btn btn-outline-secondary"
                                                            onclick="window.open('<?php echo base_url('produk_stok/print_qr_aset/'.$this->uri->segment(3)) ?>','_blank')"><i
                                                                class="fas fa-print"></i></button></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($aset as $index => $d) : ?>
                                                <tr>
                                                    <td>
                                                        <center><img width="120px"
                                                                src="<?php echo base_url('produk_stok/qr_link/'.$d->UUID_STOK.'/'.$d->UUID_ASET)?>"
                                                                alt=""></center>
                                                    </td>
                                                    <td><?php echo $d->NAMA_PRODUK; ?></td>
                                                    <td><?php echo $d->NAMA_PIC; ?></td>
                                                    <td class="text-center col-2">
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
                                                    </td>
                                                    <td class="text-center col-2">
                                                        <label
                                                            onclick="detail_stok('<?php echo $d->UUID_STOK; ?>','<?php echo $d->UUID_ASET; ?>')"
                                                            class="btn btn-outline-primary" id="btn-show-produk"> <i
                                                                class="fa fa-eye"></i> CEK HISTORI
                                                        </label>
                                                        <label class="btn btn-outline-secondary"
                                                            onclick="window.open('<?php echo base_url('produk_stok/print_qr_single/'.$d->UUID_ASET) ?>','_blank')"><i
                                                                class="fas fa-print"></i>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
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
$('#tabel').dataTable({
    paging: false,
    searching: true,
    info: false
});

function detail_stok(UUID_STOK, UUID_ASET) {
    window.open("<?php echo base_url('produk_stok/produk_aset_histori/') ?>" + UUID_STOK + "/" + UUID_ASET, '_blank');
}
            </script>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>