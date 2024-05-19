<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js Bundle.
 *
 * (c) Hamid Peywasti 2023-2024 <hamid@respinar.com>
 *
 * @license MIT
 */

namespace Respinar\ContaoChartjsBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'chartjs')]
class ChartjsController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {

        // Deserialize the headline field
        $headline = StringUtil::deserialize($model->headline, true);

        // Pass both the headline text and level (hl) to the template
        $template->set('headline', $headline['value'] ?? '');
        $template->set('hl', $headline['unit'] ?? 'h2');

        $template->set('type', $model->chartjs_type ?? 'bar');
        $template->set('options', $model->chartjs_options ?? '{}');

        $chart_table = StringUtil::deserialize($model->chartjs_table);  

        $chart_labels =  array_shift($chart_table);
        
        array_shift($chart_labels);

        $template->set('labels', json_encode($chart_labels));

        $datasets = [];
        foreach( $chart_table as $chart_data ) {

            $data_label = array_shift($chart_data);

            $datasets[] = [
                'label' => $data_label,
                'data' => $chart_data
            ];
        };

        $template->set( 'datasets', json_encode($datasets));


        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/respinarcontaochartjs/js/chart.umd.js|static';

        return $template->getResponse();
    }
}
