<?php
//header("Content-Type: text/plain");

if (have_posts()) :
	while (have_posts()) : the_post();

if(get_field('embargoed_url')) {
	$permalink = get_field('embargoed_url');
} else {
	$permalink = get_the_permalink();
}

// Remove embeds from emails
function wusm_remove_oembed( $html ) {
	if ( get_query_var( 'template' ) == 'email' ) {
		global $permalink;
		$video_available = '<p style="font-family:\'Open Sans\', Arial, sans-serif;font-size: 14px;color: #333;padding:0;margin-bottom:35px;text-align:left;"><strong>Video available:</strong> <a href="' . $permalink . '">' . $permalink . '</a></p>';
		return $video_available;
	}
	return $html;
}
add_filter('embed_oembed_html', 'wusm_remove_oembed', 99, 4);

// Remove audio from emails
function wusm_remove_audio( $html ) {
    if ( get_query_var( 'template' ) == 'email' ) {
		global $permalink;
    	$audio_available = '<p style="font-family:\'Open Sans\', Arial, sans-serif;font-size: 14px;color: #333;padding:0;margin:0;"><strong>Audio available:</strong> <a style="color:#990000;font-weight:normal;text-decoration:none;" href="' . $permalink . '">' . $permalink . '</a></p>';
		return $audio_available;
    }
    return $html;
}
add_filter( 'wp_audio_shortcode', 'wusm_remove_audio', 10, 5 );

// Remove image galleries from emails
function wusm_remove_gallery( $html ) {
	if ( get_query_var( 'template' ) == 'email' ) {
		return ' ';
	}
	return $html;
}
add_filter( 'post_gallery', 'wusm_remove_gallery', 10, 3);


// Do not use responsive images
add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );

// Add image credits to images without captions
function medicine_wrap_image( $content ) {
	global $post;
	// Regex to find all <img ... > tags
	$ic_url_regex = "/\<img [^>]*src=\"([^\"]+)\"[^>]*>/";

	// If we get any hits then put the code before and after the img tags
	if ( preg_match_all( $ic_url_regex , $content, $ic_matches ) ) {;
	    for ( $ic_count = 0; $ic_count < count( $ic_matches[0] ); $ic_count++ ) {
			// Old img tag
            $ic_old = $ic_matches[0][$ic_count];
	        if( strpos($ic_old, 'align')) {
	        	$dom = new DOMDocument();
				$dom->loadHTML($ic_old);
	        	$img = $dom->getElementsByTagName('img');

				//The email template is 600px wide, so set the widths of the containers for the image accordingly
				$width = min($img->item(0)->getAttribute('width'),600);

				if ($width > 580) {
					$width_table = '600px';
				} else {
					$width_table = $width + 20 . 'px';
				}
				$width_img = $width . 'px';

				if (preg_match("/align(\w+)/", $ic_old, $found)) {
	            	$alignment = $found[0];
	            	$align_value = str_replace("align","",$alignment);
				}

				if (preg_match("/wp-image-([0-9]+)/", $ic_old, $found)) {
					$creditID = $found[1];
				}

				$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
				if (!empty($creditName)) {
					$credit = '<span style="font-family:\'Open Sans\',Arial,sans-serif;font-size:11px;text-transform:uppercase;line-height:11px;text-align:right;margin:3px 0 3px 10px;color:#909090;display:block;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">' . $creditName . '</span>';
				}

				//img element
				if ($img->item(0)->getAttribute('width') > 600) {
					$ic_new = wp_get_attachment_image($creditID, 'news-email');
				} else {
					$ic_new = $ic_old;
				}

				// Put together the image credit code to place before the img tag
				$ic_credit_code = '<div style="width:' . $width_img . '">';

				if (!empty($creditName)) {
					// Replace before the img tag in the new string
					$ic_new = preg_replace( '/^/' , $ic_credit_code , $ic_new );
					// After the img tag
					$ic_new = preg_replace( '/$/' , $credit . '</div>' , $ic_new );
				}

				$ic_new_table = '<table width="' . $width_table . '" align="' . $align_value . '" cellpadding="0" cellspacing="0" class="templateColumnContainer" style="margin-bottom:20px;"><tbody><tr cellpadding="0" cellspacing="0"><td width="' . $width_img . '" align="' . $align_value . '" cellpadding="0" cellspacing="0">' . $ic_new . '</td></tr></tbody></table>';

	            // make the substitution
	            $content = str_replace( $ic_old, $ic_new_table , $content );
	        }
        }
    }	
	return $content;
}
add_filter( 'the_content' , 'medicine_wrap_image' );

// Remove height from [caption] shortcode
function medicine_email_caption_shortcode_filter($val, $attr, $content)
{
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
		return $val;

	//Containers in the email message can't be more than 600px wide
	$width_img = min((int) $width,600);
	if ($width_img  > 580) {
		$width_table = '600px';
	} else {
		$width_table = $width_img + 20 . 'px';
	}

	$imageID = $int = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
	$creditName = esc_html( get_post_meta( $imageID, 'image_credit', true ) );
	if (!empty($creditName)) {
		$credit = '<span style="font-family:\'Open Sans\',Arial,sans-serif;font-size:11px;text-transform:uppercase;line-height:11px;text-align:right;margin:3px 0 3px 10px;color:#909090;display:block;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">' . $creditName . '</span>';
	}

	$maxWidth = '';
	$captionAlign = esc_attr($align);
	$align_value = str_replace("align","",$captionAlign);
	if ($captionAlign == 'alignleft' || $captionAlign == 'alignright') {
		$maxWidth = 'style="max-width: ' . $width_img . 'px;"';
	}

	$captionOutput = '<table width="' . $width_table . '" align="' . $align_value . '" cellpadding="0" cellspacing="0" class="templateColumnContainer" style="margin-bottom:20px;"><tbody><tr cellpadding="0" cellspacing="0"><td width="' . $width_img . '" align="' . $align_value . '" cellpadding="0" cellspacing="0">';
	$captionOutput .= '<div class="wp-caption ' . $captionAlign . '"' . $maxWidth . '>';
	if (!empty($creditName)) {
		$captionOutput .= '<div>';
	}
	$captionOutput .= do_shortcode( $content );

	//Replace large (700px-wide) images with news-email size (600px-wide)
	if ((int) $width > 600) {
		$captionOutput = preg_replace("/\<img [^>]*src=\"([^\"]+)\"[^>]*>/", wp_get_attachment_image($imageID, 'news-email'), $captionOutput);
	}

	if (!empty($creditName)) {
		$captionOutput .= $credit . '</div>';
	}
	$captionOutput .= '<div style="font-family: \'Open Sans Condensed\', Arial, sans-serif;font-size: 16px;font-weight:bold;color:#333;margin:0;padding: 0 0 10px;line-height: 1.3;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-align:left;">' . $caption . '</div></div></td></tr></tbody></table>';

	return $captionOutput;
}
add_filter('img_caption_shortcode', 'medicine_email_caption_shortcode_filter', 10, 3 );

// Add inline styles to paragraphs and headings
$content = get_the_content();
$content = apply_filters('the_content', $content);
$replace_p = '<p style="font-family: Georgia, serif;font-size: 22px;line-height: 1.5;margin: 0 0 35px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-align:left;">';
$replace_h2 = '<h2 style="display:block;color:#333;font-family:\'Open Sans\', Arial, sans-serif;font-size:24px;font-style:normal;font-weight:bold;line-height:1.5;letter-spacing:normal;margin: 35px 0 19px;text-align:left;">';
$replace_h3 = '<h3 style="display:block;color:#333;font-family:\'Open Sans\', Arial, sans-serif;font-size:20px;font-style:normal;font-weight:600;line-height:1.5;letter-spacing:normal;margin:19px 0 10px;text-align:left;">';
$replace_ul = '<ul style="font-family: Georgia, serif;font-size: 22px;margin: 0 0 35px 40px;list-style-type: disc;text-align:left;">';
$replace_ol = '<ol style="font-family: Georgia, serif;font-size: 22px;margin: 0 0 35px 40px;text-align:left;">';
$replace_li = '<li style="margin-bottom:10px;line-height:33px;text-align:left;">';
$replace_a  = '<a style="color:#990000;font-weight:normal;text-decoration:none;" '; // Required for Gmail

$email_content = str_replace(array('<p>','<h2>','<h3>','<ul>','<ol>','<li>','<a '), array($replace_p, $replace_h2, $replace_h3, $replace_ul, $replace_ol,$replace_li,$replace_a), $content);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>News Release | Washington University in St. Louis</title>
        <style type="text/css">
			/* Client specific styles */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

			/* Reset styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table{border-collapse:collapse !important;}
			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

			#bodyCell{padding:20px;}
			#templateContainer{width:600px;}
			h1{
				display:block;
				color:#333;
				font-family: Georgia, serif;
				font-size: 35px;
				font-style:normal;
				font-weight:normal;
				line-height: 43px;
				letter-spacing:normal;
				margin: 0 0 12px;
				text-align:left;
			}
			h2{
				display:block;
				color:#333;
				font-family:'Open Sans', Arial, sans-serif;
				font-size:24px;
				font-style:normal;
				font-weight:bold;
				line-height:1.5;
				letter-spacing:normal;
				margin: 35px 0 19px;
				text-align:left;
			}
			h3{
				display:block;
				color:#333;
				font-family:'Open Sans', Arial, sans-serif;
				font-size:20px;
				font-style:normal;
				font-weight:600;
				line-height:1.5;
				letter-spacing:normal;
				margin:19px 0 10px;
				text-align:left;
			}
			.headerContent{
				font-family:'Open Sans', Arial, sans-serif;
				font-size: 16px;
				font-weight: bold;
				color: #333;
				text-transform: uppercase;
				padding-bottom:5px;
			}
			#headerImage{
				height:auto;
				max-width:600px;
			}
			.bodyContent p{
				font-size: 22px;
				line-height: 1.5;
				margin: 0 0 35px;
			}
			.bodyContent p.subhead {
				margin: 0 0 25px;
				font-size: 22px;
				font-family: 'Open Sans', Arial, sans-serif;
				color: #787878;
				line-height: 28px;
			}
			.bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{
				color:#990000;
				font-weight:normal;
				text-decoration:none;
			}
			.bodyContent img{
				display:inline;
				height:auto;
				max-width:600px;
			}
			.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
				color:#990000;
				font-weight:normal;
				text-decoration:none;
			}

            @media only screen and (max-width: 500px){
				/* Client-specific mobile styles */
				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

				#bodyCell{
					padding:10px !important;
				}
				#templateContainer{
					max-width:600px !important;
					width:100% !important;
				}
				h1{
					font-size: 26px !important;
					line-height: 34px !important;
				}
				h2{
					font-size:18px !important;
					line-height:18px !important;
					margin-bottom:7px !important;
				}
				h3{
					font-size:17px !important;
					line-height:17px !important;
					margin-bottom:7px; !important;
				}
				#headerImage{
					height:auto !important;
					max-width:600px !important;
					width:100% !important;
				}
				.bodyContent p, .bodyContent li{
					font-size:16px !important;
					line-height:23px !important;
					margin-bottom:16px !important;
				}
				.bodyContent p.subhead{
					font-size:18px !important;
				}
				.bodyContent p.featured-caption{
					padding-bottom: 9px !important;
				}
				.bodyContent p.contact{
					font-size:14px !important;
					margin: 0 !important;
				}
				.bodyContent ul, .bodyContent ol{
					margin: 0 0 19px 15px !important;
				}
				.bodyContent img{
					height:auto !important;
					max-width:600px !important;
					width:100% !important;
				}
				.templateColumnContainer{
					display: block !important;
					width: 100% !important;
				}
				.wp-caption{
					margin-bottom: 10px !important;
				}
			}
		</style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height:100% !important; margin:0; padding:0; width:100% !important;">
    	<center>
        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="height:100% !important; margin:0; padding:0; width:100% !important;border-collapse:collapse !important;">
            	<tr>
                	<td align="center" valign="top" id="bodyCell" style="height:100% !important; margin:0; padding:20px; width:100% !important;">
                    	<!-- BEGIN TEMPLATE // -->
                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer" style="width:600px;border-collapse:collapse !important;">
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN HEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader" style="border-collapse:collapse !important;">
                                        <tr>
                                            <td valign="top" class="headerContent" style="font-family:'Open Sans',Arial,sans-serif;font-size:16px;font-weight:bold;color:#6e6e6e;padding-bottom:5px;letter-spacing:0.6px;text-align:left;">
                                            	<a href="https://medicine.wustl.edu/"><img src="<?php echo get_template_directory_uri() . '/_/img/wusm-logo.jpg'; ?>" id="headerImage" style="height:auto;max-width:600px;padding-bottom:20px;border-bottom:1px solid #e1e1e1;margin-bottom:30px;" alt="Washington University School of Medicine in St. Louis" /></a>
												NEWS RELEASE
                                            </td>
                                        </tr>
									</table>
									<!-- // END HEADER -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- BEGIN BODY // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody" style="border-collapse:collapse !important;">
										<tr>
											<td valign="top" class="bodyContent">
												<?php
												if ( get_post_status() == 'future' ) {
													$date_time = get_the_date('F j, Y') . ' ' . get_the_time('H:i:s');
													$embargo_lift_pre = date('g:i a l, M. j, Y', strtotime($date_time . '+ 1 hour'));
													$embargo_lift = str_replace(array('am','pm',':00','Mar.','Apr.','May.','Jun.','Jul.'),array('a.m. ET','p.m. ET','','March','April','May','June','July'),$embargo_lift_pre);
													echo '<p style="font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;font-weight: bold;color: #333;margin-bottom:25px;margin-top:0;background:#f2eb29;padding:10px 20px;text-align:center;">Embargoed until ' . $embargo_lift . '</p>';
												} else {
													echo '<p style="font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;font-weight: normal;color: #333;margin-bottom:25px;margin-top:0;text-align:left;">' . get_the_date() . '</p>';
												}
												?>
												<h1 style="display:block;font-family:Georgia,serif;font-size:35px;font-style:normal;font-weight:normal;line-height:43px;letter-spacing:normal;margin: 0 0 12px;text-align:left;"><a style="color:#990000;text-decoration:none;font-weight:normal;" href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h1>
												<?php
												if(has_excerpt()):
													echo '<p class="subhead" style="margin: 0 0 25px;font-size: 22px;font-family: \'Open Sans\', Arial, sans-serif;color: #787878;line-height: 28px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-align:left;">' . get_the_excerpt() . '</p>';
												endif;

												$has_media_contact = '';
												$rows_mc = get_field( 'media_contact' );
												if($rows_mc[0]['media_contact']) {
													$has_media_contact = $rows_mc[0]['media_contact'];
												}
												if( $has_media_contact ):
													if( have_rows('media_contact') ):
														while ( have_rows('media_contact') ) : the_row();
															if(get_sub_field('custom_media_contact')) {
																$media_contact_name = get_sub_field('name');
																$media_contact_email = get_sub_field('email_address');
																$media_contact_phone = get_sub_field('phone_number');
															} elseif(get_sub_field('media_contact')) {
																$author = get_sub_field('media_contact');
																$user_id = $author['ID'];
																$media_contact_name = get_the_author_meta( 'display_name', $user_id);
																$media_contact_email = get_the_author_meta( 'user_email', $user_id );
																$media_contact_phone = get_user_meta( $user_id, 'phone', true);
															}
														endwhile;
														?>

														<p class="contact" style="font-family:'Open Sans', Arial, sans-serif;font-size: 14px;font-weight: bold;color: #333;padding:0;margin:0;text-align:left;">MEDIA CONTACT</p>
														<p class="contact" style="font-family:'Open Sans', Arial, sans-serif;font-size: 14px;font-weight: normal;color: #333;padding:0;margin:0;text-align:left;"><?php echo $media_contact_name; ?> &middot; <a href="mailto:<?php echo $media_contact_email; ?>" style="color:#990000;text-decoration:none;"><?php echo $media_contact_email; ?></a> &middot; <?php echo $media_contact_phone; ?></p>
													<?php
													endif;
												endif;

												if( get_field('audio') ) { ?>
													<p style="font-family:'Open Sans', Arial, sans-serif;font-size: 14px;font-weight: normal;color: #333;padding:0;margin-top:15px;text-align:left;"><strong>AUDIO</strong><br> <a style="color:#990000;font-weight:normal;text-decoration:none;" href="<?php echo $permalink; ?>"><?php echo $permalink; ?></a></p>
												<?php }

												if(has_post_thumbnail()) {
													echo '<div style="margin-top:25px;">';
													the_post_thumbnail('news-email');
													$creditID = get_post_thumbnail_id();
													$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
													$credit = '';
													if (!empty($creditName)) {
														$credit = '<span style="font-family:\'Open Sans\',Arial,sans-serif;font-size:11px;text-transform:uppercase;line-height:11px;text-align:right;margin:3px 0 3px 10px;color:#909090;display:block;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">' . $creditName . '</span>';
													}
													echo $credit;
													echo '</div>';
													$post_thumbnail_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
													if(!empty($post_thumbnail_caption)) {
														echo '<p class="featured-caption" style="font-family: \'Open Sans Condensed\', Arial, sans-serif;font-size: 16px;font-weight:bold;color:#333;margin:0;padding: 0 0 45px;line-height: 1.3;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-align:left;">' . $post_thumbnail_caption . '</p>';
													}
												}

												echo $email_content; ?>
											</td>
										</tr>
									</table>
									<!-- // END BODY -->
								</td>
							</tr>
							<?php if (get_field('boilerplate')) :
								$replace_p = '<p style="font-size: 14px;font-family: \'Open Sans\', Arial, sans-serif;color:#333;line-height: 21px;margin: 0 0 16px;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;text-align:left;">';
								$replace_a = '<a style="color:#990000;font-weight:normal;text-decoration:none;" '; // Required for Gmail
								$email_boilerplate = str_replace(array('<p>','<a '), array($replace_p,$replace_a), get_field('boilerplate'));
							?>
							<tr>
								<td align="center" valign="top">
									<!-- BEGIN FOOTER // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="border-collapse:collapse !important;">
										<tr>
											<td valign="top" class="footerContent" style="border-top:#ccc 2px solid;padding:25px 0 9px 0;">
												<?php echo $email_boilerplate; ?>
											</td>
										</tr>
									</table>
									<!-- // END FOOTER -->
								</td>
							</tr>
							<?php endif; ?>
						</table>
						<!-- // END TEMPLATE -->
					</td>
				</tr>
			</table>
        </center>
    </body>
</html>
<?php
	endwhile;
endif;
?>