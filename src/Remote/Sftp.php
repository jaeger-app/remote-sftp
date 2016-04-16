<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Remote/Sftp.php
 */
namespace JaegerApp\Remote;

use League\Flysystem\Sftp\SftpAdapter as Adapter;
use RuntimeException;
use JaegerApp\Remote\Sftp as m62Sftp;

/**
 * Jaeger - SFTP Transfer Abstraction
 *
 * Simple intermediary between Flysystem and JaegerApp
 *
 * @package Remote
 * @author Eric Lamb <eric@mithra62.com>
 */
class Sftp extends Adapter
{

    /**
     * (non-PHPdoc)
     * 
     * @see \League\Flysystem\Adapter\Ftp::connect()
     */
    public function connect()
    {
        @parent::connect();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \League\Flysystem\Adapter\Ftp::getMetadata()
     */
    
    /**
     *
     * @ignore (non-PHPdoc)
     * @see \League\Flysystem\Adapter\Ftp::getMetadata()
     */
    public function getMetadata($path)
    {
        return @parent::getMetadata($path);
    }

    /**
     * Returns the remote transport client
     * 
     * @param array $params
     *            An array of the connection details
     * @return \JaegerApp\Remote\Sftp
     */
    public static function getRemoteClient(array $params)
    {
        return new m62Sftp([
            'host' => $params['sftp_host'],
            'username' => $params['sftp_username'],
            'password' => $params['sftp_password'],
            'port' => $params['sftp_port'],
            'privateKey' => (isset($params['sftp_private_key']) ? $params['sftp_private_key'] : ''),
            'timeout' => (! empty($params['sftp_timeout']) ? $params['sftp_timeout'] : '30'),
            'root' => $params['sftp_root']
        ]);
    }
}