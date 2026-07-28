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
        <?php foreach ($incomes as $income): ?>
            <tr>
                <td><?php echo formatDate($income['date']); ?></td>
                <td><?php echo htmlspecialchars($income['description']); ?></td>
                <td>
                    <span class="badge" style="background-color: <?php echo htmlspecialchars($income['category_color']); ?>">
                        <?php echo htmlspecialchars($income['category_name']); ?>
                    </span>
                </td>
                <td class="text-success">+<?php echo formatCurrency($income['amount']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
