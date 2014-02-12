<?php if ($project): ?>
    <form role="form">
        <h2><?php echo $projects[$project]['title'] ?></h2>
        <div class="form-group col-sm-3">
            <label for="repo">Git Repo</label>
            <input class="form-control" id="repo" placeholder="Git Repo" value="<?php echo $projects[$project]['git'] ?>"><br>
            <button class="btn btn-primary">Load</button>
        </div>
    </form>
<?php endif; ?>