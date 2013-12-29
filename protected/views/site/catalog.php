<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>Category::make_tree(),
    'activateItems'=>false,
)); ?>
