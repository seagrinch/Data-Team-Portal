<ol class="breadcrumb">
  <li><?= $this->Html->link(__('Parameters'), ['action' => 'index']) ?></li>
  <li class="active"><?= h($parameter->name) ?></li>
</ol>

<h2>Parameter: <?= h($parameter->name) ?></h2>

<dl class="dl-horizontal">
  <dt><?= __('Id') ?></dt>
  <dd>PD<?= $this->Number->format($parameter->id,['pattern'=>'#']) ?></dd>
  <dt><?= __('Display Name') ?></dt>
  <dd><?= h($parameter->display_name) ?></dd>
  <dt><?= __('Standard Name') ?></dt>
  <dd><?= h($parameter->standard_name) ?></dd>
  <dt><?= __('Unit') ?></dt>
  <dd><?= h($parameter->unit) ?></dd>
  <dt><?= __('Fill Value') ?></dt>
  <dd><?= h($parameter->fill_value) ?></dd>
  <dt><?= __('Precision') ?></dt>
  <dd><?= h($parameter->precision) ?></dd>
  <dt><?= __('Parameter Function') ?></dt>
  <dd><?= $parameter->has('parameter_function') ? $this->Html->link($parameter->parameter_function->name, ['controller' => 'ParameterFunctions', 'action' => 'view', $parameter->parameter_function->id]) : '' ?></dd>
  <dt><?= __('Data Product Identifier') ?></dt>
  <dd><?= h($parameter->data_product_identifier) ?></dd>
  <dt><?= __('Data Product Type') ?></dt>
  <dd><?= h($parameter->data_product_type) ?></dd>
  <dt><?= __('Data Level') ?></dt>
  <dd><?= h($parameter->data_level) ?></dd>
  <dt><?= __('Parameter Function Map') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($parameter->parameter_function_map)); ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $this->Text->autoParagraph(h($parameter->description)); ?></dd>
</dl>


<div><!-- Tabbed Navigation -->

  <!-- Nav Tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#streams" aria-controls="streams" role="tab" data-toggle="tab">Related Streams</a></li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="streams">

      <?php if (!empty($parameter->streams)): ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($parameter->streams as $streams): ?>
          <tr>
            <td><?= h($streams->id) ?></td>
            <td><?= $this->Html->link($streams->name,['controller'=>'streams','action'=>'view',$streams->name]) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
        <p class="panel-body">No related Streams found</p>
      <?php endif; ?>

    </div>
  </div><!-- End Tab Content -->

</div><!-- End Tabbed Navigation -->
