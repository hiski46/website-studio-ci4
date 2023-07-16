<h1><?php echo lang('Auth.create_group_heading'); ?></h1>
<?php breadcrumb() ?>
<p><?php echo lang('Auth.create_group_subheading'); ?></p>

<div id="infoMessage"><?php echo $message; ?></div>

<div class="container">
      <?php echo form_open("auth/create_group"); ?>
      <div class="row">
            <div class="col-md-6">
                  <p>
                        <?php echo form_label(lang('Auth.create_group_name_label'), 'group_name'); ?> <br />
                        <?php echo form_input($group_name, '', ['class' => 'form-control']); ?>
                  </p>

                  <p>
                        <?php echo form_label(lang('Auth.create_group_desc_label'), 'description'); ?> <br />
                        <?php echo form_input($description, '', ['class' => 'form-control']); ?>
                  </p>

                  <p><?php echo form_submit('submit', lang('Auth.create_group_submit_btn'), ['class' => 'btn btn-primary']); ?></p>

            </div>
      </div>

      <?php echo form_close(); ?>

</div>