<?php

namespace App\Forms\Fields;

use TCG\Voyager\FormFields\AbstractHandler;
class ButtonFormField extends AbstractHandler
{
    protected $codename = 'button';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('voyager::formfields.button', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
