<form action="login" method="post" accept-charset="utf-8">
  <img class="mb-4" src="/image/logo.png" alt="" height="100">
  <h1 class="h3 mb-3 text-light fw-normal"><?= lang('Auth.login_heading') ?></h1>
  <p><?= lang('Auth.login_subheading') ?></p>
  <div class="form-floating">
    <input type="email" class="form-control text-light" id="identity" name="identity" placeholder="name@example.com" autocomplete="off" value="admin@admin.com">
    <label class="text-light bordered" for="identity" name="identity"><?= lang('Auth.login_identity_label') ?></label>
  </div>
  <div class="form-floating">
    <input type="password" class="form-control text-light" id="password" name="password" placeholder="Password" autocomplete="off" value="password">
    <label class="text-light" for="password"><?= lang('Auth.login_password_label') ?></label>
  </div>

  <!-- <div class="checkbox mb-3">
    <label class="text-light">
      <input type="checkbox" value="remember-me"> <?= lang('Auth.login_remember_label') ?>
    </label>
  </div> -->
  <button class="btn w-100 btn-primary" type="submit"><?= lang('Auth.login_submit_btn') ?></button>
  <p class="mt-5 mb-3 text-light">Copyright &copy; Simerawana <?= date('Y'); ?></p>
</form>

<script>
  $(document).ready(function() {

  })
</script>