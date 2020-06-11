<script src="<?= base_url('assets/plugins/qrcode/qrcode.js');?>"></script>
<script type="text/javascript">
	<?php
        $user = $this->ion_auth->user()->row();
    ?>
    $(document).ready(function() {});

    function generateqr(){
        var qrcode = new QRCode(document.getElementById("qrcode"), {
	    text: "https://localhost/coba2/scanabsen/absen/<?=$user->id;?>",
	    width: 300,
	    height: 300,
	    colorDark : "#0f324a",
	    colorLight : "#ffffff",
	    correctLevel : QRCode.CorrectLevel.H
});

    }



</script>