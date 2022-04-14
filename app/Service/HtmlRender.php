<?php

namespace Spacex\Service;

trait HtmlRender
{
    public function htmlRender(string $templatePath, array $data): string
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../../view/' . $templatePath;
        $html = ob_get_clean();

        return $html;
    }
}