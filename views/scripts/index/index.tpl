

<script type="text/javascript">

function multiDelete()
{
  return confirm("<?php echo $this->translate('Are you sure you want to delete the selected invpoce entries?');?>");
}

function selectAll()
{
  var i;
  var multidelete_form = $('multidelete_form');
  var inputs = multidelete_form.elements;
  for (i = 1; i < inputs.length; i++) {
    if (!inputs[i].disabled) {
      inputs[i].checked = inputs[0].checked;
    }
  }
}
</script>

<h2>
  <?php echo $this->translate('Invoice Plugin') ?>
</h2>





	
<br />	
<br />

<?php if( count($this->paginator) ): ?>
<form id='multidelete_form' method="post" action="<?php echo $this->url();?>" onSubmit="return multiDelete()">
<table class='admin_table'>
  <thead>
    <tr>
      <th class='admin_table_short'><input onclick='selectAll();' type='checkbox' class='checkbox' /></th>
      <th class='admin_table_short'>ID</th>
      <th><?php echo $this->translate("Invoice Number") ?></th>
      <th><?php echo $this->translate("Created By") ?></th>
      <th><?php echo $this->translate("Customer Name") ?></th>
      <th><?php echo $this->translate("Date") ?></th>
      <th><?php echo $this->translate("Amount") ?></th>
      <th><?php echo $this->translate("Payment Status") ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->paginator as $item): ?>
      <tr>
        <td><input type='checkbox' class='checkbox' name='delete_<?php echo $item->getIdentity(); ?>' value="<?php echo $item->getIdentity(); ?>" /></td>
        <td><?php echo $item->invoice_id ?></td>
        <td><?php echo $item->invoice_number ?></td>
        <td><?php echo $item->getOwner()->getTitle()?></td>
        <td><?php echo $item->cust_name ?> </td>
        <td><?php echo $this->locale()->toDateTime($item->creation_date) ?></td>
        <td><?php echo $item->amount ?></td>
        <td><?php echo $item->status?></td>
        <td>
        <?php echo $this->htmlLink(array(
              'action' => 'view',
              'invoice_id' => $item->invoice_id,
              'route' => 'invoice_specific',
              // 'reset' => true,
            ), $this->translate('view'))  ?>
          |
          <?php echo $this->htmlLink(array(
              'action' => 'edit',
              'invoice_id' => $item->invoice_id,
              'route' => 'invoice_specific',
              // 'reset' => true,
            ), $this->translate('edit')) ?>
          |
          <?php echo $this->htmlLink(array(
                 
                'action' => 'delete', 
                'invoice_id' => $item->invoice_id,
                'route'=>'invoice_specific',
              ),                
                $this->translate("delete"),
                array('class' => 'smoothbox')) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
 
</table>

<br />

<div class='buttons'>
  <button type='submit'><?php echo $this->translate("Delete Selected") ?></button>
</div>
</form>

<br/>


<?php else: ?>
  <div class="tip">
    <span>
      <?php echo $this->translate("There are no Invoice entries by you yet.") ?>
    </span>
  </div>
<?php endif; ?>

<?php echo $this->paginationControl($this->paginator, null, null, array(
  'pageAsQuery' => true,
  'query' => $this->formValues,
  //'params' => $this->formValues,
)); ?>