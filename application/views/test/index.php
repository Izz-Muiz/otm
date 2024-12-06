<?php

$gender = array(
	(object) array(
		'value' => 'male',
		'checked' => FALSE,
		'label_name' => 'Male',
		'extra' => array()
	),
	(object) array(
		'value' => 'female',
		'checked' => FALSE,
		'label_name' => 'Female',
		'extra' => array()
	)
);
echo bootstrap_input_2('Select your gender', 'gender', 'radio', '', array('input_attr' => array('option' => $gender, 'required' => TRUE)));

echo '<br><br>';

echo bootstrap_input_2('Choose Date', 'date', 'date', '', ['input_attr' => ['min' => '2024-01-01', 'max' => '2024-12-31']]);

echo '<br><br>';

// echo bootstrap_input_2('Choose class', 'class', 'select', '', [
// 	'input_attr' => ['class' => 'form-select', 'require' => true],
// 	'help_top' => 'Please select one of the options below.', // Help text above dropdown
// 	'help' => 'This field is mandatory.',
// ]);


// Dropdown options
$options = [
	'' => 'Select an option', // Default placeholder option
	'1' => 'Option 1',
	'2' => 'Option 2',
	'3' => 'Option 3',
];

// Attributes for the dropdown
$attributes = [
	'class' => 'form-select',
	'id' => 'dropdown_input',
	'required' => 'required',
];

// Help text above and below
$help_top = 'Please select one of the options below.';
$help_bottom = 'This field is mandatory.';
?>

<div class="row">
	<!-- Label -->
	<label class="col-md-2 col-form-label" for="dropdown_input">
		Choose an option <span class="form-required text-danger">*</span>
	</label>

	<div class="col-md-10">
		<!-- Help text above -->
		<?php if (!empty($help_top)): ?>
			<span class="form-text text-muted"><?php echo $help_top; ?></span>
		<?php endif; ?>

		<!-- Dropdown -->
		<br>
		<?php echo form_dropdown('dropdown_input', $options, '', $attributes); ?>
		<br>
		<!-- Help text below -->
		<?php if (!empty($help_bottom)): ?>
			<span class="form-text text-muted"><?php echo $help_bottom; ?></span>
		<?php endif; ?>
	</div>
</div>
