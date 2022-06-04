    <table id="datatables" style="width:100%;" class="pt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Avatar</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Username</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="mb-5">
            <?php $i = 1;
            foreach ($users as $user) { ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><img class="rounded gambar img-thumbnail" src="<?= base_url('assets/avatar/' . $user['avatar']) ?>" alt="<?= $user['avatar'] ?>"></td>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['telepon'] ?></td>
                    <td>
                        <button type="button" data-id="<?= $user['id'] ?>" id="editData" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDataModal">Edit</button>
                        <button id="deleteData" data-id="<?= $user['id'] ?>" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>