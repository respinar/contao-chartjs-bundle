<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js Bundle.
 *
 * (c) Hamid Peywasti 2023-2024 <hamid@respinar.com>
 *
 * @license MIT
 */

use Contao\System;
use Contao\BackendUser;
use Contao\DC_Table;

/**
 * Table tl_chartjs_config
 */
$GLOBALS['TL_DCA']['tl_chartjs_config'] = [

	// Config
	'config' => [
		'dataContainer'               => DC_Table::class,
		'enableVersioning'            => true,
		'sql' => [
			'keys' => [
				'id' => 'primary'
			]
		]
	],

	// List
	'list' => [
		'sorting' => [
			'mode'                    => 1,
			'fields'                  => ['title'],
			'flag'                    => 1
		],
		'label' => [
			'fields'                  => ['title'],
			'format'                  => '%s'
		],
		'global_operations' => [
			'all' => [
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			]
		],
		'operations' => [
			'edit' => [
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
			],
			'copy' => [
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
			],
			'delete' => [
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'show' => [
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			]
		]
	],

	// Select
	'select' => [
		'buttons_callback' => []
	],

	// Edit
	'edit' => [
		'buttons_callback' => []
	],

	// Palettes
	'palettes' => [
		'__selector__'                => ['pager', 'ticker', 'adaptiveHeight', 'touchEnabled', 'controls', 'autoControls', 'auto'],
		'default'                     => '
        {title_legend},title;
        {datadecimation_legend},decimation_enabled,decimation_algorithm,decimation_samples,decimation_threshold;
        {devicepixelratio_legend},devicePixelRatio;
        {point_legend:hide},elements_point_radius,elements_point_pointStyle,elements_point_rotation,elements_point_backgroundColor,elements_point_borderWidth,elements_point_borderColor,elements_point_hitRadius,elements_point_hoverRadius,elements_point_hoverBorderWidth;
        {line_legend:hide},elements_line_tension,elements_line_backgroundColor,elements_line_borderWidth,elements_line_borderColor,elements_line_borderCapStyle,elements_line_borderDash,elements_line_borderDashOffset,elements_line_borderJoinStyle,elements_line_cubicInterpolationMode,elements_line_fill,elements_line_stepped;
        {bar_legend:hide},elements_bar_backgroundColor,elements_bar_borderWidth,elements_bar_borderColor,elements_bar_borderSkipped,elements_bar_borderRadius,elements_bar_inflateAmount,elements_bar_pointStyle;
        {arc_legend:hide},elements_arc_angle,elements_arc_backgroundColor,elements_arc_borderAlign,elements_arc_borderColor,elements_arc_borderDash,elements_arc_borderDashOffset,elements_arc_borderJoinStyle,elements_arc_borderWidth,elements_arc_circular;
        {interactions_legend:hide},interaction_mode,interaction_intersect,interaction_axis,interaction_includeInvisible,
        {events_legend:hide},events,onHover,onClick;
        {layout_legend},layout_autoPadding,layout_padding;
        {legend_legend},legend_display,legend_position,legend_align,legend_maxHeight,legend_maxWidth,legend_fullSize,legend_onClickonClick,legend_onHover,legend_onLeave,legend_reverse,legend_labels,legend_rtl,legend_textDirection,legend_title;
        {legendlabels_legend},legendlabels_boxWidth,legendlabels_boxHeight,legendlabels_color,font,legendlabels_padding,legendlabels_generateLabels,legendlabels_filter,legendlabels_sort,legendlabels_pointStyle,legendlabels_textAlign,legendlabels_usePointStyle,legendlabels_pointStyleWidth,legendlabels_useBorderRadius,legendlabels_borderRadius;
        {legendtitle_legend},legendtitle_color,legendtitle_display,legendtitle_font,legendtitle_padding,legendtitle_text;
        {locale_legend},locale;
        {responsive_legend},responsive,maintainAspectRatio,aspectRatio,onResize,resizeDelay;
        {subtitle_legend},;
        {title_legend},title_align,title_color,title_display,title_fullSize,title_position,title_font,title_padding,title_text;
        {tooltip_legend},enabled,external,mode,intersect,position,callbacks,itemSort,filter,backgroundColor,titleColor,titleFont,titleAlign,titleSpacing,titleMarginBottom,bodyColor,bodyFont,bodyAlign,bodySpacing,footerColor,footerFont,footerAlign,footerSpacing,footerMarginTop,padding,caretPadding,caretSize,cornerRadius,multiKeyBackground,displayColors,boxWidth,boxHeight,boxPadding,usePointStyle,borderColor,borderWidth,rtl,textDirection,xAlign,yAlign;
        '
	],

	// Subpalettes
	'subpalettes' => [
		''                    => '',
	],

	// Fields
	'fields' => [
		'id' => [
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		],
		'tstamp' => [
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		],
		'title' => [
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'mode' =>  [
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'horizontal',
			'options'                 => ['horizontal', 'vertical', 'fade'],
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default 'horizontal'"
		],

		'speed' =>  [
			'exclude'                 => true,
			'default'                 => 500,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 500"
		],

		'slideMargin' =>  [
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		],

		'startSlide' =>  [
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		],

		'randomStart' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'infiniteLoop' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'hideControlOnEnd' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'easing' =>  [
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => ['linear', 'swing', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)'],
			'eval'                    => ['chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default ''"
		],

		'captions' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'ticker' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'tickerHover' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],
		'adaptiveHeight' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr m12', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],
		'adaptiveHeightSpeed' =>  [
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 500,
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 500"
		],

		'video' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'responsive' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'useCSS' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'preloadImages' =>  [
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'visible',
			'options'                 => ['all', 'visible'],
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default 'visible'"
		],

		'touchEnabled' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr m12', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'swipeThreshold' =>  [
			'exclude'                 => true,
			'default'                 => 50,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 50"
		],

		'oneToOneTouch' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'preventDefaultSwipeX' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'preventDefaultSwipeY' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		/* Pager */
		'pager' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'pagerType' =>  [
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'full',
			'options'                 => ['full', 'short'],
			'eval'                    => ['tl_class' => 'w50 clr'],
			'sql'                     => "varchar(64) NOT NULL default 'full'"
		],

		'pagerShortSeparator' =>  [
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => '/',
			'inputType'               => 'text',
			'eval'                    => ['maxlength' => 64, 'tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default '/'"
		],

		/* Controls */
		'controls' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'nextText' =>  [
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 'Next',
			'inputType'               => 'text',
			'eval'                    => ['maxlength' => 64, 'tl_class' => 'w50 clr'],
			'sql'                     => "varchar(64) NOT NULL default 'Next'"
		],

		'prevText' =>  [
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 'Prev',
			'inputType'               => 'text',
			'eval'                    => ['maxlength' => 64, 'tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default 'Prev'"
		],

		'autoControls' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50 clr', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'startText' =>  [
			'exclude'                 => true,
			'default'                 => 'Start',
			'inputType'               => 'text',
			'eval'                    => ['maxlength' => 64, 'tl_class' => 'w50 clr'],
			'sql'                     => "varchar(64) NOT NULL default 'Start'"
		],

		'stopText' =>  [
			'exclude'                 => true,
			'default'                 => 'Stop',
			'inputType'               => 'text',
			'eval'                    => ['maxlength' => 64, 'tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default 'Stop'"
		],

		'autoControlsCombine' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		/* Auto */
		'auto' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'pause' =>  [
			'exclude'                 => true,
			'default'                 => 4000,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 4000"
		],

		'autoStart' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'autoDirection' =>  [
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'next',
			'options'                 => ['next', 'prev'],
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default ''"
		],

		'autoStart' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'autoHover' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'autoDelay' =>  [
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		],

		/* Carousel */
		'minSlides' =>  [
			'exclude'                 => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 1"
		],

		'maxSlides' =>  [
			'exclude'                 => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 1"
		],

		'moveSlides' =>  [
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		],
		'slideWidth' =>  [
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		],

		'thumbnail' => [
			'exclude'          => true,
			'inputType'        => 'checkbox',
			'eval'             => ['tl_class' => 'w50 m12'],
			'sql'              => ['type' => 'boolean', 'default' => false]
		],
		'thumbnailSize' => [
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'options_callback' => function () {
				return System::getContainer()
					->get('contao.image.image_sizes')
					->getOptionsForUser(BackendUser::getInstance());
			},
			'eval'                    => ['rgxp' => 'natural', 'includeBlankOption' => true, 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'w50 clr'],
			'sql'                     => "varchar(128) COLLATE ascii_bin NOT NULL default ''"
		],

		'keyboardEnabled' =>  [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],

		'ariaLive' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],
		'ariaHidden' =>  [
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => ['type' => 'boolean', 'default' => true]
		],

		'wrapperClass' =>  [
			'exclude'                 => true,
			'default'                 => 'bx-wrapper',
			'inputType'               => 'text',
			'eval'                    => ['tl_class' => 'w50'],
			'sql'                     => "varchar(64) NOT NULL default 'bx-wrapper'"
		],

		'protected' => [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => ['submitOnChange' => true],
			'sql'                     => ['type' => 'boolean', 'default' => false]
		],
		'groups' => [
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => ['mandatory' => true, 'multiple' => true],
			'sql'                     => "blob NULL",
			'relation'                => ['type' => 'hasMany', 'load' => 'lazy']
		]
	]
];
