<h3><?= $this->html->link($site->name,['action'=>'view',$site->reference_designator]) ?> / 
<?= $this->html->link($designator->parent->name,['action'=>'view',$designator->parent->reference_designator]) ?> / 
<?= h($designator->name) ?></h3>

<dl class="dl-horizontal">
  <dt><?= __('Reference Designator') ?></dt>
  <dd><?= h($designator->reference_designator) ?></dd>
  <dt><?= __('Description') ?></dt>
  <dd><?= $designator->description ?></dd>
  <dt><?= __('Latitude') ?></dt>
  <dd><?= $this->Number->format($designator->latitude) ?></dd>
  <dt><?= __('Longitude') ?></dt>
  <dd><?= $this->Number->format($designator->longitude) ?></dd>
  <dt><?= __('Depth') ?></dt>
  <dd><?= $this->Number->format($designator->end_depth) ?></dd>
</dl>

<h3>Instruments</h3>
  <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
    <tr>
      <th>Instrument</th>
      <th>Reference Designator</th>
    </tr>
    <?php foreach ($designator->child as $child): ?>
    <tr>
      <td><?= $this->html->link($child->name,['action'=>'view',$child->reference_designator]) ?></td>
      <td><?= h($child->reference_designator)?></td>
    </tr>
    <?php endforeach; ?>
  </table>
