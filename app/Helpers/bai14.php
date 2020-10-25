<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài14</title>
    <style>

    </style>
</head>
<body>
<?php
$masv ="";
$ngaysinh="";
$noisinh="";
$lop="";
$hoten="";
if (isset($_POST["dangky"])) {
    $masv=$_POST["ma"];
    $hoten=$_POST["hoten"];
    $noisinh=$_POST["noisinh"];
    $ngaysinh=$_POST["ngaysinh"];
    $gioitinh=$_POST["gioitinh"];
    $lop=$_POST["lop"];

}
?>
<h1 align="center">Đăng Ký</h1>
<form action="" method="post" >
    <div class="box">
        <p>Mã SV: </p>
        <input type="text" name="ma"  value="">
    </div>
    <div class="box">
        <p>Họ Tên: </p>
        <input type="text" name="hoten"  value="">
    </div>
    <div class="box">
        <p>Ngày Sinh: </p>
        <input type="text" name="ngaysinh" value="">
    </div>
    <div class="box">
        <p>Giới Tính: </p>

        <input type="radio" name="gioitinh" value="Nam"> <span>Nam</span>
        <input type="radio" name="gioitinh" value="Nữ"> <span>Nữ</span>

    </div>
    <div class="box">
        <p>Nơi Sinh: </p>
        <input type="text" name="noisinh" value="">
    </div>
    <div class="box">
        <p>Lớp: </p>
        <input type="text" name="lop" value="">
    </div>
    <div class="btn">
        <input type="reset" value="Xóa" class="btn-in">
        <input type="submit" value="Đăng Ký" name="dangky" class="btn-in">
    </div>
</form>
<?php if ($masv!=""&&$ngaysinh!=""&&$noisinh!=""&&$hoten!=""&&$lop!="") {
    ?>
    <h1 align="center">Thông Tin</h1>
    <div class="show">
        <div class="box">
            <p>Mã SV: </p>
            <p><?php echo $masv ?></p>
        </div>
        <div class="box">
            <p>Họ tên: </p>
            <p><?php echo $hoten ?></p>
        </div>
        <div class="box">
            <p>Ngày Sinh: </p>
            <p><?php echo $ngaysinh ?></p>
        </div>
        <div class="box">
            <p>Giới Tính: </p>
            <p><?php echo $gioitinh ?></p>
        </div>
        <div class="box">
            <p>Nơi Sinh: </p>
            <p><?php echo $noisinh ?></p>
        </div>
        <div class="box">
            <p>Lớp: </p>
            <p><?php echo $lop ?></p>
        </div>
    </div>
<?php } ?>
</body>
</html>
