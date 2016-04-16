<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/FtpTest.php
 */
namespace JaegerApp\tests\Remote;

use JaegerApp\Remote\Sftp;

/**
 * Jaeger - Sftp Remote Object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Remote\Sftp object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class SftpTest extends \PHPUnit_Framework_TestCase
{

    private function getSftpInstance()
    {
        $settings = $this->getSftpCreds();
        $sftp = new Sftp([
            'host' => $settings['sftp_host'],
            'username' => $settings['sftp_username'],
            'password' => $settings['sftp_password'],
            'port' => $settings['sftp_port'],
            'timeout' => (! empty($settings['sftp_timeout']) ? $settings['sftp_timeout'] : '30')
        ]);
        
        return $sftp;
    }

    public function testInstance()
    {
        $ftp = $this->getSftpInstance();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', $ftp);
    }

    public function testGetRemoteClient()
    {
        $settings = $this->getSftpCreds();
        $this->assertInstanceOf('\League\Flysystem\AdapterInterface', Sftp::getRemoteClient($settings));
    }

    public function testConnect()
    {
        $sftp = $this->getSftpInstance();
        $sftp->connect();
        $this->assertInstanceOf('\phpseclib\Net\SFTP', $sftp->getConnection());
        $sftp->disconnect();
    }

    /**
     * The SFTP Test Credentials
     *
     * @return array
     */
    protected function getSftpCreds()
    {
        return include 'data/sftpcreds.config.php';
    }    
}