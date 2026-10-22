        <div class="site-footer">
            2017 © Faqihalfahmy.com
            <div class="pull-right">
                Version 1.0
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>assets/template/backend/js/vendor.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/cosmos.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/application.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/tables-datatables.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/tables-responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/ui-notifications.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/js/forms-plugins.min.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url();?>assets/template/backend/datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Global CSRF Token Prefilter for AJAX POST requests -->
    <script type="text/javascript">
      (function($) {
        if (typeof $ !== 'undefined') {
          $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
            if (options.type && options.type.toUpperCase() === 'POST') {
              var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
              var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
              if (options.data instanceof FormData) {
                if (!options.data.has(csrfName)) {
                  options.data.append(csrfName, csrfHash);
                }
              } else if (typeof options.data === 'string') {
                if (options.data.indexOf(csrfName + '=') === -1) {
                  options.data += (options.data.length > 0 ? '&' : '') + encodeURIComponent(csrfName) + '=' + encodeURIComponent(csrfHash);
                }
              } else if (typeof options.data === 'object' && options.data !== null) {
                options.data[csrfName] = csrfHash;
              } else if (!options.data) {
                options.data = {};
                options.data[csrfName] = csrfHash;
              }
            }
          });
        }
      })(jQuery);
    </script>
  </body>
</html>
