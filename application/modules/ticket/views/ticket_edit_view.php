<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-white"><i class="fas fa-ticket-alt mr-2"></i>DETAIL TIKET</h4>
                        <div class="card-header-action">
                            <div class="ticket-info-badge">
                                <span class="badge badge-light">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    <?= isset($get_ticket->DATE_TICKET) ? date('d/m/Y', strtotime($get_ticket->DATE_TICKET)) : '-'; ?>
                                </span>
                                <span class="badge badge-light ml-2">
                                    ID: <?= isset($get_ticket->IDTICKET) ? $get_ticket->IDTICKET : '-'; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Baris Pertama: Informasi Compact -->
                        <div class="row mb-4">
                            <!-- Informasi Pemohon -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="compact-card">
                                    <div class="compact-card-header bg-primary text-white">
                                        <i class="fas fa-user-circle mr-2"></i>
                                        <span>Pemohon</span>
                                    </div>
                                    <div class="compact-card-body">
                                        <div class="compact-info">
                                            <small class="text-muted">Request By</small>
                                            <div class="fw-bold"><?= isset($get_ticket->REQUESTBY) ? htmlspecialchars($get_ticket->REQUESTBY) : '-'; ?></div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">Departemen</small>
                                            <div class="fw-bold"><?= isset($get_ticket->NAMA_DEPARTEMEN) ? htmlspecialchars($get_ticket->NAMA_DEPARTEMEN) : '-'; ?></div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">No. WhatsApp</small>
                                            <div class="fw-bold"><?= isset($get_ticket->TELP) ? htmlspecialchars($get_ticket->TELP) : '-'; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Lokasi -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="compact-card">
                                    <div class="compact-card-header bg-success text-white">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        <span>Lokasi</span>
                                    </div>
                                    <div class="compact-card-body">
                                        <div class="compact-info">
                                            <small class="text-muted">Area</small>
                                            <div class="fw-bold"><?= isset($get_ticket->NAMA_AREA) ? htmlspecialchars($get_ticket->NAMA_AREA) : '-'; ?></div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">Departemen Direquest</small>
                                            <div class="fw-bold">
                                                <?php
                                                $departemen_direquest = '-';
                                                foreach ($get_departement as $row) {
                                                    if ($get_ticket->DEPARTEMENT_DIREQUEST == $row->KODE_DEPARTEMEN) {
                                                        $departemen_direquest = $row->NAMA_DEPARTEMEN;
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($departemen_direquest);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Progress -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="compact-card">
                                    <div class="compact-card-header bg-info text-white">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        <span>Status & Progress</span>
                                    </div>
                                    <div class="compact-card-body">
                                        <div class="compact-info">
                                            <small class="text-muted">Status</small>
                                            <div>
                                                <?php
                                                $status_text = '';
                                                $status_class = '';
                                                switch ($get_ticket->STATUS_TICKET) {
                                                    case 0:
                                                        $status_text = 'DALAM ANTRIAN';
                                                        $status_class = 'badge-warning';
                                                        break;
                                                    case 25:
                                                        $status_text = 'SEDANG DIKERJAKAN';
                                                        $status_class = 'badge-primary';
                                                        break;
                                                    case 50:
                                                        $status_text = 'MENUNGGU VALIDASI';
                                                        $status_class = 'badge-danger';
                                                        break;
                                                    case 100:
                                                        $status_text = 'SELESAI';
                                                        $status_class = 'badge-success';
                                                        break;
                                                    default:
                                                        $status_text = 'TIDAK DIKENAL';
                                                        $status_class = 'badge-secondary';
                                                }
                                                ?>
                                                <span class="badge <?= $status_class ?> status-badge-sm"><?= $status_text ?></span>
                                            </div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">Progress</small>
                                            <div class="progress-wrapper">
                                                <?php if ($get_ticket->STATUS_TICKET != 200) : ?>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar"
                                                            style="width: <?= $get_ticket->STATUS_TICKET ?>%;"
                                                            aria-valuenow="<?= $get_ticket->STATUS_TICKET ?>"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <?= $get_ticket->STATUS_TICKET ?>%
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            0%
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">Approval</small>
                                            <div>
                                                <?php
                                                $approval_text = '';
                                                $approval_class = '';
                                                switch ($get_ticket->APPROVAL_TICKET) {
                                                    case 0:
                                                        $approval_text = 'DALAM ANTRIAN';
                                                        $approval_class = 'badge-warning';
                                                        break;
                                                    case 1:
                                                        $approval_text = 'DISETUJUI';
                                                        $approval_class = 'badge-success';
                                                        break;
                                                    case 2:
                                                        $approval_text = 'DITOLAK';
                                                        $approval_class = 'badge-danger';
                                                        break;
                                                    default:
                                                        $approval_text = 'TIDAK DIKENAL';
                                                        $approval_class = 'badge-secondary';
                                                }
                                                ?>
                                                <span class="badge <?= $approval_class ?> status-badge-sm"><?= $approval_text ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Teknisi -->
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <div class="compact-card">
                                    <div class="compact-card-header bg-warning text-white">
                                        <i class="fas fa-tools mr-2"></i>
                                        <span>Teknisi</span>
                                    </div>
                                    <div class="compact-card-body">
                                        <div class="compact-info">
                                            <small class="text-muted">Nama Teknisi</small>
                                            <div class="fw-bold">
                                                <?php
                                                $technician_name = '-';
                                                foreach ($get_technician as $row) {
                                                    if ($get_ticket->TECHNICIAN == $row->IDTECH) {
                                                        $technician_name = $row->NAME_TECHNICIAN;
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($technician_name);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="compact-info">
                                            <small class="text-muted">Tanggal Selesai</small>
                                            <div class="fw-bold">
                                                <?=
                                                (isset($get_ticket->DATE_TICKET_DONE) && !empty($get_ticket->DATE_TICKET_DONE))
                                                    ? date('d/m/Y H:i', strtotime($get_ticket->DATE_TICKET_DONE))
                                                    : '-';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Kedua: Detail Keluhan (Highlighted) -->
                        <div class="row">
                            <div class="col-12">
                                <div class="highlight-card">
                                    <div class="highlight-card-header">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        <h5 class="mb-0">Detail Keluhan</h5>
                                        <span class="badge badge-danger ml-2">PRIORITAS</span>
                                    </div>
                                    <div class="highlight-card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="highlight-info">
                                                    <div class="highlight-label">
                                                        <i class="fas fa-tags mr-2"></i>Type Keluhan
                                                    </div>
                                                    <div class="highlight-value">
                                                        <?php
                                                        if (isset($get_ticket->TYPE_TICKET) && !empty($get_ticket->TYPE_TICKET)) {
                                                            $types = explode(',', $get_ticket->TYPE_TICKET);
                                                            foreach ($types as $type) {
                                                                echo '<span class="badge badge-primary mr-1 mb-1 highlight-badge">' .
                                                                    htmlspecialchars(trim($type)) . '</span>';
                                                            }
                                                        } else {
                                                            echo '<span class="text-muted">-</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="highlight-info">
                                                    <div class="highlight-label">
                                                        <i class="fas fa-align-left mr-2"></i>Deskripsi Keluhan
                                                    </div>
                                                    <div class="highlight-value">
                                                        <div class="highlight-description">
                                                            <?= isset($get_ticket->DESCRIPTION_TICKET) ? nl2br(htmlspecialchars($get_ticket->DESCRIPTION_TICKET)) : '-'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($get_ticket->APPROVAL_TICKET == 2 && isset($get_ticket->ALASAN_DITOLAK) && !empty($get_ticket->ALASAN_DITOLAK)) : ?>
                                                <div class="col-12 col-md-12 mt-3">
                                                    <div class="highlight-info">
                                                        <div class="highlight-label text-danger">
                                                            <i class="fas fa-times-circle mr-2"></i>Alasan Ditolak
                                                        </div>
                                                        <div class="highlight-value">
                                                            <div class="highlight-rejection">
                                                                <?= htmlspecialchars($get_ticket->ALASAN_DITOLAK) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right bg-light">
                        <button type="button" onclick="history.go(-1)" class="btn btn-secondary btn-icon icon-left">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </button>
                        <!-- <button type="button" onclick="window.print()" class="btn btn-info btn-icon icon-left ml-2">
                            <i class="fas fa-print mr-1"></i> Cetak
                        </button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('layout/footer'); ?>

<style>
    /* Compact Card Styles */
    .compact-card {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        background: #fff;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 0.15rem 1rem 0 rgba(58, 59, 69, 0.1);
    }

    .compact-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 1.5rem 0 rgba(58, 59, 69, 0.15);
    }

    .compact-card-header {
        padding: 12px 15px;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .compact-card-body {
        padding: 15px;
    }

    .compact-info {
        margin-bottom: 12px;
    }

    .compact-info:last-child {
        margin-bottom: 0;
    }

    /* Highlight Card Styles */
    .highlight-card {
        border: 2px solid #e74a3b;
        border-radius: 12px;
        background: linear-gradient(135deg, #fffaf0 0%, #fff5f5 100%);
        box-shadow: 0 0.5rem 2rem 0 rgba(231, 74, 59, 0.2);
        position: relative;
        overflow: hidden;
    }

    .highlight-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
    }

    .highlight-card-header {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        color: white;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        border-radius: 10px 10px 0 0;
    }

    .highlight-card-header i {
        font-size: 1.3rem;
    }

    .highlight-card-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .highlight-card-body {
        padding: 25px;
    }

    .highlight-info {
        margin-bottom: 20px;
    }

    .highlight-info:last-child {
        margin-bottom: 0;
    }

    .highlight-label {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .highlight-label i {
        color: #e74a3b;
        width: 20px;
        text-align: center;
    }

    .highlight-value {
        color: #4a5568;
        font-weight: 500;
    }

    .highlight-description,
    .highlight-rejection {
        background: white;
        border: 1px solid #fed7d7;
        border-radius: 8px;
        padding: 20px;
        margin-top: 8px;
        line-height: 1.6;
        box-shadow: 0 2px 10px rgba(231, 74, 59, 0.1);
    }

    .highlight-rejection {
        background: #fff5f5;
        border-color: #fc8181;
        color: #c53030;
    }

    .highlight-badge {
        font-size: 0.8rem;
        padding: 8px 12px;
        border-radius: 20px;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: 2px solid white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Progress Bar Styles */
    .progress-sm {
        height: 8px;
    }

    .status-badge-sm {
        font-size: 0.7rem;
        padding: 6px 10px;
        border-radius: 15px;
    }

    .progress-wrapper {
        width: 100%;
    }

    .progress {
        border-radius: 10px;
        background: #eaecf4;
    }

    .progress-bar {
        border-radius: 10px;
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }

    /* Header Styles */
    .ticket-info-badge {
        display: flex;
        align-items: center;
    }

    .card-header.bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
        border-bottom: none;
    }

    @media (max-width: 768px) {

        .compact-card-header,
        .highlight-card-header {
            flex-direction: column;
            text-align: center;
            gap: 5px;
        }

        .ticket-info-badge {
            flex-direction: column;
            align-items: flex-start;
        }

        .ticket-info-badge .badge {
            margin-bottom: 5px;
        }

        .highlight-label {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        console.log("Halaman view tiket loaded");

        // Animasi progress bar
        $('.progress-bar').each(function() {
            var progressValue = $(this).attr('aria-valuenow');
            $(this).css('width', '0%').animate({
                width: progressValue + '%'
            }, 1000);
        });

        // Efek highlight pada card keluhan
        $('.highlight-card').hover(
            function() {
                $(this).css('transform', 'scale(1.01)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );
    });
</script>
</body>

</html>