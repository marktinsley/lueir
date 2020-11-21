<?php

namespace App\View\Components\Files;

use Illuminate\View\Component;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class MarkdownView extends Component
{
    public string $html;

    /**
     * Create a new component instance.
     *
     * @param string|null $markdown
     */
    public function __construct(?string $markdown)
    {
        $this->html = (new GithubFlavoredMarkdownConverter())->convertToHtml($markdown);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.files.markdown-view');
    }
}
