<?php if ($item->isDiscountEligible()) { ?>
                    <del><span class="amount"><?= $item->price ?> LEI</span></del>
                    <div class="price-box">
                        <span class="amount"><?= $item->proposePrice() ?> LEI</span>
                    </div>
                <?php } else { ?>
                    <div class="price-box">
                        <span class="amount"><?= $item->price ?> LEI</span>
                    </div>
                <?php } ?>