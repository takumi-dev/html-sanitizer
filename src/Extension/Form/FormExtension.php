<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Extension\Iframe;

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
            'input' => new NodeVisitor\InputNodeVisitor($config['tags']['input'] ?? []),
            'textarea' => new NodeVisitor\TextareaNodeVisitor($config['tags']['textarea'] ?? []),
            'select' => new NodeVisitor\SelectNodeVisitor($config['tags']['select'] ?? []),
            'button' => new NodeVisitor\ButtonNodeVisitor($config['tags']['button'] ?? []),
        ];
    }
}