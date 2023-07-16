<?= $type == 'dashboard' ? $this->extend('layout/dashboard_layout') : $this->extend('layout/login_layout') ?>

<?= $this->section('content') ?>
<?= $view ?>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    <?php if (session()->getFlashdata('pesan')) { ?>
        iziToast.show({
            title: "<?= session()->getFlashdata('pesan'); ?>",
            // message: 'What would you like to add?',
            balloon: false,
            position: 'topCenter',
            theme: "light",
            color: 'blue'
        });
    <?php } ?>
    <?php if (session()->getFlashdata('error')) { ?>
        iziToast.show({
            title: "<?= session()->getFlashdata('error'); ?>",
            // message: 'What would you like to add?',
            balloon: false,
            position: 'topCenter',
            theme: "light",
            color: 'red'
        });
    <?php } ?>
    <?php if (session()->getFlashdata('info')) { ?>
        iziToast.show({
            title: "<?= session()->getFlashdata('info'); ?>",
            // message: 'What would you like to add?',
            balloon: false,
            position: 'topCenter',
            theme: "light",
            color: 'yellow'
        });
    <?php } ?>
</script>
<?= $this->endSection() ?>