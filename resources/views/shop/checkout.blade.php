@extends('layout.main')

@section('content')
<header class="entry-header">
    <div class="container">
        <h1 class="entry-title">Finalizare comanda</h1>
    </div>
</header>
<div class="page-content">
    <div class="container">
        <article class="page type-page status-publish hentry">
            <div class="entry-content">
                <div class="phm_row hasteck_row phm_row-fluid">
                    <div class="row-container">
                        <div class="parvez_column parvez_column_container parvez_col-sm-12">
                            <div class="parvez_wrapper">
                                <div class="parvez_text_column parvez_content_element ">
                                    <div class="parvez_wrapper">
                                        <div class="bootexpert">
                                            <form name="checkout" method="post" class="checkout bootexpert-checkout" action="#">
                                                <div class="col2-set" id="customer_details">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="bootexpert-billing-fields">
                                                                <h3>Detalii facturare</h3>
                                                                <p class="form-row form-row-first">
                                                                    <label class="">Nume 
                                                                        <abbr class="required" title="required">*</abbr>
                                                                    </label>
                                                                    <input required type="text" class="input-text " name="name" placeholder="" value="<?= old('name',  Auth::user()->name)?>" />
                                                                </p>
                                                                <div class="clear"></div>
                                                                <p class="form-row form-row-first validate-email" id="billing_email_field">
                                                                    <label class="">Adresa de email
                                                                        <abbr class="required" title="required">*</abbr>
                                                                    </label>
                                                                    <input readonly type="email" class="input-text " name="email" placeholder="" value="<?=old('email',Auth::user()->email)?>" />
                                                                </p>
                                                                <p class="form-row form-row-last validate-phone" id="billing_phone_field">
                                                                    <label class="">Telefon 
                                                                        <abbr class="required" title="required">*</abbr>
                                                                    </label>
                                                                    <input required type="tel" class="input-text " name="phone" placeholder="" value="<?=old('phone',Auth::user()->phone)?>" />
                                                                </p>
                                                                <div class="clear"></div>
                                                                <p class="form-row form-row-wide address-field" id="delivery_address_1_field">
                                                                    <label class="">Adresa Livrare
                                                                        <abbr class="required" title="required">*</abbr>
                                                                    </label>
                                                                    <textarea required cols="5" rows="2" class="input-text " name="delivery_address" id="delivery_address_1" placeholder="Ex.: bld. Tomis, nr 48, bl. L4, ap. 22, Constanta"><?=old('delivery_address',Auth::user()->delivery_address)?></textarea>
                                                                </p>
                                                                <p class="form-row form-row-wide create-account">
                                                                    <input class="input-checkbox" type="checkbox" name="store_account" id="store_account" value="1">
                                                                    <label class="checkbox" for="store_account">Salvez datele in cont</label>
                                                                </p>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-6">
                                                            <div class="order-box">
                                                                <h3 id="order_review_heading">Informatii comanda</h3>
                                                                <div id="order_review" class="bootexpert-checkout-review-order">
                                                                    <table class="shop_table bootexpert-checkout-review-order-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="product-name">Produs</th>
                                                                                <th class="product-total">Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach($cartService->getCart()->items as $item){?>
                                                                            <tr class="cart_item">
                                                                                <td class="product-name"><?=$item->product_name?> <strong class="product-quantity">&times; <?=$item->qty?></strong></td>
                                                                                <td class="product-total"> <span class="amount"><?=$item->price?> LEI</span></td>
                                                                            </tr>
                                                                            <?php }?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr class="order-total">
                                                                                <th>Total</th>
                                                                                <td><strong><span class="amount"><?=$cartService->getTotal()?> LEI</span></strong></td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                    <div id="payment" class="bootexpert-checkout-payment">
                                                                        <div class="form-row place-order">
                                                                            <input type="submit" class="button alt" name="bootexpert_checkout_place_order" id="place_order" value="Plaseaza comanda" />
                                                                            <?=csrf_field()?>
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection