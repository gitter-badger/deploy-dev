<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
$(function(){
	$('#update').click(function(e){
		e.preventDefault();
		var $this = $(this)
		$this.button('loading');
		$.get('?update=1&query=1', function(){
			$this.button('reset');
			window.location.reload();
		});
	});
    $('.deploy-production').click(function(e){
        e.preventDefault();
        var $this = $(this);
        $this.button('loading');
        var project = $this.parents('.tab-pane').attr('id');
        $.getJSON('shell.php', {action: 'deploy-production', project: project}, function(response){
            $this.button('reset');
            var content = '';
            for(i in response.message) {
                content += '<p>'+response.message[i]+'</p>';
            }
            $("#alert").show();
            $("#alert-content").html(content);
        });
    })
    $("#alert .close").click(function(e){
        e.preventDefault();
        $("#alert").hide();
    })
})
    </script>
</head>
<body>
<div id="alert" class="alert fade in" style="display: none; position: absolute; right: 10px">
    <a class="close" href="#">×</a>
    <strong>Finished!</strong>
    <div id="alert-content"></div>
</div>
<div class="container">
    <div class="span12">
        <div class="row">
            <div class="span2">
                <div class="tab-content span2">
                    <div class="tab-pane active" id="home">
                        <div class="well" style="padding: 8px 0;">
							<ul class="nav nav-list">
                                <li class="nav-header">
                                    Projects
                                </li>
                                <?php foreach($repos as $repo): ?>
                                <li>
                                    <a href="#<?php echo $repo['id']?>" data-toggle="tab"><i class="icon-ok"></i> <?php echo $repo['name']?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="nav nav-list">
								<li class="nav-header">Last updated</li>
								<li class="summary">
									<p><?php echo $updated; ?></p>
									<a id="update" href="#" class="btn" data-loading-text="updating ...">Update</a>
								</li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6 offset1">
               <div class="tab-content" style="overflow: visible;">
                    <?php foreach($repos as $repo): ?>
                    <div class="tab-pane well" id="<?php echo $repo['id']?>">
                        <h2><?php echo $repo['name']?></h2>
                        <fieldset>
                            <legend>Testing Server</legend>
                            <div class="control-group">
                                <div class="control-label">
                                    <input value="<?php echo $repo['id']?>">.testing.web4life.com.ua
                                </div>
                                <div class="controls">
                                    <div class="btn-toolbar" style="display: inline-block;padding-top: 5px">
                                        <div class="btn-group">
                                            <a href="#" class="create-testing btn btn-success">Create</a>
                                        </div>
                                        <div class="btn-group ">
                                          <a class="deploy-testing btn btn-warning" href="#"><i class="icon-refresh icon-white"></i> Deploy</a>
                                          <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                            <li><a href="#">master</a></li>
                                            <li class="divider"></li>

                                            <?php foreach($repo['branches'] as $branch=>$commit): ?>
                                            <li><a href="#"><?php echo $branch; ?></a></li>
                                            <?php endforeach; ?>
                                          </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </fieldset>

                            <fieldset>
                                <legend>Staging Server</legend>
                                <div class="control-group">
                                    <div class="control-label">
                                        <input value="<?php echo $repo['id']?>">.staging.web4life.com.ua
                                    </div>
                                    <div class="controls">
                                        <a href="#" class="create-staging btn btn-success">Create</a>
                                        <a class="deploy-staging btn btn-warning disabled"><i class="icon-refresh icon-white"></i> Deploy</a>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Production Server</legend>
                                <div class="control-group">
                                    <div class="control-label">
                                        <?php
                                            $server = file_exists('/var/www/razbakov/data/www/'.$repo['id'].'.web4life.com.ua');
                                        ?>
                                        <?php if($server): ?>
                                            <?php echo $repo['id'] ?>.web4life.com.ua
                                        <?php else: ?>
                                            <input value="<?php echo $repo['id'] ?>">.web4life.com.ua
                                        <?php endif; ?>
                                    </div>
                                    <div class="controls">
                                        <?php if(!$server): ?>
                                        <a href="#" class="create-staging btn btn-success">Create</a>
                                        <?php endif; ?>
                                        <button class="deploy-production btn btn-warning <?php if(!$server): ?>disabled<?php endif; ?>" data-loading-text="deploying ..."><i class="icon-refresh icon-white"></i> Deploy</button>
                                        <?php if($server): ?>
                                        <a href="#" style="float: right;" class="create-staging btn btn-danger">Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </fieldset>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>