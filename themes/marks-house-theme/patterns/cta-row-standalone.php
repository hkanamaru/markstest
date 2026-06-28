<?php
/**
 * Title: CTAボタン（メール査定＋電話）
 * Slug: marks-house/v2-cta-row-standalone
 * Categories: marks-house-cta
 * Description: メール無料査定ボタンとお電話無料相談ボタンのセット
 */
?>
<!-- wp:group {"className":"cta-row","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"stretch"}} -->
<div class="wp-block-group cta-row">

  <!-- wp:group {"className":"btn-teal-wrap","layout":{"type":"constrained"}} -->
  <div class="wp-block-group btn-teal-wrap">
    <!-- wp:html -->
    <a href="/contact/" class="btn-teal">
      <div class="badge">
        <p style="color:#004B53;font-size:14px;font-weight:700;margin:0;text-align:center;">オンラインでカンタン30秒！</p>
      </div>
      <p class="btn-text" style="color:#ffffff;font-size:20px;font-weight:700;margin:0;text-align:center;">メールで無料査定を依頼する</p>
    </a>
    <!-- /wp:html -->
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"btn-red-wrap","layout":{"type":"constrained"}} -->
  <div class="wp-block-group btn-red-wrap">
    <!-- wp:html -->
    <a href="tel:0120-917-974" class="btn-red-phone">
      <div class="phone-badge">
        <p style="color:#810004;font-size:14px;font-weight:700;margin:0;text-align:center;">お電話で<br>無料相談</p>
      </div>
      <div>
        <p class="phone-number" style="color:#ffffff;font-size:32px;font-weight:700;margin:0;text-align:center;">0120-917-974</p>
        <p class="phone-hours" style="color:#ffffff;font-size:14px;font-weight:700;margin:0;text-align:center;">24時間365日受付中</p>
      </div>
    </a>
    <!-- /wp:html -->
  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->
