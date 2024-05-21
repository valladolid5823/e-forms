<div id="container">
<div id="head">
    <h1>Glass Register</h1>
    </div>
    <div id="body">
        <table class="table">
            <thead>
                <tr>
                    <th>Date Reviewed:</th>
                    <th>Reviewed By:</th>
                    <th>Approved Date:</th>
                    <th>Approved By:</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record['reviewed_date']; ?></td>
                        <td><?php echo $record['reviewer_name']; ?></td>
						<td><?php echo $record['approved_date']; ?></td>
                        <td><?php echo $record['approver_name']; ?></td>
                        <td>
                            <a href="<?php echo site_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/gmp_watch/details?id={$record['PK_id']}") ?>"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
