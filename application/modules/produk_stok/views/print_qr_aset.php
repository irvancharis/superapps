<?php

    foreach ($aset as $d) {
        $uuid = $d->UUID_ASET;
        ?>

            <img width="100px" src="<?php echo base_url('produk_stok/qr/'.$uuid) ?>" alt="" style="float: left; margin-right: 10px;padding: 5px; border: 1px solid #000; border-radius: 5px;">
                   
<?php
    }
?>


<script type="text/javascript">
    window.print();
</script>