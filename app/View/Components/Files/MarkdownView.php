<?php

namespace App\View\Components\Files;

use App\Lib\Files\FileHelper;
use Illuminate\View\Component;

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
        $this->html = FileHelper::markdownToHtml($markdown);
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
