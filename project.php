<?php if ($project): ?>
    <form role="form">
        <h2><?php echo $projects[$project]['title'] ?></h2>
        <div class="form-group col-sm-6">
            <label for="repo">Test</label><br>
            <a href="http://<?php echo $project . $config['subdomain'] ?>/">http://<?php echo $project . $config['subdomain'] ?>/</a>
        </div>
        <div class="form-group col-sm-6 clearfix">
            <label for="repo">Live</label><br>
            <a href="<?php echo $projects[$project]['live'] ?>"><?php echo $projects[$project]['live'] ?></a>
        </div>
        <div class="form-group col-sm-12">
            <label for="repo">Name</label>
            <input class="form-control" id="name" placeholder="Git Repo" value="<?php echo $project ?>">
        </div>
        <div class="form-group col-sm-12">
            <label for="repo">Title</label>
            <input class="form-control" id="title" placeholder="Git Repo" value="<?php echo $projects[$project]['title'] ?>">
        </div>
        <div class="form-group col-sm-12">
            <label for="repo">Git Repo</label>
            <input class="form-control" id="repo" placeholder="Git Repo" value="<?php echo $projects[$project]['git'] ?>">
        </div>
        <div class="form-group col-sm-12">
            <label for="repo">Live</label>
            <input class="form-control" id="live" placeholder="Live" value="<?php echo $projects[$project]['live'] ?>">
        </div>
        <div class="form-group col-sm-12">
            <button class="btn btn-primary pull-right">Save</button>
        </div>
    </form>

<?php endif; ?>