<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Generate QR CODE</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
            <div class= "container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary" onclick="generateqr()" style="margin-bottom:20px;"> Generate QRCODE</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <div id="qrcode"></div>
            </div>
            </div>
            </div>
        </div>
        </div>
     
</div>