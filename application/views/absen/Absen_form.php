<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Absen</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Siswa <?php echo form_error('id_siswa') ?></label>
            <!--input type="text" class="form-control" name="id_siswa" id="id_siswa" placeholder="Id Siswa" />--->
            <select class="form-control" name="id_siswa" id="id_siswa">
                <option value = "">Pilih Siswa</option>
                <?php foreach ($siswa as $key => $value) { ?>
                        <option <?= ($id_siswa == $value ->id_siswa)?"Selected" :""; ?> value="<?= $value->id_siswa?>"><?=$value->nama;?></option>
                    <?php 
                    }?>
            </select>
        </div>
	    <div class="form-group">
            <label for="time">Masuk <?php echo form_error('masuk') ?></label>
            <input type="time" class="form-control" name="masuk" id="masuk" placeholder="Masuk" value="<?php echo $masuk; ?>" />
        </div>
	    <div class="form-group">
            <label for="time">Keluar <?php echo form_error('keluar') ?></label>
            <input type="time" class="form-control" name="keluar" id="keluar" placeholder="Keluar" value="<?php echo $keluar; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status Kehadiran <?php echo form_error('status_kehadiran') ?></label>
            <input type="text" class="form-control" name="status_kehadiran" id="status_kehadiran" placeholder="Status Kehadiran" value="<?php echo $status_kehadiran; ?>" />
        </div>
	    <input type="hidden" name="id_absen" value="<?php echo $id_absen; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('absen') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>