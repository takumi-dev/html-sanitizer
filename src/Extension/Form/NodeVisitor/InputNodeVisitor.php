<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Extension\Form\NodeVisitor;

use HtmlSanitizer\Model\Cursor;
use HtmlSanitizer\Extension\Form\Node\InputNode;
use HtmlSanitizer\Node\NodeInterface;
use HtmlSanitizer\Visitor\AbstractNodeVisitor;
use HtmlSanitizer\Visitor\IsChildlessTagVisitorTrait;
use HtmlSanitizer\Visitor\NamedNodeVisitorInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @final
 */
class InputNodeVisitor extends AbstractNodeVisitor implements NamedNodeVisitorInterface
{
    use IsChildlessTagVisitorTrait;

    protected function getDomNodeName(): string
    {
        return 'input';
    }
    
    public function getDefaultAllowedAttributes(): array
    {
        return [
            'id', 'class', 'style', 'type', 'value', 'min', 'max', 'step', 'name', 'required', 'readonly', 'disabled', 'placeholder', 'size', 'minlength', 'maxlength',
        ];
    }

    protected function createNode(\DOMNode $domNode, Cursor $cursor): NodeInterface
    {
        return new InputNode($cursor->node);
    }
}
