



<h2>
  <?php echo $this->translate('Invoice Plugin') ?>
</h2>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render()
    ?>
  </div>
<?php endif; ?>

<p>
  <?php echo $this->translate("Invoice_VIEWS_SCRIPTS_ADMINMANAGE_INDEX_DESCRIPTION") ?>
</p>


<br />	
<br />

<?php if( count($this->paginator) ): ?>

<table class='admin_table'>
  <thead>
    <tr>
      
      <th class='admin_table_short'>ID</th>
      <th><?php echo $this->translate("Invoice Number") ?></th>
      <th><?php echo $this->translate("Created By") ?></th>
      <th><?php echo $this->translate("Customer Name") ?></th>
      <th><?php echo $this->translate("Date") ?></th>
      <th><?php echo $this->translate("Amount") ?></th>
      <th><?php echo $this->translate("Payment Status") ?></th>
      <th><?php echo $this->translate("Options") ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->paginator as $item): ?>
      <tr>
       
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