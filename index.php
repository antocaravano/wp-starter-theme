<?php get_header(); ?>
<section id="index">
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<h1><?php the_title();?></h1>
			<h2>This an h2 sub header</h2>
			<hr />
			<h3>Sub title h3</h3>
			<p><?php the_content(); ?></p>
			</div>
		</div>
	</div>
	
</section>
<?php get_footer(); ?>
