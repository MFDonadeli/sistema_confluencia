<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <style>
        .split-panel{
            float: left;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class='split-panel' id="left-panel">
        <button class='btn_run' id='iq'>Run IqOption import</button>
        <div id="iq_pair_import">
        </div>
    </div> <!-- left-panel -->
    
    <div class='split-panel' id="right-panel">
    <button class='btn_run' id='mt4'>Run MT4Option import</button>
        <div id="mt4_pair_import">
        </div>
    </div> <!-- right-panel -->

    <script>
        $('.btn_run').click(function() {
            source = $(this).attr('id');
            $.ajax({
                url: '/start-import/' + source
            }).done(function(data) {
                $("#" + source + "_pair_import").html(data);
            });
        });
    </script>

</body>
</html>