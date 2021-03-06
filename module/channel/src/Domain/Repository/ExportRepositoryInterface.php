<?php
/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Channel\Domain\Repository;

use Ergonode\Channel\Domain\Entity\Export;
use Ergonode\SharedKernel\Domain\Aggregate\ExportId;
use Ergonode\SharedKernel\Domain\AggregateId;

interface ExportRepositoryInterface
{
    public function load(ExportId $id): ?Export;

    public function save(Export $export): void;

    public function exists(ExportId $id): bool;

    public function delete(Export $export): void;

    public function addLine(ExportId $exportId, AggregateId $objectId): void;

    public function processLine(ExportId $exportId, AggregateId $objectId): void;

    /**
     * @param string[] $parameters
     */
    public function addError(ExportId $exportId, string $message, array $parameters = []): void;
}
