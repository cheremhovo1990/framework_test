<?php

use app\BaseBuilder;

class TestBaseBuilder extends BaseBuilder
{

}

class BaseBuilderTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateOperatorIntoArray()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperatorIntoArray');
        $method->setAccessible(true);
        $arr = [];
        $method->invokeArgs ($built, [&$arr, 'where']);
        $except = ['where' => []];
        $this->assertEquals($except, $arr);
    }

    public function testBuildArray()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildArray');
        $method->setAccessible(true);
        $arr = [];
        $query = [
            'and',
            'status=1',
            'key' => 'value',
            'pi' => [
                0,
                1,
                2
            ],
            [
                'and',
                'status=1',
                'key' => 'value',
                'pi' => [
                    0,
                    1,
                    2
                ]
            ]
        ];

        $method->invokeArgs($built, [&$arr, $query]);

        $except = [
            'and' => [
                'status=1',
                'key=value',
                'in' => [
                    'pi',
                    [
                        0,
                        1,
                        2
                    ]
                ],
                'and' => [
                    'status=1',
                    'key=value',
                    'in' => [
                        'pi',
                        [
                            0,
                            1,
                            2
                        ]
                    ],
                ]
            ]
        ];

        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildArray');
        $method->setAccessible(true);
        $arr = [];
        $query = [
            'or',
            'status=1',
            'key' => 'value',
            'pi' => [
                0,
                1,
                2
            ],
            [
                'or',
                'status=1',
                'key' => 'value',
                'pi' => [
                    0,
                    1,
                    2
                ]
            ]
        ];

        $method->invokeArgs($built, [&$arr, $query]);

        $except = [
            'or' => [
                'status=1',
                'key=value',
                'in' => [
                    'pi',
                    [
                        0,
                        1,
                        2
                    ]
                ],
                'or' => [
                    'status=1',
                    'key=value',
                    'in' => [
                        'pi',
                        [
                            0,
                            1,
                            2
                        ]
                    ],
                ]
            ]
        ];

        $this->assertEquals($except, $arr);
    }

    public function testCreateOperator()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperator');
        $method->setAccessible(true);
        $arr = [];
        $query = [
            'and',
            'status=1',
            'key' => 'value',
            'pi' => [
                0,
                1,
                2
            ],
            [
                'and',
                'status=1',
                'key' => 'value',
                'pi' => [
                    0,
                    1,
                    2
                ]
            ]
        ];

        $method->invokeArgs($built, [&$arr, 'and', $query]);

        $except = [
            'and' => [
                'status=1',
                'key=value',
                'in' => [
                    'pi',
                    [
                        0,
                        1,
                        2
                    ]
                ],
                'and' => [
                    'status=1',
                    'key=value',
                    'in' => [
                        'pi',
                        [
                            0,
                            1,
                            2
                        ]
                    ],
                ]
            ]
        ];

        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperator');
        $method->setAccessible(true);
        $arr = [];
        $query = [
            'or',
            'status=1',
            'key' => 'value',
            'pi' => [
                0,
                1,
                2
            ],
            [
                'or',
                'status=1',
                'key' => 'value',
                'pi' => [
                    0,
                    1,
                    2
                ]
            ]
        ];

        $method->invokeArgs($built, [&$arr, 'or', $query]);

        $except = [
            'or' => [
                'status=1',
                'key=value',
                'in' => [
                    'pi',
                    [
                        0,
                        1,
                        2
                    ]
                ],
                'or' => [
                    'status=1',
                    'key=value',
                    'in' => [
                        'pi',
                        [
                            0,
                            1,
                            2
                        ]
                    ],
                ]
            ]
        ];

        $this->assertEquals($except, $arr);
    }

    public function testCreateOperandIntString()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 'status=1']);
        $except = ['or' => ['status=1']];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 'status=1']);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 1]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateOperandStringStringOrFloatOrInt()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 'status']);
        $except = ['or' => ['str=status']];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 1]);
        $except = ['or' => ['str=1']];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 1.1]);
        $except = ['or' => ['str=1.1']];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 'str']);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateOperandIntArray()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, ['str=1']]);
        $except = ['or' => ['and' => ['str=1']]];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createOperandIntArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', ['str=1']]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateStringArray()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createStringArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'pi', [1,2,3]]);
        $except = ['or' => ['in' => ['pi', [1,2,3]]]];
        $this->assertEquals($except, $arr);

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'createStringArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, [1,2,3]]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testBuildWhere()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildWhere');
        $method->setAccessible(true);
        $built->build['where'] = [
            'and' => [
                'status=1',
                'status=2',
                'status=3',
            ]
        ];
        $except = ' WHERE (status=1 AND status=2 AND status=3)';
        $this->assertEquals($except, $method->invoke($built));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildWhere');
        $method->setAccessible(true);
        $built->build['where'] = [
            'or' => [
                'status=1',
                'status=2',
                'status=3',
            ]
        ];
        $except = ' WHERE (status=1 OR status=2 OR status=3)';
        $this->assertEquals($except, $method->invoke($built));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildWhere');
        $method->setAccessible(true);
        $built->build['where'] = 'status=1';
        $except = ' WHERE status=1';
        $this->assertEquals($except, $method->invoke($built));
    }

    public function testBuildAndOr()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOr');
        $method->setAccessible(true);
        $build = [
            'and' => [
                'status=1',
                'status=2',
                'status=3',
                'and' => [
                    'status=1',
                    'status=2',
                    'status=3',
                ],
            ]
        ];
        $except = '(status=1 AND status=2 AND status=3 AND (status=1 AND status=2 AND status=3))';
        $this->assertEquals($except, $method->invoke($built, $build));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOr');
        $method->setAccessible(true);
        $build = [
            'or' => [
                'status=1',
                'status=2',
                'status=3',
                'or' => [
                    'status=1',
                    'status=2',
                    'status=3',
                ],
            ]
        ];
        $except = '(status=1 OR status=2 OR status=3 OR (status=1 OR status=2 OR status=3))';
        $this->assertEquals($except, $method->invoke($built, $build));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOr');
        $method->setAccessible(true);
        $build = [
            'or' => [
                'status=1',
                'status=2',
                'status=3',
                'and' => [
                    'status=1',
                    'status=2',
                    'status=3',
                ],
            ]
        ];
        $except = '(status=1 OR status=2 OR status=3 OR (status=1 AND status=2 AND status=3))';
        $this->assertEquals($except, $method->invoke($built, $build));
    }

    public function testBuildAndOrOr()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOrOr');
        $method->setAccessible(true);
        $build = [
            'or' => [
                'status=1',
                'status=2',
                'status=3',
                'and' => [
                    'status=1',
                    'status=2',
                    'status=3',
                ],
            ]
        ];
        $except = '(status=1 OR status=2 OR status=3 OR (status=1 AND status=2 AND status=3))';
        $this->assertEquals($except, $method->invoke($built, $build, 'or'));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOrOr');
        $method->setAccessible(true);
        $build = [
            'and' => [
                'status=1',
                'status=2',
                'status=3',
                'and' => [
                    'status=1',
                    'status=2',
                    'status=3',
                ],
            ]
        ];
        $except = '(status=1 AND status=2 AND status=3 AND (status=1 AND status=2 AND status=3))';
        $this->assertEquals($except, $method->invoke($built, $build, 'and'));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'buildAndOrOr');
        $method->setAccessible(true);
        $build = [
            'and' => [
                'in' => [
                    'str',
                    [1,2,3]
                ],
            ]
        ];
        $except = '(str IN (1, 2, 3))';
        $this->assertEquals($except, $method->invoke($built, $build, 'and'));
    }

    public function testShielding()
    {
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
        $active = 'name';
        $except = '`name`';
        $this->assertEquals($except, $method->invoke($built, $active));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
        $active = ' name ';
        $except = '`name`';
        $this->assertEquals($except, $method->invoke($built, $active));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
        $active = 'name as asname';
        $except = '`name` as `asname`';
        $this->assertEquals($except, $method->invoke($built, $active));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
        $active = 'name.id';
        $except = '`name`.`id`';
        $this->assertEquals($except, $method->invoke($built, $active));

        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
        $active = 'id, email.div';
        $except = '`id`, `email`.`div`';
        $built = new TestBaseBuilder();
        $method = new ReflectionMethod($built, 'shielding');
        $method->setAccessible(true);
    }
}