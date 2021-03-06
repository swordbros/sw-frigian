<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();


$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketCntl = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );

$coTarget = $this->config( 'client/html/checkout/standard/url/target' );
$coCntl = $this->config( 'client/html/checkout/standard/url/controller', 'checkout' );
$coAction = $this->config( 'client/html/checkout/standard/url/action', 'index' );
$coConfig = $this->config( 'client/html/checkout/standard/url/config', [] );

$checkoutAddressUrl = $this->url( $coTarget, $coCntl, $coAction, array( 'c_step' => 'address' ), [], $coConfig );
$checkoutDeliveryUrl = $this->url( $coTarget, $coCntl, $coAction, array( 'c_step' => 'delivery' ), [], $coConfig );
$checkoutPaymentUrl = $this->url( $coTarget, $coCntl, $coAction, array( 'c_step' => 'payment' ), [], $coConfig );
$basketUrl = $this->url( $basketTarget, $basketCntl, $basketAction, [], [], $basketConfig );


?>


<?php $this->block()->start( 'checkout/standard/summary' ); ?>
<section class="checkout-standard-summary common-summary">
	<input type="hidden" name="<?= $enc->attr( $this->formparam( array( 'cs_order' ) ) ); ?>" value="1" />

	

	



	<div class="common-summary-address row">
		<div class="item payment <?= !$this->value( $this->get( 'summaryErrorCodes', [] ), 'address/payment' ) ?: 'error' ?> col-sm-6">
			<div class="header">
				<a class="modify" href="<?= $enc->attr( $checkoutAddressUrl ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Change' ), $enc::TRUST ); ?>
				</a>
				<h3><?= $enc->html( $this->translate( 'client', 'Billing address' ), $enc::TRUST ); ?></h3>
			</div>

			<div class="content">
				<?php if( $addresses = $this->standardBasket->getAddress( 'payment' ) ) : ?>
					<?= $this->partial(
						/** client/html/checkout/standard/summary/address
						 * Location of the address partial template for the checkout summary
						 *
						 * To configure an alternative template for the address partial, you
						 * have to configure its path relative to the template directory
						 * (usually client/html/templates/). It's then used to display the
						 * payment or delivery address block on the summary page during the
						 * checkout process.
						 *
						 * @param string Relative path to the address partial
						 * @since 2017.01
						 * @category Developer
						 * @see client/html/checkout/standard/summary/detail
						 * @see client/html/checkout/standard/summary/options
						 * @see client/html/checkout/standard/summary/service
						 */
						$this->config( 'client/html/checkout/standard/summary/address', 'common/summary/address-standard' ),
						['addresses' => $addresses, 'type' => 'payment']
					); ?>
				<?php endif; ?>
			</div>
		</div><!--

		--><div class="item delivery <?= !$this->value( $this->get( 'summaryErrorCodes', [] ), 'address/delivery' ) ?: 'error' ?> col-sm-6">
			<div class="header">
				<a class="modify" href="<?= $enc->attr( $checkoutAddressUrl ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Change' ), $enc::TRUST ); ?>
				</a>
				<h3><?= $enc->html( $this->translate( 'client', 'Delivery address' ), $enc::TRUST ); ?></h3>
			</div>

			<div class="content">
				<?php if( $addresses = $this->standardBasket->getAddress( 'delivery' ) ) : ?>
					<?= $this->partial(
						$this->config( 'client/html/checkout/standard/summary/address', 'common/summary/address-standard' ),
						['addresses' => $addresses, 'type' => 'delivery']
					); ?>
				<?php else : ?>
					<?= $enc->html( $this->translate( 'client', 'like billing address' ), $enc::TRUST ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<div class="common-summary-service row">
		<div class="item delivery <?= !$this->value( $this->get( 'summaryErrorCodes', [] ), 'service/delivery' ) ?: 'error' ?> col-sm-6">
			<div class="header">
				<a class="modify" href="<?= $enc->attr( $checkoutDeliveryUrl ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Change' ), $enc::TRUST ); ?>
				</a>
				<h3><?= $enc->html( $this->translate( 'client', 'delivery' ), $enc::TRUST ); ?></h3>
			</div>

			<div class="content">
				<?php if( $services = $this->standardBasket->getService( 'delivery' ) ) : ?>
					<?= $this->partial(
						/** client/html/checkout/standard/summary/service
						 * Location of the service partial template for the checkout summary
						 *
						 * To configure an alternative template for the service partial, you
						 * have to configure its path relative to the template directory
						 * (usually client/html/templates/). It's then used to display the
						 * payment or delivery service block on the summary page during the
						 * checkout process.
						 *
						 * @param string Relative path to the service partial
						 * @since 2017.01
						 * @category Developer
						 * @see client/html/checkout/standard/summary/address
						 * @see client/html/checkout/standard/summary/detail
						 * @see client/html/checkout/standard/summary/options
						 */
						$this->config( 'client/html/checkout/standard/summary/service', 'common/summary/service-standard' ),
						['service' => $services, 'type' => 'delivery']
					); ?>
				<?php endif; ?>
			</div>
		</div><!--

		--><div class="item payment <?= !$this->value( $this->get( 'summaryErrorCodes', [] ), 'service/payment' ) ?: 'error' ?> col-sm-6">
			<div class="header">
				<a class="modify" href="<?= $enc->attr( $checkoutPaymentUrl ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Change' ), $enc::TRUST ); ?>
				</a>
				<h3><?= $enc->html( $this->translate( 'client', 'payment' ), $enc::TRUST ); ?></h3>
			</div>

			<div class="content">
				<?php if( $services = $this->standardBasket->getService( 'payment' ) ) : ?>
					<?= $this->partial(
						$this->config( 'client/html/checkout/standard/summary/service', 'common/summary/service-standard' ),
						['service' => $services, 'type' => 'payment']
					); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>


	<div class="common-summary-additional row">
		<!--

		--><div class="form-box__single-group col-sm-12">
			
				<h6><?= $enc->html( $this->translate( 'client', 'Additional information' ), $enc::TRUST ); ?></h6>
				<label for="form-additional-info"><?= $enc->html( $this->translate( 'client', 'Order notes' ), $enc::TRUST ); ?></label>
		

			<div class="content">

			<textarea class="comment-value" name="<?= $this->formparam( array( 'cs_comment' ) ); ?>" id="form-additional-info" rows="5" placeholder="<?= $enc->html( $this->translate( 'client', 'Notes about your order, e.g. special notes for delivery.' ), $enc::TRUST ); ?>">
			<?= $enc->html( $this->standardBasket->getComment() ); ?>
			</textarea>

			</div>
		</div>

		<div class="item coupon <?= !$this->value( $this->get( 'summaryErrorCodes', [] ), 'coupon' ) ?: 'error' ?> col-sm-12">
			<div class="header">
			<h6><?= $enc->html( $this->translate( 'client', 'Coupon codes' ), $enc::TRUST ); ?></h6>
			
				<a class="modify" href="<?= $enc->attr( $basketUrl ); ?>">
					<?= $enc->html( $this->translate( 'client', 'Change' ), $enc::TRUST ); ?>
				</a>
			
			</div>

			<div class="content">
				<?php if( !( $coupons = $this->standardBasket->getCoupons() )->isEmpty() ) : ?>
					<ul class="attr-list">
						<?php foreach( $coupons as $code => $products ) : ?>
							<li class="attr-item"><?= $enc->html( $code ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>


	</div>



	<div class="col-lg-5">



	<div class="summary-sticky">
	
	<div class="common-summary-detail row">


		<div class="basket table-responsive">
			<?= $this->partial(
				/** client/html/checkout/standard/summary/detail
				 * Location of the detail partial template for the checkout summary
				 *
				 * To configure an alternative template for the detail partial, you
				 * have to configure its path relative to the template directory
				 * (usually client/html/templates/). It's then used to display the
				 * product detail block on the summary page during the checkout process.
				 *
				 * @param string Relative path to the detail partial
				 * @since 2017.01
				 * @category Developer
				 * @see client/html/checkout/standard/summary/address
				 * @see client/html/checkout/standard/summary/options
				 * @see client/html/checkout/standard/summary/service
				 */
				$this->config( 'client/html/checkout/standard/summary/detail', 'common/summary/detail-standard' ),
				array(
					'summaryBasket' => $this->standardBasket,
					'summaryTaxRates' => $this->get( 'summaryTaxRates', [] ),
					'summaryNamedTaxes' => $this->get( 'summaryNamedTaxes', [] ),
					'summaryCostsPayment' => $this->get( 'summaryCostsPayment', 0 ),
					'summaryCostsDelivery' => $this->get( 'summaryCostsDelivery', 0 ),
					'summaryShowDownloadAttributes' => $this->get( 'summaryShowDownloadAttributes' )
				)
			); ?>
		</div>
	</div>

	<div class="checkout-standard-summary-option row">
		<?= $this->partial(
			/** client/html/checkout/standard/summary/options
			 * Location of the options partial template for the checkout summary
			 *
			 * To configure an alternative template for the options partial, you
			 * have to configure its path relative to the template directory
			 * (usually client/html/templates/). It's then used to display the
			 * options block on the summary page during the checkout process.
			 *
			 * @param string Relative path to the options partial
			 * @since 2017.01
			 * @category Developer
			 * @see client/html/checkout/standard/summary/address
			 * @see client/html/checkout/standard/summary/detail
			 * @see client/html/checkout/standard/summary/service
			 */
			$this->config( 'client/html/checkout/standard/summary/options', 'checkout/standard/option-partial-standard' ),
			['standardBasket' => $this->standardBasket, 'errors' => $this->get( 'summaryErrorCodes', [] )]
		); ?>
	</div>


	<div class="button-group-checkout" >
		
		<button class=" btn--box btn--small btn--radius btn--green btn--black-hover-green btn--uppercase font--semi-bold">
			<?= $enc->html( $this->translate( 'client', 'Place Order' ), $enc::TRUST ); ?>
		</button>
	</div>
	</div>
</section>
<?php $this->block()->stop(); ?>
<?= $this->block()->get( 'checkout/standard/summary' ); ?>

</div>
</div>
