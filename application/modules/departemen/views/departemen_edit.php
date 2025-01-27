<div class="pb-3 card-header d-flex justify-content-center align-items-center ">
              <h3>EDIT DEPARTEMENT</h3>
            </div>

			<div class="row">
            	<div class="col-lg">
					<div class="card mb-grid">
						<div class="card-body">
							<form action="<?=site_url('departemen');?>/proses" method="post">
								<div class="form-group">
								<label class="form-label">ID_DEPARTEMENT</label>					  
								<input class="form-control mb-2 input-credit-card" value="<?=$departemen->ID_DEPARTEMENT?>" name="ID_DEPARTEMENT" type="text" placeholder="">
								</div>

								<div class="form-group">
								<label class="form-label">NAMA_DEPARTEMENT</label>
								<input class="form-control input-date mb-2" value="<?=$departemen->NAMA_DEPARTEMENT?>" name="NAMA_DEPARTEMENT" type="text" placeholder="">
								</div>

								<a href="<?=site_url('departemen');?>"><button class="btn btn-information mr-2 " type="button">KEMBALI</button></a>
								<button class="btn btn-primary mr-2 " name="edit" type="submit">SIMPAN</button>
							</form>
						</div>
					</div>
				</div>
			</div>


