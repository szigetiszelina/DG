<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['opauth_config'] = array(
                                'path' => '/DG/auth/login/', //example: /ci_opauth/auth/login/
                    			'callback_url' => '/DG/auth/authenticate/', //example: /ci_opauth/auth/authenticate/
                                'callback_transport' => 'post', //Codeigniter don't use native session
                                'security_salt' => 'your_salt',
                                'debug' => false,
                                'Strategy' => array( //comment those you don't use
                                    'Twitter' => array(
                                        'key' => 'twitter_key',
                                        'secret' => 'twitter_secret'
                                    ),
                                    'Facebook' => array(
                                        'app_id' => '745635502113326',
                                        'app_secret' => 'e42f1f5bd19c47f53a6de446012abb04',
                                        'scope' => 'read_friendlists,email,publish_actions,manage_pages'
                                        
                                    ),
                                    'Google' => array(
                                        'client_id' => 'client_id',
                                        'client_secret' => 'client_secret'
                                    ),
                                    'OpenID' => array(
										'openid_url' => 'openid_url'
									)
                                )
                            );

/* End of file ci_opauth.php */
/* Location: ./application/config/ci_opauth.php */