<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$comment = <<<JS
<?php
/**
 * A view used to create new {@link {$this->modelClass}} models
 * @uses {$this->modelClass} \$model The {$this->modelClass} model to be inserted
 */ 


JS;
echo $comment;

$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>Create <?php echo $this->modelClass; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
