<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js Bundle.
 *
 * (c) Hamid Peywasti 2023-2024 <hamid@respinar.com>
 *
 * @license MIT
 */

use Contao\Controller;
use Contao\DataContainer;
use Respinar\ContaoChartjsBundle\Controller\ContentElement\ChartjsController;

$GLOBALS['TL_DCA']['tl_content']['palettes']['chartjs'] = '
    {type_legend},type,headline;
    {chartjs_legend},chartjs_type,chartjs_options;
    {chartjs_data_legend},chartjs_table;	
	{template_legend},customTpl;
	{protected_legend:hide},protected;
	{expert_legend:hide},guests,cssID;
    {invisible_legend:hide},invisible,start,stop;';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_type'] = [
    'exclude'          => true,
    'inputType'        => 'select',
    'options'          => ['line','bar','radar','pie','doughnut','polarArea'],
    'reference'        => &$GLOBALS['TL_LANG']['CTE'],
    'eval'             => ['chosen'=>true, 'tl_class'=>'w50'],
    'sql'              => "varchar(255) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_id'] = [
	'exclude'          => true,
    'inputType' 	   => 'text',
	'eval'             => ['unique' => true],
	'save_callback'    => [
		function ($value, DataContainer $dc) {
			if (empty($value) || !$dc->activeRecord) {
				return 'chart-' . uniqid();
			}
			return $value;
		},
    ],
	'sql'              => ['type' => 'string', 'length' => 255, 'default' => ''],
];
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_table'] = [
	'inputType'        => 'tableWizard',
	'eval'             => array('multiple'=>true, 'doNotSaveEmpty'=>true, 'style'=>'width:142px;height:66px'),			
	'sql'              => "mediumblob NULL"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_options'] = [
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'textarea',
    'eval'                    => ['style'=>'height:120px', 'preserveTags'=>true, 'class'=>'monospace', 'rte'=>'ace|json', 'tl_class'=>'clr'],
    'sql'                     => "text NULL"
];


$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_labels'] = [
    'inputType'        => 'listWizard',
	'eval'             => ['multiple'=>true, 'tl_class'=>'clr'],
	'sql'              => "blob NULL"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_config'] = [
	'exclude'          => true,
	'inputType'        => 'select',
	//'foreignKey'       => 'tl_chartjs_config.title',
	'eval'             => ['multiple'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50'],
	'sql'			   => "int(10) unsigned NOT NULL default 0",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_template'] = [
	'exclude'          => true,
	'inputType'        => 'select',
	'options_callback' => static function ()
	{
		return Controller::getTemplateGroup('chartjs_');
	},
	'eval'			   => ['tl_class'=>'w50 clr'],
	'sql'			   => "varchar(64) NOT NULL default ''",
];
