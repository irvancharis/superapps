    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card author-box">
                            <div class="card-body">
                                <div class="author-box-center">
                                    <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                        <a href="#"><?php echo $M_USER->NAMA_KARYAWAN; ?></a>
                                    </div>
                                    <div class="author-box-job"><?php echo $M_USER->NAMA_JABATAN . " - " . $M_USER->NAMA_DEPARTEMEN; ?></div>
                                </div>
                                <div class="text-center">
                                    <div class="author-box-description">
                                        <p>
                                            <i class="fas fa-briefcase"></i> <?php echo $this->session->userdata('NAMA_ROLE'); ?> <br>
                                            <i class="fas fa-map-marker"></i> <?php echo $M_KARYAWAN->NAMA_AREA; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Personal Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Birthday
                                        </span>
                                        <span class="float-right text-muted">
                                            <?php echo date("j F Y", strtotime($M_KARYAWAN->TANGGAL_LAHIR)); ?>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Phone
                                        </span>
                                        <span class="float-right text-muted">
                                            <?php echo $M_KARYAWAN->TELEPON; ?>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Mail
                                        </span>
                                        <span class="float-right text-muted">
                                            <?php echo $M_KARYAWAN->EMAIL; ?>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            NIK
                                        </span>
                                        <span class="float-right text-muted">
                                            <a href="javascript:void(0);"><?php echo $M_KARYAWAN->NIK; ?></a>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            NIP
                                        </span>
                                        <span class="float-right text-muted">
                                            <a href="#"><?php echo $M_KARYAWAN->NIP; ?></a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="padding-20">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                            aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                            aria-selected="false">Setting</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Nama</strong>
                                                <br>
                                                <p class="text-muted"><?php echo $M_KARYAWAN->NAMA_KARYAWAN; ?></p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted"><?php echo $M_KARYAWAN->TELEPON; ?></p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Email</strong>
                                                <br>
                                                <p class="text-muted"><?php echo $M_KARYAWAN->EMAIL; ?></p>
                                            </div>
                                            <div class="col-md-3 col-6">
                                                <strong>Location</strong>
                                                <br>
                                                <p class="text-muted"><?php echo $M_KARYAWAN->ALAMAT; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="<?php echo base_url('assets/img/Profile_user.png'); ?>" width="50%" alt="">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                        <form id="formEditProfileUser" method="post" class="needs-validation">
                                            <div class="card-header">
                                                <h4>Edit Profile</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-12">
                                                        <label>Nama</label>
                                                        <input type="text" name="NAMA_KARYAWAN" class="form-control" value="<?php echo $M_KARYAWAN->NAMA_KARYAWAN; ?>">
                                                        <div class="invalid-feedback">
                                                            Masukkan NAMA dengan benar!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4 col-12">
                                                        <label>Email</label>
                                                        <input type="email" name="EMAIL" class="form-control" value="<?php echo $M_KARYAWAN->EMAIL; ?>">
                                                        <div class="invalid-feedback">
                                                            Masukkan EMAIL dengan benar!
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4 col-12">
                                                        <label>Telepon</label>
                                                        <input type="tel" name="TELEPON" class="form-control" value="<?php echo $M_KARYAWAN->TELEPON; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4 col-12">
                                                        <label>Alamat</label>
                                                        <input type="text" name="ALAMAT" class="form-control" value="<?php echo $M_KARYAWAN->ALAMAT; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalGantiPassword"> <i class="fa fa-key"></i> Ganti Password</button>
                                                <div>
                                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Simpan Perubahan</button>
                                                    <button type="button" onclick="history.go(-1)" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> Kembali</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- Modal Ganti Password -->
    <div class="modal fade" id="modalGantiPassword" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" placeholder="Masukkan Password Baru" name="new_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                <input type="password" class="form-control" placeholder="Masukkan Konfirmasi Password" name="confirm_password">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="btnGantiPassword" class="btn btn-primary m-t-15 waves-effect"> <i class="fa fa-save"></i> SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>
    <script>
        $(document).ready(function() {
            // formEditProfile  
            $('#formEditProfileUser').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo site_url('profile_user/update/' . $this->session->userdata('NIK')); ?>',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        var result = JSON.parse(result);
                        if (result.success) {
                            swal('Sukses', 'Profile berhasil diubah', 'success').then(function() {
                                location.reload();
                            });
                        } else {
                            swal('Gagal', 'Profile gagal diubah', 'error');
                        }
                    }
                });
            })

            // formGantiPassword
            $('#btnGantiPassword').click(function() {
                var new_password = $('input[name=new_password]').val();
                var confirm_password = $('input[name=confirm_password]').val();
                if (new_password == confirm_password) {
                    $.ajax({
                        url: '<?php echo site_url('profile_user/ganti_password/' . $this->session->userdata('UUID_USER')); ?>',
                        type: 'POST',
                        data: {
                            'new_password': new_password,
                            'confirm_password': confirm_password
                        },
                        success: function(result) {
                            var result = JSON.parse(result);
                            if (result.success) {
                                $('#modalGantiPassword').modal('hide');
                                swal('Sukses', 'Password berhasil diubah', 'success');
                            } else {
                                swal('Gagal', 'Password gagal diubah', 'error');
                            }
                        }
                    });
                } else {
                    swal('Gagal', 'Password baru dan konfirmasi password tidak cocok', 'error');
                }
            })
        });
    </script>

    </body>


    <!-- profile.html  21 Nov 2019 03:49:32 GMT -->

    </html>