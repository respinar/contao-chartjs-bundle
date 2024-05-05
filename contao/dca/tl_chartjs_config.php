<?php

declare(strict_types=1);

/*
 * This file is part of Contao Chart.js Bundle.
 *
 * (c) Hamid Peywasti 2023 <hamid@respinar.com>
 *
 * @license MIT
 */

use Contao\System;
use Contao\BackendUser;
use Contao\DC_Table;

/**
 * Table tl_chartjs_config
 */
$GLOBALS['TL_DCA']['tl_chartjs_config'] = array(

	// Config
	'config' => array(
		'dataContainer'               => DC_Table::class,
		'enableVersioning'            => true,
		'sql' => array(
			'keys' => array(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array(
		'sorting' => array(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1
		),
		'label' => array(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
		'global_operations' => array(
			'all' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array(
			'edit' => array(
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
			),
			'copy' => array(
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
			),
			'delete' => array(
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array(
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	// Select
	'select' => array(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array(
		'__selector__'                => array('pager', 'ticker', 'adaptiveHeight', 'touchEnabled', 'controls', 'autoControls', 'auto'),
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
	),

	// Subpalettes
	'subpalettes' => array(
		''                    => '',
	),

	// Fields
	'fields' => array(
		'id' => array(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array(
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'title' => array(
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'mode' =>  array(
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'horizontal',
			'options'                 => array('horizontal', 'vertical', 'fade'),
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default 'horizontal'"
		),

		'speed' =>  array(
			'exclude'                 => true,
			'default'                 => 500,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 500"
		),

		'slideMargin' =>  array(
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		),

		'startSlide' =>  array(
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		),

		'randomStart' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'infiniteLoop' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'hideControlOnEnd' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'easing' =>  array(
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('linear', 'swing', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(n,n,n,n)'),
			'eval'                    => array('chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),

		'captions' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'ticker' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'tickerHover' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),
		'adaptiveHeight' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr m12', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),
		'adaptiveHeightSpeed' =>  array(
			'exclude'                 => true,
			'inputType'               => 'text',
			'default'                 => 500,
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 500"
		),

		'video' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'responsive' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'useCSS' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'preloadImages' =>  array(
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'visible',
			'options'                 => array('all', 'visible'),
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default 'visible'"
		),

		'touchEnabled' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr m12', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'swipeThreshold' =>  array(
			'exclude'                 => true,
			'default'                 => 50,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 50"
		),

		'oneToOneTouch' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'preventDefaultSwipeX' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'preventDefaultSwipeY' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		/* Pager */
		'pager' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'pagerType' =>  array(
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'full',
			'options'                 => array('full', 'short'),
			'eval'                    => array('tl_class' => 'w50 clr'),
			'sql'                     => "varchar(64) NOT NULL default 'full'"
		),

		'pagerShortSeparator' =>  array(
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => '/',
			'inputType'               => 'text',
			'eval'                    => array('maxlength' => 64, 'tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default '/'"
		),

		/* Controls */
		'controls' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'nextText' =>  array(
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 'Next',
			'inputType'               => 'text',
			'eval'                    => array('maxlength' => 64, 'tl_class' => 'w50 clr'),
			'sql'                     => "varchar(64) NOT NULL default 'Next'"
		),

		'prevText' =>  array(
			'exclude'                 => true,
			'search'                  => true,
			'default'                 => 'Prev',
			'inputType'               => 'text',
			'eval'                    => array('maxlength' => 64, 'tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default 'Prev'"
		),

		'autoControls' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50 clr', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'startText' =>  array(
			'exclude'                 => true,
			'default'                 => 'Start',
			'inputType'               => 'text',
			'eval'                    => array('maxlength' => 64, 'tl_class' => 'w50 clr'),
			'sql'                     => "varchar(64) NOT NULL default 'Start'"
		),

		'stopText' =>  array(
			'exclude'                 => true,
			'default'                 => 'Stop',
			'inputType'               => 'text',
			'eval'                    => array('maxlength' => 64, 'tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default 'Stop'"
		),

		'autoControlsCombine' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		/* Auto */
		'auto' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50', 'submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'pause' =>  array(
			'exclude'                 => true,
			'default'                 => 4000,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 4000"
		),

		'autoStart' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'autoDirection' =>  array(
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'                 => 'next',
			'options'                 => array('next', 'prev'),
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),

		'autoStart' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'autoHover' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'autoDelay' =>  array(
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		),

		/* Carousel */
		'minSlides' =>  array(
			'exclude'                 => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 1"
		),

		'maxSlides' =>  array(
			'exclude'                 => true,
			'default'                 => 1,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 1"
		),

		'moveSlides' =>  array(
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		),
		'slideWidth' =>  array(
			'exclude'                 => true,
			'default'                 => 0,
			'inputType'               => 'text',
			'eval'                    => array('rgxp' => 'natural', 'tl_class' => 'w50'),
			'sql'                     => "smallint(5) unsigned NOT NULL default 0"
		),

		'thumbnail' => array(
			'exclude'          => true,
			'inputType'        => 'checkbox',
			'eval'             => array('tl_class' => 'w50 m12'),
			'sql'              => "char(1) COLLATE ascii_bin NOT NULL default ''"
		),
		'thumbnailSize' => array(
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'options_callback' => function () {
				return System::getContainer()->get('contao.image.image_sizes')->getOptionsForUser(BackendUser::getInstance());
			},
			'eval'                    => array('rgxp' => 'natural', 'includeBlankOption' => true, 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'w50 clr'),
			'sql'                     => "varchar(128) COLLATE ascii_bin NOT NULL default ''"
		),

		'keyboardEnabled' =>  array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),

		'ariaLive' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),
		'ariaHidden' =>  array(
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => array('type' => 'boolean', 'default' => true)
		),

		'wrapperClass' =>  array(
			'exclude'                 => true,
			'default'                 => 'bx-wrapper',
			'inputType'               => 'text',
			'eval'                    => array('tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default 'bx-wrapper'"
		),

		'protected' => array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange' => true),
			'sql'                     => array('type' => 'boolean', 'default' => false)
		),
		'groups' => array(
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('mandatory' => true, 'multiple' => true),
			'sql'                     => "blob NULL",
			'relation'                => array('type' => 'hasMany', 'load' => 'lazy')
		)
	)
);
