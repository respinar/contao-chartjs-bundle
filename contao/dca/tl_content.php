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
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_type'] = array
(
    'exclude'          => true,
    'inputType'        => 'select',
    'options'          => array('line','bar','bubble','pie','polarArea','radar','scatter','mixed'),
    'reference'        => &$GLOBALS['TL_LANG']['CTE'],
    'eval'             => array('chosen'=>true, 'tl_class'=>'w50'),
    'sql'              => "varchar(255) NOT NULL default ''"

);
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_config'] = array
(
	'exclude'          => true,
	'inputType'        => 'select',
	//'foreignKey'       => 'tl_chartjs_config.title',
	'eval'             => array('multiple'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'			   => "int(10) unsigned NOT NULL default 0",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_data'] = array
(
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'textarea',
    'eval'                    => array('style'=>'height:120px', 'preserveTags'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'tl_class'=>'clr'),
    'sql'                     => "text NULL"

);
$GLOBALS['TL_DCA']['tl_content']['fields']['chartjs_template'] = array
(
	'exclude'          => true,
	'inputType'        => 'select',
	'options_callback' => static function ()
	{
		return Controller::getTemplateGroup('chartjs_');
	},
	'eval'			   => array('tl_class'=>'w50 clr'),
	'sql'			   => "varchar(64) NOT NULL default ''",
);
