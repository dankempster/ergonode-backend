<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Segment\Domain\Query;

use Ergonode\Grid\DataSetInterface;
use Ergonode\SharedKernel\Domain\Aggregate\SegmentId;

interface SegmentProductsQueryInterface
{
    public function getDataSet(SegmentId $segmentId): DataSetInterface;

    /**
     * @return string[]
     */
    public function getProducts(SegmentId $segmentId): array;

    /**
     * @return array
     */
    public function getProductsByType(SegmentId $segmentId, string $type): array;
}
