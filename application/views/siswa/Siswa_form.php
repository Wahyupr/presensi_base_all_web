<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Siswa</h3>
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
            <label for="int">Nis <?php echo form_error('nis') ?></label>
            <input type="text" class="form-control" name="nis" id="nis" placeholder="Nis" value="<?php echo $nis; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Email <?php echo form_error('id_user') ?></label>
            <!--<input type="text" class="form-control" name="id_user" id="id_user" placeholder="id_user" value="<?php echo $email; ?>" />--->
            <select class="form-control" name="id_user" id="id_user">
                <option value ="">Pilih User Email</option>
                <?php foreach ($users as $key => $value) {?>
                    <option <?= ($id_user == $value->id)?'selected':''; ?> value ="<?=$value->id?>"><?=$value->email;?></option>
                <?php }?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Jurusan Kelas <?php echo form_error('jurusan_kelas') ?></label>
            <input type="text" class="form-control" name="jurusan_kelas" id="jurusan_kelas" placeholder="Jurusan Kelas" value="<?php echo $jurusan_kelas; ?>" />
        </div>
	    <input type="hidden" name="id_siswa" value="<?php echo $id_siswa; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('siswa') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>