<?php
/**
 * Sample shortcode
 *
 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @package Dignity Health
 */

function dignity_health_products() {

  ob_start();
  ?>
    <div class="dh-searchproduct">
      <div class="dh-searchproduct__title">
        <h5>Search Product</h5>
      </div>

      <div class="dh-searchproduct__input">
        <input type="search" name="s" value="" class="form-control wt-filter-product" placeholder="Product Name OR Composition">
      </div>
    </div>

    <!-- All Products -->
    <div class="dh-all-products">
      <div class="dh-all-products__title">
        <h5>All Products</h5>
      </div>

      <div id="dh-mainaccordion" class="dh-mainaccordion">

        <?php
          $get_terms = get_terms(array(
            'taxonomy' => 'dignity-products-cat',
            'hide_empty' => true,
          ));

          foreach ($get_terms as $the_term) {
            ?>
              <div class="dh-all-products__content">
                <div data-toggle="collapse" data-target="#dh-collapsemain-<?php echo esc_attr($the_term->term_id) ?>" aria-expanded="false" class="collapsed">
                  <div class="dh-all-products__maintab">
                    <div class="dh-all-products__maintab--title filter-cat">
                      <h6><?php echo esc_html($the_term->name); ?></h6>
                    </div>
                    <div class="dh-all-products__maintab--rightarea">
                      <?php $item = ($the_term->count == 1) ? ' Item' : ' Items'; ?>
                      <h6><?php echo esc_html($the_term->count . $item); ?></h6>
                      <i class="dh-angle-down"></i>
                      <div class="all-products__maintab--items">
                      </div>
                      <div class="all-products__maintab--icon">
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- .dh-all-products__content -->

              <div id="dh-collapsemain-<?php echo esc_attr($the_term->term_id) ?>" class="collapse" data-parent="#dh-mainaccordion" data-count="<?php echo esc_attr($the_term->count) ?>">
                <div class="dh-all-products__maintabcontent">

                  <div class="dh-all-products__maintabcontent--title">
                    <h5>Product Name</h5>
                  </div>
                  <div class="dh-all-products__maintabcontent--title">
                    <h5>Composition</h5>
                  </div>

                  <div class="dh-productswrap">
                    <?php
                      $get_products = get_posts([
                        'post_type' => 'dignity-products',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                          array(
                            'taxonomy' => 'dignity-products-cat',
                            'field' => 'term_id',
                            'terms' => $the_term->term_id
                          )
                        )
                      ]);

                      foreach ($get_products as $the_product) {

                        $type = get_post_meta($the_product->ID, '_type', true);
                        $composition = get_post_meta($the_product->ID, '_composition', true);
                        $pack_size = get_post_meta($the_product->ID, '_pack_size', true);
                        $reg_no = get_post_meta($the_product->ID, '_reg_no', true);

                        ?>
                          <div id="dh-inneraccordion-<?php echo esc_attr($the_product->ID) ?>" class="accordion dh-inneraccordion">
                            <div class="dh-all-products__innertab collapsed" data-toggle="collapse" data-target="#dh-collapseinner-<?php echo esc_attr($the_product->ID); ?>" aria-expanded="false">
                              <div class="dh-all-products__innertab--detail">
                                <div class="dh-all-products__innertab--title">
                                  <div class="dh-all-products__productsname">
                                    <div class="dh-all-products__maintabcontent--title">
                                      <h5>Product Name</h5>
                                    </div>
                                    <div class="dh-all-products__productsname--description">
                                      <h6 class="filter-name"><?php echo esc_html($the_product->post_title); ?></h6>
                                      <p class="filter-cat"><?php echo esc_html($the_term->name); ?></p>
                                    </div>
                                  </div>
                                  <div class="dh-all-products__composition">
                                    <div class="dh-all-products__maintabcontent--title">
                                      <h5>Compositions</h5>
                                    </div>
                                    <div class="dh-all-products__productsname--description">
                                      <p class="filter-comp"><?php echo esc_html($composition); ?></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="dh-all-products__innertab--link">
                                  <h6><a href="javascript:;">Quick View</a></h6>
                                </div>
                              </div>
                            </div>
                            <div id="dh-collapseinner-<?php echo esc_attr($the_product->ID); ?>" class="collapse" data-parent="#dh-inneraccordion-<?php echo esc_attr($the_product->ID); ?>" style="">
                              <div class="dh-all-products__innertab--content">
                                <div class="dh-all-products__img">
                                  <?php
                                    $img_url = get_the_post_thumbnail_url($the_product->ID);
                                    if (empty($img_url)) $img_url = dignity_health_directory_uri() . '/assets/img/p.holder.jpg';
                                  ?>
                                  <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($the_product->post_title); ?>">
                                  <h6><a href="<?php echo get_permalink($the_product->ID); ?>">Get Free Quotation</a></h6>
                                </div>
                                <ul>
                                  <li>
                                    <h6>Type:</h6>
                                    <div class="dh-all-products__innertab--description">
                                      <p><?php echo esc_html($type); ?></p>
                                    </div>
                                  </li>
                                  <li>
                                    <h6>Composition:</h6>
                                    <div class="dh-all-products__innertab--description">
                                      <?php echo esc_html($composition); ?>
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
                            </div><!-- #dh-inneraccordion-* -->
                          </div><!-- #dh-inneraccordion-* -->
                        <?php

                      }
                    ?>
                  </div>

                </div><!-- .dh-all-products__maintabcontent -->
              </div><!-- #dh-collapsemain-* -->
            <?php
          }
        ?>

      </div><!-- #dh-mainaccordion -->
    </div><!-- #dh-all-products -->
  <?php
  return ob_get_clean();

}
add_shortcode('dignity_products', 'dignity_health_products');
