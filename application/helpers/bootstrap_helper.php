<?php

function bootstrap_input_2($label, $input_name, $input_type, $input_value = '', $options = array())
{

	$required_style = "";
	$tooltip = "";
	$input = "";

	if (isset($options['input_attr']['required'])) {
		$required_style = '<span class="form-required text-danger">*</span>';
	}

	if (!empty($options['tooltip'])) {
		$tooltip .= '<span class="fa fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . $options['tooltip'] . '"></span>';
	}

	if (in_array($input_type, array('radio', 'checkbox'))) {
		$spacings = '';
		for ($i = 0; $i < ($options['input_attr']['spacing'] ?? 0); $i++) $spacings .= '<br>';

		if (!empty($options['input_attr']['option'])) {
			$input = '<div class="mt-1">';
			foreach ($options['input_attr']['option'] as $attr) {
				$extra = $attr->extra ?? array();
				$attr_help = !empty($attr->help) ? '<span class="form-text text-muted"><br>' . $attr->help . '</span>' : '';
				$attr_spacing = '';
				for ($i = 0; $i < ($attr->spacing ?? 0); $i++) $attr_spacing .= '<br>';
				$input .= '<input type="' . $input_type . '"
                    name="' . $input_name . '"
                    value="' . $attr->value . '"
                    ' . ($attr->checked ? 'checked' : '') . '
                    class="form-check-input ' . ($extra['class'] ?? '') . '"
                    ' . _attributes_to_string($extra) . ' >
                    <label class="form-check-label" for="' . $input_name . '"
                    ' . _attributes_to_string($attr->label_extra ?? array()) . '>&nbsp;' .
					$attr->label_name . '&nbsp;&nbsp;</label>' . $attr_help . $spacings . $attr_spacing;
			}
			$input .= '</div>';
		}
	} else {
		$extra = !empty($options['input_attr']['extra']) ? $options['input_attr']['extra'] : [];

		if ($input_type == 'password') {
			$extra['pattern'] = '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$"';
		}

		$input = '<input name="' . $input_name . '" class="form-control ' . (isset($options['input_attr']['class']) ? $options['input_attr']['class'] : 'form-control col-md-6') . '" type="' . $input_type . '" value="' . htmlspecialchars($input_value) . '" ' . _attributes_to_string($extra) . ' ' . (isset($options['input_attr']['required']) ? 'required' : '') . '>';
	}

	$row_class = element('row_class', $options);

	$string =
		'<div class="row ' . $row_class . '">
        <label class="col-md-2 col-form-label">
            ' . $label . ' ' . $tooltip . ' ' . $required_style . '
        </label>
        <div class="col-sm-10">
            <div class="mb-3">' . (!empty($options['help_top']) ? '<span class="form-text ' . ($options['help_color'] ?? 'text-muted') . ' ' . ($options['help_class'] ?? NULL) . '" style="' . ($options['help_style'] ?? NULL) . '">' . $options['help_top'] . '</span>' : NULL) . '
                <div class="' . ($options['input_attr']['input_size'] ?? 'col-md-6') . '">'
		. $input;

	if (!empty($options['help'])) {
		$string .= '</div><span class="form-text ' . ($options['help_color'] ?? 'text-muted') . ' ' . ($options['help_class'] ?? NULL) . '" style="' . ($options['help_style'] ?? NULL) . '">' . $options['help'] . '</span></div></div></div>';
	} else {
		$string .= '</div></div></div></div>';
	}

	return $string;
}
