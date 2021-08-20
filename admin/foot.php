<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Admin.</b>
  </div>
  <strong>Copyright &copy; 2021 Admin - All rights reserved.</strong>
 </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="lib/DataTables/datatables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tables').DataTable();
	});
</script>
<!-- select2 -->
        <script src="js/select2.full.js"></script>
        <!-- select2 -->
        <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Choose an option",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                    maximumSelectionLength: 4,
                    placeholder: "With Max Selection limit 4",
                    allowClear: true
                });
            });
        </script>
<script src="js/admin.js"></script>
<script type="text/javascript" src='js/main.js'></script>
<script src="js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>