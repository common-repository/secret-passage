<div class="wrap">
<h2>Secret Passage Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('secret_passage'); ?>
<?php do_settings_sections('secret_passage'); ?>
<input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form>

</div>
