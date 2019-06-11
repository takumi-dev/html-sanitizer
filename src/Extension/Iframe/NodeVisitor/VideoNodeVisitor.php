<?php

/*
 * This file is part of the HTML sanitizer project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HtmlSanitizer\Extension\Iframe\NodeVisitor;

use HtmlSanitizer\Extension\Iframe\Node\VideoNode;
use HtmlSanitizer\Model\Cursor;
use HtmlSanitizer\Node\NodeInterface;
use HtmlSanitizer\Extension\Iframe\Sanitizer\IframeSrcSanitizer;
use HtmlSanitizer\Visitor\AbstractNodeVisitor;
use HtmlSanitizer\Visitor\HasChildrenNodeVisitorTrait;
use HtmlSanitizer\Visitor\NamedNodeVisitorInterface;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 *
 * @final
 */
class VideoNodeVisitor extends AbstractNodeVisitor implements NamedNodeVisitorInterface
{
    use HasChildrenNodeVisitorTrait;

    /**
     * @var IframeSrcSanitizer
     */
    private $sanitizer;

    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->sanitizer = new IframeSrcSanitizer($this->config['allowed_hosts'], $this->config['force_https']);
    }

    protected function getDomNodeName(): string
    {
        return 'video';
    }

    public function getDefaultAllowedAttributes(): array
    {
        return [
            'src', 'poster', 'preload', 'width', 'height', 'frameborder', 'title',
            'autoplay', 'loop', 'muted', 'controls',
            
            // YouTube integration
            'allow', 'allowfullscreen',
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
        $node = new VideoNode($cursor->node);
        $node->setAttribute('src', $this->sanitizer->sanitize($this->getAttribute($domNode, 'src')));

        return $node;
    }
}
