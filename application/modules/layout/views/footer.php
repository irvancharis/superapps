          </div>
        </div>
      </div>
      <!-- // Main Content -->
    </div>

    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/vendor.js"></script>
    <script src="<?= base_url('assets/'); ?>js/adminx.js"></script>

    <script src="<?= base_url('assets/'); ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/dataTables.bootstrap4.min.js"></script>

    <script>
      $(document).ready(function() {
        var table = $('[data-table]').DataTable({          
        });

        /* $('.form-control-search').keyup(function(){
          table.search($(this).val()).draw() ;
        }); */
      });
    </script>

    <!-- If you prefer vanilla JS these are the only required scripts -->
    <!-- script src="../dist/js/vendor.js"></script>
    <script src="../dist/js/adminx.vanilla.js"></script-->
  </body>
</html>