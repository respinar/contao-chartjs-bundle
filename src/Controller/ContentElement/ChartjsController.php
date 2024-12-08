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

#[AsContentElement(category: 'miscellaneous')]
class ChartjsController extends AbstractContentElementController
{

    public const TYPE = 'chartjs';

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {

        $template->set('chartType', $model->chartjs_type ?? 'bar');
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
