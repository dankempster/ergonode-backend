<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Designer\Infrastructure\Persistence\Repository\Decorator;

use Ergonode\Designer\Domain\Entity\Template;
use Ergonode\Designer\Domain\Repository\TemplateRepositoryInterface;
use Ergonode\SharedKernel\Domain\Aggregate\TemplateId;

class CacheTemplateRepositoryDecorator implements TemplateRepositoryInterface
{
    private TemplateRepositoryInterface $repository;

    /**
     * @var array
     */
    private array $cache = [];

    public function __construct(TemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     */
    public function load(TemplateId $id): ?Template
    {
        $key = $id->getValue();
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = $this->repository->load($id);
        }

        return $this->cache[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function save(Template $template): void
    {
        $this->repository->save($template);
        $this->cache[$template->getId()->getValue()] = $template;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Template $template): void
    {
        $this->repository->delete($template);
        $this->cache[$template->getId()->getValue()] = $template;
    }
}
