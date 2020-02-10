<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\ProductCollection\Application\Form\Transformer;

use Ergonode\Product\Domain\Entity\ProductId;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 */
class ProductIdDataTransformer implements DataTransformerInterface
{
    /**
     * @param ProductId|null $value
     *
     * @return null|string
     */
    public function transform($value): ?string
    {
        if ($value) {
            if ($value instanceof ProductId) {
                return $value->getValue();
            }
            throw new TransformationFailedException('Invalid Product Id object');
        }

        return null;
    }

    /**
     * @param string|null $value
     *
     * @return ProductId|null
     */
    public function reverseTransform($value): ?ProductId
    {
        if ($value) {
            try {
                return new ProductId($value);
            } catch (\InvalidArgumentException $e) {
                throw new TransformationFailedException(sprintf('Invalid "%s" value', $value));
            }
        }

        return null;
    }
}