<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$comment = <<<JS
<?php
/**
 * Shows a list of {@link {$this->modelClass}} models
 * @uses CActiveDataProvider \$dataProvider The dataProvider containing {$this->modelClass} data
 */ 


JS;
echo $comment;

$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

$this->menu=array(
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1><?php echo $label; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
