<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Importer\Infrastructure\Handler\Import;

use Ergonode\Importer\Domain\Command\Import\EndImportCommand;
use Ergonode\Importer\Domain\Repository\ImportRepositoryInterface;
use Webmozart\Assert\Assert;

class EndImportCommandHandler
{
    private ImportRepositoryInterface $repository;

    public function __construct(ImportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \ReflectionException
     */
    public function __invoke(EndImportCommand $command): void
    {
        $import = $this->repository->load($command->getId());
        Assert::notNull($import);
        $import->end();
        $this->repository->save($import);
    }
}
