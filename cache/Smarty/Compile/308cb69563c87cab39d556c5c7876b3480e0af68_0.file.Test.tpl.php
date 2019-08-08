<?php
/* Smarty version 3.1.31, created on 2019-07-31 17:13:43
  from "/var/www/html/src/View/Smarty/Templates/Test/Test.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5d415bc7605760_94163765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '308cb69563c87cab39d556c5c7876b3480e0af68' => 
    array (
      0 => '/var/www/html/src/View/Smarty/Templates/Test/Test.tpl',
      1 => 1564564420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d415bc7605760_94163765 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container"><?php echo $_smarty_tpl->tpl_vars['data']->value['test'];?>
</div>

marmot encode: <?php echo marmot_encode('2');
}
}
