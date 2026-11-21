<?php if(isset($bankAccounts) && count($bankAccounts) > 0): ?>
    <div class="section">
        <div class="section-title">Cuentas bancarias</div>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <?php $columnCount = 0; ?>
                    <?php $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="bank-cell">
                            <div class="bank-card">
                                <table style="width: 100%">
                                    <tr>
                                        <td class="bank-logo-cell">
                                            <?php if(!empty($account->bank?->image)): ?>
                                                <img src="<?php echo e(public_path($account->bank->image)); ?>" class="bank-logo">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="bank-title"><?php echo e($account->description); ?></div>
                                            <div class="bank-subtitle"><?php echo e($account->bank->full_name); ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="bank-detail"><strong>Número de cuenta:</strong> <?php echo e($account->number); ?></div>
                                <div class="bank-detail"><strong>CCI:</strong> <?php echo e($account->cci); ?></div>
                            </div>
                        </td>
                        <?php $columnCount++; ?>
                        <?php if($columnCount % 2 === 0 && ! $loop->last): ?>
                            </tr><tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($columnCount % 2 !== 0): ?>
                        <td class="bank-cell"></td>
                    <?php endif; ?>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\sales\partials\bank_accounts_grid_v2.blade.php ENDPATH**/ ?>