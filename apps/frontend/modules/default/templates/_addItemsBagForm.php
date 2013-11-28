<?php echo form_tag('@bag_items?hash=' . $hash) ?>
<table id="add_item_bag_form">
    <tfoot>
    <tr>
        <td colspan="2">
            <input type="submit" value="Добавить!" />
        </td>
    </tr>
    </tfoot>
    <tbody>
    <?php echo $form ?>
    </tbody>
</table>
</form>