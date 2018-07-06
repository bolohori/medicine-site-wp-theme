<?php
get_header();
if (have_posts()) :
	while (have_posts()) :
		the_post(); ?>
	<div class="page-template-admissions-php">
		<div class="intro">
			<div class="wrapper">
				<?php the_title('<h1>', '</h1>'); ?>
				<?php the_content(); ?>
				<ul class="program-list clearfix">
					<li><a href="#medical-education">Medical Education</a></li>
					<li><a href="#PACS">Audiology &amp; Communication Sciences</a></li>
					<li><a href="#DBBS">Biology &amp; Biomedical Sciences</a></li>
					<li><a href="#CPR">Clinical &amp; Population Research</a></li>
					<li><a href="#OT">Occupational Therapy</a></li>
					<li class="last-child"><a href="#PT">Physical Therapy</a></li>
					<li class="last-child"><a href="#admissions-resources">Admissions Resources</a></li>
				</ul>
			</div>
		</div>
		<div class="hero-lists clearfix">
			<div class="wrapper">
				<div class="admissions-left-col">
					<ul id="medical-education" class="hero-list left-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/medical-education.jpg" alt=""></li>
						<li class="hero-list-title">Medical Education</li>
						<li><a href="https://bme.wustl.edu/graduate/phd/Pages/default.aspx">Biomedical Engineering (MD/PhD)</a></li>
						<li><a href="http://mdadmissions.wustl.edu">Doctor of Medicine (MD)</a></li>
						<li><a href="http://dbbs.wustl.edu/divprograms/mamd/Pages/mamd.aspx">Doctor of Medicine and Master of Arts (MD/MA)</a></li>
						<li><a href="https://brownschool.wustl.edu/academics/joint-and-dual-degrees/pages/MPH-doctor-of-medicine.aspx">Doctor of Medicine and Master of Public Health (MD/MPH)</a></li>
						<li><a href="http://www.mphs.wustl.edu/en/Academics/MD-MPHS">Doctor of Medicine and Master of Population Health Sciences (MD/MPHS)</a></li>
						<li>Doctor of Medicine and <a href="https://crtc.wustl.edu/programs/degrees/msci/">Master of Science in Clinical Investigation</a> (MD/MSCI)</li>
						<li><a href="http://mstp.wustl.edu/admissions/Pages/Admissions.aspx">Medical Scientist Training Program (MD/PhD)</a></li>
					</ul>
					<ul id="DBBS" class="hero-list left-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/dbbs.jpg" alt=""></li>
						<li class="hero-list-title">Biology &amp; Biomedical Sciences</li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/biophysics/Pages/BBSB.aspx">Biochemistry, Biophysics & Structural Biology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/compbio/Pages/default.aspx">Computational and Systems Biology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/devbio/Pages/default.aspx">Developmental, Regenerative and Stem Cell Biology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/eepb/Pages/default.aspx">Evolution, Ecology and Population Biology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/hsg/Pages/default.aspx">Human and Statistical Genetics (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/immunology/Pages/default.aspx">Immunology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/cellbio/Pages/default.aspx">Molecular Cell Biology (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/genetics/Pages/default.aspx">Molecular Genetics and Genomics (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/micro/Pages/default.aspx">Molecular Microbiology and Microbial Pathogenesis (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/neuro/Pages/default.aspx">Neurosciences (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/PlantMicroBioSci/Pages/default.aspx">Plant and Microbial Biosciences (PhD)</a></li>
					</ul>
					<ul id="OT" class="hero-list left-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/ot.jpg" alt=""></li>
						<li class="hero-list-title">Occupational Therapy</li>
						<li><a href="http://www.ot.wustl.edu/education/phd-in-rehabilitation-and-participation-science-142">Rehabilitation and Participation Science (PhD)</a></li>
						<li><a href="http://www.ot.wustl.edu/education/masters-msot-131">Occupational Therapy (MS)</a></li>
						<li><a href="https://www.ot.wustl.edu/education/doctorate-otd-587">Occupational Therapy (OTD)</a></li>
					</ul>
				</div>
				<div class="admissions-right-col">
					<ul id="PACS" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/pacs.jpg" alt=""></li>
						<li class="hero-list-title">Audiology &amp; Communication Sciences</li>
						<li><a href="http://pacs.wustl.edu/programs/doctor-of-audiology/">Audiology (AuD)</a></li>
						<li><a href="http://pacs.wustl.edu/programs/doctor-of-philosophy/">Speech and Hearing Sciences (PhD)</a></li>
						<li><a href="http://pacs.wustl.edu/programs/master-of-science-in-deaf-education/">Deaf Education (MS)</a></li>
					</ul>
					<ul id="CPR" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/cpr.jpg" alt=""></li>
						<li class="hero-list-title">Clinical &amp; Population Research</li>
						<li><a href="https://crtc.wustl.edu/programs/degrees/ahbr/">Applied Health Behavior Research (MS)</a></li>
						<li><a href="https://biostatistics.wustl.edu/education/master-of-science-in-biostatistics-msibs/">Biostatistics (MS)</a></li>
						<li><a href="https://crtc.wustl.edu/programs/degrees/msci/ ">Clinical Investigation (MSCI)</a></li>
						<li><a href="https://biostatistics.wustl.edu/education/master-of-science-in-genetic-epidemiology-gems/">Genetic Epidemiology (MS)</a></li>
						<li><a href="http://www.mphs.wustl.edu/en">Population Health (MPHS)</a></li>
						<li><a href="http://mph.wustl.edu/">Public Health (MPH)</a></li>
					</ul>
					<ul id="PT" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/pt.jpg" alt=""></li>
						<li class="hero-list-title">Physical Therapy</li>
						<li><a href="https://pt.wustl.edu/education/phd-in-movement-science/">Movement Science (PhD)</a></li>
						<li><a href="https://pt.wustl.edu/education/doctor-of-physical-therapy/">Physical Therapy (DPT)</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="admissions-resources" class="admission-footer clearfix">
			<div class="wrapper">
				<ul class="clearfix">
					<li class="list-title">Admissions Resources</li>
					<li><a href="http://medicine.wustl.edu/directory/academic-departments">Academic Departments &amp; Programs</a></li>
					<li><a href="https://bulletin.med.wustl.edu/">Bulletin: Courses, Programs, Policies</a></li>
					<li><a href="https://cme.wustl.edu/">Continuing Medical Education</a></li>
					<li><a href="http://finaid.med.wustl.edu/">Financial Aid</a></li>
					<li><a href="http://gme.wustl.edu/">Graduate Medical Education</a></li>
					<li><a href="http://postdoc.wustl.edu/">Postdoctoral Affairs</a></li>
					<li><a href="http://registrar.med.wustl.edu/">Registrar</a></li>
					<li><a href="http://wustl.edu/admissions/">WUSTL Admissions - Danforth Campus</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php endwhile;
endif;
get_footer(); ?>
