<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div>
        <form action="" name="frmPhieudatphong" id="frmPhieudatphong" onsubmit="check(event)">
            <p>Ho ten *</p>
            <input type="text" name="txtHoten" id="txtHoten">
            <p>Dia Chi</p>
            <input type="text" name="txtDiachi">
            <p>CMND *</p>
            <input type="text" name="txtcmnd" id="txtcmnd">
            <p>Muc gia</p>
            <select name="cboMucgia" onchange="chkOnchange()" id="cboMucgia">
                <option value="a" selected>Loai thuong</option>
                <option value="b">Loai sang trong</option>
                <option value="c">Loai dac biet </option>
            </select>
            <p>Ngay thue</p>
            <input type="date" name="dateNgaythue" id="dateNgaythue">
            <p>Ngay tra</p>
            <input type="date" name="dateNgaytra" id="dateNgaytra">
            <p>dich vu di kem</p>
            <input type="checkbox" name="chkAnsang" id="chkAnsang">
            <label for="chkAnsang">An Sang</label>
            <input type="checkbox" name="chkGiatiut" id="chkGiatui">
            <label for="chkGiatiut">Giat ui</label>
            <input type="checkbox" name="chkBaobuoisang" id="chkBaobuoisang">
            <label for="chkBaobuoisang">Baobuoisang</label>
            <p>Tien thue phong</p>
            <input type="text" name="txtTienthuephong" id="txtTienthuephong">
            <label for="txtTienthuephong">VND</label>
            <br>
            <br>
            <button name="btnTinhdongia" onclick="date(event)">tinh Don Gia</button>
            <input type="submit" value="Dang ky" name="subDangky">
        </form>
    </div>

    <script>
        function check(event) {
            const hoten = document.getElementById("txtHoten");
            const cmnd = document.getElementById("txtcmnd");
            if (hoten.value == "") {
                alert("Ho ten ko dc rong")
                hoten.focus();
                event.preventDefault();
            }
            if (cmnd.value == "") {
                alert("CMND ko dc rong")
                cmnd.focus();
                event.preventDefault();
            }
            if (isNaN(cmnd.value)) {
                cmnd.focus();
                alert("CMND phai la so")
                event.preventDefault();
            }
        }

        function chkOnchange() {
            const cbox = document.getElementById("cboMucgia");
            const as = document.getElementById("chkAnsang");
            if (cbox.value != "a") {
                console.log(cbox.value)
                as.checked = true;
                as.disabled = true;
            }
            else {
                as.checked = false;
                as.disabled = false;
            }
        }
        function date(event) {
            const ngaythue = document.getElementById("dateNgaythue")
            const ngaytra = document.getElementById("dateNgaytra")
            if (ngaythue.value > ngaytra.value) {
                alert("ngay thue phai lon hon ngay tra")
            }
            else {
                var tong = 0;
                let nthue = new Date(ngaythue.value);
                let ntra = new Date(ngaytra.value);
                const ngay = (ntra - nthue) / 86400000;
                const mg = document.getElementById("cboMucgia").value;
                const ansang = document.getElementById("chkAnsang");
                const baobuoisang = document.getElementById("chkBaobuoisang");
                const giatui = document.getElementById("chkGiatui");
                var dichvu = 0;
                const map = {}
                map["a"] = 150
                map["b"] = 300
                map["c"] = 500
                if (ansang.checked == true && mg == "a") {
                    dichvu += 1
                }
                if (baobuoisang.checked == true) {
                    dichvu += 1
                }
                if (giatui.checked == true) {
                    dichvu += 1
                }
                tong += ((map[mg] * dichvu * 0.05) + map[mg]) * ngay
                const txtTienthuephong = document.getElementById("txtTienthuephong")
                txtTienthuephong.value = tong * 1000
            }
            event.preventDefault();
        }
    </script>

</body>

</html>