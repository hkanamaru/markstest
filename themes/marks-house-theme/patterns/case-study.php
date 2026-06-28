<?php
/**
 * Title: 活用事例
 * Slug: marks-house/v2-case-study
 * Categories: marks-house-sections
 */
?>
<!-- wp:group {"className":"case-study-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group case-study-section">

  <!-- wp:group {"className":"case-study-inner","layout":{"type":"flex","orientation":"vertical"}} -->
  <div class="wp-block-group case-study-inner">

    <!-- wp:group {"className":"section-title-wrap","layout":{"type":"constrained"}} -->
    <div class="wp-block-group section-title-wrap">
      <!-- wp:heading {"level":2} -->
      <h2 class="wp-block-heading">活用事例</h2>
      <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:html -->
    <div class="before-after-tabs">
      <button class="tab-before is-active" data-tab="before">Before</button>
      <button class="tab-after" data-tab="after">After</button>
    </div>
    <!-- /wp:html -->

    <div class="wp-block-group case-content" id="case-before">

      <!-- wp:image {"className":"case-image","sizeSlug":"large","linkDestination":"none"} -->
      <figure class="wp-block-image size-large case-image">
        <img src="<?php echo get_template_directory_uri(); ?>lp-case-study-before.png" alt="草刈り前の土地"/>
      </figure>
      <!-- /wp:image -->

      <!-- wp:group {"className":"case-text","layout":{"type":"flex","orientation":"vertical"}} -->
      <div class="wp-block-group case-text">
        <!-- wp:heading {"level":3} -->
        <h3 class="wp-block-heading">草刈りなど手入れができていない土地</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>草刈りなどの管理ができていない状態の土地でも、一括でご相談いただけます。管理できていない土地でも土地としての固定資産税はかかっている状態なので、上手に使えば収入を得られるのです。</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <div class="wp-block-group case-content" id="case-after" style="display:none;">

      <!-- wp:image {"className":"case-image","sizeSlug":"large","linkDestination":"none"} -->
      <figure class="wp-block-image size-large case-image">
        <img src="<?php echo get_template_directory_uri(); ?>lp-case-study-after.png" alt="整備後の駐車場"/>
      </figure>
      <!-- /wp:image -->

      <!-- wp:group {"className":"case-text","layout":{"type":"flex","orientation":"vertical"}} -->
      <div class="wp-block-group case-text">
        <!-- wp:heading {"level":3} -->
        <h3 class="wp-block-heading">整備された月極駐車場として活用</h3>
        <!-- /wp:heading -->
        <!-- wp:paragraph -->
        <p>弊社が土地を一括借り上げし、駐車場として整備・運営。オーナー様は管理不要で毎月安定した賃料を受け取ることができます。</p>
        <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->

<style>
.case-image img {object-fit: cover; flex-shrink: 0; }
</style>

<script>
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    var tabs   = document.querySelectorAll('.before-after-tabs [data-tab]');
    var before = document.getElementById('case-before');
    var after  = document.getElementById('case-after');
    if (!tabs.length || !before || !after) return;
    tabs.forEach(function(tab) {
      tab.addEventListener('click', function() {
        tabs.forEach(function(t) { t.classList.remove('is-active'); });
        tab.classList.add('is-active');
        if (tab.dataset.tab === 'before') {
          before.style.display = 'flex';
          after.style.display  = 'none';
        } else {
          before.style.display = 'none';
          after.style.display  = 'flex';
        }
      });
    });
  });
})();
</script>
