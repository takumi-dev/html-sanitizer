<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Extension\Form;

use HtmlSanitizer\Extension\ExtensionInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @final
 */
class FormExtension implements ExtensionInterface
{
    public function getName(): string
    {
        return 'form';
    }

    public function createNodeVisitors(array $config = []): array
    {
        return [
            'form' => new NodeVisitor\FormNodeVisitor($config['tags']['form'] ?? []),
            'fieldset' => new NodeVisitor\FieldsetNodeVisitor($config['tags']['fieldset'] ?? []),
            'legend' => new NodeVisitor\LegendNodeVisitor($config['tags']['legend'] ?? []),
            'label' => new NodeVisitor\LabelNodeVisitor($config['tags']['label'] ?? []),
            'input' => new NodeVisitor\InputNodeVisitor($config['tags']['input'] ?? []),
            'option' => new NodeVisitor\OptionNodeVisitor($config['tags']['option'] ?? []),
            'optgroup' => new NodeVisitor\OptGroupNodeVisitor($config['tags']['optgroup'] ?? []),
            'textarea' => new NodeVisitor\TextareaNodeVisitor($config['tags']['textarea'] ?? []),
            'select' => new NodeVisitor\SelectNodeVisitor($config['tags']['select'] ?? []),
            'button' => new NodeVisitor\ButtonNodeVisitor($config['tags']['button'] ?? []),
        ];
    }
}
