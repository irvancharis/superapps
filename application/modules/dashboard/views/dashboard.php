<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 80%;
    justify-content: center;
}
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="card">
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('layout/footer'); ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stockData = {
        labels: ["Barang A", "Barang B", "Barang C", "Barang D", "Barang E"],
        datasets: [{
            label: "Daftar Produk Limit Stok",
            data: [5, 2, 7, 2, 9],
            backgroundColor: "#8884d8"
        }]
    };


    new Chart(document.getElementById("stockChart"), {
        type: "bar",
        data: stockData
    });
});
</script>