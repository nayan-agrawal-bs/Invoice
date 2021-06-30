

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

<div class='clear'>
  <div class='settings'>
    <form class="global_form">
      <div>
      <h3><?php echo $this->translate("Invoice Products") ?></h3>
      <p class="description">
        <?php echo $this->translate("All Product Prices are in \$USD ") ?>
      </p>
      
          <?php if(count($this->products)>0):?>

      <table class='admin_table'>
        <thead>

          <tr>
          <th><?php echo $this->translate("Product Id") ?></th>
            <th><?php echo $this->translate("Product Name") ?></th>
            <th><?php echo $this->translate("Product Price") ?></th>
            <th><?php echo $this->translate("Domain") ?></th>
          </tr>

        </thead>
        <tbody>
          <?php foreach ($this->products as $product): ?>

          <tr>
            <td><?php echo $product->product_id?></td>
            <td><?php echo $product->product_name?></td>
            <td><?php echo $product->product_price?></td>
            <td><?php echo $product->category_id?></td>
            <td>
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'invoice', 'controller' => 'settings', 'action' => 'edit-product', 'id' =>$product->product_id), $this->translate('edit'), array(
                'class' => 'smoothbox',
              )) ?>
              |
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'invoice', 'controller' => 'settings', 'action' => 'delete-product', 'id' =>$product->product_id), $this->translate('delete'), array(
                'class' => 'smoothbox',
              )) ?>
            </td>
          </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

      <?php else:?>
      <br/>
      <div class="tip">
      <span><?php echo $this->translate("There are currently no Products.") ?></span>
      </div>
      <?php endif;?>
      <br/>

      <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'invoice', 'controller' => 'settings', 'action' => 'add-product'), $this->translate('Add New Product'), array(
      'class' => 'smoothbox buttonlink',
      'style' => 'background-image: url(' . $this->layout()->staticBaseUrl . 'application/modules/Core/externals/images/admin/new_category.png);')) ?>
      </div>
    </form>
  </div>
</div>
