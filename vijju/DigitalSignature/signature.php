<html>
<head>
<script src="modernizr.custom.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <!--[if lt IE 9]><script src="flashcanvas.js"></script><![endif]-->
 </head>
 <body>
<?php
if(isset($_POST["output"])){
    require_once 'signature-to-image.php';
    $img = sigJsonToImage($_POST['output']);

    imagepng($img, 'signature.png');
    imagedestroy($img);

    echo "Signature saved!";
}else{
?>
<canvas class="pad" height="55" width="198"></canvas>

 <form method=post action="<?=$_SERVER['PHP_SELF']?>" class=sigPad>

    <canvas style="border:solid 1px black" class=pad width=298 height=155></canvas>
    <input type='hidden' name='output' class='output' value='fsd'>
    <br />
    <button type=submit>I accept the terms of this agreement.</button>    <button class=clearButton>Reset</button>
 </form>
 <script src="jquery.signaturepad.min.js"></script>
 <script>
  $(document).ready(function () {
    $('.sigPad').signaturePad({drawOnly:true});
  });
</script>
<?php } ?>


<!-- <div class="sigPad"><canvas class="pad" height="100" width="220"></canvas></div> -->
<script>
// var sig = "{"lx":40,"ly":56,"mx":40,"my":55},{"lx":39,"ly":56,"mx":40,"my":56},{"lx":40,"ly":57,"mx":39,"my":56},{"lx":41,"ly":58,"mx":40,"my":57},{"lx":45,"ly":61,"mx":41,"my":58},{"lx":46,"ly";
// $('.sigPad').signaturePad({displayOnly:true}).regenerate(sig)";
// </script>


 </body>
 </html>