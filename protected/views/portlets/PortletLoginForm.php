<div class="sidebarItem">
    <div class="sidebarItemTitle font15">Вход для партнеров</div>
    <div class="sidebarItemContainer">

        <?php echo CHtml::beginForm('', 'post', array('class' => 'formStyle')); ?>

            <?php echo CHtml::errorSummary($form,"",""); ?>

            <table class="formTable">
                <tr class="h30 formBorder">
                    <td class="formLabel vam bgWhite"><?php echo CHtml::activeLabel($form,'email'); ?>:</td>
                    <td colspan="2"><?=CHtml::activeTextField($form,'email', array('class'=>'formInput', 'placeholder'=>'ваша@эл.почта')); ?></td>
                </tr>
                <tr class="h30 formBorder">
                    <td class="formLabel vam bgWhite"><?=CHtml::activeLabel($form,'password'); ?>:</td>
                    <td><?=CHtml::activePasswordField($form,'password', array('class'=>'formInput', 'placeholder'=>'*******')); ?></td>
                    <td><?=CHtml::submitButton('Войти', array('class'=>'formSubmit font13 submitGray')); ?></td>
                </tr>
            </table>
        <?php echo CHtml::endForm(); ?>

        <a class="font13 right loginFormLink" href="password_resets.php">Забыли пароль?</a>
        <div class="clearfix"></div>
        <?=CHtml::link( 'Как стать партнером?', array('/page/default/view', 'id'=>'kak-stat-partnerom'), array('class'=>'font13 right loginFormLink') )?>
        <div class="clearfix"></div>
    </div>
</div>