<footer class="main-footer">
    <strong>Copyright &copy; 2021 </strong>
    All rights reserved.
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- MDB -->
  <!-- <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"
  ></script> -->
<!-- jQuery -->
<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/adminlte/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/adminlte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/adminlte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/adminlte/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('assets/adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/adminlte/dist/js/demo.js')}}"></script>


<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<!-- DataTables -->
<script src="{{url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->


<script src="https://adminlte.io/themes/v3/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
      $('.category-select').select2();
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
    $('#clone_btn').click(function(){
      $("#mainBody").append($("#answerDiv").clone());
    });
});
</script>
<script>
  function setRadioBtnValue(params)
  {
    console.log(params.value);
  }
</script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<!-- <script>
      function userModalOpen(params) {
        var userid = params.id;
        console.log(userid);
        // return false;
        
        if ($.trim($("#modal-detail" + userid).text().length) > 0) {
          //do nothing
          console.log($("#modal-detail" + userid).html().length);
        } else {
            $.ajax({
                type:'GET',
                url:'{{ url("userModalContent") }}/' + userid,
                beforeSend: function(){
                    $("#modal-detail" + userid).append("Loading...");
                },
                complete: function(){
                  
                },
                success:function(data) {
                  $('#modal-detail'+userid).empty();
                  console.log(data);
                  $("#modal-detail" + userid).append(data);
                }
              });
        }

       
    }
</script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('fetchPlayers') }}",
            });
        });
    </script>

    <script>
      function player(params)
      {
        console.log(params);
      }
    </script>