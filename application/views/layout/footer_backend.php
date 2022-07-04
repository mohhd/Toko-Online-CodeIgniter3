              <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
              </div><!-- /.container-fluid -->
              </div>
              <!-- /.content -->
              </div>
              <!-- /.content-wrapper -->

              <!-- Control Sidebar -->
              <aside class="control-sidebar control-sidebar-dark">
                  <!-- Control sidebar content goes here -->
                  <div class="p-3">
                      <h5>Title</h5>
                      <p>Sidebar content</p>
                  </div>
              </aside>
              <!-- /.control-sidebar -->

              <!-- Main Footer -->
              <footer class="main-footer">
                  <!-- To the right -->
                  <div class="float-right d-none d-sm-inline">
                      Anything you want
                  </div>
                  <!-- Default to the left -->
                  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
              </footer>
              </div>
              <!-- ./wrapper -->

              <!-- REQUIRED SCRIPTS -->

              <!-- jQuery -->
              <script>
                  $(function() {
                      $("#example1").DataTable({
                          "responsive": true,
                          "lengthChange": false,
                          "autoWidth": false,
                          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

              <script>
                  window.setTimeout(function() {
                      $('.alert').fadeTo(500, 0).slideUp(500, function() {
                          $(this).remove();
                      });
                  }, 3000)
              </script>
              </body>

              </html>