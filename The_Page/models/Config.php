<?php
/**
 * Config.php Database Class base model for other models
 * 
 * PHP Version 7.4.4
 * 
 * @category  PHP_WebApplication_Software
 * @package   User_Management_System
 * @author    PDF File Viewer <info@filepdfs.work>
 * @copyright 2021 PDF File Viewer
 * @license   SSLIC: https://filepdfs.work
 * @link      https://filepdfs.work
 */

class Config
{
	const SYSTEM_TIMEZONE           = 'America/Kentucky/Monticello';
	const EMAIL_SMTP_METHOD         = 'yes';
	const SYSTEM_EMAIL_ID           = 'info@filepdfs.work';
	const SYSTEM_EMAIL_PASSWORD     = 'k9&AD^m$&RtI';
	const SYSTEM_EMAIL_HOST         = 'filepdfs.work';
	const SYSTEM_EMAIL_SENDER_NAME  = 'PDF File Viewer';
	const SYSTEM_PORT_NO            = 587;
	const APP_ADDRESS               = 'https://filepdfs.work';


	/**
	 * Error & Success messasge alert
	 * 
	 * @param $type    The type of error message
	 * @param $message The message string to be displayed
	 * 
	 * @return html  
	 */
	public function showMessage($type, $message)
	{
		return  '<div class="alert alert-' . $type . ' alert-dismissible"> 
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong class="text-center">' . $message . '</strong>
				</div>';
	}

	public function scream($item)
    {
        echo $item;
    }
}
