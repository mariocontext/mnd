<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<ul class="ccm-manual-nav">
<?php  foreach ($links as $link): ?>
	<li>
		<a href="<?php  echo $link->url; ?>">
			<?php  echo htmlentities($link->text, ENT_QUOTES, APP_CHARSET); ?>
		</a>
	</li>
<?php  endforeach; ?>
</ul>
