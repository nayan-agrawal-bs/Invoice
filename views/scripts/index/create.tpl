<?php
$this->headScript()
  ->appendFile($this->layout()->staticBaseUrl . 'application/modules/Invoice/externals/scripts/main.js');
$this->headScript()
  ->appendFile($this->layout()->staticBaseUrl . 'application/modules/Invoice/externals/styles/main.css');

?>
<script type="text/javascript">
  scriptJquery(document).ready(function() {
    document.getElementById('cate').value='';
    document.getElementById('currency').value='';
    isUSD(0);
  });
 
</script>

<script type="text/javascript">
  // en4.core.runonce.add(function()
  // {
  //   new Autocompleter.Request.JSON('tags', '<?php //echo $this->url(array('controller' => 'tag', 'action' => 'suggest'), 'default', true) 
                                               // ?>', {
  //     'postVar' : 'text',
  //     'customChoices' : true,
  //     'minLength': 1,
  //     'selectMode': 'pick',
  //     'autocompleteType': 'tag',
  //     'className': 'tag-autosuggest',
  //     'filterSubset' : true,
  //     'multiple' : true,
  //     'injectChoice': function(token){
  //       var choice = new Element('li', {'class': 'autocompleter-choices', 'value':token.label, 'id':token.id});
  //       new Element('div', {'html': this.markQueryValue(token.label),'class': 'autocompleter-choice'}).inject(choice);
  //       choice.inputValue = token;
  //       this.addChoiceEvents(choice).inject(this.choices);
  //       choice.store('autocompleteChoice', token);
  //     }
  //   });
  // });
</script>



<?php echo $this->form->render($this); ?>





<script type="text/javascript">
  // $$('.core_main_blog').getParent().addClass('active');
</script>