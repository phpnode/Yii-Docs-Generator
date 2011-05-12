<?php echo "<?php\n"; ?>
/**
 * The <?php echo $this->moduleID; ?> module.
 * @package application.modules.<?php echo $this->moduleID."\n"; ?>
 */
class <?php echo $this->moduleClass; ?> extends CWebModule
{
	/**
	 * Called when the module is being created.
	 * Put any module specific configuration here
	 */
	public function init()
	{
		
		// import the module-level models and components
		$this->setImport(array(
			'<?php echo $this->moduleID; ?>.models.*',
			'<?php echo $this->moduleID; ?>.components.*',
		));
	}
	/**
	 * This function is called before the controller action is run
	 * @param CController $controller The controller to run
	 * @param CAction $action The action to run on the controller
	 * @return boolean True if the action should be executed, false if the action should be stopped
	 */
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
