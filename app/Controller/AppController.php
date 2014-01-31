<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'projects/projectlist',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            )
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }
    //set cache
    public function setcache($key,$data)
    {
        Cache::write($key, $data, '_cake_model_');
        Cache::write($key, $data, '_APC_');
        Cache::write($key, $data, '_Memcache_');
    }
    //get cache for key
    public function getcache($key)
    {
        $result1 = Cache::read($key, '_APC_');
        if($result1 =='')
        {
            $result2 = Cache::read($key, '_Memcache_');
            if($result2 =='')
            {
                $result = Cache::read($key, '_cake_model_');
            }
            else
            {
                $result = $result2;
            }
        }
        else
        {
            $result = $result1;
        }
        return $result;
    }
    //delete cache
    public function removecache($key)
    {
        Cache::delete($key, '_APC_');
        Cache::delete($key, '_Memcache_');
        Cache::delete($key, '_cake_model_');
    }
}
