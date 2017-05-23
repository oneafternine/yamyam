<?php
/**
 * Template part for the newsletter sign up
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package yamyamcards
 */

?>

    <div class="o-container o-row">
        <section class="c-newsletter-block u-bg--pink">
            <div class="o-layout o-layout--middle">
                <div class="c-newsletter__image o-layout__item  u-1/1  u-1/4@tablet">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/header_logo2x.png" alt="yamyam footer logo">
                </div>
                <div class="o-layout__item  u-1/1  u-3/4@tablet">
                    <h3 class="c-newsletter__title">10% off your first order, plus loads more offers straight to your inbox!</h3>
                    <p class="c-newsletter__description">Emails will only ever be about our awesome cards, and you can unsubscribe at any time</p>
                    <div class="newsletter__form">
                        <!-- Begin MailChimp Signup Form -->
                        <div id="mc_embed_signup">
                        <form action="//oneafternine.us15.list-manage.com/subscribe/post?u=f16e6027cdc1a835756dc172b&amp;id=6b9e624fbb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">

                        <div class="mc-field-group">
                            <label class="form__label--email" for="mce-EMAIL">Email Address: </label>
                            <input type="email" value="" name="EMAIL" class="required email form__field" id="mce-EMAIL">
                        </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f16e6027cdc1a835756dc172b_6b9e624fbb" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Send me offers" name="subscribe" id="mc-embedded-subscribe" class="button form__btn"></div>
                            </div>
                        </form>
                        </div>

                        <!--End mc_embed_signup-->
                    </div>
                </div>
            </div>
        </section>
    </div>
