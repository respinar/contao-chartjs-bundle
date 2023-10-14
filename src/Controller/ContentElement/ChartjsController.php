<?php

declare(strict_types=1);

namespace Respinar\ChartjsBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'chartjs')]
class ChartjsController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {



        $GLOBALS['TL_BODY'][] = Template::generateScriptTag('bundles/respinarchartjs/js/chart.js', false, null);
        $GLOBALS['TL_BODY'][] = Template::generateStyleTag('bundles/respinarchartjs/css/sty.css', false, null);

        return $template->getResponse();
    }
}
