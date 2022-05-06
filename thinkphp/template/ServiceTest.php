<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

((new \think\App())->http)->run();

use PHPUnit\Framework\TestCase;
use app\service\{{thinkphp.service}};


/**
 * {{table.table_comment}}
 * Class {{thinkphp.service}}Test
 * @package {{thinkphp.namespace}}
 * @created {{time.fullYear}}-{{time.format_month}}-{{time.date}}
 */
class {{thinkphp.service}}Test extends TestCase
{

    /**
     * @doesNotPerformAssertions
     */
    public function testDemo()
    {
        $ret = {{thinkphp.service}}::demo();
        var_dump($ret);
    }
}
