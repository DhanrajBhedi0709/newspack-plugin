<?php
/**
 * Tests the GA 4 connector.
 *
 * @package Newspack\Tests
 */

use Newspack\Data_Events\Connectors\GA4\Event;

/**
 * Tests the GA 4 connector.
 */
class Newspack_Test_GA4_Connector extends WP_UnitTestCase {

	/**
	 * Data provider for test_validate_name
	 */
	public function validate_name_data() {
		return [
			[
				'asd123',
				true,
			],
			[
				'asd_123',
				true,
			],
			[
				'123_asd',
				false,
			],
			[
				'_asd123',
				false,
			],
			[
				'asd 123',
				false,
			],
			'40 chars' => [
				'iiiiiiiiiOiiiiiiiiiOiiiiiiiiiOiiiiiiiiiO',
				true,
			],
			'41 chars' => [
				'iiiiiiiiiOiiiiiiiiiOiiiiiiiiiOiiiiiiiiiOi',
				false,
			],
			[
				'asd123#',
				false,
			],
		];
	}

	/**
	 * Tests the validate_name method
	 *
	 * @param string $name The event name.
	 * @param bool   $expected The expected result.
	 * @dataProvider validate_name_data
	 */
	public function test_validate_name( $name, $expected ) {
		$this->assertEquals( $expected, Event::validate_name( $name ) );
	}

	/**
	 * Ensures validate_name dont accept special chars
	 */
	public function test_validate_name_special_chars() {
		$special_chars = [
			'!',
			'@',
			'#',
			'$',
			'%',
			'^',
			'&',
			'*',
			'(',
			')',
			'-',
			'=',
			'+',
			'[',
			']',
			'{',
			'}',
			'\\',
			'|',
			';',
			':',
			'"',
			"'",
			'<',
			'>',
			',',
			'.',
			'/',
			'?',
			'~',
			'`',
		];
		foreach ( $special_chars as $char ) {
			$this->assertFalse( Event::validate_name( 'asd123' . $char ) );
		}
	}

	/**
	 * Data provider for test_validate_param_name
	 */
	public function validate_param_value_data() {
		return [
			[
				'dsl2390ijd2m, #asd',
				true,
			],
			[
				123123232,
				true,
			],
			[
				'iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0',
				true,
			],
			[
				'iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0iiiiiiiii0i',
				false,
			],
			[
				[ 123 ],
				false,
			],
			[
				(object) [ 'asd' => 123 ],
				false,
			],
			[
				true,
				false,
			],
		];
	}

	/**
	 * Tests the validate_param_value method
	 *
	 * @param string $value The param value.
	 * @param bool   $expected The expected result.
	 * @dataProvider validate_param_value_data
	 */
	public function test_validate_param_value( $value, $expected ) {
		$this->assertEquals( $expected, Event::validate_param_value( $value ) );
	}

	/**
	 * Tests the validate_params method
	 *
	 * @param array $params The parameters array.
	 * @param bool  $expected The expected result.
	 * @dataProvider validate_params_data
	 */
	public function test_validate_params( $params, $expected ) {
		$this->assertEquals( $expected, Event::validate_params( $params ) );
	}

	/**
	 * Data provider for test_validate_params
	 */
	public function validate_params_data() {
		return [
			[
				[
					'param1' => 'value1',
					'param2' => 'value2',
					'param3' => 'value3',
					'param4' => 'value4',
				],
				true,
			],
			[
				[
					'invalid' => false,
					'param2'  => 'value2',
					'param3'  => 'value3',
					'param4'  => 'value4',
				],
				false,
			],
			[
				[
					'_invalid' => 'value1',
					'param2'   => 'value2',
					'param3'   => 'value3',
					'param4'   => 'value4',
				],
				false,
			],
			[
				[
					'param1'  => 'value1',
					'param2'  => 'value2',
					'param3'  => 'value3',
					'param4'  => 'value4',
					'param5'  => 'value5',
					'param6'  => 'value6',
					'param7'  => 'value7',
					'param8'  => 'value8',
					'param9'  => 'value9',
					'param10' => 'value10',
					'param11' => 'value11',
					'param12' => 'value12',
					'param13' => 'value13',
					'param14' => 'value14',
					'param15' => 'value15',
					'param16' => 'value16',
					'param17' => 'value17',
					'param18' => 'value18',
					'param19' => 'value19',
					'param20' => 'value20',
					'param21' => 'value21',
					'param22' => 'value22',
					'param23' => 'value23',
					'param24' => 'value24',
					'param25' => 'value25',
					'param26' => 'value26',
				],
				false,
			],
			[
				[
					'param1'  => 'value1',
					'param2'  => 'value2',
					'param3'  => 'value3',
					'param4'  => 'value4',
					'param5'  => 'value5',
					'param6'  => 'value6',
					'param7'  => 'value7',
					'param8'  => 'value8',
					'param9'  => 'value9',
					'param10' => 'value10',
					'param11' => 'value11',
					'param12' => 'value12',
					'param13' => 'value13',
					'param14' => 'value14',
					'param15' => 'value15',
					'param16' => 'value16',
					'param17' => 'value17',
					'param18' => 'value18',
					'param19' => 'value19',
					'param20' => 'value20',
					'param21' => 'value21',
					'param22' => 'value22',
					'param23' => 'value23',
					'param24' => 'value24',
					'param25' => 'value25',
				],
				true,
			],
		];
	}
}