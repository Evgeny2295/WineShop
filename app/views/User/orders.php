<div class="cabinet cabinet__orders">
    <div class="container">
        <div class="col-12">
            <h1 class="section-title cabinet__title"><?php __('user_orders_title'); ?></h1>
        </div>
        <div class="cabinet__content">
            <?php $this->getPart('parts/cabinet_sidebar'); ?>
            <div class="cabinet__user-orders">
                <div class="col-md-9 order-md-1">

                    <?php if (!empty($orders)): ?>

                        <div class="table-responsive">
                            <table class="table text-start table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col"><?php __('user_orders_num'); ?></th>
                                    <th scope="col"><?php __('user_orders_status'); ?></th>
                                    <th scope="col"><?php __('user_orders_total'); ?></th>
                                    <th scope="col"><?php __('user_orders_created'); ?></th>
                                    <th scope="col"><?php __('user_orders_updated'); ?></th>
                                    <th scope="col"><i class="far fa-eye"></i></a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr <?php if ($order['status']) echo 'class="table-info"' ?>>
                                        <td><?= $order['id'] ?></td>
                                        <td><?php __("user_order_status_{$order['status']}"); ?></td>
                                        <td>$<?= $order['total'] ?></td>
                                        <td><?= $order['created_at'] ?></td>
                                        <td><?= $order['updated_at'] ?></td>
                                        <td><a href="user/order?id=<?= $order['id'] ?>"><i class="far fa-eye"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p><?=count($orders)?> <?php __('user_orders_total_pagination'); ?> <?=$total;?></p>
                                <?php if($pagination->countPages > 1): ?>
                                    <?=$pagination;?>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php else: ?>
                        <p><?php __('user_orders_empty'); ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>