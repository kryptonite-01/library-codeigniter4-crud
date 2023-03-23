<?= $header; ?>

    <a href="<?= basename('create') ?>" class="btn btn-success">Create book</a>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($books as $book): ?>
                    <tr>
                        <td scope="row"><?= $book['id']; ?></td>
                        <td><?= $book['name']; ?></td>
                        <td>
                            <img src="<?= base_url()?>/uploads/<?=$book['image']; ?>" width="100" class="img-thumbnail" alt="">
                        </td>
                        <td>
                            <a href="<?= base_url('edit/').$book['id'];?>" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                            <a href="<?= base_url('delete/').$book['id'];?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

<?= $footer; ?>