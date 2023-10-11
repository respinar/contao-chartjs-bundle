<?php

declare(strict_types=1);

$GLOBALS['TL_DCA']['tl_content']['palettes']['chart_js'] = '
    {type_legend},type,headline;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
    {invisible_legend:hide},invisible,start,stop;';
