<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name." the ".$column->name." column in table '".$tableName."'\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name." the $name relation ($modelClass has one $relationModel)\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name." the $name relation ($modelClass belongs to $relationModel)\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name." the $name relation ($modelClass has many $relationModel)\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name." the $name relation ($modelClass many to many $relationModel)\n";
            break;
            default:
                echo 'mixed $'.$name." the $name relation\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 * 
 * @package application.models
 */
class <?php echo $modelClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className the class name to instantiate
	 * @return <?php echo $modelClass; ?> the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns the name of the associated database table.
	 * @see CActiveRecord::tableName()
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	/**
	 * Returns the validation rules for attributes. 
	 * @see CModel::rules()
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Returns the relational rules that specify the relations this model uses
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * Returns the attribute labels. Attribute labels are mainly used in error messages of validation.
	 * @see CModel::attributeLabels()
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'$name' => '$label',\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

<?php
foreach($columns as $name=>$column)
{
	if($column->type==='string')
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
	}
	else
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
	}
}
?>

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}