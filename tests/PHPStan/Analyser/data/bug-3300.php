<?php declare(strict_types=1);

namespace Bug3300;

use function PHPStan\Testing\assertType;

/**
 * Class FormTypeHelper.
 */
class FormTypeHelper
{
	private const TYPE_TO_CLASS_MAP = [
		'text' => 'TextType::class',
		'group' => 'EntityManagerFormType::class',
		'number' => 'IntegerType::class',
		'select' => 'ChoiceType::class',
		'radio' => 'ChoiceType::class',
		'checkbox' => 'ChoiceType::class',
		'bool' => 'CheckboxType::class',
	];

	/**
	 * @param string $class
	 *
	 * @return string
	 *
	 * @throws \Exception
	 */
	public static function getTypeFromClass(string $class): string
	{
		$type = array_keys(self::TYPE_TO_CLASS_MAP, $class, true);

		if (0 === count($type)) {
			throw new \Exception(sprintf('No type matched class %s', $class));
		}
		if (1 < count($type)) {
			throw new \Exception(
				sprintf('Multiple types found, did you mean any of %s', implode(', ', $type))
			);
		}

		return $type[0];
	}
}
