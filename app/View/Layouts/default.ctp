<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
error_reporting(E_ALL);
$cakeDescription = __d('Webonise Lab', 'Webonise Lab Project Management');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('bootstrap-theme');
        echo $this->Html->css('cakeassignment');


        echo $this->Html->script('jquery.min');
        echo $this->Html->script('bootstrap');
        echo $this->Html->script('cakeassignment');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
            <div class="container">
                <?php
                if ($this->Session->read('Auth.User'))
                    {?>
                       <!-- <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">-->
                       <nav class=" navbar navbar-default navbar-fixed-top bs-docs-nav" role="navigation">
                        <ul class="nav navbar-nav">
                            <li>
                                <?php echo $this->Html->link('Contract List',array('controller'=>'contracts','action'=>'contractlist'))?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Project List',array('controller'=>'projects','action'=>'projectlist'))?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Employee',array('controller'=>'employees','action'=>'uploademployee'))?>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <li>
                                <?php echo $this->Html->link('Logout','../users/logout');  ?>
                            </li>
                        </ul>

                </nav>
                <?php }?>
            </div>
		</div>
		<div id="content" class="contentid">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer"><?php echo $this->element('sql_dump'); ?>
		</div>
	</div>
</body>
</html>