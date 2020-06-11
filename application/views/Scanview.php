<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>ScanerView</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body{
            max-width: 100%;
            overflow: hidden;
            background: url(<?= base_url('assets/dist/img/bgScanview.jpg');
                            ?>);
            background-size: cover;
        }

        #jam{
            padding: 20px;
            font-size: 60pt;
            color: #000033;
            font-weight: bold;
            padding-bottom: 0px;
        }

        #tgl{
            padding-left: 30px;
            font-size: 45pt;
            margin-top: -70px;
            color: #465584;
            font-weight: 500;
        }
        .panel{
            background-color: rgba(255, 255, 255, 0.5);
            min-height: 800px;
            width: 100%;
            padding: 10px;
            margin: 20px;

        }
        video{
            width: 600px;
        }
        .title{
            font-size: 42pt;
            font-weight: bold;
            color: #124d5d;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #FFFFFF;
        } 
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <div class="col-8">
            <div class="jam" id="jam">
                12 : 00: 00
            </div>
            <div class="tgl" id="tgl">
                20 Mei 2020
            </div>

            <div class="row">
                <div class="col mx-auto">
                    <div class="title">
                        Scanner View
                    </div>
                </div>
                <div class="col">
                    <div class="title mx-auto">
                        <video id="preview">

                        </video>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="row">
                <div class="panel">

                </div>
            </div>
        </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/intascan.js">
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('jam').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
        }

            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

            var date = new Date();

            var day = date.getDate();

            var month = date.getMonth();

            var thisDay = date.getDay(),

                thisDay = myDays[thisDay];

            var yy = date.getYear();

            var year = (yy < 1000) ? yy + 1900 : yy;

            document.getElementById('tgl').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;

        startTime();
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addlistener('scan', function(content){
            alert(content);
        });
        Instascan.Camera.getCameras().then(function(cameras){
            if (cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                console.error('No Camera Found.');
            }
        }).catch(function(e){
            console.error(e);
        });
</script>
</body>
</html>