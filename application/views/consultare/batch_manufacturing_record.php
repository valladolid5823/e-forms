<div id="container">
<div id="head">
    <h1>Batch Manufacturing Records</h1>
    </div>
    <div id="body">
        <table class="table">
            <thead>
                <tr>
                    <th>Batch Record No.</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Formula Code</th>
                    <th>Product Label</th>
                    <th>MFG Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record['batch_number']; ?></td>
                        <td><?php echo $record['product_name']; ?></td>
                        <td><?php echo $record['product_code']; ?></td>
                        <td><?php echo $record['formula_code']; ?></td>
						<td><?php echo $record['product_label']; ?></td>
                        <td><?php echo $record['mfg_date']; ?></td>
                        <td>
                            <a href="<?php echo site_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/gmp_bmr/details?id={$record['PK_id']}") ?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
