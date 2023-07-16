<p><?php echo lang('Auth.edit_user_subheading'); ?></p>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open_multipart(uri_string(), ['onsubmit' => 'showLoader()', 'id'=>'ubah-user']); ?>
<div class="row">
      <div class="col-12 col-lg-6 align-self-center">
            <div class=" mb-3 image-upload">
                  <label for="formFile" class="file-input ">
                        <span class="icon-foto fw-bold"><?= icon("camera", 25, 25); ?></span>
                        <img src="/image/md/<?= $user->medium; ?>" alt="<?= lang('Auth.profile_picture_lable'); ?>">
                  </label>
                  <input class="fileinput" type="file" id="formFile" name="foto_profil" accept="image/*">
                  <input type="hidden" value="<?= $user->img; ?>" name="old_foto_profil">
                  <script>
                        $('.fileinput').change(function(event) {
                              console.log($(this).val());
                              $('label.file-input img').attr('src', URL.createObjectURL(event.target.files[0]));
                        })
                        $('label.file-input img').hover(function() {
                              $('.icon-foto').show()
                        }, function() {
                              $('.icon-foto').hide()
                        })
                  </script>
            </div>
      </div>
      <div class="col-12 col-lg-6">
            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('people') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($first_name, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_fname_label'), 'first_name', ['for' => 'first_name']); ?>
                  </div>
            </div>
            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('people') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($last_name, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_lname_label'), 'last_name', ['for' => 'last_name']); ?>
                  </div>
            </div>
            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('buildings') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($company, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_company_label'), 'company', ['for' => 'company']); ?>
                  </div>
            </div>
            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('telephone') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($phone, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_phone_label'), 'phone', ['for' => 'phone']); ?>
                  </div>
            </div>
            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('key') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($password, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_password_label'), 'password', ['for' => 'password']); ?>
                  </div>
            </div>

            <div class="input-group mb-3">
                  <span class="input-group-text rounded-0"><?= icon('key') ?></span>
                  <div class="form-floating">
                        <?php echo form_input($password_confirm, '', ['class' => 'form-control rounded-0', "placeholder" => "Username"]); ?>
                        <?php echo form_label(lang('Auth.edit_user_password_confirm_label'), 'password_confirm', ['for' => 'password_confirm']); ?>
                  </div>
            </div>

            <?php if ($ionAuth->isAdmin()) : ?>

                  <h3><?php echo lang('Auth.edit_user_groups_heading'); ?></h3>
                  <?php foreach ($groups as $group) : ?>
                        <label class="checkbox">
                              <?php
                              $gID = $group['id'];
                              $checked = null;
                              $item = null;
                              foreach ($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                          $checked = ' checked="checked"';
                                          break;
                                    }
                              }
                              ?>
                              <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
                              <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </label>
                  <?php endforeach ?>

            <?php endif ?>
      </div>
</div>

<?php echo form_hidden('id', $user->id); ?>

<!-- <p><?php echo form_submit('submit', lang('Auth.edit_user_submit_btn')); ?></p> -->

<?php echo form_close(); ?>