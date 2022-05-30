<?= $this->extend('layout/template') ?>

<?= $this->section('konten') ?>


<div id="alerthere">

</div>

<div class="container mt-3">
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

<script>
    function showTable() {
        $.ajax({
            url: "<?= base_url("admin/panel/getData") ?>",
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
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
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
                        $('#alerthere').html("<?= session()->getFlashdata('notif'); ?>")
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
                        showTable();
                        // $('#namaDepan').val('');
                    }
                },
            });
        });
    });
</script>

<?= $this->endSection() ?>