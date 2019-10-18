<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Condition\Infrastructure\Grid;

use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Grid\AbstractGrid;
use Ergonode\Grid\Column\LinkColumn;
use Ergonode\Grid\Column\TextColumn;
use Ergonode\Grid\Filter\TextFilter;
use Ergonode\Grid\GridConfigurationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 */
class ConditionSetGrid extends AbstractGrid
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function init(GridConfigurationInterface $configuration, Language $language): void
    {
        $filters = $configuration->getFilters();

        $id = new TextColumn('id', $this->trans('Id'));
        $id->setVisible(false);
        $this->addColumn('id', $id);
        $this->addColumn('code', new TextColumn('code', $this->trans('Code'), new TextFilter($filters->get('code'))));
        $this->addColumn('name', new TextColumn('name', $this->trans('Name'), new TextFilter($filters->get('name'))));
        $this->addColumn('description', new TextColumn('description', $this->trans('Description'), new TextFilter($filters->get('description'))));
        $this->addColumn('_links', new LinkColumn('hal', [
            'get' => [
                'route' => 'ergonode_designer_template_read',
                'parameters' => ['language' => $language->getCode(), 'template' => '{id}'],
            ],
            'edit' => [
                'route' => 'ergonode_designer_template_change',
                'parameters' => ['language' => $language->getCode(), 'template' => '{id}'],
                'method' => Request::METHOD_PUT,
            ],
            'delete' => [
                'route' => 'ergonode_designer_template_delete',
                'parameters' => ['language' => $language->getCode(), 'template' => '{id}'],
                'method' => Request::METHOD_DELETE,
            ],
        ]));
        $this->setConfiguration(self::PARAMETER_ALLOW_COLUMN_RESIZE, true);
    }

    /**
     * @param string $id
     * @param array  $parameters
     *
     * @return string
     */
    private function trans(string $id, array $parameters = []): string
    {
        return $this->translator->trans($id, $parameters, 'grid');
    }
}