<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    /**
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->helpers = array_merge($this->helpers, ['url', 'form', 'text', 'html', 'cookie', 'language', 'data', 'auth']);

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = service('session');
        
        // Language handling
        $language = $this->session->get('lang') ?: config('App')->defaultLocale;
        service('language')->setLocale($language);

        // Fetch Global Module Configs & Settings
        $db = \Config\Database::connect();
        $modules = $db->table('global_modules')->get()->getResultArray();
        $moduleStatus = [];
        foreach($modules as $m) {
            $moduleStatus[$m['module_key']] = $m['is_enabled'];
        }
        config('App')->moduleStatus = $moduleStatus; // Semi-global storage

        // Dynamic Timezone Implementation
        $tzRes = $db->table('settings')->where('key', 'timezone')->get()->getRow();
        if ($tzRes && !empty($tzRes->value)) {
            config('App')->appTimezone = $tzRes->value;
            date_default_timezone_set($tzRes->value);
        }
    }
}
