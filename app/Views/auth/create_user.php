<h1><?php echo lang('Auth.create_user_heading'); ?></h1>
<?php breadcrumb() ?>
<p><?php echo lang('Auth.create_user_subheading'); ?></p>

<div class="container-fluid mb-5">
      <div id="infoMessage"><?php echo $message; ?></div>

      <?php echo form_open_multipart('auth/create_user', ['class' => 'pe-3', 'onsubmit' => 'showLoader()']); ?>
      <div class="row justify-content-center">
            <div class="col-lg-6">
                  <div class=" mb-3 image-upload">
                        <label for="formFile" class="file-input ">
                              <span class="icon-foto fw-bold"><?= icon("camera", 25, 25); ?></span>
                              <img src="/image/md/default.png" alt="<?= lang('Auth.profile_picture_lable'); ?>">
                        </label>
                        <input class="fileinput" type="file" id="formFile" name="foto_profil" accept="image/*">
                        <script>
                              $('.fileinput').change(function(event) {
                                    $('label.file-input img').attr('src', URL.createObjectURL(event.target.files[0]));
                              })
                        </script>
                  </div>
            </div>
      </div>

      <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3">
                  <div class="input-group mb-3 ">
                        <span class="input-group-text rounded-0"><?= icon('people') ?></span>
                        <div class="form-floating">
                              <?php echo form_input($first_name, '', ['class' => 'form-control rounded-0', 'placeholder' => 'first name']); ?>
                              <?php echo form_label(lang('Auth.create_user_fname_label'), 'first_name', ['for' => 'first_name']); ?>
                        </div>
                  </div>
            </div>
            <div class="col-md-6 col-lg-3">
                  <div class="form-floating mb-3">
                        <?php echo form_input($last_name, '', ['class' => 'form-control rounded-0', 'placeholder' => 'last name']); ?>
                        <?php echo form_label(lang('Auth.create_user_lname_label'), 'last_name', ['for' => 'last_name']); ?>
                  </div>
            </div>

      </div>

      <?php
      if ($identity_column !== 'email') {
            echo '<p>';
            echo form_label(lang('Auth.create_user_identity_label'), 'identity');
            echo '<br />';
            echo \Config\Services::validation()->getError('identity');
            echo form_input($identity);
            echo '</p>';
      }
      ?>
      <div class="row justify-content-center">
            <div class="col-lg-6">
                  <div class="input-group mb-3">
                        <span class="input-group-text rounded-0"><?= icon('buildings') ?></span>
                        <div class="form-floating">
                              <?php echo form_input($company, '', ['class' => 'form-control rounded-0', 'placeholder' => 'company']); ?>
                              <?php echo form_label(lang('Auth.create_user_company_label'), 'company', ['for' => 'company']); ?>
                        </div>
                  </div>
            </div>
      </div>
      <div class="row justify-content-center">
            <div class="col-lg-6">
                  <div class="input-group mb-3">
                        <span class="input-group-text rounded-0"><?= icon('telephone') ?></span>
                        <div class="form-floating mb">
                              <?php echo form_input($phone, '', ['class' => 'form-control rounded-0', 'placeholder' => 'phone']); ?>
                              <?php echo form_label(lang('Auth.create_user_phone_label'), 'phone', ['for' => 'phone']); ?>
                        </div>
                  </div>
            </div>
      </div>
      <div class="row justify-content-center">
            <div class="col-lg-6">
                  <div class="input-group mb-3">
                        <span class="input-group-text rounded-0"><?= icon('envelope') ?></span>
                        <div class="form-floating">
                              <?php echo form_input($email, '', ['class' => 'form-control rounded-0', 'placeholder' => 'email']); ?>
                              <?php echo form_label(lang('Auth.create_user_email_label'), 'email', ['for' => 'email']); ?>
                        </div>
                  </div>
            </div>
      </div>

      <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                  <div class="input-group mb-3">
                        <span class="input-group-text rounded-0"><?= icon('key') ?></span>
                        <div class="form-floating">
                              <?php echo form_input($password, '', ['class' => 'form-control rounded-0', 'placeholder' => 'password']); ?>
                              <?php echo form_label(lang('Auth.create_user_password_label'), 'password', ['for' => 'password']); ?>
                        </div>
                  </div>
            </div>
            <div class="col-lg-3 col-md-6">
                  <div class="form-floating mb-3">
                        <?php echo form_input($password_confirm, '', ['class' => 'form-control rounded-0', 'placeholder' => 'password_confirm']); ?>
                        <?php echo form_label(lang('Auth.create_user_password_confirm_label'), 'password_confirm', ['for' => 'password_confirm']); ?>
                  </div>
            </div>
      </div>

      <div class="row justify-content-center">
            <div class="col-2">
                  <button type="submit" class="btn rounded-0 btn-primary"><?= icon('folder-plus') . ' ' . lang('Auth.create_user_submit_btn')    ?></button>
            </div>
      </div>

      <?php echo form_close(); ?>

</div>