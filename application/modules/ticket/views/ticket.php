            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Ticketing</h4>
                                    <div class="card-header-action">
                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Sementara Dinonaktifkan"><a href="<?php echo base_url('ticket/tambah_view') ?>" class="btn btn-primary disabled"><i class="fas fa-plus"></i> Tambah Data</a></span>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('NAMA_ROLE') == 'IT' || $this->session->userdata('NAMA_ROLE') == 'IT KABAG'): ?>
                                    <div class="card-body">
                                        <ul class="nav nav-pills mb-4" id="myTab3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="all-tab3" data-toggle="tab" href="#all3" role="tab"
                                                    aria-controls="all" aria-selected="false"><i class="fas fa-list"></i> All <span class="badge badge-primary"><?php echo $JML_ALL->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                                    aria-controls="home" aria-selected="true"><i class="fas fa-spinner"></i> Dalam Antrian <span class="badge badge-primary"><?php echo $JML_DALAM_ANTRIAN->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                                    aria-controls="profile" aria-selected="false"><i class="fas fa-check"></i> Disetujui <span class="badge badge-primary"><?php echo $JML_DISETUJUI->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                                    aria-controls="contact" aria-selected="false"><i class="fas fa-times"></i> Ditolak <span class="badge badge-primary"><?php echo $JML_DITOLAK->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="sedang_dikerjakan-tab3" data-toggle="tab" href="#sedang_dikerjakan3" role="tab"
                                                    aria-controls="sedang_dikerjakan" aria-selected="false"><i class="fas fa-spinner"></i> Sedang Dikerjakan <span class="badge badge-primary"><?php echo $JML_SEDANG_DIKERJAKAN->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="menunggu_validasi-tab3" data-toggle="tab" href="#menunggu_validasi3" role="tab"
                                                    aria-controls="menunggu_validasi" aria-selected="false"><i class="fas fa-spinner"></i> Menunggu Validasi <span class="badge badge-primary"><?php echo $JML_MENUNGGU_VALIDASI->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="selesai-tab3" data-toggle="tab" href="#selesai3" role="tab"
                                                    aria-controls="selesai" aria-selected="false"><i class="fas fa-check"></i> Selesai <span class="badge badge-primary"><?php echo $JML_SELESAI->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade" id="all3" role="tabpanel" aria-labelledby="all-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-all">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_ALL as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($d->STATUS_TICKET != 200) : ?>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                            </div>
                                                                        <?php else : ?>
                                                                            <span class="badge badge-danger">Ditolak</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <a href="javascript:void(0)" class="dropdown-item has-icon btnHapus" data-id="<?php echo $d->IDTICKET; ?>"> <i class="fas fa-trash-alt"></i> Hapus</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-dalam-antrian">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_DALAM_ANTRIAN as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-disetujui">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_DISETUJUI as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-ditolak">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_DITOLAK as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($d->STATUS_TICKET != 200) : ?>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                            </div>
                                                                        <?php else : ?>
                                                                            <span class="badge badge-danger">Ditolak</span>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="sedang_dikerjakan3" role="tabpanel" aria-labelledby="sedang-dikerjakan-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-sedang-dikerjakan">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_SEDANG_DIKERJAKAN as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="menunggu_validasi3" role="tabpanel" aria-labelledby="menunggu-validasi-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-menunggu-validasi">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_MENUNGGU_VALIDASI as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="selesai3" role="tabpanel" aria-labelledby="selesai-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-selesai">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_SELESAI as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($this->session->userdata('NAMA_ROLE') == 'IT TEKNISI'): ?>
                                    <div class="card-body">
                                        <ul class="nav nav-pills mb-4" id="myTab3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="all-tab3" data-toggle="tab" href="#all3" role="tab"
                                                    aria-controls="all" aria-selected="false"><i class="fas fa-list"></i> All Teknisi <span class="badge badge-primary"><?php echo $JML_ALL->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                                    aria-controls="home" aria-selected="true"><i class="fas fa-spinner"></i> Dalam Antrian <span class="badge badge-primary"><?php echo $JML_DALAM_ANTRIAN->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                                    aria-controls="profile" aria-selected="false"><i class="fas fa-tools"></i> Sedang Dikerjakan <span class="badge badge-primary"><?php echo $JML_SEDANG_DIKERJAKAN->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                                    aria-controls="contact" aria-selected="false"><i class="fas fa-hourglass-half"></i> Menunggu Validasi <span class="badge badge-primary"><?php echo $JML_MENUNGGU_VALIDASI->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="selesai-tab3" data-toggle="tab" href="#selesai3" role="tab"
                                                    aria-controls="selesai" aria-selected="false"><i class="fas fa-check"></i> Selesai <span class="badge badge-primary"><?php echo $JML_SELESAI->JUMLAH_TICKET; ?></span></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade" id="all3" role="tabpanel" aria-labelledby="all-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-all">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_ALL_TECHNICIAN as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-dalam-antrian">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_DALAM_ANTRIAN as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-disetujui">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_SEDANG_DIKERJAKAN as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-ditolak">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_MENUNGGU_VALIDASI as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="selesai3" role="tabpanel" aria-labelledby="selesai-tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-ticket" id="table-ticket-selesai">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center pt-3">
                                                                    <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                                            class="custom-control-input" id="checkbox-all">
                                                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>ID TICKET</th>
                                                                <th>ORDER BY</th>
                                                                <th>LOKASI</th>
                                                                <th>APPROVAL</th>
                                                                <th>TEKNISI</th>
                                                                <th>STATUS</th>
                                                                <th>CLEAR AT</th>
                                                                <th>ACTION</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($M_TICKET_SELESAI as $index => $d) : ?>
                                                                <tr onclick>
                                                                    <td class="text-center pt-2">
                                                                        <div class="custom-checkbox custom-control">
                                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                                                id="checkbox-1">
                                                                            <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $index + 1; ?></td>
                                                                    <td><?php echo $d->IDTICKET; ?></td>
                                                                    <td><?php echo strtoupper($d->REQUESTBY); ?></td>
                                                                    <td><?php echo $d->NAMA_AREA; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($d->APPROVAL_TICKET == 0) {
                                                                            echo '<span class="badge badge-warning">Dalam Antrian</span>';
                                                                        } elseif ($d->APPROVAL_TICKET == 1) {
                                                                            echo '<span class="badge badge-success">Disetujui</span>';
                                                                        } else {
                                                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php if ($d->NAME_TECHNICIAN == null) : ?>
                                                                            <span>-</span>
                                                                        <?php else : ?>
                                                                            <?php echo strtoupper($d->NAME_TECHNICIAN); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="<?php echo $d->STATUS_TICKET; ?>" aria-valuemin="0" aria-valuemax="100" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><?php echo $d->STATUS_TICKET; ?>%</div>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?php
                                                                            if (!empty($d->DATE_TICKET_DONE)) {
                                                                                $date_done = new DateTime($d->DATE_TICKET_DONE);
                                                                                $now = new DateTime($d->DATE_TICKET);
                                                                                $diff = $now->diff($date_done);

                                                                                // Format hasil: "X hari, Y jam, Z menit"
                                                                                echo "{$diff->d} hari, {$diff->h} jam, {$diff->i} menit";
                                                                            } else {
                                                                                echo "-"; // Jika tidak ada tanggal, tampilkan tanda "-"
                                                                            }
                                                                            ?></td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <?php if ($this->session->userdata('NAMA_ROLE') == 'IT') : ?>
                                                                                <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Detail</a>
                                                                                <div class="dropdown-menu">
                                                                                    <!-- <a href="<?php echo base_url() . 'ticket/ticket_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon view-btn"><i class="fas fa-eye"></i> View</a> -->
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/edit_view/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="far fa-edit"></i> Cek Approval</a>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/view_ticket/' . $d->IDTICKET ?>" class="dropdown-item has-icon edit-btn"><i class="fas fa-file-alt"></i> Cek Ticket</a>
                                                                                    <?php endif; ?>
                                                                                    <a href="<?php echo base_url() . 'ticket/ticket_admin/' . $d->IDTICKET ?>" class="dropdown-item has-icon"> <i class="fas fa-hourglass-half"></i> Lihat Progress</a>
                                                                                    <!-- <a href="#" class="dropdown-item has-icon update-approval" data-id="<?php echo $d->IDTICKET; ?>" data-approval="<?php echo $d->APPROVAL_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Update Approval</a> -->
                                                                                    <!-- <a href="javascript:void(0)" class="dropdown-item has-icon update-status <?php echo ($d->APPROVAL_TICKET == 0) ? 'd-none' : 'd-block'; ?>" data-id="<?php echo $d->IDTICKET; ?>" data-status="<?php echo $d->STATUS_TICKET; ?>"><i class="fas fa-hourglass-half"></i> Proses Ticket</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="#" class="dropdown-item has-icon text-danger hapus-btn" data-id="<?php echo $d->IDTICKET; ?>" data-toggle="modal" data-target="#hapusModal"><i class="far fa-trash-alt"></i>
                                                                            Delete</a> -->
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($d->STATUS_TICKET == 100) : ?>
                                                                                    <span class="d-inline-block" data-toggle="tooltip" data-title="Selesai"><a href="javascript:void(0)" class="btn btn-success has-icon disabled"> <i class="fas fa-check"></i> Selesai</a></span>
                                                                                <?php else : ?>
                                                                                    <?php if ($d->APPROVAL_TICKET == 0) : ?>
                                                                                        <span class="d-inline-block" data-toggle="tooltip" data-title="Belum Disetujui"><a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon disabled"> <i class="fas fa-hourglass-half"></i> Proses</a></span>
                                                                                    <?php else : ?>
                                                                                        <a href="<?php echo base_url() . 'ticket/ticket_technician/' . $d->IDTICKET ?>" class="btn btn-primary has-icon"> <i class="fas fa-hourglass-half"></i> Proses</a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                        <span class="selectgroup-button">Light</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                        <span class="selectgroup-button">Dark</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                        <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Color Theme</h6>
                                <div class="theme-setting-options">
                                    <ul class="choose-theme list-unstyled mb-0">
                                        <li title="white" class="active">
                                            <div class="white"></div>
                                        </li>
                                        <li title="cyan">
                                            <div class="cyan"></div>
                                        </li>
                                        <li title="black">
                                            <div class="black"></div>
                                        </li>
                                        <li title="purple">
                                            <div class="purple"></div>
                                        </li>
                                        <li title="orange">
                                            <div class="orange"></div>
                                        </li>
                                        <li title="green">
                                            <div class="green"></div>
                                        </li>
                                        <li title="red">
                                            <div class="red"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="mini_sidebar_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Mini Sidebar</span>
                                    </label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                            id="sticky_header_setting">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="control-label p-l-10">Sticky Header</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                    <i class="fas fa-undo"></i> Restore Default
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            </div>


            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Hapus Data Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formHapusTicket">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id_ticket_hapus" class="form-control" placeholder="ID" name="id_ticket_hapus">
                                    <p class="text-center">Apakah anda yakin ingin menghapus data ini?</p>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary" id="btnSimpan">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php $this->load->view('layout/footer'); ?>

            <script>
                $(document).ready(function() {
                    // DataTable
                    let table = $('.table-ticket').DataTable();

                    $('.hapus-btn').on('click', function() {
                        const id = $(this).data('id');

                        // Isi form di modal edit
                        $('#id_ticket_hapus').val(id);
                    });

                    $('#formHapusTicket').on('submit', function(e) {
                        e.preventDefault();

                        // Ambil data dari form
                        let formData = $(this).serialize();

                        // Kirim data ke server melalui AJAX
                        $.ajax({
                            url: "<?php echo base_url(); ?>" + "ticket/hapus", // Endpoint untuk proses input
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

                    // Fungsi untuk inisialisasi Progress Bar
                    function initializeProgressBars() {
                        $(".progress-bar").each(function() {
                            const id = $(this).data("id");
                            const progressValue = $(this).data("status");
                            if (progressValue !== undefined) {
                                updateProgressBar(id, progressValue);
                            }
                        });
                    }

                    // Inisialisasi Progress Bar saat halaman pertama kali dimuat
                    initializeProgressBars();

                    // Inisialisasi ulang Progress Bar setiap kali DataTable mengganti halaman
                    table.on('draw', function() {
                        initializeProgressBars();
                    });

                    // Update Status Ticket
                    $(".update-status").click(function() {
                        let id_ticket = $(this).data("id");
                        let currentStatus = $(this).data("status");

                        swal({
                            title: "Proses Ticket",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: `
                                        <div class="form-group">
                                            <div class="selectgroup selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="0" class="selectgroup-input-radio" id="status0" disabled>
                                                    <span class="selectgroup-button status" id="label-status0">DALAM ANTRIAN</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="25" class="selectgroup-input-radio" id="status1" disabled>
                                                    <span class="selectgroup-button status" id="label-status1">SEDANG DIKERJAKAN</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="50" class="selectgroup-input-radio" id="status2" disabled>
                                                    <span class="selectgroup-button status" id="label-status2">MENUNGGU VALIDASI</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status_ticket" value="100" class="selectgroup-input-radio" id="status3" disabled>
                                                    <span class="selectgroup-button status" id="label-status3">SELESAI</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="KETERANGAN">KETERANGAN</label>
                                            <input type="text" class="form-control" id="KETERANGAN" name="KETERANGAN" required>
                                        </div>
                                    `
                                }
                            },
                            buttons: {
                                cancel: "Batal",
                                confirm: {
                                    text: "Update",
                                    closeModal: false,
                                    className: "btn-update-status",
                                    value: true,
                                    attributes: {
                                        disabled: "disabled" // Awalnya tombol Update dinonaktifkan
                                    }
                                }
                            },
                            closeOnClickOutside: false
                        }).then((confirm) => {
                            if (confirm) {
                                let selectedStatus = $("input[name='status_ticket']:checked").val();
                                let keterangan = $("#KETERANGAN").val();

                                if (!selectedStatus) {
                                    swal("Pilih status terlebih dahulu!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                if (!keterangan) {
                                    swal("Masukkan keterangan!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                // Kirim data ke backend via AJAX
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "ticket/updateStatus",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        status_ticket: selectedStatus,
                                        id_ticket: id_ticket,
                                        prosentase: selectedStatus, // Progress sama dengan status
                                        keterangan: keterangan
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Status tiket berhasil diperbarui.", "success")
                                                .then(() => {
                                                    updateProgressBar(id_ticket, selectedStatus);
                                                    location.reload();
                                                });
                                        } else {
                                            swal("Gagal!", response.error, "error");
                                        }
                                    },
                                    error: function() {
                                        swal("Error!", "Tidak dapat terhubung ke server.", "error");
                                    }
                                });
                            }
                        });

                        // Set radio button sesuai status dari database setelah SweetAlert selesai render
                        setTimeout(() => {
                            $(`input[name='status_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");

                            // Pastikan tombol Update tetap disabled saat pertama kali terbuka
                            $(".btn-update-status").prop("disabled", true);
                        }, 500);

                        // Event listener untuk input KETERANGAN
                        $(document).on("input", "#KETERANGAN", function() {
                            let isFilled = $(this).val().trim() !== "";
                            $(".btn-update-status").prop("disabled", !isFilled);

                            if (isFilled) {
                                if ($(this).val().toLowerCase().includes("validasi")) {
                                    // CEK JIKA ISI INPUTAN MENGANDUNG KATA "VALIDASI" MAKA SET status_ticket = 50
                                    $(`input[name='status_ticket'][value='50']`).prop("checked", true).trigger("change");
                                    return;
                                } else if ($(this).val().toLowerCase().includes("selesai")) {
                                    // CEK JIKA ISI INPUTAN MENGANDUNG KATA "SELESAI" MAKA SET status_ticket = 100
                                    $(`input[name='status_ticket'][value='100']`).prop("checked", true).trigger("change");
                                    return;
                                } else {
                                    // CEK JIKA ISI INPUT KETERANGAN TIDAK KOSONG AUTO SET status_ticket = 25
                                    $(`input[name='status_ticket'][value='25']`).prop("checked", true).trigger("change");
                                }
                            }
                        });
                    });


                    // Fungsi untuk update tampilan progress bar
                    function updateProgressBar(id, progressValue) {
                        $(`.progress-bar[data-id='${id}']`)
                            .css("width", progressValue + "%")
                            .attr("aria-valuenow", progressValue)
                            .text(progressValue + "%");
                    }

                    // Fungsi untuk mengatur kelas warna ketika radio button dipilih
                    $(document).on("change", "input[name='status_ticket']", function() {
                        $('.status').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        if ($('#status0').is(':checked')) {
                            $('#label-status0').addClass('bg-warning text-white');
                        } else if ($('#status1').is(':checked')) {
                            $('#label-status1').addClass('bg-info text-white');
                        } else if ($('#status2').is(':checked')) {
                            $('#label-status2').addClass('bg-danger text-white');
                        } else if ($('#status3').is(':checked')) {
                            $('#label-status3').addClass('bg-success text-white');
                        }

                        let progressValue = $(this).val();
                        updateProgressBar(progressValue);
                    });


                    // Update Approval Ticket
                    $(".update-approval").click(function() {
                        let id_ticket = $(this).data("id");

                        // Ambil status tiket dari atribut data
                        let currentStatus = $(this).data("approval");

                        swal({
                            title: "Update Approval Ticket",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: `
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="0" class="selectgroup-input-radio" id="approval0">
                                            <span class="selectgroup-button approval" id="label-approval0">DALAM ANTRIAN</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="1" class="selectgroup-input-radio" id="approval1">
                                            <span class="selectgroup-button approval" id="label-approval1">DISETUJUI</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="approval_ticket" value="2" class="selectgroup-input-radio" id="approval2">
                                            <span class="selectgroup-button approval" id="label-approval2">DITOLAK</span>
                                        </label>
                                    </div>
                                `
                                }
                            },
                            buttons: {
                                cancel: "Batal",
                                confirm: {
                                    text: "Update",
                                    closeModal: false
                                }
                            },
                            closeOnClickOutside: false
                        }).then((confirm) => {
                            if (confirm) {
                                let selectedStatus = $("input[name='approval_ticket']:checked").val();
                                if (!selectedStatus) {
                                    swal("Pilih Approval terlebih dahulu!", {
                                        icon: "warning"
                                    });
                                    return;
                                }

                                // Kirim data ke backend via AJAX
                                $.ajax({
                                    url: "<?php echo base_url(); ?>" + "ticket/updateApproval",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        approval_ticket: selectedStatus,
                                        id_ticket: id_ticket,
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Approval berhasil diperbarui.", "success")
                                                .then(() => {
                                                    // Reload halaman setelah update sukses
                                                    location.reload();
                                                });
                                        } else {
                                            swal("Gagal!", response.error, "error");
                                        }
                                    },
                                    error: function() {
                                        swal("Error!", "Tidak dapat terhubung ke server.", "error");
                                    }
                                });
                            }
                        });

                        // Tunggu SweetAlert selesai render, lalu set radio button sesuai status dari database
                        setTimeout(() => {
                            $(`input[name='approval_ticket'][value='${currentStatus}']`).prop("checked", true).trigger("change");
                        }, 500);
                    });

                    // Fungsi untuk mengatur kelas warna ketika radio button dipilih
                    $(document).on("change", "input[name='approval_ticket']", function() {
                        $('.approval').removeClass('bg-warning bg-info bg-danger bg-success text-white');

                        if ($('#approval0').is(':checked')) {
                            $('#label-approval0').addClass('bg-warning text-white');
                        } else if ($('#approval1').is(':checked')) {
                            $('#label-approval1').addClass('bg-success text-white');
                        } else if ($('#approval2').is(':checked')) {
                            $('#label-approval2').addClass('bg-danger text-white');
                        }
                    });

                    // Fungsi untuk mengupdate badge berdasarkan status active
                    function updateBadge() {
                        $('.nav-link').each(function() {
                            var badge = $(this).find('.badge');
                            if ($(this).hasClass('active')) {
                                badge.removeClass('badge-primary').addClass('badge-white');
                            } else {
                                badge.removeClass('badge-white').addClass('badge-primary');
                            }
                        });
                    }

                    // Panggil fungsi updateBadge saat halaman dimuat
                    updateBadge();

                    // Panggil fungsi updateBadge saat tab diubah
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
                        updateBadge();
                    });

                    // Swal untuk hapus ticket
                    $(document).on('click', '.btnHapus', function() {
                        let id_ticket = $(this).data('id');
                        swal({
                            title: "Hapus Ticket",
                            text: "Anda yakin ingin menghapus ticket ini?",
                            icon: "warning",
                            buttons: ["Batalkan", "Hapus"],
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "<?php echo base_url(); ?>ticket/hapus",
                                    method: "POST",
                                    dataType: "json",
                                    data: {
                                        id_ticket: id_ticket
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            swal("Berhasil!", "Ticket berhasil dihapus.", "success")
                                                .then(() => {
                                                    // Reload halaman setelah update sukses
                                                    location.reload();
                                                });
                                        } else {
                                            swal("Gagal!", response.error, "error");
                                        }
                                    },
                                    error: function() {
                                        swal("Error!", "Tidak dapat terhubung ke server.", "error");
                                    }
                                });
                            }
                        });
                    });


                    // // Auto Load Data Otomatis
                    // // Config
                    // const CHECK_INTERVAL = 15000; // 30 detik
                    // const NOTIFICATION_TIMEOUT = 30000; // 60 detik

                    // // Fungsi utama pengecekan update
                    // function checkForUpdates() {
                    //     $.ajax({
                    //         url: "<?php echo base_url(); ?>ticket/check_updates",
                    //         method: "POST",
                    //         dataType: "json",
                    //         success: function(response) {
                    //             console.debug('Update check:', response);
                    //             if (response.has_update) {
                    //                 showUpdateNotification();
                    //             }
                    //         },
                    //         error: function(xhr, status, error) {
                    //             console.error("Error checking updates:", error);
                    //         }
                    //     });
                    // }

                    // // Tampilkan notifikasi
                    // function showUpdateNotification() {
                    //     const lastNotified = localStorage.getItem('lastNotified');
                    //     const now = new Date().getTime();

                    //     // Cek jika notifikasi sudah muncul dalam 1 menit terakhir
                    //     if (lastNotified && (now - lastNotified) < NOTIFICATION_TIMEOUT) {
                    //         return;
                    //     }

                    //     swal({
                    //         title: "Data Ticket Diperbarui!",
                    //         text: "Ada perubahan data terbaru pada sistem ticketing.\n\nTerakhir diperiksa: " + new Date().toLocaleTimeString(),
                    //         icon: "info",
                    //         buttons: {
                    //             confirm: {
                    //                 text: "Refresh",
                    //                 value: true,
                    //                 visible: true,
                    //                 className: "btn-refresh",
                    //                 closeModal: true
                    //             },
                    //             cancel: {
                    //                 text: "Nanti",
                    //                 value: false,
                    //                 visible: true,
                    //                 className: "btn-cancel",
                    //                 closeModal: true
                    //             }
                    //         }
                    //     }).then((result) => {
                    //         if (result) {
                    //             localStorage.setItem('lastNotified', now.toString());
                    //             location.reload();
                    //         } else {
                    //             localStorage.setItem('lastNotified', now.toString());
                    //         }
                    //     });
                    // }
                    // // Inisialisasi
                    // // Jalankan segera saat halaman load
                    // checkForUpdates();

                    // // Jadwalkan pengecekan berkala
                    // setInterval(checkForUpdates, CHECK_INTERVAL);

                    // // Untuk debugging
                    // window.debugCheckUpdate = checkForUpdates;
                });
            </script>
            </body>


            <!-- index.html  21 Nov 2019 03:47:04 GMT -->

            </html>