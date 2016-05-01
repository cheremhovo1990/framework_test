<?php


class BuildQueryTest extends \Codeception\TestCase\Test
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

    public function testSelect()
    {
        $built1 = new \app\BuildQuery();
        $built1->select('name');
        $except1 = 'SELECT name';
        $this->assertEquals($except1, $built1->statament());

        $built2 = new \app\BuildQuery();
        $built2->select('first, second');
        $except2 = 'SELECT first, second';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->select(['first', 'second']);
        $except3 = 'SELECT first, second';
        $this->assertEquals($except3, $built3->statament());

        $built4 = new \app\BuildQuery();
        $built4->select(['first' => 'one', 'second']);
        $except4 = 'SELECT one AS first, second';
        $this->assertEquals($except4, $built4->statament());
    }

    public function testFrom()
    {
        $built = new \app\BuildQuery();
        $built->from('Test');
        $except = ' FROM Test';
        $this->assertEquals($except, $built->statament());

        $built2 = new \app\BuildQuery();
        $built2->from('first, second');
        $except2 = ' FROM first, second';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->from(['first', 'second']);
        $except3 = ' FROM first, second';
        $this->assertEquals($except3, $built3->statament());

        $built4 = new \app\BuildQuery();
        $built4->from(['first' => 'one', 'second']);
        $except4 = ' FROM one AS first, second';
        $this->assertEquals($except4, $built4->statament());
    }

    public function testSelectAndFrom()
    {
        $built = new \app\BuildQuery();
        $built->select('name');
        $built->from('Test');

        $except = 'SELECT name FROM Test';
        $this->assertEquals($except, $built->statament());
    }

    public function testWhere()
    {
        $built1 = new \app\BuildQuery();
        $built1->where(['and', 'first=first', 'second=second']);
        $except1 = ' WHERE first=first AND second=second';
        $this->assertEquals($except1, $built1->statament());

        $built2 = new \app\BuildQuery();
        $built2->where(['or', 'first=first', 'second=second']);
        $except2 = ' WHERE first=first OR second=second';
        $this->assertEquals($except2, $built2->statament());

        $built3 = new \app\BuildQuery();
        $built3->where('status=1');
        $except3 = ' WHERE status=1';
        $this->assertEquals($except3, $built3->statament());
    }
    
    // private
    public function testCreateOperatorIntoArray()
    {
        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperatorIntoArray');
        $method->setAccessible(true);
        $arr = [];
        $method->invokeArgs ($built, [&$arr, 'where']);
        $except = ['where' => []];
        $this->assertEquals($except, $arr);
    }

    public function testBuildArray()
    {
        $built = new \app\BuildQuery();
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

        $built = new \app\BuildQuery();
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
        $built = new \app\BuildQuery();
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

        $built = new \app\BuildQuery();
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
        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 'status=1']);
        $except = ['or' => ['status=1']];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 'status=1']);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 1]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntString');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateOperandStringStringOrFloatOrInt()
    {
        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 'status']);
        $except = ['or' => ['str=status']];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 1]);
        $except = ['or' => ['str=1']];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', 1.1]);
        $except = ['or' => ['str=1.1']];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, 'str']);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandStringStringOrFloatOrInt');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', []]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateOperandIntArray()
    {
        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, ['str=1']]);
        $except = ['or' => ['and' => ['str=1']]];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createOperandIntArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'str', ['str=1']]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }

    public function testCreateStringArray()
    {
        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createStringArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 'pi', [1,2,3]]);
        $except = ['or' => ['in' => ['pi', [1,2,3]]]];
        $this->assertEquals($except, $arr);

        $built = new \app\BuildQuery();
        $method = new ReflectionMethod($built, 'createStringArray');
        $method->setAccessible(true);
        $arr = ['or' => []];
        $method->invokeArgs($built, [&$arr, 'or', 1, [1,2,3]]);
        $except = ['or' => []];
        $this->assertEquals($except, $arr);
    }
}