<?php
$job_categories = $job_types = array();

if ( taxonomy_exists( 'job_listing_category' ) ){
	$job_categories_args = array( 'hide_empty=1' );
	$job_categories = get_terms( 'job_listing_category', $job_categories_args );
}

if ( taxonomy_exists( 'job_listing_type' ) ){
	$job_types_args = array( 'hide_empty=1' );
	$job_types = get_terms( 'job_listing_type', $job_types_args );
}

?>

<div class="list-job-sidebar">
    <div class="job-sideblock">
	    <?php if ( ! empty( $job_categories ) ) {
		    if ( is_tax( 'job_listing_category' ) ) {
			    ?><input type="hidden" name="filter_job_categories[]" value="<?php echo get_query_var('job_listing_category'); ?>" id="job_categories_<?php echo $job_category->slug; ?>" /><?php
		    } else { ?>
                <div class="bb-job-filter">
                    <div class="job-filter-heading marker">Choose Category</div>
                    <ul class="job_categories">
					    <?php foreach ( $job_categories as $job_category ) { ?>
                            <li>
								<input type="checkbox" name="filter_job_categories[]" value="<?php echo $job_category->slug; ?>" id="job_categories_<?php echo $job_category->slug; ?>" class="bs-styled-checkbox" />
                                <label for="job_categories_<?php echo $job_category->slug; ?>" class="<?php echo sanitize_title( $job_category->name ); ?>">
								    <?php echo $job_category->name; ?>
                                </label>
                            </li>
					    <?php } ?>
                    </ul>
                </div>
            <?php }
	    } ?>

	    <?php if ( ! empty( $job_types ) ) {
		    if ( is_tax( 'job_listing_type' ) ) {
			    ?><input type="hidden" name="filter_job_types[]"
                         value="<?php echo get_query_var( 'job_listing_type' ); ?>"
                         id="job_types_<?php echo $job_category->slug; ?>" /><?php
		    } else { ?>
                <div class="bb-job-filter">
                    <div class="job-filter-heading marker">Job Type</div>
                    <ul class="job_types">
					    <?php foreach ( $job_types as $job_type ) { ?>
                            <li>
								<input type="checkbox" name="filter_job_types[]" value="<?php echo $job_type->slug; ?>" id="job_types_<?php echo $job_type->slug; ?>" class="bs-styled-checkbox" />
                                <label for="job_types_<?php echo $job_type->slug; ?>" class="<?php echo sanitize_title( $job_type->name ); ?>">
								    <?php echo $job_type->name; ?>
                                </label>
                            </li>
					    <?php } ?>
                    </ul>
                </div>
		    <?php }
	    } ?>
    </div>
</div>
