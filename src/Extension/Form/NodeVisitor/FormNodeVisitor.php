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

use HtmlSanitizer\Extension\Form\Node\FormNode;
use HtmlSanitizer\Model\Cursor;
use HtmlSanitizer\Node\NodeInterface;
use HtmlSanitizer\Extension\Form\Sanitizer\FormSrcSanitizer;
use HtmlSanitizer\Visitor\AbstractNodeVisitor;
use HtmlSanitizer\Visitor\HasChildrenNodeVisitorTrait;
use HtmlSanitizer\Visitor\NamedNodeVisitorInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @final
 */
class FormNodeVisitor extends AbstractNodeVisitor implements NamedNodeVisitorInterface
{
    use HasChildrenNodeVisitorTrait;

    /**
     * @var FormSrcSanitizer
     */
    private $sanitizer;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->sanitizer = new FormActionSanitizer($this->config['allowed_hosts'], $this->config['force_https']);
    }

    protected function getDomNodeName(): string
    {
        return 'form';
    }

    public function getDefaultAllowedAttributes(): array
    {
        return [
            'action', 'method', 'enctype', 'id', 'class', 'style'
        ];
    }

    public function getDefaultConfiguration(): array
    {
        return [
            'allowed_hosts' => null,
            'force_https' => false,
        ];
    }

    protected function createNode(\DOMNode $domNode, Cursor $cursor): NodeInterface
    {
        $node = new FormNode($cursor->node);
        $node->setAttribute('action', $this->sanitizer->sanitize($this->getAttribute($domNode, 'action')));

        return $node;
    }
}
