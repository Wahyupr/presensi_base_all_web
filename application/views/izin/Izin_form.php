<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Izin</h3>
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
        <?php echo form_open_multipart('upload/do_upload');?>
	    <div class="form-group">
            <label for="varchar">Nama Siswa <?php echo form_error('nama_siswa') ?></label>
            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" value="<?php echo $nama_siswa; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alasan <?php echo form_error('alasan') ?></label>
            <input type="text" class="form-control" name="alasan" id="alasan" placeholder="Alasan" value="<?php echo $alasan; ?>" />
        </div>
	    <div class="form-group">
            <label for="binary">Foto <?php echo form_error('foto') ?></label>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
        </div>
	    <input type="hidden" name="id_izin" value="<?php echo $id_izin; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('izin') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>