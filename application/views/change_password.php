<div class="row">
    <div class="col-md-6 col-xs-12">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body">
                <h1><?php echo lang('change_password_heading'); ?></h1>

                <div id="infoMessage"><?php echo $message; ?></div>

                <?php echo form_open("auth/change_password"); ?>
                <div class="form-group">
                    <label for="firstname">Password:</label>
                    <?php echo form_input($old_password); ?>
                </div>
                <div class="form-group">
                    <label for="firstname">Password Baru:</label>
                    <?php echo form_input($new_password); ?>

                </div>
                <div class="form-group">
                    <label for="firstname">Konfirmasi Password Baru:</label>
                    <?php echo form_input($new_password_confirm); ?>

                </div>
              
                <?php echo form_input($user_id); ?>
                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Simpan</button>
                <a href="<?= site_url('profile');?>" class="btn btn-warning pull-right">Kembali</a>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>