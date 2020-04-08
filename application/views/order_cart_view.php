<?php echo form_open(site_url() . 'order/edit/'); ?>
<table cellpadding="6" cellspacing="1" style="width:100%" class="table table-striped table-condended">

<tr class="small">
  <th>Menge</th>
  <th>Beschreibung</th>
  <th style="text-align:right">Einzelpreis</th>
  <th style="text-align:right">Subtotal</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        <tr class="small">
                <td style="vertical-align: middle;"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '3')); ?></td>
                <td>
                        <?php echo $items['name']; ?>

                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                        <?php endforeach; ?>
                                </p>

                        <?php endif; ?>

                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?> Fr.</td>
        </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
        <td> </td>
        <td colspan="2"class="text-right"><strong>Total CHF</strong></td>
        <td class="text-right"><?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

<p><button class="btn btn-default" type="submit">Aktualisieren</button>
<a class="btn btn-primary block-right" href="<?=site_url()?>order/payment" role="button">Bestellen</a></p>
