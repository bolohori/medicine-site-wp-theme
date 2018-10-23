'use strict';

module.exports = function (grunt) {

		// Load grunt tasks automatically
		require('load-grunt-tasks')(grunt);

		// Define shared variables for all tasks

		/* 
		====== WE WILL PROBABLY INCLUDE THIS AT SOME POINT. JUST NOT NOW. ======
		var jsUglifyFileMap = {
			// scripts.min.js contains all the scripts we want to load
			// at the footer on every page
			'_assets/js/scripts.js': [
				'_assets/js/lib/jquery.fitvids.js',
				'_assets/js/lib/picturefill.3.0.2.min.js', // already minified, but we want to concat it
				'_assets/js/lib/stickyfill.min.js',
				'_assets/js/lib/priority-nav.js',
				'_assets/js/lib/jquery.sticky.js',
				'_assets/js/src/scripts/*.js'
			],
			// scripts for the backend
			'_assets/js/customizer.js': ['_assets/js/src/customizer.js'],
			// polyfills for IE8
			'_assets/js/ie8.js': [
				'_assets/js/lib/html5shiv.min.js',
				'_assets/js/lib/respond.min.js'
			]
		}; */

		// Define the configuration for all the tasks
		grunt.initConfig({
			// Add vendor prefixed styles
			autoprefixer: {
				dist: {
					files: {
						'style.css': 'style.css',
					}
				},
				options: {
					map: true
				}
			},

			sass: {
				options: {
					sourceMap: true,
					outputStyle: 'compressed',
				},
				dist: {
					files: {
						'style.css': '_/sass/style.scss',
					}
				}
			},

			uglify: {
				dev: {
					options: {
						mangle: false,
						beautify: true,
						sourceMap: true
					}
				},
				dist: {
				},
			},

			watch: {
				sass: {
					files: ['_/sass/*.scss'],
					tasks: ['sass', 'autoprefixer']
				},
				php: {
					files: ['**/*.php']
				},
				options: {
					livereload: true,
				},
			}

		});

		// Define your default tasks
		grunt.registerTask('default', [
			'sass',
			'autoprefixer',
			'uglify:dist'
		]);

		grunt.registerTask('dev', [
			'default',
			'watch',
		]);

		grunt.registerTask('debug', [
			'uglify:dev'
		]);

		grunt.registerTask('build', [
			'default'
		]);
};
