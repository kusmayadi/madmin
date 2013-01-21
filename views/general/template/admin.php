<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8"/>
	<title><?php echo isset($module_action_title) ? $module_action_title . ' - ' : ''; echo isset($module_title) ? $module_title . ' - ' : ''; echo isset($title) ? $title : ''; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php echo isset($css) ? $css : ''; ?>
	
	<?php echo isset($js) ? $js : ''; ?>

</head>


<body>

	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<?php echo html::anchor('/', Kohana::$config->load('site.name'), array('class' => 'brand')); ?>
				
				<?php if (Auth::instance()->logged_in()): ?>
				<ul class="nav">
					<?php 
					// Custom menu
					foreach ($menus as $menu)
					{
						echo '<li class="dropdown">';
							echo html::anchor($menu['url'], $menu['label'].' <span class="caret"></span>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'data-target' => 'dropdown'));
							
							if (count($menu['sub']))
							{
								echo '<ul class="dropdown-menu">';
									foreach ($menu['sub'] as $submenu)
									{
										echo '<li>'.html::anchor($submenu['url'], $submenu['label']).'</li>';
									}
								echo '</ul>';
							}
							
						echo '</li>';
					}
					
					// Admin menu
					foreach ($admin_menus as $menu)
					{
						echo '<li class="dropdown">';
							echo html::anchor($menu['url'], $menu['label'].' <span class="caret"></span>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'data-target' => 'dropdown'));
							
							if (count($menu['sub']))
							{
								echo '<ul class="dropdown-menu">';
									foreach ($menu['sub'] as $submenu)
									{
										echo '<li>'.html::anchor($submenu['url'], $submenu['label']).'</li>';
									}
								echo '</ul>';
							}
							
						echo '</li>';
					}
					?>
				</ul>
				
				<ul class="nav pull-right">
					<li class="dropdown">
						<?php
						$user_name = empty(Auth::instance()->get_user()->name) ? Auth::instance()->get_user()->username : Auth::instance()->get_user()->name;
						
						echo html::anchor('profile', $user_name.' <span class="caret"></span>', array('class' => 'dropdown', 'data-toggle' => 'dropdown', 'data-target' => 'dropdown'));
						
						echo '<ul class="dropdown-menu">';

						foreach ($profile_menus as $menu)
						{
							echo '<li>'.html::anchor($menu['url'], $menu['label']).'</li>';
						}
						?>
					</li>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
	
		<?php 
		if (count($messages))
		{
			foreach ($messages as $message)
			{
				echo '<div class="alert alert-success">'.$message.'</div>';
			}
		}
		?>
		
		<?php echo isset($content) ? $content : ''; ?>
	
	</div>
	
	<footer>
		<div class="container-fluid">
			<hr>
			<p>Copyright &copy; <?php echo date('Y'); ?> <?php echo Kohana::$config->load('site.name'); ?></p>
		</div>
	</footer>

</body>

</html>