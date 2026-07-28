<table class="table table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Category</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($expenses as $expense): ?>
            <tr>
                <td><?php echo formatDate($expense['date']); ?></td>
                <td><?php echo htmlspecialchars($expense['description']); ?></td>
                <td>
                    <span class="badge" style="background-color: <?php echo htmlspecialchars($expense['category_color']); ?>">
                        <?php echo htmlspecialchars($expense['category_name']); ?>
                    </span>
                </td>
                <td class="text-danger">-<?php echo formatCurrency($expense['amount']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
