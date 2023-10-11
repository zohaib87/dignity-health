<?php
/**
 * Single Template file for dignity health
 *
 * @package Dignity Health
 */

get_header();

$id = get_the_ID();
$type = get_post_meta($id, '_type', true);
$composition = get_post_meta($id, '_composition', true);
$pack_size = get_post_meta($id, '_pack_size', true);
$reg_no = get_post_meta($id, '_reg_no', true);

$img_url = get_the_post_thumbnail_url($id);
if (empty($img_url)) $img_url = dignity_health_directory_uri() . '/assets/img/p.holder.jpg';

$terms = get_the_terms($id, 'dignity-products-cat');
$group = array();

foreach ($terms as $term) {
  $group[] = $term->name;
}
$group = implode(',', $group);

?>

<main id="dh-main" class="dh-main dh-haslayout">
  <section class="dh-main-section">

    <div class="container">
      <div class="dh-varietyproducts">
        <div class="row">
          <div class="col-lg-4">
            <div class="dh-all-products__img">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>">
            </div>
          </div>

          <div class="col-lg-8">
            <div class="dh-varietyproducts__content">
              <div class="dh-varietyproducts__title">
                <h6><a href="javascript:;"><?php echo esc_html($group); ?></a></h6>
                <h5><?php the_title(); ?></h5>
              </div>
              <div class="dh-all-products__innertab--content">
                <ul>
                  <li>
                    <h6>Type:</h6>
                    <div class="dh-all-products__innertab--description">
                      <p><?php echo esc_html($type); ?></p>
                    </div>
                  </li>
                  <li>
                    <h6>Group:</h6>
                    <div class="dh-all-products__innertab--description">
                      <p><?php echo esc_html($group); ?></p>
                    </div>
                  </li>
                  <li>
                    <h6>Composition:</h6>
                    <div class="dh-all-products__innertab--description">
                      <p><?php echo esc_html($composition); ?></p>
                    </div>
                  </li>
                  <li>
                    <h6>Pack Size:</h6>
                    <div class="dh-all-products__innertab--description">
                      <p><?php echo esc_html($pack_size); ?></p>
                    </div>
                  </li>
                  <li>
                    <h6>UK Registration No:</h6>
                    <div class="dh-all-products__innertab--description">
                      <p><?php echo esc_html($reg_no); ?></p>
                    </div>
                  </li>
                </ul>
              </div>

              <div class="dh-varietyproducts__formtitle">
                <h5>Get a Free Quotation</h5>
                <?php echo do_shortcode('[contact-form-7 id="13" title="Get Free Quotation"]'); ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</main>

<?php
get_footer();
