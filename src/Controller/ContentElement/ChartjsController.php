<?php

declare(strict_types=1);

namespace Respinar\ContaoChartjsBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'chartjs', template: 'ce_chartjs')]
class ChartjsController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {

        $template->type = $model->chartjs_type;
        $template->data = $model->chartjs_data;


        $GLOBALS['TL_HEAD'][] = Template::generateScriptTag('bundles/respinarchartjs/js/chart.umd.js', false, null);
        $GLOBALS['TL_BODY'][] = Template::generateStyleTag('bundles/respinarchartjs/css/style.css', false, null);

        return $template->getResponse();
    }
}
