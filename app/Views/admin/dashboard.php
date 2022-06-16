<?= $this->extend('layout/template') ?>

<?= $this->section('konten') ?>


<div id="alerthere">

</div>

<div class="container mt-3">
    <?php if (session()->getFlashdata('pesan')) {
        echo session()->getFlashdata('pesan');
    }  ?>
    <div class="row mb-3">
        <div class="col-md-12 text-right">

            <!-- Button trigger modal -->
            <button type="button" id="tambah" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+Tambah Data</button>

        </div>
    </div>
    <div class="card p-3">
        <div id="viewdata"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="admin/panel/insertajax" id="form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaDepan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" name="namaDepan" id="namaDepan" aria-describedby="namaDepanHelp">
                        <div id="namaDepanHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempatLahir" id="tempatLahir" aria-describedby="tempatLahirHelp">
                        <div id="tempatLahirHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tglLahir" id="tglLahir" aria-describedby="tglLahirHelp">
                        <div id="tglLahirHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="gender" id="gender" aria-describedby="genderHelp">
                            <option value="" disabled selected>Pilih Gender</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="gender" id="gender" aria-describedby="genderHelp"> -->
                        <div id="genderHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="noTelp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="noTelp" id="noTelp" aria-describedby="noTelpHelp">
                        <div id="noTelpHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameHelp">
                        <div id="usernameHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Re-Type Password</label>
                        <input type="password" class="form-control" name="password2" id="password2" aria-describedby="password2Help">
                        <div id="password2Help" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" accept="image/*" name="avatar" class="form-control" id="avatar" aria-describedby="avatarHelp">
                        <div id="avatarHelp" class="form-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/admin/panel/editData" id="formEdit" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaDepanEdit" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" name="idDataku" id="idDataku" hidden>
                        <input type="text" class="form-control" name="namaDepanEdit" id="namaDepanEdit" aria-describedby="namaDepanEditHelp">
                        <div id="namaDepanEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tempatLahirEdit" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempatLahirEdit" id="tempatLahirEdit" aria-describedby="tempatLahirEditHelp">
                        <div id="tempatLahirEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="tglLahirEdit" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tglLahirEdit" id="tglLahirEdit" aria-describedby="tglLahirEditHelp">
                        <div id="tglLahirEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="genderEdit" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="genderEdit" id="genderEdit" aria-describedby="genderEditHelp">
                            <option value="" disabled selected>Pilih Gender</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="gender" id="gender" aria-describedby="genderHelp"> -->
                        <div id="genderEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="noTelpEdit" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="noTelpEdit" id="noTelpEdit" aria-describedby="noTelpEditHelp">
                        <div id="noTelpEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="emailEdit" class="form-label">Email</label>
                        <input type="emailEdit" class="form-control" name="emailEdit" id="emailEdit" aria-describedby="emailEditHelp">
                        <div id="emailEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="usernameEdit" class="form-label">Username</label>
                        <input type="text" class="form-control" name="usernameEdit" id="usernameEdit" aria-describedby="usernameEditHelp">
                        <div id="usernameEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordEdit" class="form-label">Password</label>
                        <input type="passwordEdit" class="form-control" name="passwordEdit" id="passwordEdit" aria-describedby="passwordEditHelp">
                        <div id="passwordEditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password2Edit" class="form-label">Re-Type Password</label>
                        <input type="password" class="form-control" name="password2Edit" id="password2Edit" aria-describedby="password2EditHelp">
                        <div id="password2EditHelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="avatarEdit" class="form-label">Avatar</label>
                        <input type="file" accept="image/*" name="avatarEdit" class="form-control" id="avatarEdit" aria-describedby="avatarEditHelp">
                        <div id="avatarEditHelp" class="form-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showTable() {
        $.ajax({
            url: "<?= base_url("admin/panel/getData/true") ?>",
            data: {
                table: true
            },
            dataType: "json",
            success: function(res) {
                $('#viewdata').html(res.table)
            }
        });
    }

    $(document).ready(function() {
        showTable()
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#editData', function() {
            // if (confirm("Apakah Anda Yakin Akan Menghapus Data?")) {
            let idData = $(this).attr('data-id');
            $.ajax({
                url: `admin/panel/getData/false/${idData}`,
                data: {},
                dataType: "json",
                success: function(res) {
                    console.log(res.data);
                    var dataUsr = res.data.users;
                    $('#namaDepanEdit').val(dataUsr['nama']);
                    $('#tempatLahirEdit').val(dataUsr['tempat_lahir']);
                    $('#tglLahirEdit').val(dataUsr['tanggal_lahir']);
                    $('#genderEdit').val(dataUsr['gender']);
                    $('#noTelpEdit').val(dataUsr['telepon']);
                    $('#emailEdit').val(dataUsr['email']);
                    $('#usernameEdit').val(dataUsr['username']);
                    $('#passwordEdit').val(dataUsr['password']);
                    $('#password2Edit').val(dataUsr['password']);
                    // $('#avatarEdit').val(dataUsr['avatar']);
                    $('#idDataku').val(dataUsr['id']);
                    // $('#namaDepan').val()
                    // $('#viewdata').html(res.table)
                }
            });
            // }
        });

        $(document).on('click', '#deleteData', function() {
            if (confirm("Apakah Anda Yakin Akan Menghapus Data?")) {
                let idData = $(this).attr('data-id');
                $.ajax({
                    url: `admin/panel/deletedata`,
                    data: {
                        ids: idData
                    },
                    success: function(res) {
                        // var resp = JSON.parse(res);
                        alert("Data Berhasil Dihapus");
                        showTable();
                    }
                });
            }
        });

        $('#form').submit(function(e) {
            e.preventDefault();
            // var tipe = $(this).attr('tipe-req');
            datanya = new FormData(this);
            console.log(datanya);
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: datanya,
                processData: false,
                contentType: false,
                success: function(response) {
                    var respon = JSON.parse(response);
                    // console.log(respon);
                    if (respon.error) {
                        for (var key in respon.error) {
                            if (respon.error[key]) {
                                $(`#${key}`).addClass(`is-invalid`);
                                $(`#${key}Help`).addClass(`invalid-feedback`);
                                $(`#${key}Help`).html(respon.error[key]);
                            } else {
                                $(`#${key}`).removeClass(`is-invalid`);
                                $(`#${key}`).addClass(`is-valid`);

                                $(`#${key}Help`).removeClass(`invalid-feedback`);
                                $(`#${key}Help`).addClass(`valid-feedback`);
                                $(`#${key}Help`).html(`Nah gitu dong`);
                            }
                        }
                    } else {
                        // $('#alerthere').html("<?= session()->getFlashdata('notif'); ?>")
                        $('#exampleModal').modal('hide');
                        $('#namaDepan').val('');
                        $('#tempatLahir').val('');
                        $('#tglLahir').val('');
                        $('#gender').val('');
                        $('#noTelp').val('');
                        $('#email').val('');
                        $('#username').val('');
                        $('#password').val('');
                        $('#password2').val('');
                        $('#avatar').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Mantappp',
                            text: 'Data Berhasil ditambah',
                            // footer: '<a href="">Why do I have this issue?</a>'
                        })
                        showTable();
                        // $('#namaDepan').val('');
                    }
                },
            });
        });

        $('#formEdit').submit(function(e) {
            e.preventDefault();
            var tipe = $(this).attr('tipe-req');
            let idData = $('#idDataku').val();
            datanya = new FormData(this);
            console.log(datanya.keys);
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res) {
                    var resp = JSON.parse(res);
                    Swal.fire({
                        icon: 'success',
                        title: 'Mantap',
                        text: resp.sukses,
                        confirmButtonText: 'OK'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    $('#editDataModal').modal('hide');
                    showTable();
                },
            });
        });
    });
</script>

<?= $this->endSection() ?>