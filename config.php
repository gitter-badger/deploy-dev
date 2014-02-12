<?php if ($config): ?>
    <form role="form">
        <h2>Configuration</h2>
            <?php foreach($config as $id => $value): ?>
            <div class="form-group col-sm-12">
                <label for="repo"><?php echo $id ?></label>
                <input class="form-control" id="<?php echo $id ?>" placeholder="<?php echo $id ?>" value="<?php echo $value ?>">
            </div>
            <?php endforeach; ?>
            <button class="btn btn-primary">Save</button>
    </form>
<?php endif; ?>