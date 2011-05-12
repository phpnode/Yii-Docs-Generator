<?php echo "<?php\n"; ?>
/**
 * The default controller for <?php echo $this->moduleClass."\n"; ?>
 * @package application.modules.<?php echo $this->moduleID; ?>.controllers
 *
 */
class DefaultController extends Controller
{
	/**
	 * The default index action
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
}