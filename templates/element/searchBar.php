<?php
	$show = '';
	if (isset($showSearchBar) && $showSearchBar) {
		$show = ' show';
	}
?>

				<div class="collapse<?= $show ?>" id="collapseSearch">
					<div class="card card-body mb-3 mt-0">
						<?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index'], 'class' => 'input-group']) ?>
							<input id="search" name="search" type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon" value="<?= $search ?? '' ?>" autofocus>
							<button class="btn btn-outline-secondary" type="submit" id="button-search"><i class="fa fa-fw fa-search"></i> <?= __('Search') ?></button>
							<?php if (isset($showSearchBar) && $showSearchBar && isset($search) && $search !== '') { ?>
								<a href="<?= $this->Url->build(['action' => 'index', 'clear-filter'], ['fullBase' => true]) ?>" class="btn btn-outline-danger" type="submit" id="button-search"><i class="fa fa-fw fa-times"></i> <?= __('Clear search') ?></a>
							<?php } ?>
							
						<?= $this->Form->end() ?>

					</div>
				</div>					
