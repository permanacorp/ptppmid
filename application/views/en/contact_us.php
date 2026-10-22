<?php $this->load->view('templates/frontend/head'); ?>
<?php $this->load->view('templates/frontend/header'); ?>
<!-- PAGE TITLE -->
        <section class="no-padding">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7424690709113!2d106.89074541476946!3d-6.2975340954421455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed50d076a261%3A0x98d1ee0fbfadb7c0!2sPermana%20Putra%20Mandiri!5e0!3m2!1sen!2sid!4v1568184268514!5m2!1sen!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </section>
        <!-- END: PAGE TITLE -->

        <!-- CONTENT -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row m-t-40">
                            <div class="col-md-12">
                        <h4 class="text-uppercase"><?php echo html_escape($web_config->namaWeb);?></h4>
                                <address>
              <?php echo html_escape($web_config->address);?>
              <hr />
              <abbr title="Phone">Telp:</abbr> <?php echo html_escape($web_config->telp);?><br />
              <abbr title="Fax">Fax:</abbr> <?php echo html_escape($web_config->fax);?><br />
              <abbr title="Email">Email:</abbr> <?php echo html_escape($web_config->email);?><br />
            </address>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                    <?php echo form_open('en/contact_us',array('id'=>'widget-contact-form','role'=>'form'));?>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="nama">Name</label>
                                    <input type="text" name="nama" aria-required="true" name="widget-contact-form-name" class="form-control" placeholder="Enter your Name" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" aria-required="true" name="widget-contact-form-email" class="form-control" placeholder="Enter your Email" required>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="noWA">Phone Number</label>
                                    <input type="number" name="noWA" aria-required="true" name="widget-contact-form-email" class="form-control" placeholder="Enter your phonenumber" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="subject">Your Subject</label>
                                    <input type="text" name="subject" name="widget-contact-form-subject" class="form-control required" placeholder="Subject..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea type="text" name="content" name="widget-contact-form-message" rows="5" class="form-control required" placeholder="Enter your Message" required></textarea>
                            </div>
                            <div class="g-recaptcha" data-expired-callback="expiredCallback" data-callback="recaptchaCallback" data-sitekey="6LdXRhEUAAAAANBrgQp5nhZwr4BNfEOGvwVUa7Cb" style="margin-top:20px;margin-bottom:20px"></div>
                            <button id="submitBtn" class="btn btn-primary disabled" type="submit" name="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
                        <?php echo form_close();?>
                        <?php echo $message;?>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: CONTENT -->
<script>
function recaptchaCallback() {
    $('#submitBtn').removeClass('disabled');
};
function expiredCallback() {
    $('#submitBtn').addClass('disabled');
};
</script>
<?php $this->load->view('templates/frontend/footer'); ?>
