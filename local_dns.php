<?php
// Page header
require "scripts/pi-hole/php/header.php";

// Set the message text to empty
$messages = '';

// Define the content file name
$content_filename = '/etc/pihole/lan.list';

// Try saving the contents to the file
if(isset($_POST['save_file']))
{
	$fp = @fopen($content_filename, 'w');
	if ($fp !== FALSE)
	{
		fwrite($fp, stripslashes($_POST['savecontent']));
		fclose($fp);
	}
	else
	{
		$messages .= sprintf('<div class="alert alert-danger alert-dismissable show" role="alert">Unable to write to the file %s</div>', $content_filename);
	}
}

// Load the file contents to show in the form
$fp = @fopen($content_filename, 'r');
if ($fp !== FALSE)
{
        $content = htmlspecialchars(fread($fp, filesize($content_filename)));
        fclose($fp);
}
else
{
	$messages .= sprintf('<div class="alert alert-danger alert-dismissable show" role="alert">Unable to read from the file %s</div>', $content_filename);
}
?>

<?=$messages?>
<div class="page-header">
<h1>Manage local DNS records</h1>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form role="form" method="post">
			<div class="box">
				<div class="box-body">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label>The DNS records</label>
							<textarea name="savecontent" class="form-control" rows="25"><?=$content?></textarea>
						</div>
					</div>
				</div>
				<div class="box-footer clearfix">
					<button type="submit" name="save_file" class="btn btn-primary" value="1">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php require "scripts/pi-hole/php/footer.php"; ?>
