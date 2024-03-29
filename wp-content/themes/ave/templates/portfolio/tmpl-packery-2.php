<div class="col-lg-<?php $this->get_column_class() ?> col-sm-6 masonry-item <?php $this->entry_term_classes() ?>">
	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="ld-pf-inner">
	
			<div class="ld-pf-image">
				
				<?php $this->entry_thumbnail( null, true ); ?>

			</div><!-- /.ld-pf-image -->
	
			<div class="ld-pf-details">
				<div class="ld-pf-bg" style="background-color: #ffd200;" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": "this", "duration": 850, "initValues": { "scale": 0, "transformOrigin": "0 80% 0" }, "animations": { "scale": 1, "transformOrigin": "0 80% 0" } }'></div><!-- /.ld-pf-bg -->
				<div class="ld-pf-details-inner justify-content-center" data-custom-animations="true" data-ca-options='{ "triggerHandler": "mouseenter", "triggerTarget": ".ld-pf-item", "triggerRelation": "closest", "offTriggerHandler": "mouseleave", "animationTarget": ".split-inner", "startDelay": 200, "duration": 650, "delay": 150, "initValues": { "translateY": "150%" }, "animations": { "translateY": "0", "rotateX": 0 } }'>
					
					<?php the_title( '<h3 class="ld-pf-title text-uppercase h4 font-weight-bold" data-split-text="true" data-split-options=\'{ "type": "lines" }\'>', '</h3>' ) ?>
					<?php $this->entry_cats() ?>
		
				</div><!-- /.ld-pf-details-inner -->
			</div><!-- /.ld-pf-details -->
	
			<?php $this->get_overlay_button(); ?>
	
		</div><!-- /.ld-pf-inner -->
	</article><!-- /.ld-pf-item -->
</div><!-- /.col-lg-4 col-md-6 -->