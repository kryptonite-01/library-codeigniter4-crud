<?= $header; ?>
     
    <div class="col-md-4 mx-auto">
        <!-- Alert -->
        <?php if(session('message')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo session('message');  ?> 
            </div>
        <?php endif; ?>

        <!-- Create form -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Creata book</h4>
            </div>
            <div class="card-body">
                <form class="needs-validation" method="post" action="<?= base_url('save')?>" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="<?= old('name');?>" id="name" name="name" placeholder="Enter book name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="name">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
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