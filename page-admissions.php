<?php
get_header();
if (have_posts()) :
	while (have_posts()) :
		the_post(); ?>
		<div class="intro">
			<div class="wrapper">
				<?php the_title('<h1>', '</h1>'); ?>
				<?php the_content(); ?>
				<ul class="program-list clearfix">
					<li><a href="#medical-education">Medical Education</a></li>
					<li><a href="#OT">Occupational Therapy</a></li>
					<li><a href="#PACS">Audiology &amp; Communication Sciences</a></li>
					<li><a href="#PT">Physical Therapy</a></li>
					<li class="last-child"><a href="#DBBS">Biology &amp; Biomedical Sciences</a></li>
					<li class="last-child"><a href="#admissions-resources">Admissions Resources</a></li>
				</ul>
			</div>
		</div>
		<div class="hero-lists clearfix">
			<div class="wrapper">
				<div class="left-col">
					<ul id="medical-education" class="hero-list left-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/medical-education.png" alt=""></li>
						<li class="hero-list-title">Medical Education</li>
						<li><a href="http://medadmissions.wustl.edu/Education/degreeprograms/Pages/DegreePrograms.aspx">Doctor of Medicine (MD)</a></li>
						<li><a href="http://mstp.wustl.edu/admissions/Pages/Admissions.aspx">MSTP (MD/PhD)</a></li>
						<li><a href="http://bme.wustl.edu/graduateprograms/Pages/default.aspx">Biomedical Engineering (MD/PhD)</a></li>
						<li><a href="http://dhbr.dom.wustl.edu/education/overview/13-masters-program/23-mp-masters-of-science-2.html">Applied Health Behavior Research (MS)</a></li>
						<li><a href="https://biostatistics.wustl.edu/training/msibs/prospectivestudents/MS/Pages/default.aspx">Biostatistics (MS)</a></li>
						<li><a href="http://crtc.wustl.edu/index.php/degree-programs/msci">Clinical Investigation (MSCI)</a></li>
						<li><a href="https://biostatistics.wustl.edu/training/msibs/prospectivestudents/GEMS/Pages/default.aspx">Genetic Epidemiology (MS)</a></li>
						<li><a href="http://www.mphs.wustl.edu/">Population Health (MPHS)</a></li>
						<li><a href="http://brownschool.wustl.edu/Admissions/MPH/Pages/MPHLanding.aspx">Public Health (MPH)</a></li>
					</ul>
					<ul id="DBBS" class="hero-list left-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/dbbs.png" alt=""></li>
						<li class="hero-list-title">Biology &amp; Biomedical Sciences</li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/biochemistry/Pages/Biochemistry.aspx">Biochemistry (PhD)</a></li>
						<li><a href="http://www.dbbs.wustl.edu/divprograms/biophysics/Pages/ComputationalAndMolecularBiophysics.aspx">Computational and Molecular Biophysics (PhD)</a></li>
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
				</div>
				<div class="right-col">
					<ul id="PACS" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/pacs.png" alt=""></li>
						<li class="hero-list-title">Audiology &amp; Communication Sciences</li>
						<li><a href="http://pacs.wustl.edu/programs/doctor-of-audiology/">Audiology (AuD)</a></li>
						<li><a href="http://pacs.wustl.edu/programs/doctor-of-philosophy/">Speech and Hearing Sciences (PhD)</a></li>
						<li><a href="http://pacs.wustl.edu/programs/master-of-science-in-deaf-education/">Deaf Education (MS)</a></li>
					</ul>
					<ul id="OT" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/ot.png" alt=""></li>
						<li class="hero-list-title">Occupational Therapy</li>
						<li><a href="http://www.ot.wustl.edu/education/phd-in-rehabilitation-participation-science-142">Rehabilitation and Participation Science (PhD)</a></li>
						<li><a href="http://www.ot.wustl.edu/education/masters-msot-131">Occupational Therapy (MS)</a></li>
						<li><a href="http://www.ot.wustl.edu/education/doctorate-otd-140">Occupational Therapy (OTD)</a></li>
					</ul>
					<ul id="PT" class="hero-list right-row">
						<li class="li-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/admissions/pt.png" alt=""></li>
						<li class="hero-list-title">Physical Therapy</li>
						<li><a href="https://pt.wustl.edu/Education/DoctoralEducation/PhDinMovementScience/Pages/PhDinMovementScience.aspx">Movement Science (PhD)</a></li>
						<li><a href="https://pt.wustl.edu/Education/DoctoralEducation/DoctorofPhysicalTherapy/Pages/DoctorofPhysicalTherapy.aspx">Physical Therapy (DPT)</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="admissions-resources" class="admission-footer clearfix">
			<div class="wrapper">
				<ul class="clearfix">
					<li class="list-title">Admission Resources</li>
					<li><a target="_blank" href="http://medicine.wustl.edu/directory/academic-departments">Academic Departments &amp; Programs</a></li>
					<li><a target="_blank" href="http://bulletinoftheschoolofmedicine.wustl.edu/">Bulletin: Courses, Programs, Policies</a></li>
					<li><a target="_blank" href="https://cme.wustl.edu/">Continuing Medical Education</a></li>
					<li><a target="_blank" href="http://wumsfinaid.wustl.edu/">Financial Aid</a></li>
					<li><a target="_blank" href="http://gme.wustl.edu/">Graduate Medical Education</a></li>
					<li><a target="_blank" href="http://postdoc.wustl.edu/">Postdoctoral Affairs</a></li>
					<li><a target="_blank" href="http://wusmregistrar.wustl.edu/">Registrar</a></li>
					<li><a target="_blank" href="http://wustl.edu/admissions/">WUSTL Admissions - Danforth Campus</a></li>
				</ul>
			</div>
		</div>
<?php endwhile;
endif;
get_footer(); ?>
