<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login as Admin</title>
</head>
<style>
    .form-input {
        width: 300px;
    }

    a {
        font-family: 
    }
</style>
<div class="login-container">

</div>
<body>
    <a href="/advo">Kembali ke Halaman Utama</a>
    <br><hr>
    <fieldset>
        <legend align="center"><img src="/KomisiAdvokasi.jpg" width="100px"></legend>
        <h1 align="center">Login sebagai Minvo</h1>
        <h4 align="center">Anda mau login sebagai Minvo? Mari verifikasi diri Anda.</h4>
        <form action="/check-nim" method="post" id="form">
            <p id="error" style="color: red;"></p>
            <table cellpadding="5px">
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><input type="text" name="nim" id="nim" class="form-input" placeholder="Masukkan NIM Anda" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input type="text" name="nama" id="nama" class="form-input" placeholder="Nama akan muncul otomatis" disabled></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><input type="text" name="jabatan" id="jabatan" class="form-input" placeholder="Jabatan akan muncul otomatis" disabled></td>
                </tr>
                <tr id="passwordRow" hidden>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" id="password" class="form-input" placeholder="Masukkan password Anda"></td>
                </tr>
            </table>
            <button type="submit" id="loginButton">Login</button>
        </form>
    </fieldset>
</body>
<footer>
    <p>&copy Komisi Advokasi BPMF FTI UKSW</p>
</footer>
</html>

<script>
    const nimInput = document.getElementById('nim');
    const getNama = document.getElementById('nama');
    const getJabatan = document.getElementById('jabatan');
    const barisPassword = document.getElementById('passwordRow');
    const loginButton = document.getElementById('button');
    const form = document.getElementById('form');
    const error = document.getElementById('error');

    form.addEventListener('click', function(e) {
        e.preventDefault();

        if(loginButton.value == "Login") {

        }
    });
</script>