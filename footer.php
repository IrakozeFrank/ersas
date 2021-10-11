<div class="footer">
                    <div class="pull-right">
                        Final Project
                    </div>
                    <div>
                        2020
                    </div>
                </div>

            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script> 

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- FooTable -->
        <script src="js/plugins/footable/footable.all.min.js"></script>

        <!-- Data Tables -->
        <script src="js/plugins/dataTables/datatables.min.js"></script>

        <!-- Page-Level Scripts -->
        <script>

            $(document).ready(function() {

                $('.footable').footable(); 

            });

        </script>  

        <script>

            $(document).ready(function() {

                $('.dataTables-example').DataTable({
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [

                    {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('primary-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    }
                }
                ]
            });  
            });
        </script>

        <script type="text/javascript">

            window.setTimeout(function() {

                $(".alert").fadeTo(500, 0).slideUp(500, function(){

                    $(this).remove();
                });

            }, 8000);

        </script>

    </body>
</html>