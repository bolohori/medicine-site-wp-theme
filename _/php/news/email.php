<?php
header("Content-Type: text/plain");
	if (have_posts()) :
		while (have_posts()) :
			the_post();

if(get_field('embargoed_url')) {
	$permalink = get_field('embargoed_url');
} else {
	$permalink = get_the_permalink();
}

// Remove embeds from emails
function wusm_remove_oembed( $html ) {
	if ( get_query_var( 'template' ) == 'email' ) {
		$video_available = '<p><strong>Video available:</strong> <a style="color:#990000;font-weight:normal;text-decoration:none;" href="' . $permalink . '">' . $permalink . '</a></p>';
		return $video_available;
	}
	return $html;
}
add_filter('embed_oembed_html', 'wusm_remove_oembed', 99, 4);

// Remove audio from emails
function wusm_remove_audio( $html ) {
    if ( get_query_var( 'template' ) == 'email' ) {
    	$audio_available = '<p><strong>Audio available:</strong> <a style="color:#990000;font-weight:normal;text-decoration:none;" href="' . $permalink . '">' . $permalink . '</a></p>';
		return $audio_available;
    }
    return $html;
}
add_filter( 'wp_audio_shortcode', 'wusm_remove_audio', 10, 5 );

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
					$credit = '<span style="font-family:Arial,sans-serif;font-size:11px;text-transform:uppercase;line-height:1;text-align:right;margin:4px 4px 3px 15px;color:#909090;display:block;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">' . $creditName . '</span>';
				}

				//img element
				if ($img->item(0)->getAttribute('width') > 600) {
					$ic_new = wp_get_attachment_image($creditID, 'news-email');
				} else {
					$ic_new = $ic_old;
				}

				// Put together the image credit code to place before the img tag
				$ic_credit_code = '<div class="credit-container ' . $alignment . '" style="width:' . $width_img . '">';

				if (!empty($creditName)) {
					// Replace before the img tag in the new string
					$ic_new = preg_replace( '/^/' , $ic_credit_code , $ic_new );
					// After the img tag
					$ic_new = preg_replace( '/$/' , $credit . '</div>' , $ic_new );
				}

				$ic_new_table = '<table width="' . $width_table . '" align="' . $align_value . '" cellpadding="0" cellspacing="0" class="templateColumnContainer" style="margin-bottom:15px;"><tbody><tr cellpadding="0" cellspacing="0"><td width="' . $width_img . '" align="' . $align_value . '" cellpadding="0" cellspacing="0">' . $ic_new . '</table>';

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
		$credit = '<span style="font-family:Arial,sans-serif;font-size:11px;text-transform:uppercase;line-height:1;text-align:right;margin:4px 4px 3px 15px;color:#909090;display:block;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;float:right;">' . $creditName . '</span>';
	}

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	$maxWidth = '';
	$captionAlign = esc_attr($align);
	$align_value = str_replace("align","",$captionAlign);
	if ($captionAlign == 'alignleft' || $captionAlign == 'alignright') {
		$maxWidth = 'style="max-width: ' . $width_img . 'px;"';
	}

	$captionOutput = '<table width="' . $width_table . '" align="' . $align_value . '" cellpadding="0" cellspacing="0" class="templateColumnContainer" style="margin-bottom:15px;"><tbody><tr cellpadding="0" cellspacing="0"><td width="' . $width_img . '" align="' . $align_value . '" cellpadding="0" cellspacing="0">';
	$captionOutput .= '<div class="wp-caption ' . $captionAlign . '"' . $maxWidth . '>';
	if (!empty($creditName)) {
		$captionOutput .= '<div class="credit-container">';
	}
	$captionOutput .= do_shortcode( $content );

	//Replace large (700px-wide) images with news-email size (600px-wide)
	if ((int) $width > 600) {
		$captionOutput = preg_replace("/\<img [^>]*src=\"([^\"]+)\"[^>]*>/", wp_get_attachment_image($imageID, 'news-email'), $captionOutput);
	}

	if (!empty($creditName)) {
		$captionOutput .= $credit . '</div>';
	}

	$captionOutput .= '<div ' . $capid . ' style="background:#F5F5F5;margin:0;padding:10px;line-height:140%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-align:left;">' . $caption . '</div></div></td></tr></tbody></table>';

	return $captionOutput;
}
add_filter('img_caption_shortcode', 'medicine_email_caption_shortcode_filter', 10, 3 );

// Add inline styles to paragraphs and headings
$content = get_the_content();
$content = apply_filters('the_content', $content);
$replace_p = '<p style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;">';
$replace_h2 = '<h2 style="display:block;font-family:Georgia;font-size:20px;font-style:normal;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;">';
$replace_h3 = '<h3 style="display:block;font-family:Georgia;font-size:16px;font-style:normal;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;">';
$replace_h4 = '<h4 style="display:block;font-family:Georgia;font-size:14px;font-style:normal;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;">';

$email_content = str_replace(array('<p>','<h2>','<h3>','<h4>'), array($replace_p, $replace_h2, $replace_h3, $replace_h4), $content);

//Indent the HTML for the email content so it's easier to read
$config = array(
	'indent'     => true,
	'output-xml' => true,
	'input-xml'  => true,
	'wrap'       => '1000');
$tidy = new tidy();
$tidy->parseString($email_content, $config, 'utf8');
$tidy->cleanRepair();

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
				font-family:Georgia;
				font-size:26px;
				font-style:normal;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}
			h2{
				display:block;
				font-family:Georgia;
				font-size:20px;
				font-style:normal;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}
			h3{
				display:block;
				font-family:Georgia;
				font-size:16px;
				font-style:normal;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}
			h4{
				display:block;
				font-family:Georgia;
				font-size:14px;
				font-style:normal;
				font-weight:normal;
				line-height:100%;
				letter-spacing:normal;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				text-align:left;
			}
			.headerContent{
				padding-bottom:15px;
			}
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				color:#990000;
				font-weight:normal;
				text-decoration:none;
			}
			#headerImage{
				height:auto;
				max-width:600px;
			}
			.bodyContent{
				color:#333;
				font-family:Georgia;
				font-size:14px;
				line-height:150%;
				padding-top:30px;
				padding-bottom:20px;
				text-align:left;
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
			#templateFooter{
				border-top:#990000 2px solid;
			}
			.footerContent{
				color:#787878;
				font-family:Georgia;
				font-size:10px;
				line-height:150%;
				padding-top:20px;
				padding-bottom:20px;
				text-align:left;
			}
			.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
				color:#990000;
				font-weight:normal;
				text-decoration:none;
			}

            @media only screen and (max-width: 480px){
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
					font-size:24px !important;
					line-height:100% !important;
				}
				h2{
					font-size:20px !important;
					line-height:100% !important;
				}
				h3{
					font-size:18px !important;
					line-height:100% !important;
				}
				h4{
					font-size:16px !important;
					line-height:100% !important;
				}
				#headerImage{
					height:auto !important;
					max-width:600px !important;
					width:100% !important;
				}
				.headerContent{
					padding-bottom: 12px !important;
				}
				.bodyContent{
					font-size:16px !important;
					line-height:140% !important;
				}
				.bodyContent img {
					height:auto !important;
					max-width:600px !important;
					width:100% !important;
				}
				.templateColumnContainer {
					display: block !important;
					width: 100% !important;
				}
				#news-release img {
					max-width: 150px;
				}
				.wp-caption {
					margin-bottom: 5px;
				}
				#media-contact {
					padding-top: 15px;
				}
				.footerContent{
					font-size:14px !important;
					line-height:115% !important;
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
                                            <td valign="top" class="headerContent" style="padding-bottom:15px;">
                                            	<img src="<?php echo get_template_directory_uri() . '/_/img/wusm-logo.jpg'; ?>" id="headerImage" style="height:auto;max-width:600px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                        <td align="center" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse !important;"> 
	                                        <tr>
	                                        	<td align="left" valign="middle" style="width:280px;" id="news-release" class="templateColumnContainer">
	                                            	<img src="<?php echo get_template_directory_uri() . '/_/img/news-release.jpg'; ?>" />
	                                            </td><?php
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
    		$media_contact_phone = get_sub_field('phone_number');
    		$media_contact_email = get_sub_field('email_address');
    	} elseif(get_sub_field('media_contact')) {
    		$author = get_sub_field('media_contact');
			$user_id = $author['ID'];
			$media_contact_name = get_the_author_meta( 'display_name', $user_id);
			$media_contact_phone = get_user_meta( $user_id, 'phone', true);
			$media_contact_email = get_the_author_meta( 'user_email', $user_id );
    	}
    endwhile;
?><td align="left" valign="top" style="width:220px;line-height:1;" id="media-contact" class="templateColumnContainer">
<p style="font-family:Georgia,serif;font-size:11px;padding:0;margin:0;line-height:100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;"><strong>Media Assistance:</strong><br>
<?php echo $media_contact_name; ?><br><?php echo $media_contact_phone; if($media_contact_phone && $media_contact_email) { echo ' | '; } ?><a href="mailto:<?php echo $media_contact_email; ?>" style="color:#990000;text-decoration:none;"><?php echo $media_contact_email; ?></a></p></td>
<?php endif; endif; ?>
	                                        </tr>
	                                    </table>
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
                                            <td valign="top" class="bodyContent" style="color:#333;font-family:Georgia;font-size:14px;line-height:150%;padding-top:30px;padding-bottom:20px;text-align:left;">
				<?php

				if ( get_post_status() == 'future' ) {
					$date_time = get_the_date('F j, Y') . ' ' . get_the_time('H:i:s');
					$embargo_lift_pre = date('g:i a l, M j, Y', strtotime($date_time . '+ 1 hour'));
					$embargo_lift = str_replace(array('am','pm'),array('a.m. ET','p.m. ET'),$embargo_lift_pre);
				    echo '<p style="background:#FFFF52;padding:10px 15px;font-weight:normal;text-align:center;font-size:16px;">Embargoed until ' . $embargo_lift . '</p>';
				}
				
				?><h1 style="display:block;font-family:Georgia;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;text-align:left;"><a style="color:#990000;text-decoration:none;font-weight:normal;" href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h1><?php
				
				if(has_excerpt()):
					echo '<p style="font-size:16px;color:#787878;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;">' . get_the_excerpt() . '</p>';
				endif;

				echo '<p style="margin:0px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;">';

				if( have_rows('article_author') ):
				$author = array();
					while ( have_rows('article_author') ) : the_row();
						if(get_sub_field('custom_author')) {
							$author[] = get_sub_field('name');
						} elseif(get_sub_field('author')) {
				        	$wp_author = get_sub_field('author');
							$user_id = $wp_author['ID'];
							$author[] = get_the_author_meta( 'display_name', $user_id);
						}
					endwhile;

					switch (count($author)) {
					    case 0:
					        $result = '';
					        break;
					    case 1:
					        $result = 'by ' . reset($author);
					        break;
					    default:
					        $last = array_pop($author);
					        $result = 'by ' . implode(', ', $author) . ' & ' . $last;
					        break;
					}
        			echo $result;
        		endif;
				
				echo '</p>';

				echo '<p style="margin-bottom:15px;margin-top:0;">' . get_the_date() . '</p>';

				if( get_field('audio') ) { ?>
					<p><strong>Article audio:</strong> <a style="color:#990000;font-weight:normal;text-decoration:none;" href="<?php echo $permalink; ?>"><?php echo $permalink; ?></a></p>
				<?php }

				if(has_post_thumbnail()) {
					the_post_thumbnail('news-email');
					$creditID = get_post_thumbnail_id();
					$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
					$credit = '';
					if (!empty($creditName)) {
						$credit = '<span style="font-family:Arial,sans-serif;font-size:11px;text-transform:uppercase;text-align:right;margin:0 4px 3px 15px;color:#909090;float:right;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">' . $creditName . '</span>';
					}
					echo $credit;
					$post_thumbnail_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
					if(!empty($post_thumbnail_caption)) {
						echo '<p style="background:#F5F5F5;margin:0;padding:10px;line-height:140%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;">' . $post_thumbnail_caption . '</p>';
					}
				} ?>

												<?php echo tidy_get_output($tidy); ?>

												<p style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin-top:40px;">URL: <a style="color:#990000;text-decoration:none;font-weight:normal;" href="<?php echo $permalink; ?>"><?php echo $permalink; ?></a></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                	<!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="border-top:#990000 2px solid;border-collapse:collapse !important;">
                                        <tr>
                                            <td valign="top" class="footerContent" style="color:#787878;font-family:Georgia;font-size:10px;line-height:150%;padding-top:20px;padding-bottom:20px;text-align:left;">
                                                <p style="margin:0 0 6px 0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;"><a href="https://medicine.wustl.edu" style="color:#990000;font-weight:normal;text-decoration:none;font-family:Georgia,serif;font-size:13px;">Washington University School of Medicine in St. Louis</a></p><p style="margin:0 0 4px 0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;color:#666666;font-size:12px;"><span style="margin-right:10px;">Office of Medical Public Affairs</span><span style="display:inline-block;margin-right:10px;">(314) 286-0100</span><a href="https://medicine.wustl.edu" style="color:#990000;font-weight:normal;text-decoration:none;">medicine.wustl.edu</a></p><p style="margin:0 0 5px 0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">Affiliated with Barnes-Jewish Hospital and St. Louis Children's Hospital, which are members of BJC HealthCare.</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
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