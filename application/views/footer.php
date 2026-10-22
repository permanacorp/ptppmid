<!-- Preloader -->
        <div id="preloader">
            <div class="preloader-position">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-teal">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Start Core Plugins-->

        <!-- jQuery -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/jQuery/jquery-3.2.1.min.js" type="text/javascript"></script>
        <!-- jquery-ui -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/themes/material/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- materialize  -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/materialize/js/materialize.min.js" type="text/javascript"></script>
        <!-- metismenu-master -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/metismenu-master/dist/metisMenu.min.js" type="text/javascript"></script>
        <!-- m-custom-scrollbar -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
        <!-- scroll -->
        <script src="<?php echo base_url();?>assets/themes/material/plugins/simplebar/dist/simplebar.js" type="text/javascript"></script>

        <!-- custom js -->
        <script src="<?php echo base_url();?>assets/themes/material/dist/js/custom.js" type="text/javascript"></script>
        <!-- End Core Plugins-->
        <!-- Start Theme label Script-->
        <!-- main js -->
        <script src="<?php echo base_url();?>assets/themes/material/dist/js/main.js" type="text/javascript"></script>

        <!-- End Theme label Script-->
        <script>
            "use strict";
            $(function () {
                $('select').material_select();
                Materialize.updateTextFields();
                // autocomplete
                $('input.autocomplete').autocomplete({
                    data: {
                        "Apple": null,
                        "Microsoft": null,
                        "Google": 'https://placehold.it/250x250'
                    },
                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                    onAutocomplete: function (val) {
                        // Callback function when value is autcompleted.
                    },
                    minLength: 1 // The minimum length of the input for the autocomplete to start. Default: 1.
                });

                //datepicker
                $('.datepicker').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15 // Creates a dropdown of 15 years to control year
                });
            });
        </script>

    </body>


<!-- Mirrored from materialadmin.thememinister.com/admin/forms_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Sep 2017 05:11:52 GMT -->
</html>