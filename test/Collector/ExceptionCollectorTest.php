<?php
namespace ZendDeveloperToolsTest\Collector;

use ZendDeveloperTools\Collector\ExceptionCollector;
use Zend\Mvc\Application;
use ZendDeveloperTools\Exception\SerializableException;

class ExceptionCollectorTest extends \PHPUnit_Framework_TestCase
{
    public function testCollectorAcceptsThrowables()
    {
        $collector = new ExceptionCollector();

        $error = new \Error();

        $mvcEvent = $this->getMockBuilder("Zend\Mvc\MvcEvent")
            ->getMock();

        $mvcEvent->method('getParam')
                 ->willReturn($error);

        $mvcEvent->method('getError')
                 ->willReturn(Application::ERROR_EXCEPTION);

        $collector->collect($mvcEvent);
        $this->assertInstanceOf(SerializableException::class, $collector->getException());
    }
    public function testCollectorAcceptsExceptions()
    {
        $collector = new ExceptionCollector();

        $error = new \Exception();

        $mvcEvent = $this->getMockBuilder("Zend\Mvc\MvcEvent")
            ->getMock();

        $mvcEvent->method('getParam')
                 ->willReturn($error);

        $mvcEvent->method('getError')
                 ->willReturn(Application::ERROR_EXCEPTION);

        $collector->collect($mvcEvent);
        $this->assertInstanceOf(SerializableException::class, $collector->getException());
    }
}
