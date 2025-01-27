			<div class="pb-3 card-header d-flex justify-content-center align-items-center ">
              <h3>DATA DEPARTEMENT</h3>
            </div>


			<div class="row">
              <div class="col">
                <div class="card mb-grid">
                  <div class="card-header d-flex justify-content-end align-items-center">
                    <div class="card-header-title"><a href="<?=site_url('departemen/add');?>"><button class="btn btn-success mr-2" type="submit">TAMBAH</button></a></div>
                  </div>
                  <div class="table-responsive-md">
                    <table class="table table-actions table-striped table-hover mb-0" data-table >
                      <thead>
                        <tr>
                          <th scope="col">
                            <label class="custom-control custom-checkbox m-0 p-0">
                              <input type="checkbox" class="custom-control-input table-select-all">
                              <span class="custom-control-indicator"></span>
                            </label>
                          </th>
                          <th scope="col">ID DEPARTEMENT</th>
                          <th scope="col">NAMA DEPARTEMENT</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
						$no = 1;
						foreach ($departemen as $b => $row) { ?>
                        <tr>
                          <th scope="row">
                            <label class="custom-control custom-checkbox m-0 p-0">
                              <input type="checkbox" class="custom-control-input table-select-row">
                              <span class="custom-control-indicator"></span>
                            </label>
                          </th>
                          <td><?=$row->ID_DEPARTEMENT;?></td>
                          <td><?=$row->NAMA_DEPARTEMENT;?></td>
                          <td>
						  <a class="card-header-action" href="#" role="button" id="card1Settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i data-feather="settings"></i>
                        </a>
						  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="card1Settings">
                          <a class="dropdown-item" href="<?=site_url('departemen/edit/'.$row->ID_DEPARTEMENT);?>">Edit</a>
                          <a class="dropdown-item" href="<?=site_url('departemen/del/'.$row->ID_DEPARTEMENT);?>" onclick="return confirm('Yakin akan menghapus data?')">Hapus</a>
                        </div>
                          </td>
                        </tr>

						<?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
			