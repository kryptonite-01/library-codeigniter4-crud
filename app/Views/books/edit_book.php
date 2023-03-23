<?= $header; ?>

<div class="col-md-4 mx-auto">
    <!-- Alert -->
    <?php if(session('message')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo session('message');  ?> 
        </div>
    <?php endif; ?>
    <!-- Edit form -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit book</h4>
        </div>
        <div class="card-body">
            <form class="needs-validation" method="post" action="<?= base_url('update')?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $book['id']; ?>">
                <div class="form-row">
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $book['name'];?>" placeholder="Enter book name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="name">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <img src="<?= base_url()?>/uploads/<?=$book['image']; ?>" width="100" class="img-thumbnail" alt="">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a class="btn btn-secondary" href="<?= base_url('list'); ?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $footer; ?>