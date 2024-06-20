<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setup $setup
 */
?>
<?php
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

$this->Form->setTemplates(Configure::read('Templates.form'));
$this->assign('title', __('Edit') . ' ' . __('Setup'));
?>
				<div id="form-row" class="setups row">
					<div class="col-xs-12 col-xl-10">
						<div class="card mb-3">
							<div class="card-header">

								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-edit fa-spin"></i> <?= __('Edit') ?>: <?= __('Setup') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>

								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Setups", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									); ?>

								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tabMain" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>

<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabSecond" data-bs-toggle="tab" data-bs-target="#tabPanelSecond" type="button" role="tab" aria-controls="tabPanelSecond" aria-selected="false"><?= __('Memo') ?></button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabMore" data-bs-toggle="tab" data-bs-target="#tabPanelMore" type="button" role="tab" aria-controls="tabPanelMore" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

									</ul>
								</div>

							</div>

							<?= $this->Form->create($setup, ['id' => 'main-form']) ?>
							
								<?php //= $this->Form->control('_csrfToken', ['name' => '_csrfToken', 'type' => 'hidden', 'value' => $this->request->getAttribute('csrfToken')] ) ?>

								<div class="card-body">
								
									<div class="tab-content" id="tabContent">
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tabMain" tabindex="0">

											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name"><?= __('Name') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name', ['label' => __('Name'), 'placeholder' => __('Name'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: slug: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="slug"><?= __('Slug') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('slug', ['label' => __('Slug'), 'placeholder' => __('Slug'), 'class' => 'form-control', 'empty' => false, 'disabled' => true, 'readonly' => true]); ?>

												</div>
											</div>

<?php /*
											<!-- 2. STRING: type: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="type"><?= __('Type') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('type', ['options' => $setupTypes, 'placeholder' => __('Template Id'), 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => true]);	?>	

												</div>
											</div>
*/ ?>

											<!-- 2. STRING: value: string  required -->
<?php /*
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="value"><?= __('Value') ?>:</label>
												<div class="col-md-9">
													<?php
																echo $this->Form->control('value', ['label' => __('Value'), 'placeholder' => __('Value'), 'class' => 'form-control', 'empty' => false]);
													?>
												</div>
											</div>
*/ ?>

<?php if(in_array($setup->type, ['date', 'time', 'datetime'])) { ?>
											<!-- 5. DATE: date: date  -->
											<div class="mb-3 row required">
												<label class="pt-2 col-form-label col-md-2 pt-1 text-start text-md-end" for="date"><?= __('Date') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
													<div class="form-group date">
														<div class="input-group date" id="value" data-target-input="nearest">
															<?= $this->Form->control('value', ['type' => 'text', 'placeholder' => __('Date'), 'class' => 'form-control', 'empty' => true]); ?>

															<div class="input-group-append" data-target="#date" data-toggle="date">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</div>
												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['bool', 'boolean'])) { ?>
											<!-- 7. BOOLEAN: visible: boolean  required -->
											<div class="mb-3 form-group row checkbox">
												<div class="col-sm-2 col-form-label required"></div>
												<div class="col-sm-10">
													<?= $this->Form->checkbox('value'); ?> <?= h($setup->name) ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['number', 'integer', 'int'])) { ?>
											<!-- 3. INTEGER: delay: integer  required -->
											<div class="mb-3 form-group row number required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="value"><?= __('Value') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
													<?= $this->Form->number('value', ['class' => 'form-control', 'data-decimals' => '0', 'min' => '-999999999999', 'max' => '999999999999', 'step' => '1', 'empty' => true]); ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['real', 'float'])) { ?>
											<!-- 3. INTEGER: delay: integer  required -->
											<div class="mb-3 form-group row number required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="value"><?= __('Value') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
													<?= $this->Form->number('value', ['class' => 'form-control', 'data-decimals' => '3', 'min' => '-999999999999', 'max' => '999999999999', 'step' => '.001', 'empty' => true]); ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['string'])) { ?>
											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="value"><?= __('Value') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('value', ['label' => __('Value'), 'placeholder' => __('Value'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['text', 'array', 'json'])) { ?>
											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="value"><?= __('Value') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->textarea('value', ['label' => __('Value'), 'placeholder' => __('Value'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['richtext'])) { ?>
											<!-- 2. STRING: about_us_body: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="value"><?= __('Rich text') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('value', ['label' => __('Rich text'), 'class' => 'form-control summernote', 'empty' => true]); ?>

												</div>
											</div>

<?php } ?>

<?php if(in_array($setup->type, ['password'])) { ?>
											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name"><?= __('Password') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('value', ['label' => __('Password'), 'placeholder' => __('Name'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

<?php } ?>

										</div><!-- /.tabPanelMain -->
										
										
<?php /*											
										<div class="tab-pane fade" id="tabPanelMore" role="tabpanel" aria-labelledby="tabMore" tabindex="0">
											<h3>More content come here...</h3>

										</div><!-- /.N.TAB -->
*/ ?>

									</div><!-- /.TAB PANEL -->
										
								</div>

								<div class="card-footer text-center">
									<?= $this->Form->button('<span class="btn-label"><i class="fa fa-save"></i></span>' . __('Save'), ["escapeTitle" => false, "type" => "submit", "class" => "btn btn-primary me-4"]) ?>
									
									<?= $this->Html->link('<span class="btn-label"><i class="fa fa-arrow-up"></i></span>' . __("Cancel"),
										["controller" => "Setups", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button", "class" => "btn btn-outline-secondary"]
									); ?>
									
								</div>

							<?= $this->Form->end() ?>

						</div><!-- end card-->
                    </div>


				</div>			


<?php
	$this->Html->css(
		[
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/css/tempus-dominus.min",
			"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/css/bootstrap-select.min",
			"jeffAdmin5./assets/plugins/icheck-1.0.3/skins/all",
			// "jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/css/select2.min",	// If you want to use Select 2, but it's not finish!!!
			// "jeffAdmin5./assets/css/select2-bootstrap-5-theme.min",					// If you want to use Select 2, but it's not finish!!!
		],
		['block' => true]);


	$this->Html->script(
		[
			"jeffAdmin5./assets/js/popper",
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/js/tempus-dominus.min",	// Must be loaded the popper.js !!
			"jeffAdmin5./assets/plugins/bootstrap-input-spinner-bs-5/src/bootstrap-input-spinner",
			"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/lang/summernote-hu-HU",
			//'jeffAdmin5./assets/plugins/jReadMore-master/dist/read-more.min',
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/bootstrap-select.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/i18n/defaults-hu_HU.min",
			"jeffAdmin5./assets/plugins/icheck-1.0.3/icheck.min",			
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/select2.full.min',	// If you want to use Select 2, but it's not finish!!!
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/i18n/hu',			// If you want to use Select 2, but it's not finish!!!
		],
		['block' => 'scriptBottom']
	); ?>
		
<?php
	// SELECT: https://developer.snapappointments.com/bootstrap-select/examples/
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

<?php /*
	jeffAdminInitSelectPicker()
*/ ?>

<?php if(in_array($setup->type, ['number', 'integer', 'int', 'real', 'float'])) { ?>
	jeffAdminInitInputSpinner()
<?php } ?>
<?php if(in_array($setup->type, ['richtext'])) { ?>
	jeffAdminInitSummerNote('value', 450, '<?= __("Here you can write the note") ?>...')
<?php } ?>
<?php if(in_array($setup->type, ['date'])) { ?>
	jeffAdminInitDatePicker('value'<?= $setup->value !== null ? ", '" . $setup->value . "'" : "" ?>)
<?php } ?>
<?php if(in_array($setup->type, ['time'])) { ?>
	jeffAdminInitTimePicker('value'<?= $setup->value !== null ? ", '" . $setup->value . "'" : "" ?>)
<?php } ?>
<?php if(in_array($setup->type, ['datetime'])) { ?>
	jeffAdminInitDateTimePicker('value'<?= $setup->value !== null ? ", '" . $setup->value . "'" : "" ?>)
<?php } ?>
<?php if(in_array($setup->type, ['bool', 'boolean'])) { ?>
	jeffAdminInitICheck('icheckbox_flat-blue');
<?php } ?>

	$(document).ready( function(){
		$('#button-submit').click( function(){
			$('#main-form').submit();
		});			
	});			

<?php $this->Html->scriptEnd(['block' => 'javaScriptBottom']); ?>
